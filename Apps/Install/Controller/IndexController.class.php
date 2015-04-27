<?php
// 本类由系统自动生成，仅供测试用途
namespace Install\Controller;
use Think\Controller;
class IndexController extends Controller {

    //安装引导程序
    public function index(){

        $this->display();

    }


    //安装完成，锁定安装程序
    public function complete(){

    }
}