<?php  

namespace Home\Controller;

class UserController extends CommonController
{
	/**
	 * 注册
	 */
	public function register()
	{
		if(IS_AJAX)
		{
			$user = D('User');
			$uid = $user->register(I('post.username'),I('post.password'),I('post.repassword'),I('post.email'));
		}else
		{
			$this->error('非法访问');
		}

 	}

	/**
	 * 登录
	 */
	public function login()
	{
		if(IS_AJAX)
		{
			$user = D('User');
			$uid = $user->login(I('post.username'),I('post.password'),I('post.auto'));
		}else
		{
			$this->error('非法访问');
		}

	}

	/**
	 * 验证用户名是否存在
	 */
	public function checkUsername()
	{
		if(IS_AJAX)
		{
			$user = D('User');
			$uid = $user->checkField(I('post.username'),'username');
			echo $uid > 0 ? 'true' : 'false';
		}else
		{
			$this->error('非法访问');
		}
	}

	/**
	 * 验证邮箱是否被注册
	 */
	public function checkEmail()
	{
		if(IS_AJAX)
		{
			$user = D('User');
			$uid = $user->checkField(I('post.email'),'email');
			echo $uid > 0 ? 'true' : 'false';
		}else
		{
			$this->error('非法访问');
		}
	}

	/**
	 * 验证验证码
	 */
	public function checkVerify()
	{
		if(IS_AJAX)
		{
			$user = D('User');
			$uid = $user->checkField(I('post.verify'),'verify');
			echo $uid > 0 ? 'true' : 'false';
		}else
		{
			$this->error('非法访问');
		}
	}

	/**
	 * 退出
	 */
	public function logout()
	{
		//清除session
		session(null);
		//清除cookie
		cookie('auto',null);
		//跳转
		$this->success('退出成功！',U('Login/index'));
	}

}