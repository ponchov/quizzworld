<link href="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/css/facbook_apps.css" rel="stylesheet">
<div id="fb-root"></div>
<script>
	var fb_loaded = false;
	var fb_liked = true; //on part du principe que c liké
	var fb_ask_for_perm = true;
	
	function loadFBsdk() {
		fb_loaded = true; 
	
		FB.XFBML.parse(document.getElementById('countFB'));
		//setTimeout(function() {$("#newsletter").addClass('flash');},6000);
		
		FB.getLoginStatus(function(response) {
			$("#start").removeAttr("disabled");
			if (response.status === 'connected') {
				FB.api("/me/permissions",function(response) {
					var error_permissions = 4;
					for (var i = 0; i < response.data.length; i++ ) {
						var p=response.data[i].permission;
						if (p == 'user_friends' || p == 'user_birthday' || p == 'user_posts' || p == 'user_photos') error_permissions--;					
					}
					if (error_permissions == 0) fb_ask_for_perm = false;
				});
			}
		});
	}
	
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



<?php
	$posts=(int)get_testMeta($tests_info->testid,'number_of_posts');
	$photos=(int)get_testMeta($tests_info->testid,'number_of_photos');
	
	if($posts < 1) $posts=40;
	if($photos < 1)  $photos=15;
	
	
	$test_image=get_testMeta($tests_info->testid,'test_view_img');
	
	/*echo "<pre>";
	print_r($tests_info);*/
	
?>


<div class="col-sm-12 col-md-12 col-xs-12 view_container">

<div style="background-color:#FFFFFF; margin-bottom:20px; padding-bottom:20px;">

		<?php if($tests_info->test_top == 1) 		{ 
		?> 
			<div class="adsense_top col-xs-12 col-sm-12 col-md-12"><?php if($tests_info->default_ads == 2 && $tests_info->test_top_adsense) echo htmlspecialchars_decode($tests_info->test_top_adsense); else if($ads_info->test_top_adsense) echo htmlspecialchars_decode($ads_info->test_top_adsense);?></div> 
		
		<?php
		 } 
		?>


	<div id="main_container22" class="col-xs-12 col-sm-7 col-md-8 left_part ">
	
		<div class="row pre_next_test">
			<div class="text-center col-xs-6 col-sm-6 col-md-6">
			<?php 				
				$next_test_url=$this->home_model->get_next_test_url($tests_info->testid,$tests_info->activated_date,6);
				$pre_test_url=$this->home_model->get_previous_test_url($tests_info->testid,$tests_info->activated_date,6);
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
		
		<h1 class="quiz_title"><?php echo $tests_info->title;?>  </h1>
		
		<div id="fb_apps_container">
			<?php
			if(isset($friend_name))
			{
				include_once('ajax_facebook_apps_result.php');
			}
			else
			{
			?>
			<div id="fb_apps_info">		
				<div class="">
					<img class="fb_bg_image" src="<?php echo base_url(); ?>assets/img/image/<?php if(!empty($test_image)) echo $test_image; else echo $tests_info->image;  ?>" />
				</div>
				
				<div class="fb_test_description"><?php echo $tests_info->description;?></div>
				<div id="start" class="qc-fb-share">
				<img src="<?php echo base_url();?>assets/img/fb-logo.png">
					<?php
						$button_text=get_testMeta($tests_info->tests_id,'button_text');
						echo $button_text;
					?>
				</div>
				
				<h2 class="text-center" style="margin-bottom:10px;"><?php echo $this->lang->line('leave_comment');?></h2>
			</div>
			
			<div id="loading" class="hidden invisible">
				<span> Calculating... </span>
				<div>
				<img style=" margin-bottom:90px;" src="<?php echo base_url(); ?>assets/img/ajax-loader2.gif" />
				</div>
			</div>
			<?php
			}
			?>
		</div>
		
		<div style="clear:both;"></div>
		<div id="fb_comments" >
				<div class="fb-comments"  data-width="100%" data-href="<?php echo site_url();?><?php echo $tests_info->alias.".html";?>" data-numposts="5" data-colorscheme="light"></div>
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
		
		
		<div style="clear:both;"></div>
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
					<?php if(($tests_info->test_wm) && $ads_info->test_wm_adsense){ ?><div class="sidebar_adsense"><?php echo htmlspecialchars_decode($ads_info->test_wm_adsense); ?></div> <?php } ?>
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
	</div>
	
	
	<div class="col-xs-12 col-sm-5 col-md-4 right_part" style="min-height:500px;">
		<?php if($tests_info->test_left == 1) { 
		?> 
			<div class="adsense_top text-center well site_bar_add_bg" style="margin-bottom:10px;"><?php if($tests_info->default_ads == 2 && $tests_info->test_sky_left_adsense) echo htmlspecialchars_decode($tests_info->test_sky_left_adsense); else if($ads_info->test_sky_left_adsense) echo htmlspecialchars_decode($ads_info->test_sky_left_adsense);?></div> 
		
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

	
		
		
		<?php /*?><div class="text-center fb_like_box_big" style="width:300px; margin:auto; float:none;">
			<div class="fb_box" >				
				<div class="fb-like-box"  data-width="99%" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
			</div>
		</div><?php */?>
		
		
		<?php if($tests_info->test_right == 1) { 
		?> 
			<div class="adsense_top text-center well site_bar_add_bg" style="margin-bottom:10px;"><?php if($tests_info->default_ads == 2 && $tests_info->test_sky_right_adsense) echo htmlspecialchars_decode($tests_info->test_sky_right_adsense); else if($ads_info->test_sky_right_adsense) echo htmlspecialchars_decode($ads_info->test_sky_right_adsense);?></div> 
		
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
			
		<div class="well">
			
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
	</div>
	<div style="clear:both;"></div>

	
</div>


</div>














<script>
//Underscore.js 1.8.3
(function(){function n(n){function t(t,r,e,u,i,o){for(;i>=0&&o>i;i+=n){var a=u?u[i]:i;e=r(e,t[a],a,t)}return e}return function(r,e,u,i){e=b(e,i,4);var o=!k(r)&&m.keys(r),a=(o||r).length,c=n>0?0:a-1;return arguments.length<3&&(u=r[o?o[c]:c],c+=n),t(r,e,u,o,c,a)}}function t(n){return function(t,r,e){r=x(r,e);for(var u=O(t),i=n>0?0:u-1;i>=0&&u>i;i+=n)if(r(t[i],i,t))return i;return-1}}function r(n,t,r){return function(e,u,i){var o=0,a=O(e);if("number"==typeof i)n>0?o=i>=0?i:Math.max(i+a,o):a=i>=0?Math.min(i+1,a):i+a+1;else if(r&&i&&a)return i=r(e,u),e[i]===u?i:-1;if(u!==u)return i=t(l.call(e,o,a),m.isNaN),i>=0?i+o:-1;for(i=n>0?o:a-1;i>=0&&a>i;i+=n)if(e[i]===u)return i;return-1}}function e(n,t){var r=I.length,e=n.constructor,u=m.isFunction(e)&&e.prototype||a,i="constructor";for(m.has(n,i)&&!m.contains(t,i)&&t.push(i);r--;)i=I[r],i in n&&n[i]!==u[i]&&!m.contains(t,i)&&t.push(i)}var u=this,i=u._,o=Array.prototype,a=Object.prototype,c=Function.prototype,f=o.push,l=o.slice,s=a.toString,p=a.hasOwnProperty,h=Array.isArray,v=Object.keys,g=c.bind,y=Object.create,d=function(){},m=function(n){return n instanceof m?n:this instanceof m?void(this._wrapped=n):new m(n)};"undefined"!=typeof exports?("undefined"!=typeof module&&module.exports&&(exports=module.exports=m),exports._=m):u._=m,m.VERSION="1.8.3";var b=function(n,t,r){if(t===void 0)return n;switch(null==r?3:r){case 1:return function(r){return n.call(t,r)};case 2:return function(r,e){return n.call(t,r,e)};case 3:return function(r,e,u){return n.call(t,r,e,u)};case 4:return function(r,e,u,i){return n.call(t,r,e,u,i)}}return function(){return n.apply(t,arguments)}},x=function(n,t,r){return null==n?m.identity:m.isFunction(n)?b(n,t,r):m.isObject(n)?m.matcher(n):m.property(n)};m.iteratee=function(n,t){return x(n,t,1/0)};var _=function(n,t){return function(r){var e=arguments.length;if(2>e||null==r)return r;for(var u=1;e>u;u++)for(var i=arguments[u],o=n(i),a=o.length,c=0;a>c;c++){var f=o[c];t&&r[f]!==void 0||(r[f]=i[f])}return r}},j=function(n){if(!m.isObject(n))return{};if(y)return y(n);d.prototype=n;var t=new d;return d.prototype=null,t},w=function(n){return function(t){return null==t?void 0:t[n]}},A=Math.pow(2,53)-1,O=w("length"),k=function(n){var t=O(n);return"number"==typeof t&&t>=0&&A>=t};m.each=m.forEach=function(n,t,r){t=b(t,r);var e,u;if(k(n))for(e=0,u=n.length;u>e;e++)t(n[e],e,n);else{var i=m.keys(n);for(e=0,u=i.length;u>e;e++)t(n[i[e]],i[e],n)}return n},m.map=m.collect=function(n,t,r){t=x(t,r);for(var e=!k(n)&&m.keys(n),u=(e||n).length,i=Array(u),o=0;u>o;o++){var a=e?e[o]:o;i[o]=t(n[a],a,n)}return i},m.reduce=m.foldl=m.inject=n(1),m.reduceRight=m.foldr=n(-1),m.find=m.detect=function(n,t,r){var e;return e=k(n)?m.findIndex(n,t,r):m.findKey(n,t,r),e!==void 0&&e!==-1?n[e]:void 0},m.filter=m.select=function(n,t,r){var e=[];return t=x(t,r),m.each(n,function(n,r,u){t(n,r,u)&&e.push(n)}),e},m.reject=function(n,t,r){return m.filter(n,m.negate(x(t)),r)},m.every=m.all=function(n,t,r){t=x(t,r);for(var e=!k(n)&&m.keys(n),u=(e||n).length,i=0;u>i;i++){var o=e?e[i]:i;if(!t(n[o],o,n))return!1}return!0},m.some=m.any=function(n,t,r){t=x(t,r);for(var e=!k(n)&&m.keys(n),u=(e||n).length,i=0;u>i;i++){var o=e?e[i]:i;if(t(n[o],o,n))return!0}return!1},m.contains=m.includes=m.include=function(n,t,r,e){return k(n)||(n=m.values(n)),("number"!=typeof r||e)&&(r=0),m.indexOf(n,t,r)>=0},m.invoke=function(n,t){var r=l.call(arguments,2),e=m.isFunction(t);return m.map(n,function(n){var u=e?t:n[t];return null==u?u:u.apply(n,r)})},m.pluck=function(n,t){return m.map(n,m.property(t))},m.where=function(n,t){return m.filter(n,m.matcher(t))},m.findWhere=function(n,t){return m.find(n,m.matcher(t))},m.max=function(n,t,r){var e,u,i=-1/0,o=-1/0;if(null==t&&null!=n){n=k(n)?n:m.values(n);for(var a=0,c=n.length;c>a;a++)e=n[a],e>i&&(i=e)}else t=x(t,r),m.each(n,function(n,r,e){u=t(n,r,e),(u>o||u===-1/0&&i===-1/0)&&(i=n,o=u)});return i},m.min=function(n,t,r){var e,u,i=1/0,o=1/0;if(null==t&&null!=n){n=k(n)?n:m.values(n);for(var a=0,c=n.length;c>a;a++)e=n[a],i>e&&(i=e)}else t=x(t,r),m.each(n,function(n,r,e){u=t(n,r,e),(o>u||1/0===u&&1/0===i)&&(i=n,o=u)});return i},m.shuffle=function(n){for(var t,r=k(n)?n:m.values(n),e=r.length,u=Array(e),i=0;e>i;i++)t=m.random(0,i),t!==i&&(u[i]=u[t]),u[t]=r[i];return u},m.sample=function(n,t,r){return null==t||r?(k(n)||(n=m.values(n)),n[m.random(n.length-1)]):m.shuffle(n).slice(0,Math.max(0,t))},m.sortBy=function(n,t,r){return t=x(t,r),m.pluck(m.map(n,function(n,r,e){return{value:n,index:r,criteria:t(n,r,e)}}).sort(function(n,t){var r=n.criteria,e=t.criteria;if(r!==e){if(r>e||r===void 0)return 1;if(e>r||e===void 0)return-1}return n.index-t.index}),"value")};var F=function(n){return function(t,r,e){var u={};return r=x(r,e),m.each(t,function(e,i){var o=r(e,i,t);n(u,e,o)}),u}};m.groupBy=F(function(n,t,r){m.has(n,r)?n[r].push(t):n[r]=[t]}),m.indexBy=F(function(n,t,r){n[r]=t}),m.countBy=F(function(n,t,r){m.has(n,r)?n[r]++:n[r]=1}),m.toArray=function(n){return n?m.isArray(n)?l.call(n):k(n)?m.map(n,m.identity):m.values(n):[]},m.size=function(n){return null==n?0:k(n)?n.length:m.keys(n).length},m.partition=function(n,t,r){t=x(t,r);var e=[],u=[];return m.each(n,function(n,r,i){(t(n,r,i)?e:u).push(n)}),[e,u]},m.first=m.head=m.take=function(n,t,r){return null==n?void 0:null==t||r?n[0]:m.initial(n,n.length-t)},m.initial=function(n,t,r){return l.call(n,0,Math.max(0,n.length-(null==t||r?1:t)))},m.last=function(n,t,r){return null==n?void 0:null==t||r?n[n.length-1]:m.rest(n,Math.max(0,n.length-t))},m.rest=m.tail=m.drop=function(n,t,r){return l.call(n,null==t||r?1:t)},m.compact=function(n){return m.filter(n,m.identity)};var S=function(n,t,r,e){for(var u=[],i=0,o=e||0,a=O(n);a>o;o++){var c=n[o];if(k(c)&&(m.isArray(c)||m.isArguments(c))){t||(c=S(c,t,r));var f=0,l=c.length;for(u.length+=l;l>f;)u[i++]=c[f++]}else r||(u[i++]=c)}return u};m.flatten=function(n,t){return S(n,t,!1)},m.without=function(n){return m.difference(n,l.call(arguments,1))},m.uniq=m.unique=function(n,t,r,e){m.isBoolean(t)||(e=r,r=t,t=!1),null!=r&&(r=x(r,e));for(var u=[],i=[],o=0,a=O(n);a>o;o++){var c=n[o],f=r?r(c,o,n):c;t?(o&&i===f||u.push(c),i=f):r?m.contains(i,f)||(i.push(f),u.push(c)):m.contains(u,c)||u.push(c)}return u},m.union=function(){return m.uniq(S(arguments,!0,!0))},m.intersection=function(n){for(var t=[],r=arguments.length,e=0,u=O(n);u>e;e++){var i=n[e];if(!m.contains(t,i)){for(var o=1;r>o&&m.contains(arguments[o],i);o++);o===r&&t.push(i)}}return t},m.difference=function(n){var t=S(arguments,!0,!0,1);return m.filter(n,function(n){return!m.contains(t,n)})},m.zip=function(){return m.unzip(arguments)},m.unzip=function(n){for(var t=n&&m.max(n,O).length||0,r=Array(t),e=0;t>e;e++)r[e]=m.pluck(n,e);return r},m.object=function(n,t){for(var r={},e=0,u=O(n);u>e;e++)t?r[n[e]]=t[e]:r[n[e][0]]=n[e][1];return r},m.findIndex=t(1),m.findLastIndex=t(-1),m.sortedIndex=function(n,t,r,e){r=x(r,e,1);for(var u=r(t),i=0,o=O(n);o>i;){var a=Math.floor((i+o)/2);r(n[a])<u?i=a+1:o=a}return i},m.indexOf=r(1,m.findIndex,m.sortedIndex),m.lastIndexOf=r(-1,m.findLastIndex),m.range=function(n,t,r){null==t&&(t=n||0,n=0),r=r||1;for(var e=Math.max(Math.ceil((t-n)/r),0),u=Array(e),i=0;e>i;i++,n+=r)u[i]=n;return u};var E=function(n,t,r,e,u){if(!(e instanceof t))return n.apply(r,u);var i=j(n.prototype),o=n.apply(i,u);return m.isObject(o)?o:i};m.bind=function(n,t){if(g&&n.bind===g)return g.apply(n,l.call(arguments,1));if(!m.isFunction(n))throw new TypeError("Bind must be called on a function");var r=l.call(arguments,2),e=function(){return E(n,e,t,this,r.concat(l.call(arguments)))};return e},m.partial=function(n){var t=l.call(arguments,1),r=function(){for(var e=0,u=t.length,i=Array(u),o=0;u>o;o++)i[o]=t[o]===m?arguments[e++]:t[o];for(;e<arguments.length;)i.push(arguments[e++]);return E(n,r,this,this,i)};return r},m.bindAll=function(n){var t,r,e=arguments.length;if(1>=e)throw new Error("bindAll must be passed function names");for(t=1;e>t;t++)r=arguments[t],n[r]=m.bind(n[r],n);return n},m.memoize=function(n,t){var r=function(e){var u=r.cache,i=""+(t?t.apply(this,arguments):e);return m.has(u,i)||(u[i]=n.apply(this,arguments)),u[i]};return r.cache={},r},m.delay=function(n,t){var r=l.call(arguments,2);return setTimeout(function(){return n.apply(null,r)},t)},m.defer=m.partial(m.delay,m,1),m.throttle=function(n,t,r){var e,u,i,o=null,a=0;r||(r={});var c=function(){a=r.leading===!1?0:m.now(),o=null,i=n.apply(e,u),o||(e=u=null)};return function(){var f=m.now();a||r.leading!==!1||(a=f);var l=t-(f-a);return e=this,u=arguments,0>=l||l>t?(o&&(clearTimeout(o),o=null),a=f,i=n.apply(e,u),o||(e=u=null)):o||r.trailing===!1||(o=setTimeout(c,l)),i}},m.debounce=function(n,t,r){var e,u,i,o,a,c=function(){var f=m.now()-o;t>f&&f>=0?e=setTimeout(c,t-f):(e=null,r||(a=n.apply(i,u),e||(i=u=null)))};return function(){i=this,u=arguments,o=m.now();var f=r&&!e;return e||(e=setTimeout(c,t)),f&&(a=n.apply(i,u),i=u=null),a}},m.wrap=function(n,t){return m.partial(t,n)},m.negate=function(n){return function(){return!n.apply(this,arguments)}},m.compose=function(){var n=arguments,t=n.length-1;return function(){for(var r=t,e=n[t].apply(this,arguments);r--;)e=n[r].call(this,e);return e}},m.after=function(n,t){return function(){return--n<1?t.apply(this,arguments):void 0}},m.before=function(n,t){var r;return function(){return--n>0&&(r=t.apply(this,arguments)),1>=n&&(t=null),r}},m.once=m.partial(m.before,2);var M=!{toString:null}.propertyIsEnumerable("toString"),I=["valueOf","isPrototypeOf","toString","propertyIsEnumerable","hasOwnProperty","toLocaleString"];m.keys=function(n){if(!m.isObject(n))return[];if(v)return v(n);var t=[];for(var r in n)m.has(n,r)&&t.push(r);return M&&e(n,t),t},m.allKeys=function(n){if(!m.isObject(n))return[];var t=[];for(var r in n)t.push(r);return M&&e(n,t),t},m.values=function(n){for(var t=m.keys(n),r=t.length,e=Array(r),u=0;r>u;u++)e[u]=n[t[u]];return e},m.mapObject=function(n,t,r){t=x(t,r);for(var e,u=m.keys(n),i=u.length,o={},a=0;i>a;a++)e=u[a],o[e]=t(n[e],e,n);return o},m.pairs=function(n){for(var t=m.keys(n),r=t.length,e=Array(r),u=0;r>u;u++)e[u]=[t[u],n[t[u]]];return e},m.invert=function(n){for(var t={},r=m.keys(n),e=0,u=r.length;u>e;e++)t[n[r[e]]]=r[e];return t},m.functions=m.methods=function(n){var t=[];for(var r in n)m.isFunction(n[r])&&t.push(r);return t.sort()},m.extend=_(m.allKeys),m.extendOwn=m.assign=_(m.keys),m.findKey=function(n,t,r){t=x(t,r);for(var e,u=m.keys(n),i=0,o=u.length;o>i;i++)if(e=u[i],t(n[e],e,n))return e},m.pick=function(n,t,r){var e,u,i={},o=n;if(null==o)return i;m.isFunction(t)?(u=m.allKeys(o),e=b(t,r)):(u=S(arguments,!1,!1,1),e=function(n,t,r){return t in r},o=Object(o));for(var a=0,c=u.length;c>a;a++){var f=u[a],l=o[f];e(l,f,o)&&(i[f]=l)}return i},m.omit=function(n,t,r){if(m.isFunction(t))t=m.negate(t);else{var e=m.map(S(arguments,!1,!1,1),String);t=function(n,t){return!m.contains(e,t)}}return m.pick(n,t,r)},m.defaults=_(m.allKeys,!0),m.create=function(n,t){var r=j(n);return t&&m.extendOwn(r,t),r},m.clone=function(n){return m.isObject(n)?m.isArray(n)?n.slice():m.extend({},n):n},m.tap=function(n,t){return t(n),n},m.isMatch=function(n,t){var r=m.keys(t),e=r.length;if(null==n)return!e;for(var u=Object(n),i=0;e>i;i++){var o=r[i];if(t[o]!==u[o]||!(o in u))return!1}return!0};var N=function(n,t,r,e){if(n===t)return 0!==n||1/n===1/t;if(null==n||null==t)return n===t;n instanceof m&&(n=n._wrapped),t instanceof m&&(t=t._wrapped);var u=s.call(n);if(u!==s.call(t))return!1;switch(u){case"[object RegExp]":case"[object String]":return""+n==""+t;case"[object Number]":return+n!==+n?+t!==+t:0===+n?1/+n===1/t:+n===+t;case"[object Date]":case"[object Boolean]":return+n===+t}var i="[object Array]"===u;if(!i){if("object"!=typeof n||"object"!=typeof t)return!1;var o=n.constructor,a=t.constructor;if(o!==a&&!(m.isFunction(o)&&o instanceof o&&m.isFunction(a)&&a instanceof a)&&"constructor"in n&&"constructor"in t)return!1}r=r||[],e=e||[];for(var c=r.length;c--;)if(r[c]===n)return e[c]===t;if(r.push(n),e.push(t),i){if(c=n.length,c!==t.length)return!1;for(;c--;)if(!N(n[c],t[c],r,e))return!1}else{var f,l=m.keys(n);if(c=l.length,m.keys(t).length!==c)return!1;for(;c--;)if(f=l[c],!m.has(t,f)||!N(n[f],t[f],r,e))return!1}return r.pop(),e.pop(),!0};m.isEqual=function(n,t){return N(n,t)},m.isEmpty=function(n){return null==n?!0:k(n)&&(m.isArray(n)||m.isString(n)||m.isArguments(n))?0===n.length:0===m.keys(n).length},m.isElement=function(n){return!(!n||1!==n.nodeType)},m.isArray=h||function(n){return"[object Array]"===s.call(n)},m.isObject=function(n){var t=typeof n;return"function"===t||"object"===t&&!!n},m.each(["Arguments","Function","String","Number","Date","RegExp","Error"],function(n){m["is"+n]=function(t){return s.call(t)==="[object "+n+"]"}}),m.isArguments(arguments)||(m.isArguments=function(n){return m.has(n,"callee")}),"function"!=typeof/./&&"object"!=typeof Int8Array&&(m.isFunction=function(n){return"function"==typeof n||!1}),m.isFinite=function(n){return isFinite(n)&&!isNaN(parseFloat(n))},m.isNaN=function(n){return m.isNumber(n)&&n!==+n},m.isBoolean=function(n){return n===!0||n===!1||"[object Boolean]"===s.call(n)},m.isNull=function(n){return null===n},m.isUndefined=function(n){return n===void 0},m.has=function(n,t){return null!=n&&p.call(n,t)},m.noConflict=function(){return u._=i,this},m.identity=function(n){return n},m.constant=function(n){return function(){return n}},m.noop=function(){},m.property=w,m.propertyOf=function(n){return null==n?function(){}:function(t){return n[t]}},m.matcher=m.matches=function(n){return n=m.extendOwn({},n),function(t){return m.isMatch(t,n)}},m.times=function(n,t,r){var e=Array(Math.max(0,n));t=b(t,r,1);for(var u=0;n>u;u++)e[u]=t(u);return e},m.random=function(n,t){return null==t&&(t=n,n=0),n+Math.floor(Math.random()*(t-n+1))},m.now=Date.now||function(){return(new Date).getTime()};var B={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#x27;","`":"&#x60;"},T=m.invert(B),R=function(n){var t=function(t){return n[t]},r="(?:"+m.keys(n).join("|")+")",e=RegExp(r),u=RegExp(r,"g");return function(n){return n=null==n?"":""+n,e.test(n)?n.replace(u,t):n}};m.escape=R(B),m.unescape=R(T),m.result=function(n,t,r){var e=null==n?void 0:n[t];return e===void 0&&(e=r),m.isFunction(e)?e.call(n):e};var q=0;m.uniqueId=function(n){var t=++q+"";return n?n+t:t},m.templateSettings={evaluate:/<%([\s\S]+?)%>/g,interpolate:/<%=([\s\S]+?)%>/g,escape:/<%-([\s\S]+?)%>/g};var K=/(.)^/,z={"'":"'","\\":"\\","\r":"r","\n":"n","\u2028":"u2028","\u2029":"u2029"},D=/\\|'|\r|\n|\u2028|\u2029/g,L=function(n){return"\\"+z[n]};m.template=function(n,t,r){!t&&r&&(t=r),t=m.defaults({},t,m.templateSettings);var e=RegExp([(t.escape||K).source,(t.interpolate||K).source,(t.evaluate||K).source].join("|")+"|$","g"),u=0,i="__p+='";n.replace(e,function(t,r,e,o,a){return i+=n.slice(u,a).replace(D,L),u=a+t.length,r?i+="'+\n((__t=("+r+"))==null?'':_.escape(__t))+\n'":e?i+="'+\n((__t=("+e+"))==null?'':__t)+\n'":o&&(i+="';\n"+o+"\n__p+='"),t}),i+="';\n",t.variable||(i="with(obj||{}){\n"+i+"}\n"),i="var __t,__p='',__j=Array.prototype.join,"+"print=function(){__p+=__j.call(arguments,'');};\n"+i+"return __p;\n";try{var o=new Function(t.variable||"obj","_",i)}catch(a){throw a.source=i,a}var c=function(n){return o.call(this,n,m)},f=t.variable||"obj";return c.source="function("+f+"){\n"+i+"}",c},m.chain=function(n){var t=m(n);return t._chain=!0,t};var P=function(n,t){return n._chain?m(t).chain():t};m.mixin=function(n){m.each(m.functions(n),function(t){var r=m[t]=n[t];m.prototype[t]=function(){var n=[this._wrapped];return f.apply(n,arguments),P(this,r.apply(m,n))}})},m.mixin(m),m.each(["pop","push","reverse","shift","sort","splice","unshift"],function(n){var t=o[n];m.prototype[n]=function(){var r=this._wrapped;return t.apply(r,arguments),"shift"!==n&&"splice"!==n||0!==r.length||delete r[0],P(this,r)}}),m.each(["concat","join","slice"],function(n){var t=o[n];m.prototype[n]=function(){return P(this,t.apply(this._wrapped,arguments))}}),m.prototype.value=function(){return this._wrapped},m.prototype.valueOf=m.prototype.toJSON=m.prototype.value,m.prototype.toString=function(){return""+this._wrapped},"function"==typeof define&&define.amd&&define("underscore",[],function(){return m})}).call(this);
//
</script>

<script>
	var count,balance_array,balance,i,strenght,resultid,win,maxHeight,before,after,timeline,Y,share_id;
	var ScrollTop = 0;
	var quizz_started = false;
	var has_shared = false;
	var winid = '';
	var og_title,og_description;
	var fbid,profile_pic,sex,firstname,soulmate_name,rand;
	
			
	
	var friends_obj = {};
	
	function add_Friend_obj(id,power,main_user) {
		
		if (id != main_user.id) {
			if (friends_obj[id]) {
				friends_obj[id]["power"] += power;
			} else { //si entrée existe pas
				var new_friend = {};
				new_friend.id = id;
				new_friend.power = power;
				friends_obj[id] = new_friend;
			}
		}
	}
	
	 
	$(document).on('click','#games_again',function(e) {
		/*$("#fb_results").addClass('invisible');
		$("#loading>span").html("<?php echo $this->lang->line('get_information');?>");
		setTimeout(function(){
			$("#fb_results").addClass('hidden');
			$("#loading").removeClass('hidden');
			setTimeout(function () { $("#loading").removeClass('invisible'); }, 20);
		},500);*/
		/*FB.api('/me', function(user) {
			CheckFbPost(user);
		});*/
		//StartGame();
		var url="<?php echo site_url();?><?php echo $tests_info->alias;?>.html";
		window.location=url;
	});
	
	//$("#start").click(function() {
	$(document).on('click','#start',function(e) {
		$("#start").attr("disabled","disabled");
		if (fb_ask_for_perm) {
			FB.login(function(response){
				if (response.authResponse) {
					StartGame();
				} else {
					$("#start").removeAttr("disabled");
				}
			},{scope:'user_friends,user_birthday,user_posts,user_photos'});
		} else {
			StartGame();
		}
	});
	
	function StartGame() {
		//alert('started');
		$("#fb_apps_info").addClass('invisible');
		$("#loading>span").html('Getting information...');
		setTimeout(function(){
			$("#fb_apps_info").addClass('hidden');
			$("#loading").removeClass('hidden');
			setTimeout(function () { $("#loading").removeClass('invisible'); }, 20);
		},500);
		FB.api('/me', function(user) {
			CheckFbPost(user);
		});
	}
	
	function CheckFbPost(user) {
		var number_of_posts="<?php echo $posts;?>";
		FB.api("/me/posts",{fields: ['comments', 'likes', 'with_tags', 'from', 'to'], limit:number_of_posts},function(response) {
			if (response && response.data) {
				$("#loading>span").html('Analyzing social interactions...');
				console.log("/me/posts",response);
				for (var i = 0; i < response.data.length; i++ ) {
					var post = response.data[i];
					
					if (post.comments && post.comments.data.length > 0) {
						for (var j = 0; j < post.comments.data.length; j++)
							if (post.comments.data[j].from && post.comments.data[j].from.id) add_Friend_obj(post.comments.data[j].from.id,2,user);
					}
					if (post.likes && post.likes.data.length > 0) {
						for (var j = 0; j < post.likes.data.length; j++)
							if (post.likes.data[j].id) add_Friend_obj(post.likes.data[j].id,3,user);
					}
					if (post.with_tags && post.with_tags.data.length > 0) {
						for (var j = 0; j < post.with_tags.data.length; j++)
							if (post.with_tags.data[j].id) add_Friend_obj(post.with_tags.data[j].id,2,user);
					}
					if (post.to && post.to.data.length > 0) {
						for (var j = 0; j < post.to.data.length; j++)
							if (post.to.data[j].id) add_Friend_obj(post.to.data[j].id,3,user);
					}
				}
			}
			
			CheckFBPhotos(user);
		});	
	}
	
	function CheckFBPhotos(user) {
		//alert('check photos');
		var number_of_photos="<?php echo $photos;?>";
		FB.api("/me/photos",{limit:number_of_photos},function(response) {
			if (response && response.data) {
				$("#loading>span").html('Analyzing photos...');
				console.log("/me/photos",response);
				for (var i = 0; i < response.data.length; i++ ) {
					var photo = response.data[i];
					if (photo.tags && photo.tags.data.length > 0) {
						for (var j = 0; j < photo.tags.data.length; j++) {
							if (photo.tags.data[j].id && photo.tags.data[j].id != user.id) {
								if (photo.tags.data.length <= 2) add_Friend_obj(photo.tags.data[j].id,3,user);
								else if (photo.tags.data.length <= 3) add_Friend_obj(photo.tags.data[j].id,2,user);
								else add_Friend_obj(photo.tags.data[j].id,1,user);
							}
						}
					}
				}
				console.log("unsorted",friends_obj);
				
			}
			
			if (_.size(friends_obj)>0) {
				filter_Fb_friends(user);
			} else { //si toujours pas d'ami, on prend le premier pote loggé et basta
				
				console.log("no_friends");
				FB.api("/me/friends",function(response) {
					console.log(response);
					if (response && response.data.length > 0) {
						add_Friend_obj(response.data[0].id,1,user);
					} else { //on s'ajoute soi-même
						var myself = {};
						myself.id = user.id;
						myself.power = 10;
						friends_obj[user.id] = myself;
					}
					filter_Fb_friends(user);
				});
			}
		});
	}
	
	function filter_Fb_friends(user) {
		//alert('filter friends');
		var removePower=1;
		while(_.size(friends_obj)>10) {
			for(var id in friends_obj) { 
			   if (friends_obj.hasOwnProperty(id)) {
				   if (_.size(friends_obj)>10 && friends_obj[id].power == removePower) delete friends_obj[id];
			   }
			}
			removePower++;
		}
		
		var ids = [];
		for(var id in friends_obj) { 
			ids.push(id);
		}	
		if (ids.length == 0) return;
		FB.api("/",{ids: ids, fields:'metadata{type}', metadata:1},function(response) { 
			$("#loading>span").html("<?php echo $this->lang->line('analyzing_potential');?>");
			/*for (var id in response) {
				var r = response[id];
				if (r.metadata && r.metadata.type && r.metadata.type == 'user') friends_obj[r.id].type = 'user';
				else delete friends_obj[r.id];
			}
			
			while(_.size(friends_obj)>4) {
				for(var id in friends_obj) { 
				   if (friends_obj.hasOwnProperty(id)) {
					   if (_.size(friends_obj)>4 && friends_obj[id].power == removePower) delete friends_obj[id];
				   }
				}
				removePower++;
			}*/
			
			var final_ids = [];
			var ss="";
			for(var id in friends_obj) {final_ids.push(id); var ss=ss+id+"**"}
			rand = Math.floor((Math.random()*_.size(friends_obj)));
			var soulmate_id = final_ids[rand];
			
			console.log("finals",final_ids);
			
			FB.api("/"+soulmate_id,{'fields': ['id', 'name']},function(response) {
				friend_name = response.name;
				//$("#final_description>b").html(soulmate_name);
				FB.api("http://graph.facebook.com/"+soulmate_id+"/picture?width=191&height=191",function (response) {
					var friend_pic = response.data.url;
					FB.api("http://graph.facebook.com/me/picture?width=191&height=191",function (response) {
						if (response && !response.error) {
							var user_pic = response.data.url;
							fbid = user.id;
							var alias="<?php echo $tests_info->alias; ?>";	
							//alert(user_pic);
							//alert(friend_pic);
								
									
							var url="<?php echo site_url();?>home/facebook_apps";
							//alert(url); 
							 $.post(url,{alias:alias, friend_name:friend_name,friend_pic:friend_pic,user_pic:user_pic,friend_id:soulmate_id,user_id:fbid},function(data) {
								$("#loading>span").html("<?php echo $this->lang->line('calculating');?>");
								//return false;
								//$('#fb_apps_container').html(data);	
								var res=$.parseJSON(data);
								//alert(res['bg_img']);
								id=res['id'];
								window.location="<?php echo site_url();?><?php echo $tests_info->alias;?>.html?result="+id;
							});
						}
					});
				});
			});	
		});
	}
	
	<?php
	if(isset($_GET['fb_r']))
	{
	?>
	$(document).ready(function() {
		var url="<?php echo site_url();?><?php echo $tests_info->alias;?>.html";
		window.history.pushState("", "", url);
	});
	<?php
	}
	?>
</script>

