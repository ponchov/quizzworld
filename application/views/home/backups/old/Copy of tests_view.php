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
	<?php if($tests_info->add_sense_top) { ?> <div class="adsense_top text-center"><?php echo htmlspecialchars_decode($tests_info->add_sense_top);?></div> <?php } ?>
	
	<div class="well">
		<h1 class="text-center"><?php echo $tests_info->title;?></h1>
		<p class="tests_des"><?php echo $tests_info->description;?></p>
		<div class="text-center row "><a href="<?php echo site_url();?>start/<?php echo $tests_info->alias.".html";?>"><button style="font-size:30px;" type="button" class="btn btn-lg btn-success col-xs-8 col-md-4 col-sm-4 start_btn">START</button></a></div>
	</div>
	
	<div id="fb_like_share" class="col-xs-12 col-sm-8 col-md-8 ">	
		<div class="fb-like  hidden-xs hidden-sm" data-width="420" data-href="<?php echo site_url();?><?php echo $tests_info->alias.".html";?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
		<div class="fb-like  visible-xs visible-sm" data-width="270" data-href="<?php echo site_url();?><?php echo $tests_info->alias.".html";?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
	</div>
	<div class="row description">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<h3 class="">Questions</h3>
			<?php echo $tests_info->question;?>	
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<h3 class="">Answer</h3>
			<?php echo $tests_info->answer;?>
		</div>
	</div>
	
	<div class="row description">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<h3 class="">Fun</h3>
			<?php echo $tests_info->fun;?>	
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<h3 class="">Enjoy And Share</h3>
			<?php echo $tests_info->enjoy_and_share;?>
		</div>
	</div>
	
	<?php if($tests_info->add_sense_bottom) { ?><div class="adsense_bottom text-center"><?php echo htmlspecialchars_decode($tests_info->add_sense_bottom);?></div> <?php  } ?>
	<div class="like_box ">
		<div class="fb-like-box"  data-width="270" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
	</div>
	
</div>

</div>
<?php if($tests_info->google_analytics) echo htmlspecialchars_decode($tests_info->google_analytics);?>
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
		font-size:21px;
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
		font-size:55px;
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
	
</style>