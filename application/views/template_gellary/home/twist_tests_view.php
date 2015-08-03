<link href="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/css/twist.css" rel="stylesheet">
<div id="fb-root"></div>


<script>

 	//teststoday id:928641110498954

	//survley id:730590450345834
	// quiztwist 1410218625953821

      window.fbAsyncInit = function() {

        FB.init({

          appId      : '<?php echo trim($config_info->facebook_appid);?>',

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
	
<div class="col-sm-12 col-md-12 col-xs-12 view_container">
<div style="background-color:#FFFFFF; margin-bottom:20px; padding-bottom:20px;">

	<div style="clear:both; height:5px;"></div>
	<div id="main_container22" class="col-xs-12 col-sm-8 col-md-8 left_part ">
		
		<div class="row pre_next_test">
			<div class="text-center col-xs-6 col-sm-6 col-md-6">
			<?php 				
				$next_test_url=$this->home_model->get_next_test_url($tests_info->testid,$tests_info->activated_date,2);
				$pre_test_url=$this->home_model->get_previous_test_url($tests_info->testid,$tests_info->activated_date,2);
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
		<div class="answer_block2">
			<h1 class="quiz_title"><?php echo $tests_info->title;?></h1>
			<?php if($tests_info->test_top == 1) 
			{ 
		
			?> 
				<div class="adsense_top text-center"><?php if($tests_info->default_ads == 2 && $tests_info->test_top_adsense) echo htmlspecialchars_decode($tests_info->test_top_adsense); else if($ads_info->test_top_adsense) echo htmlspecialchars_decode($ads_info->test_top_adsense);?></div> 
		
			<?php
		
			 } 
		
			?>
			<p class="test_description"><?php echo $tests_info->description;?></p>
		</div>
		
		<div id="test_img_container">
			<div class="testimg hidden-xs">
				<?php if(file_exists(FCPATH."/assets/img/image/".$tests_info->image)) { ?><img  src="<?php echo base_url(); ?>assets/img/image/<?php echo $tests_info->image; ?>" /> <?php } ?>
			</div>
			<div class="testimg visible-xs ">
				<?php
					$image_thumb=$this->home_model->get_thumb($tests_info->testid);
					$moble_url=base_url()."assets/img/image/".$image_thumb;
					if(!file_exists(FCPATH."/assets/img/image/".$image_thumb))
					{ 
						 $moble_url=base_url()."assets/img/image/".$tests_info->image;
					} 
				?>
				<img  src="<?php echo $moble_url;?>" /> 
			</div>
			<a class="start_link"  href="<?php echo site_url();?>start/<?php echo $tests_info->alias.".html"; if(isset($ref_page) && $ref_page=='top') echo"?ref_page=top";?>">
			<div class="start_btn"><?php echo $this->lang->line('start_quizz');?></div>
			</a>
		</div>
		<div id="questions_container" style="display:none;">
			<div class="answer_block">
	
	
				<?php 
					if($questions)
					{
						$total_questions=count($questions);
						$i=0;
						foreach($questions as $question)
	
						{
							$i++;
								$class="";
								if($i == $question_num)  $class="current";
							?>
								<div class="question_block btn-group-vertical btn-group btn-group-lg <?php echo $class;?>" >
									<p class="text-center question_nav "><?php echo $this->lang->line('question');?> <?php echo $i;?> <?php echo $this->lang->line('out_of');?> <?php echo ($total_questions);?></p>
									<?php
									if($question->image)
									{
									?>
									<div class="testimg ">
										<?php if(file_exists(FCPATH."/assets/img/image/".$question->image)) { ?><img  src="<?php echo base_url(); ?>assets/img/image/<?php echo $question->image; ?>" /> <?php } ?>
									</div>
									
									<?php
									}
									?>
									<h2 class="text-center question"><?php echo $question->question;?></h2>
									<?php
										$answers=array();
										$answers=$this->home_model->get_answers($question->test_questionid,$question->lang_code);
										//print_r($answers);
										if($answers)
										{
											foreach($answers as $answer)
											{
												?>
													<button question_number="<?php echo $i;?>" question_id="<?php echo $answer->test_question_id;?>" answer_id="<?php echo $answer->answere_id;?>"  marks="<?php echo $answer->marks;?>"  type="submit" class="ans_button col-xs-12"><?php echo $answer->answere;?></button>
													<div style="clear:both;"></div>
	
												<?php
	
											}
	
										}
	
									?>
								</div>
							<?php
						}
					}
				?>
			</div>
		</div>
		<div class="clear_space" style="clear:both;"></div>
		<?php

		if($tests_info->test_middle == 1)
		{
		?>
		<div class="adsense_bottom text-center" >
		<?php if($tests_info->default_ads == 2 && $tests_info->test_middle_adsense) echo htmlspecialchars_decode($tests_info->test_middle_adsense); else if($ads_info->test_middle_adsense) echo htmlspecialchars_decode($ads_info->test_middle_adsense);?>
		</div>
		<?php
		}
		?>
		<div style="clear:both;"></div>
		<div id="fb_comments" >
				<h3 class="text-left"><?php echo $this->lang->line('do_you_think');?></h3>
				<div class="fb-comments"  data-width="100%" data-href="<?php echo site_url();?><?php echo $tests_info->alias.".html";?>" data-numposts="5" data-colorscheme="light"></div>

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
		
		<div class="visible-xs text-center">
			<?php if(($tests_info->sidebar_1) && $ads_info->test_sitebar_1_adsense){ ?><div class="sidebar_adsense"><?php echo htmlspecialchars_decode($ads_info->test_sitebar_1_adsense); ?></div> <?php } ?>
		</div>
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
		
		<?php if($tests_info->result_bottom == 1)
		 { 	
		 ?>	
			 <div class="adsense_bottom text-center"><?php if($tests_info->default_ads == 2 && $tests_info->result_bottom_adsense) echo htmlspecialchars_decode($tests_info->result_bottom_adsense); else if($ads_info->result_bottom_adsense) echo htmlspecialchars_decode($ads_info->result_bottom_adsense);?></div> 
		 <?php  
		 } 
		?>
		
		<div style="clear:both;"></div>
		
	</div>

	
	<div class="col-xs-12 col-sm-4 col-md-4 right_part" style="min-height:500px;">
	
		<?php if(($tests_info->sidebar_1) && $ads_info->test_sitebar_1_adsense){ ?><div class="sidebar_adsense well site_bar_add_bg"><?php echo htmlspecialchars_decode($ads_info->test_sitebar_1_adsense); ?></div> <?php } ?>
		
		
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

	
		
		
		
		<?php /*?><div class="text-center fb_like_box_big"  style="width:300px; margin:auto; float:none;">
			<div class="fb_box">
				<!--<div class="fb_title">Follow us on Facebook</div>-->
				<div class="fb-like-box"  data-width="99%" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
			</div>
		</div><?php */?>
		
		<?php if(($tests_info->sidebar_2) && $ads_info->test_sitebar_2_adsense){ ?><div class="sidebar_adsense well site_bar_add_bg"><?php echo htmlspecialchars_decode($ads_info->test_sitebar_2_adsense); ?></div> <?php } ?>
		<div style="clear:both; height:20px;"></div>
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
			<div style="clear:both;"></div>
	</div>

		<?php
		}
		?>
	<div style="clear:both;"></div>
	</div>


</div>


</div>

</div>

<script language="javascript">

$(function() { 
	//var fb_comments_height=$('.left_part').width();
	//$('.fb-comments').attr('data-width',fb_comments_height);
	
	
	
	/*$(window).resize(function(){
	 $(".fb-comments").attr("data-width", $(".left_part").width());
	 FB.XFBML.parse($(".left_part")[0]);
	});*/
});

</script>



<script language="javascript">
$(function() { 
	var nav_offset=$('.test_description').offset().top;
	nav_offset= nav_offset + $('.test_description').height() + 20;
	
	/*var is_chrome = /chrome/.test( navigator.userAgent.toLowerCase() );
	var OSName="Unknown OS";
	if (navigator.appVersion.indexOf("Win")!=-1) OSName="Windows";
	else if (navigator.appVersion.indexOf("Mac")!=-1) OSName="MacOS";
	else if (navigator.appVersion.indexOf("X11")!=-1) OSName="UNIX";
	else if (navigator.appVersion.indexOf("Linux")!=-1) OSName="Linux";
	
	if((is_chrome) && OSName=="MacOS")
	{
		//nav_offset=nav_offset - 40;
	}*/
	
	$(document).on('click','.start_btn',function(e) {
		e.preventDefault();
		$(window).scrollTop(nav_offset);
		$('#test_img_container').fadeOut();
		$('#questions_container').fadeIn('slow');
	});
	
	
	
	$(document).on('click','.ans_button',function(e) {
		e.preventDefault();
		var cur_question=$(this).parent('.question_block');
		var answer_block_height=$('.answer_block').height();
		var question_number=$(this).attr('question_number');
		if(question_number == <?php echo $total_questions;?>)
		{
			$('.answer_block').css({minHeight:50});
		}
		
		//$('.answer_block').append("<div class='ajax-loader'><img src='<?php echo base_url();?>assets/img/ajax-loader.gif' /></div>");
		
		var question_id=$(this).attr('question_id');
		var answer_id=$(this).attr('answer_id');
		var marks=$(this).attr('marks');
		var question_number=$(this).attr('question_number');
		//alert("<?php echo site_url();?>home/ajax_result/<?php echo $tests_info->alias;?>.html");
		
		
		cur_question.hide();
		cur_question.next().fadeIn('slow');
		$(window).scrollTop(nav_offset);
				
				
				
		$.post("<?php echo site_url();?>home/record_answer",{question_id:question_id, answer_id:answer_id, marks:marks}, function(data) {
			//alert(data);
			if(question_number == <?php echo $total_questions;?>)
			{ 
				var str="<div class='result_loader_img'><img src='<?php echo base_url(); ?>assets/img/result_loader.gif' /><br/> <?php echo $this->lang->line('generating_result');?></div>";
				$('.answer_block').html(str);
				//return false;
				$.post("<?php echo site_url();?>home/ajax_twist_result/<?php echo $tests_info->alias;?>",{}, function(data) {
					//alert(data);
					data=$.parseJSON(data);
					var b="<?php echo site_url();?><?php echo $tests_info->alias;?>.html?r="+data['res_id'];
					window.history.pushState("", "", b);
					//alert(b);
					
					$('.answer_block').html(data['res']);
					
					//alert(data);
				});
				
			}
			else
			{
				
				/*$('.ajax-loader').remove();
				cur_question.next().fadeIn('slow');
				$(window).scrollTop(nav_offset);*/
			}
			
		});
		
		//
		//
	});
});
</script>

<script language="javascript">
	$(document).ready(function () {
		// $(window).scrollTop($('.question_nav').offset().top);
		 var b="<?php echo site_url();?><?php echo $tests_info->alias;?>.html";
		 window.history.pushState("", "", b);
		 
		 $(document).on('click','#check_answer',function(e) {
		 	e.preventDefault();
			$('#visitor_answers').show();
			 $(window).scrollTop($('#visitor_answers').offset().top);
		 });
	});
	
	
	/*jQuery(".fb_share_btn").click(function() {
        var a = screen.width / 2 - 277.5,
            f = screen.height / 2 - 580;
			alert(window.location.href);
        window.open("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent("http://quiztwist.com/how-well-you-know-great-mountains-of-the-world.html"), "", "width=555px, height=550px,left=" + a + ",top=" + f)
    })*/
	
</script>










<script language="javascript">
	<?php /*?> function streamPublish() {

		FB.ui( {

		method: 'feed',

		name: "I got 3 out of 3! Can you beat me?",

		link: "<?php  echo site_url().$tests_info->alias.".html";?>",

		picture: "<?php echo base_url();?>assets/img/test_result_img/<?php echo $result_img;?>",

		caption: "Take this test",

		description: 'This is tesdescription',

		 message: 'TestsToday'

		}, function( response ) {



		} );

	}<?php */?>

	



	function streamPublish(){
		 var a = screen.width / 2 - 277.5,
            f = screen.height / 2 - 580;
			//alert(window.location.href);
        window.open("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href), "", "width=555px, height=550px,left=" + a + ",top=" + f)
	 }

</script>







