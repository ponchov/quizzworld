<link href="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/css/personal.css" rel="stylesheet">
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

<style type="text/css">
	body {
		padding-top:5px !important;
	}
	.answer  {

		white-space:normal;

	}

	.question {

		font-size:30px;

		color:#438EB9;

	}

	.question_block {

		display:none;

		

	}

	.current {

		display:block;

	}

	

	.adsense_top {

		

		min-height:40px;

		margin-bottom:15px;
		
		vertical-align:middle;

	}

	

	.adsense_bottom {

		

		min-height:40px;

		margin-top:15px;

		

	}

	#main_container {

		margin:auto;

		float:none;

	}

	.ans_button

	{

		border-radius:0 !important;

		margin-top: -1px;

		padding: 9px 16px;

		

		font-size: 18px;

	}



	

</style>


<div class="col-sm-12 col-md-12 col-xs-12 view_container">

<div style="background-color:#FFFFFF; margin-bottom:20px; padding-bottom:20px;">

		<?php if($tests_info->question_top == 1) 		{ 
		?> 
			<div class="adsense_top col-xs-12 col-sm-12 col-md-12 text-center"><?php if($tests_info->default_ads == 2 && $tests_info->question_top_adsense) echo htmlspecialchars_decode($tests_info->question_top_adsense); else if($ads_info->question_top_adsense) echo htmlspecialchars_decode($ads_info->question_top_adsense);?></div> 
		
		<?php
		 } 
		?>


	<div id="main_container22" class="col-xs-12 col-sm-7 col-md-8 left_part ">
		
		<div class="well answer_block">
			<h4 class="text-center"><?php echo $tests_info->title;?></h4>
			<?php if($tests_info->is_real_test == 1) 
			{ 
			$i=0;
			$current_question="";
			foreach($questions as $question)
			{
				$i++;
				if($i == $question_num) 
				{
					$current_question=$question;
				}
			}
			?>

				<div class="testimg hidden-xs">
					<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/image/<?php echo $current_question->image; ?>" />
				</div>
				<div class="testimg visible-xs ">
					<?php
						$moble_url=base_url()."assets/img/image/thumb_".$current_question->image;
						if(!file_exists(FCPATH."/assets/img/image/thumb_".$current_question->image))
						{ 
							 $moble_url=base_url()."assets/img/image/".$current_question->image;
						} 
					?>

					<img class="img-responsive" src="<?php echo $moble_url;?>" />
				</div>
			<?php } ?>
			<?php 

				if($questions)
				{
					$total_questions=count($questions);
					$i=0;
					/*echo "<pre>";
					print_r($questions);*/
					foreach($questions as $question)
					{
						$i++;
						if($i == $question_num) 
						{
						?>
							
							<div class="question_block btn-group-vertical btn-group btn-group-lg current">
								<p class="text-center"><?php echo $this->lang->line('question');?> <?php echo $i;?> <?php echo $this->lang->line('out_of');?> <?php echo ($total_questions + 1);?></p>
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
												<form action="<?php echo site_url();?>question/<?php echo $tests_info->alias;?>/<?php echo $question_num + 1;?>.html" method="post" >
													<button question_number="<?php echo $i;?>" question_id="<?php echo $answer->test_question_id;?>" answer_id="<?php echo $answer->answere_id;?>"  marks="<?php echo $answer->marks;?>"  type="submit" class="btn btn-default answer ans_button col-xs-12"><?php echo $answer->answere;?></button>
													<input type="hidden" name="question_id" value="<?php echo $question->test_question_id;?>" />
													<input type="hidden" name="answer_id" value="<?php echo $answer->answere_id;?>" />
													<input type="hidden" name="marks" value="<?php echo $answer->marks;?>" />
													<input type="hidden" name="test_id" value="<?php echo $tests_info->tests_id;?>" />
													<input type="hidden" name="test_alias" value="<?php echo $tests_info->alias;?>" />
													<input type="hidden" name="next_question_num" value="<?php echo $question_num + 1;?>" />
												</form>
												<div style="clear:both;"></div>
											<?php
										}
									}
								?>

							</div>							
						<?php
						}
					}
				}
			?>
		</div>
		<div class="clear_space" style="clear:both;"></div>
		<div style="clear:both;"></div>
		<?php if($tests_info->question_bottom2 == 1)
		 { 	
		 ?>	
			 <div class="adsense_bottom text-center tabola"><?php if($tests_info->default_ads == 2 && $tests_info->question_bottom_adsense2) echo htmlspecialchars_decode($tests_info->question_bottom_adsense2); else if($ads_info->question_bottom_adsense2) echo htmlspecialchars_decode($ads_info->question_bottom_adsense2);?></div> 
		 <?php  
		 } 
		?>
		
		<div style="clear:both;"></div>
		<h2 class="text-center" style="margin-bottom:10px;"><?php echo $this->lang->line('leave_comment');?></h2>
		<div id="fb_comments" >
				<div class="fb-comments"  data-width="100%" data-href="<?php echo site_url();?><?php echo $tests_info->alias.".html";?>" data-numposts="5" data-colorscheme="light"></div>
		</div>
		<div class="clear_space" style="clear:both;"></div>
		
		
		
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
		<?php if($tests_info->question_bottom == 1)
		 { 	
		 ?>	
			 <div class="adsense_bottom text-center tabola"><?php if($tests_info->default_ads == 2 && $tests_info->question_bottom_adsense) echo htmlspecialchars_decode($tests_info->question_bottom_adsense); else if($ads_info->question_bottom_adsense) echo htmlspecialchars_decode($ads_info->question_bottom_adsense);?></div> 
		 <?php  
		 } 
		?>
		
		<div style="clear:both;"></div>
		
		<?php if($tests_info->question_tabo == 1)
		 { 	
		 ?>	
			 <div class="adsense_bottom text-center"><?php if($tests_info->default_ads == 2 && $tests_info->question_tabo_adsense) echo htmlspecialchars_decode($tests_info->question_tabo_adsense); else if($ads_info->question_tabo_adsense) echo htmlspecialchars_decode($ads_info->question_tabo_adsense);?></div> 
		 <?php  
		 } 
		?>
		
		<div style="clear:both;"></div>
	</div>  <?php /*?>left site<?php */?>
	
	<div class="col-xs-12 col-sm-5 col-md-4 right_part" style="min-height:500px;">
		<?php if($tests_info->question_left == 1) { 
		?> 
			<div class="adsense_top text-center well site_bar_add_bg" style="margin-bottom:10px;"><?php if($tests_info->default_ads == 2 && $tests_info->question_sky_left_adsense) echo htmlspecialchars_decode($tests_info->question_sky_left_adsense); else if($ads_info->question_sky_left_adsense) echo htmlspecialchars_decode($ads_info->question_sky_left_adsense);?></div> 
		
		<?php
		 } 
		?>
		
		<div class="right_content" style="margin-bottom:10px;" >
			<?php
							
				
				$purple_test=$this->home_model->get_purple_widget($tests_info->tests_id,$tests_info->lang_code);
				if($purple_test)
				{
				?>
				<div class="well">
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

	
		</div>
		
		
		<?php if($tests_info->question_right == 1) { 
		?> 
			<div class="adsense_top text-center well site_bar_add_bg" style="margin-bottom:10px;"><?php if($tests_info->default_ads == 2 && $tests_info->question_sky_right_adsense) echo htmlspecialchars_decode($tests_info->question_sky_right_adsense); else if($ads_info->question_sky_right_adsense) echo htmlspecialchars_decode($ads_info->question_sky_right_adsense);?></div> 
		
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



