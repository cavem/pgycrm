<?php
return array(
	//'配置项'=>'配置值'
    'MODULE_ALLOW_LIST' =>    array('Home','Admin',),
	'DEFAULT_MODULE'     => 'Admin', //默认模块
    'URL_MODEL'          => '2', //URL模式
    'SESSION_AUTO_START' => true, //是否开启session
    'ACTION_SUFFIX'      =>  'Action', // 操作方法后缀
    'LOAD_EXT_CONFIG'   => 'alipay', 
    'USER_CONFIG'        => array(
        'USER_AUTH' => true,
        'USER_TYPE' => 2,
    ),
    //更多配置参数
    'URL_CASE_INSENSITIVE' =>true, //不区分大小写
    //默认数据库配置
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'crmdb', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'caicai525217', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => '', // 数据库表前缀 
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增
    //ym数据库配置
    /*'ym' => array(
        'DB_TYPE'  => 'mysql',
        'DB_USER'  => 'xiaocai',
        'DB_PWD'   => 'BReDbMJHnHHfHbkj',
        'DB_HOST'  => '180.101.72.210',
        'DB_PORT'  => '3306',
        'DB_NAME'  => 'ym',
        'DB_PREFIX' => '', // 数据库表前缀 
        'DB_CHARSET'=> 'utf8', // 字符集
    ),*/
);