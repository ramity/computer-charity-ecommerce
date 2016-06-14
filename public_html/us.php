<?php
require_once('../modules/vars.php');
require_once('../modules/cookie.php');
?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Custom built PCs. Liquid cooled and high performing components to meet all your gaming needs.">
		<meta name="keywords" content="gaming, custom, PC, deals, gaming computers, best pcs, custom computers">
		<meta name="author" content="Lewis Brown">
		<link rel="stylesheet" type="text/css" href="css/topbar.css">
		<link rel="stylesheet" type="text/css" href="css/us.css">
		<link rel="stylesheet" type="text/css" href="css/footer.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300' rel='stylesheet' type='text/css'>
		<title>Custom PCs, gaming news, reviews, and more all in one place</title>
	</head>
	<body>
		<?php require_once('../modules/block/topbar.php');?>
		<div id="us">
			<div id="usinr">
				<div id="usprofile">
					<div id="usprofilepos">
						<div id="usprofileposlogo"></div>
					</div>
					<div id="usprofilebanner" style="background-color:rgba(255,255,255,0.5);border-right:2.5px solid #0cf;"></div>
					<div id="usprofilebanner" style="background-color:rgba(0,0,0,0.5);border-left:2.5px solid #0cf;"></div>
					<div id="usprofilelistbar">
						<div class="usprofilecoverlistbartitle">Our Team Members:</div>
						<div class="usprofilecoverlistbaritem">
							<div class="usprofilecoverlistbaritemname">Lewis</div>
							<div class="usprofilecoverlistbaritemjob">FullStack Dev</div>
						</div>
						<div class="usprofilecoverlistbaritem">
							<div class="usprofilecoverlistbaritemname">Austin</div>
							<div class="usprofilecoverlistbaritemjob">Art Director</div>
						</div>
						<div class="usprofilecoverlistbaritem">
							<div class="usprofilecoverlistbaritemname">Thomas</div>
							<div class="usprofilecoverlistbaritemjob">Product Manager</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php require_once('../modules/block/footer.php');?>
	</body>
</html>
