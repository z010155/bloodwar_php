<?php
	//查询玩家
	//参数列表：
	//name:君主名
	//返回
	//array[0]:user_info
	if (!defined("MANAGE_INTERFACE")) exit;
	$name = addslashes($name);
	$ret[] = sql_fetch_rows("select u.*,o.name as officepos,n.name as nobility,from_unixtime(regtime) as regtime,un.name as `union` from sys_user u left join cfg_office_pos o on o.id=u.officepos left join cfg_nobility n on n.id=u.nobility left join sys_union un on un.id=u.union_id where u.uid > 1000 and u.name like '%".$name."%'");
?>