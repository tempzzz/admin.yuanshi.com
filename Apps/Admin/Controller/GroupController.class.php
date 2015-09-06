<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * @desc 用户组管理
 */
class GroupController extends BaseController {

    public function __construct(){
        parent::__construct();
    }



    /**
     * @isMenu 0
     * @desc 添加用户组（模板）
     */
    public function add_form(){
        $o = A("FlushNodes");
        $data = $o->__getNodes();
        $this->assign('data',$data);
        $this->display();
    }

    /**
     * @isMenu 0
     * @desc 添加用户组（提交）
     */

    public function add(){
        LogController::__write();
        $childMenu = I('post.ChildMenu');
        $data['name'] = I('post.name');
        $data['desc'] = I('post.desc');
        if(trim($data['name'])=='') $this->redirect('/Group/');
        $db = D('Groups');
        if($ret = $db->where("name = '%s'",array($data['name']))->find()){
            $success['code'] = 'error';
            $success['text'] = '该分组已经存在';
            session('notice',$success);
            $this->redirect('/Group/add_form');
        }else{
            $gid = $db->data($data)->add($data);

            $db = D('GroupsNodes');
            for($i=0;$i<count($childMenu);$i++){
                $db->add(array('group_id'=>$gid,'nodes_id'=>$childMenu[$i]));
            }
            $success['code'] = 'success';
            $success['text'] = '分组添加成功';
            session('notice',$success);
            $this->redirect('/Index/group');
        }

    }

    /**
     * @isMenu 0
     * @desc 编辑用户组(模板)
     */

    public function edit_form(){
        $id = intval(I('get.id'));
        $db = D('Groups');
        $groups = $db->find($id);



        $c = new FlushNodesController();
        $data = $c->__getNodes();

        $db = D('GroupsNodes');
        $gNodes = $db->where(array('group_id'=>$id))->field('nodes_id')->select();
        for($i=0;$i<count($gNodes);$i++){
            $groups_nodes[] = $gNodes[$i]['nodes_id'];
        }
//        print_r($groups_nodes);
        $this->assign('groups_nodes',$groups_nodes); //组合节点的关系
        $this->assign('data',$data);//所有节点
        $this->assign('groups',$groups);//当前组信息
        $this->display();
    }

    /**
     * @isMenu 0
     * @desc 编辑用户组(提交)
     */
    public function edit(){
        LogController::__write();
        $childMenu = I('post.ChildMenu');
        $data['id'] = intval(I('post.id'));
        $data['name'] = I('post.name');
        $data['desc'] = I('post.desc');
        if(trim($data['name'])=='') $this->redirect('/Index/group');
        $db = D('Groups');

        $gid = $db->save($data);

        $db = D('GroupsNodes');
        $db->where(array('group_id'=>$data['id']))->delete();

        for($i=0;$i<count($childMenu);$i++){
            $db->add(array('group_id'=>$data['id'],'nodes_id'=>intval($childMenu[$i])));
        }

        $success['code'] = 'success';
        $success['text'] = '分组修改成功';

        $login = A('Login');
        $_SESSION['menu'] = $login->__getMenuByUser(session('group_id'));
        session('notice',$success);
        $this->redirect('/');



    }
    /**
     * @isMenu 0
     * @desc 删除用户组
     */

    public function del(){
        LogController::__write();
        $db = D('Groups');
        $data['id'] = intval(I('get.id'));
        $db->where($data)->delete();
        $db = D('GroupsNodes');
        $db->where(array('group_id'=>$data['id']))->delete();
        $success['code'] = 'success';
        $success['text'] = '删除成功';
        session('notice',$success);
        $this->redirect('/Index/group');
    }
}