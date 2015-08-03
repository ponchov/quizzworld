<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

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

    <div class="container">

      <!-- Static navbar -->
	  <div class="row">
     	 <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">

		  	<?php if($this->session->userdata('user_id')) 
				{ 
				?>
				
				<li><a  href="<?php echo site_url(); ?>admin/tests">Tests</a></li>				
				<li><a  href="<?php echo site_url(); ?>admin/categories">Categories</a></li>
				<li><a  href="<?php echo site_url(); ?>admin/users">Users</a></li>
				<li><a  href="<?php echo site_url(); ?>admin/site_config">Configuration</a></li>
				<li><a  href="<?php echo site_url(); ?>admin/contact_user">Contact User List</a></li>
				<li><a  href="<?php echo site_url(); ?>admin/users/change_password">Change Password</a></li>
				<li><a  href="<?php echo site_url(); ?>admin/auth/logout">Signout	</a></li>
				

				<?php 
					}
					else
					{
					?>
					<li><a  href="<?php echo site_url(); ?>admin/auth">Signin	</a></li>
	
					<?php 
					}
					?>           
          </ul>
          
        </div><!--/.nav-collapse -->
		
      </div>
		<!--<ul class="breadcrumb">
			<li><a href="#">Home</a> </li>
			<li class="active">Library</li>
		</ul>-->
		<?php echo $breadcrumbs;?>
		</h1>
	  <?php /*if(isset($page_header)) { ?>
		<div class="page-header">
			<h1>
				<?php echo $page_header;?>
											
			</h1>
		</div><!-- /.page-header -->
		<?php }*/ ?>
	  </div>
	  
	  
	  <style type="text/css">
	  	.nav  li a
			{
				color:#FFFFFF;
			}
			
			.navbar-default .navbar-nav > li > a {
				color: #FFFFFF;
			}
			
			.error{
				color:#FF0000;
			}
			
			.navbar-collapse
			{
				padding-left:0;
				padding-right:0;
			}
			.nav  li
			{
				background-color:#3276B1;
				border-right:1px solid #FFFFFF;
			}
	  </style>
	  