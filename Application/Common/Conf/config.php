<?php
return array(
	//配置静态资源文件路径
    'TMPL_PARSE_STRING' => array (
            '__HOME__' => __ROOT__.'/Public/home',
            '__ADMIN__' => __ROOT__.'/Public/Admin'
        ),
    'MODULE_ALLOW_LIST'    =>    array('Home','Admin'),
	//'配置项'=>'配置值'
	'LOAD_EXT_CONFIG' => 'db',
	'URL_MODEL'=>2,		//URL模式
	'DATA_CACHE_TYPE'=>'Memcache',
	'MEMCACHE_HOST'   => 'tcp://127.0.0.1:11211',  
	'DATA_CACHE_TIME' => '3600',
	'SHOW_PAGE_TRACE' => true 		//显示跟踪信息
	//'DEFAULT_MODEL' => 'Admin'
);