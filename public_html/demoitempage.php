<?php
require_once('/home/ramity/modules/vars.php');
require_once('/home/ramity/modules/cookie.php');
?>
<!DOCTYPE>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>GTX 770 - Video Cards - Ramity.com</title>
		<link rel="stylesheet" type="text/css" href="https://ramity.com/css/topbar.css">
		<link rel="stylesheet" type="text/css" href="https://ramity.com/css/itempage.css">
		<link rel="stylesheet" type="text/css" href="https://ramity.com/css/purchase.css">
		<link rel="stylesheet" type="text/css" href="https://ramity.com/css/footer.css">
		<link href='https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300' rel='stylesheet' type='text/css'>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
		<script src="https://ramity.com/js/analytics.js"></script>
		<script>
		$(document).ready(function()
		{
			$(".itembackgrounditemlf, .itembackgrounditem").mouseover(function()
			{
				$(this).stop().animate({ backgroundColor:'#fff',color:'#000'},500);
			}).mouseout(function()
			{
				$(this).stop().animate({ backgroundColor:'transparent',color:'#fff'},500);
			});
		});
		</script>
	</head>
	<body>
		<?php require_once('/home/ramity/modules/block/topbar.php');?>
		<div id="itembackground" style="background-image:url('https://ramity.com/img/titanZ.jpg')">
			<div id="itembackgroundpos">
				<div id="itembackgroundinf">
					<div id="itembackgroundinr">
						<div class="itembackgrounditemlf">Like</div>
						<div class="itembackgrounditemlf">Comment</div>
						<div class="itembackgrounditemlf">Rate</div>
						<div class="itembackgrounditem">Buy</div>
						<div class="itembackgrounditem">Wish</div>
						<div class="itembackgrounditem">Subscribe</div>
					</div>
				</div>
			</div>
		</div>
		<div id="iteminf">
			<div id="iteminfinr">
				<div id="itemtitle">GTX 770</div>
				<div id="itemfunctions">
					<a class="itemfunctionsmall">1</a>
					<a class="itemfunctionsmall">2</a>
					<a class="itemfunctionsmall">3</a>
					<a class="itemfunctionsmall">4</a>
					<a class="itemfunctionsmall">5</a>
					<a class="itemfunctionbig">Buy</a>
				</div>
			</div>
		</div>
		<?php require_once('/home/ramity/modules/block/footer.php');?>
	</body>
</html>