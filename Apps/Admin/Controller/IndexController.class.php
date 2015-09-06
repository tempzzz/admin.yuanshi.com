<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;
/**
 * @desc 后台管理
 */
class IndexController extends BaseController {

    public function __construct(){
        parent::__construct();
    }

    /**
     * @isMenu  1
     * @desc 后台首页
     */
    public function index(){
        $this->display();
    }

    /**
     * @isMenu  1
     * @desc 用户组管理
     */
    public function group(){
        $db = D('Groups');
        $data = $db->select();
        $this->assign('data',$data);
        $this->display();
    }


    /**
     * @isMenu  1
     * @desc 用户管理
     */
    public function user(){
        $db = D('Users');
        $data = $db->select();
        $this->assign('data',$data);

        $g = D('Groups');
        $gdata = $g->select();
        for($i=0;$i<count($gdata);$i++){
            $groups[$gdata[$i]['id']] = $gdata[$i]['name'];
        }

        $this->assign('groups',$groups);
        $this->display();
    }

    /**
     * @isMenu 1
     * @desc 浏览节点
     */
    public function nodes(){
        $o = A("FlushNodes");
        $data = $o->__getNodes();
        $this->assign('data',$data);
        $this->display();
    }

    /**
     * @isMenu  1
     * @desc 浏览所有日志
     */
    public function logview(){
        $db = D('Logs');
        $count      = $db->count();// 查询满足要求的总记录数
        $Page       = new Page($count,50);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->showHTML();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $data = $db->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $User = D('Users');
        $ret = $User->select();
        for($i=0;$i<count($ret);$i++){
            $user[$ret[$i]['id']] = $ret[$i]['username'];
        }

        for($i=0;$i<count($data);$i++){
            $data[$i]['username'] = $user[$data[$i]['uid']];
        }

        $this->assign('user',$user);// 赋值数据集
        $this->assign('data',$data);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板

    }


    public function __NoPrivileges(){
        send_http_status(403);
        $this->display();
    }


}