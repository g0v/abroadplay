<link rel="stylesheet" type="text/css" href="<?=base_url()?>includes/templtes/01/images/css/table.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>includes/pagination/pagination.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>includes/templtes/01/images/css/search.css" />
<header class="codrops-header">
    <a href="<?=base_url()?>" title="公務員出國考察追蹤網-Home">
        <h1>公務員出國考察追蹤網<span>追蹤公務員出國考察的、行程、人數</span></h1>
    </a>
</header>
<form class="form-wrapper cf" action="<?=base_url()?>report/search/" method="post">
    <input type="text" placeholder="輸入查詢關鍵字..." name="key" value="<?=$key?>" required>
    <button type="submit">Search</button>
</form>  
<?=$pageList?>
<table cellspacing='0'> <!-- cellspacing='0' is important, must stay -->
    <tr><th width="120">系統識別號</th><th width="30%">計畫名稱</th><th>主辦機關</th><th width="120">出國開始</th><th width="120">出國結束</th><th width="80">地區</th><th width="80">人數</th></tr>
<?php foreach ($list as $k=>$item): ?>
    <tr <?=($k%2==0)?"class='even'":"";?>><td><?=$item->sysid ?></td><td><a href="<?=base_url()?>report/view/<?=$item->id ?>"><?=$item->reportName ?></a></td><td><?=$item->authority ?></td><td><?=$item->periodStart ?></td><td><?=$item->periodEnd ?></td><td><?=$item->countries ?></td><td><?=$item->people ?></td></tr>
<?php endforeach ?>   
</table>
<?=$pageList?>