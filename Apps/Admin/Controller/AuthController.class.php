<?php
namespace Admin\Controller;
use Think\Controller;
class AuthController extends Controller {
    function __auth(){
        if(!session('username')){
            $this->redirect('/Login', '', 0, '请重新登陆');
        }
    }

    function __checkPrivileges(){
        if(session('username')!='admin!@!@'){
            $db = D('Nodes');
            $condition = array(
                'controller'=>CONTROLLER_NAME,
                'method'=>ACTION_NAME
            );
            if(strtolower(CONTROLLER_NAME)!='index'&&strtolower(ACTION_NAME)!='noprivileges' && !$ret = $db->where($condition)->find()){//如果访问的controller和action并不存在
               $this->redirect('/Index/__NoPrivileges');
            }

            $currentNodesId = $ret['id'];
            $db = D("GroupsNodes");
            $condition = array(
                'group_id'=> session('group_id'),
                'nodes_id'=>$currentNodesId
            );
//print_r($condition);exit;
            if(strtolower(CONTROLLER_NAME)!='index'&&strtolower(ACTION_NAME)!='noprivileges' && strtolower(ACTION_NAME) != 'flushprivileges'&& !$db->where($condition)->find()){
                $this->redirect('/Index/__NoPrivileges');
            }
        }
    }


}