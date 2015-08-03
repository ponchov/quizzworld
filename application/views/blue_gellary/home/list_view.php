<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo trim($config_info->facebook_appid);?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> 



<div class="col-xs-12 col-sm-12 col-md-12" style="padding:0;">
	<div class="col-xs-12 col-sm-8 col-md-8" id="list_left_panel">
		<div class="list_title"><?php echo $tests_info->title; ?></div>	
		

		<div class="social_link">
			<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
			<?php
			$share_url =site_url()."lists/".$tests_info->alias.".html";
			$shareAttributes = "addthis:url='$share_url' addthis:title='Test' addthis:description='' ";
			?>
			<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_32x32_style" data-url="<?php $share_url; ?>" data-title="" style="width:100%;" >
				<a class="socila_button addthis_button_facebook" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/facebook.png" alt="Facebook" /></a>
				<a class="socila_button addthis_button_twitter" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/twitter.png" alt="Twitter" /></a>
				<a class="socila_button addthis_button_stumbleupon" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/pinterest.png" alt="Pinterest" /></a>
			</div>

		</div>

		<div class="">
			<?php
				$lists=$this->home_model->get_lists($tests_info->testid);
				/*echo "<pre>";
				print_r($lists);*/
			
				
				foreach($lists as $list)
				{
					?>
					<div class="list_details ">
						
						<div class="item_title border_top"><?php echo $list->item_title;?></div>
						<div class="item_image "><img class="img-responsive"src="<?php echo base_url();?>assets/img/image/<?php echo $list->image;?>" /></div>
						<div class="item_description "><?php echo $list->description;?></div>
					</div>
					<?php
				}
			?>
		
		</div>	
		

		<div class="social_link">
			<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_32x32_style" data-url="<?php $share_url; ?>" data-title="" style="width:100%;" >
				<a class="socila_button addthis_button_facebook" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/facebook.png" alt="Facebook" /></a>
				<a class="socila_button addthis_button_twitter" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/twitter.png" alt="Twitter" /></a>
				<a class="socila_button addthis_button_stumbleupon" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/pinterest.png" alt="Pinterest" /></a>
			</div>

		</div>
		
		<div id="fb_comments" class="text-center">
			<div class="fb-comments"  data-width="620" data-href="<?php echo site_url();?>/lists<?php echo $tests_info->alias.".html";?>" data-numposts="5" data-colorscheme="light"></div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-3 col-md-3 pull-right" id="list_right_panel" style="min-height:800px;">
		<div class="text-center" style="min-height:278px;">
			<div class="fb-like-box"  data-width="245" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
		</div>
		<div style="clear:both; height:20px;"></div>
		<?php
			$items=$this->home_model->get_randon_lists('lists',4);
			if($items)
			{
				foreach($items as $item)
				{ 
					?>
						<div class="list_border">
							<img class="img-responsive"src="<?php echo base_url();?>assets/img/thumbs/<?php echo $item->image_thumb;?>" />
							<p class="latest_games_caption list_of_item_title">
								<a href="<?php echo site_url();?>lists/<?php echo $item->alias;?>.html"><?php echo $item->title;?></a>
							</p>
						</div>
					<?php
				}
			}
		?>
	</div>
</div>



