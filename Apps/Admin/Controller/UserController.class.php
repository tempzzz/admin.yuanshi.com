<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * @desc 用户管理
 */
class UserController extends BaseController {

    public function __construct(){
        parent::__construct();
    }



    /**
     * @isMenu 0
     * @desc 添加用户(模板)
     */
    public function add_form(){
        $g = D('Groups');
        $groups = $g->select();
        $this->assign('groups',$groups);
        $this->display();
    }

    /**
     * @isMenu 0
     * @desc 添加用户(提交)
     */
    public function add(){
        LogController::__write();
        $data['username'] = I('post.username');

        $db = D('Users');
        if(!$ret =  $db->where($data)->find()){
            $success['code'] = 'success';
            $success['text'] = '添加用户成功';
            session('notice',$success);
            $data['password'] = md5(I('post.password'));
            $data['group_id'] = intval(I('post.groups'));
            $db->add($data);
        }else{
            $success['code'] = 'error';
            $success['text'] = '该用户已经存在';
        }
        session('notice',$success);
        $this->redirect('/Index/user');
    }
    /**
     * @isMenu 0
     * @desc 编辑用户(模板)
     */

    public function edit_form(){
        $id = intval(I('get.id'));
        $db = D('Users');
        $data = $db->find($id);
        $this->assign('data',$data);

        $g = D('Groups');
        $groups = $g->select();
        $this->assign('groups',$groups);

        $this->display();
    }

    /**
     * @isMenu 0
     * @desc 编辑(提交)
     */
    public function edit(){
        LogController::__write();
        $success['code'] = 'success';
        $success['text'] = '用信息修改成功';
        session('notice',$success);


        $data['id'] = intval(I('post.id'));
        $password = trim(I('post.password'));
        $data['group_id'] = intval(I('post.groups'));

        if($password){
                $data['password'] = md5($password);
        }

        $U = D("Users");
        $U->save($data);
        $this->redirect('/Index/user');
    }

    /**
     * @isMenu 0
     * @desc 删除用户
     */

    public function del(){
        LogController::__write();
        $id = intval(I('get.id'));
        $success['code'] = 'success';
        $success['text'] = '用户成功删除';
        session('notice',$success);
        $db = D('Users');
        $db->where(array('id'=>$id))->delete();
        $this->redirect('/Index/user');
    }

    /**
     * @isMenu 0
     * @desc 修改个人密码(模板)
     */

    public function edit_mypassword_form(){
       $this->display();
    }

    /**
     * @isMenu 0
     * @desc 修改个人密码(提交)
     */

    public function edit_mypassword(){
        LogController::__write();
        $success['code'] = 'success';
        $success['text'] = '密码修改成功';
        session('notice',$success);


        $data['id'] = intval($_SESSION['uid']);
        $password = trim(I('post.password'));

        if($password){
            $data['password'] = md5($password);
            $U = D("Users");
            $U->save($data);
        }


        $this->redirect('/User/edit_mypassword_form');
    }


}