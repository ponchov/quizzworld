<div id="fb-root"></div>
<script>

 	//teststoday id:928641110498954

	//survley id:730590450345834

      window.fbAsyncInit = function() {

        FB.init({

          appId      : '730590450345834',

          xfbml      : true,

          version    : 'v2.3'

        });

      };



      (function(d, s, id){

         var js, fjs = d.getElementsByTagName(s)[0];

         if (d.getElementById(id)) {return;}

         js = d.createElement(s); js.id = id;

         js.src = "//connect.facebook.net/<?php echo $this->fb_localize;?>/sdk.js";

         fjs.parentNode.insertBefore(js, fjs);

       }(document, 'script', 'facebook-jssdk'));

    </script>



<div class="col-xs-12 col-sm-12 col-md-12" style="padding:0;">
	<div class="col-xs-12 col-sm-8 col-md-8" id="list_left_panel">
		<div id="left_content">
				<div class="list_title"><?php echo $tests_info->title; ?></div>	
				<div class="snipet_1"><?php echo get_testMeta($tests_info->tests_id,'list_snippet');?></div>
		
				<div class="social_link">
					<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
					<?php
					$share_url =site_url()."list/".$tests_info->alias.".html";
					$shareAttributes = "addthis:url='$share_url' addthis:title='Test' addthis:description='' ";
					?>
					<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style addthis_32x32_style" data-url="<?php $share_url; ?>" data-title="" style="width:100%;" >
						<a class="socila_button addthis_button_facebook" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/facebook.png" alt="Facebook" /></a>
						<!--<a class="socila_button addthis_button_twitter" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/twitter.png" alt="Twitter" /></a>
						<a class="socila_button addthis_button_stumbleupon" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/pinterest.png" alt="Pinterest" /></a>-->
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
								<div class="item_image "><img class="img-responsive img-rounded_custom"src="<?php echo base_url();?>assets/img/image/<?php echo $list->image;?>" /></div>
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
						<!--<a class="socila_button addthis_button_twitter" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/twitter.png" alt="Twitter" /></a>-->
		<!--				<a class="socila_button addthis_button_stumbleupon" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/pinterest.png" alt="Pinterest" /></a>
		-->			</div>
		
				</div>
		</div>
		<div id="fb_comments" class="text-center">
			<div class="fb-comments"  data-width="100%" data-href="<?php echo site_url();?>/lists<?php echo $tests_info->alias.".html";?>" data-numposts="5" data-colorscheme="light"></div>
		</div>
		<div id="bottom_list">
			<h3 style="padding-bottom:10px;"><?php echo $this->lang->line('you_might_also_like'); ?></h3>
			<?php
			$items=$this->home_model->get_randon_lists('lists',3);
			if($items)
			{
				foreach($items as $item)
				{ 
					$url=site_url().$item->alias.".html";
					if($item->post_type == "games")
					{
						$url=site_url().$item->alias.".html";
					}
					if($item->post_type == "articles")
					{
						$url=site_url()."article/".$item->alias.".html";
					}
					if($item->post_type == "videos")
					{
						$url=site_url()."videos/".$item->alias.".html";
					}
					if($item->post_type == "lists")
					{
						$url=site_url()."list/".$item->alias.".html";
					}
					?>
						<div class="col-xs-12 col-md-4 col-sm-4">
							<a href="<?php echo $url;?>">
								<img class="img-responsive img-rounded"src="<?php echo base_url();?>assets/img/thumbs/<?php echo $item->image_thumb;?>" />
							</a>
							<p class="latest_games_caption list_of_item_title">
								<a href="<?php echo $url;?>"><?php echo $item->title;?></a>
							</p>
						</div>
					<?php
				}
			}
		?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-4 col-md-4  hidden-xs" id="list_right_panel" style="min-height:800px;">
		<div id="right_top">
			<div class="more_title visible-xs"><?php echo $this->lang->line('more_article'); ?></div>
			<?php
				$items=$this->home_model->get_topgames();
				if($items)
				{
					foreach($items as $item)
					{ 
					$url=site_url().$item->alias.".html";
					if($item->post_type == "games")
					{
						$url=site_url().$item->alias.".html";
					}
					if($item->post_type == "articles")
					{
						$url=site_url()."article/".$item->alias.".html";
					}
					if($item->post_type == "videos")
					{
						$url=site_url()."videos/".$item->alias.".html";
					}
					if($item->post_type == "lists")
					{
						$url=site_url()."list/".$item->alias.".html";
					}
						?>
							<div class="list_border">
								<a href="<?php echo $url;?>">
								<img class="img-responsive img-rounded"src="<?php echo base_url();?>assets/img/thumbs/<?php echo $item->image_thumb;?>" />
								</a>
								<p class="latest_games_caption list_of_item_title">
									<a href="<?php echo $url;?>"><?php echo $item->title;?></a>
								</p>
							</div>
						<?php
					}
				}
			?>
			
			<div id="footer_links" class="text-center" style="border:1px #CCCCCC solid; border-top:0px; padding:15px 0px;">
				<a href="<?php echo site_url();?>"><?php echo $this->lang->line('home');?></a>  | 
	
				<a href="<?php echo site_url();?>home/privacy_policy"><?php echo $this->lang->line('private_policy');?></a> | <br />
	
				<a href="<?php echo site_url();?>contact-us.html"><?php echo $this->lang->line('contact');?></a> 
	
				<br />
				<a href="<?php echo site_url();?>"><?php echo $config_info->site_title;?></a> &copy; <?php echo date('Y');?>. <?php echo $this->lang->line('copyright');?>
			</div>
		</div>
	   
		<div style="clear:both; margin-bottom:5px;">&nbsp;</div>
		<div id="ads_block" class="">
			<div class="text-center fb_like_box_big">
					<div class="fb_box">
						<div class="fb_title"><?php echo $this->lang->line('fb_follow_us');?></div>
						<div class="fb-like-box"  data-width="285" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
					</div>
				</div>			
				<div class="text-center fb_like_box_small">
					<div class="fb_box">
						<div class="fb_title"><?php echo $this->lang->line('fb_follow_us');?></div>
						<div class="fb-like-box"  data-width="80" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
					</div>
				</div>
		</div>
 	</div>
	
	<div class="col-xs-12 visible-xs">
		<div id="footer_links" class="text-center" style="border:1px #CCCCCC solid;  padding:15px 0px;">
			<a href="<?php echo site_url();?>"><?php echo $this->lang->line('home');?></a>  | 

			<a href="<?php echo site_url();?>home/privacy_policy"><?php echo $this->lang->line('private_policy');?></a> | <br />

			<a href="<?php echo site_url();?>contact-us.html"><?php echo $this->lang->line('contact');?></a> 

			<br />
			<a href="<?php echo site_url();?>"><?php echo $config_info->site_title;?></a> &copy; <?php echo date('Y');?>. <?php echo $this->lang->line('copyright');?>
		</div>
	</div>
	
</div>




