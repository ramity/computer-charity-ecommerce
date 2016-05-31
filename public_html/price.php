<?php
require_once('/home/ramity/modules/vars.php');
if(isset($_POST)&&!empty($_POST))
{
	$price=($_POST['value']*100);
	$price+=2500;
	$price+=($_POST['shipping']*100);
	$price+=($price*.029)+30;
	$price=round($price,0);
	
	echo 'site price: '.$price/100,'<br>';
}
?>
<form action="https://ramity.com/price" method="post">
	<input type="text" name="value" placeholder="retail price">
	<input type="text" name="shipping" placeholder="shipping">
	<input type="submit">
</form>