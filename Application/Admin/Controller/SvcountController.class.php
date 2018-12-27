<?php
namespace Admin\Controller;
use Think\Controller;
class SvcountController extends BaseController {
    //list
    public function listAction(){
        // ini_set('memory_limit','1024M');
        // set_time_limit (0);
        // $map=array(
        //     "ID" => array('egt',16796),
        //     "ServState" => '在线运行',
        //     "InsertTime" => array('exp','is null'),
        // );
        // $list=M('servers')->field('ServNum')->where($map)->order("ID desc")->select();
        // foreach($list as $val){
        //     $str=substr($val['servnum'],2,8);
        //     $y=substr($str,0,4);
        //     $m=substr($str,4,2);
        //     $d=substr($str,6,2);
        //     $inserttime=$y.'-'.$m.'-'.$d;
        //     M('servers')->where("ServNum='%s'",$val['servnum'])->setField("InsertTime",$inserttime);
        // }
        if(IS_POST){
            M()->execute("truncate table svcount");
        }
        if(!M('svcount')->count()){
            for($i=2018;$i<=date("Y");$i++){
                for($j=1;$j<=date("m");$j++){
                    if($j<10){
                        $j='0'.$j;
                    }
                    $n1=M('servers')->where(array("ServState" => "在线运行","ID" => array('lt',16796)))->count();
                    if(date("Ym")==$i.$j&&date("d")<15){
                        break;
                    }
                    $map=array(
                        "ID" => array('egt',16796),
                        "InsertTime" => array("between",array("2018-01-01",$i.'-'.$j.'-15'))
                    );
                    $n2=M('servers')->where("ServState='在线运行'")->where($map)->count();
                    $data1=array(
                        "num" => $n1+$n2,
                        "time" => $i.'-'.$j.'-15', 
                    );
                    M('svcount')->add($data1);
                    $time='';
                    if($j==1||$j==3||$j==5||$j==7||$j==8||$j==10||$j==12){
                        if(date("Ym")==$i.$j&&date("d")-15<0){
                            break;
                        }
                        $time=$i.'-'.$j.'-31';
                        $map2=array(
                            "ID" => array('egt',16796),
                            "InsertTime" => array("between",array("2018-01-01",$time))
                        );
                    }else if($j==2){
                        if(date("Ym")==$i.$j&&date("d")-15<0){
                            break;
                        }
                        $time=$i.'-'.$j.'-28';
                        $map2=array(
                            "ID" => array('egt',16796),
                            "InsertTime" => array("between",array("2018-01-01",$time))
                        );
                    }else{
                        if(date("Ym")==$i.$j&&date("d")-15<0){
                            break;
                        }
                        $time=$i.'-'.$j.'-30';
                        $map2=array(
                            "ID" => array('egt',16796),
                            "InsertTime" => array("between",array("2018-01-01",$time))
                        );
                    }
                    $n3=M('servers')->where("ServState='在线运行'")->where($map2)->count();
                    $data2=array(
                        "num" => $n1+$n3,
                        "time" => $time, 
                    );
                    M('svcount')->add($data2);
                }
            }
        }
        $sc=I('sc/s','id desc');
        $sc=str_replace("+"," ",$sc);
        $key=trim(I('keyword/s'));
        $map=array(
            "time" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $count=M('svcount')->where($map)->count();
        $p = getpage($count,15);
        $p->parameter['keyword'] = $key;
        $show = $p->show();
        $list=M('svcount')->limit($p->firstRow.','.$p->listRows)->where($map)->order($sc)->select();
        $this->assign("list",$list);
        $this->assign("page",$show);
        $this->assign("sc",$sc);
        $this->assign("key",$key);
        $this->display();
    }
}