<?php

use Casbin\Enforcer;
use Casbin\Exceptions\CasbinException;
use CasbinAdapter\Database\Adapter;

ini_set('display_errors', 'on');
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

$adapter = Adapter::newAdapter([
    'type'     => 'mysql',
    'hostname' => '127.0.0.1',
    'database' => 'casbin_test',
    'username' => 'root',
    'password' => 'root'
]);
try {
    $enforcer = new Enforcer('to/simple.conf', $adapter);
} catch (CasbinException $e) {
    die($e->getTraceAsString());
}

// 添加策略
// 给用户分配角色
$enforcer->addRoleForUser('wuwenhao', 'admin');

// 给角色分配权限
// 示例说明：admin为角色、User为控制器、getUserInfos为方法、GET为请求方式
//$enforcer->addPermissionForUser('admin', 'User', 'getUserInfos', 'GET');
//$enforcer->addPermissionForUser('admin', 'User', 'delUserInfos', 'POST');
//$enforcer->addPermissionForUser('admin', 'User', 'changeUserInfos', 'POST');
//$enforcer->addPermissionsForUser('admin',
//    ['Book', 'getBook', 'GET'],
//    ['Chapter', 'getChapter', 'GET'],
//    ['Setting', 'appGlobalConfig', 'GET']
//);

// 验证权限
//$ret = $enforcer->enforce('wuwenhao', 'User', 'getUserInfos', 'GET');
//var_dump($ret);
//
//// 获取所有角色列表
//$ret = $enforcer->getAllRoles();
//var_dump($ret);
//
//// 获取所有访问对象列表
////$ret = $enforcer->getAllSubjects();
//$ret = $enforcer->getAllObjects();
//var_dump($ret);
//
//// 获取所有方法列表
//$ret = $enforcer->getAllActions();
//var_dump($ret);

//$ret = $enforcer->getRolesForUser('wuwenhao');
//$ret = $enforcer->getUsersForRole('admin');
//$ret = $enforcer->getImplicitRolesForUser('wuwenhao');
$ret = $enforcer->getImplicitResourcesForUser('wuwenhao');
var_dump($ret);

//var_dump('ok');


