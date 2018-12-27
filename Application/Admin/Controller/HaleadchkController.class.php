<?php
namespace Admin\Controller;
use Think\Controller;
class HaleadchkController extends BaseController {
    //list
    public function listAction(){
        //部门
        $dptlist=M('department')->getField("ID,Name");
        $this->assign("dptlist",$dptlist);
        $key=I('keyword/s');
        $where=array(
            "RealName" => array('like','%'.$key.'%'),
            "AssessMonth" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $map=array(
            "_complex" => $where,
        );
        $count=M('assessment')->where($map)->count();
        $Page = new \Extend\Page($count,10);
        $Page->parameter['keyword'] = $key;
        $show = $Page->show();
        $list=M('assessment')->limit($Page->firstRow.','.$Page->listRows)->where($map)->order("ID desc")->select();
        foreach($list as $key=>$val){
            $dept=M('accounts')->where("realname='%s'",$val['realname'])->getField('dept');
            $list[$key]['dept']=$dept;
        }
        $this->assign("list",$list);
        $this->assign("page",$show);
        $this->assign("perm",C('perm'));
    	$this->display();
    }
    //new
    public function newAction(){
        $aclist=M('accounts')->where("isleave='%s' AND ischarge='%s'",'false','true')->order("name asc")->getField("nid,realname");
        $this->assign("aclist",$aclist);
        $this->display();
    }
    //view
    public function viewAction(){
        $list=M('assessresult')->where("Assessment_ID=%d",I('id'))->select();
        $this->assign("list",$list);
        $this->display();
    }
    //assessadd
    public function assessaddAction(){
        $data=M('assessment')->create();
        $data['UserProfile_ID']=M('accounts')->where("realname='%s'",$data['RealName'])->getField('nid');
        if(M('assessment')->add($data)){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
    //resultadd
    public function resultaddAction(){
        $assessmentid=M('assessment')->order("ID desc")->getField("ID");
        $data=M('assessresult')->create();
        $data['Assessment_ID']=$assessmentid;
        $data['WorkRemarks']=htmlspecialchars_decode($data['WorkRemarks']);
        M('assessresult')->add($data);
    }
    //getworkpool
    public function getworkpoolAction(){
        $map=array(
            "UserProfiles"=>array('like','%'.I('name').'%')
        );
        $list=M('workremark')->where($map)->getField("ID,Remarks");
        echo self::decodeUnicode(json_encode($list));
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
}