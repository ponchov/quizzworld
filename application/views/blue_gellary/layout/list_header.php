<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Test Yourself Today! Your destination for daily fun tests and personality quizzes!">

    <meta name="author" content="PC" >

	

	<meta property="og:title" content="<?php if(isset($page_title)) echo $page_title; ?>" />

    <meta property="og:type" content="website" />

    <?php if(isset($meta_img)) { ?> <meta property="og:image" content="<?php  echo $meta_img; ?>" /> <?php } ?>

    <meta property="og:url" content="<?php if(isset($meta_url)) echo $meta_url; ?>" />

    <meta property="og:site_name" content="<?php if(isset($page_title)) echo $page_title; ?>" />

    <meta property="og:description" content="<?php if(isset($fb_meta_description)) echo $fb_meta_description; ?>" />

    <meta property="fb:admins" content="<?php echo trim($config_info->facebook_appid);?>" />

	

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


<!-- Start: Taboola Code -->

<script type="text/javascript">

window._taboola = window._taboola || [];

_taboola.push({article:'auto'});

!function (e, f, u) {

e.async = 1;

e.src = u;

f.parentNode.insertBefore(e, f);

}(document.createElement('script'), document.getElementsByTagName('script')[0], 'http://cdn.taboola.com/libtrc/survley/loader.js');

</script>

<!-- End: Taboola Code -->

</head>



  <body>

<?php /*?><script type="text/javascript">
(function() {
  var ARTICLE_URL = window.location.href;
  var CONTENT_ID = 'everything';
  document.write(
    '<scr'+'ipt '+
    'src="//survey.g.doubleclick.net/survey?site=_dmea5ybvipiqlpcn3v5tmqjopm'+
    '&amp;url='+encodeURIComponent(ARTICLE_URL)+
    (CONTENT_ID ? '&amp;cid='+encodeURIComponent(CONTENT_ID) : '')+
    '&amp;random='+(new Date).getTime()+
    '" type="text/javascript">'+'\x3C/scr'+'ipt>');
})();
</script><?php */?>

	<?php if($cur_page != 'questions') { ?>

	<div class="navbar-fixed-top" id="list_header">
		<div class="container list_container">
			<div class="col-xs-12 col-sm-12 col-md-12">	
					<a href="<?php echo base_url();?>"><img class="img-resposive logo" src="<?php echo base_url();?>assets/templates/<?php echo $this->template;?>/img/logo.gif" alt=""/></a>
			</div> <!--header_area-->
		</div>

	</div>
	
	

	<div style="clear:both; height:80px;"></div>
	<?php } ?>
   
	<div class="container list_container">

      <!-- Static navbar -->

	  
