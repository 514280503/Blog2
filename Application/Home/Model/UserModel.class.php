<?php 

namespace Home\Model;
use Think\Model;

class UserModel extends Model\RelationModel
{
	//批量验证
	//protected $patchValidate = true;
	/**自动验证
	 * @var array
	 */
	protected $_validate = array(
		//用户名不小于两位或者大于20位 -1
		array('username','2,20',-1,self::EXISTS_VALIDATE,'length'),
		//用户名已注册 -2
		array('username','',-2,self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
		//密码不小于六位 -3
		array('password','6',-3,self::EXISTS_VALIDATE,'length'),
		//密码确认不一致 -4
		array('repassword','password',-4,self::EXISTS_VALIDATE,'confirm'),
		//邮箱格式不正确 -5
		array('email','email',-5,self::EXISTS_VALIDATE),
		//邮箱已注册 -6
		array('email','',-6,self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
		//验证码 -7
		array('verify','check_verify',-7,self::EXISTS_VALIDATE,'function'),
		//-8,登录用户名长度不合法
		array('login_username', '2,50', -8, self::EXISTS_VALIDATE,'length'),
		//noemail,判断登录用户名是否是邮箱
		array('login_username', 'email', 'noemail', self::EXISTS_VALIDATE),
	);

	/**
	 * 验证
	 * @param $field
	 * @param $type
	 * @return int|string
	 */
	public function checkField($field,$type)
	{
		$data=array();
		switch($type)
		{
			case 'username' :
				$data['username']=$field;
				break;
			case 'email' :
				$data['email']=$field;
				break;
			case 'verify' :
				$data['verify']=$field;
				break;
			default :
				return 0;
		}

		return $this->create($data) ? 1 : $this->getError();
	}
	/**自动完成
	 * @var array
	 */
	protected $_auto = array(
		array('password','sha1',self::MODEL_BOTH,'function'),
		array('create','time',self::MODEL_INSERT,'function'),
	);

	/**注册
	 * @param $username
	 * @param $password
	 * @param $email
	 * @return int|mixed
	 */
	public function register($username,$password,$repassword,$email)
	{
		$data = array(
			'username' => $username,
			'password' => $password,
			'repassword' => $repassword,
			'email'    => $email,
		);
		if($this->create($data))
		{
			$uid =$this->add();
			return $uid ? $uid : 0;
		}else
		{
			dump($this->getError());
		}

	}
	//登录
	public function login($username,$password,$auto)
	{
		$data=array(
			'login_username'=>$username,
			'password' => $password,
		);

		$map=array();
		if($this->create($data))
		{
			//邮箱登录
			$map['email']=$username;
		}else
		{
			if($this->getError()=='noemail')
			{
				//账号登录
				$map['username']=$username;
			}else
			{
				return $this->getError();
			}
		}

		$user = $this->field('id,username,password,face')->where($map)->find();
		if($user['password']==sha1($password))
		{
			//最后登录IP 和时间
			$update=array(
				'id'=>$user['id'],
				'last_login'=>NOW_TIME,
				'last_ip'=>get_client_ip(1),
			);
			$this->save($update);

			//将记录写入到cookie和session中去
			$auth = array(
					'id'=>$user['id'],
					'username'=>$user['username'],
					'last_login'=>NOW_TIME,
					'face'=>json_decode($user['face']),
			);

			//写入到session
			session('user_auth', $auth);

			if($auto=='on')
			{
				cookie('auto',encryption($user['username']),3600*24*30);
			}
			echo $user['id'];
		}else
		{
			echo -9;
		}
	}

	//一对一关联用户
	protected $_link = array(
			'extend'=>array(
					'mapping_type'=>self::HAS_ONE,
					'class_name'=>'UserExtend',
					'foreign_key'=>'uid',
					'mapping_fields'=>'intro',
			),
	);

	//通过一对一关联获取用户信息
	public function getUser()
	{
		$map['id'] = session('user_auth')['id'];
		$user = $this->relation(true)->field('id,username,email')->where($map)->find();
		if (!is_array($user['extend']))
		{
			$UserExtend = M('UserExtend');
			$data = array(
					'uid'=>$map['id'],
			);
			$UserExtend->add($data);
		}
		return $user;
	}

	//通过一对一关联修改用户资料
	public function updateUser($email, $intro)
	{
		$map['id'] = session('user_auth')['id'];
		$data = array(
				'email'=>$email,
				'extend'=>array(
						'intro'=>$intro
				),
		);
		return $this->relation(true)->where($map)->save($data);
	}

	//更新个人头像
	public function updateFace($face)
	{
		$data = array(
				'face'=>$face,
		);
		$map['id'] = session('user_auth')['id'];
		return $this->where($map)->save($data);
	}

	//获取个人头像
	public function getFace()
	{
		$map['id'] = session('user_auth')['id'];
		return json_decode($this->field('face')->where($map)->find()['face'])->big;
	}

}