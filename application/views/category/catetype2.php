<link rel="stylesheet" type="text/css" href="<?=base_url()?>includes/templtes/01/images/css/table.css" />
<header class="codrops-header">
    <a href="<?=base_url()?>" title="公務員出國考察追蹤網-Home">
        <h1>公務員出國考察追蹤網<span>追蹤公務員出國考察的、行程、人數</span></h1>
    </a>
</header>
<table cellspacing='0' class="catetype"> <!-- cellspacing='0' is important, must stay -->
    <tr>	
	    <td>
	    	<ul>
			<?php foreach ($cateList as $k=>$item): ?>
				<li><a href="/category/catetype/<?=$item->id?>"><?=$item->cateName?></a></li>				
			<?php endforeach ?>
			</ul>
	    </td>
    </tr>
    <tr>
    	<td>
			<?php foreach ($list as $k=>$item): ?>
				<a href="<?=$item['url']?>"><h3 id="<?=$item['id']?>"><?=$item['name']?>(<?=$item['count']?>)</h3></a>
				<ul>
				<?php foreach ($item['list'] as $list1): ?>
					<li><a href="<?=$list1['url']?>"><?=$list1['name']?>(<?=$list1['count']?>)</a></li>
				<?php endforeach ?>
				</ul>
				<div style="clear:both"></div>
			<?php endforeach ?>
		</td>
	</tr>

</table>

<style>
	.catetype h3{font-size: 20px;}
	.catetype h4{font-size: 16px;}
	.catetype li{float: left;width: 20%;line-height: 30px;font-size: 13px;}
</style>