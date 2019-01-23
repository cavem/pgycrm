<?php
namespace Admin\Controller;
use Think\Controller;
class CustomController extends BaseController {
    //list
    public function listAction(){
        $sc=I('sc/s','id desc');
        $sc=str_replace("+"," ",$sc);
        $key=I('keyword/s');
        $where=array(
            "name" => array('like','%'.$key.'%'),
            "qq" => array('like','%'.$key.'%'),
            "tel" => array('like','%'.$key.'%'),
            "cellphone" => array('like','%'.$key.'%'),
            "mail" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $map=array(
            "_complex" => $where,
            "id" => array('neq',0),
        );
        if(I('salers/s')!=''){
            $map['salesman']=I('salers/s');
            $this->assign("salers",I('salers/s'));
        }
        $count=M('clients')->where($map)->count();
        $p = getpage($count,15);
        $p->parameter['keyword'] = $key;
        $show = $p->show();
        $clientlist=M('clients')->limit($p->firstRow.','.$p->listRows)->where($map)->order($sc)->select();
        // print "<pre>";
        // print_r($clientlist);exit;
        $this->assign("count",$count);
        $this->assign("page",$show);
        $this->assign("clientlist",$clientlist);
        $this->assign("perm",C('perm'));
        $this->assign("sc",$sc);
        $this->assign("key",$key);
        //销售人员
        $sales=M('accounts')->field('realname')->where("dept='%s' AND isleave='%s'",'销售部','false')->select();
        $this->assign("sales",$sales);
        $this->display();
    }
    //new
    public function newAction(){
        if(IS_POST){
            $data=M('clients')->create();
            $data['committer']=C('username');
            $data['create_at']=date("Y-m-d H:i:s");
            if(M('clients')->where("name='%s'",$data['name'])->getField('id')!=''||M('clients')->where("cellphone='%s'",$data['cellphone'])->getField('id')!=''||M('clients')->where("qq='%s'",$data['qq'])->getField('id')!=''){
                $this->ajaxReturn("该用户已存在");exit;
            }
            if(M('clients')->add($data)){
                $id=M('clients')->where("name='%s'",$data['name'])->getField('id');
                //新增财务收入信息
                $paydata=array(
                    "cid" => $id,
                    "cname" => $data['name'],
                    "year" => date("Y")
                );
                M('payment')->add($paydata);

                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        //销售人员
        $sales=M('accounts')->field('realname')->where("dept='%s' AND isleave='%s'",'销售部','false')->select();
        $this->assign("sales",$sales);
        $this->display();
    }
    //view
    public function viewAction(){
        //基本信息
        $name=I('name/s');
        $id=I('id/d');
        $map=array(
            "name" => $name,
            "id" => $id
        );
        $userinfo=M('clients')->where($map)->select();
        $servinfo=M('servers')->where("CustName='%s' AND ServState='%s'",$name,'在线运行')->select();
        //预付款记录
        $prepaylist=M('prepays')->where("cid = %d",$id)->select();
        $prepayloglist=M('prepaylog')->where("cid = %d",$id)->select();
        //订单列表
        $orderlist=M('orders')->field('order_begin_at,last_pay_at,status,ordertype,money,salesman')->where("cid = %d",$id)->select();
        //服务器 列表
        $servlist=M('servers')->field('ServNum,ShelfCode,ServState,OS,Serv_IP,InsertTime')->where("CustName = '%s' AND ServState='%s'",$name,'在线运行')->select();
        $this->assign("userinfo",$userinfo[0]);
        $this->assign("servinfo",$servinfo);
        $this->assign("prepaylist",$prepaylist);
        $this->assign("prepayloglist",$prepayloglist);
        $this->assign("orderlist",$orderlist);
        $this->assign("servlist",$servlist);
        $this->display();
    }
    //edit
    public function editAction(){
        $id=I('id/d');
        $clientinfo=M('clients')->where("id=%d",$id)->find();
        if(IS_POST){
            $data=M('clients')->create();
            $data['committer']=C('username');
            $data['create_at']=date("Y-m-d H:i:s");
            if(M('clients')->save($data)){
                //修改服务器信息
                $servdata=array(
                    "CustName" => $data['name'],
                    "CustTech" => $data['contact'],
                    "CustTel" => $data['cellphone']
                );
                M('servers')->where("Customer_ID=%d",$data['id'])->save($servdata);
                //修改订单信息
                M('orders')->where("cid=%d",$data['id'])->setField("cname",$data['name']);
                //修改财务信息
                M('finances')->where("cid=%d",$data['id'])->setField("cname",$data['name']);
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->assign("clientinfo",$clientinfo);
        //销售人员
        $sales=M('accounts')->field('realname')->where("dept='%s' AND isleave='%s'",'销售部','false')->select();
        $this->assign("sales",$sales);
        $this->display();
    }
    //add_pay
    public function add_payAction(){
        $name=I('name/s');
        $cid=I('cid/d');
        if(IS_POST){
            $data=M('prepays')->create();
            $data['id']='PP'.date("YmdHis");
            $data['create_at']=date("Y-m-d H:i:s");
            $prepay=M('clients')->where("id=%d",$data['cid'])->getField("prepay");
            $cdata=array(
                "prepay" => $prepay+$data['money'],
            );
            if(M('clients')->where("id=%d",$data['cid'])->save($cdata)){
                if(M('prepays')->add($data)){
                    $this->ajaxReturn(0);
                }else{
                    $this->ajaxReturn(1);
                }
            }else{
                $this->ajaxReturn(1);
            }
            
        }
        $this->assign("name",$name);
        $this->assign("cid",$cid);
        $this->display();
    }
    //add_order
    public function add_orderAction(){
        //订单信息
        $name=I('name/s');
        $salesman=I('salesman/s');
        $orderno='DD'.date("Ym-d-his");
        //服务器信息
        $roomlist=M('rooms')->getField('id,name');
        $pdtkindlist=M('categories')->select();
        if(IS_POST){
            $data=M('orders')->create();
            $data["prodlist"]=htmlspecialchars_decode(I('post.prodlist'));
            $data["committer"]=C("username");
            $data["create_at"]=date("Y-m-d h:i:s");
            $data["isnew"]=1;
            if(M('orders')->add($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->assign("name",$name);
        $this->assign("orderno",$orderno);
        $this->assign("salesman",$salesman);
        $this->assign("roomlist",$roomlist);
        $this->assign("pdtkindlist",$pdtkindlist);
        $this->display();
    }
    //getproduct
    public function getproductAction(){
        $category=I('post.category');
        $prolist=M('products')->field("name,price,desc")->where("category='%s'",$category)->select();
        print_r(self::decodeUnicode(json_encode($prolist)));
    }
    //remove
    public function removeAction(){
        $id=I('post.id');
        if(M('clients')->where("id=%d",$id)->delete()){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }

    //上传图片
    public function uploadimgAction(){
        if(is_uploaded_file($_FILES["file"]["tmp_name"]))
        {
            //将信息存放在变量中
            $upfile=$_FILES["file"];//用一个数组类型的字符串存放上传文件的信息
            $exten_name=pathinfo($upfile['name'],PATHINFO_EXTENSION);
            //生成照片证书guid
            $data=date('YmdHis');
            $name=$data.'.'.$exten_name;//便于以后转移文件时命名
            //如果打印则输出类似这样的信息Array ( [name] => m.jpg [type] => image/jpeg [tmp_name] => C:\WINDOWS\Temp\php1A.tmp [error] => 0 [size] => 44905 )
            $type=$upfile["type"];//上传文件的类型
            $size=$upfile["size"];//上传文件的大小
            $tmp_name=$upfile["tmp_name"];//用户上传文件的临时名称
            $error=$upfile["error"];//上传过程中的错误信息
            //对文件类型进行判断，判断是否要转移文件,如果符合要求则设置$ok=1即可以转移
            switch($type){
                case "image/gif" : $ok=1;
                break;
                case "image/jpg" : $ok=1;
                break;
                case "image/jpeg": $ok=1;
                break;
                case "image/png": $ok=1;
                break;
                default:$ok=0;
                break;
            }
            //如果文件符合要求并且上传过程中没有错误
            if($ok&&$error=='0'){
                //检查文件是否损坏
                $data = file_get_contents($tmp_name);
                $im = @imagecreatefromstring($data);
                if($im != false){
                    header("Content-type:text/html;charset=utf-8");
                    //乱码解决
                    $namea = iconv("utf-8","gb2312",$name);
                    //调用move_uploaded_file（）函数，进行文件转移
                    $path=$_SERVER['DOCUMENT_ROOT']."/Public/uploadpic/".$namea;
                    if (!file_exists(dirname($path))){
                        mkdir(dirname($path), 0777);
                    }
                    move_uploaded_file($tmp_name,$path);
                    $this->ajaxReturn("/Public/uploadpic/".$namea);
                    
                    exit();
                }
                else{
                    //如果文件不符合类型或者上传过程中有错误，提示失败
                    $this->ajaxReturn("图片损坏");
                    exit();
                }
            }else{
                //如果文件不符合类型或者上传过程中有错误，提示失败
                $this->ajaxReturn("上传失败");
                exit();
            }
        }
        else{
            echo "<p style='color:red'>请选择文件</p>";
            exit();
        }
    }
    //对unicode码进行解码
    function decodeUnicode($str)
    {
        return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
            create_function(
                '$matches',
                'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
            ),
            $str);
    }
    //导出csv
    public function exportcsvAction(){
        ini_set('memory_limit','1024M');
        set_time_limit (0);
        $sc=I('sc/s','id asc');
        $sc=str_replace("+"," ",$sc);
        $key=I('keyword/s');
        $where=array(
            "name" => array('like','%'.$key.'%'),
            "qq" => array('like','%'.$key.'%'),
            "tel" => array('like','%'.$key.'%'),
            "cellphone" => array('like','%'.$key.'%'),
            "mail" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $map=array(
            "_complex" => $where,
        );
        if(I('salers/s')!=''){
            $map['salesman']=I('salers/s');
        }
        $clientlist=M('clients')->where($map)->order($sc)->select();
        $str="ID,客户名称,QQ号码,手机号码,电话号码,身份证号,邮箱,客户等级,销售代表,客户状态,客户备注\n";
        foreach($clientlist as $item){
            $str.=$item['id']. "," .$item['name']. "," .$item['qq']. "," .$item['cellphone']. "," .$item['tel']. "," .$item['idnumber']. "," .$item['mail']. "," .$item['class']. "," .$item['salesman']. "," .$item['state']. "," .str_replace(array("\r\n","\r","\n"),"",$item['remark'])."\n";
        }
        $filename="客户".date("Ymdhis").".csv";
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