<!DOCTYPE html>



<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="<?php if(isset($page_description)) echo $page_description;?>">

    <meta name="author" content="PC" >

	

	<meta property="og:title" content="<?php if(isset($page_title)) echo $page_title; ?>" />

    <meta property="og:type" content="website" />

    <?php if(isset($meta_img)) { ?> <meta property="og:image" content="<?php  echo $meta_img; ?>" /> <?php } ?>

    <meta property="og:url" content="<?php if(isset($meta_url)) echo $meta_url; ?>" />

    <meta property="og:site_name" content="<?php if(isset($page_title)) echo $page_title; ?>" />

    <meta property="og:description" content="<?php if(isset($fb_meta_description)) echo $fb_meta_description; ?>" />
	
    <meta property="fb:app_id" content="<?php echo trim($config_info->facebook_appid);?>" />

	

    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/Antheratom.ico">



    <title><?php if(isset($page_title)) echo $page_title; else echo "Funny Games";?></title>



    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">



    <!-- Custom styles for this template -->

    <link href="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/css/navbar.css" rel="stylesheet">

	<link href="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/css/style.css" rel="stylesheet">

	<!--[if gte IE 8]>

		<link href="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/css/style_ie.css" rel="stylesheet">

	<![endif]-->

	

	<!--[if gte IE 8]>

		<style type="text/css">

			.start_btn 

			{

				border-radius: 6px;

				behavior: url(<?php echo base_url() ;?>assets/templates/<?php echo $this->template;?>/css/pie.htc);  

				position: relative;  

				zoom: 1; 

			}

			

			.button 

			{

				border-radius: 4px;

				box-shadow: 0 -3px 0 0 #DDDDDD;

				behavior: url(<?php echo base_url() ;?>assets/templates/<?php echo $this->template;?>/css/pie.htc);  

				position: relative;  

				zoom: 1; 

			}

		</style>

	<![endif]-->



	<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

	

    <!-- Just for debugging purposes. Don't actually copy this line! -->

    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

    <![endif]-->

	<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>

	<?php echo htmlspecialchars_decode($config_info->dfp_ad);?>

	
<!-- FB Pix 1: -->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '787502501343541']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=787502501343541&amp;ev=PixelInitialized" /></noscript>



<!--FB Pix 2: -->

<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '775595749198065']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=775595749198065&amp;ev=PixelInitialized" /></noscript>



<!-- Quantcast code: -->

<!-- Quantcast Tag -->
<script type="text/javascript">
var _qevents = _qevents || [];

(function() {
var elem = document.createElement('script');
elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
elem.async = true;
elem.type = "text/javascript";
var scpt = document.getElementsByTagName('script')[0];
scpt.parentNode.insertBefore(elem, scpt);
})();

_qevents.push({
qacct:"p-q9CSRau13eZQp"
});
</script>

<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-q9CSRau13eZQp.gif" border="0" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->

</head>



  <body>
  

	
	<?php if($cur_page != 'questions') { ?>

	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="slide-nav">
		<div class="container"> 
			<div class="col-xs-12 col-sm-12 col-md-12 headerArea">
				<div class="navbar-header">
					<a class="navbar-toggle"> 
					  <span class="sr-only">Toggle navigation</span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					 </a>				
					<a class="navbar-brand hidden-xs" href="<?php echo base_url();?>"><img class="img-resposive" src="<?php echo base_url();?>assets/templates/<?php echo $this->template;?>/img/logo.gif" alt="" style="height:50px;"/></a>
			   </div>
				
				<div id="topmenu">
				<div class="domain_like_box  col-sm-3 col-md-2 hidden-xs">
					<div class="fb-like" data-href="<?php echo $config_info->facebook_url;?>" data-width="320" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
				</div>	
				<div class="pull-right">		 
					<ul class="nav navbar-nav">
					<li class="visible-xs"><a class="button" href="<?php echo site_url();?>"><?php echo $this->lang->line('home');?></a></li>
					<li><a class="button" href="<?php echo site_url();?>personality_quiz.html"><?php echo $this->lang->line('personality_quizz');?></a></li>
					<li><a class="button" href="<?php echo site_url();?>lists.html"><?php echo $this->lang->line('list');?></a></li>	
					<li><a class="button" href="<?php echo site_url();?>articles.html"><?php echo $this->lang->line('article');?></a></li>
					<li><a class="button" href="<?php echo site_url();?>videos.html"><?php echo $this->lang->line('video');?></a></li>							
				</ul>	
				</div>			  
			   </div>
			   
				<div class="navbar-header  domain_like_box_mob visible-xs col-xs-6" style="padding-top:1px;">				
					<a class="pull-right" href="<?php echo base_url();?>"><img class="img-resposive" src="<?php echo base_url();?>assets/templates/<?php echo $this->template;?>/img/logo.gif" alt="" style="height:46px; padding-top:2px;"/></a>
					</div>
					
				<div class="navbar-header visible-xs  col-xs-3 pull-right facebookLikeBox" style="padding-right:0px; padding-top:15px;">
						<div class="fb-like pull-right" data-href="<?php echo $config_info->facebook_url;?>" data-width="320" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
					</div>
		    </div>
		</div><!--end container-->

	</div>


	<?php } ?>

   

   <div id="page-content">
	<div class="container">

      <!-- Static navbar -->
	  

	

      

