<?php
namespace Home\Controller;
class TopicController extends CommonController
{
    /**
     * 发布微博
     */
    public function publish()
    {
        if(IS_AJAX)
        {
            $topic = D('Topic');
            $topicid= $topic->publish(I('post.content'),session('user_auth')['id']);
            echo $topicid;
        }else
        {
            $this->error('非法访问');
        }
    }

    /**
     * 拖动加载更多
     */
    public function ajaxList()
    {
        if (IS_AJAX)
        {
            $Topic = D('Topic');
            $ajaxList = $Topic->getList(I('post.first'),10);
            $this->assign('ajaxList', $ajaxList);
            $this->display();
        } else
        {
            $this->error('非法访问！');
        }
    }

    //Ajax获取总页码
    public function ajaxCount()
    {
        if (IS_AJAX)
        {
            $Topic = D('Topic');
            $count = $Topic->where('1=1')->count();
            echo ceil($count / 10);
        } else
        {
            $this->error('非法访问！');
        }
    }
}