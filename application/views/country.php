<style>
    #main
    {
		width:100%;
		magin: 0 auto;
		background-color: #fff;
		color: #888;
		font-size:12px;
    }
	#visualization
    {
		width:800px;
		magin: 0 auto;
    }
	#countryList
    {
		font-size:14px;
		padding:20px;
		width:340px;
		height:580px;
		float:right;
		margin-top:10px;
		overflow:auto;
    }
	#countryList li
    {
		float:left;
		width:130px;
		line-height:30px;
    }
	
</style>

<script type="text/javascript">
    google.load('visualization', '1', {packages: ['geochart']});
	function drawVisualization() {
		var data = google.visualization.arrayToDataTable([
			['國家', '次數'],
			<?php foreach ($list as $k=>$item): ?>
			['<?=(($item->cName=='中國大陸')?"中國":$item->cName)?>', <?=$item->cnt ?>],
			<?php endforeach ?>
		]);
		var geochart = new google.visualization.GeoChart(document.getElementById('visualization'));
		geochart.draw(data, {width: 800, height: 600});
    }
    google.setOnLoadCallback(drawVisualization);
</script>

<header class="codrops-header">
<a href="<?=base_url()?>" title="公務員出國考察追蹤網-Home">
	<h1>公務員出國考察追蹤網<span>追蹤公務員出國考察的、行程、人數</span></h1>
</a>
</header>
<div id="main">
	<div class="content">
		<b>國家統計</b>
		<div style="float:right">
		<form class="form-wrapper cf" action="<?=base_url()?>country/datelist/" method="post">
		<input type="text" id="from" name="Dfrom" value="<?=$Dfrom?>" placeholder="開始日" />~<input type="text" id="to" name="Dto" value="<?=$Dto?>" placeholder="結束日"/>
		<input type="submit" value="送出" />
		</form>
		</div>
		<div style="clear:both"></div>
		<div id="countryList">
		<ol type="circle"> 
		<?php foreach ($list as $k=>$item): ?>
			<li><?=$item->cName ?> / <?=$item->cnt ?></li>
		<?php endforeach ?>		
		</ol>
		</div>
		<div id="visualization"></div>
	</div>	
	<div style="clear:both"></div>
</div>

<script>
  $(function() {
    $( "#from" ).datepicker({
	defaultDate : (new Date(new Date().getFullYear() - 10
                                + "/01/01") - new Date())
                                / (1000 * 60 * 60 * 24),
	dateFormat: "yy-mm-dd",
	changeMonth: true,
	changeYear: true,
	showAnim: "fadeIn",
	yearRange: '1999:' + new Date().getFullYear(),
	onClose: function( selectedDate ) {
		$( "#to" ).datepicker( "option", "minDate", selectedDate );
	}
    });
    $( "#to" ).datepicker({
	defaultDate: "+1w",
	dateFormat: "yy-mm-dd",
	changeMonth: true,
	changeYear: true,
	showAnim: "fadeIn",
	yearRange: '1999:' + new Date().getFullYear(),
	onClose: function( selectedDate ) {
		$( "#from" ).datepicker( "option", "maxDate", selectedDate );
	}
    });
  });
</script>