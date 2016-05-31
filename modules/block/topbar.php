<div id="topbar">
	<div id="topbarinr">
		<a href="https://ramity.com/">
			<span class="topbarnavitembutton" style="margin-left:0px;">RAMITY</span>
		</a>
		<div id="topbarnav">
			<a class="topbarnavitem" href="https://ramity.com/us">
				<span class="topbarnavitembutton">THE TEAM</span>
			</a>
			<div class="topbarnavdd">
				<a class="topbarnavitem" href="https://ramity.com/products">
					<span class="topbarnavitembutton">PRODUCTS</span>
				</a>
				<div class="topbarnavddholder">
					<?php
					$builds=buildQueryFetchAll('ramity_collection','SELECT id,title,siteprice FROM `builds` ORDER BY siteprice ASC');
					for($q=0;$q<count($builds);$q++)
					{
						echo '<a class="topbarnavitemdd" href="https://ramity.com/search?id='.$builds[$q]['id'].'&type=build" title="$'.number_format($builds[$q]['siteprice']/100,2,'.',',').'">'.$builds[$q]['title'].'</a>';
					}
					?>
				</div>
			</div>
			<!--
			<a class="topbarnavitem" href="https://ramity.com/reviews">
				<span class="topbarnavitembutton">REVIEWS</span>
			</a>
			<a class="topbarnavitem" href="https://ramity.com/news">
				<span class="topbarnavitembutton">NEWS</span>
			</a>
			-->
			<?php
			if($GLOBALS['secureLogin'])
			{
				echo'
				<a class="topbarnavitem" href="https://ramity.com/signin">
					<span class="topbarnavitembutton">YOU</span>
				</a>';
			}
			else
			{
				echo'
				<a class="topbarnavitem" href="https://ramity.com/signin">
					<span class="topbarnavitembutton">SIGN IN</span>
				</a>';
			}
			?>
		</div>
	</div>
</div>