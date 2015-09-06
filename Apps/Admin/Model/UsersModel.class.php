<?php
namespace Admin\Model;
use Think\Model;

class UsersModel extends BaseModel
{
    protected $tableName = 'admin_user';
    public function __construct()
    {
        parent::__construct();
    }
}