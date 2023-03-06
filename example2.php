<?php

use Casbin\Enforcer;
use CasbinAdapter\Database\Adapter;

ini_set('display_errors', 'on');
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

$adapter = Adapter::newAdapter([
    'type' => 'mysql',
    'hostname' => '127.0.0.1',
    'database' => 'casbin_test',
    'username' => 'root',
    'password' => 'root'
]);
$e = new Enforcer('to/model2.conf', $adapter);

/*// 分配角色
$e->addRoleForUser('wuwenhao', 'admin');
$e->addRoleForUser('guest', 'member');

// 角色分配权限
$e->addPermissionForUser('member', '/foo', 'GET');
$e->addPermissionForUser('member', '/foo/:id', 'GET');

$e->addRoleForUser('admin', 'member');
$e->addPermissionForUser('admin', '/foo', 'POST');
$e->addPermissionForUser('admin', '/foo/:id', 'PUT');
$e->addPermissionForUser('admin', '/foo/:id', 'DELETE');*/

/*
 * request_definition

[request_definition]

r = sub, obj, act

这是请求定义, 也就是在问casbin的时候, 请求应该具有的格式.

sub: subject, obj: object, act: action.

也就是在问: “谁(sub)对什么东西(obj)能做什么(act)?”

policy_definition

策略定义, 也就是你要将权限以什么格式来存储, 最直观的, 也就是和请求格式一样.

比如我们有一条策略:

p = om, cat, play

这条策略就表示tom对cat可以play, 也就是tom可以play cat.

[role_definition]

当然这只是权限定义, 具体有没有权限还要看

[role_definition]

g = _, _

g2 = _, _

开始看到这个真是很迷茫, 这什么玩意啊…

后来才明白, 其实这就是分组, 或者说定义从属关系.

当然这里的g专门用来划分角色, 如: g = tom, admin就可以表示tom的角色是admin.

而g2, g3, …, 完全可以自定义分组, 比如 g2 = 北京, 中国 就表示北京属于中国这样一个关系.

这个g, g2的也叫grouping policy, 可以说是分组策略(代码里有这个词, 比较贴切).

[policy_effect]

e = some(where (p.eft == allow))

这个就是说在判断权限时的结果有"allow"的, 就认为有权限, 否则没有权限.

至于如何判断权限, 就要看matchers了.

[matchers]

m = g(r.sub, p.sub) && g2(r.obj, p.obj) && r.act == p.act

这个matchers是什么东西呢? 你看它有r.xxx, p.xxx, 这r, p不就是上面定义的吗?

还有g, g2这些, 也是上面定义的.

单就刚才这个matcher来说, 我们自己想也大概能猜出来:

请求是: r = sub, obj, act,

我们存储的是: p = sub, obj, act,

判断权限时就看

r.sub是不是属于p.sub分组(r.sub有没有p.sub这个角色)

并且 r.obj是不是属于p.obj这个组的(资源分组)

并且r.act和p.act是不是一样(如都是GET)
 */

// 验证权限
$ret = $e->enforce('wuwenhao', '/foo', 'GET');
var_dump($ret);
$ret = $e->enforce('wuwenhao', '/foo/1', 'GET');
var_dump($ret);

echo "\n\r";
$ret = $e->enforce('guest', '/foo', 'GET');
var_dump($ret);
$ret = $e->enforce('guest', '/foo', 'POST');
var_dump($ret);


var_dump(123);


