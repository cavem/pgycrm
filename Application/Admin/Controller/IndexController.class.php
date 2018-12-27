<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function indexAction(){
        $perm=C("perm");
        foreach($perm as $k=>$v){
            $n=0;
            foreach($v as $k2=>$v2){
                $n2=0;
                foreach($v2 as $k3=>$v3){
                    $n+=$v3;
                    $n2+=$v3;
                }
                if($n2>0){
                    $perm[$k][$k2]["this"]=1;
                }else{
                    $perm[$k][$k2]["this"]=0;
                }
            }
            if($n>0){
                $perm[$k]["this"]=1;
            }else{
                $perm[$k]["this"]=0;
            }
        }
        $this->assign("perm",$perm);
        $rooms=C("rooms");
        $rooms=trim($rooms,"']");
        $rooms=trim($rooms,"['");
        $this->assign("username",C("username"));
        $this->assign("dept",C("dept"));
        $this->assign("room",$rooms);
    	$this->display();
    }
    public function index2Action(){
        //我的工作
        $dptlist=M('department')->getField("ID,Name");
        $this->assign("dptlist",$dptlist);
        $map=array(
            "UserProfiles" => array("like",'%'.C("username").'%'),
        );
        $count=M('workremark')->where($map)->count();
        $Page = new \Extend\Page($count,10);
        $Page->parameter['keyword'] = $key;
        $show = $Page->show();
        $list=M('workremark')->limit($Page->firstRow.','.$Page->listRows)->where($map)->order("ID desc")->select();
        $this->assign("list",$list);
        $this->assign("page",$show);
        //我的考核
        $map2=array(
            "RealName" => C("username"),
        );
        $count2=M('assessment')->where($map2)->count();
        $Page2 = new \Extend\Page($count2,10);
        $Page2->parameter['keyword'] = $key;
        $show2 = $Page2->show();
        $list2=M('assessment')->limit($Page2->firstRow.','.$Page2->listRows)->where($map2)->order("ID desc")->select();
        $this->assign("list2",$list2);
        $this->assign("page2",$show2);
        $this->assign("perm",C('perm'));
        $this->display();
    }
    //editpsw
    public function editpswAction(){
        if(IS_POST){
            $psw=md5(I('post.psw'));
            if(M('accounts')->where("name='%s'",C(name))->setField("passwd",$psw)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->display();
    }
    //我的考核-确认
    public function checkAction(){
        if(M('assessment')->where("ID=%d",I('post.id'))->setField("IsConfirm",1)){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(0);
        }
    }
    //退出
    public function loginoutAction(){
        $_SESSION["loginuser"]="";
        $this->redirect('Login/index');
    }
}