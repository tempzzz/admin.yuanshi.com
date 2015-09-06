<?php

$menu = include 'menu.php';
$admin = include 'admin.php';

$config =  array(
    'DB_TYPE' => 'mysql',
    'DB_HOST' => '210.73.216.151',
    'DB_NAME' => 'sdk',
    'DB_USER' => 'muzhiwansdk',
    'DB_PWD'  => 'muzhiwantest@#4%',
    'DB_PORT' => '3306',


    'MAX_RATE_NUMS'=>5
);


return array_merge($config,$menu,$admin);