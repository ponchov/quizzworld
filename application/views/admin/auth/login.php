
<div id="signup_box" class="jumbotron">
	<h3>Login Form</h3>
	<div class="error">
		<p>
		<?php 
			if(!empty($error_messaage))
			{
				echo $error_messaage;
			}
		?>
		</p>
	</div>
	<form class="form-horizontal" action="<?php echo site_url();?>admin/auth/signin" method="post" role="form">
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Username</label>
			<div class="col-sm-9">
			  <input type="text" name="username" id="username" class="form-control"  placeholder="Username">
			</div>
		  </div>
  		<div class="form-group">
			<label for="password" class="col-sm-3 control-label">Password</label>
			<div class="col-sm-9">
			  <input type="password" name="password" id="password" class="form-control"  placeholder="Password">
			</div>
		  </div>
		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-primary">Sign in</button>
			</div>
		  </div>
		 
		 
		
		<input type="hidden" name="user_login" id="user_login" value="user_login" />
		
	</form>
	
	
	
	
	

	
</div>

<style type="text/css">
	#signup_box{
	width:40%;
	margin:auto;
	padding:35px 15px;	
	text-align:center;
	
}
.jumbotron {
    color: inherit;
    font-size: 16px;
    font-weight: 200;
    line-height:normal;
}

.error p
{
	color:#FF0000;
}

.error
{
	color:#FF0000;
}
</style>

