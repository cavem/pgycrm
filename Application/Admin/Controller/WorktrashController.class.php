<?php
namespace Admin\Controller;
use Think\Controller;
class WorktrashController extends BaseController {
    //list
    public function listAction(){
        $sc=I('sc/s','desc');
        $key=I('keyword/s');
        $where=array(
            "ipaddr" => array('like','%'.$key.'%'),
            "cname" => array('like','%'.$key.'%'),
            "type2" => array('like','%'.$key.'%'),
            "action" => array('like','%'.$key.'%'),
            "ipaddr" => array('like','%'.$key.'%'),
            "recvdept" => array('like','%'.$key.'%'),
            "receiver" => array('like','%'.$key.'%'),
            "total_use" => array('like','%'.$key.'%'),
            "bonus" => array('like','%'.$key.'%'),
            "comp_state" => array('like','%'.$key.'%'),
            "room" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $map=array(
            "_complex" => $where,
            "state" => "废弃"
        );
        $count=M('tasks')->where($map)->count();
        $p = getpage($count,15);
        $p->parameter['keyword'] = $key;
        $show = $p->show();
        $tasklist=M('tasks')->limit($p->firstRow.','.$p->listRows)->where($map)->order('id '.$sc)->select();
        $totalbonus=M('tasks')->where("state='废弃'")->sum("bonus");
        $this->assign("count",$count);
        $this->assign("page",$show);
        $this->assign("tasklist",$tasklist);
        $this->assign("totalbonus",$totalbonus);
        $this->assign("perm",C('perm'));
        $this->display();
    }
    //放回
    public function resetAction(){
        $nid=I('post.nid');
        $data=array(
            "state"  => "关闭",
        );
        if(M('tasks')->where("nid=%d",$nid)->save($data)){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
}