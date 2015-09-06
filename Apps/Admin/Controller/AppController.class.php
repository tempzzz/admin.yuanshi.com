<?php
namespace Admin\Controller;
use Admin\Model\AppsModel;
use Think\Controller;
use Think\Page;
/**
 * @desc App管理
 */
class AppController extends BaseController {

    public function __construct(){
        parent::__construct();
    }

    /**
     * @isMenu  1
     * @desc 返利管理
     */
    public function index(){
        $db = D('Apps');


        $where = array();

        if($_GET['appname']){
            $where = array(
                'appname'=>array(
                    'like',I('get.appname')
                )
            );
        }

        $count      = $db->where($where)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->showHTML();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $data = $db->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();



        for($i=0;$i<count($data);$i++){
            $rate = '';
            $arr = json_decode($data[$i]['pay_rate_single'],true);


            for($j=0;$j<count($arr);$j++){
                $rate .= $arr[$j][0].'~'.$arr[$j][1]."=>".$arr[$j][2]."，";
            }

            $data[$i]['rate'] = $rate;
        }

        $this->assign('data',$data);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * @isMenu 0
     * @desc 添加一个app（模板）
     */
    public function add_form(){
        $this->display();
    }

    /**
     * @ismenu 0
     * @desc 获取app信息(ajax查询)
     */
    public function getappinfo(){
        $data['appkey'] = I('post.appkey');

        if(!preg_match('/^\w+$/i',$data['appkey']))
            $data['appkey'] = '';

        $db = D('Apps');

        if($rs = $db->where($data)->find()){
            $ret['success'] = false;
        }else{
            $ret = $db->table($db::TABLE_CP)->where($data)->find();
            $ret['success'] = true;
        }

        $this->ajaxReturn($ret);
    }

    /**
     * @ismenu 0
     * @desc 添加app(提交)
     */
    public function add(){
        LogController::__write();

        $low = I('post.low');
        $high = I('post.high');
        $bonus = I('post.bonus');
        $days = I('post.days');

        $data['appkey'] = I('post.appkey');
        $data['appname'] = I('post.appname');
        $data['appid'] = I('post.appid');

//        print_r($low);print_r($high);print_r($bonus);

        $single = array();
        for($i=0;$i<count($low);$i++){

            $low[$i] = abs(intval($low[$i]));
            $high[$i] = abs(intval($high[$i]));
            $bonus[$i] = abs(intval($bonus[$i]));
            $days[$i] = abs(intval($days[$i]));

            if($low[$i] == 0 || $high[$i] == 0 || $bonus[$i] == 0 ||
                $low[$i] > $high[$i] ||
                $bonus[$i] >= ($high[$i] / 2)
            )
            {
                $low[$i] = $high[$i] = $bonus[$i] = $days[$i] = 0;
            }

            $single[$i] = array(
                $low[$i],
                $high[$i],
                $bonus[$i],
                $days[$i]
            );
        }

        $db = D('Apps');
//        C('TOKEN_ON',false);
        $data['pay_rate_single'] = json_encode($single);
        if ($db->autoCheckToken($_POST)){
            $db->add($data);
            $success['code'] = 'success';
            $success['text'] = '数据添加成功';
        }else{
            $success['code'] = 'error';
            $success['text'] = '非法提交，请刷新页面后再试';
        }

//        print_r($_SESSION['token']);
        session('notice',$success);
//        print_r($success);exit;
        $this->redirect('/App/');

    }



    /**
     * @isMenu 0
     * @desc 编辑app（模板）
     */
    public function edit_form(){
        $db = D('Apps');
        $id = intval(I('get.id'));
        $data = $db->where(array('id'=>$id))->find();
        $rates = json_decode($data['pay_rate_single']);
        $this->assign('rates',$rates);
        $this->assign('data',$data);
        $this->display();
    }


    /**
     * @isMenu 0
     * @desc 编辑app（提交）
     */
    public function edit(){
        LogController::__write();

        $low = I('post.low');
        $high = I('post.high');
        $bonus = I('post.bonus');
        $days = I('post.days');

        $data['id'] = intval(I('post.id'));
        $data['appkey'] = I('post.appkey');
        $data['appname'] = I('post.appname');
        $data['appid'] = I('post.appid');

//        print_r($low);print_r($high);print_r($bonus);

        $single = array();
        for($i=0;$i<count($low);$i++){

            $low[$i] = abs(intval($low[$i]));
            $high[$i] = abs(intval($high[$i]));
            $bonus[$i] = abs(intval($bonus[$i]));
            $days[$i] = abs(intval($days[$i]));

            if($low[$i] == 0 || $high[$i] == 0 || $bonus[$i] == 0 ||
                $low[$i] > $high[$i] ||
                $bonus[$i] >= ($high[$i] / 2)
            )
            {
                $low[$i] = $high[$i] = $bonus[$i] = $days[$i] = 0;
            }

            $single[$i] = array(
                $low[$i],
                $high[$i],
                $bonus[$i],
                $days[$i]
            );
        }

        $db = D('Apps');
//        C('TOKEN_ON',false);
        $data['pay_rate_single'] = json_encode($single);
        if ($db->autoCheckToken($_POST)){
            $db->save($data);
            $success['code'] = 'success';
            $success['text'] = '数据修改成功';
        }else{
            $success['code'] = 'error';
            $success['text'] = '非法提交，请刷新页面后再试';
        }

//        print_r($_SESSION['token']);
        session('notice',$success);
//        print_r($success);exit;
//        exit();
        $this->redirect('/App/');
    }

    /**
     * @isMenu 0
     * @desc 删除app（提交）
     */
    public function del(){
        LogController::__write();
        $db = D('Apps');
        $id = intval(I('get.id'));
        $db->delete($id);
        $success['code'] = 'success';
        $success['text'] = '数据删除成功';
        session('notice',$success);
        $this->redirect('/App/');
    }


    /**
     * @isMenu 1
     * @desc 支付渠道管理
     */
    public function payment(){
        $db = D('Apps');


        $where = array();

        if($_GET['appname']){
            $where = array(
                'appname'=>array(
                    'like',I('get.appname')
                )
            );
        }

        $count      = $db->table(AppsModel::TABLE_PAYMENT_TYPE)->where($where)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->showHTML();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $data = $db->table(AppsModel::TABLE_PAYMENT_TYPE)->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('data',$data);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * @isMenu 0
     * @desc 添加一个app支付方式（模板）
     */
    public function payment_add_form(){
        $this->display();
    }


    /**
     * @ismenu 0
     * @desc 添加app支付方式(提交)
     */
    public function payment_add(){
        LogController::__write();
        $db = D('Apps');
        $data['appid'] = I('post.appid',0,'int');
        $data['appkey'] = I('post.appkey','','/^[A-Za-z0-9]+$/');
        $data['appname'] = I('post.appname');
        $data['type'] = array();
        $type = I('post.payments');

        if ($db->autoCheckToken($_POST)){

            $menus = C('PAYMENT_TYPE');

            foreach($menus as $k =>$v){
                $data['type'][$k] = 0;
            }

            for($i=0;$i<count($type);$i++){
                $data['type'][$type[$i]] = 1;
            }
            $data['type'] = json_encode($data['type']);


            $sql = "insert into ".AppsModel::TABLE_PAYMENT_TYPE." set appid = '%d',
            appkey = '%s' ,
            appname = '%s' ,
            type = '%s'";

            $db->execute($sql,$data);
            $success['code'] = 'success';
            $success['text'] = '数据添加成功';
//            echo $db->_sql();
        }else{
            $success['code'] = 'error';
            $success['text'] = '非法提交，请刷新页面后再试';
        }


        session('notice',$success);
        $this->redirect('/App/payment');
    }
    /**
     * @isMenu 0
     * @desc 编辑app支付方式（模板）
     */
    public function payment_edit_form(){
        $db = D('Apps');
        $id = intval(I('get.id'));
        $data = $db->table(AppsModel::TABLE_PAYMENT_TYPE)->where(array('id'=>$id))->find();
        echo $db->_sql();
        $this->assign('data',$data);
        $this->display();
    }


    /**
     * @isMenu 0
     * @desc 编辑app支付方式（提交）
     */
    public function payment_edit(){
        LogController::__write();
        $db = D('Apps');

        $data['appid'] = I('post.appid',0,'int');
        $data['appkey'] = I('post.appkey','','/^[A-Za-z0-9]+$/');
        $data['appname'] = I('post.appname');
        $data['type'] = array();
        $type = I('post.payments');
        $data['id'] = I('post.id',0,'int');

        if ($db->autoCheckToken($_POST)){
            $menus = C('PAYMENT_TYPE');

            foreach($menus as $k =>$v){
                $data['type'][$k] = 0;
            }

            for($i=0;$i<count($type);$i++){
                $data['type'][$type[$i]] = 1;
            }
            $data['type'] = json_encode($data['type']);

            $sql = "update ".AppsModel::TABLE_PAYMENT_TYPE." set appid = '%d',
            appkey = '%s' ,
            appname = '%s' ,
            type = '%s'
            where id = %d ";

            $db->execute($sql,$data);
            $success['code'] = 'success';
            $success['text'] = '数据修改成功';
//            echo $db->_sql();
        }else{
            $success['code'] = 'error';
            $success['text'] = '非法提交，请刷新页面后再试';
        }


        session('notice',$success);
        $this->redirect('/App/payment');
    }

    /**
     * @isMenu 0
     * @desc 删除app支付方式（提交）
     */
    public function payment_del(){
        LogController::__write();
        $db = D('Apps');
        $id = intval(I('get.id'));
        $db->table(AppsModel::TABLE_PAYMENT_TYPE)->delete($id);
        $success['code'] = 'success';
        $success['text'] = '数据删除成功';
        session('notice',$success);
        $this->redirect('/App/payment');
    }

    /**
     * @ismenu 0
     * @desc 获取app支付渠道信息(ajax查询)
     */
    public function payment_getappinfo(){
        $data['appkey'] = I('post.appkey');

        if(!preg_match('/^\w+$/i',$data['appkey']))
            $data['appkey'] = '';

        $db = D('Apps');

        if($rs = $db->table(AppsModel::TABLE_PAYMENT_TYPE)->where($data)->find()){
            $ret['success'] = false;
        }else{
            $ret = $db->table($db::TABLE_CP)->where($data)->find();
            $ret['success'] = true;
        }

        $this->ajaxReturn($ret);
    }
}