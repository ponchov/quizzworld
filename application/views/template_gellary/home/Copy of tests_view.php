<div id="fb-root"></div>

<script>(function(d, s, id) {

  var js, fjs = d.getElementsByTagName(s)[0];

  if (d.getElementById(id)) return;

  js = d.createElement(s); js.id = id;

  js.src = "//connect.facebook.net/<?php echo $this->fb_localize;?>/all.js#xfbml=1&appId=<?php echo trim($config_info->facebook_appid);?>";

  fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));</script>







<div class="row">

	<?php if($tests_info->test_top == 1) 
	{ 
	?> 
		<div class="adsense_top text-center"><?php if($tests_info->default_ads == 2 && $tests_info->test_top_adsense) echo htmlspecialchars_decode($tests_info->test_top_adsense); else if($ads_info->test_top_adsense) echo htmlspecialchars_decode($ads_info->test_top_adsense);?></div> 
	<?php
	 } 
	?>

	<div class="sky_ad_left">

		<?php 

			if($tests_info->test_left == 1 && $tests_info->default_ads == 2 && $tests_info->test_sky_left_adsense) echo htmlspecialchars_decode($tests_info->test_sky_left_adsense);

			else if($ads_info->test_sky_left_adsense && $tests_info->test_left == 1) echo htmlspecialchars_decode($ads_info->test_sky_left_adsense);

		?>

	</div>

	<div id="main_container" class="col-xs-12 col-sm-10 col-md-8 ">

	<div class="row pre_next_test">

		<div class="text-center col-xs-6 col-sm-6 col-md-6">

		<?php 

			if(isset($ref_page) && $ref_page == 'top')

			{

				 $next_test_url=$this->home_model->get_next_test_url_by_ranking($tests_info->fb_like,$tests_info->testid);

				 $pre_test_url=$this->home_model->get_previous_test_url_by_ranking($tests_info->fb_like,$tests_info->testid);
				//echo $pre_test_url;

			}

			else

			{

				$next_test_url=$this->home_model->get_next_test_url($tests_info->testid,$tests_info->activated_date);

				$pre_test_url=$this->home_model->get_previous_test_url($tests_info->testid,$tests_info->activated_date);
				 //echo $pre_test_url;
			}  

			

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

	<div style="clear:both; height:10px;">&nbsp;</div>

	<div class="well">
		
		<h1 class="text-center"><?php echo $tests_info->title;?></h1>



		<p class="tests_des"><?php echo $tests_info->description;?></p>

		<div class="row text-center">

			<a  href="<?php echo site_url();?>start/<?php echo $tests_info->alias.".html"; if(isset($ref_page) && $ref_page=='top') echo"?ref_page=top";?>" class="btn btn-lg btn-success col-xs-8 col-md-4 col-sm-4 start_btn" style="font-size:30px; float:none;">

				<?php echo $this->lang->line('start_btn');?>

			</a>

		</div>

	</div>

	<div class="row clear_space" style="clear:both;"></div>



	

	<div style="clear:both;"></div>

	

	<?php

		$ads=0;

		if($tests_info->test_middle == 1 && $tests_info->test_middle2 == 1 )

		{

			

			if($tests_info->default_ads == 2 && $tests_info->test_middle_adsense) $ads+=1;

			else if($ads_info->test_middle_adsense) $ads+=1;

			if($tests_info->default_ads == 2 && $tests_info->test_middle_adsense2) $ads+=1;

			else  if($ads_info->test_middle_adsense2) $ads+=1;

		} 

		if($tests_info->test_middle == 1)

		{

		?>

		<div class="adsense_bottom text-center <?php if($ads == 2) echo 'col-xs-12 col-sm-6 col-md-6';?>" >

		<?php if($tests_info->default_ads == 2 && $tests_info->test_middle_adsense) echo htmlspecialchars_decode($tests_info->test_middle_adsense); else if($ads_info->test_middle_adsense) echo htmlspecialchars_decode($ads_info->test_middle_adsense);?>

		</div>

		<?php

		}

		if($tests_info->test_middle2 == 1)

		{

			?>

				<div class="adsense_bottom text-center <?php if($ads == 2) echo 'col-xs-12 col-sm-6 col-md-6';?>" >

					<?php if($tests_info->default_ads == 2 && $tests_info->test_middle_adsense2) echo htmlspecialchars_decode($tests_info->test_middle_adsense2); else if($ads_info->test_middle_adsense2) echo htmlspecialchars_decode($ads_info->test_middle_adsense2);?>

				</div>

			<?php

		}

		?>

	<div style="clear:both;"></div>

	<div class="row description">

		<div class="col-xs-12 col-sm-6 col-md-6">

			<h3 class=""><?php echo $this->lang->line('questions');?></h3>

			<?php echo $this->lang->line('questions_des');?>		

		</div>

		<div class="col-xs-12 col-sm-6 col-md-6">

			<h3 class=""><?php echo $this->lang->line('answer');?></h3>

			<?php echo $this->lang->line('answer_des');?>			

		</div>

	</div>

	

	<div class="row description">

		<div class="col-xs-12 col-sm-6 col-md-6">

			<h3 class=""><?php echo $this->lang->line('fun');?></h3>

			<?php echo $this->lang->line('fun_des');?>				

		</div>

		<div class="col-xs-12 col-sm-6 col-md-6">

			<h3 class=""><?php echo $this->lang->line('enjoy_share');?></h3>

			<?php echo $this->lang->line('enjoy_share_des');?>			

		</div>

	</div>

	

	<?php if($tests_info->test_bottom == 1)

	 { 

	 ?>

		

		 <div class="adsense_bottom text-center"><?php if($tests_info->default_ads == 2 && $tests_info->test_bottom_adsense) echo htmlspecialchars_decode($tests_info->test_bottom_adsense); else if($ads_info->test_bottom_adsense) echo htmlspecialchars_decode($ads_info->test_bottom_adsense);?></div> 

	 <?php  

	 } 

	?>



	<div class="like_box ">

		<div class="fb-like-box"  data-width="270" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true" ></div>

	</div>

	

</div>

<div class="sky_ad_right" >

	<?php 

		if($tests_info->test_right == 1 && $tests_info->default_ads == 2 && $tests_info->test_sky_right_adsense) echo htmlspecialchars_decode($tests_info->test_sky_right_adsense);

		else if($ads_info->test_sky_right_adsense && $tests_info->test_right == 1)  echo htmlspecialchars_decode($ads_info->test_sky_right_adsense);

	?>

</div>

</div>

<style type="text/css">

	.adsense_top {

		

		min-height:40px;

		margin-bottom:15px;
		

		vertical-align:middle;

	}

	

	.adsense_bottom {

		

		min-height:40px;

		margin-top:15px;

		

	}

	.tests_des {

		padding:5px 0;

		font-size:19px;

		line-height: 1.4;

		margin-bottom: 20px;

		text-align:center;

	}

	.like_box {

		margin-top:10px;

		text-align:center;

	}



	#fb_like_share {

		margin:auto;

		float:none;

	}

	.description{

		text-align:center;

	}

	

	h1{

		font-size:45px;

		font-weight:500;

	}

	#main_container {

		margin:auto;

		float:none;

	}



	

	.well{

		padding:36px;

	}

	.start_btn {

		margin:auto;

		float:none;

	}

	

.facebook { overflow: hidden; border: 1px solid #d5d5d5; }

	
	@media (max-width:767px) { 
		h1{
			font-size:30px;
		}
		
		.tests_des {
			font-size:17px;

	
		}
	}

</style>