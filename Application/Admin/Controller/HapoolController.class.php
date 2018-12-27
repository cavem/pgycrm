<?php
namespace Admin\Controller;
use Think\Controller;
class HapoolController extends BaseController {
    //list
    public function listAction(){
        //部门
        $dptlist=M('department')->getField("ID,Name");
        $this->assign("dptlist",$dptlist);
        $key=I('keyword/s');
        $where=array(
            "Name" => array('like','%'.$key.'%'),
            "Remarks" => array('like','%'.$key.'%'),
            "Frequency" => array('like','%'.$key.'%'),
            "UserProfiles" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $map=array(
            "_complex" => $where,
        );
        $count=M('workremark')->where($map)->count();
        $Page = new \Extend\Page($count,10);
        $Page->parameter['keyword'] = $key;
        $show = $Page->show();
        $list=M('workremark')->limit($Page->firstRow.','.$Page->listRows)->where($map)->order("ID desc")->select();
        $this->assign("list",$list);
        $this->assign("page",$show);
        $this->assign("perm",C('perm'));
    	$this->display();
    }
    //new
    public function newAction(){
        //部门
        $dptlist=M('department')->field('ID,Name')->select();
        $this->assign("dptlist",$dptlist);
        //员工
        $userlist=M('accounts')->where("isleave='%s'",'false')->order("name asc")->getField('nid,realname,dept');
        $this->assign("userlist",$userlist);
        if(IS_POST){
            $data=M('workremark')->create();
            $data['Remarks']=htmlspecialchars_decode(I('Remarks'));
            if(M('workremark')->add($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->display();
    }
    //view
    public function viewAction(){
        $this->display();
    }
    //edit
    public function editAction(){
        //部门
        $dptlist=M('department')->field('ID,Name')->select();
        $this->assign("dptlist",$dptlist);
        //员工
        $userlist=M('accounts')->where('nid != 1')->order("realname asc")->getField('nid,realname,dept');
        $this->assign("userlist",$userlist);
        //工作
        $wklist=M('workremark')->where("ID=%d",I('id'))->find();
        $this->assign("wklist",$wklist);
        if(IS_POST){
            $data=M('workremark')->create();
            $data['Remarks']=htmlspecialchars_decode(I('Remarks'));
            if(M('workremark')->save($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->display();
    }
    //remove
    public function removeAction(){
        if(M('workremark')->where("ID=%d",I('id'))->delete()){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
        $this->display();
    }
}