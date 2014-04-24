<link rel="stylesheet" type="text/css" href="<?=base_url()?>includes/templtes/01/images/css/table.css" />
<header class="codrops-header">
    <a href="<?=base_url()?>" title="公務員出國考察追蹤網-Home">
        <h1>公務員出國考察追蹤網<span>追蹤公務員出國考察的、行程、人數</span></h1>
    </a>
</header>
<table cellspacing='0' class="catetype"> <!-- cellspacing='0' is important, must stay -->
    <tr><td>
	<?php foreach ($list as $k=>$item): ?>
		
		<h3><?=$item['name']?></h3>
		<?php if(count($item['list'])>1): ?>
		<ul>
			<?php foreach ($item['list'] as $v): ?>
				<li><a href="<?=$v['url']?>"><?=$v['name']?></a>
					<?php if(count($v['list'])>1): ?>
					<ul>
						<?php foreach ($v['list'] as $v1): ?>
							<li><a href="<?=$v1['url']?>"><?=$v1['name']?></a></li>
						<?php endforeach ?>
					</ul>
					<?php endif; ?>
				</li>
			<?php endforeach ?>
		</ul>
		<?php endif; ?>
		<div style="clear:both"></div>
	<?php endforeach ?>
	</td></tr>
</table>

<style>
	.catetype h3{font-size: 20px;}
	.catetype li{float: left;width: 25%;line-height: 30px;font-size: 15px;}
</style>