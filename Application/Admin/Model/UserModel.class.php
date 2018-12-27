<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends Model {
	protected $trueTableName = 'users'; 
	
	//生成web端用户token
    public function settoken($userid)
    {
    	$userModel=M('users');
    	//生成用户token
    	$charid = strtoupper(md5(uniqid(mt_rand(), true)));
    	$hyphen = chr(45);// "-"
    	$uuid = substr($charid, 0, 8).$hyphen
		    	.substr($charid, 8, 4).$hyphen
		    	.substr($charid,12, 4).$hyphen
		    	.substr($charid,16, 4).$hyphen
		    	.substr($charid,20,12);
    	$token=$userid.$uuid;
    	$data=array(
    		'LastTime'=>time(),
    		'WebGuid'=>$token,
    		'EffectiveTime'=>date("Y-m-d H:i:s",strtotime("+1 day"))
    	);
    	if (!$userModel->create($data)) {
            $this->error($userModel->getError());
        }else{
            if ($userModel->where("UserID= %d",$userid)->save($data)) {
                return 0;
            } else {
                return 1;
            }        
        }
    }
}