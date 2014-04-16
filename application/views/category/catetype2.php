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
			<?php foreach ($list as $k=>$item): ?>
				<li><a href="#<?=$item['id']?>"><?=$item['name']?></a></li>				
			<?php endforeach ?>
			</ul>
	    </td>
    </tr>
    <tr>
    	<td>
			<?php foreach ($list as $k=>$item): ?>
				<h3 id="<?=$item['id']?>"><?=$item['name']?></h3>
				<?php foreach ($item['list'] as $list1): ?>
					<h4><?=$list1['name']?></h4>
					<? if(count($list1['list'])>0):?>
					<ul>
						<?php foreach ($list1['list'] as $v): ?>
							<li><?=$v?></li>
						<?php endforeach ?>
					</ul>
					<div style="clear:both"></div>
					<?php endif ?>
				<?php endforeach ?>
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