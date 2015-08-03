<link href="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/css/personal.css" rel="stylesheet">
<div id="fb-root"></div>

 <script>

 	//teststoday id:928641110498954

	//survley id:730590450345834

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




<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-49278576-1', 'auto');
  ga('send', 'pageview');

</script>

<style type="text/css">
	.res_container {
		padding-top:15px;
	}
	
	.res_container h2 {
		padding-bottom:15px;
	}
	.btn-primary {
		background-color:#5492ff;
	}
	.score_title {
		font-size:26px;
		font-weight:bold;
	}
	.final_resutl {
		font-size:18px;
	}
	.wrong_anwser {
		padding:10px 0px;
	}
</style>
	
<div class="col-sm-12 col-md-12 col-xs-12 view_container">

	<div style="background-color:#FFFFFF; margin-bottom:20px; padding-bottom:20px;">

		<?php if($tests_info->test_top == 1) 		{ 
		?> 
			<div class="col-sm-12 col-md-12 col-xs-12">
				<div class="adsense_top col-xs-12 col-sm-12 col-md-12  text-center"><?php if($tests_info->default_ads == 2 && $tests_info->test_top_adsense) echo htmlspecialchars_decode($tests_info->test_top_adsense); else if($ads_info->test_top_adsense) echo htmlspecialchars_decode($ads_info->test_top_adsense);?></div> 
			</div>
		<?php
		 } 
		?>

	<div id="main_container22" class="col-xs-12 col-sm-7 col-md-8 left_part ">
		
		<div class=" pre_next_test p402_hide">
			<div class="text-center col-xs-6 col-sm-6 col-md-6">			
			<?php 
				if(isset($ref_page) && $ref_page == 'top')
				{
					 $next_test_url=$this->home_model->get_next_test_url_by_ranking($tests_info->fb_like,$tests_info->tests_id);
					 $pre_test_url=$this->home_model->get_previous_test_url_by_ranking($tests_info->fb_like,$tests_info->tests_id);
				}
				else
				{
					$next_test_url=$this->home_model->get_next_test_url($tests_info->tests_id,$tests_info->activated_date);
					$pre_test_url=$this->home_model->get_previous_test_url($tests_info->tests_id,$tests_info->activated_date);
				}  

			?>

			<?php if($pre_test_url) { ?>
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

		<div style="clear:both; height:10px;">&nbsp;</div>		
		<div class="well"  style="background-color:#FFFFFF; border:none; box-shadow:0;">
			
			<div class="text-center col-xs-12 col-sm-12 col-md-12">
				<?php

					$final_score=($this->session->userdata('test_result')) + ($tests_info->start_point);

					//echo $final_score;

					$total_question=count($questions);

					$obtain_score_persentage=number_format((($final_score * 100)/$total_question),2);

					$result="";

					//$home_url="<a href='".site_url()."' style='font-weight:bold;'>HERE</a>";

					$home_url="<a href='".site_url()."' style='font-weight:bold;'>'".$this->lang->line('here')."'</a>";

					if($obtain_score_persentage >= 100 ) $result=$this->lang->line('fantastic_try_again').$home_url;

					else if($obtain_score_persentage >= 61 ) $result=$this->lang->line('vary_good_try_again');

					else if($obtain_score_persentage >= 31 ) $result=$this->lang->line('good_try_again');

					else $result=$this->lang->line('should_try_again');

				?>

				
				
				<div class="p402_premium">
				<div class="score_title p402_hide"><?php echo $this->lang->line('your_scored');?></div>
				<div class='p402_hide'>
					<?php if($this->session->userdata('lang_code') == 'bn') { ?>
	
						<div class="final_resutl"><?php echo $total_question." ".$this->lang->line('out_of')." " .$final_score; ?></div>
	
					<?php } else { ?>
	
						<div class="final_resutl"><?php echo $final_score." ".$this->lang->line('out_of')." " .$total_question; ?></div>
	
					<?php } ?>
	
					
	
					
	
					<div class="well_just">
	
					<?php echo $result;?>
	
					</div>				
				</div>
			

			<div style="clear:both; height:15px;"></div>
			<div class="p402_hide">
				<div style="clear:both;"></div>	
				<center>	  
				<div style="padding-left: 5px; padding-top: 1px; margin:auto;  margin-bottom: 10px">	
					<span onclick="streamPublish()" class="fb_button" style="cursor:pointer;" ><i class="fa fa-facebook" ></i><?php echo $this->lang->line('share_facebook');?> </span>
				</div>
	
				</center>	
				<div style="clear:both;"></div>	
				<div class="wrong_anwser">	
					<?php 
	
						//print_r($tests_info);
	
						$question_answers=$this->session->userdata('question_answers');	
						if($question_answers)	
						{
	
							$i=0;
	
							$wrong_answer='';
	
							foreach($question_answers as $question_answer)
	
							{
	
								$i++;
	
								if($question_answer->marks == 0)
	
								{
	
									$wrong_answer.=$i.", ";
	
								}
	
								
	
							}
	
							
	
						}
	
						$wrong_answer=rtrim($wrong_answer,', ');
	
					?>
	
					<?php 
	
					
	
					if($wrong_answer) echo $this->lang->line('wrong_answer').$wrong_answer.".";
	
					else echo $this->lang->line('all_right_answer');
	
					?>
	
	
	
					
	
				</div>
	
				
	
				<div class="" style="text-align:center; margin-bottom:22px;">	
					<a class="btn btn-success again_btn" href="<?php echo site_url(); ?><?php echo $tests_info->alias.".html"; ?>"><?php echo $this->lang->line('try_again');?></a>
	
				</div>

			</div>
			</div> 
				<script type="text/javascript"> 
				  try { _402_Show(); } catch(e) {} 
				</script> 
			
		</div>
			<div class="clear_space_result" style="clear:both;"></div>
		</div> <!--end well-->
		<div class="" style="text-align:center; margin-bottom:15px;">

				<?php

						$new_result=str_replace("<RESULT>",'',trim($tests_info->result_text));

						//echo $new_result=str_replace("<PRE_RESULT>",'',$new_result);

				?>

				<h2 class="text-center" style="margin-bottom:10px;"><?php echo $this->lang->line('leave_comment');?></h2>

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
		
		<?php if($tests_info->question_bottom == 1)
		 { 	
		 ?>	
			 <div class="adsense_bottom text-center"><?php if($tests_info->default_ads == 2 && $tests_info->question_bottom_adsense) echo htmlspecialchars_decode($tests_info->question_bottom_adsense); else if($ads_info->question_bottom_adsense) echo htmlspecialchars_decode($ads_info->question_bottom_adsense);?></div> 
		 <?php  
		 } 
		?>
		
		<div style="clear:both;"></div>
	</div>
	
	<div class="col-xs-12 col-sm-5 col-md-4 right_part" style="min-height:500px;">
		<?php if($tests_info->sidebar_1 == 1) { 
		?> 
			<div class="adsense_top text-center well site_bar_add_bg" style="margin-bottom:10px;"><?php if($tests_info->default_ads == 2 && $tests_info->test_sky_left_adsense) echo htmlspecialchars_decode($tests_info->test_sky_left_adsense); else if($ads_info->test_sitebar_1_adsense) echo htmlspecialchars_decode($ads_info->test_sitebar_1_adsense);?></div> 
		
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

	
		

		
		
		<?php if($tests_info->sidebar_2 == 1) { 
		?> 
			<div class="adsense_top text-center well site_bar_add_bg" style="margin-bottom:10px;"><?php if($tests_info->default_ads == 2 && $tests_info->test_sky_right_adsense) echo htmlspecialchars_decode($tests_info->test_sky_right_adsense); else if($ads_info->test_sitebar_2_adsense) echo htmlspecialchars_decode($ads_info->test_sitebar_2_adsense);?></div> 
		
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

<style type="text/css">

	

	.adsense_top {

		min-height:40px;

		margin-bottom:15px;

		vertical-align:middle;
		

	}

	

	.adsense_bottom {

		

		/*min-height:40px;

		margin-top:15px;*/

		vertical-align:middle;

		

	}

	.tests_des {

		padding:15px 0;

		font-size:18px;

	}

	.like_box {

		margin-top:10px;

		text-align:center;

	}

	#main_container {

		margin:auto;

		float:none;

	}

	#message {

		margin:auto;

		float:none;

		font-size:11px;

	}

	#fb_like_share {

		margin:auto;

		float:none;

		padding-top:15px;

		margin-bottom:15px;

	}

	

	

	h1{

		font-size:63px;

		font-weight:500;

	}

	

	h2{

		font-size:30px;

	}

	

	#fb_comments {

		/*text-align:center;*/

	}

	#fb_like_share {

		text-align:center;

	}

	

	.result_des {

		/*width:320px;*/

		margin:auto;

	}

	.fb_button {

    background: url("<?php echo base_url();?>assets/img/facebook-icon.png") no-repeat scroll 12px center #3B5998;

    color: #FFFFFF;

    margin-right: 10px;

    padding: 10px 40px;

	}

	a.fb_button:hover {

		color:#FFFFFF;

		text-decoration:none;

	}

	

	

	h1.page_title a {

		font-size:36px;

	}

	

	h1, h2 {

		margin:0;

	}

	.result_img {

		float:left;

		margin-right:10px;

	}

	

	.pre_description {

		

	}

	@media only screen and (max-width:560px) {

		.result_img img

		{

			/*width:88px;*/

		}

		

		.result_img {

			float:none;

			margin:auto;

		}

		

		#main_container {

			padding:0 !important;

		}

		.pre_next_test {

			padding:0 15px;

		}

		.well {

			padding-left:0px !important;

			padding-right:0px !important;

		}
		
		h1{

			font-size:42px;
	
		}
	
		
	
		h2{
	
			font-size:30px;
	
		}

	}

	

	@media only screen and (max-width:340px) {



		.pre_next_test {

			padding:0;

		}
		
		h1{

			font-size:40px;
	
		}
	
		
	
		h2{
	
			font-size:28px;
	
		}



	}

	

	

</style>

<script language="javascript">

$(function() {
	var fb_comments_height=$('.well').width();
	$('.fb-comments').attr('data-width',fb_comments_height);
});

</script>















<div id="my_Modal" class="modal fade" tabindex="-1">

	<div class="modal-dialog">

		<div class="modal-content">	

			<div class="modal-header" style="border:none; margin-bottom:15px;">

				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>

				<?php /*?><h4 id="myModalLabel" class="modal-title text-center">Share on Facebook</h4><?php */?>

			</div>

			

			<div class="modal-body  text-center">

					<?php //echo $tests_info->popup_box_text;?>

					<h2><?php echo $this->lang->line('congrats_facebook');?></h2>

					<h1 style="font-size:36px; font-weight:bold; margin:45px 0;"><?php echo $this->lang->line('share_facebook_see_friend');?></h1>

					<div style="padding-left: 5px; padding-top: 20px; margin:auto;  margin-bottom: 20px">

						<button  class="button  fb_button"style="width: 185px" onClick="streamPublish()"> <i class="fa fa-facebook" ></i><?php echo $this->lang->line('share_facebook');?></button>

					</div>

			</div>

		</div><!-- /.modal-content -->

	</div><!-- /.modal-dialog -->

</div>





<div id="my_Modal2" class="modal fade" tabindex="-1">

	<div class="modal-dialog">

		<div class="modal-content">	

			<div class="modal-header   text-center">

				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>

				<h4 id="myModalLabel" class="modal-title"><?php echo $this->lang->line('facebook_page');?></h4>

			</div>

			<div class="modal-body   text-center">					  

					<?php echo $this->lang->line('like_our_page');?>

					<div class="fb-like-box hidden-xs hidden-sm"  data-width="420" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>

					<div class="fb-like-box visible-xs visible-sm"  data-width="220" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>

			</div>

		</div><!-- /.modal-content -->

	</div><!-- /.modal-dialog -->

</div>









<script language="javascript">

var expDays = 365; // number of days the cookie should last



//var page = "only-popup-once.html";

//var windowprops = "width=300,height=200,location=no,toolbar=no,menubar=no,scrollbars=no,resizable=yes";



function GetCookie (name) {

  var arg = name + "=";

  var alen = arg.length;

  var clen = document.cookie.length;

  var i = 0;

  while (i < clen) {

    var j = i + alen;

    if (document.cookie.substring(i, j) == arg)

    return getCookieVal (j);

    i = document.cookie.indexOf(" ", i) + 1;

    if (i == 0) break;

  }

  return null;

}



function SetCookie (name, value) {

  var argv = SetCookie.arguments;

  var argc = SetCookie.arguments.length;

  var expires = (argc > 2) ? argv[2] : null;

  var path = (argc > 3) ? argv[3] : null;

  var domain = (argc > 4) ? argv[4] : null;

  var secure = (argc > 5) ? argv[5] : false;

  document.cookie = name + "=" + escape (value) +

    ((expires == null) ? "" : ("; expires=" + expires.toGMTString())) +

    ((path == null) ? "" : ("; path=" + path)) +

    ((domain == null) ? "" : ("; domain=" + domain)) +

    ((secure == true) ? "; secure" : "");

}



function DeleteCookie (name) {

  var exp = new Date();

  exp.setTime (exp.getTime() - 1);

  var cval = GetCookie (name);

  document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();

}



var exp = new Date();

exp.setTime(exp.getTime() + (expDays*24*60*60*1000));



function amt(){

  var count = GetCookie('count')

  if(count == null) {

    SetCookie('count','1')

    return 1

  } else {

    var newcount = parseInt(count) + 1;

    DeleteCookie('count')

    SetCookie('count',newcount,exp)

    return count

  }

}



function getCookieVal(offset) {

  var endstr = document.cookie.indexOf (";", offset);

  if (endstr == -1)

  endstr = document.cookie.length;

  return unescape(document.cookie.substring(offset, endstr));

}



function checkCount() {

  var count = GetCookie('count');

  if (count == null) {

    count=1;

    SetCookie('count', count, exp);

   // window.open(page, "", windowprops);

   

  } else {

    count++;

    SetCookie('count', count, exp);

  }

  return count;

}



//window.onload=checkCount;



</script>







<script language="javascript">
		/*$(function() {
		 setTimeout(function() {
				  $('#my_Modal').modal('show');
			},29000);
		  var visit_numbers=checkCount();

		$('#my_Modal').on('hide.bs.modal', function (e) {
		  if(visit_numbers < 4)
			{
		 	 $('#my_Modal2').modal('show');
		    }
		})

		});*/

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

	

	

	function streamPublish(){ //alert('asdfsad');

		//$('#myModal').modal('hide');

		var product_name   = 	'I Scored <?php echo $final_score." Out Of ".$total_question; ?>! Can You Beat Me? Take This Quiz!';

		var description	   =	'<?php  echo str_replace(array("\r", "\n", "'",'"',",","?",":",";"), "", $tests_info->description) ?>';

		var share_image	   =	'<?php echo base_url();?>assets/img/image/<?php echo $tests_info->image;?>';

		var share_url	   =	'<?php  echo site_url().$tests_info->alias.".html";?>';	

		var share_capt     =    'Survley.com';

		FB.ui({

			method: 'feed',

			name: product_name,

			link: share_url,

			picture: share_image,

			caption: share_capt,

			description: description,

			 message: 'Survley.com'

	

		}, function(response) {

			if(response && response.post_id){}

			else{}

		});

	

	

	

	 }

</script>



