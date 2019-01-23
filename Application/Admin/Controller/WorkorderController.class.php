<?php
namespace Admin\Controller;
use Think\Controller;
//所有session未处理
class WorkorderController extends BaseController {
    public function myorderAction(){
        //parent::nosession();
        $this->assign("username",C("username"));
        $this->assign("dept",C("dept"));
        $this->assign("perm",C('perm'));
    	$this->display();
    }
    public function searchipAction(){
        $ip=I('post.ip');
        $map=array(
            "ipaddr" => array('like','%'.$ip.'%')
        );
        $tasks=M('tasks')->where($map)->where("state<>'关闭' AND state<>'废弃'")->select();
        foreach ($tasks as $k => $val) {
            //日期格式化
            $ra=strstr($val['receive_at'],'T')?str_replace('T',' ',$val['receive_at']):$val['receive_at'];//受理时间
            $ra=explode('.', $ra);
            $ca=strstr($val['commit_at'],'T')?str_replace('T',' ',$val['commit_at']):$val['commit_at'];//提交时间
            $ca=explode('.', $ca);
            $tasks[$k]['receive_at']=$ra[0];
            $tasks[$k]['commit_at']=$ca[0];
            //查询超时状态
            if (empty($val['receive_at'])) {
                $tasks[$k]['overtime']="未超时";
            }
            else
            {
                if (date("Y-m-d H:i:s",strtotime($ra[0])+$val['timelimit']*60)>date("Y-m-d H:i:s")) {
                    $tasks[$k]['overtime']="未超时";
                }else{
                    $tasks[$k]['overtime']="超时";
                }
            }
        }
        echo json_encode($tasks);
    }
    //技术接单
    public function gettingAction()
    {
        $username=C("username");
        $dept=C("dept");
        $rooms=C("rooms");
        $rooms=trim($rooms,']');
        $rooms=trim($rooms,'[');
        $tasksModel=M('tasks');
        $where['receiver'] = array('exp','is null OR receiver=""');
        //$where['_logic'] = 'OR';
        $map['_complex'] = $where;
        if ($dept=="网络部"||$dept=="客服部") {
            $map['recvdept']="网络部";
        }
        else
        {
            $map['recvdept']="技术部";
            $map['room']  = array('exp',"IN (".$rooms.")");
        }
        $map['state']="待处理";
        $tasks=$tasksModel->field("id,nid")->where($map)->find();
        if ($tasks) {
            $data['state']="处理中";
            $data['receiver']=$username;
            $data['receive_at']=date('Y-m-d H:i:s');
            $tasksModel->where("nid=%d",$tasks['nid'])->save($data);
            self::talog('领取工单','',$tasks['id']); 
            echo json_encode(0);
            exit;
        }else{
            echo json_encode(1);//当前无单
            exit;
        }  
    }


    //技术接单后刷新处理中数据
    public function processingAction()
    {
        $username=C("username");
        $tasksModel=M('tasks');
        $map['state']="处理中";
        $map['receiver']=$username;
        $tasks=$tasksModel->where($map)->order('nid desc')->select();
        foreach ($tasks as $k => $val) {
            //日期格式化
            $ra=strstr($val['receive_at'],'T')?str_replace('T',' ',$val['receive_at']):$val['receive_at'];//受理时间
            $ra=explode('.', $ra);
            $ca=strstr($val['commit_at'],'T')?str_replace('T',' ',$val['commit_at']):$val['commit_at'];//提交时间
            $ca=explode('.', $ca);
            $tasks[$k]['receive_at']=$ra[0];
            $tasks[$k]['commit_at']=$ca[0];
            //查询超时状态
            if (empty($val['receive_at'])) {
                $tasks[$k]['overtime']="未超时";
            }
            else
            {
                if (date("Y-m-d H:i:s",strtotime($ra[0])+$val['timelimit']*60)>date("Y-m-d H:i:s")) {
                    $tasks[$k]['overtime']="未超时";
                }else{
                    $tasks[$k]['overtime']="超时";
                }
            }
        }
        $this->assign("orderinfo",$tasks);
        $this->display('orderinfo');
    }

    //tab选中动态添加
    public function orderinfoAction()
    {
    	//parent::nosession();
    	$username=C("username");
    	$state=I('state/s');
    	$tasksModel=M('tasks');
    	switch ($state) {
    		case '处理中':
    			$map['state']=$state;
    			$map['receiver']=$username;
    			break;
    		case '待处理':
    			$map['state']=array(array('eq','待处理'),'处理中','or');
    			break;
    		case '库管确认':
    			$map['state']=array(array('eq','已解决[下转]'),array('eq','已解决[涉硬]'),'已下架','or');
    			break;
    		default:
    			$map['state']=$state;
    			break;
    	}
        $tasks=$tasksModel->where($map)->order('nid desc')->select();
        foreach ($tasks as $k => $val) {
        	//日期格式化
        	$ra=strstr($val['receive_at'],'T')?str_replace('T',' ',$val['receive_at']):$val['receive_at'];//受理时间
        	$ra=explode('.', $ra);
        	$ca=strstr($val['commit_at'],'T')?str_replace('T',' ',$val['commit_at']):$val['commit_at'];//提交时间
        	$ca=explode('.', $ca);
        	$tasks[$k]['receive_at']=$ra[0];
        	$tasks[$k]['commit_at']=$ca[0];
        	//查询超时状态
        	if (empty($val['receive_at'])) {
        		$tasks[$k]['overtime']="未超时";
        	}
        	else
        	{
        		if (date("Y-m-d H:i:s",strtotime($ra[0])+$val['timelimit']*60)>date("Y-m-d H:i:s")) {
        			$tasks[$k]['overtime']="未超时";
	        	}else{
	        		$tasks[$k]['overtime']="超时";
	        	}
        	}
        }
        echo json_encode($tasks);
        exit;
    }

    public function viewitemAction()
    {
        $nid=I('nid');
        $tasksModel=M('tasks');
        $tasks=$tasksModel->where("nid = %d",$nid)->find();
        $this->assign("tasks",$tasks);
        $talogs=M('talogs');
        $talog=$talogs->where("tid = '%s'",$tasks['id'])->select();
        $this->assign("talog",$talog);
        if (!empty($tasks['svid'])) {
            //获取服务器信息
            $serverModel=M('servers');
            $serverinfo=$serverModel->where("ServNum = '%s'",$tasks['svid'])->find();
            $this->assign("serverinfo",$serverinfo);
            //获取服务器转让信息
            if(!empty($serverinfo['id'])){
                $servtflist=M('server_transfer_log')->where("svnid=%d",$serverinfo['id'])->select();
                $this->assign('servtflist',$servtflist);
            }
            
        }
        $this->assign('nid',$nid);
        $this->display();
    }

    //新工单/修改工单弹出信息
    public function addorderAction()
    {
    	$nid=I('nid');
    	if (!empty($nid)) {
    		//修改工单
    		$tasksModel=M('tasks');
    		$tasks=$tasksModel->where("nid = %d",$nid)->find();
    		$this->assign("tasks",$tasks);
    		$talogs=M('talogs');
    		$talog=$talogs->where("tid = '%s'",$tasks['id'])->select();
    		$this->assign("talog",$talog);
    		$this->assign('nid',$nid);
    	}
    	$this->display();
    }

    //新工单信息保存
    public function orderaddAction()
    {
    	$nid=I('nid/d');
    	$gid=I('gid/s');
    	$bid=I('bid/s');
    	$state=I('state/s');
    	$priority=I('priority/s');
    	$recvdept=I('recvdept/s');
    	$room=I('room/s');
    	$title=I('title/s');
    	$problemdesc=I('problemdesc/s');
    	$action=I('action/s');
    	$action=explode('_', $action);
    	$action=$action[0];
    	$timelimit=I('timelimit/d');
    	$id=empty($gid)?'GD'.date('YmdHis').rand(100,999):$gid;
    	$bid=empty($bid)?'BN'.date('YmdHis').rand(100,999):$bid;
    	$data=array(
    		"id"=>$id,
    		"batchid"=>$bid,
    		"batchnum"=>1,//默认为1
    		"state"=>empty($nid)||$state=="未解决"?'待确认':$state,
    		"priority"=>$priority,
    		"priority_num"=>$priority=="正常"?0:($priority=="优先"?1:2),
    		"recvdept"=>$recvdept,
    		"title"=>$title,
    		"problemdesc"=>$problemdesc,
    		"action"=>$action,
    		"timelimit"=>$timelimit,
    		"room"=>$room,
    	);
    	$tasksModel=M('tasks');
    	if($tasksModel->create($data)){
    		if (!empty($nid)) {
    			$tasksModel->where("nid=%d",$nid)->save($data);
    			//增加记录
		    	self::log("修改");
		    	self::talog('修改工单',$problemdesc,$id);
    		}
    		else
    		{
                $data["type"]=0;
                $data["type2"]="问题处理";
    			$data["committer"]=C("username");//提交人
    			$data["commit_at"]=date('Y-m-d H:i:s');//提交时间
    			$data["expire_at"]=date('Y-m-d H:i:s',strtotime("+".$timelimit." minute"));
				$tasksModel->add($data);
		    	//增加记录
		    	self::log("提交");
		    	self::talog('创建工单',$problemdesc,$id);
    		}
		    echo json_encode(0);
			exit;
		}
    }

    //确认/指派工单弹出信息
    public function confirmorderAction()
    {
    	$type=I('type/d',0);//0确认工单 1指派工单 2回复工单 3待验证确认 4确认审核 5带宽确认 6财务确认 7位置确认 8库管确认 9放回处理 10废弃工单
    	$nid=I('nid');
		$tasksModel=M('tasks');
		$tasks=$tasksModel->where("nid = %d",$nid)->find();
		$this->assign("tasks",$tasks);
		$talogs=M('talogs');
		$talog=$talogs->where("tid = '%s'",$tasks['id'])->select();
		$this->assign("talog",$talog);
        if (!empty($tasks['svid'])) {
            //获取服务器信息
            $serverModel=D('Servers');
            $serverinfo=$serverModel->where("ServNum = '%s'",$tasks['svid'])->find();
            $this->assign("serverinfo",$serverinfo);
        }
		if ($type==1) {
            $accounts=M('accounts');
            $map=array(
                "isleave" => 'false'
            );
			$userlst=$accounts->field('realname')->where("dept='技术部' OR dept='网络部' OR dept='客服部'")->where($map)->select();
			$this->assign('userlst',$userlst);
		}
        //print_r($tasks['action']);exit;
		$this->assign('nid',$nid);
		$this->assign('type',$type);
    	$this->display();
    }

    //确认工单/指派工单/回复信息/待验证确认/确认审核/带宽确认/财务确认提交
    public function orderresAction()
    {
    	$username=C("username");
    	$id=I('gid/s');
    	$nid=I('nid/d');//工单自增id
    	$type=I('type/d',0);//0确认工单 1指派工单 2回复工单 3待验证确认 4确认审核 5带宽确认 6财务确认 7位置确认 8库管确认 9放回处理 10废弃工单
    	$receiver=I('receiver/s');//指派员工姓名
    	$state=I('state/s');//解决状态
    	$action=I('action/s');
    	$orderreset=I('orderreset');//工单重置
    	$zero=I('zero'); //奖金清零
        $ips=I('ips/s'); 
    	$problemdesc=I('problemdesc/s');//问题描述
        //先根据action获取是否是涉硬流程
        $processModel=M('process');
        $pc=$processModel->field('id')->where("name='%s' AND flow='%s'",array($action,'涉硬流程'))->find();
        $oldstate=$state;
    	switch ($type) {
            case 0:
                if($action=="订单转让"||$action=="上架转让"){
                    $state="关闭";
                }else{
                    $state="待处理";
                }
    			break;
    		case 1:
    			$state="处理中";
    			break;
            case 2:
                if ($state=="已解决") {
                    if($action=="租用机器增减硬件"||$action=="更换硬件"||$action=="托管机器增减硬件"||$action=="借用配件重装系统"||$action=="更换硬件重装系统"){
                        $state="已解决";
                    }else if (!empty($pc)) {
                        $state="已解决[涉硬]";
                    }elseif ($action=="下架转让") {
                        $state="已解决[下转]";
                    }elseif ($action=="下架") {
                        $state="已下架";
                    }
                }
                break;
    		case 3:
                if ($state=="已解决") {
        			if ($action=="上架"||$action=="新上架"){
        				$state="已验证";
        			}else if($action=="带宽变更"||$action=="添加IP"||$action=="租用机器增减硬件"){
                        $state="待财务确认";
                    }else if($action=="更换硬件"||$action=="托管机器增减硬件"||$action=="借用配件重装系统"||$action=="更换硬件重装系统"){
                        $state="已解决[涉硬]";
                    }else{
                        //结束流程->算钱
                        $data=self::bonus($nid);
                        $state="关闭";
                    }
                }
        		break;
            // case 4:
            //     if($action=="上架"){
            //         $state="上架位置确认";
            //     }else{
            //         $state="关闭";
            //     }
            //     break;
            case 5:
                if(($action=="上架"||$action=="新上架")&&$state=="待财务确认"){
                    $state="上架位置确认";
                }else if($action=="带宽确认"){
                    $state="待财务确认";
                }
                break;
            case 6:
                if($action=="带宽变更"||$action=="添加IP"){
                    $data=self::bonus($nid);
                    $state="关闭";
                }else{
                    $state="已解决[涉硬]";
                }
                break;
            case 7:
                // if($action=="上架转让"){
                //     $state="待审核";
                // }else{
                //     $state="关闭";
                // }
                // break;
            case 8:
                //结束流程->算钱
                $data=self::bonus($nid);
    			$state="关闭";
    			break;
            case 9:
                if ($state=="继续处理") {
                    $state="处理中";
                }elseif($state=="放入工单池")
                {
                    $state="待处理";
                }
                break;
            case 10:
                $state="废弃";
                break;
    	}
    	$data["state"]=$state;
    	$tasksModel=M('tasks');
    	$accountsModel=M('accounts');
    	$processModel=M('process');
    	$levelModel=M('level');
    	if($tasksModel->create($data)){
			//增加记录
	    	self::log("修改");
	    	switch ($type) {
	    		case 0:
                    $data['addip']=$ips;
	    			$data['makesure']=$username;
                    $data['makesure_at']=date('Y-m-d H:i:s');
                    if($action=="订单转让"||$action=="上架转让"){
                        $data['receiver']=$username;
                        $data['receive_at']=date('Y-m-d H:i:s');
                        $data['complete_at']=date('Y-m-d H:i:s');
                    }
                    self::talog('处理确认',$problemdesc,$id);
	    			break;
	    		case 1:
                    $data['addip']=$ips;
	    			$data['receiver']=$receiver;
		    		$data['receive_at']=date('Y-m-d H:i:s');
                    if ($oldstate=="待确认") {
                        $data['makesure']=$username;
                        $data['makesure_at']=date('Y-m-d H:i:s');
                    }
		    		self::talog('指派工单',$problemdesc,$id);
                    self::talog('接收工单[指派]',$problemdesc,$id,$receiver);
		    		break;
                case 2:
                    if($action=="下架"){
                        //获取服务器信息
                        $taskinfo=M('tasks')->field("svid,ipaddr")->where("nid=%d",I('nid/d'))->find();
                        $servinfo=M('servers')->where("ServNum='%s'",$taskinfo['svid'])->find();
                        //更改服务器状态
                        M('servers')->where("ServNum='%s'",$taskinfo["svid"])->setField("ServState","期满移出");
                        //修改机柜服务器数量
                        $s_num=M('cabinets')->where("room='%s' AND code='%s'",$servinfo['IDCName'],$servinfo['ShelfCode'])->getField("s_num");
                        M('cabinets')->where("room='%s' AND code='%s'",$servinfo['IDCName'],$servinfo['ShelfCode'])->setField("s_num",$s_num-1);
                        //更改ip状态
                        $iparr=explode("/",$taskinfo["ipaddr"]);
                        $ipdata=array(
                            "state" => 0,
                            "server" => ''
                        );
                        foreach($iparr as $val){
                            if($val!=''){
                                M('ips')->where("ipaddr='%s'",$val)->save($ipdata);
                                M('t_ips')->where("ip='%s'",$val)->setField("note","已占用/已分配");
                            }
                        }
                        //新增下架记录
                        $downdata=array(
                            "svid" => I('post.servnum'),
                            "svnid" => M('servers')->where("ServNum='%s'",I('post.servnum'))->getField('ID'),
                            "gdbh" => I('post.gid'),
                            "cid" => M('servers')->where("ServNum='%s'",I('post.servnum'))->getField('Customer_ID'),
                            "cname" => M('servers')->where("ServNum='%s'",I('post.servnum'))->getField('CustName'),
                            "ipaddr" => I('post.serv_ip'),
                            "down_img" => '',
                            "commit_at" => date("Y-m-d H:i:s")
                        );
                        M('server_down_log')->add($downdata);
                    }if($action=="更换位置"){
                        //更新服务器
                        $servdata=array(
                            "IDCName" => I('post.idcname'),
                            "ShelfCode" => I('post.shelfcode')
                        );
                        M('servers')->where("ServNum='%s'",I('post.servnum'))->save($servdata);
                        //新增更换记录
                        $updata=array(
                            "svnid" => M('servers')->where("ServNum='%s'",I('post.servnum'))->getField('ID'),
                            "odnid" => M('servers')->where("ServNum='%s'",I('post.servnum'))->getField('Order_ID'),
                            "pre_data" => "原机柜：".I('post.preidcname').I('post.preshelfcode'),
                            "new_data" => "现机柜：".I('post.idcname').I('post.shelfcode'),
                            "remarks" => "原机柜：".I('post.preidcname').I('post.preshelfcode')."\n现机柜：".I('post.idcname').I('post.shelfcode'),
                            "ipaddr" => I('post.serv_ip'),
                            "logtype" => "更换位置",
                            "committer" => C("username"),
                            "commit_at" => date("Y-m-d H:i:s")
                        );
                        M('server_update_log')->add($updata);
                    }if($action=="带宽变更"||$action=="带宽纠错"){
                        //servers更改带宽
                        M('servers')->where("ServNum='%s'",I('post.servnum'))->setField("Bandwidth",I('post.bandwidth'));
                        //添加服务器更新记录->带宽变更
                        $updata=array(
                            "svnid" => M('servers')->where("ServNum='%s'",I('post.servnum'))->getField('ID'),
                            "odnid" => M('servers')->where("ServNum='%s'",I('post.servnum'))->getField('Order_ID'),
                            "pre_data" => "原带宽：".I('post.prebandwidth'),
                            "new_data" => "现带宽：".I('post.bandwidth'),
                            "remarks" => "原带宽：".I('post.prebandwidth')."\n现带宽：".I('post.bandwidth'),
                            "ipaddr" => I('post.serv_ip'),
                            "logtype" => "带宽变更",
                            "committer" => C("username"),
                            "commit_at" => date("Y-m-d H:i:s")
                        );
                        M('server_update_log')->add($updata);
                    }if($action=="上架"||$action=="添加IP"||$action=="更换IP"||$action=="更换IP重装Win系统"||$action=="更换IP重装Linux系统"||$action=="新上架"){
                        //判断ip是否被使用
                        $newip=I('post.newip');
                        $oldip=I('post.oldip');
                        $newipv6=I('post.newipv6');
                        if (!empty($newip)) {
                            $newiparr=explode('/',$newip);
                            $oldiparr=explode('/',$oldip);
                            foreach($newiparr as $val){
                                if($val!=''){
                                    $ishave=M('ips')->field('id')->where("ipaddr='%s' AND state=%d",$val,1)->find();
                                    if(!empty($ishave)&&(!in_array($val, $oldiparr))){
                                        $this->ajaxReturn($val.'已被使用请重新选择ip！');
                                    }
                                }
                            }
                            //更改服务器ip
                            $servdata=array(
                                "Serv_IP" => I('post.newip'),
                                "IPNum" => count(explode("/",I('post.newip')))-1,
                            );
                            M('servers')->where("ServNum='%s'",I('post.servnum'))->save($servdata);
                        }
                        if (!empty($newipv6)){
                            M('servers')->where("ServNum='%s'",I('post.servnum'))->setField("IPv6",$newipv6);
                        }
                        //添加更改ip记录
                        $updata=array(
                            "OldIP" => "IPv4".$oldip."\n"."IPv6".I('post.oldipv6'),
                            "NewIP" => "IPv4".$newip."\n"."IPv6".I('post.newipv6'),
                            "UpdateTime" => date("Y-m-d H:i:s"),
                            "Operator" => C("username"),
                            "Servers_ID" => M('servers')->where("ServNum='%s'",I('post.servnum'))->getField('ID')
                        );
                        M('servipupdatelog')->add($updata);
                        //更改ip状态
                        $preiparr=explode("/",$oldip);
                        $preipdata=array(
                            "state" => 0,
                            "server" => ''
                        );
                        foreach($preiparr as $val){
                            if(!empty($val)){
                                M('ips')->where("ipaddr='%s'",$val)->save($preipdata);
                                M('t_ips')->where("ip='%s'",$val)->setField("note","未占用/未分配");
                            }
                        }
                        $iparr=explode("/",$newip);
                        $ipdata=array(
                            "state" => 1,
                            "server" => I('post.servnum')
                        );
                        foreach($iparr as $val){
                            if(!empty($val)){
                                M('ips')->where("ipaddr='%s'",$val)->save($ipdata);
                                M('t_ips')->where("ip='%s'",$val)->setField("note","已占用/已分配");
                            }
                        }
                    }
                    if($action=="更换硬件"||$action=="更换硬件重装系统"||$action=="租用机器增减硬件"||$action=="托管机器增减硬件"||$action=="新上架"){
                        $newhwconfig=I('post.newhwconfig');
                        if (!empty($newhwconfig)) {
                            //服务器修改
                            M('servers')->where("ServNum='%s'",I('post.servnum'))->setField("Hwconfig",I('post.newhwconfig'));
                        }
                        //添加修改记录
                        $updata=array(
                            "svnid" => M('servers')->where("ServNum='%s'",I('post.servnum'))->getField('ID'),
                            "odnid" => M('servers')->where("ServNum='%s'",I('post.servnum'))->getField('Order_ID'),
                            "pre_data" => "原配置：".I('post.oldhwconfig'),
                            "new_data" => "现配置：".I('post.newhwconfig'),
                            "remarks" => "原配置：".I('post.oldhwconfig').'\n'."现配置：".I('post.newhwconfig'),
                            "ipaddr" => I('post.serv_ip'),
                            "logtype" => "服务器配置变更",
                            "committer" => C("username"),
                            "commit_at" => date("Y-m-d H:i:s")
                        );
                        M('server_update_log')->add($updata);
                    }
		    		//存入完成时间
		    		$data['complete_at']=date('Y-m-d H:i:s');
		    		self::talog($state,$problemdesc,$id);
	    			break;
		    	case 3://待验证->已解决
		    		self::talog('确认工单'.$state,$problemdesc,$id);
		    		break;
		    	//case 4://待审核
		   //  		$info=$tasksModel->field('complete_at,makesure_at,receive_at,recvdept,receiver,action,timelimit')->where("nid = %d",$nid)->find();
		   //  		$person=$accountsModel->field('dept,level')->where("realname = '%s'",$info['receiver'])->find();
		   //  		$level=$levelModel->field('coeff')->where("name = '%s'",$person['level'])->find();
		   //  		$process=$processModel->field('bonus')->where("name = '%s'",$info['action'])->find();
		   //  		$diff_c=floor((strtotime($info['complete_at'])-strtotime($info['makesure_at']))/60);
					// $diff_r=floor((strtotime($info['complete_at'])-strtotime($info['receive_at']))/60);
					// // 优: 1.3，中: 1，差: 0.5
					// $v_coeff = 1;

					// $data['total_use'] = $diff_r.'分钟';
					// // 距离开单时间小于限定时间，优
					// if ($diff_c < $info['timelimit']) {
					// 	$data['comp_state'] = "优";
					// 	$v_coeff = 1.3;
					// }
					// else if ($diff_r < $info['timelimit']) {
					// 	$data['comp_state'] = "中";
					// 	$v_coeff = 1;
					// }
					// else {
					// 	$data['comp_state'] = "差";
					// 	$v_coeff = 0.5;
					// }
					// //所有【受理部门为网络部，接单人为客服部】的单子，都为中
					// $str="";
					// if ($info['recvdept'] == '网络部' && $person['dept'] == '客服部') {
					// 	$str .= "【网络部工单系数调整】本来: ".$v_coeff;
					// 	$v_coeff = 1;
					// 	$str .= ",调为: ".$v_coeff;
					// 	$str .= ",";
					// }

					// $str_benlai="";
					// $str_zero="";
		   //  		if ($orderreset=="on") {//工单重置重置
		   //  			$str_benlai = ",【重置前】".$data['comp_state']."[".$v_coeff."]";
		   //  			$data['comp_state']="中";
		   //  			$v_coeff = 1;
		   //  		}
		   //  		$final_bonus = round($level['coeff'] * $process['bonus'] * $v_coeff * 100) / 100;
					// $data['bonus'] = $final_bonus;

		   //  		if ($zero=="on") {//奖金清零
		   //  			$str_zero = ",【奖金清零】";
		   //  			$data['bonus']=0;
		   //  		}

		   //  		$str .= "距开单时间：".$diff_c."分钟,";
					// $str .= "距接单时间：".$diff_r."分钟,";
					// $str .= "奖金：".$process['bonus'].",等级系数: ".$level['coeff'].",完成状态:".$data['comp_state']."[".$v_coeff."]".$str_benlai.$str_zero;
					// $data['bonus_desc'] = $str;

        //             $data=self::bonus($nid);
        //             print_r($data);exit;

		    		// self::talog('确认工单通过审核',$problemdesc,$id);
		    		// break;
                case 5://带宽确认
                    if($action=="上架"||$action=="上架转让"){
                        //修改截图
                        M('tasks')->where("id='%s'",$id)->setField("pic",I('post.pic'));
                        //修改带宽
                        M('servers')->where("ServNum='%s'",I('post.servnum'))->setField("Bandwidth",I('post.bandwidth'));
                    }
                    self::talog('带宽确认',$problemdesc,$id);
                    break;
                case 6://财务确认
                    self::talog('财务确认',$problemdesc,$id);
                    break;
                case 8://库管确认
                    self::talog('库管确认',$problemdesc,$id);
                    break;
                case 9://放回处理
                    $data['receiver']='';//清空指派人
                    $data['receive_at']='';
                    self::talog('放回处理',$problemdesc,$id);
                    break;
                case 10://废弃
                    self::talog('废弃',$problemdesc,$id);
                    break;
	    		default:
	    			self::talog($state,$problemdesc,$id);
	    			break;
	    	}
		    $tasksModel->where("nid=%d",$nid)->save($data);
            if (!empty($ips)) {
                $ipsModel=M("t_ips");
                $ips=explode("/", $ips);
                array_pop($ips);
                foreach ($ips as $k => $ip) {
                    $data['note'] = '已占用/已分配';
                    $ipsModel->where("ip= '%s'",$ip)->save($data);
                }
            }
            if ($type==0) {
                //处理确认->返回所属机房
                $info=$tasksModel->field('room')->where("nid=%d",$nid)->find();
                echo json_encode($info['room']);
                exit;
            }elseif($type==1){
                //指派工单->返回指派员工姓名
                echo json_encode($receiver);
                exit;
            }else{
		        echo json_encode(0);
			    exit;
            }
		}
    }

    static function bonus($nid)
    {
        $tasksModel=M('tasks');
        $accountsModel=M('accounts');
        $processModel=M('process');
        $levelModel=M('level');
        $info=$tasksModel->field('complete_at,makesure_at,receive_at,recvdept,receiver,action,timelimit')->where("nid = %d",$nid)->find();
        $person=$accountsModel->field('dept,level')->where("realname = '%s'",$info['receiver'])->find();
        $level=$levelModel->field('coeff')->where("name = '%s'",$person['level'])->find();
        $process=$processModel->field('bonus')->where("name = '%s'",$info['action'])->find();
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
        if ($orderreset=="on") {//工单重置重置
            $str_benlai = ",【重置前】".$data['comp_state']."[".$v_coeff."]";
            $data['comp_state']="中";
            $v_coeff = 1;
        }
        $final_bonus = round($level['coeff'] * $process['bonus'] * $v_coeff * 100) / 100;
        $data['bonus'] = $final_bonus;

        if ($zero=="on") {//奖金清零
            $str_zero = ",【奖金清零】";
            $data['bonus']=0;
        }

        $str .= "距开单时间：".$diff_c."分钟,";
        $str .= "距接单时间：".$diff_r."分钟,";
        $str .= "奖金：".$process['bonus'].",等级系数: ".$level['coeff'].",完成状态:".$data['comp_state']."[".$v_coeff."]".$str_benlai.$str_zero;
        $data['bonus_desc'] = $str;
        return $data;
    }

    public function confirmserverAction()
    {
        $type=I('type/d',0);//0问题处理 1下架 2服务器转让
        $sid=I('sid');//服务器id
        $serverModel=D('Servers');
        $serverinfo=$serverModel->where("ID = %d",$sid)->find();
        $this->assign("serverinfo",$serverinfo);
        $this->assign('sid',$sid);
        $this->assign('type',$type);
        $this->display();
    }

    public function serveraddAction()
    {
        $svid=I('svid/s');
        $stype=I('stype/d');//0问题处理 1下架 2服务器转让
        $ordernum=I('ordernum/s');
        $priority=I('priority/s');
        $recvdept=I('recvdept/s');
        $action=I('action/s');
        $action=explode('_', $action);
        $action=$action[0];
        $timelimit=I('timelimit/d');
        $ddnid=I('ddnid');
        $ordernum=I('ordernum');
        $problemdesc=I('problemdesc/s');
        $room=I('room/s');
        $ip=I('ip/s');
        $cid=I('cid/d');
        $cname=I('cname/s');
        $id='GD'.date('YmdHis').rand(100,999);
        $bid='BN'.date('YmdHis').rand(100,999);
        $type=0;
        $type2="";
        switch ($stype) {
            case 0:
                $type2="问题处理";
                $type=3;
                break;
            case 1:
                $type2="下架单";
                $type=2;
                break;
            case 2:
                $type2="服务器转让";
                $type=4;
                break;
        }
        $data=array(
            "id"=>$id,
            "batchid"=>$bid,
            "batchnum"=>1,//默认为1
            "state"=>$action=="下架转让"?"已解决[下转]":'待确认',
            "priority"=>$priority,
            "priority_num"=>$priority=="正常"?0:($priority=="优先"?1:2),
            "recvdept"=>$recvdept,
            "problemdesc"=>$problemdesc,
            "action"=>$action,
            "timelimit"=>$timelimit,
            "type"=>$type,
            "type2"=>$type2,
            "title"=>"",
            "room"=>$room,
            "ddbh"=>$ordernum,
            "svid"=>$svid,
            "ipaddr"=>$ip,
            "cid"=>$cid,
            "cname"=>$cname,
            "ddnid"=>$ddnid
        );
        //print_r($data);exit;
        $tasksModel=M('tasks');
        if($tasksModel->create($data)){
            // if (!empty($nid)) {
            //     $tasksModel->where("nid=%d",$nid)->save($data);
            //     //增加记录
            //     self::log("修改");
            //     self::talog('修改工单',$problemdesc,$id);
            // }
            // else
            // {
                $data["committer"]=C("username");//提交人
                $data["commit_at"]=date('Y-m-d H:i:s');//提交时间
                $data["expire_at"]=date('Y-m-d H:i:s',strtotime("+".$timelimit." minute"));
                $tasksModel->add($data);
                //增加记录
                self::log("提交");
                self::talog('创建工单',$problemdesc,$id);
                if($action=="订单转让"||$action=="上架转让"||$action=="下架转让"){
                    //更改服务器信息
                    $orderinfo=M('orders')->field('id,cid,prodcat')->where("nid=%d",$ddnid)->find();
                    $custinfo=M('clients')->field('name,contact,tel')->where("id=%d",$orderinfo['cid'])->find();
                    $servdata=array(
                        "OrderNum" => $orderinfo['id'],
                        "CustName" => $custinfo['name'],
                        "CustTech" => $custinfo['contact'],
                        "CustTel" => $custinfo['tel'],
                        "Customer_ID" => $orderinfo['cid'],
                        "Order_ID" => $ddnid,
                        "Productkind" => $orderinfo['prodcat'],
                    );
                    M('servers')->where("ServNum='%s'",$svid)->save($servdata);
                    //添加变更记录
                    $trsdata=array(
                        "svnid" => I('post.id'),
                        "pre_o_nid" => I('post.orderid'),
                        "new_o_nid" => $ddnid,
                        "pre_cname" => I('post.cname'),
                        "new_cname" => $custinfo['name'],
                        "committer" => C("username"),
                        "commit_at" => date("Y-m-d H:i:s")
                    );
                    M('server_transfer_log')->add($trsdata);
                    //更改工单记录
                    $taskdata=array(
                        "receiver" => C("username"),
                        "receive_at" => date("Y-m-d H:i:s"),
                        "complete_at" => date("Y-m-d H:i:s"),
                        "makesure" => $username,
                        "makesure_at" => date('Y-m-d H:i:s')
                    );
                    if(M('tasks')->where("id='%s'",$id)->save($taskdata)){
                        //算钱
                        $nid=M('tasks')->where("id='%s'",$id)->getField('nid');
                        $bnsdata=self::bonus($nid);
                        M('tasks')->where("id='%s'",$id)->save($bnsdata);
                    }
                }
            //}
            echo json_encode(0);
            exit;
        }
    }

    //新上架
    public function newgroundingAction()
    {
        $id=I('id');//订单id
        $orderModel=M('orders');
        $orderinfo=$orderModel->where("nid = %d",$id)->find();
        $this->assign("orderinfo",$orderinfo);
        //客户信息
        $clientsModel=M('clients');
        $userinfo=$clientsModel->where("id = %d",$orderinfo['cid'])->find();
        $this->assign("userinfo",$userinfo);
        $this->assign('nid',$id);
        $this->display();
    }

    public function groundingAction()
    {
        $batchnum=I('batchnum/d',1);
        $priority=I('priority/s');
        $recvdept=I('recvdept/s');
        $room=I('room/s');
        $problemdesc=I('problemdesc/s');
        $action=I('action/s');
        $action=explode('_', $action);
        $action=$action[0];
        $timelimit=I('timelimit/d');
        $id='GD'.date('YmdHis').rand(100,999);
        $bid='BN'.date('YmdHis').rand(100,999);
        $ddbh=I('ddbh/s');
        $cid=I('cid/d');
        $cname=I('cname/s');
        $tasksModel=M('tasks');
        for ($i=1; $i <= $batchnum; $i++) {
            $data=array(
                "id"=>$batchnum==1?$id:$id.'_'.$i,
                "batchid"=>$bid,
                "batchnum"=>$batchnum,//默认为1
                "title"=>"",
                "state"=>'待确认',
                "priority"=>$priority,
                "priority_num"=>$priority=="正常"?0:($priority=="优先"?1:2),
                "recvdept"=>$recvdept,
                "problemdesc"=>$problemdesc,
                "action"=>$action,
                "timelimit"=>$timelimit,
                "type"=>1,
                "type2"=>'上架单',
                "room"=>$room,
                "ddbh"=>$ddbh,
                "cid"=>$cid,
                "cname"=>$cname
            );
            if($tasksModel->create($data)){
                $data["committer"]=C("username");//提交人
                $data["commit_at"]=date('Y-m-d H:i:s');//提交时间
                $data["expire_at"]=date('Y-m-d H:i:s',strtotime("+".$timelimit." minute"));
                $tasksModel->add($data);
                //增加记录
                self::log("提交");
                self::talog('上架单',$problemdesc,$id);
            }
        }
        echo json_encode(0);
        exit;
    }

    //页面首次加载所在机房列表
    public function roomlstAction()
    {
    	$roomsModel=M('rooms');
        $rooms=$roomsModel->select();
        echo json_encode($rooms);
        exit;
    }

    //页面首次加载处理方式列表
    public function actionlstAction()
    {
        $type=I('type/d',0);//0问题处理 1下架 2服务器转让
        switch ($type) {
            case 0:
                $type="问题处理";
                $dep="技术部";//默认
                break;
            case 1:
                $type="下架单";
                $dep="技术部";
                break;
            case 2:
                $type="服务器转让";
                $dep="客服部";
                break;
            case 3:
                $type="上架单";
                $dep="技术部";
                break;
        }
        $dept=I('dept/s');
        $dept=empty($dept)?$dep:$dept;
    	$actionModel=M('process');
    	//初始加载技术部的处理方式
        $action=$actionModel->field('name,timelimit')->where("dept ='%s' AND type ='%s'",array($dept,$type))->select();
        echo json_encode($action);
        exit;
    }
    //服务器上架
    public function upshelfAction(){
        $nid=I("nid");
        $type=I("type");
        //工单信息
        $tasksModel=M('tasks');
		$tasks=$tasksModel->where("nid = %d",$nid)->find();
		$this->assign("tasks",$tasks);
		$talogs=M('talogs');
		$talog=$talogs->where("tid = '%s'",$tasks['id'])->select();
		$this->assign("talog",$talog);
		$this->assign('nid',$nid);
        $this->assign('type',$type);
        //上架信息
        $tasklist=M('tasks')->field('id,ddbh')->where("nid=%d",$nid)->find();
        $orderlist=M('orders')->field('cname,prodcat,salesman,nid,cid')->where("id='%s'",$tasklist['ddbh'])->find();
        $clientlist=M('clients')->field('contact,tel')->where("id=%d",$orderlist['cid'])->find();
        $roomlist=M('rooms')->getField('id,name');
        $this->assign("tasklist",$tasklist);
        $this->assign("orderlist",$orderlist);
        $this->assign("roomlist",$roomlist);
        $this->assign("clientlist",$clientlist);
        $this->display();
    }
    public function upconfirmAction(){
        $data=M('servers')->create();
        $ipnum=count(explode('/',$data['Serv_IP']));
        $data['IPNum']=$ipnum-1;
        $data['ForbidDown']=0;
        $data['ServState']="在线运行";
        $data['InsertTime']=date("Y-m-d H:i:s");
        //完善工单信息
        $taskdata=array(
            "state" => "已解决",
            "svid" => $data['ServNum'],
            "ipaddr" => $data['Serv_IP'],
            "complete_at" => date("Y:m:d H:i:d"),
        );
        //增加操作记录
        $taskid=M('tasks')->where("nid=%d",I('nid'))->getField('id');
        self::talog('上架回复',I('problemdesc/s'),$taskid);
        //修改机柜服务器数量
        $s_num=M('cabinets')->where("room='%s' AND code='%s'",$data['IDCName'],$data['ShelfCode'])->getField("s_num");
        M('cabinets')->where("room='%s' AND code='%s'",$data['IDCName'],$data['ShelfCode'])->setField("s_num",$s_num+1);
        //更改ip状态
        $iparr=explode("/",$data["Serv_IP"]);
        $ipdata=array(
            "state" => 1,
            "server" => $data["ServNum"]
        );
        foreach($iparr as $val){
            if(!empty($val)){
                M('ips')->where("ipaddr='%s'",$val)->save($ipdata);
                M('t_ips')->where("ip='%s'",$val)->setField("note","已占用/已分配");
            }
        }
        //存入servers
        if(M('tasks')->where("nid=%d",I('nid'))->save($taskdata)){
            if(M('servers')->add($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }else{
            $this->ajaxReturn(1);
        }
    }
    //操作后跳转到原页面
    public function originalAction()
    {
        $username=C("username");
        $state=I('state/s');
        $tasksModel=M('tasks');
        switch ($state) {
            case '处理中':
                $map['state']=$state;
                $map['receiver']=$username;
                break;
            case '待处理':
                $map['state']=array(array('eq','待处理'),'处理中','or');
                break;
            case '库管确认':
                $map['state']=array(array('eq','已解决[下转]'),array('eq','已解决[涉硬]'),'已下架','or');
                break;
            default:
                $map['state']=$state;
                break;
        }
        $tasks=$tasksModel->where($map)->order('nid desc')->select();

        $username=C("username");
        $state=I('state/s');
        $tasksModel=M('tasks');
        foreach ($tasks as $k => $val) {
            //日期格式化
            $ra=strstr($val['receive_at'],'T')?str_replace('T',' ',$val['receive_at']):$val['receive_at'];//受理时间
            $ra=explode('.', $ra);
            $ca=strstr($val['commit_at'],'T')?str_replace('T',' ',$val['commit_at']):$val['commit_at'];//提交时间
            $ca=explode('.', $ca);
            $tasks[$k]['receive_at']=$ra[0];
            $tasks[$k]['commit_at']=$ca[0];
            //查询超时状态
            if (empty($val['receive_at'])) {
                $tasks[$k]['overtime']="未超时";
            }
            else
            {
                if (date("Y-m-d H:i:s",strtotime($ra[0])+$val['timelimit']*60)>date("Y-m-d H:i:s")) {
                    $tasks[$k]['overtime']="未超时";
                }else{
                    $tasks[$k]['overtime']="超时";
                }
            }
        }
        $this->assign("orderinfo",$tasks);
        $this->assign("state",$state);
        $this->display();
    }

    //随机选择ip
    public function selipAction()
    {
        $datatype=I('datatype/d',0);
        //<!--普通电信空闲IP -->
        $ptdx[]="218.93.206";
        $ptdx[]="218.93.207";
        $ptdx[]="218.93.208";
        $ptdx[]="222.187.220";
        $ptdx[]="222.187.221";
        $ptdx[]="222.187.222";
        $ptdx[]="222.187.223";
        $ptdx[]="222.187.224";
        $ptdx[]="222.187.227";
        $ptdx[]="222.187.232";
        $ptdx[]="222.187.239";
        $ptdx[]="222.187.254";
        $ptdx[]="61.147.247";
        $ptdx[]="180.101.45";
        $ptdx[]="222.187.238";
        //<!--普通电信阻断国外空闲IP -->
        $ptdxzdgw[]="180.101.75";
        //<!--普通移动空闲IP -->
        $ptyd[]="221.131.165";
        $ptyd[]="221.181.185";
        //<!--普通联通空闲IP -->
        $ptlt[]="122.195.200.";
        $ptlt[]="153.36.236.";
        $ptlt[]="153.36.232.";
        $ptlt[]="153.36.233.";
        $ptlt[]="153.36.240.";
        $ptlt[]="153.36.242.";
        //<!--高防电信空闲IP -->
        $gfdx[]="180.101.72";
        //<!--高防联通空闲IP -->
        $gflt[]="103.205.252.";
        //<!--普通BGP空闲IP -->
        $ptbgp[]="43.241.48";
        $ptbgp[]="103.37.45";
        //<!--中防BGP空闲空闲IP（京东专用） -->
        $zfbgp[]="43.248.189";
        //<!--高防BGP空闲IP -->
        $gfbgp[]="103.239.244.";
        $gfbgp[]="43.241.50.";
        
        try {
            $w="WHERE `note` = '未占用/未分配' AND (";
            switch ($datatype) {
                case 0://普通电信IP
                    foreach ($ptdx as $d){
                        $w=$w."ip LIKE '$d%' OR ";
                    }
                    break;
                case 1://普通电信阻断国外IP
                    foreach ($ptdxzdgw as $d){
                        $w=$w."ip LIKE '$d%' OR ";
                    }
                    break;
                case 2://普通移动IP
                    foreach ($ptyd as $d){
                        $w=$w."ip LIKE '$d%' OR ";
                    }
                    break;
                case 3://普通联通IP
                    foreach ($ptlt as $d){
                        $w=$w."ip LIKE '$d%' OR ";
                    }
                    break;
                case 4://高防电信(阻断国外)IP
                    foreach ($gfdx as $d){
                        $w=$w."ip LIKE '$d%' OR ";
                    }
                    break;
                case 5://高防联通(阻断国外)IP
                    foreach ($gflt as $d){
                        $w=$w."ip LIKE '$d%' OR ";
                    }
                    break;
                case 6://普通BGP(无防御)IP
                    foreach ($ptbgp as $d){
                        $w=$w."ip LIKE '$d%' OR ";
                    }
                    break;
                case 7://100G BGP空闲(不封国外，京东专用)IP
                    foreach ($zfbgp as $d){
                        $w=$w."ip LIKE '$d%' OR ";
                    }
                    break;
                case 8://高防BGP(阻断国外)IP
                    foreach ($gfbgp as $d){
                        $w=$w."ip LIKE '$d%' OR ";
                    }
                    break;
            }
            $w=trim($w,'OR ').")";
            $s="SELECT ip FROM t_ips $w ORDER BY rand() LIMIT 1";
            $a=M('t_ips')->query($s);
            echo json_encode($a[0][ip]);
            exit; 
        } catch (Exception $e) {
            echo json_encode(1);
            exit;
        } 
    }

    public function myrecordAction(){
    	$this->display();
    }

    //操作记录
    static function log($method)
    {
    	$logs=M('logs');
    	$data=array(
    		"module"=>"工单",
    		"method"=>$method,
    		"account"=>C("name"),//操作人账号session
    		"realname"=>C("username"),//操作人姓名session
    		"ipaddr"=>$_SERVER["REMOTE_ADDR"],
    		"operate_at"=>time()
    	);
    	$logs->add($data);
    }

    //工单操作记录
    static function talog($act,$msg,$id,$receiver='')
    {
    	$talogs=M('talogs');
    	$data=array(
    		"tid"=>$id,
    		"name"=>empty($receiver)?C("username"):$receiver,//操作人姓名session (指派状态下为指派人姓名)
    		"act"=>$act,
    		"msg"=>$msg,
    		"ip"=>$_SERVER["REMOTE_ADDR"],
    		"tm"=>time()
    	);
    	$talogs->add($data);
    }

    public function numAction()
    {
    	$username=C("username");
        $rooms=C("rooms");
        $rooms=trim($rooms,']');
        $rooms=trim($rooms,'[');
        $dept=C("dept");
        $where['receiver'] =array('exp','is null OR receiver=""');
        $wait['_complex'] = $where;
        $wait['state']='待处理';
        $wait['recvdept']=$dept;
        if ($dept=="技术部") {
            $wait['room'] = array('exp',"IN (".$rooms.")");
        }elseif ($dept=="客服部"||$dept=="网络部") {
            $wait['recvdept']="网络部";
        }
        $w=self::selectnum($wait);//新工单数量

    	$pool['state']=array(array('eq','待处理'),'处理中','or');
    	$p=self::selectnum($pool);//工单池数量

    	$process['state']='处理中';
    	$process['receiver']=$username;
    	$s=self::selectnum($process);//处理中数量

    	$confirmed['state']='待确认';
    	$c=self::selectnum($confirmed);//待确认数量

    	$resolved['state']='已解决';
    	$r=self::selectnum($resolved);//待验证数量

    	$verified['state']='已验证';
    	$v=self::selectnum($verified);//带宽确认数量

    	$finance['state']='待财务确认';
    	$f=self::selectnum($finance);//财务确认数量

    	// $audited['state']='待审核';
    	// $a=self::selectnum($audited);//待审核数量

    	$position['state']='上架位置确认';
    	$n=self::selectnum($position);//上架位置确认数量

    	$storehouse['state']=array(array('eq','已解决[下转]'),array('eq','已解决[涉硬]'),'已下架','or');
    	$h=self::selectnum($storehouse);//库管数量

    	$unsolved['state']='未解决';
    	$u=self::selectnum($unsolved);//未解决数量

    	$num=array("w"=>$w,"p"=>$p,"s"=>$s,"c"=>$c,"r"=>$r,"v"=>$v,"f"=>$f,"n"=>$n,"h"=>$h,"u"=>$u);
    	echo json_encode($num);
        exit();
    }

    public function setivAction()
    {
        $rooms=C("rooms");
        $rooms=trim($rooms,']');
        $rooms=trim($rooms,'[');
        $dept=C("dept");
        $where['receiver'] =array('exp','is null OR receiver=""');
        $wait['_complex'] = $where;
        $wait['state']='待处理';
        $wait['recvdept']=$dept;
        if ($dept=="技术部") {
            $wait['room'] = array('exp',"IN (".$rooms.")");
        }elseif ($dept=="客服部"||$dept=="网络部") {
            $wait['recvdept']="网络部";
        }
        $w=self::selectnum($wait);//新工单数量
        echo json_encode($w);
        exit();
    }

    static function selectnum($w)
    {
    	$tasksModel=M('tasks');
    	$c=$tasksModel->where($w)->count();
    	return $c;
    }
}