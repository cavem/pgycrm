<?php
namespace Admin\Controller;
use Think\Controller;
class AccountController extends BaseController {
    //list
    public function listAction(){
        $cpage=I('p/d',1);
        $key=I('keyword/s');
        $where=array(
            "name" => array('like','%'.$key.'%'),
            "realname" => array('like','%'.$key.'%'),
            "level" => array('like','%'.$key.'%'),
            "dept" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $map=array(
            "_complex" => $where,
            "nid" => array('gt',1)
        );
        $count=M('accounts')->where($map)->count();
        $Page = new \Extend\Page($count,10);
        $Page->parameter['keyword'] = $key;
        $show = $Page->show();
        $accountslist=M('accounts')->limit($Page->firstRow.','.$Page->listRows)->where($map)->select();
        for($i=0;$i<count($accountslist);$i++){
            $accountslist[$i]['no']=($cpage-1)*10+$i+1;
            $perm=$accountslist[$i]['perm'];
            $permarr=json_decode($perm,true);
            $powernum=0;
            foreach($permarr as $key=>$val){
                foreach($val as $key2=>$val2){
                    foreach($val2 as $key3=>$val3){
                        if(!strpos($key3,'_')){
                            if($val3=="1"){
                                $powernum++;
                            }
                        }
                    }
                }
            }
            $accountslist[$i]['powernum']=$powernum;
        }
        // print "<pre>";
        // print_r($accountslist);exit;
        $this->assign("accountslist",$accountslist);
        $this->assign("page",$show);
        $this->assign("count",$count);
        $this->assign("perm",C('perm'));
    	$this->display();
    }
    //new
    public function newAction(){
        $powerlist=self::getpowerlist();
        $roomlist=M('rooms')->getField('id,name');
        $userlist=M('accounts')->where('nid != 1')->getField('nid,realname,dept');
        $roleslist=M('roles')->select();
        if(IS_POST){
            $requestdata=file_get_contents("php://input");
            $dataarr=explode("&",$requestdata);
            foreach($dataarr as $key => $vl){
                if($key>10){
                    $truevl=explode("=",$vl);
                    $typearr=explode("-",$truevl[0]);
                    $powerlist[$typearr[0]][$typearr[1]][$typearr[2]]="1";
                }
            }
            if(I('post.perm')==""){
                $powerlist=self::decodeUnicode(json_encode($powerlist));
            }else{
                $powerlist=str_replace('&quot;','"',I('post.perm'));
            }
            $data=array(
                "name"  => I('post.name'),
                "passwd" => md5(I('post.password')),
                "realname" => I('post.realname'),
                "level" => I('post.level'),
                "dept" => I('post.dept'),
                "ischarge" => I('post.ischarge'),
                "issales" => I('post.issales'),
                "isleave" => I('post.isleave'),
                "leads" => self::decodeUnicode(json_encode(explode(',',I('post.leads')))),
                "rooms" => self::decodeUnicode(json_encode(explode(',',I('post.rooms')))),
                "role" => "",
                "perm" => $powerlist,
                "recvs" => self::decodeUnicode(json_encode(explode(',',I('post.recvs')))),
                "super" => "false",
            );
            if(M('accounts')->add($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->assign("powerlist",$powerlist);
        $this->assign("roomlist",$roomlist);
        $this->assign("userlist",$userlist);
        $this->assign("roleslist",$roleslist);
        $this->display();
    }
    //edit
    public function editAction(){
        if(IS_POST){
            $powerlist=self::getpowerlist();
            $requestdata=file_get_contents("php://input");
            $dataarr=explode("&",$requestdata);
            foreach($dataarr as $key => $vl){
                if($key>10){
                    $truevl=explode("=",$vl);
                    $typearr=explode("-",$truevl[0]);
                    $powerlist[$typearr[0]][$typearr[1]][$typearr[2]]="1";
                }
            }
            if(I('post.perm')==""){
                $powerlist=self::decodeUnicode(json_encode($powerlist));
            }else{
                $powerlist=str_replace('&quot;','"',I('post.perm'));
            }
            $data=array(
                "name"  => I('post.name'),
                "realname" => I('post.realname'),
                "level" => I('post.level'),
                "dept" => I('post.dept'),
                "ischarge" => I('post.ischarge'),
                "issales" => I('post.issales'),
                "isleave" => I('post.isleave'),
                "leads" => self::decodeUnicode(json_encode(explode(',',I('post.leads')))),
                "rooms" => self::decodeUnicode(json_encode(explode(',',I('post.rooms')))),
                "role" => "",
                "perm" => $powerlist,
                "recvs" => self::decodeUnicode(json_encode(explode(',',I('post.recvs')))),
                "super" => "false",
            );
            if(I('post.password')){
                $data['passwd']=md5(I('post.password'));
            }
            if(M('accounts')->where("name='%s'",I('post.name'))->save($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $name=I('name/s');
        $userinfo=M('accounts')->where("name='%s'",$name)->find();
        $powerlist=json_decode($userinfo['perm'],true);
        $merooms=json_decode($userinfo['rooms'],true);
        $meleads=json_decode($userinfo['leads'],true);
        $merecvs=json_decode($userinfo['recvs'],true);
        $roomlist=M('rooms')->getField('id,name');
        $userlist=M('accounts')->where('nid != 1')->getField('nid,realname,dept');
        $roleslist=M('roles')->select();
        $this->assign("info",$userinfo);
        $this->assign("powerlist",$powerlist);
        $this->assign("roomlist",$roomlist);
        $this->assign("userlist",$userlist);
        $this->assign("merooms",$merooms);
        $this->assign("meleads",$meleads);
        $this->assign("merecvs",$merecvs);
        $this->assign("roleslist",$roleslist);
        $this->display();
    }
    //remove
    public function removeAction(){
        $name=I('name/s');
        if(M('accounts')->where("name='%s'",$name)->delete()){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
    //view
    public function viewAction(){
        $name=I('name/s');
        $userinfo=M('accounts')->where("name='%s'",$name)->find();
        $powerlist=json_decode($userinfo['perm'],true);
        $this->assign('userinfo',$userinfo);
        $this->assign('powerlist',$powerlist);
        $this->display();
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
    //获取powerlist
    function getpowerlist(){
        $powerjson='{"我的工作区":{"公司公告":{"新增":"0","修改":"0","删除":"0"},"技术公告":{"新增":"0","修改":"0","删除":"0"}},"工单系统":{"我的工单":{"新工单":"0","领工单":"0","工单池":"0","工单池_指派":"0","工单池_修改":"0","工单池_删除":"0","待确认":"0","待确认_确认":"0","待确认_指派":"0","待确认_修改":"0","待确认_删除":"0","待验证":"0","待验证_验证":"0","待验证_指派":"0","待验证_修改":"0","待验证_删除":"0","带宽确认":"0","带宽确认_确认":"0","带宽确认_指派":"0","带宽确认_修改":"0","带宽确认_删除":"0","财务确认":"0","财务确认_确认":"0","财务确认_指派":"0","财务确认_修改":"0","财务确认_删除":"0","待审核":"0","待审核_确认":"0","待审核_指派":"0","待审核_修改":"0","待审核_删除":"0","上架位置确认":"0","上架位置确认_确认":"0","上架位置确认_指派":"0","上架位置确认_修改":"0","上架位置确认_删除":"0","库管确认":"0","库管确认_确认":"0","库管确认_指派":"0","库管确认_修改":"0","库管确认_删除":"0","未解决":"0","未解决_放回处理":"0","未解决_指派":"0","未解决_修改":"0","未解决_删除":"0"},"我的记录":{"查看":"0"},"工单报表":{"查看":"0","删除":"0","导出":"0","工单重置":"0","奖金清零":"0"},"回收站":{"查看":"0","恢复":"0"}},"业务管理":{"服务器管理":{"导出":"0","查看":"0","客户信息":"0","修改":"0","删除":"0","下架":"0","问题处理":"0","服务器转让":"0","系统安装":"0"}},"客户管理":{"客户列表":{"客户立案":"0","查看":"0","修改":"0","删除":"0","订单":"0","预付款":"0"}},"订单管理":{"订单管理":{"新增财务收入":"0","新上架":"0","查看":"0","修改":"0","删除":"0","恢复生效":"0"},"订单统计":{"导出":"0"}},"财务管理":{"财务收入":{"新增":"0","查看":"0","修改":"0","删除":"0","款到确认":"0","主管确认":"0"},"收款统计":{"导出":"0"}},"人事管理":{"工作池管理":{"新增":"0","查看":"0","修改":"0","删除":"0"},"员工考核":{"查看":"0","考核":"0"},"主管考核":{"查看":"0","考核":"0"}},"资源管理":{"产品分类":{"新增":"0","删除":"0"},"产品管理":{"新增":"0","查看":"0","修改":"0","删除":"0"},"IP段管理":{"新增":"0","查看":"0","修改":"0","删除":"0","IP管理":"0"},"机房管理":{"新增":"0","查看":"0","修改":"0","删除":"0"},"机柜管理":{"新增":"0","查看":"0","修改":"0","删除":"0"},"交换机管理":{"新增":"0","查看":"0","修改":"0","删除":"0"},"机器型号":{"新增":"0","查看":"0","修改":"0","删除":"0"},"操作系统":{"新增":"0","查看":"0","修改":"0","删除":"0"}},"系统管理":{"部门管理":{"新增":"0","查看":"0","修改":"0","删除":"0"},"角色权限":{"新增":"0","查看":"0","修改":"0","删除":"0"},"账户管理":{"新增":"0","查看":"0","修改":"0","删除":"0"},"账户等级":{"新增":"0","修改":"0","删除":"0"},"处理方式":{"新增":"0","查看":"0","修改":"0","删除":"0"},"日志查询":{"查看":"0","删除":"0"}},"域名相关":{"宿迁域名过白":{"使用":"0"},"扬州域名过白":{"使用":"0"},"域名黑名单":{"使用":"0"},"非法域名":{"使用":"0"}},"防火墙相关":{"金盾防护CC":{"使用":"0"},"金盾CC参数":{"使用":"0"},"金盾IP释放":{"使用":"0"},"金盾黑名单":{"使用":"0"},"IP直通设置":{"使用":"0"},"IP直通记录":{"使用":"0"},"安全盾防护CC":{"使用":"0"},"IP白名单":{"使用":"0"},"连接数查看":{"使用":"0"}},"防御相关":{"防御设置":{"使用":"0"},"防御区记录":{"使用":"0"},"防护查看":{"使用":"0"}},"牵引相关":{"牵引状态":{"使用":"0"},"攻击记录":{"使用":"0"},"牵引策略":{"使用":"0"},"牵引策略(电信)":{"使用":"0"},"单IP牵引策略设置":{"使用":"0"},"十分钟内攻击记录":{"使用":"0"}},"自动化":{"IPMI管理":{"使用":"0"}}}';
        return json_decode($powerjson,true);
    }
}