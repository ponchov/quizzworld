<div id="fb-root"></div>

<script>(function(d, s, id) {

  var js, fjs = d.getElementsByTagName(s)[0];

  if (d.getElementById(id)) return;

  js = d.createElement(s); js.id = id;

  js.src = "//connect.facebook.net/<?php echo $this->fb_localize;?>/all.js#xfbml=1&appId=<?php echo trim($config_info->facebook_appid);?>";

  fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));





</script>


<?php /*?><div class="col-sm-12 col-md-12 col-xs-12" id="featured_post">
	<div class="autoplay">
		  <?php
				if($featured_posts)
				{
					foreach($featured_posts as $featured_post)					
					{
						$fea_caption= $this->lang->line('personality_quizz');
						$url=site_url().$featured_post->alias.".html";
						if($featured_post->post_type == "games")
						{
							$fea_caption=$this->lang->line('personality_quizz');
							$url=site_url().$featured_post->alias.".html";
						}
						if($featured_post->post_type == "articles")
						{
							$fea_caption=$this->lang->line('article');
							$url=site_url()."article/".$featured_post->alias.".html";
						}
						if($featured_post->post_type == "videos")
						{
							$fea_caption=$this->lang->line('video');
							$url=site_url()."videos/".$featured_post->alias.".html";
						}
						if($featured_post->post_type == "lists")
						{
							$fea_caption=$this->lang->line('list');
							$url=site_url()."list/".$featured_post->alias.".html";
						}
					
						?>
						<div class="col-xs-12 col-sm-3 col-md-3 item" >
							<div class="featured_title hidden-xs"><?php echo $fea_caption; ?></div>
							
								<a href="<?php echo $url; ?>">
								<img class="img-responsive  img_rounded_featured" style="" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $featured_post->image_thumb;  ?>" alt="" />
								</a>
								<div class="featured_caption"><a href="<?php echo $url; ?>"><?php echo $featured_post->title; ?> </a></div>
							
						</div>
						<?php 
					}
				}
			?>
		</div>
	<div class="col-sm-12 featured_hr"><hr></div>
	
</div><?php */?> <!--featured_post-->



<div class="col-xs-12 col-sm-12 col-md-12 " style="padding:5px 0;">
	<div class="col-xs-12 col-sm-8 col-md-9"  id="left_part">
		<div id="latest_headlineArea" class="col-sm-12" style="width:100%; padding-bottom:5px;">
			<div class="games_headline"><?php echo $this->lang->line('latest'); ?> <?php echo $quiz_type; ?></div>
		</div>
		<div id="post_container">
		<?php
			
			if($game_list)
			{
				foreach($game_list as $game)
				{
					$caption=$this->lang->line('personality_quizz');
					$url=site_url().$game->alias.".html";
					if($game->post_type == "games")
					{
						if($game->is_real_test == 2)
						{
							$caption=$this->lang->line('trivia');
						}
						else if($game->is_real_test == 6)
						{
							$caption=$this->lang->line('apps');						
						}
						else if($game->is_real_test == 3)
						{
							$caption=$this->lang->line('name_apps');						
						}
						else
						{
							$caption=$this->lang->line('personality_quizz');
						}
						
						$url=site_url().$game->alias.".html";
					}
					if($game->post_type == "articles")
					{
						$caption=$this->lang->line('article');
						$url=site_url()."article/".$game->alias.".html";
					}
					if($game->post_type == "videos")
					{
						$caption=$this->lang->line('video');
						$url=site_url()."videos/".$game->alias.".html";
					}
					if($game->post_type == "lists")
					{
						$caption=$this->lang->line('list');;
						$url=site_url()."list/".$game->alias.".html";
					}
				?>
					<div class="col-xs-6 col-sm-6 col-md-6 latest_item_box">
						<div class="latest_title hidden-xs"><?php echo $caption;?></div>
						
						<div class="">						
								<a href="<?php echo $url;?>">								
									<img class="img-responsive img-rounded_custom" style="" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $this->home_model->get_thumb($game->testid);  ?>" alt="" />
									<span class="start_button"><?php echo $this->lang->line('start_btn');?></span>
								</a>
						</div>
						
						
						<div class="latest_title_mob visible-xs"><?php echo $caption;?></div>
					    <div class="latest_games_caption">
							<a href="<?php echo $url;?>">
								<?php echo $game->title;?>
							</a>
							<?php /*?><div class="latest_description hidden-xs">
								<?php 
									 $sub_title=get_testMeta($game->tests_id,'sub_title');
								?>
								<a href="<?php echo $url;?>"><?php if(!empty($sub_title)) echo nl2br($sub_title); ?></a> 
							</div><?php */?>
						</div>
						
					</div>
				<?php 
				}
			}
		?>
		</div>
		<div id="paginationArea" class="col-xs-12 col-sm-12">
			<?php
			 if($page == 0) $page=1;
			 $pagination_record=$limit*$page;
			 if(($pagination)) 
			 { 
				if($pagination_record <  $total_record)
				{
			 ?>
				<a class="next_page" href="<?php echo site_url();?><?php if(isset($ref_page) && $ref_page != '') echo $ref_page."/";?>page/<?php echo $page+1;?>"><button type="button" class="btn btn-primary col-xs-12 col-sm-12 col-md-12"><?php echo $this->lang->line('next_page');?></button></a>
			<?php
				}
				else
				{
					?>
						<a class="next_page" href="<?php echo site_url();?><?php if(isset($ref_page) && $ref_page !='') echo $ref_page."/";?>page/<?php echo $page - 1;?>"><button type="button" class="btn btn-primary col-xs-12 col-sm-12 col-md-12"><?php echo $this->lang->line('pre_page');?></button></a>
	
					<?php
	
				} 
	
			} 
	
			?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-4 col-md-3" style="padding:0;" id="right_part">
		<div class="col-sm-12 top_headline" style="width:100%; padding-bottom:19px;"><div class="games_headline"><?php echo $this->lang->line('you_may_like'); ?></div></div>
		<div class="col-sm-12" id="right_panel">
			<div id="right_top">
			<?php
				if($widgets->external_items)
				{
					foreach($widgets->external_items as $external_item)
					{
						?>
						<div class="col-xs-6 col-sm-12 col-md-12">
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
				if($widgets->direct_items)
				{
					foreach($widgets->direct_items as $direct_item)
					{
						?>
						<div class="col-xs-6 col-sm-12 col-md-12">
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
				//echo count($widgets->items);
				if($widgets->items)
				{
					$i=0;
					//print_r($widgets->items); exit;
					foreach($widgets->items as $ran_game)
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
					<div class="col-xs-6 col-sm-12 col-md-12">
						<a href="<?php echo $url; ?>">
						<div class="widgets_area">
							
								<img class="img-responsive  img-rounded" style="" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $this->home_model->get_thumb($ran_game->testid);  ?>" alt="" />
													
							 <div class="top_games_caption"><?php echo $ran_game->title; ?></div>
						 </div>
						 </a>
					</div>
					<?php 
					}
				}
			?>
				<div style="clear:both;"></div>
				<div id="footer_links" class="text-center" style="border:1px #CCCCCC solid;  margin:15px; padding:15px 20px;">
					<a href="<?php echo site_url();?>"><?php echo $this->lang->line('home');?></a> 
		
					<a href="<?php echo site_url();?>home/privacy_policy"><?php echo $this->lang->line('private_policy');?></a> 
		
					<a href="<?php echo site_url();?>contact-us.html"><?php echo $this->lang->line('contact');?></a> 
		
					
					<div class="copyRight">
					 &copy; <?php echo date('Y');?>. <?php echo $this->lang->line('copyright');?>
					</div>
				</div>
			</div>
			<div style="clear:both;"></div>
			<?php /*?><div id="ads_block" class="hidden-xs hidden-sm">
				<div class="col-sm-12 text-center fb_like_box_big">
					<div class="fb_box">
						<div class="fb_title"><?php echo $this->lang->line('fb_follow_us');?></div>
						<div class="fb-like-box"  data-width="236" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
					</div>
				</div>			
				<div class="col-sm-12 text-center fb_like_box_small">
					<div class="fb_box">
						<div class="fb_title"><?php echo $this->lang->line('fb_follow_us');?></div>
						<div class="fb-like-box"  data-width="70" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
					</div>
				</div>
			</div><?php */?>
		</div> <!--right_panel-->
	</div>
	<div style="clear: both;"></div>	
</div>

<div class="fb_popup facebook-popup facebook-off">
	<div class="fb_popup_close">
		<span class="fb_text"><?php echo $this->lang->line('fb_follow_us');?></span>
		<a style="float:right;"  class="popup-close" id="bpclosetrig" onClick="hidepopup()">X</a>
	</div>
	<div class="fb-like-box"  data-width="" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="false" data-header="true" data-stream="false" data-show-border="true"></div>
</div>
<div id="up_arrow">
	<img src="<?php echo base_url();?>assets/templates/<?php echo $this->template;?>/img/up_arrow.png" />
</div>
<script type="text/javascript">
      jQuery(document).ready(function($) {
	  	
		
		<?php
			$total_post=$total_record;
			$total_page=$total_post/6;
			$total_page=(int)$total_page;
			$modolas=$total_post%6;
			if($modolas > 0) $total_page=$total_page+1;
			$total_page=$total_page ;
		?>
        var count = 4;
		var total = <?php echo $total_page; ?>;
		
		var document_width=$(document).width();
		if(document_width > 768 )
		{ 
			$('.next_page').hide();
			$(window).scroll(function(){
				if  ($(window).scrollTop() == $(document).height() - $(window).height()){
					if (count > total){
						return false;
					}else{
						//alert(count);
						loadArticle(count);
					}
					count++;
				}
			}); 
		}
		else
		{
			$('.next_page').show();
		}
 
          function loadArticle(pageNumber){ //alert(pageNumber); 
                  //$('div#inifiniteLoader').show('fast');
                  $.ajax({
                      url: "<?php echo site_url();?>home/ajax_load",
                      type:'POST',
                      data: "action=infinite_scroll&game_type=<?php echo $game_type;?>&page_no="+ pageNumber, 
                      success: function(html){
					  		//alert(html);
                         $('div#inifiniteLoader').hide('1000');
                          $("#post_container").append(html);    // This will be the div where our content will be loaded
                      }
                  });
              return false;
          }
   
      });
	  
	 // $('.facebook-popup').hide();
	  
	  /*$(window).scroll(function () {
			if($(window).scrollTop() + $(window).height() >  1800) {
				//$('#up_arrow').css({bottom:'120px'});

				if($(".fb_popup").hasClass('facebook-off'))
				{
					$(".fb_popup").addClass('facebook-on');
					$(".fb_popup").removeClass('facebook-off');
					$(".fb_popup").animate({'right': '10px'},1500);
				}

			}
			else
			{
				$('#up_arrow').css({bottom:'0px'});
				if($(".fb_popup").hasClass('facebook-on'))
				{
					$(".fb_popup").removeClass('facebook-on');
					$(".fb_popup").addClass('facebook-off');
					$(".fb_popup").animate({'right': '-330px'},1500);
				}
				

			}
			
		});*/
		
		function hidepopup()
		{
			//$('.fb_popup').slideUp();
			
			$(".fb_popup").removeClass('facebook-on');
			$(".fb_popup").addClass('facebook-off');
			$(".fb_popup").animate({'right': '-330px'},1500);
			$(".fb_popup").removeClass('fb_popup');
			
		}
		
		var lastScrollTop = 0;
		$(window).scroll(function(event){
		   var st = $(this).scrollTop();
		   if (st > lastScrollTop){
			  if(st + $(window).height() >  1800)
			  {
			  	if($(".fb_popup").hasClass('facebook-off'))
				{
					$(".fb_popup").addClass('facebook-on');
					$(".fb_popup").removeClass('facebook-off');
					$(".fb_popup").animate({'right': '10px'},1500);
				}
			  }
		   } else {
			  	if($(".fb_popup").hasClass('facebook-on'))
				{
					$(".fb_popup").removeClass('facebook-on');
					$(".fb_popup").addClass('facebook-off');
					$(".fb_popup").animate({'right': '-330px'},500);
				}
		   }
		   lastScrollTop = st;
		});
		
		$(document).ready(function() {
			$("#up_arrow").hide();
			
			$(function () {
				$(window).scroll(function () {
					if ($(this).scrollTop() > 100) {
						$('#up_arrow').fadeIn();
					} else {
						$('#up_arrow').fadeOut();
					}
				});
		
				// scroll body to 0px on click
				$('#up_arrow').click(function () {
					$('body,html').animate({
						scrollTop: 0
					}, 800);
					return false;
				});
			});
		});
      
  </script>
  
  
  <style type="text/css">
  	.fix_ads {
		position:fixed;
		top:85px;
		
	}
	
	#up_arrow {
		position:fixed;
		right:0px;
		bottom:0px;
		z-index:0;
		/*opacity:0.5;*/
		cursor:pointer;
	}
	.slick-slider
	{
		margin-bottom:0;
		
	}
	.featured_hr hr
	{
		margin-bottom:14px;
		margin-top:14px;
	}
  </style>
  
  
  <script language="javascript">
 
	 
	function fixDiv() {
		var $div = $("#right_top");
		
		if ($(window).scrollTop() > $div.data("top")) { //alert( $div.data("top")); return ;
			$('#ads_block').addClass('fix_ads');
		}
		else {
		   $('#ads_block').removeClass('fix_ads');
		}
	}
	
	
	//alert($("#left_part").offset().top);
	
	setTimeout( function(){ 
		var right_top_height=$('#right_top').height();
		var head_line_height=$('.top_headline').height();
		var menu_height=$('#slide-nav').height();
		var feature_post_height=$('#featured_post').height();
		
		top_offset=right_top_height + head_line_height + menu_height + feature_post_height;
		//alert(right_top_height);
		//var top_offset=($("#left_part").offset().top + $('#right_top').height()) - 200;
		$("#right_top").data("top", top_offset); // set original position on load
		$(window).scroll(fixDiv);
	  }
	 , 2500 );
	
	
	


</script>





							