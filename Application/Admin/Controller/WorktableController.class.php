<?php
namespace Admin\Controller;
use Think\Controller;
class WorktableController extends BaseController {
    //list
    public function listAction(){
        $sc=I('sc/s','nid desc');
        $sc=str_replace("+"," ",$sc);
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
            "state" => "关闭"
        );
        if(I("type2")!=''){
            $map['type2']=I("type2");
            $this->assign("type2",I("type2"));
        }
        if(I("action")!=''){
            $map['action']=I("action");
            if(I("action")=='新上架'){
                $map['type2']='问题处理';
            }
            $this->assign("action",I("action"));
        }
        if(I('recvdept/s')){
            $map['recvdept']=I('recvdept/s');
            $this->assign("recvdept",I('recvdept/s'));
        }
        if(I('commit_at_from/s')!=''&&I('commit_at_to/s')!=''){
            if(I('commit_at_from/s')==I('commit_at_to/s')){
                $map['commit_at']=array('like','%'.I('commit_at_from/s').'%');
            }else{
                $map['commit_at']=array('between',array(I('commit_at_from/s'),date("Y-m-d",strtotime("+1 day",strtotime(I('commit_at_to/s'))))));
            }
            $this->assign("commit_at_from",I('commit_at_from/s'));
            $this->assign("commit_at_to",I('commit_at_to/s'));
        }
        if(I('receive_at_from/s')!=''&&I('receive_at_to/s')!=''){
            if(I('receive_at_from/s')==I('receive_at_to/s')){
                $map['receive_at']=array('like','%'.I('receive_at_from/s').'%');
            }else{
                $map['receive_at']=array('between',array(I('receive_at_from/s'),date("Y-m-d",strtotime("+1 day",strtotime(I('receive_at_to/s'))))));
            }
            $this->assign("receive_at_from",I('receive_at_from/s'));
            $this->assign("receive_at_to",I('receive_at_to/s'));
        }
        if(I('complete_at_from/s')!=''&&I('complete_at_to/s')!=''){
            if(I('complete_at_from/s')==I('complete_at_to/s')){
                $map['complete_at']=array('like','%'.I('complete_at_from/s').'%');
            }else{
                $map['complete_at']=array('between',array(I('complete_at_from/s'),date("Y-m-d",strtotime("+1 day",strtotime(I('complete_at_to/s'))))));
            }
            $this->assign("complete_at_from",I('complete_at_from/s'));
            $this->assign("complete_at_to",I('complete_at_to/s'));
        }
        if(I('room')!=''){
            $map['room']=I('room');
            $this->assign("room",I('room'));
        }
        if(I('receiver')!=''){
            $map['receiver']=I('receiver');
            $this->assign("receiver",I('receiver'));
        }
        if(I('committer')!=''){
            $map['committer']=I('committer');
            $this->assign("committer",I('committer'));
        }
        if(I('comp_state')!=''){
            $map['comp_state']=I('comp_state');
            $this->assign("comp_state",I('comp_state'));
        }
        // print "<pre>";
        // print_r($map);exit;
        $count=M('tasks')->where($map)->count();
        $p = getpage($count,15);
        $p->parameter['keyword'] = $key;
        $show = $p->show();
        $tasklist=M('tasks')->limit($p->firstRow.','.$p->listRows)->where($map)->order($sc)->select();
        $totalbonus=M('tasks')->where($map)->sum("bonus");
        $roomlist=M('rooms')->getField('id,name');
        $this->assign("roomlist",$roomlist);
        $committerlst=M('accounts')->field('realname')->where("dept='%s'","客服部")->select();
        $this->assign("committerlst",$committerlst);
        $receiverlst=M('accounts')->field('realname')->where("dept='%s' OR dept='%s'","技术部","客服部")->select();
        $this->assign("receiverlst",$receiverlst);
        $this->assign("count",$count);
        $this->assign("page",$show);
        $this->assign("tasklist",$tasklist);
        $this->assign("totalbonus",$totalbonus);
        $this->assign("perm",C('perm'));
        $this->assign("sc",$sc);
        $this->assign("key",$key);
        $this->display();
    }
    //工单重置
    public function resetAction(){
        $nid=I('post.nid');
        $info=M('tasks')->field('complete_at,makesure_at,receive_at,recvdept,receiver,action,timelimit')->where("nid = %d",$nid)->find();
        $person=M('accounts')->field('dept,level')->where("realname = '%s'",$info['receiver'])->find();
        $level=M('level')->field('coeff')->where("name = '%s'",$person['level'])->find();
        $process=M('process')->field('bonus')->where("name = '%s'",$info['action'])->find();
        $diff_c=floor((strtotime($info['complete_at'])-strtotime($info['makesure_at']))/60);
        $diff_r=floor((strtotime($info['complete_at'])-strtotime($info['receive_at']))/60);
        // 优: 1.3，中: 1，差: 0.5
        $v_coeff = 1;

        $data['total_use'] = $diff_r.'分钟';
        // 距离开单时间小于限定时间，优
        if ($diff_c < $info['timelimit']) {
            $data['comp_state'] = "优";
            $v_coeff = 1.3;
        }
        else if ($diff_r < $info['timelimit']) {
            $data['comp_state'] = "中";
            $v_coeff = 1;
        }
        else {
            $data['comp_state'] = "差";
            $v_coeff = 0.5;
        }
        //所有【受理部门为网络部，接单人为客服部】的单子，都为中
        $str="";
        if ($info['recvdept'] == '网络部' && $person['dept'] == '客服部') {
            $str .= "【网络部工单系数调整】本来: ".$v_coeff;
            $v_coeff = 1;
            $str .= ",调为: ".$v_coeff;
            $str .= ",";
        }

        $str_benlai="";
        $str_zero="";
        $str_benlai = ",【重置前】".$data['comp_state']."[".$v_coeff."]";
        $data['comp_state']="中";
        $v_coeff = 1;
        $final_bonus = round($level['coeff'] * $process['bonus'] * $v_coeff * 100) / 100;
        $data['bonus'] = $final_bonus;
        $str .= "距开单时间：".$diff_c."分钟,";
        $str .= "距接单时间：".$diff_r."分钟,";
        $str .= "奖金：".$process['bonus'].",等级系数: ".$level['coeff'].",完成状态:".$data['comp_state']."[".$v_coeff."]".$str_benlai.$str_zero;
        $data['bonus_desc'] = $str;
        
        $talogsdata=array(
            "tid" =>  'GD'.date('YmdHis').rand(100,999),
            "name" => C("username"),
            "act" => "工单重置",
            "msg" => "",
            "ip" => $_SERVER["REMOTE_ADDR"],
            "tm" => time()
        );
        M("talogs")->add($talogsdata);
        if(M('tasks')->where("nid=%d",$nid)->save($data)){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
    //奖金清零
    public function emptybnsAction(){
        $nid=I('post.nid');
        $talogsdata=array(
            "tid" =>  'GD'.date('YmdHis').rand(100,999),
            "name" => C("username"),
            "act" => "奖金清零",
            "msg" => "",
            "ip" => $_SERVER["REMOTE_ADDR"],
            "tm" => time()
        );
        M("talogs")->add($talogsdata);
        if(M('tasks')->where("nid=%d",$nid)->save(array("bonus"=>0))){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
    //remove
    public function removeAction(){
        $nid=I('post.nid');
        $data=array(
            "state"  => "废弃",
        );
        if(M('tasks')->where("nid=%d",$nid)->save($data)){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
    //导出csv
    public function exportcsvAction(){
        ini_set('memory_limit','1024M');
        set_time_limit (0);
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
            "state" => "关闭"
        );
        if(I("type2")!=''){
            $map['type2']=I("type2");
        }
        if(I("action")!=''){
            $map['action']=I("action");
            if(I("action")=='新上架'){
                $map['type2']='问题处理';
            }
        }
        if(I('recvdept/s')){
            $map['recvdept']=I('recvdept/s');
        }
        if(I('commit_at_from/s')!=''&&I('commit_at_to/s')!=''){
            $map['commit_at']=array('between',array(I('commit_at_from/s'),I('commit_at_to/s')));
        }
        if(I('receive_at_from/s')!=''&&I('receive_at_to/s')!=''){
            $map['receive_at']=array('between',array(I('receive_at_from/s'),I('receive_at_to/s')));
        }
        if(I('complete_at_from/s')!=''&&I('complete_at_to/s')!=''){
            $map['complete_at']=array('between',array(I('complete_at_from/s'),I('complete_at_to/s')));
        }
        if(I('room')!=''){
            $map['room']=I('room');
        }
        if(I('receiver')!=''){
            $map['receiver']=I('receiver');
        }
        if(I('committer')!=''){
            $map['committer']=I('committer');
        }
        if(I('comp_state')!=''){
            $map['comp_state']=I('comp_state');
        }
        $list=M('tasks')->where($map)->order('nid desc')->select();
        $str="ID,客户名称,IP地址,工单类型,处理方法,受理部门,受理工程师,用时,奖金,完成结果,提交时间,受理时间,完成时间,处理时限(分钟),所在机房,提交人\n";
        foreach($list as $item){
            $str.=$item['nid']. "," .$item['cname']. "," .$item['ipaddr']. "," .$item['type2']. "," .$item['action']. "," .$item['recvdept']. "," .$item['receiver']. "," .$item['total_use']. "," .$item['bonus']. "," .$item['comp_state']. "," .$item['commit_at']. "," .$item['receive_at'].",".$item['complete_at']."," .$item['timelimit']. ",".$item['room'].",".$item['committer']."\n";
        }
        $filename="工单报表".date("Ymdhis").".csv";
        $this->export_filename($filename, $str);
    }
    public function export_filename($filename,$data)
    {
        header("Content-type:text/csv");
        header("Content-Disposition:attachment;filename=" . $filename);
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');
        echo $data;
    }  
}