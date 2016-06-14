<?php
require_once('../modules/vars.php');
require_once('../modules/cookie.php');
?>
<!DOCTYPE>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/topbar.css">
		<link rel="stylesheet" type="text/css" href="css/banner.css">
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<link rel="stylesheet" type="text/css" href="css/footer.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300' rel='stylesheet' type='text/css'>
		<meta name="msvalidate.01" content="FE15AB1858F76A6FC24538172736298B" />
		<title>Gaming news, reviews, and more all in one place</title>
		<script src="js/analytics.js"></script>
	</head>
	<body>
		<?php require_once('../modules/block/topbar.php');?>
		<div id="splash">
			<div id="splashinr">
				<!--<div id="splashad">
					<iframe src="https://rcm-na.amazon-adsystem.com/e/cm?t=ramity06-20&o=1&p=48&l=ur1&category=intel4th&banner=1TM0REVV6VV1JZ6RXP82&f=ifr&linkID=HO4JLO5N6S6Y64I5" width="728" height="90" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>
				</div>-->
				<div class="splashitemwide">
					<div class="splashitemwideoverlayimg" style="background-image:url('img/backdrop.jpg');">
						<a class="splashitemwideoverlaytext" href="https://twitter.com/RamityOfficial" target="_blank">Follow us</a>
					</div>
				</div>
			</div>
		</div>
		<div id="products">
			<div id="productsinr">
				<div id="productsinrbanner">Products</div>
				<div class="productsinritem" style="background-image:url('img/products/1.jpg');"></div>
				<div class="productsinritem" style="background-image:url('img/products/2.jpg');"></div>
				<div class="productsinritem" style="background-image:url('img/products/3.jpg');"></div>
				<div class="productsinritem" style="background-image:url('img/products/4.jpg');"></div>
				<div class="productsinritem" style="background-image:url('img/products/5.jpg');"></div>
				<div class="productsinritem" style="background-image:url('img/products/6.jpg');"></div>
				<div class="productsinritem" style="background-image:url('img/products/7.jpg');"></div>
				<div class="productsinritem" style="background-image:url('img/products/8.jpg');"></div>
				<div class="productsinritem" style="background-image:url('img/products/9.jpg');"></div>
				<div class="productsinritem" style="background-image:url('img/products/10.jpg');"></div>
				<div class="productsinritem" style="background-image:url('img/products/11.jpg');"></div>
				<div class="productsinritem" style="background-image:url('img/products/12.jpg');"></div>
				<a id="productsinrlink" href="/products">View All</a>
			</div>
		</div>
		<div id="recentdev">
			<div id="recentdevinr">
				<div id="recentdevinrbanner">Development Log</div>
				<ul class="recentdevninrlistitem">
					<li>Work completed on frontpage</li>
					<li>Set up database structure</li>
					<li>Set up post structure</li>
					<li>Amazon afiliate?</li>
					<li>Site idea!</li>
				</ul>
				<ul class="recentdevninrlistitem">
					<li>Work completed on frontpage</li>
					<li>Set up database structure</li>
					<li>Set up post structure</li>
					<li>Amazon afiliate?</li>
					<li>Site idea!</li>
				</ul>
				<ul class="recentdevninrlistitem" style="margin-right:0px;">
					<li>Work completed on frontpage</li>
					<li>Set up database structure</li>
					<li>Set up post structure</li>
					<li>Amazon afiliate?</li>
					<li>Site idea!</li>
				</ul>
				<a id="recentdevlink" href="dev">View All</a>
			</div>
		</div>
		<?php require_once('../modules/block/footer.php');?>
	</body>
</html>
