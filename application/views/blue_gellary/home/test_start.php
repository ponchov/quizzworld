<div id="fb-root"></div>

<script>(function(d, s, id) {

  var js, fjs = d.getElementsByTagName(s)[0];

  if (d.getElementById(id)) return;

  js = d.createElement(s); js.id = id;

  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo trim($config_info->facebook_appid);?>";

  fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));</script>


<style type="text/css">

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

<div class="row">

	

	<?php 
	if($question_num != 3)
	{
		if($tests_info->question_top == 1) 
	
		{ 
	
		?> 
	
			<div class="adsense_top text-center p402_hide"><?php if($tests_info->default_ads == 2 && $tests_info->question_top_adsense) echo htmlspecialchars_decode($tests_info->question_top_adsense); else if($config_info->question_top_adsense) echo htmlspecialchars_decode($config_info->question_top_adsense);?></div> 
	
		<?php
	
		 }
	
		 else if($tests_info->question_top2 == 1)
	
		 {
	
			?>
	
			<div class="adsense_top text-center p402_hide"><?php if($tests_info->default_ads == 2 && $tests_info->question_top_adsense2) echo htmlspecialchars_decode($tests_info->question_top_adsense2); else if($config_info->question_top_adsense2) echo htmlspecialchars_decode($config_info->question_top_adsense2);?></div>
	
			<?php
	
		 }
	 } 

	?>

	

	

	<div class="sky_ad_left">

		<?php 
			if($question_num == 3)
			{
				if($tests_info->question_left == 1 && $tests_info->default_ads == 2 && $tests_info->question_sky_left_adsense) echo htmlspecialchars_decode($tests_info->question_sky_left_adsense);
	
				else if($config_info->question_sky_left_adsense && $tests_info->question_left == 1) echo htmlspecialchars_decode($config_info->question_sky_left_adsense);
			}
		?>

	</div>

	<div id="main_container" class="col-xs-12 col-sm-10 col-md-8 ">

		

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
							<?php if($question_num == 3) { ?><div class="p402_premium"><?php } ?>
							<div class="question_block btn-group-vertical btn-group btn-group-lg current">

								<p class="text-center"><?php echo $this->lang->line('question');?> <?php echo $i;?> <?php echo $this->lang->line('out_of');?> <?php echo ($total_questions + 1);?></p>

								<h2 class="text-center question"><?php echo $question->question;?></h2>

								<?php

									$answers=array();

									$answers=$this->home_model->get_answers($question->test_questionid);

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
							<?php if($question_num == 3) { ?>
							</div>
							<script type="text/javascript"> 
							  try { _402_Show(); } catch(e) {} 
							</script>
							<?php
							}
							?>
						<?php

						}

					}

				}

			?>

			

		</div>

		<div class="clear_space" style="clear:both;"></div>



		<div class="clear_space_start" style="clear:both;"></div>

		

		

		

		

		<?php
		if($question_num != 3)
		{
			$ads=0;
	
			if($tests_info->question_bottom == 1 && $tests_info->question_bottom2 == 1 )
	
			{
	
				
	
				if($tests_info->default_ads == 2 && $tests_info->question_bottom_adsense) $ads+=1;
	
				else if($config_info->question_bottom_adsense) $ads+=1;
	
				if($tests_info->default_ads == 2 && $tests_info->question_bottom_adsense2) $ads+=1;
	
				else  if($config_info->question_bottom_adsense2) $ads+=1;
	
			} 
	
			if($tests_info->question_bottom == 1)
	
			{
	
			?>
	
			<div class="adsense_bottom text-center p402_hide <?php if($ads == 2) echo 'col-xs-12 col-sm-6 col-md-6';?>" >
	
			<?php if($tests_info->default_ads == 2 && $tests_info->question_bottom_adsense) echo htmlspecialchars_decode($tests_info->question_bottom_adsense); else if($config_info->question_bottom_adsense) echo htmlspecialchars_decode($config_info->question_bottom_adsense);?>
	
			</div>
	
			<?php
	
			}
	
			if($tests_info->question_bottom2 == 1)
	
			{
	
				?>
	
					<div class="adsense_bottom text-center p402_hide <?php if($ads == 2) echo 'col-xs-12 col-sm-6 col-md-6';?>" >
	
						<?php if($tests_info->default_ads == 2 && $tests_info->question_bottom_adsense2) echo htmlspecialchars_decode($tests_info->question_bottom_adsense2); else if($config_info->question_bottom_adsense2) echo htmlspecialchars_decode($config_info->question_bottom_adsense2);?>
	
					</div>
	
				<?php
	
			}
		}
		?>

	</div>

	

	<div class="sky_ad_right" >

	<?php 
		if($question_num == 3)
		{
			if($tests_info->question_right == 1 && $tests_info->default_ads == 2 && $tests_info->question_sky_right_adsense) echo htmlspecialchars_decode($tests_info->question_sky_right_adsense);
	
			else if($config_info->question_sky_right_adsense && $tests_info->question_right == 1)  echo htmlspecialchars_decode($config_info->question_sky_right_adsense);
		}
	?>

	</div>
	

</div>



