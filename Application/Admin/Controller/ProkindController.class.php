<?php
namespace Admin\Controller;
use Think\Controller;
class ProkindController extends BaseController {
    //list
    public function listAction(){
        $sc=I('sc/s','asc');
        $key=I('keyword/s');
        $map=array(
            "name" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $count=M('categories')->where($map)->count();
        $p = getpage($count,10);
        $p->parameter['keyword'] = $key;
        $show = $p->show();
        $prokindlist=M('categories')->limit($p->firstRow.','.$p->listRows)->where($map)->order('id '.$sc)->select();
        $this->assign("count",$count);
        $this->assign("page",$show);
        $this->assign("prokindlist",$prokindlist);
        $this->assign("perm",C('perm'));
        $this->display();
    }
    //new
    public function newAction(){
        if(IS_POST){
            $data=M("categories")->create();
            if(M("categories")->add($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->display();
    }
    //remove
    public function removeAction(){
        if(M('categories')->where("name='%s'",I('post.name'))->delete()){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
}