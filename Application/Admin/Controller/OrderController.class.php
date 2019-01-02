<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends BaseController {
    //list
    public function listAction(){
        $sc=I('sc/s','nid desc');
        $sc=str_replace("+"," ",$sc);
        $key=I('keyword/s','');
        $where=array(
            "id" => array('like','%'.$key.'%'),
            "nid" => array('eq',$key),
            "cname" => array('like','%'.$key.'%'),
            "salesman" => array('like','%'.$key.'%'),
            "propertyof" => array('like','%'.$key.'%'),
            "ipaddr" => array('like','%'.$key.'%'),
            "preroom" => array('like','%'.$key.'%'),
            "prodcat" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        if(strpos($key,'.')){
            $oids=M('servers')->field("Order_ID")->where(array("Serv_IP"=>array('like','%'.$key.'%'),"ServState"=>"在线运行"))->group("Order_ID")->select();
            $orderlist=array();
            foreach($oids as $val){
                $nid=$val['order_id'];
                if($nid){
                    $odl=M('orders')->where("nid=%d AND status<>'%s'",$nid,"已注销")->find();
                    if($odl){
                        array_push($orderlist,$odl);
                    }
                }
            }
            foreach ($orderlist as $k=>$val) {
                $iplist=M('servers')->field('Serv_IP')->where("ServState='%s' AND Order_ID=%d","在线运行",$val['nid'])->select();
                $ipaddr="";
                foreach($iplist as $val2){
                    $ipaddr.=$val2['serv_ip'];
                }
                $orderlist[$k]['ipaddr']=$ipaddr;
            }
            $this->assign("key",$key);
            $this->assign("perm",C('perm'));
            $this->assign("orderlst",$orderlist);
            $this->display();exit;
        }
        $map=array(
            "_complex" => $where,
            "status" => array("neq","已注销"),
        );
        $salesman=I('salesman/s');
        $cname=I('cname/s');
        $order_begin_at=I('order_begin_at/s');
        $order_end_at=I('order_end_at/s');
        $status=I('status/s');
        $paycycle=I('paycycle/s');
        $prodcat=I('prodcat/s');
        $preroom=I('preroom/s');
        if(!empty($salesman)){
            $map['salesman']=I('salesman/s');
            $this->assign("salesman",I('salesman/s'));
        }
        if(!empty($cname)){
            $map['cname']=str_replace("+"," ",I('cname/s'));
            $this->assign("cname",str_replace("+"," ",I('cname/s')));
        }
        if(!empty($order_begin_at)){
            $map['order_begin_at']=array('like','%'.I('order_begin_at/s').'%');
            $this->assign("order_begin_at",I('order_begin_at/s'));
        }
        if(!empty($order_end_at)){
            $map['order_end_at']=array('like','%'.I('order_end_at/s').'%');
            $this->assign("order_end_at",I('order_end_at/s'));
        }
        if(!empty($status)){
            $map['status']=I('status/s');
            $this->assign("status",I('status/s'));
        }
        if(!empty($paycycle)){
            $map['paycycle']=I('paycycle/s');
            $this->assign("paycycle",I('paycycle/s'));
        }
        if(!empty($prodcat)){
            $map['prodcat']=I('prodcat/s');
            $this->assign("prodcat",I('prodcat/s'));
        }
        if(!empty($preroom)){
            $map['preroom']=I('preroom/s');
            $this->assign("preroom",I('preroom/s'));
        }

        //读取缓存
        S(array('type'=>'redis','host'=>'127.0.0.1','port'=>'6379','prefix'=>'redis_','expire'=>10800));
        if (empty($key)&&empty($salesman)&&empty($cname)&&empty($order_begin_at)&&empty($order_end_at)&&empty($status)&&empty($paycycle)&&empty($prodcat)&&empty($preroom)) {
            $count = S('orders_count');
            if (empty($count)) {
                $newcount=M('orders')->where($map)->count();
                $count = S('orders_count',$newcount);
            }
            $countarr = S('countarr');
            if (empty($countarr)) {
                $ctarr=array(
                    "zj" => M('orders')->where($map)->sum("money"),
                    "ysx" => M('orders')->where($map)->where("status='已生效'")->sum("money"),
                    "wsx" => M('orders')->where($map)->where("status='未生效'")->sum("money"),
                    "dsh" => M('orders')->where($map)->where("status='待审核'")->sum("money"),
                    "yzx" => M('orders')->where($map)->where("status='已注销'")->sum("money"),
                );
                $countarr = S('countarr',$ctarr);
            }
        }else{
            $count=M('orders')->where($map)->count();
            $countarr=array(
                "zj" => M('orders')->where($map)->sum("money"),
                "ysx" => M('orders')->where($map)->where("status='已生效'")->sum("money"),
                "wsx" => M('orders')->where($map)->where("status='未生效'")->sum("money"),
                "dsh" => M('orders')->where($map)->where("status='待审核'")->sum("money"),
                "yzx" => M('orders')->where($map)->where("status='已注销'")->sum("money"),
            );
        }

        $roomlist = S('roomlist');
        if (empty($roomlist)) {
            $rmlist=M('rooms')->getField('id,name');
            $roomlist = S('roomlist',$rmlist);
        }
        $pdtkindlist = S('pdtkindlist');
        if (empty($pdtkindlist)) {
            $categories=M('categories')->select();
            $pdtkindlist = S('pdtkindlist',$categories);
        }

        $p = getpage($count,15);
        $p->parameter['keyword'] = $key;
        $show = $p->show();
        $orderlst=M('orders')->limit($p->firstRow.','.$p->listRows)->where($map)->order($sc)->select();
        foreach ($orderlst as $k => $val) {
            $ca=strstr($val['order_end_at'],'T')?str_replace('T',' ',$val['order_end_at']):$val['order_end_at'];
            $ca=explode(' ', $ca);
            $orderlst[$k]['order_end_at']=$ca[0];
            $iplist=M('servers')->field('Serv_IP')->where("ServState='%s' AND Order_ID=%d","在线运行",$val['nid'])->select();
            $ipaddr="";
            foreach($iplist as $val2){
                $ipaddr.=$val2['serv_ip'];
            }
            $orderlst[$k]['ipaddr']=$ipaddr;
        }
        //销售人员
        $sales=M('accounts')->field('realname')->where("dept='%s' AND isleave='%s'",'销售部','false')->select();
        $this->assign("sales",$sales);
        $this->assign("roomlist",$roomlist);
        $this->assign("pdtkindlist",$pdtkindlist);
        $this->assign("count",$count);
        $this->assign("page",$show);
        $this->assign("orderlst",$orderlst);
        $this->assign("cname",I('cname/s'));
        $this->assign("countarr",$countarr);
        $this->assign("perm",C('perm'));
        $this->assign("sc",$sc);
        $this->assign("key",$key);
        $this->display();
    }

    //view
    public function viewAction(){
        $nid=I('nid/d');
        $orderinfo=M('orders')->where("nid=%d",$nid)->find();
        $servinfo=M('servers')->where("Order_ID=%d",$nid)->select();
        $orderinfo['qq']=M('clients')->where("id=%d",$orderinfo['cid'])->getField('qq');
        $orderinfo['cellphone']=M('clients')->where("id=%d",$orderinfo['cid'])->getField('cellphone');
        $finanlst=M('finances')->where("id='%s'",$orderinfo['id'])->order('nid desc')->select();
        $this->assign("orderinfo",$orderinfo);
        $this->assign('servinfo',$servinfo);
        $this->assign('finanlst',$finanlst);
        $this->display();
    }

    //edit
    public function editAction(){
        $nid=I('nid/d');
        //服务器信息
        $roomlist=M('rooms')->getField('id,name');
        $pdtkindlist=M('categories')->select();
        if(IS_POST){
            $data=M('orders')->create();
            //修改服务器信息
            M('servers')->where("OrderNum='%s'",$data['id'])->setField("Productkind",$data['prodcat']);
            //修改订单信息
            $prodlist=I('post.prodlist');
            if (!empty($prodlist)) {
            	$data["prodlist"]=htmlspecialchars_decode($prodlist);
            }
            if(M('orders')->save($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $orderinfo=M('orders')->where("nid=%d",$nid)->find();
        $this->assign("orderinfo",$orderinfo);
        $this->assign("roomlist",$roomlist);
        $this->assign("pdtkindlist",$pdtkindlist);
        $this->display();
    }

    //新增财务记录
    public function add_payAction(){
        $id=I('id/d');
        if(IS_POST){
        	if (I('withhold')=="on") {
            	//先查询预付款余额是否充足
            	$prepay=I('prepays');
            	if ($prepay>I('money')) {
            		//说明钱够啊 开始扣费
                    $reduce=round($prepay-I('money'),2);
                    M('clients')->where("id=%d",I('cid'))->setField('prepay',$reduce);
                    //存入使用记录表
                    $pldata=array(
                        "cid" => I('cid'),
                        "money" => I('money'),
                        "fid" => I('ddid'),
                        "remark" => I('remark'),
                        "committer" => C('username'),
                        "create_at" => date("Y-m-d H:i:s"),
                    );
                    M('prepaylog')->add($pldata);
            	}else{
            		echo json_encode(2);
	            	exit;
            	}	
            }
            $data=array(
	    		"id"=>I('ddid'),//订单编号
	    		"type"=>I('type'),
	    		"state"=>I('state'),
	    		"money"=>I('money'),
	    		"cid"=>I('cid'),
	    		"cname"=>I('cname'),
	    		"recvtype"=>I('recvtype'),
	    		"receipt"=>I('receipt'),
	    		"paycycle"=>I('paycycle'),
	    		"fee_begin_at"=>I('fee_begin_at'),
	    		"fee_end_at"=>I('fee_end_at'),
	    		"bank_recv_at"=>I('bank_recv_at'),
	    		"ipaddr"=>I('ip'),
	    		"salesman"=>I('salesman'),
	    		"remark"=>I('remark'),
	    		"committer"=>C("username"),
                "create_at"=>date("Y-m-d H:i:s"),
            );
            M('orders')->where("id='%s'",I('ddid'))->save(array("isnew"=>0,"fstate"=>"款到确认"));
            
            $financesModel=M('finances');
	        if($financesModel->create($data)){
                if($financesModel->add($data)){
                    self::uppaydata(I('cid'));
                    echo json_encode(0);
                    exit;
                }
	        }else{
	        	echo json_encode(1);
	            exit;
	        }
        }
        $orderinfo=M('orders')->where("nid=%d",$id)->find();
        $this->assign("orderinfo",$orderinfo);
        //根据cid获取客户预付款余额
        $prepay=M('clients')->where("id=%d",$orderinfo['cid'])->getField("prepay");
        $this->assign("prepay",$prepay);
        //默认费用开始日期和银行款到日期为当天
        $bank_recv_at=date("Y-m-d");
        $fee_begin_at=substr($orderinfo['order_end_at'],0,10);
        //费用结束时间
        switch ($orderinfo['paycycle']) {
        	case '月付':
        		$fee_end_at=date("Y-m-d",strtotime("+1 month",strtotime($fee_begin_at)));
        		break;
        	case '季付':
        		$fee_end_at=date("Y-m-d",strtotime("+3 month",strtotime($fee_begin_at)));
        		break;
        	case '半年付':
        		$fee_end_at=date("Y-m-d",strtotime("+6 month",strtotime($fee_begin_at)));
        		break;
        	case '年付':
        		$fee_end_at=date("Y-m-d",strtotime("+12 month",strtotime($fee_begin_at)));
        		break;
        }
        $this->assign("bank_recv_at",$bank_recv_at);
        $this->assign("fee_begin_at",$fee_begin_at);
        $this->assign("fee_end_at",$fee_end_at);
        $this->assign("cid",$cid);
        $this->display();
    }
    //getdate
    public function getdateAction(){
        $paycycle=I("post.paycycle");
        $fee_begin_at=I("post.fee_begin_at");
        switch($paycycle){
            case "月付":$paycycle=1;break;
            case "季付":$paycycle=3;break;
            case "半年付":$paycycle=6;break;
            case "年付":$paycycle=12;break;
        }
        $fee_end_at=date("Y-m-d",strtotime("+".$paycycle."month",strtotime($fee_begin_at)));
        $this->ajaxReturn($fee_end_at);
    }
    //add_order
    public function add_orderAction(){
        //订单信息
        $name=I('name/s');
        $salesman=I('salesman/s');
        $orderno='DD'.time();
        //服务器信息
        $roomlist=M('rooms')->getField('id,name');
        $pdtkindlist=M('categories')->select();
        
        $this->assign("name",$name);
        $this->assign("orderno",$orderno);
        $this->assign("salesman",$salesman);
        $this->assign("roomlist",$roomlist);
        $this->assign("pdtkindlist",$pdtkindlist);
        $this->display();
    }

    //remove
    public function removeAction(){
        $nid=I('post.nid');
        $ddbh=M('orders')->where("nid=%d",$nid)->getField('id');
        $where=array(
            "ddbh" => $ddbh,
            "action" => '上架',
        );
        if(M('tasks')->where($where)->where("state<>'关闭' AND state<>'废弃'")->select()){
            $this->ajaxReturn('该订单正在上架');
        }else if(M('orders')->where("nid=%d",$nid)->setField("status","已注销")){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
    //recover
    public function recoverAction(){
        $nid=I('post.nid');
        if(M('orders')->where("nid=%d",$nid)->setField("status","已生效")){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
    //census
    public function censusAction(){
        $key=I('key/s','');
        $map=array(
            "create_at"=>array('like',$key.'%'),
            "status"=>"已生效"
        );
        $data=array(
            array(
                "paycycle"=>"月付",
                "num"=>M('orders')->where($map)->where("paycycle='月付'")->count(),
                "total"=>M('orders')->where($map)->where("paycycle='月付'")->sum('money'),
                "average"=>round(M('orders')->where($map)->where("paycycle='月付'")->sum('money'),2)
            ),
            array(
                "paycycle"=>"季付",
                "num"=>M('orders')->where($map)->where("paycycle='季付'")->count(),
                "total"=>M('orders')->where($map)->where("paycycle='季付'")->sum('money'),
                "average"=>round(M('orders')->where($map)->where("paycycle='季付'")->sum('money')/3,2)
            ),
            array(
                "paycycle"=>"半年付",
                "num"=>M('orders')->where($map)->where("paycycle='半年付'")->count(),
                "total"=>M('orders')->where($map)->where("paycycle='半年付'")->sum('money'),
                "average"=>round(M('orders')->where($map)->where("paycycle='半年付'")->sum('money')/6,2)
            ),
            array(
                "paycycle"=>"年付",
                "num"=>M('orders')->where($map)->where("paycycle='年付'")->count(),
                "total"=>M('orders')->where($map)->where("paycycle='年付'")->sum('money'),
                "average"=>round(M('orders')->where($map)->where("paycycle='年付'")->sum('money')/12,2)
            ),
            array(
                "paycycle"=>"总计",
                "num"=>M('orders')->where($map)->count(),
                "total"=>M('orders')->where($map)->sum('money'),
                "average"=>round(M('orders')->where($map)->where("paycycle='月付'")->sum('money')+M('orders')->where($map)->where("paycycle='季付'")->sum('money')/3+M('orders')->where($map)->where("paycycle='半年付'")->sum('money')/6+M('orders')->where($map)->where("paycycle='年付'")->sum('money')/12,2)
            ),
        );
        // print "<pre>";
        // print_r($data);
        $this->assign("key",$key);
        $this->assign("list",$data);
        $this->display();
        
    }
    //导出csv
    public function exportcsvAction(){
        ini_set('memory_limit','1024M');
        set_time_limit (0);
        $sc=I('sc/s','nid desc');
        $sc=str_replace("+"," ",$sc);
        $key=I('keyword/s');
        $where=array(
            "id" => array('like','%'.$key.'%'),
            "cname" => array('like','%'.$key.'%'),
            "salesman" => array('like','%'.$key.'%'),
            "propertyof" => array('like','%'.$key.'%'),
            "ipaddr" => array('like','%'.$key.'%'),
            "preroom" => array('like','%'.$key.'%'),
            "prodcat" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );

        $map=array(
            "_complex" => $where,
            "status" => array("neq","已注销"),
        );
        if(I('salesman/s')!=''){
            $map['salesman']=I('salesman/s');
        }
        if(I('order_begin_at/s')!=''){
            $map['order_begin_at']=array('like','%'.I('order_begin_at/s').'%');
        }
        if(I('order_end_at/s')!=''){
            $map['order_end_at']=array('like','%'.I('order_end_at/s').'%');
        }
        if(I('status/s')!=''){
            $map['status']=I('status/s');
        }
        if(I('paycycle/s')!=''){
            $map['paycycle']=I('paycycle/s');
        }
        if(I('prodcat/s')!=''){
            $map['prodcat']=I('prodcat/s');
        }
        if(I('preroom/s')!=''){
            $map['preroom']=I('preroom/s');
        }
        $orderlst=M('orders')->where($map)->order($sc)->select();
        foreach ($orderlst as $k => $val) {
            $ca=strstr($val['order_end_at'],'T')?str_replace('T',' ',$val['order_end_at']):$val['order_end_at'];
            $ca=explode(' ', $ca);
            $orderlst[$k]['order_end_at']=$ca[0];
            $iplist=M('servers')->field('Serv_IP')->where("ServState='%s' AND Order_ID=%d","在线运行",$val['nid'])->select();
            $ipaddr="";
            foreach($iplist as $val2){
                $ipaddr.=$val2['serv_ip'];
            }
            $orderlst[$k]['ipaddr']=$ipaddr;
        }
        $str="ID,订单编号,客户名称,IP名称,订单备注,订单状态,产品类型,订单金额,付款周期,销售人员,下次付款日期\n";
        foreach($orderlst as $item){
            $str.=$item['nid']. "," .$item['id']. "," .$item['cname']. "," .$item['ipaddr']. "," .str_replace(array("\r\n","\r","\n",","),"",$item['remark']). "," .$item['status']. "," .$item['prodcat']. "," .$item['money']. "," .$item['paycycle']. "," .$item['salesman']. "," .$item['order_end_at']. "\n";
        }
        $filename="订单".date("Ymdhis").".csv";
        $this->export_filename($filename, $str);
    }
    
    //收款统计
    public function uppaydata($cid){
        $cltlist=M("clients")->field("id,name,prepay")->where("id=%d",$cid)->find();
        $payment["prepay"]=$cltlist['prepay'];
        $payment["svrnum"]=M('servers')->where("Customer_ID=%d AND ServState='%s'",$cid,"在线运行")->count();
        $payment["yfze"]=M('orders')->where("cid=%d AND paycycle='%s' AND status='%s'",$cid,"月付","已生效")->sum("money");
        $payment["jfze"]=M('orders')->where("cid=%d AND paycycle='%s' AND status='%s'",$cid,"季付","已生效")->sum("money");
        $payment["bnfze"]=M('orders')->where("cid=%d AND paycycle='%s' AND status='%s'",$cid,"半年付","已生效")->sum("money");
        $payment["nfze"]=M('orders')->where("cid=%d AND paycycle='%s' AND status='%s'",$cid,"年付","已生效")->sum("money");
        //到期未注销总额
        $ordinfo=M('orders')->field("money,order_end_at")->where("cid=%d AND status<>'%s'",$cid,"已注销")->select();
        $dqwzxze=0;
        foreach($ordinfo as $val2){
            $curdate=date("Ymd");
            $enddate=str_replace('-','',substr($val2["order_end_at"],0,10));
            if($curdate-$enddate>0){
                $dqwzxze+=$val2['money'];
            }
        }
        $payment["dqwzxze"]=$dqwzxze;
        //上月到期未注销总额
        $sydqwzxze=0;
        foreach($ordinfo as $val3){
            $enddate=str_replace('-','',substr($val3["order_end_at"],0,10));
            $predate=date("Ymd",strtotime("-1 month"));
            if($predate-$enddate>0){
                $sydqwzxze+=$val3['money'];
            }
        }
        $payment["dqwzxze"]=$sydqwzxze;
        //月份收入
        $year=date('Y');
        for($i=1;$i<13;$i++){
            $j="";
            if($i<10){
                $j="0".$i;
            }else{
                $j=$i;
            }
            $payment["m".$i]=M('finances')->where(array("cid"=>$cid,"bank_recv_at"=>array("like",$year.'-'.$j."%")))->sum("money");
        }
        $payment['ndze']=M('finances')->where(array("cid"=>$cid,"bank_recv_at"=>array("like",$year."%")))->sum("money");
        M('payment')->where("cid=%d",$cid)->save($payment);
    }
    //导出
    public function csexportcsvAction(){
        $key=I('key/s','');
        $map=array(
            "create_at"=>array('like',$key.'%'),
            "status"=>"已生效"
        );
        $data=array(
            array(
                "paycycle"=>"月付",
                "num"=>M('orders')->where($map)->where("paycycle='月付'")->count(),
                "total"=>M('orders')->where($map)->where("paycycle='月付'")->sum('money'),
                "average"=>round(M('orders')->where($map)->where("paycycle='月付'")->sum('money'),2)
            ),
            array(
                "paycycle"=>"季付",
                "num"=>M('orders')->where($map)->where("paycycle='季付'")->count(),
                "total"=>M('orders')->where($map)->where("paycycle='季付'")->sum('money'),
                "average"=>round(M('orders')->where($map)->where("paycycle='季付'")->sum('money')/3,2)
            ),
            array(
                "paycycle"=>"半年付",
                "num"=>M('orders')->where($map)->where("paycycle='半年付'")->count(),
                "total"=>M('orders')->where($map)->where("paycycle='半年付'")->sum('money'),
                "average"=>round(M('orders')->where($map)->where("paycycle='半年付'")->sum('money')/6,2)
            ),
            array(
                "paycycle"=>"年付",
                "num"=>M('orders')->where($map)->where("paycycle='年付'")->count(),
                "total"=>M('orders')->where($map)->where("paycycle='年付'")->sum('money'),
                "average"=>round(M('orders')->where($map)->where("paycycle='年付'")->sum('money')/12,2)
            ),
            array(
                "paycycle"=>"总计",
                "num"=>M('orders')->where($map)->count(),
                "total"=>M('orders')->where($map)->sum('money'),
                "average"=>round(M('orders')->where($map)->where("paycycle='月付'")->sum('money')+M('orders')->where($map)->where("paycycle='季付'")->sum('money')/3+M('orders')->where($map)->where("paycycle='半年付'")->sum('money')/6+M('orders')->where($map)->where("paycycle='年付'")->sum('money')/12,2)
            ),
        );
        $str="付款周期,订单数量,总金额,月平均\n";
        foreach($data as $item){
            $str.=$item['paycycle']. "," .$item['num']. "," .$item['total']. "," .$item['average']."\n";
        }
        $filename="订单统计".date("Ymdhis").".csv";
        $this->export_filename($filename, $str);
    }
    public function export_filename($filename,$data){
        header("Content-type:text/csv");
        header("Content-Disposition:attachment;filename=" . $filename);
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');
        echo $data;
    }
}