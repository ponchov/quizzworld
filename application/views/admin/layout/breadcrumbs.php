<div class="breadcrumbs" id="breadcrumbs">
<ul class="breadcrumb">
	<?php
		$i=0;
		
		foreach($breadcrumbs as $breadcrumb)
		{
			$i++;
			if($breadcrumb['href'] != '')
			{
			?>
				<li>
					<?php if($i == 1) { ?><i class="icon-home home-icon"></i> <?php } ?>
					<a href="<?php echo $breadcrumb['href'];?>"><?php echo $breadcrumb['text'];?></a>
					<?php /*?><span class="divider"><i class="icon-angle-right arrow-icon"></i></span><?php */?>						
				</li>
			<?php
			}
			else
			{
			?>
				<li class="active"><?php echo $breadcrumb['text'];?></li>
			<?php
			}
		}
	?>
	
</ul>
</div><!-- .breadcrumb -->

