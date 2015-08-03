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



<div class="container-fluid">
<div class="">	
	<?php if($config_info->adsense) { ?> <div class="adsense text-center"><?php echo htmlspecialchars_decode($config_info->adsense);?></div> <?php } ?>
	<div class="home_inner">
		<div class="sky_ad_left_home"><?php if($config_info->adsense_sky_left) echo htmlspecialchars_decode($config_info->adsense_sky_left);?></div>
		
		<div id="main_container_home" class="col-xs-12 col-sm-12 col-md-12 text-center">
		
			<?php
				//echo site_url();
				/*echo "<pre>";
				print_r($game_list);*/
				if($game_list)
				{
					$i=0;
					foreach($game_list as $game)
					{
						$i++;
						?>
							<?php
								if($i == 7)
								{
									if($config_info->adsense_middle) 
									{ 
									?> 
									<div style="clear:both;"></div>
									<div class="adsense text-center" style="margin-top:15px; margin-bottom:15px;"><?php echo htmlspecialchars_decode($config_info->adsense_middle); ?></div>
									<div style="clear:both;"></div>
									<?php
									}
	
								}
	
							?>
							
							<div class="col-xs-12 col-sm-6 col-md-4">
								<div class="well">
									<div class="test_img">
										<a href="<?php echo site_url();?><?php echo $game->alias.".html"; if(isset($ref_page) && $ref_page=='top') echo"?ref_page=top";?>">
											<img  class="img-rounded img-responsive" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $game->image_thumb; ?>" alt="<?php echo $game->image_thumb; ?>" />	
										</a>
									</div>			
									<div id="test_title" class="text-center"><a href="<?php echo site_url();?><?php echo $game->alias.".html"; if(isset($ref_page) && $ref_page=='top') echo"?ref_page=top";?>"><?php echo $game->title; ?> </a></div>
									
								</div>
							</div>
							
						<?php
	
					}
	
					
	
					?>
						<div style="clear:both;"></div>
						<?php if($config_info->adsense_bottom) { ?> <div class="adsense adsense_bottom_home text-center" style="margin-top:15px;"><?php echo htmlspecialchars_decode($config_info->adsense_bottom);?></div> <?php } ?>
	
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
									<a href="<?php echo site_url();?><?php if(isset($ref_page) && $ref_page=='top') echo "top/";?>page/<?php echo $page+1;?>"><button type="button" class="btn btn-primary col-xs-12 col-sm-12 col-md-12"><?php echo $this->lang->line('next_page');?></button></a>
								<?php
									}
									else
									{
										?>
											<a href="<?php echo site_url();?><?php if(isset($ref_page) && $ref_page=='top') echo "top/";?>page/<?php echo $page - 1;?>"><button type="button" class="btn btn-primary col-xs-12 col-sm-12 col-md-12"><?php echo $this->lang->line('pre_page');?></button></a>
	
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
			<div class="col-sm-12 text-center">
				<div class="fb-like-box visible-lg visible-md"  data-width="728" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
		
				<div class="fb-like-box visible-sm"  data-width="420" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
		
				<div class="fb-like-box visible-xs"  data-width="270" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
			</div>
	
			<div style="clear:both;"></div>
	
		</div>
		
		<div class="sky_ad_right_home" ><?php if($config_info->adsense_sky_right) echo htmlspecialchars_decode($config_info->adsense_sky_right);?></div>
		
	</div>
	<div style="clear:both;"></div>

</div>

</div>


<style type="text/css">
	@media only screen and (max-width: 459px) { 
		.adsense_bottom_home
		{
			margin-left:-15px;
		}
	}
</style>




							