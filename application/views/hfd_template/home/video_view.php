<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo trim($config_info->facebook_appid);?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> 

<link href="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/css/video-js.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/js/video.js"></script>


<div class="col-xs-12 col-sm-12 col-md-12" style="padding:0;">
	<div class="col-xs-12 col-sm-8 col-md-8 list_left_box" id="list_left_panel">
		<div id="left_content">
			<div class="list_title"><?php echo $tests_info->title; ?></div>
			<div class="snipet_1"><?php echo get_testMeta($tests_info->tests_id,'video_snippet');?></div>
			<!--social link-->
			<div class="social_link">
				<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
				<?php
				$share_url =site_url()."videos/".$tests_info->alias.".html";
				$shareAttributes = "addthis:url='$share_url' addthis:title='Test' addthis:description='' ";
				?>
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style addthis_32x32_style" data-url="<?php $share_url; ?>" data-title="" style="width:100%;" >
					<a class="socila_button addthis_button_facebook" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/facebook.png" alt="Facebook" /></a>
					<!--<a class="socila_button addthis_button_twitter" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/twitter.png" alt="Twitter" /></a>
					<a class="socila_button addthis_button_stumbleupon" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/pinterest.png" alt="Pinterest" /></a>-->
				</div>
	
			</div>
			<!--end social link-->
			<div class="list_image"><img class="img-responsive img-rounded_custom" src="<?php echo base_url();?>assets/img/image/<?php echo $tests_info->image; ?>" /></div>
			<div class="snipet_2"><?php echo get_testMeta($tests_info->tests_id,'article_snippet_2');?></div>
			<div class="description"><?php echo $tests_info->description; ?></div><br />
			<div class="snipet_3"><?php echo get_testMeta($tests_info->tests_id,'video_snippet');?></div>
			<div class="video col-xs-12, col-md-12">
				<?php
					$video_type=get_testMeta($tests_info->tests_id,'video_type');
					if($video_type == "internal" || $video_type == "" )
					{
						$video_name=get_testMeta($tests_info->tests_id,'video');
						$video_info=pathinfo($video_name);
						
						
						
						if($video_name != '')
						{
							$extension=$video_info['extension'];
							?>
								<?php /*?><video id="internal_video" width="auto" height="auto"  class="video-js vjs-default-skin"
								  controls preload="auto" 
								  poster="<?php echo base_url(); ?>assets/videos/<?php echo $video_name; ?>"
								  data-setup='{"example_option":true}'>
								 <source src="<?php echo base_url(); ?>assets/videos/<?php echo $video_name; ?>" type='video/<?php echo $extension; ?>' />		 
								</video><?php */?>
								
							  <video id="internal_video" class="video-js vjs-default-skin" controls preload="auto" 
							  data-setup='{ "asdf": true }' poster="<?php echo base_url(); ?>assets/videos/<?php echo $video_name; ?>" >
								<source src="<?php echo base_url(); ?>assets/videos/<?php echo $video_name; ?>" type='video/<?php echo $extension; ?>'>
								
							  </video>
								
								
							<?php 
						}
					}
					else if($video_type == "youtube")
					{
						$video_name=get_testMeta($tests_info->tests_id,'video');
						$url =explode("=", $video_name);					
						$total=count($url);
						$youtube_id=$url[$total -1];
						$youtube_url="http://www.youtube.com/embed/".$youtube_id;
						?>
							<iframe  id="youtube_video" src="<?php echo $youtube_url;?>" ></iframe>
							 
						<?php 
					}
					else if($video_type == "vimo")
					{
						$video_name=get_testMeta($tests_info->tests_id,'video');
						$url =explode("/", $video_name);
						$total=count($url);
						$vimo_id=$url[$total -1];
						?>
						<iframe id="youtube_video" src="//player.vimeo.com/video/<?php echo $vimo_id; ?>"  frameborder="0" ></iframe>
						<?php 
					}
				?>	
						
				<div style="clear:both; height:10px;"></div>
			</div>
			<div style="clear:both; "></div>
			<!--social link-->
			<div class="social_link">			
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style addthis_32x32_style" data-url="<?php $share_url; ?>" data-title="" style="width:100%;" >
					<a class="socila_button addthis_button_facebook" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/facebook.png" alt="Facebook" /></a>
	<!--				<a class="socila_button addthis_button_twitter" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/twitter.png" alt="Twitter" /></a>
					<a class="socila_button addthis_button_stumbleupon" <?php echo $shareAttributes; ?>><img src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/img/pinterest.png" alt="Pinterest" /></a>
	-->			</div>
	
			</div>
			<!--end social link-->
		
		</div>
		
		<div id="fb_comments" class="text-center">
			<div class="fb-comments"  data-width="100%" data-href="<?php echo site_url();?>/lists<?php echo $tests_info->alias.".html";?>" data-numposts="5" data-colorscheme="light"></div>
		</div>
		<div id="bottom_list">
			<h3 style="padding-bottom:10px;"><?php echo $this->lang->line('you_might_also_like'); ?></h3>
			<?php
			$items=$this->home_model->get_randon_lists('videos',3);
			if($items)
			{
				foreach($items as $item)
				{ 
					?>
						<div class="col-xs-12 col-md-4 col-sm-4">
							<a href="<?php echo site_url();?>videos/<?php echo $item->alias;?>.html">
								<img class="img-responsive img-rounded"src="<?php echo base_url();?>assets/img/thumbs/<?php echo $item->image_thumb;?>" />
							</a>
							<p class="latest_games_caption list_of_item_title">
								<a href="<?php echo site_url();?>videos/<?php echo $item->alias;?>.html"><?php echo $item->title;?></a>
							</p>
						</div>
					<?php
				}
			}
		?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-3 col-md-3 pull-right hidden-xs" id="list_right_panel" style="min-height:800px;">
		<div id="right_top">
		<div class="more_title visible-xs"><?php echo $this->lang->line('more_article'); ?></div>
		<?php
			$items=$this->home_model->get_randon_lists('videos',4);
			if($items)
			{
				foreach($items as $item)
				{ 
					?>
						<div class="list_border">
							<a href="<?php echo site_url();?>list/<?php echo $item->alias;?>.html">
								<img class="img-responsive img-rounded"src="<?php echo base_url();?>assets/img/thumbs/<?php echo $item->image_thumb;?>" />
							</a>
							<p class="latest_games_caption list_of_item_title">
								<a href="<?php echo site_url();?>videos/<?php echo $item->alias;?>.html"><?php echo $item->title;?></a>
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
						<div class="fb_title">Follow us on Facebook</div>
						<div class="fb-like-box"  data-width="236" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
					</div>
				</div>			
				<div class="text-center fb_like_box_small">
					<div class="fb_box">
						<div class="fb_title">Follow us on Facebook</div>
						<div class="fb-like-box"  data-width="70" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
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


<script language="javascript">
	
		var video_width=$('.video').width();
		var video_height=(281*video_width)/500
		//alert(video_width);
		$('#youtube_video').attr('width',video_width);
		$('#youtube_video').attr('height',video_height);
	
	
</script>
 <script language="javascript">
  //videojs.autoSetup();

    videojs('internal_video').ready(function(){
      //console.log(this.options()); //log all of the default videojs options
      
       // Store the video object
      var myPlayer = this, id = myPlayer.id();
      // Make up an aspect ratio
      var aspectRatio = 281/500; 

      function resizeVideoJS(){
        var width = document.getElementById(id).parentElement.offsetWidth;
        myPlayer.width(width).height( width * aspectRatio );
		$('.vjs-big-play-button').css({top:'40%',left:'40%'});

      }
      
      // Initialize resizeVideoJS()
      resizeVideoJS();
      // Then on resize call resizeVideoJS()
      window.onresize = resizeVideoJS; 
    });
  </script>
