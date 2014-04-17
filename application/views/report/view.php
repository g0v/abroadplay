<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
<script type="text/javascript" src="<?=base_url()?>includes/mapper.js"></script>
<script type="text/javascript">
<!--
$(function(){
    try{
	COUNTRYMapper.initializeMap("map-canvas",2);
	var countryArray = [<?php foreach ($item['country'] as $v): ?>"<?=($v->name=='中國大陸')?'中國':$v->name?>",<?php endforeach ?>];
        COUNTRYMapper.addCOUNTRYArray(countryArray);
    } catch(e){
	//handle error
    }
});
//-->
</script>

<style>
  #map-canvas {
    float: left;
    padding: 0;
    width: 70%;
    height: 500px;
  }
</style>
<div>
    <div id="map-canvas"></div>
    <div style="float: right;text-align: center;width: 28%">
        <h2>出國期間</h2><p><?=$item['periodStart']?> 至 <?=$item['periodEnd']?></p>
        <h2>前往地區</h2><p><ul><?php foreach ($item['country'] as $v): ?>
                <li><?=$v->name?></li>
                <?php endforeach ?></ul></p>
        <h2>出國人數</h2><p>共 <?=$item['people']?> 位</p></div>
    <div style="clear: both;"></div>
</div>


<link rel="stylesheet" type="text/css" href="<?=base_url()?>includes/templtes/01/images/css/table.css" />
<table cellspacing='0'>
    <tr><th colspan="2"><center>基本資料</center></th></tr>
    <tr>
        <th width="15%">系統識別號</th>
        <td><?=$item['sysid']?></td>
    </tr>
    <tr>
        <th width="15%">主題分類</th>
        <td><?=$item['scId']?></td>
    </tr>
    <tr>
        <th width="15%">施政分類</th>
        <td><?=$item['pcId']?></td>
    </tr>    
    <tr>
        <th >計畫名稱</th>
        <td><?=$item['name']?></td>
    </tr>
    <tr>
        <th >報告名稱</th>
        <td><?=$item['reportName']?></td>
    </tr>
    <?php if(count($item['file'])>0):?>
    <tr>
        <th >電子全文檔</th>
        <td>
            <ul>
            <?php foreach ($item['file'] as $v): ?>
            <li><a href="<?=$v->fileUrl?>" target="_blank" title="<?=$v->fileName?>"><?=$v->fileName?></a></li>
            <?php endforeach ?>                     
            </ul>
        </td>
    </tr>
    <?php endif; ?>
    <tr>
        <th >報告日期</th>
        <td><?=$item['reportDate']?></td>
    </tr>
    <tr>
        <th >報告書頁數</th>
        <td><?=$item['reportPages']?></td>
    </tr>
</table>

<table cellspacing='0' >
    <tr><th colspan="2"><center>其他資料</center></th></tr>
    <tr>
        <th >出國期間</th>
        <td><?=$item['periodStart']?> 至 <?=$item['periodEnd']?></td>
    </tr>
    <tr>
        <th width="15%">前往地區</th>
        <td>
           <ol>
                <?php foreach ($item['country'] as $v): ?>
                <li><?=$v->name?></li>
                <?php endforeach ?>            
           </ol> 

        </td>
    <tr>
        <th >參訪機關</th>
        <td><?=$item['authorities']?></td>
    </tr>
    <tr>
        <th >出國類別</th>
        <td><?=$item['aCategory']?></td>
    </tr>
    <tr>
        <th >關鍵詞</th>
        <td><?=$item['keyword']?></td>
    </tr>
    <? if($item['remark']):?>
    <tr>
        <th >備註</th>
        <td><?=$item['remark']?></td>
    </tr>
    <?php endif; ?>
</table>

<table cellspacing='0' >
    <tr><th colspan="2"><center>計畫主辦機關資訊</center></th></tr>
    <tr>
        <th width="15%">計畫主辦機關</th>
        <td><?=$item['authority']?></td>
    </tr>
    <?if(count($item['abroad'])>0):?>
    <tr>
        <th >出國人員</th>
        <td>
        <table cellspacing='0' width="90%">
            <tr>
              <th scope="col" class="aLeft">姓名</th>
              <th scope="col" class="aLeft">服務機關</th>
              <th scope="col" class="aLeft">服務單位</th>
              <th scope="col" class="aLeft">職稱</th>
              <th scope="col" class="aLeft">官職等 </th>
            </tr>
            <?php foreach ($item['abroad'] as $v): ?>
            <tr>
              <td><?=$v->name?></td>
              <td><?=$v->agencies?></td>
              <td><?=$v->units?></td>
              <td><?=$v->title?></td>
              <td><?=$v->official?></td>
            </tr>
            <?php endforeach ?>       
        </table>                        
        </td>
    </tr>
    <?php endif ?>  
</table>

<table cellspacing='0' >
    <? if($item['report']):?>
    <tr><th ><center>報告內容摘要</center></th></tr>
    <tr>
        <td><?=$item['report']?></td>
    </tr>
    <?php endif; ?>
    <tr>
        <td>前往原始報告頁面：<a href="<?=$item['source']?>" target="_blank"><?=$item['source']?></a></td>
    </tr>    
</table>
