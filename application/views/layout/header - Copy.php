<!DOCTYPE html>

<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
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
    <link href="<?php echo base_url(); ?>assets/css/navbar.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
	
	<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
	
	<div class="top_bar navbar-fixed-top ">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-2 col-md-2 hidden-xs hidden-sm text-center logo" style="float:left;">
					<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/img/logo.gif" style="height:30px;  float:right;"/></a>
				</div>
				<div class="col-xs-12 col-sm-10 col-md-8 text-center" style="float:none; margin:auto;">
				<?php /*?><div class="col-xs-2 col-sm-2 col-md-2 logo">
					<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/img/logo.gif" style="height:30px; width:130px; float:right;"/></a>
				</div><?php */?>
						
					<div class="col-xs-7 col-sm-6 col-md-6 facebook_like" style="">				
							<div class="hidden-md hidden-lg text-center logo" style="float:left;">
								<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/img/logo.gif" style="height:33px;  float:right;"/></a>
							</div>
							<div class="domain_like_box hidden-xs hidden-sm"  >
								<div class="fb-like" data-href="<?php echo $config_info->facebook_url;?>" data-width="320" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
							</div>
							<div class="visible-sm" style="float:right;"  >
								<div class="fb-like" data-href="<?php echo $config_info->facebook_url;?>" data-width="320" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
							</div>
							
	
							<div class="domain_like_box_mobile visible-xs pull-right" >
								<div style="" class="fb-like" data-href="<?php echo $config_info->facebook_url;?>" data-width="320" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
							</div>
							
					</div>
					
					<div class="col-xs-5 col-sm-6 col-md-6 top_menu">				
							<nav class="navbar navbar-default pull-right" role="navigation">
								<div class="container-fluid">				
								<div class="navbar-header">
								  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								  </button>
								
								</div>
								
								<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">				  
								
								  <ul class="nav navbar-nav">
									<?php
										if(isset($active_sub_menu)) $active_sub_menu=$active_sub_menu;
										else $active_sub_menu='';
										$this->db->select('*');
										$this->db->where('status',1);
										$this->db->from('categories');
										$query=$this->db->get();
										$res=$query->result();
										if($res) {
										?>
											
										<li class="<?php if($active_menu == 'category') echo 'active';?> dropdown">
										  <a  href="#" class="dropdown-toggle" data-toggle="dropdown">Category <b class="caret"></b></a>
										  <ul class="dropdown-menu">
											<?php
												foreach($res as $row)
												{
													?>
													<li class="<?php if($active_sub_menu == $row->alias) echo 'active';?>"><a href="<?php echo site_url();?>category/<?php echo $row->alias; ?>.html"><?php echo $row->category_name; ?></a></li>
													<?php 
												}
											?>
											
									
										  </ul>
										</li>
									
									<?php } ?>
									<li class="<?php if($active_menu == 'top') echo 'active';?>"><a href="<?php echo site_url();?>top.html">Top</a></li>
									<li class="<?php if($active_menu == 'random') echo 'active';?>"><a  href="<?php echo site_url();?>random.html">Random</a></li>								
								  </ul>
								  
								</div><!-- /.navbar-collapse -->
								</div><!-- /.container-fluid -->
							</nav>
					</div>	
				
				</div>
			</div>
			
		</div>
	</div>
	
	<!--<div class="navbar" style="padding-top:50px;" >
		<ul>
			<li>asdfasdf</li>
			<li>asdfasdf</li>
			<li>asdfasdf</li>
			<li>asdfasdf</li>		
		</ul>
	</div>-->
	
	<div style="clear:both; height:50px;"></div>
    <div class="container">

      <!-- Static navbar -->
	  
	<style type="text/css">
		.navbar-default
		{
			background-color:#F5F5F5;
			border-color:#F5F5F5;
			/*height:33px !important;*/
			
		}
		.navbar-collapse  {
			border:none;
		}
		
		.navbar
		{
			margin-bottom:0 !important;
			min-height:33px!important;
		}
		.navbar ul
		{
			
			padding: !important;
		}
		.navbar ul li
		{
			margin:0 !important;
			padding: !important;
			list-style-image:url('<?php echo base_url(); ?>assets/img/border.jpg') !important;
		}
		

		.navbar-nav > li > a
		{
			color:#000000!important;
			font-size:14px;
			font-weight:bold;			
			padding:6px 15px ;
			/*border-right:1px solid #999999*/
		}
		
		.navbar ul li:first-child
		{
			/*border-right:none;*/
			/*list-style-image:none;*/
		}
		
		.nav > li {
			display: inline;
			float: left;
			position: relative;
		}

		.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus 
		{
			background-color:#F5F5F5 !important;
		}
		
		.navbar-toggle
		{
			margin:0px;
			padding:7px 10px !important;
			/*margin-right:-120%;*/
		}
		
		.top_area
		{
			padding:0 !important;
		}
		
		.facebook_like
		{
			padding-left:0;			
		}
		.top_menu
		{
			padding-right:0;
		}
		.logo
		{
			padding-right:0;
		}
		@media only screen and (max-width:520px) 
		{
			.logo img
			{
				width:70px !important;
			}
			.facebook_like
			{
				padding:0;				
			}
			.navbar-nav > li > a
			{
				font-size:13px;
				padding:0 4px ;
			}
					
		  }
		
	</style>
      
