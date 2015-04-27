<?php
/**
 * Created by PhpStorm.
 * User: closure
 * Date: 4/27/15
 * Time: 2:37 PM
 */

namespace Home\Controller;

use Think\Controller;

class PublicController extends  Controller{

//    protected  function index(){
//        if(!session(C('IS_LOGIN'))){
//            //没有登陆
//            $this->login();
//        }else{
//            $this->redirect('Index/index');
//        }
//    }


    //用户登陆
    public function login(){
        if(IS_POST){

            //验证码
            if(!check_verify($_POST['code'])){
                $this->error('验证码错误');
            }

            // 用户名验证
            if(!check_user($_POST['username'])){

            }

            //密码验证
            if(!check_pwd($_POST['password'])){

            }

            $User = D('User');
            $map['username'] = $_POST['username'];

            $info = $User->where($map)->find();

            if($info === NULL){
                //
                    $this->error('用户不存在');
            }

            if($info['password'] !== md5($_POST['password'])){

                // 密码错误
            }

            //验证成功
            // 更新登陆信息

            // 更新SESSION
            session('is_login',true);
            session('is_admin',false);
            session('login_ip', get_client_ip());
            session('login_time', time());
            session('login_user',$info['username']);

            //调转到首页
            $this->redirect('Index/index');

        }else{
            //可以动态加载配置信息
            $this->display();
        }
    }


    //验证码
    public function verify(){
        $config =    array(
            'fontSize'    =>    30,    // 验证码字体大小
            'length'      =>    3,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
        );
        $Verify =     new \Think\Verify($config);
        $Verify->entry();
    }

    //异步帐号验证(可提取为公用函数)
    public function ajaxUser($username){

        $result = M('User')->where(array('username'=>$username))->find();

        if($result === NULL){
            echo 0;
        }else{
            echo 1;
        }

    }


    //异步验证码验证
    public function ajaxVerify($code){
        if(!check_verify($code)){
            // 验证错误
        }else{
            // 验证码正确
        }
    }

    public function logout(){

        //如果登陆，清除session
        if(session(C('IS_LOGIN'))){
            session_destroy();
        }

        //没有登陆
        $this->login();
    }
}