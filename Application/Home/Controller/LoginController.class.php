<?php  
namespace Home\Controller;
use Think\Verify;

class LoginController extends CommonController
{
	public function index()
	{
		if(!session('?user_auth'))
		{
			$this->display();
		}else
		{
			$this->redirect('Index/index');
		}

	}

	public function verify()
	{
		$verify = new Verify();
		$verify->length=1;
		$verify->reset=false;
		$verify->entry(1);
	}
}