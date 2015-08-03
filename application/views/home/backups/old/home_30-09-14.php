<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo trim($config_info->facebook_appid);?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


</script>

</div>

<div class="container">

<div class="row">
	<?php if($config_info->adsense) { ?> <div class="adsense text-center"><?php echo htmlspecialchars_decode($config_info->adsense);?></div> <?php } ?>
	<div class="sky_ad_left"><?php if($config_info->adsense_sky_left) echo htmlspecialchars_decode($config_info->adsense_sky_left);?></div>
	<div id="main_container" class="col-xs-12 col-sm-10 col-md-8">
		
		<?php
			if($game_list)
			{
				$i=0;
				foreach($game_list as $game)
				{
					$i++;
					?>
						<?php
							if($i == 4)
							{
								if($config_info->adsense_middle) 
								{ 
								?> 
								<div class="adsense text-center" style="margin-top:15px; margin-bottom:15px;"><?php echo htmlspecialchars_decode($config_info->adsense_middle); ?></div>
								<?php
								}
								 
							}
						?>
						<div class="well">
							<h2 class="tests_title"><a href="<?php echo site_url();?><?php echo $game->alias.".html"; if(isset($ref_page) && $ref_page=='top') echo"?ref_page=top";?>"><?php echo $game->title;?></a></h2>
							
							<p class="tests_des"><?php echo $game->description;?></p>					
							<div class="row text-center"><a  href="<?php echo site_url();?>start/<?php echo $game->alias.".html"; if(isset($ref_page) && $ref_page=='top') echo"?ref_page=top";?>" class="btn btn-lg btn-success col-xs-8 col-md-4 col-sm-4 start_btn" style="font-size:30px; float:none;">START</a></div>
							
							
							<div style="clear:both;"></div>
							<div class="row  col-xs-12 col-md-7 col-sm-5 fb_like_share" style="min-height:42px;">
								<div class="fb-like hidden-xs hidden-sm" data-href="<?php echo site_url();?><?php echo $game->alias.".html";?>" data-width="420" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
								<div class="fb-like visible-xs visible-sm" data-href="<?php echo site_url();?><?php echo $game->alias.".html";?>" data-width="220" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
							</div>
							<div style="clear:both;"></div>
						</div>
					<?php
				}
				
				?>
					<?php if($config_info->adsense_bottom) { ?> <div class="adsense text-center" style="margin-top:15px;"><?php echo htmlspecialchars_decode($config_info->adsense_bottom);?></div> <?php } ?>
					<div style="clear:both; height:35px;"></div>
					<div class="row22">
						<?php
							 if($page == 0) $page=1;
							 $pagination_record=$limit + $page;
							 if(($pagination)) 
							 { 
								if($pagination_record <  $total_record)
								{
							 ?>
								<a href="<?php echo site_url();?><?php if(isset($ref_page) && $ref_page=='top') echo "top/";?>page/<?php echo $page+1;?>"><button type="button" class="btn btn-primary col-xs-12 col-sm-12 col-md-12">Next Page</button></a>
							<?php
								}
								else
								{
									?>
										<a href="<?php echo site_url();?><?php if(isset($ref_page) && $ref_page=='top') echo "top/";?>page/<?php echo $page - 1;?>"><button type="button" class="btn btn-primary col-xs-12 col-sm-12 col-md-12">Pre Page</button></a>
									<?php
								} 
							} 
							?>
						<div class="pagination text-center col-xs-12 col-sm-12 col-md-12 visible-lg visible-md visible-sm"><?php echo $pagination; ?></div>
						<div class="pagination text-center col-xs-12 col-sm-12 col-md-12 visible-xs"><?php echo $pagination2; ?></div>
					</div>
					<div style="clear:both; height:35px;"></div>
				<?php 
			}
			
		?>
		<div style="clear:both;"></div>
		<div class="fb-like-box visible-lg visible-md"  data-width="728" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
		<div class="fb-like-box visible-sm"  data-width="420" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
		<div class="fb-like-box visible-xs"  data-width="270" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
		<div style="clear:both;"></div>
	</div>
	<div class="sky_ad_right" ><?php if($config_info->adsense_sky_right) echo htmlspecialchars_decode($config_info->adsense_sky_right);?></div>
</div>
</div>



							