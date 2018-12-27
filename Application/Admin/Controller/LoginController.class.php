<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    //index
    public function indexAction(){
        $this->display();
    }
    //login
    public function loginAction(){
        $name=I('post.name');
        $password=I('post.password');
        $map=array(
            "name" => array('eq',$name),
            "passwd" => array('eq',md5($password))
        );
        if(M('accounts')->where($map)->select()){
            $userinfo=M('accounts')->where($map)->find();
            session("loginuser",$userinfo);
            //添加登录记录
            $loginlogdata=array(
                "name" => $userinfo['realname'],
                "ipaddr" => $_SERVER['REMOTE_ADDR'],
                "loginat" => date("Y-m-d H:i:s")
            );
            M('loginlog')->add($loginlogdata);
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn('账号或密码错误');
        }
    }
}