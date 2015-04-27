<?php
/**
 * Created by PhpStorm.
 * User: closure
 * Date: 4/27/15
 * Time: 2:38 PM
 */
namespace Admin\Controller;

use Think\Controller;

class PublicController extends Controller{

    //检测登陆等
    protected  function __inti(){

    }

    //管理员登陆
    public function login($username='', $password='' ,$code=''){
        if(IS_POST){
            //登陆操作，使用ajax操作
            if(!check_verify($code)){
                $this->error('验证码错误');
                return;
            }else{
                //验证码正确，验证帐号，用户名，密码
                if(!check_admin($username)){

                }else{
                    if(!check_password($password)){

                    }else{
                        //数据库比对
                        $Admin = D('Admin');
                        $map['username']=$username;
                        $info = $Admin->where($map)->find(); //只会返回一条
                        if($info === NULL) {
                            //用户不存在

                        }else{
                            //验证密码
                            if(md5($password) !== $info['password']){
                                //密码错误
                                $this->error('密码错误');
                            }else{
                                //登陆成功，更新数据库
                                $Log = M('Log');
                                //更新数据
                                $data = array(
                                    'time'=>''
                                );
                                $Log->create();

                                session(C('IS_LOGIN', true));
                                session(C('IS_ADMIN', true));
                                session(C('LOGIN_TIME', '')); //当前时间

                                //进入后台首页
                                $this->redirect('Index/index');
                            }
                        }
                    }
                }

            }
        }else{
            //登陆页面
            $this->display();
        }

    }

    //用户退出登陆
    public function logout(){
        //清除session,页面调转时会自动调转
        session_destroy();
    }

    //用户注册
    public function register(){
        //是否允许注册
        if(C('ACCESS_REGISTER')){
            if(IS_POST){

            }else{

            }
        }else{
            //不允许注册
            $this->show('暂不支持用户自行注册，请联系管理员');
        }
    }


    //生成验证码
    public function verify(){
        $config =    array(
            'fontSize'    =>    30,    // 验证码字体大小
            'length'      =>    3,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
        );
        $Verify =     new \Think\Verify($config);
        $Verify->entry();
    }
}