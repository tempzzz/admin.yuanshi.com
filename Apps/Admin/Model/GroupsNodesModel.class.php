<?php
namespace Admin\Model;
use Think\Model;

class GroupsNodesModel extends BaseModel
{
    protected $tableName = 'admin_group_nodes';
    public function __construct()
    {
        parent::__construct();
    }
}