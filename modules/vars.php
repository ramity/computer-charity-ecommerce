<?php
error_reporting(E_ALL);
$currentUpdateVersion='0.01 Foxy';
if(isset($_SERVER['HTTP_HOST']))
	$domainName=$_SERVER['HTTP_HOST'];
$adminName="ramity";
$adminPassword="Gr33ndayadmin";
$secureLogin=false;
$salt='$6$rounds=5000$2a07fKFNGBoDjWAfb1jV5rnd-cPSuqbPDMM6jHvYpeTUKf';
$token=generateToken();
setlocale(LC_MONETARY,'en_US');
$livesecret='sk_live_O3m51l1GJAordTQQZfeyOn2M';
$livepublic='pk_live_OmlrL353nSWTXmrtUy40g0hY';
function buildUrl($input)
{
	echo "http://$_SERVER[HTTP_HOST]$input";
}
function buildConnection($input)
{
	try
	{
		$con=new PDO("mysql:host=localhost;dbname=$input",$GLOBALS['adminName'],$GLOBALS['adminPassword']);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $con;
	}
	catch(PDOException $ex){echo $ex->getMessage();}
}
function buildQuery($database,$input)
{
	try
	{
		$con=buildConnection($database);
		$stm=$con->prepare($input);
		$stm->execute();
		return $stm->fetch(PDO::FETCH_BOTH);
	}
	catch(PDOException $ex){echo $ex->getMessage();}
}
function buildQueryFetchAll($database,$input)
{
	try
	{
		$con=buildConnection($database);
		$stm=$con->prepare($input);
		$stm->execute();
		return $stm->fetchAll();
	}
	catch(PDOException $ex){echo $ex->getMessage();}
}
function buildQueryBind($database,$input,$data)
{
	try
	{
		$con=buildConnection($database);
		$stm=$con->prepare($input);
		$stm->execute($data);
		return $stm->fetch(PDO::FETCH_BOTH);
	}
	catch(PDOException $ex){echo $ex->getMessage();}
}
function buildQueryBindNoFetch($database,$input,$data)
{
	try
	{
		$con=buildConnection($database);
		$stm=$con->prepare($input);
		$stm->execute($data);
	}
	catch(PDOException $ex){echo $ex->getMessage();}
}
function buildEncryption($input,$salt)
{
	return trim(crypt($input,$salt),'$6$rounds=5000$');
}
function generateToken()
{
	return buildEncryption(uniqid(mt_rand(),true),$GLOBALS['salt']);
}
function buildQueryBindNoDatabaseOrFetch($input,$data)
{
	try
	{
		$con=new PDO("mysql:host=localhost;",$GLOBALS['adminName'],$GLOBALS['adminPassword']);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stm=$con->prepare($input);
		$stm->execute($data);
	}
	catch(PDOException $ex){echo $ex->getMessage();}
}

function cut($start,$finish,$value)
{
	$foo=explode($start,$value);
	if(!array_key_exists(1,$foo))
		return false;
	else
	{
		$bar=explode($finish,$foo[1]);
		return $bar;
	}
}
?>