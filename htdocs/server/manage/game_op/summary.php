<?php
	//每日注册人数统计
	//参数列表：
	//返回
	//[0]:记录时间
	//[1]:即时在线人数
	//[2]:10分钟在线人数
	//[3]:30分钟在线人数
	//[4]:当日在线人数
	if (!defined("MANAGE_INTERFACE")) exit;
     $ret[] = sql_fetch_one_cell("select now()");
	 $ret[] =  sql_fetch_one_cell("select count(0) AS `count(*)` from `sys_online` where ((unix_timestamp() - `lastupdate`) < 60) "); 
     $ret[] =  sql_fetch_one_cell("select count(0) AS `count(*)` from `sys_online` where ((unix_timestamp() - `lastupdate`) < 600) ");  
     $ret[] =  sql_fetch_one_cell("select count(0) AS `count(*)` from `sys_online` where ((unix_timestamp() - `lastupdate`) < 1800) ");  
     
	$unix_time = sql_fetch_one_cell("select unix_timestamp()");  
	$time_between = ($unix_time+8*3600)%86400; 
	$ret[] =  sql_fetch_one_cell("select count(0) AS `count(*)` from `sys_online` where ((unix_timestamp() - `lastupdate`) < $time_between) ");
?>