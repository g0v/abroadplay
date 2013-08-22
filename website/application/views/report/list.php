<link rel="stylesheet" type="text/css" href="/abroadplay/includes/templtes/01/images/css/table.css" />
<table cellspacing='0' width="100%"> <!-- cellspacing='0' is important, must stay -->
    <tr><th>系統識別號</th><th>計畫名稱</th><th>出國開始</th><th>出國結束</th><th>出國地區</th><th>出國人數</th></tr>
<?php foreach ($list as $item): ?>
    <tr class='even'><td><?=$item->sysid ?></td><td><a href="report/<?=$item->id ?>"><?=$item->name ?></a></td><td><?=$item->periodStart ?></td><td><?=$item->periodEnd ?></td><td><?=$item->countries ?></td><td><?=$item->people ?></td></tr>
<?php endforeach ?>   
</table>