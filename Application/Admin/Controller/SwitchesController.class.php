<?php
namespace Admin\Controller;
use Think\Controller;
class SwitchesController extends BaseController {
    //list
    public function listAction(){
        $sc=I('sc/s','asc');
        $key=I('keyword/s');
        $map=array(
            "switch_id" => array('like','%'.$key.'%'),
            "asset_id" => array('like','%'.$key.'%'),
            "company" => array('like','%'.$key.'%'),
            "room" => array('like','%'.$key.'%'),
            "cabinet" => array('like','%'.$key.'%'),
            "ip_addr" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $count=M('switches')->where($map)->count();
        $p = getpage($count,10);
        $p->parameter['keyword'] = $key;
        $show = $p->show();
        $switcheslist=M('switches')->limit($p->firstRow.','.$p->listRows)->where($map)->order('id '.$sc)->select();
        $this->assign("count",$count);
        $this->assign("page",$show);
        $this->assign("switcheslist",$switcheslist);
        $this->assign("perm",C('perm'));
        $this->display();
    }
    //new
    public function newAction(){
        $roomlist=M('rooms')->getField('id,name');
        $this->assign("roomlist",$roomlist);
        if(IS_POST){
            $data=M('switches')->create();
            if(M('switches')->add($data)){
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
        $swcinfo=M('switches')->where("id=%d",I('id'))->find();
        $this->assign("roomlist",$roomlist);
        $this->assign("swcinfo",$swcinfo);
        if(IS_POST){
            $data=M('switches')->create();
            if(M('switches')->where("id=%d",I('id'))->save($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->display();
    }
    //remove
    public function removeAction(){
        if(M('switches')->where("id=%d",I('id'))->delete()){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
}