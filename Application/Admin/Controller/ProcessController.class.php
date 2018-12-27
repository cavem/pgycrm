<?php
namespace Admin\Controller;
use Think\Controller;
class ProcessController extends BaseController {
    //list
    public function listAction(){
        $sc=I('sc/s','asc');
        $key=I('keyword/s');
        $map=array(
            "name" => array('like','%'.$key.'%'),
            "category" => array('like','%'.$key.'%'),
            "band_limit" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $count=M('process')->where($map)->count();
        $p = getpage($count,10);
        $p->parameter['keyword'] = $key;
        $show = $p->show();
        $list=M('process')->limit($p->firstRow.','.$p->listRows)->where($map)->order('id '.$sc)->select();
        $this->assign("count",$count);
        $this->assign("page",$show);
        $this->assign("list",$list);
        $this->assign("perm",C('perm'));
        $this->display();
    }
    //new
    public function newAction(){
        if(IS_POST){
            $data=M("process")->create();
            if(M("process")->add($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->display();
    }
    //edit
    public function editAction(){
        if(IS_POST){
            $data=M("process")->create();
            if(M("process")->where("id=%d",I('post.id'))->save($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $list=M('process')->where("id=%d",I('id'))->find();
        $this->assign("list",$list);
        $this->display();
    }
    //remove
    public function removeAction(){
        if(M('process')->where("id=%d",I('post.id'))->delete()){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
}