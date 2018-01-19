<?php
namespace Home\Controller;
class SettingController extends CommonController
{
    public function index()
    {
        if ($this->login())
        {
            $User = D('User');
            $this->assign('user', $User->getUser());
            $this->display();
        }
    }


    //修改资料
    public function updateUser()
    {
        if (IS_AJAX)
        {
            $User = D('User');
            $uid = $User->updateUser(I('post.email'), I('post.intro'));
            echo $uid;
        } else
        {
            $this->error('非法访问！');
        }
    }

    /**
     * 头像设置
     */
    public function avatar()
    {
        if ($this->login())
        {
            $User = D('User');
            $this->assign('bigFace', $User->getFace());
            $this->display();
        }
    }



}