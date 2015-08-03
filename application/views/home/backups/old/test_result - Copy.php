<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo trim($config_info->facebook_appid);?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


</div>
<div class="container" style="padding-left:0; padding-right:0;">
<div class="row" style="margin-left:0; margin-right:0;">


	
	<?php if($tests_info->result_top == 1) 
	{ 
	?> 
		<div class="adsense_top text-center"><?php if($tests_info->default_ads == 2 && $tests_info->result_adsense) echo htmlspecialchars_decode($tests_info->result_adsense); else if($config_info->result_adsense) echo htmlspecialchars_decode($config_info->result_adsense);?></div> 
	<?php
	 } 
	?>
	
	<div class="sky_ad_left">
		<?php 
			if($tests_info->result_left == 1 && $tests_info->default_ads == 2 && $tests_info->result_sky_left_adsense) echo htmlspecialchars_decode($tests_info->result_sky_left_adsense);
			else if($config_info->result_sky_left_adsense && $tests_info->result_left == 1) echo htmlspecialchars_decode($config_info->result_sky_left_adsense);
		?>
	</div>
	<div id="main_container" class="col-xs-12 col-sm-10 col-md-8 ">
	
		<div style="clear:both; height:10px;">&nbsp;</div>
		<div class="well">
			
			<div class="text-center col-xs-12 col-sm-12 col-md-12">
			<?php
				/*echo "Start Point ".$tests_info->start_point;
				echo "<br/>";
				echo $this->session->userdata('test_result');*/
				
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
				$new_result=str_replace("<RESULT>",$result,trim($tests_info->result_text));
				$new_result=str_replace("<PRE_RESULT>",$resut_des,$new_result);
					
				if($result_img != '')
				{
					?>
						<?php /*?><div class="col-xs-12 col-sm-5 col-md-4 result_img"><img src="<?php echo base_url();?>assets/img/test_result_img/<?php echo $result_img;?>" width="180" /></div><?php */?>
						<img class="result_img" src="<?php echo base_url();?>assets/img/test_result_img/<?php echo $result_img;?>" width="180" />
						<?php echo $new_result;?>
					<?php
				}
				else
				{
					
					echo $new_result;
				}
			?>
			</div>
		<div style="clear:both;"></div>
			<center>
			<div style="padding-left: 5px; padding-top: 1px; margin:auto;  margin-bottom: 10px">
				<a href='https://www.facebook.com/sharer/sharer.php?u=<?php echo site_url();?><?php echo $tests_info->alias.".html";?>' target="_blank" class="button  fb_button" style="width: 185px" target="_blank"> <i class="fa fa-facebook" onClick="_gaq.push(['_trackEvent', 'Share', 'ClickedOnShareButton', 'startMentalAge']);"></i>Share on Facebook </a>
						
			</div>
			</center>
		<div style="clear:both;"></div>
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
		<h2 class="text-center" style="margin-bottom:10px;">Are You Surprice ? Leave a Comments</h2>
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
	
	@media only screen and (max-width:340px) {

		.pre_next_test {
			padding:0;
		}

	}
	
	
</style>




<div id="my_Modal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">	
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
				<h4 id="myModalLabel" class="modal-title text-center">Share on Facebook</h4>
			</div>
			
			<div class="modal-body  text-center">
					<?php //echo $tests_info->popup_box_text;?>
					Share your result with your friends and see what result they've got! That might surprise both of you!
					<div style="padding-left: 5px; padding-top: 20px; margin:auto;  margin-bottom: 20px">
						<a href='https://www.facebook.com/sharer/sharer.php?u=<?php echo site_url();?><?php  echo $tests_info->alias.".html";?>' target="_blank" class="button  fb_button" style="width: 185px" target="_blank"> <i class="fa fa-facebook" onClick="_gaq.push(['_trackEvent', 'Share', 'ClickedOnShareButton', 'startMentalAge']);"></i>Share on Facebook </a>
						
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
		//DeleteCookie('count');
		/*$('html, body').animate({
                        scrollTop: 95
                    }, 800);*/

		/*$.delay(1000, function(){
			$('#my_Modal').modal('show');
			alert('ss');
		});*/
// 	setTimeout(function() {
			  // Show pop-up after 15 seconds
			  
// 	  $('#my_Modal').modal('show');
//		},15000);
// 		setTimeout(function() {
			  // Show pop-up after 20 seconds
//		  var visit_numbers=checkCount();
			 //alert(visit_numbers);
//		 if(visit_numbers < 3)
// 			 {
// 			  $('#my_Modal2').modal('show');
// 			 }
		  
// 		}, 25000);
		
	});
</script>

