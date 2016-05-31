<?php
require_once('/home/ramity/modules/vars.php');
require_once('/home/ramity/modules/cookie.php');
if(isset($_GET['id'])&&!empty($_GET['id']))
{
	if(isset($_GET['type'])&&!empty($_GET['type'])&&$_GET['type']=='build')
	{
		$context=stream_context_create(array('https'=>array('method'=>"GET",'header'=>"Accept-language: en\r\n")));
		$type='build';
		$results=buildQueryBind('ramity_collection','SELECT * FROM `builds` WHERE id=:id',array('id'=>$_GET['id']));
		if(!empty($results))
		{
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
			header('location:https://ramity.com');
		}
	}
	//TODO
	//else if($_GET['type']==='product')
	//{
	//	$type='product';
	//}
}
else
{
	header('location:https://ramity.com');
}
?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Custom built PCs. Liquid cooled and high performing components to meet all your gaming needs.">
		<meta name="keywords" content="gaming, custom, PC, deals, gaming computers, best pcs, custom computers">
		<meta name="author" content="Lewis Brown">
		<link rel="stylesheet" type="text/css" href="https://ramity.com/css/topbar.css">
		<link rel="stylesheet" type="text/css" href="https://ramity.com/css/search.css">
		<link rel="stylesheet" type="text/css" href="https://ramity.com/css/footer.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
		<script src="https://ramity.com/js/analytics.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300' rel='stylesheet' type='text/css'>
		<title>Custom PCs, gaming news, reviews, and more all in one place</title>
	</head>
	<body>
		<?php require_once('/home/ramity/modules/block/topbar.php');?>
		<?php
		if($type==='build')
		{
		?>
		<div id="build">
			<div id="buildinr">
				<div id="buildinf">
					<div id="buildphoto" style="background-image:url('https://ramity.com/img/builds/<?php echo intval($_GET['id']);?>.jpg')">
						<div id="buildtopbar">
							<div id="buildtitle">
								<?php echo $results['title'];?>
							</div>
							<div id="buildprice">
								<?php echo number_format($results['siteprice']/100,2,'.',',').' USD';?>
							</div>
						</div>
						<div id="buildbar">
							<a class="buildbaritemfl">Like</a>
							<a class="buildbaritemfl">Comment</a>
							<a class="buildbaritemfl">Rate</a>
							<a class="buildbaritem" id="tosub">Subscribe</a>
							<a class="buildbaritem" id="towish">Wish</a>
							<a class="buildbaritem" id="tobuy">Buy</a>
							<script>
							$(document).ready(function()
							{
								$(".buildbaritem,.buildbaritemfl").mouseover(function()
								{
									$(this).stop().animate({backgroundColor:'#fff',color:'#000'},500);
								}).mouseout(function()
								{
									$(this).stop().animate({backgroundColor:'transparent',color:'#fff'},500);
								});
								
								$("#tobuy").click(function(event){scrollto(event,"#checkout");});
								$("#towish").click(function(event){scrollto(event,"#wish");});
								$("#tosub").click(function(event){scrollto(event,"#sub");});
							});
							function scrollto(event,element)
							{
								event.preventDefault();
								$('html,body').animate({
									scrollTop:$(element).offset().top-55
								},1500);
							}
							</script>
						</div>
					</div>
					<?php
					if(array_key_exists('extra',$results))
					{
						echo $results['extra'];
					}
					?>
					<div id="buildtext">
						<div id="buildtextrowtop">Part List</div>
						<?php
						$count=0;
						$totalprice=0;
						if(!empty($bits))
						{
							foreach($bits as $part)
							{
								$line=cut('<div style="margin-top:8px;">','</div>',$part);
								$line=cut('">','</a>',$line[0]);
								$itemname=$line[0];
								
								if(empty($itemname))continue;
								$line=cut('<b>','</b>',$part);
								$line=cut('">','</a>',$line[0]);
								$itemtype=$line[0];
								
								if(empty($itemtype))
								{
									$itemtype=$previoustype;
								}
								
								$previoustype=$itemtype;
								$line=cut(' rel="nofollow" target="_blank">','</a>',$part);
								$itemprice=$line[0];
								$tempprice=str_replace('$','',$itemprice);
								$tempprice=str_replace('.','',$tempprice);
								$totalprice+=$tempprice;
								echo '<div class="buildtextrow">'.$itemtype.' : '.$itemname.'</div>';
								$count++;
							}
						}
						?>
						<script>
						$(".buildtextrow").mouseover(function()
						{
							$(this).stop().animate({backgroundColor:'#fff'},500);
						}).mouseout(function()
						{
							$(this).stop().animate({backgroundColor:'#ccc'},500);
						});
						</script>
					</div>
				</div>
			</div>
		</div>
		<div id="checkout">
			<div id="checkoutinr">
				<div id="checkoutheader">Checkout</div>
				<div id="checkoutitems">
					<div id="checkoutinf">
						<div class="checkoutitemquantity">Quantity</div>
						<div class="checkoutitemname">Name</div>
						<div class="checkoutitemprice">Price (USD)</div>
					</div>
					<?php
					$itempepper=round(60.00/$count,2);
					if(!empty($bits))
					{
						foreach($bits as $part)
						{
							$line=cut('<div style="margin-top:8px;">','</div>',$part);
							$line=cut('">','</a>',$line[0]);
							$itemname=$line[0];
							
							if(empty($itemname))continue;
							$line=cut('<b>','</b>',$part);
							$line=cut('">','</a>',$line[0]);
							$itemtype=$line[0];
							
							if(empty($itemtype))
							{
								$itemtype=$previoustype;
							}
							
							$previoustype=$itemtype;
							$line=cut(' rel="nofollow" target="_blank">','</a>',$part);
							$itemprice=str_replace('$','',$line[0]);
							$itemprice+=$itempepper;
							
							echo '<div class="checkoutitem">';
								echo '<div class="checkoutitemquantity">1</div>';
								echo '<div class="checkoutitemname">'.$itemtype.' : '.$itemname.'</div>';
								echo '<div class="checkoutitemprice">'.$itemprice.'</div>';
							echo '</div>';
						}
					}
					?>
					<div class="checkouttotal">
						<div class="checkoutitemname" style="font-style:italic;margin-left:2px;color:#0cf;font-weight:bold;">What you would pay</div>
						<div class="checkoutitemprice" style="float:right">
							<?php echo number_format(($totalprice/100)+60.00,2,'.',',');?>
						</div>
					</div>
					<div class="checkoutitem">
						<?php
						$value=cut('Promo Discounts:</td>','</td>',$file);
						$value=cut('<td style="text-align:right;padding-bottom:0px;color:#555;vertical-align:top;padding-top:2px;">','</td>',$value[0]);
						?>
						<div class="checkoutitemquantity">-</div>
						<div class="checkoutitemname">Promo Discounts :</div>
						<div class="checkoutitemprice" style="color:rgb(74, 255, 74);font-weight:bold;"><?php echo str_replace('$','',$value[0]);?></div>
					</div>
					<div class="checkoutitem">
						<?php
						$value=cut('Mail-in Rebates:</td>','</td>',$file);
						$value=cut('<td style="text-align:right;padding-bottom:0px;color:#555;vertical-align:top;padding-top:2px;">','</td>',$value[0]);
						$mir=str_replace('$','',$value[0])*100;
						?>
						<div class="checkoutitemquantity">-</div>
						<div class="checkoutitemname">Mail-in Rebates :</div>
						<div class="checkoutitemprice" style="color:rgb(74, 255, 74);font-weight:bold;"><?php echo str_replace('$','',$value[0]);?></div>
					</div>
					<div class="checkouttotal">
						<div class="checkoutitemname" style="font-style:italic;margin-left:2px;color:#0cf;font-weight:bold;">After discounts</div>
						<div class="checkoutitemprice" style="float:right">
							<?php echo number_format(($results['retailprice']/100)+60.00,2,'.',',');?>
						</div>
					</div>
				</div>
				<div class="checkoutcharge">
					<div class="checkoutchargename">Building cost</div>
					<div class="checkoutchargevalue" style="color:rgb(74, 255, 74);font-weight:bold;">free</div>
				</div>
				<div class="checkoutcharge">
					<div class="checkoutchargename">
						<a href="https://ramity.com/charity" target="_blank" style="color:#000fff;">
							Charity donation
						</a>
					</div>
					<div class="checkoutchargevalue" style="color:rgb(74, 255, 74);font-weight:bold;">all profit</div>
				</div>
				<div class="checkoutcharge">
					<div class="checkoutchargename">Shipping (7-14 days)</div>
					<div class="checkoutchargevalue">5.00</div>
				</div>
				<?php
				$amount=$totalpricealt;
				$amount+=6000;
				//charity  : 5.00
				//profit   : 5.00
				//shipping : 50.00
				$pfee=($amount*.029)+30;
				$amount+=$pfee;
				if(round($amount,0)!=$results['siteprice'])
				{
					buildQueryBindNoFetch('ramity_collection','UPDATE `builds` SET siteprice=:siteprice WHERE id=:id',array('siteprice'=>$amount,'id'=>$results['id']));
					echo '<meta http-equiv="refresh" content="0">';
				}
				?>
				<div class="checkoutcharge">
					<div class="checkoutchargename">Processing Fees</div>
					<div class="checkoutchargevalue">
						<?php echo number_format($pfee/100,2,'.',',');?>
					</div>
				</div>
				<div class="checkouttotal" style="margin-bottom:20px;border-bottom:1px solid #ccc">
					<div class="checkoutitemname" style="font-style:italic;margin-left:2px;color:#0cf;font-weight:bold;">Ramity.com's price</div>
					<div class="checkoutitemprice" style="float:right">
						<?php echo number_format($amount/100,2,'.',',');?>
					</div>
				</div>
				<div class="checkoutcharge" style="text-align:center;background-color:#0cf;color:#fff;margin-bottom:20px;">
					You save : $<?php echo number_format((($totalprice+6000)-$amount)/100,2,'.',',');?> and donate 50 meals to people in America battling against hunger.
				</div>
			</div>
		</div>
		<?php
		require_once('/home/ramity/modules/stripe/lib/Stripe.php');
		Stripe::setApiKey('sk_live_O3m51l1GJAordTQQZfeyOn2M');
		if(isset($_POST)&&!empty($_POST)){
			if(isset($_POST['fname'])&&!empty($_POST['fname'])){
				if(isset($_POST['lname'])&&!empty($_POST['lname'])){
					if(isset($_POST['addressone'])&&!empty($_POST['addressone'])){
						if(isset($_POST['city'])&&!empty($_POST['city'])){
							if(isset($_POST['state'])&&!empty($_POST['state'])){
								if(isset($_POST['zipcode'])&&!empty($_POST['zipcode'])){
									if(isset($_POST['phonenumber'])&&!empty($_POST['phonenumber'])){
										try
										{
											if(!isset($_POST['stripeToken']))
											{
												throw new Exception("The Stripe Token was not generated correctly");
											}
											Stripe_Charge::create(array("amount"=>$results['siteprice'],"currency"=>"usd","card" =>$_POST['stripeToken'],'description'=>'Charge for build #'.$results['id'].' Cost : '.$results['siteprice'].' USD'));
											buildQueryBindNoFetch('ramity_collection','INSERT INTO `orders` (id,firstname,lastname,addressone,addresstwo,city,state,zipcode,phone,email,buildnumber,price,date,status) VALUES (:id,:firstname,:lastname,:addressone,:addresstwo,:city,:state,:zipcode,:phone,:email,:buildnumber,:price,:date,:status)',array('id'=>'','firstname'=>$_POST['fname'],'lastname'=>$_POST['lname'],'addressone'=>$_POST['addressone'],'addresstwo'=>$_POST['addresstwo'],'city'=>$_POST['city'],'state'=>$_POST['state'],'zipcode'=>$_POST['zipcode'],'phone'=>$_POST['phonenumber'],'email'=>$_POST['email'],'buildnumber'=>$results['id'],'price'=>$results['siteprice'],'date'=>microtime(true),'status'=>'0'));
											$message='Your payment was successful. Please wait one moment... <meta http-equiv="refresh" content="5;URL=https://ramity.com/thanks">';
											$success=true;
										}
										catch (Exception $e)
										{
											$message=$e->getMessage();
										}
									}else{$message='Phone number looks empty';}
								}else{$message='Zipcode is required';}
							}else{$message='What state do you want your item shipped to?';}
						}else{$message='What city do you want your item shipped to?';}
					}else{$message='Address looks empty.';}
				}else{$message='Last name looks empty';}
			}else{$message='First name looks empty';}
		}
		?>
		<div id="payment">
			<div id="paymentinr">
				<form method="post" id="payment-form" action="https://ramity.com/search?<?php echo 'id='.$_GET['id'].'&type='.$_GET['type'];?>#checkout">
					<div class="payment-status" style="<?php if(isset($message)&&!empty($message)){echo 'display:block;';}if(isset($success)&&$success==true){echo 'background-color:#00FF00;color:#fff;';}?>">
						<?php if(isset($message)&&!empty($message)){echo $message;}?>
						<noscript>Javascript must be enabled to process payments</noscript>
					</div>
					<div class="paymentrow">
						<div class="paymentfakeinput"><?php echo number_format($results['siteprice']/100,2,'.',',').' (USD)';?></div>
						<div class="paymentfakeinputnm">Ramity.com can only ship to states in US</div>
					</div>
					<div class="paymentrow">
						<input type="text" class="paymentinput" name="fname" placeholder="First Name" value="<?php if(!empty($_POST['fname'])){echo $_POST['fname'];}?>">
						<input type="text" class="paymentinputnm" name="lname" placeholder="Last Name" value="<?php if(!empty($_POST['lname'])){echo $_POST['lname'];}?>">
					</div>
					<div class="paymentrow">
						<input type="text" class="paymentinput" name="addressone" placeholder="Address 1" value="<?php if(!empty($_POST['addressone'])){echo $_POST['addressone'];}?>">
						<input type="text" class="paymentinputnm" name="addresstwo" placeholder="Address 2 (optional)" value="<?php if(!empty($_POST['addresstwo'])){echo $_POST['addresstwo'];}?>">
					</div>
					<div class="paymentrow">
						<input type="text" class="paymentinput" name="city" placeholder="City" value="<?php if(!empty($_POST['city'])){echo $_POST['city'];}?>">
						<input type="text" class="paymentinputnm" name="state" placeholder="State" value="<?php if(!empty($_POST['state'])){echo $_POST['state'];}?>">
					</div>
					<div class="paymentrow">
						<input type="text" class="paymentinput" name="zipcode" placeholder="Zip/Postal Code" value="<?php if(!empty($_POST['zipcode'])){echo $_POST['zipcode'];}?>">
						<input type="text" class="paymentinputnm" name="phonenumber" placeholder="Phone Number" value="<?php if(!empty($_POST['phonenumber'])){echo $_POST['phonenumber'];}?>">
					</div>
					<div class="paymentrow">
						<input type="text" class="paymentinput" name="email" placeholder="Email" value="<?php if(isset($inf['email'])&&!empty($inf['email'])){echo $inf['email'];}else if(!empty($_POST['email'])){echo $_POST['email'];}?>">
						<input type="text" size="20" autocomplete="off" class="card-number paymentinputnm" placeholder="Credit card number">
					</div>
					<div class="paymentrow">
						<input type="text" size="4" autocomplete="off" class="card-cvc paymentinput" placeholder ="CVC">
						<input type="text" size="2" class="card-expiry-month" placeholder="MM">
						<span>/</span>
						<input type="text" size="4" class="card-expiry-year" placeholder="YYYY">
						<input type="text" id="sitepromocode" name="promocode" placeholder="Promocode" value="<?php if(!empty($_POST['promocode'])){echo $_POST['promocode'];}?>">
					</div>
					<div class="paymentrow">
						<button type="submit" class="submit-button">Submit Payment</button>
					</div>
					<a href="https://ramity.com/legal/privacyPolicy.txt" style="color:#000fff;">
						<div id="paymentnotice">By submiting, you accept our privacy policy</div>
					</a>
				</form>
				<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
				<script type="text/javascript">
				Stripe.setPublishableKey('pk_live_OmlrL353nSWTXmrtUy40g0hY');
				function stripeResponseHandler(status,response)
				{
					if(response.error)
					{
						$('.submit-button').removeAttr('disabled');
						$('.payment-status').css('display','block');
						$('.payment-status').html(response.error.message);
					}
					else
					{
						$('.payment-status').css('display','none');
						var form$=$("#payment-form");
						var token=response['id'];
						form$.append("<input type='hidden' name='stripeToken' value='"+token+"'>");
						form$.get(0).submit();
					}
				}
				$(document).ready(function()
				{
					$("#payment-form").submit(function(event)
					{
						$('.submit-button').attr("disabled","disabled");
						Stripe.createToken(
						{
							number:$('.card-number').val(),
							cvc:$('.card-cvc').val(),
							exp_month:$('.card-expiry-month').val(),
							exp_year:$('.card-expiry-year').val()
						}, stripeResponseHandler);
						return false;
					});
				});
				</script>
			</div>
		</div>
		<div id="sub" style="width:100%;height:50px;float:left;background-color:#000;margin-top:500px;"></div>
		<?php
		}
		?>
		<?php require_once('/home/ramity/modules/block/footer.php');?>
	</body>
</html>