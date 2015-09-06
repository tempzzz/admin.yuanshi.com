<?php
namespace Admin\Model;
use Think\Model;
class BaseModel extends Model
{
    function __construct($model='',$prefix='',$conn='')
    {
        parent::__construct($model,$prefix,$conn);
    }
}