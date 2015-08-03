<script type="text/javascript" src="<?php echo base_url();?>assets/templates/<?php echo $this->template;?>/js/jquery.md5.min.js"></script>
<link href="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/css/3apps.css" rel="stylesheet">
<div class="se-pre-con">
	<div class="loader"></div>
</div>
<div id="fb-root"></div>

<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '<?php echo trim($config_info->facebook_appid);?>',
			cookie     : false,
			xfbml      : true,
			version    : 'v2.3'
		});
		
		//loadFBsdk();
	};
	
	
	(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/<?php echo $this->fb_localize;?>/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>



<div style="clear:both;"></div>
<div class="col-xs-12 col-sm-12 col-md-12">
	<?php if($tests_info->test_top == 1) 
	{ 
	?> 
		<div class="adsense_top col-sm-12 col-md-12 col-xs-12"><?php if($tests_info->default_ads == 2 && $tests_info->test_top_adsense) echo htmlspecialchars_decode($tests_info->test_top_adsense); else if($ads_info->test_top_adsense) echo htmlspecialchars_decode($ads_info->test_top_adsense);?></div> 
	<?php
	 } 
	?>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 prime_area left_part">
	<div class="row pre_next_test">
			<div class="text-center col-xs-6 col-sm-6 col-md-6">
			<?php 				
				$next_test_url=$this->home_model->get_next_test_url($tests_info->testid,$tests_info->activated_date,3);
				$pre_test_url=$this->home_model->get_previous_test_url($tests_info->testid,$tests_info->activated_date,3);
			?>
			<?php  if($pre_test_url) { ?>
				<a href="<?php echo $pre_test_url; ?>" class="btn btn-primary col-xs-12 col-md-12 col-sm-12"><?php echo $this->lang->line('pre_test');?></a>
			<?php } else { ?>
				<a href="" class="btn btn-primary col-xs-12 col-md-12 col-sm-12 disabled"><?php echo $this->lang->line('pre_test');?></a>
			<?php } ?>
			</div>
			
			<div class="text-center col-xs-6 col-sm-6 col-md-6">
	
			<?php if($next_test_url) { ?>
	
				<a href="<?php echo $next_test_url;  ?>" class="btn btn-primary col-xs-12 col-md-12 col-sm-12"><?php echo $this->lang->line('next_test');?></a>
	
			<?php } else { ?>
	
				<a href="" class="btn btn-primary col-xs-12 col-md-12 col-sm-12 disabled"><?php echo $this->lang->line('next_test');?></a>
	
			<?php } ?>
	
			</div>
		</div>
	<div style="clear:both; height:5px;"></div>
	<div class="view_box">
		<div class="view_inner_box">
			<div class="view_title"><?php echo $tests_info->title;?></div>
			<p class="subtitle"><?php echo $this->lang->line('enter_your_name');?></p>
			
			
			<form action="" class="formapp" id="view_form" method="POST">
				<div class="input_container">
					<input id="name" class="test_name_input " tabindex="1" onkeypress="return inputLimiter(event,'AllowedChars')" maxlength="18" type="text" placeholder="<?php echo $this->lang->line('3apps_placeholder');?>"  name="name">
					<label class="input__label input__label--minoru" for="input-13">
						<span class="input__label-content input__label-content--minoru"><?php echo $this->lang->line('type_your_name');?></span>
					</label>
				</div>
				<div class="facebook_share">
						<div class="fb-like" data-href="<?php echo $config_info->facebook_url;?>" data-width="320" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
					</div>
					
					<input type="hidden" name="test_id" id="test_id" value="<?php echo $tests_info->tests_id;?>" />
					<input type="hidden" name="generate_result" id="generate_result" value="generate_result" />
					<div id="next_button"><input tabindex="2" id="sbt" type="submit" class="btn btn-primary next_btn" value="<?php echo $this->lang->line('next_btn');?>" /></div>
				
			</form>
			
			<div class="view_note"><?php echo $this->lang->line('3apps_notes');?></div>
		</div>
	</div>
	
	<div style="clear:both;"></div>
	<div class="comments_area">
		<!--fb_comments-->
		<div id="fb_comments" class="text-center">
			<div class="fb-comments"  data-width="100%" data-href="<?php echo site_url();?><?php echo $tests_info->alias.".html";?>" data-numposts="5" data-colorscheme="light"></div>
		</div>
		<!--end fb_comments-->	
	</div>
	<div class="clear_space" style="clear:both;"></div>
		<?php
		if($tests_info->test_middle == 1)
		{
		?>

		<div class="adsense_bottom text-center " >
		<?php if($tests_info->default_ads == 2 && $tests_info->test_middle_adsense) echo htmlspecialchars_decode($tests_info->test_middle_adsense); else if($ads_info->test_middle_adsense) echo htmlspecialchars_decode($ads_info->test_middle_adsense);?>
		</div>

		<?php } ?>
		
		
		
		
		<div class="well visible-xs" style="margin-bottom:10px;" >
			<?php
							
				
				$purple_test=$this->home_model->get_purple_widget($tests_info->tests_id,$tests_info->lang_code);
				if($purple_test)
				{
				?>
				<div class="recent_app">
				<div class="right-inner">
					<div class="recent_content">
						<span><?php echo $this->lang->line('recent_apps');?></span>
						
					</div>
					<p>
						<?php
						if($purple_test->post_type == 'external')
						{
						?>
						<a  href="<?php echo $purple_test->url;?>" target="_blank">
							<img class="img-responsive " style="" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $purple_test->image;  ?>" alt="" />
							<div class="promoted_title"><?php echo $purple_test->title;?></div>
						</a>
						<?php
						}
						else
						{
						?>
						<a  href="<?php echo site_url();?><?php echo $purple_test->alias;?>.html">
							<img class="img-responsive " style="" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $purple_test->image;  ?>" alt="" />
							<div class="promoted_title"><?php echo $purple_test->title;?></div>
						</a>
						<?php
						}
						?>
						
					</p>
				</div>
			</div>
				<?php 
				}
			?>

	
		</div>
		
		<div style="clear:both;"></div>
		
		<div>
		
		<?php
			//$random_tests=$this->home_model->get_randon_lists('games',9,$tests_info->tests_id,6);
			if($bottom_widgets->items)
			{
			
			$columns=$bottom_widgets->columns;
			$default_class="col-xs-12 col-sm-6 col-md-4";
			if($columns == 1) $default_class="col-xs-12 col-sm-12 col-md-12";
			else if($columns == 2) $default_class="col-xs-12 col-sm-6 col-md-6";
			if($columns == 3) $default_class="col-xs-12 col-sm-6 col-md-4";
			if($columns == 4) $default_class="col-xs-12 col-sm-4 col-md-3";
			$i=0;
			$num=count($bottom_widgets->items);
			$ads_position=(int)($num / 2);
			
			?>
			<?php if($bottom_widgets->items) { ?><div class="rubric-title"><?php echo $this->lang->line('you_may_like');?></div> <?php } ?>
			
			
			
			
			
			<?php
				if($bottom_widgets->external_items)
				{
					foreach($bottom_widgets->external_items as $external_item)
					{
						?>
						<div class="<?php echo $default_class;?> banner_item_box ">
							<a href="<?php echo $external_item->url; ?>" target="_blank">
								<div class="widgets_area">
									
										<img class="img-responsive  img-rounded" style="" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $external_item->image;  ?>" alt="" />
															
									 <div class="top_games_caption"><?php echo $external_item->title; ?> </div>
								 </div>
							</a>
						</div>
						<?php
					}
				}
			?>
			
			<?php
				if($bottom_widgets->direct_items)
				{
					foreach($bottom_widgets->direct_items as $direct_item)
					{
						?>
						<div class="<?php echo $default_class;?> banner_item_box ">
							<a href="<?php echo $direct_item->url; ?>" >
								<div class="widgets_area">
									
										<img class="img-responsive  img-rounded" style="" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $direct_item->image;  ?>" alt="" />
															
									 <div class="top_games_caption"><?php echo $direct_item->title; ?> </div>
								 </div>
							</a>
						</div>
						<?php
					}
				}
			?>
			
			
			
			
			<?php
			 foreach($bottom_widgets->items as $ran_game)
			 {
			 	$i++;
			 	$url=site_url().$ran_game->alias.".html";
				if($ran_game->post_type == "games")
				{
					$url=site_url().$ran_game->alias.".html";
				}
				if($ran_game->post_type == "articles")
				{
					$url=site_url()."article/".$ran_game->alias.".html";
				}
				if($ran_game->post_type == "videos")
				{
					$url=site_url()."videos/".$ran_game->alias.".html";
				}
				if($ran_game->post_type == "lists")
				{
					$url=site_url()."list/".$ran_game->alias.".html";
				}
				
				?>
				<?php
				if($i == $ads_position)
				{
				?>
				<div style="clear:both;" class="visible-xs"></div>
		
				<div class="visible-xs text-center mobile_ads">    
					<?php if(($tests_info->question_top) && $ads_info->question_top_adsense){ ?><div class="sidebar_adsense"><?php echo htmlspecialchars_decode($ads_info->question_top_adsense); ?></div> <?php } ?>
				</div>
				<div style="clear:both;" class="visible-xs"></div>
				<?php
				}
				?>
				<div class="<?php echo $default_class;?> banner_item_box ">
				<a href="<?php echo $url; ?>">
					<div class="widgets_area">
						
							<img class="img-responsive  img-rounded" style="" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $this->home_model->get_thumb($ran_game->testid);  ?>" alt="" />
												
						 <div class="top_games_caption"><?php echo $ran_game->title; ?> </div>
					 </div>
				</a>
				</div>
				<?php
			 }
			?>
			<?php
			}
		?>
		</div>
		
		<div style="clear:both;"></div>
		<?php if($tests_info->test_bottom == 1)
		 { 	
		 ?>	
			 <div class="adsense_bottom text-center"><?php if($tests_info->default_ads == 2 && $tests_info->test_bottom_adsense) echo htmlspecialchars_decode($tests_info->test_bottom_adsense); else if($ads_info->test_bottom_adsense) echo htmlspecialchars_decode($ads_info->test_bottom_adsense);?></div> 
		 <?php  
		 } 
		?>
		
		<div style="clear:both;"></div>
		
		<?php if($tests_info->test_tabo == 1)
		 { 	
		 ?>	
			 <div class="adsense_bottom text-center"><?php if($tests_info->default_ads == 2 && $tests_info->test_tabo_adsense) echo htmlspecialchars_decode($tests_info->test_tabo_adsense); else if($ads_info->test_tabo_adsense) echo htmlspecialchars_decode($ads_info->test_tabo_adsense);?></div> 
		 <?php  
		 } 
		?>
		
		<div style="clear:both;"></div>
</div>  <!--end left_site-->

<div class="col-xs-12 col-sm-12 col-md-4 right_part">
		<?php if($tests_info->test_left == 1) 
		{ 
		?> 
			<div class="adsense_top text-center well site_bar_add_bg" style="margin-bottom:10px;">
				<?php if($tests_info->default_ads == 2 && $tests_info->test_sky_left_adsense) echo htmlspecialchars_decode($tests_info->test_sky_left_adsense); else if($ads_info->test_sky_left_adsense) echo htmlspecialchars_decode($ads_info->test_sky_left_adsense);?>
			</div> 
		
		<?php
		 } 
		?>
		
		
	<?php
		$purple_test=$this->home_model->get_purple_widget($tests_info->tests_id,$tests_info->lang_code);
		if($purple_test)
		{
		?>
		<div class="well right_content" style="margin-bottom:10px;" >
			<div class="recent_app">
				<div class="right-inner">
					<div class="recent_content">
						<span><?php echo $this->lang->line('recent_apps');?></span>
						
					</div>
					<p>
						<?php
						if($purple_test->post_type == 'external')
						{
						?>
						<a  href="<?php echo $purple_test->url;?>" target="_blank">
							<img class="img-responsive " style="" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $purple_test->image;  ?>" alt="" />
							<div class="promoted_title"><?php echo $purple_test->title;?></div>
						</a>
						<?php
						}
						else
						{
						?>
						<a  href="<?php echo site_url();?><?php echo $purple_test->alias;?>.html">
							<img class="img-responsive " style="" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $purple_test->image;  ?>" alt="" />
							<div class="promoted_title"><?php echo $purple_test->title;?></div>
						</a>
						<?php
						}
						?>
						
					</p>
				</div>
		   </div>
	   </div>
		<?php 
		}
	?>

	
		
		
		
	
		
	<?php if($tests_info->test_right == 1) 
	{ 
	?> 
		<div class="adsense_top text-center well site_bar_add_bg" style="margin-bottom:10px;">
			<div class="adsense_top text-center" style="margin-bottom:10px;"><?php if($tests_info->default_ads == 2 && $tests_info->test_sky_right_adsense) echo htmlspecialchars_decode($tests_info->test_sky_right_adsense); else if($ads_info->test_sky_right_adsense) echo htmlspecialchars_decode($ads_info->test_sky_right_adsense);?></div> 
		</div>
	
	<?php
	 } 
	?>
		
	
	<div class="right_content" style="">
		<?php 
		$tags=$this->home_model->get_tags($tests_info->tests_id);
		if($tags) echo $this->lang->line('tags');
		if($tags)
		{
		?>
		<div class="tags well">
		<?php
			$total_tag=count($tags);
			$seperator=", ";
			$i=0;
			foreach($tags as $tag)
			{
				$i++;
				if($i == $total_tag) $seperator=" ";
				?>
					<a href="<?php echo site_url();?>home/tag/<?php echo urlencode($tag->tag);?>"><?php echo $tag->tag;?></a> <?php echo $seperator;?>
				<?php
			}
		?>
		</div>
		<?php
		}
		?>
		<?php 
		if($sidebar_widgets->items || $sidebar_widgets->external_items || $sidebar_widgets->direct_items) 
		{ 
		?>
		<div class="rubric-title"><?php echo $this->lang->line('you_may_like');?></div>
			<?php
				if($sidebar_widgets->external_items)
				{
					foreach($sidebar_widgets->external_items as $external_item)
					{
						?>
						<div class="banner_item_box">
							<a href="<?php echo $external_item->url; ?>" target="_blank">
							<div class="widgets_area">
								
									<img class="img-responsive  img-rounded" style="" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $external_item->image;  ?>" alt="" />
														
								 <div class="top_games_caption"><?php echo $external_item->title; ?></div>
							 </div>
							 </a>
						</div>
						<?php
					}
				}
			?>
			
			<?php
				if($sidebar_widgets->direct_items)
				{
					foreach($sidebar_widgets->direct_items as $direct_item)
					{
						?>
						<div class="banner_item_box">
							<a href="<?php echo $direct_item->url; ?>" >
							<div class="widgets_area">
								
									<img class="img-responsive  img-rounded" style="" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $direct_item->image;  ?>" alt="" />
														
								 <div class="top_games_caption"><?php echo $direct_item->title; ?></div>
							 </div>
							 </a>
						</div>
						<?php
					}
				}
			?>
			
			<?php
				if($sidebar_widgets->items)
				{
					$i=0;
					foreach($sidebar_widgets->items as $ra_fb_apps)
					{
						$i++;
						$url=site_url().$ra_fb_apps->alias.".html";
					?>
					<div class="banner_item_box">
						<a href="<?php echo $url; ?>">
						<div class="widgets_area">
							
								<img class="img-responsive  img-rounded" style="" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $this->home_model->get_thumb($ra_fb_apps->testid);  ?>" alt="" />
													
							 <div class="top_games_caption"><?php echo $ra_fb_apps->title; ?> </div>
						 </div>
						 </a>
					</div>
					<?php 
					}
				}
			?>
			</div>
			<?php
			}
			?>
			<div style="clear:both;"></div>
	</div>





<script language="javascript">
	
	// Wait for window load
	
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");
	});
</script>
<script language="javascript">
$(function() { 
	$(window).resize(function(){
	 $(".fb-comments").attr("data-width", $(".prime_area").width());
	 FB.XFBML.parse($(".prime_area")[0]);
	});
});

</script>


<script type="text/javascript">
function inputLimiter(e,allow) {
    var AllowableCharacters = '';

    if (allow == 'AllowedChars'){AllowableCharacters=' ABCDEFGHIJKLMNOPQRSTUVWXYZ∆ÿ≈abcdefghijklmnopqrstuvwxyz-Ê¯Â‰ˆ¸ÒÎ‡·‚„È';}

    var k = document.all?parseInt(e.keyCode): parseInt(e.which);
    if (k!=13 && k!=8 && k!=0){
        if ((e.ctrlKey==false) && (e.altKey==false)) {
        return (AllowableCharacters.indexOf(String.fromCharCode(k))!=-1);
        } else {
        return true;
        }
    } else {
        return true;
    }
}   
</script>


<script language="javascript">
	function saveCookie(name, value, days) {
		var expires;
		var name=name.trim();
		var name=name.toUpperCase(); 
		var name=$.md5(name);
		//alert(name);
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toGMTString();
		} else {
			expires = "";
		}
		document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
	}
	
	function getCookie(name) { 
		var name=name.trim();
		var name=name.toUpperCase(); 
		var name=$.md5(name);
		
		var nameEQ = encodeURIComponent(name) + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) === ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) === 0)
			{
				return decodeURIComponent(c.substring(nameEQ.length, c.length));
			} 
		}
		return false;
	}
	
	
	var dots = 0;
	function type()
	{
		if(dots < 3)
		{
			$('p.analyze span').append('.');
			dots++;
		}
		else
		{
			$('p.analyze span').html('');
			dots = 0;
		}
	}
	
	function prepare_name(Text)
	{
		return Text
			.toLowerCase()
			.replace(/ /g,'-')
			.replace(/[^\w-]+/g,'')
			;
	}
			
	$(document).ready(function() {
			
			$(document).on('submit','#view_form',function(e) {
				e.preventDefault();
				$('.se-pre-con').append('<p class="analyze"><?php echo $this->lang->line('analyze_profile');?><span></span></p>');
				setInterval (type, 300);
				
				var name=$('#name').val();
				if(name == '') 
				{
					alert("<?php echo $this->lang->line('name_alert');?>");
					return false;
				}
				
				
				
				
				if(getCookie("<?php echo $tests_info->alias;?>_" + name))
				{
					
					var res_id = getCookie("<?php echo $tests_info->alias;?>_" + name);
					
					
				}
				else
				{
					
					<?php
					$ids=$this->home_model->get_result_ids($tests_info->testid);
					
					?>
					var ids="<?php echo $ids;?>";
					ids=ids.split(",");
					
					var res_id=ids[Math.floor(Math.random()*ids.length)];
					
					saveCookie("<?php echo $tests_info->alias;?>_" + name,res_id,'7'); 
					

				}
				
				$(".se-pre-con").show();
				
				var url="<?php echo site_url();?>home/ajax_3apps_result";
				var form_data=$('#view_form').serialize();
				
				var slug=prepare_name(name);
				$.post(url,{res_id:res_id,slug:slug, name:name, test_alias:"<?php echo $tests_info->alias;?>", test_id:"<?php echo $tests_info->tests_id;?>",generate_result:'generate_result'  } , function(data) {
					
					data=$.parseJSON(data);
					var new_url="<?php echo site_url();?>"+data['res_id'];
					$('.view_box').html(data['res']);
					/*setTimeout(function(){
					$(".se-pre-con").fadeOut("slow");
					}, 1000);
					FB.XFBML.parse($(".comments")[0]);
					window.history.pushState("", "",new_url);*/
					document.cookie="result_page=yes";
					//alert(new_url);
					window.location.href=new_url;
				});
				
				
				
				
				
				
			});
	
	});
	
	
	
	
	$(document).ready(function () {
		// $(window).scrollTop($('.question_nav').offset().top);
		 var b="<?php echo site_url();?><?php echo $tests_info->alias;?>.html";
		// window.history.pushState("", "", b);
		 
		
	});
	
	// facebook share
	
	function streamPublish(){
		 var a = screen.width / 2 - 277.5,
            f = screen.height / 2 - 580;
			//alert(window.location.href);
        window.open("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href), "", "width=555px, height=550px,left=" + a + ",top=" + f)
	 }
	
</script>



<script language="javascript">
 $(window).resize(function(){
	 $(".fb-comments").attr("data-width", $(".comments").width());
	 FB.XFBML.parse($(".comments")[0]);
	});
</script>





