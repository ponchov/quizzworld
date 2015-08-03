	<div class="clear_space" style="height:10px;"></div>
	<div class="col-xs-6 col-sm-6 col-md-4">		
		<form class="form-horizontal" action="<?php echo site_url(); ?>admin/tests/search_ads_config/" method="post" id="search_form">
			<div class="form-group">			
			<div class="col-xs-7 col-sm-5 col-md-8">
				<input class="form-control required" type="text" name="search_test_ads" id="search_test_ads" value="<?php if($this->session->userdata('search_test_ads')) echo $this->session->userdata('search_test_ads'); ?>" />
			</div>	
			<div class="col-xs-5 col-sm-4 col-md-4">				
				<input class="btn btn-primary" type="submit" value="Search" />
			</div>		
		</div>
		</form>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-3">
		<form class="form-horizontal" action="<?php echo site_url(); ?>admin/tests/search_ads_config/" method="post" id="test_type_form">
			<select name="test_type" id="test_type" class="form-control">
				<option value="" selected="selected">Select Test</option>
				<option value="personal" <?php if($this->session->userdata('test_type') =="personal") echo "selected"; ?> >Personal Test</option>
				<option value="2" <?php if($this->session->userdata('test_type') =="2") echo "selected"; ?>>Twist Test</option>
				<option value="3" <?php if($this->session->userdata('test_type') =="3") echo "selected"; ?>>Name Test</option>
				<option value="5" <?php if($this->session->userdata('test_type') =="5") echo "selected"; ?>>Face Test</option>
				<option value="6" <?php if($this->session->userdata('test_type') =="6") echo "selected"; ?>>Facebook Apps</option>
			</select>
		</form>
	</div>





<script language="javascript">

	$(document).ready(function() {

		$(document).on('change','#test_type',function() {
			$('#test_type_form').submit();
			/*var test_type=$(this).val();
			alert(test_type);
			var url="<?php echo site_url();?>admin/tests/search_ads_config";
				$.post(url,{test_type:test_type},function(data) {
					//alert(data);
					$('#overlay').remove();
					$('#config_container').html(data);
				});
			*/
		});

		
		
		

	});

</script>





  

