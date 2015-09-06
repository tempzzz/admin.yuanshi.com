<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;
/**
 * @desc 交易管理
 */
class MemberController extends BaseController {

    Const TABLE_USER_SPEND_EARN = 'mzw_sdk_pay_user_money_spend_earn';
    Const TABLE_CALLBACK_YEEPAY = 'mzw_sdk_pay_callback_yeepay';
    Const TABLE_CALLBACK_YEEPAYCARD = 'mzw_sdk_pay_callback_yeepaycard';
    Const TABLE_ORDERS_INFO = 'mzw_sdk_pay_orders_info';
    Const TABLE_USER_BONUS = 'mzw_sdk_pay_user_bonus';
    Const TABLE_CP_INFO = 'mzw_sdk_pay_notifyrecord';

    public function __construct(){
        parent::__construct();
    }

    /**
     * @isMenu  1
     * @desc 订单查询
     */
    public function orderlist(){
        $db = D('Orders');
        $where = array();


        if(isset($_GET['token'])){
            $db->autoCheckToken($_GET);

            if($_GET['order_no'])
                $where['order_no'] = I('get.order_no');
            if($_GET['uid'])
                $where['uid'] = intval(I('get.uid'));

            if($_GET['trade_status'] && $_GET['trade_status']!=999)
                $where['trade_status'] = intval( I('get.trade_status'));

        }

        $count      = $db->where($where)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,30);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->showHTML();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $data = $db->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();


        $this->assign('data',$data);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('paytype',$db->getPaymentType());
        $this->display(); // 输出模板
    }

    /**
     * @isMenu  0
     * @desc 订单详情
     */

    public function orderview(){
        $id = I('get.id');
        if(preg_match('/^\d+/',$id)){
            $id = intval($id);
            $where = array('id'=>$id);
        }else{
            if(!preg_match('/^\w+$/',$id))
                $id = 0;
            $where = array('order_no'=>$id);
        }

        $db = D('Orders');
        $data = $db->where($where)->find();
//        echo $db->_sql();
        $data['time']  = date("Y-m-d H:i:s",$data['time']);

        if(in_array($data['payment_type'],array(3,4,7,8))){

            $callback = $db->table(self::TABLE_CALLBACK_YEEPAY)->where(array('orderid'=>$data['order_no']))->find();
        }

        if($data['payment_type'] == 5){
            $callback = $db->table(self::TABLE_CALLBACK_YEEPAYCARD)->where(array('p2_Order'=>$data['order_no']))->find();
            $callback['p8_cardstatus'] = $db->getCardErrorCode($callback['p8_cardstatus']);
        }

        $paytype = $db->getPaymentType();
        $data['payment_type'] = $paytype[$data['payment_type']] . '{'.$data['payment_type'].'}';


        $mobile = $db->table(self::TABLE_ORDERS_INFO)->where(array('order_no'=>$data['order_no']))->find();

        $cp = $db->table(self::TABLE_CP_INFO)->where(array('order_no'=>$data['order_no']))->find();


        $this->assign('data',$data);// 赋值数据集
        $this->assign('callback',$callback);// 赋值数据集
        $this->assign('mobile',$mobile);
        $this->assign('cp',$cp);

        $this->assign('field',$db->getFieldName());// 赋值分页输出
        $this->display(); // 输出模板
    }

    /**
     * @isMenu  1
     * @desc 用户代币查询
     */

    public function money(){
        $db = D('Moneys');
        $where = array();


        if(isset($_GET['token'])){
            $db->autoCheckToken($_GET);


            if($_GET['uid'])
                $where['uid'] = intval(I('get.uid'));

        }

        $count      = $db->where($where)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,30);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->showHTML();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $data = $db->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();


        $this->assign('data',$data);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    /**
     * @isMenu  0
     * @desc 用户流水详情
     */

    public function moneyview(){
        $db = D('Moneys');
        $where['uid'] = intval(I('get.uid'));
        $count      = $db->table(self::TABLE_USER_SPEND_EARN)->where($where)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,30);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->showHTML();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $data = $db->table(self::TABLE_USER_SPEND_EARN)->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

//        echo $db->_sql();

        $this->assign('data',$data);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    /**
     * @isMenu 0
     * @desc 用户点劵详情
     */
    public function bonusview(){
        $db = D('Moneys');
        $where['uid'] = intval(I('get.uid'));
        $count      = $db->table(self::TABLE_USER_BONUS)->where($where)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,30);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->showHTML();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $data = $db->table(self::TABLE_USER_BONUS)->where($where)->order('etime asc')->limit($Page->firstRow.','.$Page->listRows)->select();

        echo $db->_sql();

        $this->assign('data',$data);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }
}