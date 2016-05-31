<?php
if(isset($_POST['login'])&&!empty($_POST['login'])){
	if(!empty($_POST['loginusername'])){
		if(!empty($_POST['loginpassword'])){
			if(strlen($_POST['loginusername'])>4){
				if(strlen($_POST['loginpassword'])>4){
					if(strlen($_POST['loginusername'])<26){
						if(strlen($_POST['loginpassword'])<65){
							if(ctype_alnum($_POST['loginusername'])){
								tryLogin();
							}else{$postErrorMessage="username must be alphanumeric characters";}
						}else{$postErrorMessage="password requires 5-64 characters";}
					}else{$postErrorMessage="username requires 5-25 characters";}
				}else{$postErrorMessage="password requires 5-64 characters";}
			}else{$postErrorMessage="username requires 5-25 characters";}
		}else{$postErrorMessage="password required";}
	}else{$postErrorMessage="username required";}
}
if(isset($_POST['register'])&&!empty($_POST['register'])){
	if(!empty($_POST['registeremail'])){
		if(!empty($_POST['registerusername'])){
			if(!empty($_POST['registerpassword'])){
				if(!empty($_POST['registerconfirmpassword'])){
					if($_POST['registerpassword']==$_POST['registerconfirmpassword']){
						if(strlen($_POST['registerusername'])>4){
							if(strlen($_POST['registerpassword'])>4){
								if(strlen($_POST['registerusername'])<26){
									if(strlen($_POST['registerpassword'])<65){
										tryRegister();
									}else{$postErrorMessage="password requires 5-64 characters";}
								}else{$postErrorMessage="username requires 5-25 characters";}
							}else{$postErrorMessage="password requires 5-64 characters";}
						}else{$postErrorMessage="username requires 5-25 characters";}
					}else{$postErrorMessage="passwords do not match";}
				}else{$postErrorMessage="confirm password required";}
			}else{$postErrorMessage="password required";}
		}else{$postErrorMessage="username required";}
	}else{$postErrorMessage="email required";}
}
function tryLogin()
{
	if(!empty($logincheck=buildQueryBind('ramity_collection','SELECT id,username,password,timezoneoffset FROM `users` WHERE username=:username AND password=:password',array('username'=>$_POST['loginusername'],'password'=>buildEncryption($_POST['loginpassword'],$GLOBALS['salt'])))))
	{
		if(!empty($_POST['logintimezoneoffset']))
		{
			if($logincheck['timezoneoffset']!=$_POST['logintimezoneoffset'])
			{
				buildQueryBindNoFetch('ramity_collection','UPDATE `users` SET timezoneoffset=:timezoneoffset WHERE id=:id AND username=:username',array('timezoneoffset'=>$_POST['logintimezoneoffset'],'id'=>$logincheck['id'],'username'=>$logincheck['username']));
			}
		}
		buildQueryBindNoFetch('ramity_collection','UPDATE `users` SET token=:token WHERE id=:id AND username=:username',array('token'=>$GLOBALS['token'],'id'=>$logincheck['id'],'username'=>$logincheck['username']));
		if(isset($_POST['loginremember']))
		{
			setCookie('inf',$logincheck['id'].'-'.$logincheck['password'].'-'.microtime(true).'-'.$GLOBALS['token'].'-'.$_SERVER['REMOTE_ADDR'],time()+60*60*24*7,'/','.ramity.com',true,true);
			header('Location:https://ramity.com/');
		}
		else
		{
			setCookie('inf',$logincheck['id'].'-'.$logincheck['password'].'-'.microtime(true).'-'.$GLOBALS['token'].'-'.$_SERVER['REMOTE_ADDR'],false,'/','.ramity.com',true,true);	
			header('Location:https://ramity.com/');
		}
	}
	else
	{
		$GLOBALS['postErrorMessage']="incorrect login information";
	}
}
function tryRegister()
{
	if(empty(buildQueryBind('ramity_collection','SELECT username FROM `users` WHERE username=:username',array('username'=>$_POST['registerusername']))))
	{
		if(empty(buildQueryBind('ramity_collection','SELECT email FROM `users` WHERE email=:email',array('email'=>$_POST['registeremail']))))
		{
			buildQueryBindNoFetch('ramity_collection',"INSERT INTO `users` (id,username,email,password,datecreated,timezoneoffset,lastonline,lastip,token,authorization,disabled,deleted) VALUES('',:username,:email,:password,:datecreated,:timezoneoffset,:lastonline,:lastip,:updateVersion,:token,'0','0','0')",array('username'=>$_POST['registerusername'],'email'=>$_POST['registeremail'],'password'=>buildEncryption($_POST['registerpassword'],$GLOBALS['salt']),'datecreated'=>microtime(true),'timezoneoffset'=>$_POST['registertimezoneoffset'],'lastonline'=>microtime(true),'lastip'=>$_SERVER['REMOTE_ADDR'],'updateVersion'=>$GLOBALS['currentUpdateVersion'],'token'=>$GLOBALS['token']));
			header('Location:https://ramity.com/signin?success=true');
		}
		else{$GLOBALS['postErrorMessage']="this email has already been used";}
	}
	else{$GLOBALS['postErrorMessage']="username taken";}
}
?>