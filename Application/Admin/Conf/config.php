<?php
return array(
	'URL_HTML_SUFFIX'=>'html',
	'URL_ROUTER_ON'   => true, //开启路由
	'URL_ROUTE_RULES' => array( //定义路由规则 
	),
	'TMPL_PARSE_STRING' => array(
        '__APC__' => __ROOT__.'/Application/'.MODULE_NAME.'/View/Public',
    ),
);