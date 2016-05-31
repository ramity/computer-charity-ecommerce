<div id="counter">
	<div id="counterpos">
		<a target="_blank" href="https://www.amazon.com/gp/search/ref=as_li_qf_sp_sr_tl?ie=UTF8&camp=1789&creative=9325&index=aps&keywords=Destiny&linkCode=ur2&tag=ramity06-20&linkId=HPG65CHETVU26O5R">
			<img src="https://ir-na.amazon-adsystem.com/e/ir?t=ramity06-20&l=ur2&o=1" width="0" height="0" border="0" alt="" style="border:none !important; margin:0px !important;" />
			<div id="counterinr"></div>
		</a>
	</div>
	<img id="counterbackground" src="https://ramity.com/img/destiny.jpg">
	<script>
	$("#counter").bind("load",function(){$(this).fadeIn();});
	var end = new Date('9 Sep 2014');
	var _second = 1000;
	var _minute = _second * 60;
	var _hour = _minute * 60;
	var _day = _hour *24;
	var timer;
	function showRemaining()
	{
		var now = new Date();
		var distance = end - now;
		//var days = Math.floor(distance / _day);
		var hours = Math.floor( (distance % _day ) / _hour );
		var minutes = Math.floor( (distance % _hour) / _minute );
		var seconds = Math.floor( (distance % _minute) / _second );
		var milliseconds = Math.round(distance % _second/10);
		var countdownElement = document.getElementById('counterinr');
		countdownElement.innerHTML = hours + 'h ' + minutes + 'm ' + seconds + 's till release';
		if(distance<0)
		{
			document.getElementById('counterinr').innerHTML="Destiny is offically out!";
			clearInterval(timer); // stop the timer from continuing ..
		}
	}
	timer = setInterval(showRemaining, 10);
	</script>
</div>