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
	</style>


		

		<div style="clear:both; height:10px;">&nbsp;</div>
		
			
			<div class="text-center  result_container">

				<?php

					$final_score=($this->session->userdata('test_result')) + ($tests_info->start_point);

					//echo $final_score;

					//$total_question=count($questions);
					$final_score=($this->session->userdata('test_result')) + ($tests_info->start_point);
					//$result=$final_score;	
					$resut_des="";	
					$result_img="";	
					$grad="";
					$result='';
					if($result_options)
					{
						foreach($result_options as $result_option)
						{
							if($final_score >= $result_option->interval_from && $final_score <= $result_option->interval_to)
							{
								$result=$result_option->result;
								$resut_des=$result_option->result_description;
								$result_img=$result_option->test_result_img;
							}
	
						}
	
					}
					
					if($final_score <= 2)
					{
						$grad="C+";
					}
					elseif($final_score <= 5)
					{
						$grad="B+";
					}
					elseif($final_score >= 6)
					{
						$grad="A+";
					}

				?>
			<div class="result_nav"><?php echo $grad; ?>, <?php echo $result; ?></div>
			<div style="min-height:110px;">
				<div class="result_image"><img src="<?php echo base_url(); ?>assets/img/test_result_img/<?php echo $result_img; ?>"  alt=""/> </div>
			</div>
			<div class="result" style="position:relative;">
				<div class="twist_test_score"><?php echo $final_score;?></div>
				<span class="real_test_score_right"><?php echo $this->lang->line('right');?></span>
			</div>	
			
			<div class="result_description"><?php echo $resut_des; ?></div>
			
			
			<div class="qc-fb-share " onClick="streamPublish()" >
				<img src="<?php echo base_url();?>assets/img/fb-logo.png">
				 <?php echo $this->lang->line('share_on_fb');?>
			</div>
			<div  style="clear:both; height:15px;"></div>
			<div class="row">
				<div class=" col-sm-6 col-xs-12" id="check_answer">
					<div class="qc-quiz-check-answers"><a href="" ><?php echo $this->lang->line('check_answer');?></a></div>
				</div>
				<div class="col-sm-6 col-xs-12">
					<div class="qc-quiz-again"><a  href="<?php echo site_url();?><?php echo $tests_info->alias;?>.html"><?php echo $this->lang->line('play_again');?></a></div>
				</div>
			</div>
			
			
			<?php
				$question_answers=$this->session->userdata('question_answers');
				$correct_ans_ids=array();
				foreach($question_answers as $qns)
				{
					$correct_ans_ids[]=$qns->answer_id;
					
				}
				/*echo "<pre>";
				print_r($correct_ans_ids);
				echo "</pre>";*/
				
			?>
			<div style="clear:both; height:10px;"></div>
			<div class="answer_block " id="visitor_answers" style="display:none;">
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
						//if($i == $question_num) 
						//{
							$class="current";
							
						?>
							<div class="question_block btn-group-vertical btn-group btn-group-lg <?php echo $class;?>" >
								<p class="text-center question_nav" style="width:35px; background:#FFC200; padding:2px 0px; margin-top:15px;"><?php echo $i;?></p>
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
											$correct="";
											if($answer->marks == 1) $correct="correct_ans";
											$wrong="";
											if(in_array($answer->answere_id,$correct_ans_ids) && $answer->marks != 1) $wrong="wrong_ans";
											?>

												

													<button  type="button" class="ans_options col-xs-12 <?php echo $correct;?> <?php echo $wrong;?>"><?php echo $answer->answere;?></button>
													<div style="clear:both;"></div>

											<?php

										}

									}

								?>
							</div>
							
						<?php

						//}

					}

				}

			?>

			

		</div>
		</div>
			
			
			<div class="clear_space_result" style="clear:both;"></div>
		


<style type="text/css">

	

	
	.tests_des {

		padding:15px 0;

		font-size:18px;

	}

	#message {

		margin:auto;

		float:none;

		font-size:11px;

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
	
	#fb_share_button .fb_button {
		background: url("<?php echo base_url();?>assets/img/facebook-icon.png") no-repeat scroll 12px center #3B5998;
	
		color: #FFFFFF;
		margin-right: 10px;
		padding: 0px 40px;
		font-size:30px;
		font-weight:bold;

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









<?php /*?><div id="my_Modal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">	
			<div class="modal-header" style="border:none; padding-top:2px">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
			</div>
			<div class="modal-body text-center" style="padding-top:0px;">
					<div class="qc-popup-title"><?php echo $this->lang->line('you_got');?></div>
					<div class="qc-popup-title"><?php echo $grad; ?>, <?php echo $result; ?></div>
					<p class="qc-popup-text"><?php echo $this->lang->line('challeng_your_friends');?></p>
					<div class="qc-fb-share " onClick="streamPublish()" style="width:90%;">
						<img src="<?php echo base_url();?>assets/img/fb-logo.png">
						<?php echo $this->lang->line('share_on_fb');?>
					</div>
					<div style="clear:both;"></div>

			</div>

		</div><!-- /.modal-content -->

	</div><!-- /.modal-dialog -->

</div><?php */?>













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
		$(function() {
	 //$('#my_Modal').modal('show');

		 setTimeout(function() {
			  //Show pop-up after 10 seconds
				 $('#my_Modal').modal('show');
			},0);
		  var visit_numbers=checkCount();

		$('#my_Modal').on('hide.bs.modal', function (e) {
		  //if(visit_numbers < 4)
			//{
		 	 $('#my_Modal2').modal('show');
		   // }
		})

		});

</script>

