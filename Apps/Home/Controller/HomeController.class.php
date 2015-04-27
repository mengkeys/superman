<?php
/**
 * Created by PhpStorm.
 * User: closure
 * Date: 4/27/15
 * Time: 2:36 PM
 */

namespace Home\Controller;

use Think\Controller;

class HomeController extends Controller{

    // 父类自动执行
    protected  function _initialize(){

        //会对每个请求进行检测
        if(!session(C('IS_LOGIN'))){
            //没有登陆
            $this->redirect(C('AUTH_PATH')); //
        }

    }
}