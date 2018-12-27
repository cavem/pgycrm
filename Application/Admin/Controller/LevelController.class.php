<?php
namespace Admin\Controller;
use Think\Controller;
class LevelController extends BaseController {
    //list
    public function listAction(){
        $sc=I('sc/s','asc');
        $key=I('keyword/s');
        $map=array(
            "name" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $count=M('level')->where($map)->count();
        $p = getpage($count,10);
        $p->parameter['keyword'] = $key;
        $show = $p->show();
        $levellist=M('level')->limit($p->firstRow.','.$p->listRows)->where($map)->order('id '.$sc)->select();
        $this->assign("count",$count);
        $this->assign("page",$show);
        $this->assign("levellist",$levellist);
        $this->assign("perm",C('perm'));
        $this->display();
    }
}