<?php
/**
 * Created by PhpStorm.
 * User: closure
 * Date: 4/27/15
 * Time: 2:52 PM
 */


//验证码校验
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}