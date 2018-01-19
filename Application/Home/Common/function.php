<?php

/**验证码
 * @param $code
 * @param int $id
 * @return bool
 */
function check_verify($code,$id=1)
{
    $verify =new \Think\Verify();
    $verify->length=1;
    $verify->reset=false;

    return $verify->check($code,$id);
}

//function encrytion($username,$type=0)
//{
//    $key="ZK";
//    if(!$type)
//    {
//        return base64_decode($username ^ $key);
//    }
//
//    $username = base64_decode($username);
//    return $username ^ $key;
//}

//cookie加密
function encryption($username, $type = 0) {
    $key = sha1("ZK");

    if (!$type) {
        return base64_encode($username ^ $key);
    }

    $username = base64_decode($username);
    return $username ^ $key;
}