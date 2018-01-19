<?php
return array(
	//'配置项'=>'配置值'
	'TMPL_PARSE_STRING' => array(
		'__JS__' => __ROOT__.'/Public/'.MODULE_NAME.'/js',
		'__CSS__' => __ROOT__.'/Public/'.MODULE_NAME.'/css',
		'__IMG__' => __ROOT__.'/Public/'.MODULE_NAME.'/img',
		'__UPLOADIFY__' =>__ROOT__.'/Public/'.MODULE_NAME.'/uploadify',
		'__ROOTZK__' => $_SERVER['HTTP_HOST'],
	),
	//页面trace
	'SHOW_PAGE_TRACE'=> false,
	//页面跳转
	'TMPL_ACTION_ERROR' => 'Public/jump',
	'TMPL_ACTION_SUCCESS' => 'Public/jump',
	//图片上传路径
	'UPLOAD_PATH'=>'./Uploads/',
	//头像上传路径
	'FACE_PATH'=>'./Uploads/face/',


	
);