<?php
namespace Admin\Model;
use Think\Model;

class OrdersModel extends BaseModel{
    protected  $tableName = 'mzw_sdk_pay_orders';


    public function __construct()
    {
        parent::__construct();
    }

    public function getFieldName(){
        return array(
            'id'=>'id',
            'uid'=>'uid',
            'username'=>'用户名',
            'deviceid'=>'设备ID',
            'appkey'=>'appkey',
            'order_no'=>'订单号',
            'extern'=>'厂商扩展',
            'ip'=>'IP',
            'time'=>'时间',
            'total_fee'=>'充值金额',
            'game_total_fee'=>'支付金额',
            'bouns'=>'临时字段',
            'subject'=>'商品名称',
            'productdesc'=>'商品描述',
            'productid'=>'产品ID',
            'channel'=>'渠道',
            'payment_type'=>'支付类型',
            'trade_status'=>'支付状态'
        );
    }

    public function getPaymentType(){
        return array(
            0=>'未知方式',
            1=>'支付宝客户端',
            2=>'支付宝wap',
            3=>'易宝信用卡',
            4=>'易宝信用卡快捷支付',
            5=>'易宝点卡',
            6=>'银联客户端',
            7=>'易宝储蓄卡',
            8=>'易宝储蓄卡快捷支付',
            9=>'拇指币支付',
            10=>'财付通支付'
        );

    }

    public function getCardErrorCode($code){

        switch( $code ){

            case '0' :

                $val['p8_cardStatus'] = '充值成功';
                break;

            case '1' :

                $val['p8_cardStatus'] = '销卡成功，订单失败';
                break;

            case '7' :

                $val['p8_cardStatus'] = '卡号或密码输入错误请重试';
                break;

            case '1002' :

                $val['p8_cardStatus'] = '本张卡密您提交过于频繁，请您稍后再试';
                break;

            case '1003' :

                $val['p8_cardStatus'] = '不支持的卡类型（比如电信地方卡）';
                break;

            case '1004' :

                $val['p8_cardStatus'] = '密码错误或充值卡无效';
                break;

            case '1006' :

                $val['p8_cardStatus'] = '充值卡无效或已过期';
                break;

            case '1007' :

                $val['p8_cardStatus'] = '卡内余额不足请用对应额度的卡充值';
                break;

            case '1008' :

                $val['p8_cardStatus'] = '余额卡过期（有效期1个月）';
                break;

            case '1010' :

                $val['p8_cardStatus'] = '此卡正在处理中';
                break;

            case '10000' :

                $val['p8_cardStatus'] = '未知错误';
                break;

            case '2005' :

                $val['p8_cardStatus'] = '此卡已使用';
                break;

            case '2006' :

                $val['p8_cardStatus'] = '卡密在系统处理中';
                break;

            case '2007' :

                $val['p8_cardStatus'] = '该卡为假卡';
                break;

            case '2008' :

                $val['p8_cardStatus'] = '该卡种正在维护';
                break;

            case null :

                $val['p8_cardStatus'] = '';
                break;

            case '2013' :

                $val['p8_cardStatus'] = '该卡已被锁定';
                break;

            case '2014' :

                $val['p8_cardStatus'] = '网络不稳，请稍后再试';
                break;

            default :

                $val['p8_cardStatus'] = '该卡种正在维护';
                break;

        }

        return $val['p8_cardStatus'];
    }
}
