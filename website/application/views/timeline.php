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
	<input type="text" id="from" name="from" />
	至
	<input type="text" id="to" name="to" />
	</div>
	<div style="clear:both"></div>
	<table cellspacing='0'>
		<tr><th width="120">系統識別號</th><th width="30%">計畫名稱</th><th>主辦機關</th><th width="120">出國開始</th><th width="120">出國結束</th><th width="80">地區</th><th width="80">人數</th></tr>
 	</table>
	</div>
</div>

<script>
  $(function() {
    $( "#from" ).datepicker({
	defaultDate: "+1w",
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