<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller 
{
	public function __construct()
	{
        header("Content-type:text/html;charset=utf8");
		parent::__construct();
        $auth = A('Auth');
        $auth->__auth();
        $auth->__checkPrivileges();
	}

}