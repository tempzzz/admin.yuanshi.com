<?php
namespace Admin\Controller;
use Admin\Model\UsersModel;
use Org\Net\Http;
use Think\Controller;
use Org\Kcaptcha\Kcaptcha;

/**
 * Class LoginController
 * @desc 登陆相关
 */
class LoginController extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        $this->assign('to',$_SERVER['HTTP_REFERER']);
        $this->assign('loginURL',U('Login/auth'));
        $this->display();
    }

    /*
     * @desc 验证用户登陆
     */
    public function auth(){

        $data['username'] = I('post.username');
        $data['password'] = md5(I('post.password'));
        $data['verifycode'] = I('post.verifycode');


        if(session('verifycode') != $data['verifycode']){
            $success['accessGranted'] = -1;
        }else{
            session('verifycode',null);
            $User = D('Users');

            if($ret = $User->where($data)->find()){
                session('username',$data['username']);
                session('uid', $ret['id']);
                session('group_id',$ret['group_id']);
                $success['accessGranted'] = 'success';
                $User->where('id ='.$ret['id'])->save(array('last_ip'=>get_client_ip(),'last_time'=>$_SERVER["REQUEST_TIME"]));

                $_SESSION['menu'] = $this->__getMenuByUser($ret['group_id']);
                LogController::__write();
            }else{
                $success['accessGranted'] = -2;
            }
        }

        $this->ajaxReturn($success,'JSON');
    }

     public function __getMenuByUser($group_id){
        $db = D('GroupsNodes');
        $ret = $db->where(array('group_id'=>$group_id))->select();

        $db = D('Nodes');
        $nret = $db->select();

        $data = array();
        for($i=0;$i<count($ret);$i++){
            for($j=0;$j<count($nret);$j++){
                if($nret[$j]['controller_name'])
                    $data[$nret[$j]['controller']]['name'] = $nret[$j]['controller_name'];
                if($ret[$i]['nodes_id'] == $nret[$j]['id']){
                    $data[$nret[$j]['controller']]['nodes'][$nret[$j]['method']] = $nret[$j];
                }
            }
        }

        foreach($data as $k => $v){
            if(!isset($v['nodes'])||empty($v['nodes']))
                unset($data[$k]);
        }

        return $data;
    }


    public function logout(){
        session_destroy();
        $this->redirect('/Login', '', 0, '请重新登陆');
    }

    public function verify(){
        $captcha = new KCAPTCHA();
        ob_start();

        $captcha->getCode();
        $value   = $captcha->getKeyString();
        session('verifycode',$value);
    }

}