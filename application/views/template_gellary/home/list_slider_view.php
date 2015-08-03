<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo $this->fb_localize;?>/all.js#xfbml=1&appId=<?php echo trim($config_info->facebook_appid);?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> 




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
					
						$i=0;
						foreach($lists as $list)
						{
							$i++;
							?>
							<div class="list_details ">
								
								<div class="item_title border_top"><?php echo $i;?>. <?php echo $list->item_title;?></div>
								
								<div class="slider_box">
									
									<div class="item_image ">
										<a class="photoslider_drag_message" href="#"> &larr; <?php echo $this->lang->line('slide');?> &rarr;</a>
										<div class="photoslider_left_image">
											<img class=""src="<?php echo base_url();?>assets/img/image/<?php echo $list->image;?>" />
											
										</div>
										<div class="photoslider_right_image">
											<img class=""src="<?php echo base_url();?>assets/img/image/<?php echo $list->image2;?>" />
											
										</div>
									</div>
								</div>
									
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

<style type="text/css">
	.slider_box {
		line-height: 0;
		padding: 0 0 3px;
		position: relative;
	}
	.photoslider_left_image
	{
		border-right: 3px solid #252525;
		cursor: ew-resize;
		margin-right: -5px;
		overflow: hidden;
		position: relative;
		z-index: 2;
		width:51%;
		max-width:625px;
	}
	.photoslider_right_image {
		left: 0;
		cursor: ew-resize;
		position: absolute;
		top: 0;
		z-index: 1;
		max-width:625px;
	}
	.photoslider_drag_message {
		background: none repeat scroll 0 0 rgba(250, 245, 187, 0.8);
		border-radius: 3px;
		color: black;
		display: block;
		font-size: 14px;
		font-weight: 600;
		height: 30px;
		line-height: 30px;
		margin-right: -50px;
		margin-top: -15px;
		position: absolute;
		right: 50%;
		text-align: center;
		text-transform: uppercase;
		top: 50%;
		transition: opacity 0.5s ease-out 0s;
		width: 100px;
		z-index: 3;
	}
</style>



<script language="javascript">
	function touchHandler(event)
	{
		var touches = event.changedTouches,
			first = touches[0],
			type = "";
			 switch(event.type)
		{
			case "touchstart": type = "mousedown"; break;
			case "touchmove":  type="mousemove"; break;        
			case "touchend":   type="mouseup"; break;
			default: return;
		}
	
				 //initMouseEvent(type, canBubble, cancelable, view, clickCount, 
		//           screenX, screenY, clientX, clientY, ctrlKey, 
		//           altKey, shiftKey, metaKey, button, relatedTarget);
	
		var simulatedEvent = document.createEvent("MouseEvent");
		simulatedEvent.initMouseEvent(type, true, true, window, 1, 
								  first.screenX, first.screenY, 
								  first.clientX, first.clientY, false, 
								  false, false, false, 0/*left*/, null);
	
		first.target.dispatchEvent(simulatedEvent);
		//event.preventDefault();
	}
	
	function init() 
	{
		document.addEventListener("touchstart", touchHandler, true);
		document.addEventListener("touchmove", touchHandler, true);
		document.addEventListener("touchend", touchHandler, true);
		document.addEventListener("touchcancel", touchHandler, true);    
	}
	
	
	$(document).ready(function() {
		init();
		
		var slider_width=625;
		var panel_width=$('#list_left_panel').width();
		if(panel_width < 625)
		{
			slider_width=panel_width;
		}
		var left_img_default_width=slider_width/2;
		//alert(left_img_default_width);
		$('.slider_box').css('width',slider_width+'px');
		$('.photoslider_right_image').css('width',slider_width+'px');
		$('.photoslider_right_image > img').css('width',slider_width+'px');
		$('.photoslider_left_image > img').css('width',slider_width+'px');
		$('.photoslider_left_image').css('max-width',slider_width+'px');
		$('.photoslider_left_image').css('width',left_img_default_width+'px');
		
		$(window).resize(function(){
			var panel_width=$('#list_left_panel').width();
			if(panel_width < 625)
			{
				slider_width=panel_width;
			}
			var left_img_default_width=slider_width/2;
			$('.slider_box').css('width',slider_width+'px');
			$('.photoslider_right_image').css('width',slider_width+'px');
			$('.photoslider_right_image > img').css('width',slider_width+'px');
			$('.photoslider_left_image > img').css('width',slider_width+'px');
			$('.photoslider_left_image').css('max-width',slider_width+'px');
			//$('.photoslider_left_image').css('width',left_img_default_width+'px');
		});
		
		 var slider_box_left = $('.slider_box').position().left;
		 var container_left = $('#page-content > .container').position().left;
		 var left_margin=container_left + slider_box_left+10;
		 
		 //alert(left_margin);
		 $('.photoslider_right_image').mousemove(function(e){
			var x = e.pageX - this.offsetLeft - left_margin;
			var y = e.pageY - this.offsetTop;
			
			$(this).prev('div').css("width", x+"px"); 
			$(this).prev('div').prev('a').css("opacity", '0'); 
		});
		
		 $('.photoslider_left_image').mousemove(function(e){
			var x = e.pageX - this.offsetLeft  - left_margin;
			var y = e.pageY - this.offsetTop;
			//alert(x);
			
			
			$(this).css("width", x+"px"); 
		});
	
	
	
		
	});
	
	
	
	
	
	
</script>
