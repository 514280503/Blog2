<?php

namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller
{
    protected function login()
    {
        //自动登录
        if(!is_null(cookie('auto')) && !session('?user_auth'))
        {
            $username = encryption(cookie('auto'),1);
            $map['username'] = $username;
            $user = D('User');
            $userobj = $user->field('id,username')->where($map)->find();

            //自动登录的时间和ip
            $update=array(
                'id'=>$userobj['id'],
                'last_login'=>NOW_TIME,
                'last_ip'=>get_client_ip(1),
            );

            $user->save($update);
            //session
            $auth=array(
                'id'=>$userobj['id'],
                'username'=>$userobj['username'],
                'last_login'=>NOW_TIME,
            );
            session('user_auth',$auth);

        }
        //是否登录
        if(session('?user_auth'))
        {
            return 1;
        }else
        {
            $this->redirect('Login/index');
        }
    }
}