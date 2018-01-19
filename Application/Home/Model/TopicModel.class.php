<?php
namespace Home\Model;
use Think\Model;

class TopicModel extends Model
{
    //验证
    protected $_validate = array(
        //内容长度
        array('allcontent','1,280',-1,self::EXISTS_VALIDATE,'length'),
    );
    //自动完成
    protected $_auto = array(
        array('create','time',self::MODEL_INSERT,'function'),
    );

    /**发布
     * @param $allcontent
     * @param $uid
     * @return int|mixed|string
     */
    public function publish($allcontent,$uid)
    {
        $len = mb_strlen($allcontent,'utf8');
        echo $len;
        $content = $contentOver = '';

        if($len > 255)
        {
            $content = mb_substr($allcontent,0,255,'utf8');
            $contentOver = mb_substr($allcontent,255,25,'utf8');
        }else
        {
            $content=$allcontent;
        }
        $data=array(
            'allcontent'=>$allcontent,
            'content'=>$content,
            'uid'=>$uid,
            'ip'=>get_client_ip(1)
        );

        if(!empty($contentOver))
        {
            $data['content_over']=$contentOver;
        }
        if($this->create($data))
        {
            $uid = $this->add();
            return $uid ? $uid : 0;
        }else
        {
            return $this->getError();
        }
    }

    /**格式化时间
     * @param $list
     * @return mixed
     */
    public function format($list)
    {

        foreach ($list as $key=>$value)
        {
            $list[$key] = $value;
            $time= NOW_TIME - $list[$key]['create'];

            if ($time < 60) {
                $list[$key]['time'] = '刚刚发布';
            } else if ($time < 60 * 60) {
                $list[$key]['time'] = floor($time / 60).'分钟之前';
            } else if (date('Y-m-d') == date('Y-m-d', $list[$key]['create'])) {
                $list[$key]['time'] = '今天'.date('H:i', $list[$key]['create']);
            } else if (date("Y-m-d",strtotime("-1 day")) == date('Y-m-d',$list[$key]['create'])) {
                $list[$key]['time'] = '昨天'.date('H:i', $list[$key]['create']);
            } else if ($time < 60 * 60 * 365) {
                $list[$key]['time'] = date('m月d日 H:i', $list[$key]['create']);
            } else {
                $list[$key]['time'] = date('Y年m月d日 H:i', $list[$key]['create']);
            }

            //头像解析
            $list[$key]['face'] = json_decode($list[$key]['face'])->small;
        }

        return $list;
    }

    public function getList($first, $total)
    {
        return $this->format($this->table('__TOPIC__ a, __USER__ b')
            ->field('a.id,a.content,a.content_over,a.create,b.username,b.face')
            ->limit($first, $total)
            ->order('a.create DESC')
            ->where('a.uid=b.id')
            ->select());
    }
}