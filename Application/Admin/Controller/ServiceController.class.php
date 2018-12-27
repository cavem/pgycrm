<?php
namespace Admin\Controller;
use Think\Controller;
class ServiceController extends BaseController {
    //list
    public function listAction(){
        $sc=I('sc/s','ID desc');
        $sc=str_replace("+"," ",$sc);
        $key=trim(I('keyword/s'));
        $where=array(
            "CustName" => array('like','%'.$key.'%'),
            "ID" => array('like','%'.$key.'%'),
            "Serv_IP" => array('like','%'.$key.'%'),
            "ServNum" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $map=array(
            "_complex" => $where,
            "ServState" => array('eq','在线运行'),
        );
        $idcname=I("idcname");
        $servstate=I("servstate");
        $custname=I("custname/s");
        $productkind=I("productkind");
        $shelfcode=I("shelfcode");
        $salers=I("salers");
        $devicetype=I("devicetype");
        if($idcname!=''){
            $map['IDCName']=I("idcname");
            $this->assign("idcname",I("idcname"));
            $shelflst=M('cabinets')->field("code")->where("room='%s'",I('idcname'))->select();
            $this->assign("shelflst",$shelflst);
        }
        if($servstate!=''){
            $map['ServState']=I("servstate");
            $this->assign("servstate",I("servstate"));
        }
        if($custname){
            $map['CustName']=I('custname/s');
            $this->assign("custname",I("custname"));
        }
        if($productkind!=''){
            $map['Productkind']=I('productkind');
            $this->assign("productkind",I("productkind"));
        }
        if($shelfcode!=''){
            $map['ShelfCode']=I('shelfcode');
            $this->assign("shelfcode",I("shelfcode"));
        }
        if($salers!=''){
            $map['Salers']=I('salers');
            $this->assign("salers",I("salers"));
        }
        if($devicetype!=''){
            $map['DeviceType']=I('devicetype');
            $this->assign("devicetype",I("devicetype"));
        }

        //读取缓存
        // S(array('type'=>'redis','host'=>'127.0.0.1','port'=>'6379','prefix'=>'redis_','expire'=>10800));
        // if (empty($key)&&empty($idcname)&&empty($servstate)&&empty($custname)&&empty($productkind)&&empty($shelfcode)&&empty($salers)&&empty($devicetype)) {
        //     $count = S('count');
        //     if (empty($count)) {
        //         $newcount=M('servers')->where($map)->count();
        //         $count = S('count',$newcount);
        //     }
        //     $servcounts=S('servcounts');
        //     if (empty($servcounts)) {
        //         $svcounts=array(
        //             "self" => M('servers')->limit($p->firstRow.','.$p->listRows)->where($map)->where("Productkind='%s'",'本公司自用')->count(),
        //             "free" => M('servers')->limit($p->firstRow.','.$p->listRows)->where($map)->where("Productkind='%s'",'空闲机器')->count(),
        //         );
        //         $servcounts = S('servcounts',$svcounts);
        //     }
        //     $servcounts2 = S('servcounts2');
        //     $roomlist=M('rooms')->getField('id,name');
        //     if (empty($servcounts2)) {
        //         foreach($roomlist as $val){
        //             $svcounts2[$val]=M('servers')->limit($p->firstRow.','.$p->listRows)->where($map)->where("IDCName='%s'",$val)->count();
        //         }
        //         $servcounts2 = S('servcounts2',$svcounts2);
        //     }
        // }else{
            $count=M('servers')->where($map)->count();
            $servcounts=array(
                "self" => M('servers')->limit($p->firstRow.','.$p->listRows)->where($map)->where("Productkind='%s'",'本公司自用')->count(),
                "free" => M('servers')->limit($p->firstRow.','.$p->listRows)->where($map)->where("Productkind='%s'",'空闲机器')->count(),
            );
            $roomlist=M('rooms')->getField('id,name');
            foreach($roomlist as $val){
                $servcounts2[$val]=M('servers')->limit($p->firstRow.','.$p->listRows)->where($map)->where("IDCName='%s'",$val)->count();
            }
        //}
        $pdtkindlist=M('categories')->select();

        $p = getpage($count,15);
        $p->parameter['keyword'] = $key;
        $show = $p->show();
        $servlist=M('servers')->limit($p->firstRow.','.$p->listRows)->where($map)->order($sc)->select();
        
        $this->assign("servlist",$servlist);
        $this->assign("roomlist",$roomlist);
        $this->assign("page",$show);
        $this->assign("count",$count);
        $this->assign("custname",I('custname/s'));
        $this->assign("pdtkindlist",$pdtkindlist);
        $this->assign("servcounts",$servcounts);
        $this->assign("servcounts2",$servcounts2);
        $this->assign("perm",C('perm'));
        $this->assign("sc",$sc);
        $this->assign("key",$key);
        $this->display();
    }
    //edit
    public function editAction(){
        $servid=I('servid/d');
        $servinfo=M('servers')->where('ID=%d',$servid)->select();
        $roomlist=M('rooms')->getField('id,name');
        $shelflist=M('cabinets')->where("room='%s'",$servinfo[0]['idcname'])->select();
        $frshelflist=array();
        foreach($shelflist as $val){
            array_push($frshelflist,array("code"=>$val["code"]));
        }
        if(IS_POST){
            $data=M('servers')->create();
            $data["IPNum"]=count(explode("/",$data['Serv_IP']))-1;
            $updata=array(
                "svnid" => $data["ID"],
                "odnid" => $data["Order_ID"],
                "ipaddr" => $data["Serv_IP"],
                "committer" => C("username"),
                "commit_at" => date("Y-m-d H:i:s")
            );
            //判断哪里有更改
            if(I('post.pre_serv_ip')!=$data["Serv_IP"]){//说明是ip更改
                //添加更改ip记录
                $oldip=I('post.pre_serv_ip');
                $newip=$data["Serv_IP"];
                $ipupdata=array(
                    "OldIP" => $oldip,
                    "NewIP" => $newip,
                    "UpdateTime" => date("Y-m-d H:i:s"),
                    "Operator" => C("username"),
                    "Servers_ID" => $data["ID"]
                );
                M('servipupdatelog')->add($ipupdata);
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
            }
            if(I('post.pre_hwconfig')!=$data["Hwconfig"]){//说明是配置更改
                $updata["pre_data"]="原配置：".I('post.pre_hwconfig');
                $updata["new_data"]="现配置：".$data["Hwconfig"];
                $updata["remarks"]="原配置：".I('post.pre_hwconfig').'\n'."现配置：".$data["Hwconfig"];
                $updata["logtype"]="服务器配置变更";
                M('server_update_log')->add($updata);
            }
            if(I('post.pre_bandwidth')!=$data["Bandwidth"]){//说明是带宽更改
                $updata["pre_data"]="原带宽：".I('post.pre_bandwidth');
                $updata["new_data"]="现带宽：".$data["Bandwidth"];
                $updata["remarks"]="原带宽：".I('post.pre_bandwidth').'\n'."现带宽：".$data["Bandwidth"];
                $updata["logtype"]="带宽变更";
                M('server_update_log')->add($updata);
            }
                       
            //保存服务器信息
            if(M('servers')->save($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->assign("servinfo",$servinfo[0]);
        $this->assign("roomlist",$roomlist);
        $this->assign("shelflist",$frshelflist);
        $this->display();
    }
    //getroom
    public function getroomAction(){
        $roomlist=M('rooms')->getField('id,name');
        print_r(self::decodeUnicode(json_encode($roomlist)));
    }
    //edit-getshelf
    public function getshelfAction(){
        $idcname=I('post.idcname');
        $shelflist=M('cabinets')->where("room='%s'",$idcname)->select();
        $frshelflist=array();
        foreach($shelflist as $val){
            array_push($frshelflist,array("code"=>$val["code"]));
        }
        print_r(self::decodeUnicode(json_encode($frshelflist)));
    }
    //edit-ip
    public function edit_ipAction(){
        $serv_ip=I('serv_ip/s');
        $serv_iplist=explode('|',$serv_ip);
        $this->assign("serv_iplist",$serv_iplist);
        $this->assign("serv_ip",$serv_ip);
        $this->display();
    }
    //edit-ip2
    public function edit_ip2Action(){
        $ippart=I('ippart/s');
        $key=I('keyword/s');
        $where=array(
            "ipaddr" => array('like','%'.$key.'%'),
        );
        $map=array(
            "_complex" => $where,
            "ipseg" => array('eq',$ippart),
            "state" => array('eq',0),
        );
        $iplist=M("ips")->where($map)->select();
        $this->assign("ippart",$ippart);
        $this->assign("iplist",$iplist);
        $this->display();
    }
    //edit_ipsort
    public function edit_ipsortAction(){
        $ipstr=I('ipstr');
        $iparr=explode('|',$ipstr);
        $this->assign("iparr",$iparr);
        $this->display();
    }
    //edit_ipfree
    public function edit_ipfreeAction(){
        $cpage=I('p/d',1);
        $key=I('keyword/s');
        $map=array(
            "ipseg" => array('like','%'.$key.'%'),
        );
        $count=M("ipsegs")->where($map)->count();
        $Page = new \Extend\Page($count,8);
        $Page->parameter['keyword'] = $key;
        $show = $Page->show();
        $ipseg=M("ipsegs")->limit($Page->firstRow.','.$Page->listRows)->field('ipseg')->where($map)->select();
        foreach($ipseg as $key=>$val){
            $ipseg[$key]['no']=($cpage-1)*6+$key+1;
            $ipseg[$key]['count']=M("ips")->where("ipseg='%s' AND state=%d",$val['ipseg'],0)->count();
            $ipseg[$key]['room']=M("ipsegs")->where("ipseg='%s'",$val['ipseg'])->getField("room");
        }
        $this->assign("ipseg",$ipseg);
        $this->assign("page",$show);
        $this->display();
    }
    //remove
    public function removeAction(){
        $servid=I('servid/d');
        if(M('servers')->where("ID=%d",$servid)->delete()){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
    //view
    public function viewAction(){
        $servid=I('servid/d');
        $servinfo=M('servers')->where("ID=%d",$servid)->select();
        $servudlist=M('server_update_log')->where("svnid=%d",$servid)->select();
        $servtflist=M('server_transfer_log')->where("svnid=%d",$servid)->select();
        $servipuplist=M('servipupdatelog')->where("Servers_ID=%d",$servid)->select();
        // print "<pre>";
        // print_r($servtflist);exit;
        $this->assign('servinfo',$servinfo[0]);
        $this->assign('servudlist',$servudlist);
        $this->assign('servtflist',$servtflist);
        $this->assign('servipuplist',$servipuplist);
        $this->display();
    }
    //install
    public function installAction(){
        $this->display();
    }

    //导出csv
    public function exportcsvAction(){
        ini_set('memory_limit','1024M');
        set_time_limit (0);
        $key=I('keyword/s');
        $where=array(
            "CustName" => array('like','%'.$key.'%'),
            "ID" => array('like','%'.$key.'%'),
            "Serv_IP" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $map=array(
            "_complex" => $where,
            "ServState" => array('eq','在线运行'),
        );
        if(I("idcname")!=''){
            $map['IDCName']=I("idcname");
        }
        if(I("servstate")!=''){
            $map['ServState']=I("servstate");
        }
        if(I('custname/s')){
            $map['CustName']=I('custname/s');
        }
        if(I('productkind')!=''){
            $map['Productkind']=I('productkind');
        }
        if(I('shelfcode')!=''){
            $map['ShelfCode']=I('shelfcode');
        }
        if(I('salers')!=''){
            $map['Salers']=I('salers');
        }
        if(I('devicetype')!=''){
            $map['DeviceType']=I('devicetype');
        }
        $servlist=M('servers')->where($map)->order("id desc")->field("ID,ServNum,DeviceShape,ServName,Serv_IP,Productkind,CustName,CustTel,IDCName,ShelfCode,Bandwidth,Remarks,Salers,Order_ID")->select();
        $servstr="ID,服务器编号,服务器外形,服务器名称,IP地址,产品类型,金额,客户名称,联系人,联系电话,所在机房,机柜,带宽,描述,到期日期,销售代表,订单ID\n";
        foreach($servlist as $key=>$val){
            if($val['order_id']!=''){
                $servlist[$key]['money']=M('orders')->where("nid=%d",$val['order_id'])->getField('money');
                $servlist[$key]['expiretime']=M('orders')->where("nid=%d",$val['order_id'])->getField('order_end_at');
            }else{
                $servlist[$key]['money']='';
                $servlist[$key]['expiretime']='';
            }
            
        }
        foreach($servlist as $item){
            $servstr.=$item['id']. "," .$item['servnum']. "," .$item['deviceshape']. "," .$item['servname']. "," .$item['serv_ip']. "," .$item['productkind']. "," .$item['money']. "," .$item['custname']. "," .$item['custtech']. "," .$item['custtel']. "," .$item['idcname']. "," .$item['shelfcode']. "," .str_replace(array("\r\n","\r","\n"),"",$item['bandwidth']). "," .str_replace(array("\r\n","\r","\n"),"",$item['remarks']). "," .substr($item['expiretime'],0,10). "," .$item['salers']. "," .$item['order_id']."\n";
        }
        $filename="服务器".date("Ymdhis").".csv";
        $this->export_filename($filename, $servstr);
    }
    //对unicode码进行解码
    function decodeUnicode($str){
        return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
            create_function(
                '$matches',
                'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
            ),
            $str);
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
    //判断当前工单是否正在处理
    public function isexistAction(){
        $tkstate=M('tasks')->where("svid='%s'",I('post.sid'))->order('nid desc')->getField("state");
        if($tkstate=="待处理"||$tkstate=="处理中"||$tkstate=="未解决"||$tkstate=="待确认"){
            $this->ajaxReturn(1);
        }else{
            $this->ajaxReturn(0);
        }
    }
}