<link rel="stylesheet" type="text/css" href="/abroadplay/includes/templtes/01/images/css/table.css" />
<table cellspacing='0' width="100%">
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
    <tr>
        <th >電子全文檔</th>
        <td>
                        
        
                        	                        
        </td>
    </tr>                      
    <tr>
        <th >報告日期</th>
        <td><?=$item['reportDate']?></td>
    </tr>
    <tr>
        <th >報告書頁數</th>
        <td><?=$item['reportPages']?></td>
    </tr>
</table>

<table cellspacing='0' width="100%">
    <tr><th colspan="2"><center>其他資料</center></th></tr>
    <tr>
        <th >出國期間</th>
        <td><?=$item['periodStart']?> 至 <?=$item['periodEnd']?></td>
    </tr>
    <tr>
        <th width="15%">前往地區</th>
        <td><?=$item['reportDate']?></td>
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
    <? if($item['remark']){?>
    <tr>
        <th >備註</th>
        <td><?=$item['remark']?></td>
    </tr>
    <? } ?>
</table>

<table cellspacing='0' width="100%">
    <tr><th colspan="2"><center>計畫主辦機關資訊</center></th></tr>
    <tr>
        <th width="15%">計畫主辦機關</th>
        <td><?=$item['authority']?></td>
    </tr>
    <tr>
        <th >出國人員</th>
        <td><table cellspacing='0' width="90%" align="center">
            <tr>
              <th scope="col" class="aLeft">姓名</th>
              <th scope="col" class="aLeft">服務機關</th>
              <th scope="col" class="aLeft">服務單位</th>
              <th scope="col" class="aLeft">職稱</th>
              <th scope="col" class="aLeft">官職等 </th>
            </tr>
            
            <tr>
              <td>王兆儀</td>
              <td>行政院衛生署食品藥物管理局</td>
              <td> </td>
              <td>副組長</td>
              <td>簡任</td>
            </tr>
            
        </table>                        
        </td>
    </tr>
</table>

<table cellspacing='0' width="100%">
    <? if($item['report']) {?>
    <tr><th ><center>報告內容摘要</center></th></tr>
    <tr>
        <td><?=$item['report']?></td>
    </tr>
    <? } ?>
    <tr>
        <td>前往原始法條頁面：<a href="<?=$item['source']?>" target="_blank"><?=$item['source']?></a></td>
    </tr>    
</table>
