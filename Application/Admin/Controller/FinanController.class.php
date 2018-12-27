<?php
namespace Admin\Controller;
use Think\Controller;
class FinanController extends BaseController {
    //list
    public function listAction(){
        $cpage=I('p/d',1);
        $sc=I('sc/s','nid desc');
        $sc=str_replace("+"," ",$sc);
        $key=I('keyword/s');
        $where=array(
            "id" => array('like','%'.$key.'%'),
            "cname" => array('like','%'.$key.'%'),
            "type" => array('like','%'.$key.'%'),
            "state" => array('like','%'.$key.'%'),
            "recvtype" => array('like','%'.$key.'%'),
            "paycycle" => array('like','%'.$key.'%'),
            "ipaddr" => array('like','%'.$key.'%'),
            "salesman" => array('like','%'.$key.'%'),
            "committer" => array('like','%'.$key.'%'),
            "paysureby" => array('like','%'.$key.'%'),
            "managersureby" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $map["_complex"] = $where;
        $cname=I('cname/s');
        $bank_recv_at_from=I('bank_recv_at_from/s');
        $bank_recv_at_to=I('bank_recv_at_to/s');
        $fee_begin_at=I('fee_begin_at/s');
        $fee_end_at=I('fee_end_at/s');
        $recvtype=I('recvtype/s');
        $ordertype=I('ordertype/s');
        $paycycle=I('paycycle/s');
        $state=I('state/s');
        $salesman=I('salesman/s');
        if(!empty($cname)){
            $map['cname']=str_replace("+"," ",I('cname/s'));
            $this->assign("cname",str_replace("+"," ",I('cname/s')));
        }
        if(!empty($bank_recv_at_from)&&!empty($bank_recv_at_to)){
            $map['bank_recv_at']=array('between',array(I('bank_recv_at_from/s'),I('bank_recv_at_to/s')));
            $this->assign("bank_recv_at_from",I('bank_recv_at_from/s'));
            $this->assign("bank_recv_at_to",I('bank_recv_at_to/s'));
        }
        if(!empty($fee_begin_at)){
            $map['fee_begin_at']=array('like','%'.I('fee_begin_at/s').'%');
            $this->assign("fee_begin_at",I('fee_begin_at/s'));
        }
        if(!empty($fee_end_at)){
            $map['fee_end_at']=array('like','%'.I('fee_end_at/s').'%');
            $this->assign("fee_end_at",I('fee_end_at/s'));
        }
        if(!empty($recvtype)){
            $map['recvtype']=I('recvtype/s');
            $this->assign("recvtype",I('recvtype/s'));
        }
        if(!empty($ordertype)){
            $map['ordertype']=I('ordertype/s');
            $this->assign("ordertype",I('ordertype/s'));
        }
        if(!empty($paycycle)){
            $map['paycycle']=I('paycycle/s');
            $this->assign("paycycle",I('paycycle/s'));
        }
        if(!empty($state)){
            $map['state']=I('state/s');
            $this->assign("state",I('state/s'));
        }
        if(!empty($salesman)){
            $map['salesman']=I('salesman/s');
            $this->assign("salesman",I('salesman/s'));
        }
        //已过期总额（暂时注销）2018-11-21 
        // $finans=M('finances')->field("money,fee_end_at")->where($map)->select();
        // $endmoney=0;
        // foreach($finans as $val){
        //     $curdate=date("Ymd");
        //     $enddate=str_replace('-','',substr($val["fee_end_at"],0,10));
        //     if($curdate-$enddate>0){
        //         $endmoney+=$val['money'];
        //     }
        // }

        //读取缓存
        S(array('type'=>'redis','host'=>'127.0.0.1','port'=>'6379','prefix'=>'redis_','expire'=>10800));
        if (empty($key)&&empty($cname)&&empty($bank_recv_at_from)&&empty($bank_recv_at_to)&&empty($fee_begin_at)&&empty($fee_end_at)&&empty($recvtype)&&empty($ordertype)&&empty($paycycle)&&empty($state)) {
            $count = S('finan_count');
            if (empty($count)) {
                $newcount=M('finances')->where($map)->count();
                $count = S('finan_count',$newcount);
            }
            $countarr = S('finan_countarr');
            if (empty($countarr)) {
                $ctarr=array(
                    "zj" => M('finances')->where($map)->sum("money"),
                    "kdqr" => M('finances')->where($map)->where("state='款到确认'")->sum("money"),
                    "yqr" => M('finances')->where($map)->where("state='已确认'")->sum("money"),
                    "yfk" => M('finances')->where($map)->where("state='已付款'")->sum("money"),
                    // "ygq" => $endmoney,
                );
                $countarr = S('finan_countarr',$ctarr);
            }
        }else{
            $count=M('finances')->where($map)->count();
            $countarr=array(
                "zj" => M('finances')->where($map)->sum("money"),
                "kdqr" => M('finances')->where($map)->where("state='款到确认'")->sum("money"),
                "yqr" => M('finances')->where($map)->where("state='已确认'")->sum("money"),
                "yfk" => M('finances')->where($map)->where("state='已付款'")->sum("money"),
                // "ygq" => $endmoney,
            );
        }

        $p = getpage($count,15);
        $p->parameter['keyword'] = $key;
        $show = $p->show();
        $finanlst=M('finances')->limit($p->firstRow.','.$p->listRows)->where($map)->order($sc)->select();
        
        foreach($finanlst as $k=>$val){
            $orderid=M('orders')->where("id='%s'",$val['id'])->getField('nid');
            $iplist=M('servers')->field('Serv_IP')->where("ServState='%s' AND Order_ID=%d","在线运行",$orderid)->select();
            $ipaddr="";
            foreach($iplist as $val2){
                $ipaddr.=$val2['serv_ip'];
            }
            $finanlst[$k]['ipaddr']=$ipaddr;
        }
        //销售人员
        $sales=M('accounts')->field('realname')->where("dept='%s' AND isleave='%s'",'销售部','false')->select();
        $this->assign("sales",$sales);
        $this->assign("count",$count);
        $this->assign("page",$show);
        $this->assign("finanlst",$finanlst);
        $this->assign("cname",I('cname/s'));
        $this->assign("countarr",$countarr);
        $this->assign("perm",C('perm'));
        $this->assign("sc",$sc);
        $this->assign("key",$key);
        $this->display();
    }
    //new
    public function newAction(){
        if(IS_POST){
            $data=M('finances')->create();
            $data['cid']=M('clients')->where("name='%s'",trim(I('cname/s')))->getField('id');
            $data['committer']=C("username");
            $data['create_at']=date("Y-m-d h:i:s");
            if(M('finances')->add($data)){
                self::uppaydata($data['cid']);
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->display();
    }

    //view_order
    public function view_orderAction(){
        $id=I('id/s');
        $orderinfo=M('orders')->where("id='%s'",$id)->find();
        $this->assign("orderinfo",$orderinfo);
        $this->display();
    }

    //view_finan
    public function view_finanAction(){
        $nid=I('nid/d');
        $finaninfo=M('finances')->where("nid=%d",$nid)->find();
        $this->assign("finaninfo",$finaninfo);
        $this->display();
    }
    //confirm_kd
    public function confirm_kdAction(){
        $nid=I('nid/d');
        $finaninfo=M('finances')->where("nid=%d",$nid)->find();
        if(IS_POST){
            $data=M('finances')->create();
            $data['state']='已付款';
            M('orders')->where("id='%s'",$data['id'])->setField("fstate","已付款");
            if(M('finances')->save($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->assign("finaninfo",$finaninfo);
        $this->display();
    }
    //confirm_zg
    public function confirm_zgAction(){
        $nid=I('nid/d');
        $finaninfo=M('finances')->where("nid=%d",$nid)->find();
        if(IS_POST){
            $orderdata=array(
                "order_end_at" => I('post.fee_end_at')
            );
            M('orders')->where("id='%s'",I('post.id'))->save($orderdata);
            $data=M('finances')->create();
            $data['state']='已确认';
            M('orders')->where("id='%s'",$data['id'])->setField("fstate","");
            if(M('finances')->save($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->assign("finaninfo",$finaninfo);
        $this->display();
    }
    //pl_confirm_kd
    public function pl_confirm_kdAction(){
        $ids=I('post.ids');
        $ids=str_replace(",","",$ids);
        $idsarr=explode("|",$ids);
        $idnum=count($idsarr)-1;
        $n=0;
        foreach($idsarr as $val){
            if($val!=''){
                $fstate=M('finances')->where("nid=%d",$val)->getField('state');
                if($fstate=='款到确认'){
                    $data=array(
                        "paysureby" => C("username"),
                        "paysure_at" => date("Y-m-d"),
                        "state" => '已付款'
                    );
                    $oid=M('finances')->where("nid=%d",$val)->getField('id');
                    M('orders')->where("id='%s'",$oid)->setField("fstate","已付款");
                    M('finances')->where("nid=%d",$val)->save($data);
                }
                $n+=1;
            }
        }
        if($idnum==$n){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
    //pl_confirm_zg
    public function pl_confirm_zgAction(){
        $ids=I('post.ids');
        $ids=str_replace(",","",$ids);
        $idsarr=explode("|",$ids);
        $idnum=count($idsarr)-1;
        $n=0;
        foreach($idsarr as $val){
            if($val!=''){
                $fstate=M('finances')->where("nid=%d",$val)->getField('state');
                if($fstate=='已付款'){
                    $finaninfo=M('finances')->where("nid=%d",$val)->find();
                    //订单
                    $oid=M('finances')->where("nid=%d",$val)->getField('id');
                    $orderdata=array(
                        "order_end_at" => $finaninfo['fee_end_at'],
                        "fstate" => ""
                    );
                    M('orders')->where("id='%s'",$oid)->save($orderdata);
                    //财务
                    $data=array(
                        "managersureby" => C("username"),
                        "managersure_at" => date("Y-m-d"),
                        "state" => '已确认'
                    );
                    M('finances')->where("nid=%d",$val)->save($data);
                }
                $n+=1;
            }
        }
        if($idnum==$n){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
        
    }
    //edit
    public function editAction(){
        $nid=I('nid/d');
        $finaninfo=M('finances')->where("nid=%d",$nid)->find();
        if(IS_POST){
            $data=M('finances')->create();
            if(M('finances')->save($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->assign("finaninfo",$finaninfo);
        $this->display();
    }

    //remove
    public function removeAction(){
        $nid=I('post.nid');
        $id=M('finances')->where("nid=%d",$nid)->getField('id');    
        if(M('finances')->where("nid=%d",$nid)->delete()){
            M('orders')->where("id='%s'",$id)->setField("fstate","");
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
    //census
    public function censusAction(){
        if(M('payment')->count()>0){
            $cpage=I('p/d',1);
            $key=I('keyword/s');
            $sc=I('sc/s','ndze desc');
            $sc=str_replace("+"," ",$sc);
            $map=array(
                "cname" => array('like','%'.$key.'%')
            );
            $count=M('payment')->where($map)->count();
            $p = getpage($count,15);
            $p->parameter['keyword'] = $key;
            $show = $p->show();
            $list=M('payment')->limit($p->firstRow.','.$p->listRows)->where($map)->order($sc)->select();
            //总计
            for($i=0;$i<2;$i++){
                if($i==0){
                    $year=date("Y");
                }else{
                    $year=date("Y",strtotime("-1 year"));
                }
                $zjdata[$i]=array(
                    "cname" => $i==0?"总计":"去年总计",
                    "prepay" => $i==0?M('clients')->sum('prepay'):'',
                    "svrnum" => $i==0?M('servers')->where("ServState='%s'",'在线运行')->count():'',
                    "yfze" => $i==0?M('orders')->where("paycycle='%s' AND status='%s'","月付","已生效")->sum("money"):'',
                    "jfze" => $i==0?M('orders')->where("paycycle='%s' AND status='%s'","季付","已生效")->sum("money"):'',
                    "bnfze" => $i==0?M('orders')->where("paycycle='%s' AND status='%s'","半年付","已生效")->sum("money"):'',
                    "nfze" => $i==0?M('orders')->where("paycycle='%s' AND status='%s'","年付","已生效")->sum("money"):'',
                );
                //到期未注销总额
                $ordinfo=M('orders')->field("money,order_end_at")->where("status='%s'","已生效")->select();
                $dqwzxze=0;
                foreach($ordinfo as $val2){
                    $curdate=date("Ymd");
                    $enddate=str_replace('-','',substr($val2["order_end_at"],0,10));
                    if($curdate-$enddate>0){
                        $dqwzxze+=$val2['money'];
                    }
                }
                $zjdata[$i]["dqwzxze"]=$i==0?$dqwzxze:'';
                //上月到期未注销总额
                $sydqwzxze=0;
                foreach($ordinfo as $val3){
                    $enddate=str_replace('-','',substr($val3["order_end_at"],0,10));
                    $predate=date("Ymd",strtotime("-1 month"));
                    if($predate-$enddate>0){
                        $sydqwzxze+=$val3['money'];
                    }
                }
                $zjdata[$i]["dqwzxze"]=$i==0?$sydqwzxze:'';
                //月份收入
                for($k=1;$k<13;$k++){
                    if($k<10){
                        $j="0".$k;
                    }else{
                        $j=$k;
                    }
                    $zjdata[$i]["m".$k]=M('finances')->where(array("bank_recv_at"=>array("like",$year.'-'.$j."%")))->sum("money");
                }
                $zjdata[$i]['ndze']=M('finances')->where(array("bank_recv_at"=>array("like",$year."%")))->sum("money");
            }
            
            $this->assign("list",$list);
            $this->assign("zjlist",$zjdata);
            $this->assign("page",$show);
            $this->assign("sc",$sc);
            $this->assign("key",$key);
        }else{
            // ini_set('memory_limit','3072M');
            // set_time_limit(0);
            // $cltlist=M("clients")->field("id,name,prepay")->select();
            // foreach($cltlist as $val){
            //     $payment["cid"]=$val['id'];
            //     $payment["cname"]=$val['name'];
            //     $payment["prepay"]=$val['prepay'];
            //     $payment["svrnum"]=M('servers')->where("Customer_ID=%d AND ServState='%s'",$val['id'],'在线运行')->count();
            //     $payment["yfze"]=M('orders')->where("cid=%d AND paycycle='%s' AND status='%s'",$val['id'],"月付","已生效")->sum("money");
            //     $payment["jfze"]=M('orders')->where("cid=%d AND paycycle='%s' AND status='%s'",$val['id'],"季付","已生效")->sum("money");
            //     $payment["bnfze"]=M('orders')->where("cid=%d AND paycycle='%s' AND status='%s'",$val['id'],"半年付","已生效")->sum("money");
            //     $payment["nfze"]=M('orders')->where("cid=%d AND paycycle='%s' AND status='%s'",$val['id'],"年付","已生效")->sum("money");
            //     //到期未注销总额
            //     $ordinfo=M('orders')->field("money,order_end_at")->where("cid=%d AND status='%s'",$val['id'],"已生效")->select();
            //     $dqwzxze=0;
            //     foreach($ordinfo as $val2){
            //         $curdate=date("Ymd");
            //         $enddate=str_replace('-','',substr($val2["order_end_at"],0,10));
            //         if($curdate-$enddate>0){
            //             $dqwzxze+=$val2['money'];
            //         }
            //     }
            //     $payment["dqwzxze"]=$dqwzxze;
            //     //上月到期未注销总额
            //     $sydqwzxze=0;
            //     foreach($ordinfo as $val3){
            //         $enddate=str_replace('-','',substr($val3["order_end_at"],0,10));
            //         $predate=date("Ymd",strtotime("-1 month"));
            //         if($predate-$enddate>0){
            //             $sydqwzxze+=$val3['money'];
            //         }
            //     }
            //     $payment["dqwzxze"]=$sydqwzxze;
            //     //月份收入
            //     $year=I('year',date('Y'));
            //     for($i=1;$i<13;$i++){
            //         if($i<10){
            //             $j="0".$i;
            //         }else{
            //             $j=$i;
            //         }
            //         $payment["m".$i]=M('finances')->where(array("cid"=>$val['id'],"bank_recv_at"=>array("like",$year.'-'.$j."%")))->sum("money");
            //     }
            //     $payment['ndze']=M('finances')->where(array("cid"=>$val['id'],"bank_recv_at"=>array("like",$year."%")))->sum("money");
            //     M('payment')->add($payment);
            // }
        }
        $this->display();
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
    //收款统计——导出csv
    public function exportcsvAction(){
        ini_set('memory_limit','1024M');
        set_time_limit (0);
        $cpage=I('p/d',1);
        $key=I('keyword/s');
        $map=array(
            "cname" => array('like','%'.$key.'%')
        );
        $list=M('payment')->where($map)->order('ndze desc')->select();
        $str="ID,客户名称,预付款余额,服务器数量,月付总额,季付总额,半年付总额,年付总额,1月份,2月份,3月份,4月份,5月份,6月份,7月份,8月份,9月份,10月份,11月份,12月份,年度总额\n";
        foreach($list as $item){
            $str.=$item['id']. "," .$item['cname']. "," .$item['prepay']. "," .$item['svrnum']. "," .$item['yfze']. "," .$item['jfze']. "," .$item['bnfze']. "," .$item['nfze']. "," .$item['m1']. "," .$item['m2']."," .$item['m3']."," .$item['m4']."," .$item['m5']."," .$item['m6']."," .$item['m7']."," .$item['m8']."," .$item['m9']."," .$item['m10']."," .$item['m11']."," .$item['m12']."," .$item['ndze']. "\n";
        }
        $filename="收款统计".date("Ymdhis").".csv";
        $this->export_filename($filename, $str);
    }
    //财务收入——导出csv
    public function fnexportcsvAction(){
        $cpage=I('p/d',1);
        $sc=I('sc/s','nid desc');
        $sc=str_replace("+"," ",$sc);
        $key=I('keyword/s');
        $where=array(
            "cname" => array('like','%'.$key.'%'),
            "type" => array('like','%'.$key.'%'),
            "state" => array('like','%'.$key.'%'),
            "recvtype" => array('like','%'.$key.'%'),
            "paycycle" => array('like','%'.$key.'%'),
            "ipaddr" => array('like','%'.$key.'%'),
            "salesman" => array('like','%'.$key.'%'),
            "committer" => array('like','%'.$key.'%'),
            "paysureby" => array('like','%'.$key.'%'),
            "managersureby" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $map["_complex"] = $where;
        $cname=I('cname/s');
        $bank_recv_at_from=I('bank_recv_at_from/s');
        $bank_recv_at_to=I('bank_recv_at_to/s');
        $fee_begin_at=I('fee_begin_at/s');
        $fee_end_at=I('fee_end_at/s');
        $recvtype=I('recvtype/s');
        $ordertype=I('ordertype/s');
        $paycycle=I('paycycle/s');
        $state=I('state/s');
        if(!empty($cname)){
            $map['cname']=str_replace("+"," ",I('cname/s'));
        }
        if(!empty($bank_recv_at_from)&&!empty($bank_recv_at_to)){
            $map['bank_recv_at']=array('between',array(I('bank_recv_at_from/s'),I('bank_recv_at_to/s')));
        }
        if(!empty($fee_begin_at)){
            $map['fee_begin_at']=array('like','%'.I('fee_begin_at/s').'%');
        }
        if(!empty($fee_end_at)){
            $map['fee_end_at']=array('like','%'.I('fee_end_at/s').'%');
        }
        if(!empty($recvtype)){
            $map['recvtype']=I('recvtype/s');
        }
        if(!empty($ordertype)){
            $map['ordertype']=I('ordertype/s');
        }
        if(!empty($paycycle)){
            $map['paycycle']=I('paycycle/s');
        }
        if(!empty($state)){
            $map['state']=I('state/s');
        }
        $finanlst=M('finances')->where($map)->order($sc)->select();
        
        foreach($finanlst as $k=>$val){
            $orderid=M('orders')->where("id='%s'",$val['id'])->getField('nid');
            $iplist=M('servers')->field('Serv_IP')->where("ServState='%s' AND Order_ID=%d","在线运行",$orderid)->select();
            $ipaddr="";
            foreach($iplist as $val2){
                $ipaddr.=$val2['serv_ip'];
            }
            $finanlst[$k]['ipaddr']=$ipaddr;
        }
        $str="ID,财务编号,相关IP,客户名称,到款日期,付款状态,收款金额,收款方式,付款周期,备注,相关销售,费用开始日期,费用结束日期,提交人,款到确认日期,款到确认人,确认日期,确认人\n";
        foreach($finanlst as $item){
            $str.=$item['nid']. "," .$item['id']. "," .$item['serv_ip']. "," .$item['cname']. "," .$item['bank_recv_at']. "," .$item['state']. "," .$item['money']. "," .$item['recvtype']. "," .$item['paycycle']. "," .str_replace(array("\r\n","\r","\n"),"",$item['remark'])."," .$item['salesman']."," .$item['fee_begin_at']."," .$item['fee_end_at']."," .$item['committer']."," .$item['paysure_at']."," .$item['paysureby']."," .$item['managersure_at']."," .$item['managersureby']. "\n";
        }
        $filename="财务收入".date("Ymdhis").".csv";
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