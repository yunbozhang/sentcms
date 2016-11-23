<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

return array(
	'__pattern__'     => array(
		'name' => '\w+',
	),

	'/'               => 'index/index/index', // 首页访问路由
	'search'          => 'index/search/index', // 首页访问路由

	'cart/index'      => 'index/cart/index',
	'cart/add'        => 'index/cart/add',
	'cart/count'      => 'index/cart/count',

	'login'           => 'user/login/index',
	'register'        => 'user/login/register',
	'logout'          => 'user/login/logout',
	'uc'              => 'user/index/index',

	'order/index'     => 'user/order/index',
	'order/list'      => 'user/order/lists',

	'admin/login'     => 'admin/index/login',
	'admin/logout'    => 'admin/index/logout',

	// 变量传入index模块的控制器和操作方法
	'addons/:mc/:ac'  => 'index/addons/execute', // 静态地址和动态地址结合
	'usera/:mc/:ac'   => 'user/addons/execute', // 静态地址和动态地址结合
	'admina/:mc/:ac'  => 'admin/addons/execute', // 静态地址和动态地址结合

	'book/list'       => 'index/book/index',
	'book/search'     => 'index/book/search',
	'book/detail/:id' => 'index/book/detail',
);