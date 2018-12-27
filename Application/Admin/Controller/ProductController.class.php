<?php
namespace Admin\Controller;
use Think\Controller;
class ProductController extends BaseController {
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
        $count=M('products')->where($map)->count();
        $p = getpage($count,10);
        $p->parameter['keyword'] = $key;
        $show = $p->show();
        $productlist=M('products')->limit($p->firstRow.','.$p->listRows)->where($map)->order('id '.$sc)->select();
        $this->assign("count",$count);
        $this->assign("page",$show);
        $this->assign("productlist",$productlist);
        $this->assign("perm",C('perm'));
        $this->display();
    }
    //new
    public function newAction(){
        if(IS_POST){
            $data=M("products")->create();
            if(M("products")->add($data)){
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
            $data=M("products")->create();
            if(M("products")->where("id=%d",I('post.id'))->save($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $list=M('products')->where("id=%d",I('id'))->find();
        $this->assign("list",$list);
        $this->display();
    }
    //remove
    public function removeAction(){
        if(M('products')->where("id=%d",I('post.id'))->delete()){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
}