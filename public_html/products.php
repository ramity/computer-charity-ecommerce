<?php
require_once('../modules/vars.php');
require_once('../modules/cookie.php');

die('This page requires database integration.');

$results=buildQuery('ramity_collection','SELECT * FROM `builds` WHERE id=6');

if(!empty($results))
{
	$context=stream_context_create(array('https'=>array('method'=>"GET",'header'=>"Accept-language: en\r\n")));
	$file=file_get_contents($results['ppurl'],false,$context);
	$bits=explode('<!-- heading -->',$file);
	$totalprice=cut('<td style="text-align:right;padding-bottom:0px;color:#555;vertical-align:top;padding-top:2px;font-weight:bold;">','</td>',$file);
	$totalprice=$totalprice[0];
	$totalpricealt=str_replace('$','',$totalprice);
	$totalpricealt=str_replace('.','',$totalpricealt);
	if($totalpricealt!=$results['retailprice'])
	{
		buildQueryBindNoFetch('ramity_collection','UPDATE `builds` SET retailprice=:retailprice WHERE id=:id',array('retailprice'=>$totalpricealt,'id'=>$results['id']));
		echo '<meta http-equiv="refresh" content="0">';
	}
}
else
{

}
?>
<!DOCTYPE>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/topbar.css">
		<link rel="stylesheet" type="text/css" href="css/banner.css">
		<link rel="stylesheet" type="text/css" href="css/products.css">
		<link rel="stylesheet" type="text/css" href="css/footer.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300' rel='stylesheet' type='text/css'>
		<meta name="msvalidate.01" content="FE15AB1858F76A6FC24538172736298B" />
		<title>Gaming news, reviews, and more all in one place</title>
	</head>
	<body>
		<?php require_once('../modules/block/topbar.php');?>
		<div id="products">
			<div id="productsinr">
				<a href="search?id=<?php echo $results['id'];?>&type=build">
					<div id="productspromo" style="background-image:url('img/builds/<?php echo $results['id'];?>.jpg')">
						<div id="productstopbar">
							<div id="productstitle"><?php echo $results['title'];?></div>
							<div id="productsprice"><?php echo number_format($results['siteprice']/100,2,'.',','),' USD';?></div>
						</div>
					</div>
				</a>
				<div id="productspane">
					<?php
					$results=buildQueryFetchAll('ramity_collection','SELECT * FROM `builds` ORDER BY siteprice');
					foreach($results as $value)
					{
						echo '<a href="search?id='.$value['id'].'&type=build">';
							echo '<div class="productspaneitem">';
								echo '<div class="productspaneitemtitle">'.$value['title'].' - $'.number_format($value['siteprice']/100,2,'.',',').'</div>';
								echo '<div class="productspaneitemimage" style="background-image:url(img/builds/'.$value['id'].'.jpg)"></div>';
							echo '</div>';
						echo '</a>';
					}
					?>

				</div>
			</div>
		</div>
		<?php require_once('../modules/block/footer.php');?>
	</body>
</html>
