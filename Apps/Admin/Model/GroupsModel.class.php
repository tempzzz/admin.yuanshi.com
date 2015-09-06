<?php
namespace Admin\Model;
use Think\Model;

class GroupsModel extends BaseModel
{
    protected $tableName = 'admin_group';
    public function __construct()
    {
        parent::__construct();
    }
}