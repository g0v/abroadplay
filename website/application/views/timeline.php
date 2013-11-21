<link rel="stylesheet" type="text/css" href="<?=base_url()?>includes/templtes/01/images/css/table.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>includes/pagination/pagination.css" />

<style>
    #main
    {
	width:100%;
	magin: 0 auto;
	background-color: #fff;
	color: #888;
	font-size:12px;
	height:300px;
    }
</style>

<header class="codrops-header">
<a href="<?=base_url()?>" title="公務員出國考察追蹤網-Home">
	<h1>公務員出國考察追蹤網<span>追蹤公務員出國考察的、行程、人數</span></h1>
</a>
</header>
<div id="main">
	<div class="content">
	<b>搜尋查詢</b>
	<div style="float:right">
	<form class="form-wrapper cf" action="<?=base_url()?>timeline/datelimit/" method="post">
	<input type="text" id="from" name="Dfrom" value="<?=$Dfrom?>" placeholder="開始日"/>
	至
	<input type="text" id="to" name="Dto" value="<?=$Dto?>" placeholder="結束日"/>
	<input type="submit" value="送出" />
	</form>
	</div>
	</div>
	<div style="clear:both"></div>
	<table cellspacing='0'>
		<tr>
		<th width="120">系統識別號</th>
		<th width="120">計畫名稱</th>
		<th width="120">主辦機關</th>
		<th width="120">出國開始</th>
		<th width="120">出國結束</th>
		<th width="80">地區</th>
		<th width="80">人數</th>
		</tr>
<?php foreach ($list as $k=>$item): ?>
    <tr <?=($k%2==0)?"class='even'":"";?>><td><?=$item->sysid ?></td><td><a href="<?=base_url()?>report/view/<?=$item->id ?>"><?=$item->reportName ?></a></td><td><?=$item->authority ?></td><td><?=$item->periodStart ?></td><td><?=$item->periodEnd ?></td><td><?=$item->countries ?></td><td><?=$item->people ?></td></tr>
<?php endforeach ?>
<?php if(count($list)==0):?>
	<tr><td colspan="7"><div style="padding-top:50px;height:200px;text-align:center">目前尚無任何資料</div></td></tr>
<?php endif;?>		
 	</table>
	<?=$pageList?>
	
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