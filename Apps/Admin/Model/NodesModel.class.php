<?php
namespace Admin\Model;
use Think\Model;

class NodesModel extends BaseModel{
    protected  $tableName = 'admin_nodes';
    public function __construct()
    {
        parent::__construct();
    }
}
