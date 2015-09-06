<?php

namespace Admin\Controller;
use Think\Controller;
use Admin\Model\NodesModel;
use Think\Model;

/**
 *
 * @desc 更新节点
 */
class FlushNodesController  extends BaseController{
    var $controllers = array();

    /**
     * @isMenu  0
     * @desc 初始化节点数据
     */
    public function rebuild(){
        LogController::__write();
        $modules = array('Admin');  //模块名称
        $controllerArr = array('login','auth','base');
        $i = 0;
        foreach ($modules as $module) {
            $all_controller = $this->getController($module);
            foreach ($all_controller as $controller) {
                if(!in_array(strtolower($controller),$controllerArr)){
                    $controller_name = $controller;
                    $all_action = $this->getAction($module, $controller_name);
                   // $classname = $this->getClassDesc($module,$controller_name);
                    foreach ($all_action as $action) {
                        $classProperty  = $this->get_cc_desc($module,$controller,$action);
                        $data[$controller]['Desc'] = $this->getClassDesc($module,$controller);
                        $data[$controller]['Method'][] = array(
                            'Name' =>($action),
                            'Desc'=>$classProperty['desc'],
                            'IsMenu'=>$classProperty['ismenu']
                        );
                        $i++;
                    }
                }
            }
        }

        $db = new NodesModel();
       foreach($data as $k => $v){
            $rows = array(
                'controller' => $k,
                'controller_name' => $v['Desc'],
                'rootid'=>0,
                'ismenu'=>1
            );

            if($ret = $db->where(array('controller'=>$k,'rootid'=>0))->find()){
                $db->where('id='.$ret['id'])->save($rows);
                $rootid = $ret['id'];
            }else{
                $rootid  = $db->add($rows);
            }



           for($i=0;$i<count($v['Method']);$i++){
               $method = array(
                   'controller'=>$k,
                    'method'=>$v['Method'][$i]['Name'],
                    'method_name' => $v['Method'][$i]['Desc'],
                    'ismenu' =>  $v['Method'][$i]['IsMenu'],
                    'rootid' =>  $rootid
               );



               if($ret = $db->where(array('controller'=>$k,'method'=>$method['method']))->find()){
                   $db->where('id='.$ret['id'])->save($method);
               }else{
//                   print_r($method);
                   $db->add($method);
               }
           }
       }
        $success['code'] = 'success';
        $success['text'] = '所有节点刷新完成';
        session('notice',$success);
        $this->redirect('/Index/nodes');
    }

    /**
     * @cc 获取所有控制器名称
     *
     * @param $module
     *
     * @return array|null
     */
    protected function getController($module){
        if(empty($module)) return null;
        $module_path = APP_PATH . '/' . $module . '/Controller/';  //控制器路径
        if(!is_dir($module_path)) return null;
        $module_path .= '/*.class.php';
        $ary_files = glob($module_path);
        foreach ($ary_files as $file) {
            if (is_dir($file)) {
                continue;
            }else {
                $files[] = basename($file, C('DEFAULT_C_LAYER').'.class.php');
            }
        }
        return $files;
    }




    /**
     * @cc 获取所有方法名称
     *
     * @param $module
     * @param $controller
     *
     * @return array|null
     */
    protected function getAction($module, $controller){
        if(empty($controller)) return null;
        $content = file_get_contents(APP_PATH . '/'.$module.'/Controller/'.$controller.'Controller.class.php');

        preg_match_all("/.*?public.*?function(.*?)\(.*?\)/i", $content, $matches);
        $functions = $matches[1];

        //排除部分方法
        $inherents_functions = array(
            'init','_initialize','__construct','getActionName','isAjax','display','show','fetch','buildHtml','assign','__set','get','__get','__isset','__call','error','success','ajaxReturn','redirect','__destruct','_empty','__write');
        foreach ($functions as $func){
            $func = trim($func);
            //if(!in_array($func, $inherents_functions)){
            if(substr($func,0,2)!='__'){ //如果不想该方法被记录，就以两个下划线命名
                if (strlen($func)>0)   $customer_functions[] = $func;
            }
        }
        return $customer_functions;
    }


    /**
     * @cc 获取函数的注释
     *
     * @param $module Home
     * @param $controller Auth
     * @param $action index
     *
     * @return string 注释
     *
     */



    protected function getClassDesc($module,$controller){
        $class = $module.'\Controller\\'.$controller.'Controller';
        $t = new \ReflectionClass( new $class());
        $tmp = $t->getDocComment();
        preg_match_all('/@desc(.*?)\n/si',$tmp,$tmp);
        $tmp   = trim($tmp[1][0]);
        $tmp   = $tmp !='' ? $tmp:'';
        return $tmp;
    }

    protected function get_cc_desc($module,$controller,$action){

        $desc=$module.'\Controller\\'.$controller.'Controller';
        $func  = new \ReflectionMethod(new $desc(),$action);
        $content   = $func->getDocComment();


        preg_match_all('/@desc(.*?)\n/si',$content,$tmp);
        $desc   = trim($tmp[1][0]);
        $desc   = $desc !='' ? $desc:'';

        unset($tmp);

        preg_match_all('/@isMenu(.*?)\n/si',$content,$tmp);
        $ismenu   = trim($tmp[1][0]);
        $ismenu   = $ismenu !='' ? $ismenu:'0';

        return array('desc'=>$desc,'ismenu'=>$ismenu);
    }

    protected function getIsMenu($module,$controller,$action){

            $desc=$module.'\Controller\\'.$controller.'Controller';
            $func  = new \ReflectionMethod(new $desc(),$action);
            $tmp   = $func->getDocComment();
            preg_match_all('/@isMenu(.*?)\n/si',$tmp,$tmp);
            $tmp   = trim($tmp[1][0]);
            $tmp   = $tmp !='' ? $tmp:'0';

            return $tmp;

    }

    public function __getNodes(){
        $db = D('Nodes');
        $ret = $db->select();
        for($i=0;$i<count($ret);$i++){
            if($ret[$i]['rootid'] === '0'){
                $data[$ret[$i]['controller']]['Desc'] = $ret[$i]['controller_name'];
                $data[$ret[$i]['controller']]['Method'] = array();
            }else{
                $data[$ret[$i]['controller']]['Method'][] = array(
                    'id'=>$ret[$i]['id'],
                    'Name'=>$ret[$i]['method'],
                    'Desc'=>$ret[$i]['method_name'],
                    'ismenu'=>$ret[$i]['ismenu']
                );
            }
        }

        return $data;
    }
}