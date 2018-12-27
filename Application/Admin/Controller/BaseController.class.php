<?php
namespace Admin\Controller;
use Think\Controller;

class BaseController extends Controller {
    public function _initialize(){
        session_start();
        if(session("loginuser")==''){$this->redirect('Login/index');}
        C("name",session("loginuser.name"));
        C("rooms",session("loginuser.rooms"));
        C("dept",session("loginuser.dept"));
        C("username",session("loginuser.realname"));
        $perm=json_decode(session("loginuser.perm"),true);
        C("perm",$perm);
    }

    public function nosession()
    {
    	$sid = session('loginuser');
        //判断用户是否登陆
        if(!isset($sid) ) {
    		session_destroy();
    		echo "<script>alert('sesion过期,请重新登录');parent.location.reload();</script>";
        	exit;
        }	
    }

}