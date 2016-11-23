<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\common\controller;

class User extends Base {

	public function _initialize() {
		parent::_initialize();

		if (!is_login() and !in_array($this->url, array('user/login/index', 'user/index/verify'))) {
			$this->redirect('user/login/index');exit();
		} elseif (is_login()) {
			$user = model('User')->getInfo(session('user_auth.uid'));
			if (!$this->checkProfile($user) && $this->url !== 'user/profile/index') {
				return $this->error('请补充完个人资料！', url('user/profile/index'));
			}
			$this->assign('user', $user);

			//设置会员中心菜单
			$this->setMenu();
		}
	}

	protected function setMenu() {
		$menu['基础设置'] = array(
			array('title' => '个人资料', 'url' => 'user/profile/index', 'icon' => 'newspaper-o'),
			array('title' => '密码修改', 'url' => 'user/profile/editpw', 'icon' => 'key'),
			array('title' => '更换头像', 'url' => 'user/profile/avatar', 'icon' => 'male'),
		);
		$contetnmenu = $this->getContentMenu();
		if (!empty($contetnmenu)) {
			$menu['内容管理'] = $contetnmenu;
		}

		foreach ($menu as $group => $item) {
			foreach ($item as $key => $value) {
				if (url($value['url']) == $_SERVER['REQUEST_URI']) {
					$value['active'] = 'active';
				} else {
					$value['active'] = '';
				}
				$menu[$group][$key] = $value;
			}
		}
		$this->assign('__MENU__', $menu);
	}

	protected function getContentMenu() {
		$list = array();
		$map  = array(
			'is_user_show' => 1,
			'status'       => array('gt', 0),
			'extend'       => array('gt', 0),
		);
		$list = db('Model')->where($map)->field("name,id,title,icon,'' as 'style'")->select();

		foreach ($list as $key => $value) {
			$value['url']   = "user/content/index?model_id=" . $value['id'];
			$value['title'] = $value['title'] . "管理";
			$value['icon']  = $value['icon'] ? $value['icon'] : 'file';
			$list[$key]     = $value;
		}
		return $list;
	}

	protected function checkProfile($user) {
		$result = true;
		//判断用户资料是否填写完整
		if (!$user['nickname'] || !$user['qq']) {
			$result = false;
		}
		return $result;
	}
}
