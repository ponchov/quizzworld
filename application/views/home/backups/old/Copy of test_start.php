<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo trim($config_info->facebook_appid);?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="row">
	<div id="main_container" class="col-xs-12 col-sm-10 col-md-8 ">
		<?php if($tests_info->add_sense_top) { ?><div class="adsense_top text-center"><?php echo htmlspecialchars_decode($tests_info->add_sense_top);?></div> <?php } ?>
		<div class="well answer_block">
			<h4 class="text-center"><?php echo $tests_info->title;?></h4>
			<?php 
				if($questions)
				{
					$total_questions=count($questions);
					$i=0;
					foreach($questions as $question)
					{
						$i++;
						$class="";
						if($i == 1) $class="current";
						?>
							<div class="question_block btn-group-vertical btn-group btn-group-lg <?php echo $class;?>">
								<p class="text-center">Question <?php echo $i;?> out of <?php echo $total_questions;?></p>
								<h2 class="text-center question"><?php echo $question->question;?></h2>
								<?php
									$answers=array();
									$answers=$this->home_model->get_answers($question->test_question_id);
									if($answers)
									{
										foreach($answers as $answer)
										{
											?>
												<button question_number="<?php echo $i;?>" question_id="<?php echo $answer->test_question_id;?>" answer_id="<?php echo $answer->answere_id;?>"  marks="<?php echo $answer->marks;?>"  type="button" class="btn btn-default answer col-xs-12"><?php echo $answer->answere;?></button>
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
		<div class="text-center">
			<div class="fb-like  hidden-xs hidden-sm"  data-width="420" data-href="<?php echo site_url();?><?php echo $tests_info->alias.".html";?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
			<div class="fb-like  visible-xs visible-sm" data-width="270" data-href="<?php echo site_url();?><?php echo $tests_info->alias.".html";?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
		</div>
		<?php if($tests_info->add_sense_bottom) { ?><div class="adsense_bottom text-center"><?php echo htmlspecialchars_decode($tests_info->add_sense_bottom);?></div> <?php } ?>
	</div>
</div>
<?php if($tests_info->google_analytics) echo htmlspecialchars_decode($tests_info->google_analytics);?>

<style type="text/css">
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

	
</style>
<script language="javascript">
$(function() {
	$(document).on('click','.answer',function(e) {
		e.preventDefault();
		var cur_question=$(this).parent('.question_block');
		var answer_block_height=$('.answer_block').height();
		$('.answer_block').css({minHeight:answer_block_height+20});
		cur_question.hide();
		
		var question_id=$(this).attr('question_id');
		var answer_id=$(this).attr('answer_id');
		var marks=$(this).attr('marks');
		var question_number=$(this).attr('question_number');
		
		$.post("<?php echo site_url();?>home/record_answer",{question_id:question_id, answer_id:answer_id, marks:marks}, function(data) {
			//alert(data);
			if(question_number == <?php echo $total_questions;?>)
			{
				window.location="<?php echo site_url();?>result/<?php echo $tests_info->alias;?>.html";
			}
			else
			{
				cur_question.next().fadeIn('slow');
			}
			
		});
		
		//
		//
	});
});
</script>