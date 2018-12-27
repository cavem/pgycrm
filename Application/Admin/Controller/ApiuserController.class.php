<?php
/**
 * 公司网站对接云谷专用
 * 作者：小菜
 * 最后修改时间：2018-04-24 09:09
 * 版权：蒲公英-小菜
 * 接口目录：1.判断当前ip是否属于该用户
			2.根据用户ID获取真实姓名
			3.(根据客户id)获取订单列表
			4.根据订单id获取订单详细
			5.根据订单id获取订单下的服务器列表信息
			6.(根据客户id)获取服务器列表  
			7.获取产品类型信息
			8.(根据客户id)获取正在处理工单列表
			9.根据IP获取客户真实姓名
			10.根据客户名获取名下ip列表
			11.根据客户id获取客户信息
			12.修改客户信息
			13.根据邮箱获取crm客户id
*/
namespace Admin\Controller;
use Think\Controller;
class ApiuserController extends Controller {
	public function _initialize()
	{
		self::check_ip();
	}

	/**
	 * 判断当前ip是否属于该用户
	 */
	public function ipbelongAction()
	{
		$uid=I('uid/d');
		$ip=I('ip/s');
		$sp=strpos($ip, "/");
		$ip=empty($sp)?$ip."/":$ip;
		try {
			$servers=M('servers');
			$map["Serv_IP"]=array('like','%'.$ip.'%');
			$map["ServState"]="在线运行";
			$map["Customer_ID"]=$uid;
			$userinfo=$servers->field('ID')->where($map)->find();
			if (!empty($userinfo)) {
				$yon="true";
			}else{
				$yon="false";
			}
			echo json_encode($yon);
			exit;
		} catch (Exception $e) {
			
		}
	}

	/**
	 * 根据用户ID获取真实姓名
	 */
	public function getnameAction()
	{
		$id=I('id/d');
		try {
			$clients=M('clients');
			$userinfo=$clients->field('name')->where('id= %d',$id)->find();
			echo json_encode($userinfo);
			exit;
		} catch (Exception $e) {
			
		}
	}

	/**
	 * (根据客户id)获取订单列表
	 */
	public function userordersAction()
	{
		$cid=I('cid/d');
		$cpage=I("cpage/d",1);
		$key=I("key/s");
		try {
			$orders=M('orders');
			$where=array(
	            "id" => array('like','%'.$key.'%'),
	            "cname" => array('like','%'.$key.'%'),
	            "_logic" => 'OR'
	        );
	        $map=array(
	            "_complex" => $where,
	            "status" => array("eq","已生效"),
	        );
	        if (!empty($cid)) {
	        	$map['cid']=$cid;
	        }
	        $ordercount = $orders->where($map)->count("nid");
			$orderlst=$orders->field('id,nid,cname,status,prodcat,paycycle,order_end_at,preroom,paytype,order_begin_at')->where($map)->page($cpage,15)->order('nid DESC')->select();
			$orderlst=array(
				"TotalCount"=>$ordercount,//总条数
	            "OrderList"=>$orderlst
	        );
			echo json_encode($orderlst);
			exit;
		} catch (Exception $e) {
			
		}
	}

	/**
	 * 根据订单id获取订单详细
	 */
	public function orderinfoAction()
	{
		$id=I('id/d');
		try {
			$orders=M('orders');
			$orderinfo=$orders->field('id,money,status,paycycle,order_begin_at,order_end_at,prodcat')->where("nid= %d",$id)->find();
			echo json_encode($orderinfo);
			exit;
		} catch (Exception $e) {
			
		}
	}

	/**
	 * 根据订单id获取订单下的服务器列表信息
	 */
	public function getsvbyorderidAction()
	{
		$orderid=I('orderid/d');
		$cpage=I("cpage/d",1);
		$key=I("key/s");
		try {
			$servers=M('servers');
	        $map=array(
	            "ServState" => array("eq","在线运行"),
	            "Order_ID"=> $orderid
	        );
	        $serverscount = $servers->where($map)->count("ID");
			$serverslst=$servers->field('ServName,ServState,Serv_IP,IDCName,DeviceShape')->where($map)->page($cpage,15)->order('ID DESC')->select();
			$serverslst=array(
				"TotalCount"=>$serverscount,//总条数
	            "ServerList"=>$serverslst
	        );
			echo json_encode($serverslst);
			exit;
		} catch (Exception $e) {
			
		}
	}

	/**
	 * (根据客户id)获取服务器列表
	 */
	public function serversAction()
	{
		$cid=I('cid/d');
		$cpage=I("cpage/d",1);
		$productkind=I('productkind/s');//
		$devicetype=I('devicetype/s');
		$key=I("key/s");
		try {
			$servers=M('servers');
			$where=array(
	            "Serv_IP" => array('like','%'.$key.'%'),
	            "_logic" => 'OR'
	        );
	        $map=array(
	            "_complex" => $where,
	            "ServState" => array("eq","在线运行"),
	        );
	        if (!empty($cid)) {
	        	$map['Customer_ID']=$cid;
	        }
	        if (!empty($productkind)) {
	        	$map['Productkind']=$productkind;
	        }
	        if (!empty($devicetype)) {
	        	$map['DeviceType']=$devicetype;
	        }
	        $servercount = $servers->where($map)->count("ID");
			$serverlst=$servers->field('Serv_IP,Customer_ID,Bandwidth,Password')->where($map)->page($cpage,15)->order('ID DESC')->select();
			$serverlst=array(
				"TotalCount"=>$servercount,//总条数
	            "ServerList"=>$serverlst
	        );
			echo json_encode($serverlst);
			exit;
		} catch (Exception $e) {
			
		}
	}

	/**
	 * 获取产品类型信息
	 */
	public function productkindAction()
	{
		try {
			$categories=M('categories');
			$catelst=$categories->field('name')->select();
			echo json_encode($catelst);
			exit;
		} catch (Exception $e) {
			
		}
	}

	/**
	 * (根据客户id)获取正在处理工单列表
	 */
	public function tasksAction()
	{
		$cid=I('cid/d');
		$cpage=I("cpage/d",1);
		$key=I("key/s");
		try {
			$tasks=M('tasks');
			$where=array(
	            "ipaddr" => array('like','%'.$key.'%'),
	            "_logic" => 'OR'
	        );
	        $map=array(
	            "_complex" => $where,
	            "state" => array(array('eq','待处理'),'处理中','or'),
	        );
	        if (!empty($cid)) {
	        	$map['cid']=$cid;
	        }
	        $taskcount = $tasks->where($map)->count("nid");
			$tasklst=$tasks->field('nid,cname,ipaddr,action,state,room,commit_at,receive_at,complete_at')->where($map)->page($cpage,15)->order('nid DESC')->select();
			$tasklst=array(
				"TotalCount"=>$taskcount,//总条数
	            "TaskList"=>$tasklst
	        );
			echo json_encode($tasklst);
			exit;
		} catch (Exception $e) {
			
		}
	}

	/**
	 * 根据IP获取客户真实姓名
	 */
	public function getnamebyipAction()
	{
		$ip=I('ip/s');
		$sp=strpos($ip, "/");
		$ip=empty($sp)?$ip."/":$ip;
		try {
			$servers=M('servers');
			$map["Serv_IP"]=array('like','%'.$ip.'%');
			$map["ServState"]="在线运行";
			$userinfo=$servers->field('CustName')->where($map)->find();
			echo json_encode($userinfo);
			exit;
		} catch (Exception $e) {
			
		}
	}

	/**
	 * 根据客户名获取名下ip列表
	 */
	public function usersvlstAction()
	{
		$custname=I('custname/s');
		$custname=urldecode($custname);
		try {
			$servers=M('servers');
			$map["CustName"]=$custname;
			$map["ServState"]="在线运行";
			$svlst=$servers->where($map)->getField('ID,Serv_IP');
			echo json_encode($svlst);
			exit;
		} catch (Exception $e) {
			
		}
	}

	/**
	 * 根据客户id获取客户信息
	 */
	public function userinfoAction()
	{
		$cid=I('cid/d');
		try {
			$clients=M('clients');
			$userinfo=$clients->field('name,cellphone,idnumber,addr,qq')->where('id =%d',$cid)->find();
			echo json_encode($userinfo);
			exit;
		} catch (Exception $e) {
			
		}
	}

	/**
	 * 修改客户信息
	 */
	public function edituserAction()
	{
		$cid=I('cid/d');
		try {
			$data=array(
				"name"=>I('name/s'),
				"cellphone"=>I('cellphone/s'),
				"idnumber"=>I('idnumber/s'),
				"addr"=>I('addr/s')
			);
			$clients=M('clients');
	    	if($clients->create($data)){
	    		if (!empty($cid)) {
	    			$clients->where("id=%d",$cid)->save($data);
	    		}
				echo json_encode(0);
				exit;
			}else{
				echo json_encode(1);
				exit;
			}
		} catch (Exception $e) {
			echo json_encode(1);
			exit;
		}
	}
	
	/**
	 * 根据邮箱获取crm客户id
	 */
	public function getidbymailAction()
	{
		$email=I('email/s');
		try {
			$clients=M('clients');
			$userinfo=$clients->field('id')->where("mail ='%s'",$email)->find();
			echo json_encode($userinfo);
			exit;
		} catch (Exception $e) {
			
		}
	}

	
	/**
	 * 检测访问的ip是否为规定的允许的ip
	 * Enter description here ...
	 */
	function check_ip(){
		$ALLOWED_IP=array('222.187.222.56','222.187.232.85','61.147.247.178','180.101.72.213','218.93.208.149');
		$IP=self::getIP();
		$check_ip_arr= explode('.',$IP);//要检测的ip拆分成数组
		#限制IP
		if(!in_array($IP,$ALLOWED_IP)) {
			foreach ($ALLOWED_IP as $val){
				if(strpos($val,'*')!==false){//发现有*号替代符
					$arr=array();//
					$arr=explode('.', $val);
					$bl=true;//用于记录循环检测中是否有匹配成功的
					for($i=0;$i<4;$i++){
						if($arr[$i]!='*'){//不等于*  就要进来检测，如果为*符号替代符就不检查
							if($arr[$i]!=$check_ip_arr[$i]){
								$bl=false;
								break;//终止检查本个ip 继续检查下一个ip
							}
						}
					}//end for
					if($bl){//如果是true则找到有一个匹配成功的就返回
						return;
						die;
					}
				}
			}//end foreach
			header('HTTP/1.1 403 Forbidden');
			echo "Access forbidden";
			die;
		}
	}
	
	/**
	 * 获得访问的IP
	 * Enter description here ...
	 */
	function getIP() {
		return isset($_SERVER["HTTP_X_FORWARDED_FOR"])?$_SERVER["HTTP_X_FORWARDED_FOR"]
		:(isset($_SERVER["HTTP_CLIENT_IP"])?$_SERVER["HTTP_CLIENT_IP"]
				:$_SERVER["REMOTE_ADDR"]);
	}
	
	//验证web端用户token是否正确，是否过期
	function checktoken($userid,$token)
	{
		$state=0;
		if($token==""){
			$state=2;//用户token错误
		}
		else{
			$select=$this->pgyidcdb->select()->from('users','UserID')
			->where('YungoID =?',$userid)
			->where('WebGuid=?', $token);
			$user=$this->pgyidcdb->fetchAll($select);
			if(empty($user)){
				$state=2;//用户token错误
			}
		}
		return $state;
	}
}