<div id="fb-root"></div>

 <script>

 	//teststoday id:928641110498954

	//survley id:730590450345834

      window.fbAsyncInit = function() {

        FB.init({

          appId      : '856801527714805',

          xfbml      : true,

          version    : 'v2.0'

        });

      };



      (function(d, s, id){

         var js, fjs = d.getElementsByTagName(s)[0];

         if (d.getElementById(id)) {return;}

         js = d.createElement(s); js.id = id;

         js.src = "//connect.facebook.net/en_US/sdk.js";

         fjs.parentNode.insertBefore(js, fjs);

       }(document, 'script', 'facebook-jssdk'));

    </script>



</div>

<div class="container" style="padding-left:0; padding-right:0;">

<div class="row" style="margin-left:0; margin-right:0;">





	

	<?php if($tests_info->result_top == 1) 

	{ 

	?> 

		<div class="adsense_top  text-center "><?php if($tests_info->default_ads == 2 && $tests_info->result_adsense) echo htmlspecialchars_decode($tests_info->result_adsense); else if($config_info->result_adsense) echo htmlspecialchars_decode($config_info->result_adsense);?></div> 

	<?php

	 } 

	?>

	

	<div class="sky_ad_left">

		<?php 

			if($tests_info->result_left == 1 && $tests_info->default_ads == 2 && $tests_info->result_sky_left_adsense) echo htmlspecialchars_decode($tests_info->result_sky_left_adsense);

			else if($config_info->result_sky_left_adsense && $tests_info->result_left == 1) echo htmlspecialchars_decode($config_info->result_sky_left_adsense);

		?>

	</div>
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
	<div id="main_container" class="col-xs-12 col-sm-10 col-md-8 ">

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
			

				
			<div class="p402_hide">
				<div style="clear:both;"></div>
	
				<center>
	  
				<div style="padding-left: 5px; padding-top: 1px; margin:10px auto;">
	
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
			
			<?php

			$ads=0;

			if($tests_info->result_middle == 1 && $tests_info->result_middle2 == 1 )

			{

				

				if($tests_info->default_ads == 2 && $tests_info->result_middle_adsense) $ads+=1;

				else if($config_info->result_middle_adsense) $ads+=1;

				if($tests_info->default_ads == 2 && $tests_info->result_middle_adsense2) $ads+=1;

				else  if($config_info->result_middle_adsense2) $ads+=1;

			} 

			if($tests_info->result_middle == 1)

			{

			?>

			<div class="adsense_bottom text-center <?php if($ads == 2) echo 'col-xs-12 col-sm-6 col-md-6';?>" >

			<?php if($tests_info->default_ads == 2 && $tests_info->result_middle_adsense) echo htmlspecialchars_decode($tests_info->result_middle_adsense); else if($config_info->result_middle_adsense) echo htmlspecialchars_decode($config_info->result_middle_adsense);?>

			</div>

			<?php

			}

			if($tests_info->result_middle2 == 1)

			{

				?>

					<div class="adsense_bottom text-center <?php if($ads == 2) echo 'col-xs-12 col-sm-6 col-md-6';?>" >

						<?php if($tests_info->default_ads == 2 && $tests_info->result_middle_adsense2) echo htmlspecialchars_decode($tests_info->result_middle_adsense2); else if($config_info->result_middle_adsense2) echo htmlspecialchars_decode($config_info->result_middle_adsense2);?>

					</div>

				<?php

			}

			?>

			

			<div class="clear_space_result" style="clear:both;"></div>

			

			

		</div> <!--end well-->
	
		

		<div class="" style="text-align:center; margin-bottom:15px;">

				<?php

						$new_result=str_replace("<RESULT>",'',trim($tests_info->result_text));

						//echo $new_result=str_replace("<PRE_RESULT>",'',$new_result);

				?>

				<h2 class="text-center" style="margin-bottom:10px;"><?php echo $this->lang->line('leave_comment');?></h2>

		</div>

		<!--fb_comments-->

		<div id="fb_comments" class="text-center">

			<div class="fb-comments"  data-width="620" data-href="<?php echo site_url();?><?php echo $tests_info->alias.".html";?>" data-numposts="5" data-colorscheme="light"></div>

		</div>

		<!--end fb_comments-->

		<div style="clear:both;"></div>

		

		<?php if($tests_info->result_bottom == 1)

		 { 

		 ?>

			 <div class="adsense_bottom text-center"><?php if($tests_info->default_ads == 2 && $tests_info->result_bottom_adsense) echo htmlspecialchars_decode($tests_info->result_bottom_adsense); else if($config_info->result_bottom_adsense) echo htmlspecialchars_decode($config_info->result_bottom_adsense);?></div> 

		 <?php  

		 } 

		?> 

		<div class="pre_next_test">

			<div class="text-center col-xs-6 col-sm-6 col-md-6">

			

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

		<div style="clear:both; height:15px;"></div>

		<div class="like_box ">

			<div class="fb-like-box hidden-xs hidden-sm"   data-width="420" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>

			<div class="fb-like-box visible-xs visible-sm"   data-width="220" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>

		</div>

	</div>

	

	<div class="sky_ad_right" >

	<?php 

		if($tests_info->result_right == 1 && $tests_info->default_ads == 2 && $tests_info->result_sky_right_adsense) echo htmlspecialchars_decode($tests_info->result_sky_right_adsense);

		else if($config_info->result_sky_right_adsense && $tests_info->result_right == 1)  echo htmlspecialchars_decode($config_info->result_sky_right_adsense);

	?>

</div>

</div>

</div>

<script language="javascript">

$(function() {

	

	var fb_comments_height=$('.well').width();

	$('.fb-comments').attr('data-width',fb_comments_height);

	

});

</script>





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

	}

	@media only screen and (max-width: 400px) {
		.pre_next_test
		{
			padding:0 10px;
		}
	}


	

	

</style>









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

		$(function() {



			  

	 //$('#my_Modal').modal('show');

		 setTimeout(function() {

			  //Show pop-up after 10 seconds

			  

				  $('#my_Modal').modal('show');

			},29000);



		  var visit_numbers=checkCount();

		$('#my_Modal').on('hide.bs.modal', function (e) {

		  if(visit_numbers < 4)

			{

		 	 $('#my_Modal2').modal('show');

		    }

		})



		

		});

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

		var share_capt     =    'Havefundaily.com';

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



