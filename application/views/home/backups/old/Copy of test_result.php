<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo trim($config_info->facebook_appid);?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


</div>

<div class="container">

<div class="row">
	<div id="main_container" class="col-xs-12 col-sm-10 col-md-8 ">
		<?php if($config_info->result_adsense) { ?><div class="adsense_top text-center"><?php echo htmlspecialchars_decode($config_info->result_adsense);?></div> <?php } ?>
		<div class="row pre_next_test">
			<div class="text-center col-xs-6 col-sm-6 col-md-6">
			<?php
				$next_test_url=$this->home_model->get_next_test_url($tests_info->tests_id); 
				$pre_test_url=$this->home_model->get_previous_test_url($tests_info->tests_id);
			?>
			<?php if($pre_test_url) { ?><a href="<?php echo $pre_test_url; ?>" class="btn btn-primary col-xs-12 col-md-12 col-sm-12">Previous Test</a><?php } else { ?>
			<a href="" class="btn btn-primary col-xs-12 col-md-12 col-sm-12 disabled">Previous Test</a>
			<?php } ?>
			</div>
			
			<div class="text-center col-xs-6 col-sm-6 col-md-6">
			<?php if($next_test_url) { ?><a href="<?php echo $next_test_url;  ?>" class="btn btn-primary col-xs-12 col-md-12 col-sm-12">Next Test</a><?php } else { ?>
				<a href="" class="btn btn-primary col-xs-12 col-md-12 col-sm-12 disabled">Next Test</a>
			<?php } ?>
			</div>
		</div>
		<div style="clear:both; height:10px;">&nbsp;</div>
		<div class="well">
			
			<div class="text-center col-xs-12 col-sm-12 col-md-12">
			<?php
				$final_score=($this->session->userdata('test_result')) + ($tests_info->start_point);
				$result=$final_score;
				$resut_des="";
				$result_img="";
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
				if($resut_des) $resut_des="<p class='pre_description'>".$resut_des."</p>";
			?>
			<?php 
				$new_result=str_replace("<RESULT>",$result,$tests_info->result_text);
				$new_result=str_replace("<PRE_RESULT>",$resut_des,$new_result);
					
				if($result_img != '')
				{
					?>
						<div class="col-xs-12 col-sm-5 col-md-4 result_img"><img src="<?php echo base_url();?>assets/img/test_result_img/<?php echo $result_img;?>" width="180" /></div>
						<div class="col-xs-12 col-sm-7 col-md-8"><?php echo $new_result;?></div>
					<?php
				}
				else
				{
					
					echo $new_result;
				}
			?>
			</div>
			
			<div id="fb_like_share" class="">
				<div class="fb-like  hidden-xs hidden-sm"  data-width="420" data-href="<?php echo site_url();?><?php echo $tests_info->alias.".html";?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
				<div class="fb-like  visible-xs visible-sm" data-width="220" data-href="<?php echo site_url();?><?php echo $tests_info->alias.".html";?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
			</div>
			<div id="fb_comments" class="">
				<div class="fb-comments  hidden-xs hidden-sm"  data-width="620" data-href="<?php echo site_url();?><?php echo $tests_info->alias.".html";?>" data-numposts="5" data-colorscheme="light"></div>
				<div class="fb-comments visible-xs visible-sm"  data-width="220" data-href="<?php echo site_url();?><?php echo $tests_info->alias.".html";?>" data-numposts="5" data-colorscheme="light"></div>
			</div>
			
		</div>
		
		<?php if($config_info->adsense_bottom) { ?><div class="adsense_bottom text-center"><?php echo htmlspecialchars_decode($config_info->adsense_bottom);?></div> <?php } ?>
		<div class="like_box ">
			<div class="fb-like-box hidden-xs hidden-sm"   data-width="420" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
			<div class="fb-like-box visible-xs visible-sm"   data-width="220" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
		</div>
	</div>
</div>



<style type="text/css">
	
	
	.adsense_bottom {
		
		min-height:40px;
		margin-top:15px;
		
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
		text-align:center;
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
	@media only screen and (max-width:520px) {
		.result_img img
		{
			/*width:88px;*/
		}
	}
</style>
<script language="javascript">
	$(function() {
		$('html, body').animate({
                        scrollTop: 95
                    }, 800);

		/*$.delay(1000, function(){
			//$('#my_Modal').modal('show');
			alert('ss');
		});*/
		setTimeout(function() {
			  // Do something after 2 seconds
			  
			  $('#my_Modal').modal('show');
		}, 8000);
		setTimeout(function() {
			  // Do something after 2 seconds
			  
			  $('#my_Modal2').modal('show');
		}, 16000);
		
	});
</script>



<div id="my_Modal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">	
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
				<h4 id="myModalLabel" class="modal-title text-center">Share on Facebook</h4>
			</div>
			
			<div class="modal-body  text-center">
					<?php echo $tests_info->popup_box_text;?>
					<div style="padding-left: 5px; padding-top: 20px; margin:auto;  margin-bottom: 20px">
						<a href='https://www.facebook.com/sharer/sharer.php?u=<?php  echo site_url();?><?php  echo $tests_info->alias.".html";?>' target="_blank" class="button  fb_button" style="width: 185px" target="_blank"> <i class="fa fa-facebook" onClick="_gaq.push(['_trackEvent', 'Share', 'ClickedOnShareButton', 'startMentalAge']);"></i>Share on Facebook </a>
						
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
				<h4 id="myModalLabel" class="modal-title">Facebook Page</h4>
			</div>
			<div class="modal-body   text-center">
					Like our page to see more tests and quizzes!  
					<div class="fb-like-box hidden-xs hidden-sm"  data-width="420" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
					<div class="fb-like-box visible-xs visible-sm"  data-width="220" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>