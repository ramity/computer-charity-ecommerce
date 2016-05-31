<?php
function checkCookieAuth($name)
{
	if(isset($_COOKIE[$name])&&!empty($_COOKIE[$name]))
	{
		$crumbs=explode('-',$_COOKIE[$name]);
		$cookieId=$crumbs[0];
		$cookiePassword=$crumbs[1];
		$cookieTime=$crumbs[2];
		$cookieToken=$crumbs[3];
		$cookieIp=$crumbs[4];
		if(!empty($inf=buildQueryBind('ramity_collection','SELECT * FROM `users` WHERE id=:id AND password=:password AND token=:token AND lastip=:lastip',array('id'=>$cookieId,'password'=>$cookiePassword,'token'=>$cookieToken,'lastip'=>$cookieIp))))
		{
			buildQueryBindNoFetch('ramity_collection','UPDATE `users` SET token=:token WHERE id=:id AND password=:password',array('token'=>$cookieToken,'id'=>$cookieId,'password'=>$cookiePassword));
			return $inf;
		}
		else
		{
			setcookie('inf',null, time()-3600);
		}
	}
}
if(!empty($inf=checkCookieAuth('inf')))
{
	$secureLogin=true;
	if($inf['updateVersion']!==$GLOBALS['currentUpdateVersion'])
	{
		//buildQueryBindNoDatabaseOrFetch('CREATE DATABASE IF NOT EXISTS :databasename',array('databasename'=>$ndb));
		//buildQueryBindNoFetch('ramity_collection','UPDATE `users` SET updateVersion=:updateVersion WHERE id=:id AND password=:password',array('updateVersion'=>$GLOBALS['currentUpdateVersion'],'id'=>$inf['id'],'password'=>$inf['password']));
	}
}
?>