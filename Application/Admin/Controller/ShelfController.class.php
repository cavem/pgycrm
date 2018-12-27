<?php
namespace Admin\Controller;
use Think\Controller;
class ShelfController extends BaseController {
    //list
    public function listAction(){
        $sc=I('sc/s','asc');
        $key=I('keyword/s');
        $map=array(
            "code" => array('like','%'.$key.'%'),
            "room" => array('like','%'.$key.'%'),
            "company" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $count=M('cabinets')->where($map)->count();
        $p = getpage($count,10);
        $p->parameter['keyword'] = $key;
        $show = $p->show();
        $shelflist=M('cabinets')->limit($p->firstRow.','.$p->listRows)->where($map)->order('code '.$sc)->select();
        $this->assign("count",$count);
        $this->assign("page",$show);
        $this->assign("shelflist",$shelflist);
        $this->assign("perm",C('perm'));
        $this->display();
    }
    //new
    public function newAction(){
        $roomlist=M('rooms')->getField('id,name');
        $this->assign("roomlist",$roomlist);
        if(IS_POST){
            $data=M('cabinets')->create();
            if(M('cabinets')->add($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->display();
    }
    //edit
    public function editAction(){
        $roomlist=M('rooms')->getField('id,name');
        $cabtinfo=M('cabinets')->where("id=%d",I('id'))->find();
        $this->assign("roomlist",$roomlist);
        $this->assign("cabtinfo",$cabtinfo);
        if(IS_POST){
            $data=M('cabinets')->create();
            if(M('cabinets')->where("id=%d",I('id'))->save($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->display();
    }
    //remove
    public function removeAction(){
        if(M('cabinets')->where("id=%d",I('id'))->delete()){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
}