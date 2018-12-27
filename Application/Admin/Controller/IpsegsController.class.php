<?php
namespace Admin\Controller;
use Think\Controller;
class IpsegsController extends BaseController {
    //list
    public function listAction(){
        $sc=I('sc/s','asc');
        $key=I('keyword/s');
        $map=array(
            "name" => array('like','%'.$key.'%'),
            "ipseg" => array('like','%'.$key.'%'),
            "netmask" => array('like','%'.$key.'%'),
            "vlan" => array('like','%'.$key.'%'),
            "router" => array('like','%'.$key.'%'),
            "room" => array('like','%'.$key.'%'),
            "isp" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $count=M('ipsegs')->where($map)->count();
        $p = getpage($count,10);
        $p->parameter['keyword'] = $key;
        $show = $p->show();
        $ipsegslist=M('ipsegs')->limit($p->firstRow.','.$p->listRows)->where($map)->order('id '.$sc)->select();
        foreach($ipsegslist as $key=>$val){
            $ipsegslist[$key]['count']=M("ips")->where("ipseg='%s' AND state=%d",$val['ipseg'],0)->count();
        }
        $this->assign("count",$count);
        $this->assign("page",$show);
        $this->assign("ipsegslist",$ipsegslist);
        $this->assign("perm",C('perm'));
        $this->display();
    }
    //new
    public function newAction(){
        $roomlist=M('rooms')->getField('id,name');
        $this->assign("roomlist",$roomlist);
        if(IS_POST){
            $data=M("ipsegs")->create();
            if(M('ipsegs')->add($data)){
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
            $data=M("ipsegs")->create();
            if(M("ipsegs")->save($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $list=M('ipsegs')->where("id=%d",I('id'))->find();
        $roomlist=M('rooms')->getField('id,name');
        $this->assign("roomlist",$roomlist);
        $this->assign("list",$list);
        $this->display();
    }
    //remove
    public function removeAction(){
        if(M('ipsegs')->where("id=%d",I('post.id'))->delete()){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
    //add_ip
    public function add_ipAction(){
        if(IS_POST){
            $ipseg=I('ipseg/s');
            $startip=I('sipaddr/s');
            $endip=I('eipaddr/s');
            if (!empty($endip)) {
                //截取开始ip/结束时间
                $ipstr=explode(".", $startip);
                $sanip=$ipstr[0].'.'.$ipstr[1].'.'.$ipstr[2];
                $start=$ipstr[3];
                $endipstr=explode(".", $endip);
                $end=$endipstr[3];
                $n=0;
                for($i=$start;$i<=$end;$i++)
                {
                    $ip=$sanip.'.'.$i;
                    //查询该ip是否已存在
                    $ipdata=M('ips')->where("ipaddr ='%s'",$ip)->getField('id');
                    if (empty($ipdata))
                    {
                        $data=array(
                            "ipseg" =>$ipseg,
                            "ipaddr" =>$ip,
                            "state" =>0,
                            "isopen" =>'true'
                        );
                        if(M("ips")->add($data)){
                            $n++;
                        }
                    }else{
                        continue;
                    }
                }
                if($n>0){
                    $this->ajaxReturn(0);
                }else{
                    $this->ajaxReturn('ip已存在');
                }
            }else{
                try 
                {
                    //查询该ip是否已存在
                    $ipdata=M('ips')->field('id')->where("ipaddr ='%s'",$startip)->find();
                    if (empty($ipdata))
                    {
                        $data=array(
                            "ipseg" =>$ipseg,
                            "ipaddr" =>$startip,
                            "state" =>0,
                            "isopen" =>'true'
                        );
                        M("ips")->add($data);
                    }
                    $this->ajaxReturn(0);
                }
                catch (Exception $e) {
                    $this->ajaxReturn(1);
                    exit;
                }
            }
        }
        $this->assign("ipseg",I("name"));
        $this->display();
    }
    //view
    public function viewAction(){
        $sc=I('sc/s','asc');
        $key=I('keyword/s');
        $where=array(
            "ipaddr" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $map=array(
            "_complex" => $where,
            "ipseg" => I('name')
        );
        $count=M('ips')->where($map)->count();
        $p = getpage($count,10);
        $p->parameter['keyword'] = $key;
        $show = $p->show();
        $list=M('ips')->limit($p->firstRow.','.$p->listRows)->where("ipseg='%s'",I('name'))->where($map)->order('id '.$sc)->select();
        $this->assign("count",$count);
        $this->assign("page",$show);
        $this->assign("list",$list);
        $this->display();
    }
    //removeip
    public function removeipAction(){
        if(M("ips")->where("id=%d",I("id"))->delete()){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
    //ipopen
    public function ipopenAction(){
        if(M("ips")->where("id=%d",I("post.id"))->setField("isopen","true")){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
    //ipclose
    public function ipcloseAction(){
        if(M("ips")->where("id=%d",I("post.id"))->setField("isopen","false")){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
}