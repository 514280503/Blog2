<?php
namespace Home\Controller;
use Think\Upload;
class FileController extends CommonController
{

	public function upload()
	{
		$Upload = new Upload();
		$Upload->rootPath = C('UPLOAD_PATH');
		$Upload->maxSize = 1048579;
		$info = $Upload->upload();
		if ($info)
		{
			$imgPath = C('UPLOAD_PATH').$info['Filedata']['savepath'].$info['Filedata']['savename'];
			$image = new Image();
			$image->open($imgPath);
			$thumbPath = C('UPLOAD_PATH').$info['Filedata']['savepath'].'180_'.$info['Filedata']['savename'];
			$image->thumb(180, 180)->save($thumbPath);
			echo $thumbPath;
		} else
		{
			echo $Upload->getError();
		}
	}

	//图片上传
	public function image() {
		$File = D('File');
		$this->ajaxReturn($File->image());
	}
	
	//头像上传
	public function face()
	{
		$File = D('File');
		$this->ajaxReturn($File->face());
	}

	//保存头像
	public function crop()
	{
		$File = D('File');
		$img = $File->crop(I('post.url'), I('post.x'),I('post.y'),I('post.w'),I('post.h'));

		$User = D('User');
		$User->updateFace(json_encode($img));
		echo json_encode($img);
	}
}