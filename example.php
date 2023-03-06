<?php

use Casbin\Enforcer;

ini_set('display_errors', 'on');
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

$e = new Enforcer('to/model.conf', 'to/policy.csv');

// 模拟访问
$sub = 'alice';
$obj = 'data1';
$act = 'read';

if ($e->enforce($sub, $obj, $act) === true) {
    echo '允许 alice 读取 data1';
} else {
    echo '拒绝请求...';
}

