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
				<option value="all">All Test</option>
				<option value="personal" <?php if($this->session->userdata('test_type') =="personal") echo "selected"; ?> >Personal Test</option>
				<option value="2" <?php if($this->session->userdata('test_type') =="2") echo "selected"; ?>>Twist Test</option>
				<option value="3" <?php if($this->session->userdata('test_type') =="3") echo "selected"; ?>>Name Test</option>
				<option value="5" <?php if($this->session->userdata('test_type') =="5") echo "selected"; ?>>Face Test</option>
				<option value="6" <?php if($this->session->userdata('test_type') =="6") echo "selected"; ?>>Facebook Apps</option>
			</select>
		</form>
	</div>

	
	<div class="row" id="config_container">
	<form action="<?php echo site_url();?>admin/tests/ads_congig_save_all" method="post">
	<button type="submit" class="btn btn-success btn-lg pull-right">Save All</button>
	<div style="clear:both; height:15px;"></div>
 	<table id="mytable" class="table table-striped table-hover table-fixed-header"> 
		<thead class="header" >
			<tr >
			<th> # </th>
			<th class="col-sm-3 col-md-3">Test Title</th>
			<th>ASfbLCT <br /> <input type="checkbox" class="single_col" value="test_top" id="test_top" /></th>
			<th>ASfbLCM <br /> <input type="checkbox" class="single_col" value="test_middle" id="test_middle" /></th>
			<th>ASfbLCB <br /> <input type="checkbox" class="single_col" value="test_bottom" id="test_bottom" /> </th>
			<th>ASfbSBT <br /> <input type="checkbox" class="single_col" value="test_left" id="test_left" /> </th>
			<th>ASfbSBB <br /> <input type="checkbox" class="single_col" value="test_right" id="test_right" /> </th>
			<th>TfbB <br /> <input type="checkbox" class="single_col" value="test_tabo" id="test_tabo" /></th>
			<th>ASfbWm   <br /> <input type="checkbox" class="single_col" value="test_wm" id="test_wm" /></th>
			
			
			<th>R.ASfbLCT  <br /> <input type="checkbox" class="single_col" value="result_top" id="result_top" /></th>
			<th>R.ASfbLCM  <br /> <input type="checkbox" class="single_col" value="result_middle" id="result_middle" /></th>
			<th>R.ASfbLCB  <br /> <input type="checkbox" class="single_col" value="result_bottom" id="result_bottom" /></th>
			<th>R.ASfbSBT  <br /> <input type="checkbox" class="single_col" value="result_left" id="result_left" /></th>
			<th>R.ASfbSBB  <br /> <input type="checkbox" class="single_col" value="result_right" id="result_right" /></th>
			<th>R.ASfbWm   <br /> <input type="checkbox" class="single_col" value="result_wm" id="result_wm" /></th>
			<th>R.TfbB   <br /> <input type="checkbox" class="single_col" value="result_tabo" id="result_tabo" /></th>
			
			
			</tr>
		</thead>

		<tbody>

			<?php
				$this->session->set_userdata('ids', array());
				if($test_list)
				{	
					$i=0;

					$test_top=true;
					$test_middle=true;
					$test_bottom=true;
					$test_left=true;
					$test_right=true;
					$test_tabo=true;
					$test_wm=true;
					
					
					
					$result_top=true;
					$result_middle=true;
					$result_bottom=true;
					$result_left=true;
					$result_right=true;
					$result_wm=true;
					$result_tabo=true;

					
					$ids=array();
					foreach($test_list as $row)

					{ 
					  //echo "<pre>"; print_r($row);exit;
						$ids[]=$row->tests_id;
						$i++;
						$all_cheched=true;
						if($row->test_top == 0) $all_cheched=false;
						else if($row->test_middle == 0) $all_cheched=false;
						else if($row->test_bottom == 0) $all_cheched=false;
						else if($row->test_left == 0) $all_cheched=false;
						else if($row->test_right == 0) $all_cheched=false;
						else if($row->test_tabo == 0) $all_cheched=false;
						else if($row->test_wm == 0) $all_cheched=false;
						
						else if($row->result_top == 0) $all_cheched=false;
						else if($row->result_middle == 0) $all_cheched=false;
						else if($row->result_bottom == 0) $all_cheched=false;
						else if($row->result_left == 0) $all_cheched=false;
						else if($row->result_right == 0) $all_cheched=false;
						else if($row->result_wm == 0) $all_cheched=false;
						else if($row->result_tabo == 0) $all_cheched=false;
						
						
						
						
						if($row->test_top == 0) $test_top=false;
						if($row->test_middle == 0) $test_middle=false;		
						if($row->test_bottom == 0) $test_bottom=false;
						if($row->test_left == 0) $test_left=false;		
						if($row->test_right == 0) $test_right=false;
						if($row->test_tabo == 0) $test_tabo=false;
						if($row->test_wm == 0) $test_wm=false;
						
						if($row->result_top == 0) $result_top=false;
						if($row->result_middle == 0) $result_middle=false;
						if($row->result_bottom == 0) $result_bottom=false;
						if($row->result_left == 0) $result_left=false;
						if($row->result_right == 0) $result_right=false;
						if($row->result_wm == 0) $result_wm=false;
						if($row->result_tabo == 0) $result_tabo=false;
						
						
						
						

					?>

					<tr>
						<td data-title="No"><input type="hidden" name="tests[]" value="<?php echo $row->tests_id;?>" /><input <?php if($all_cheched) echo 'checked="checked"';?>  type="checkbox" class="single_test"   id="test_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" /></td>
						<td data-title="Test Title"><?php echo $row->title;?></td>
						<td><input class="individual" type="checkbox"  id="t.top_<?php echo $row->tests_id;?>" name="test_top_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_top == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="t.mid_<?php echo $row->tests_id;?>" name="test_middle_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_middle == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="t.bot_<?php echo $row->tests_id;?>" name="test_bottom_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_bottom == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="t.side1_<?php echo $row->tests_id;?>" name="test_left_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_left == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="t.side2_<?php echo $row->tests_id;?>" name="test_right_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_right == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="r.bot_<?php echo $row->tests_id;?>" name="test_tabo_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_tabo == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="r.bot_<?php echo $row->tests_id;?>" name="test_wm_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_wm == 1) echo 'checked="checked"';?> /></td>
						
						
						
						
						<td><input class="individual" type="checkbox"  id="r.bot_<?php echo $row->tests_id;?>" name="result_top_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->result_top == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="r.bot_<?php echo $row->tests_id;?>" name="result_middle_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->result_middle == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="r.bot_<?php echo $row->tests_id;?>" name="result_bottom_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->result_bottom == 1) echo 'checked="checked"';?> /></td>
					    <td><input class="individual" type="checkbox"  id="r.bot_<?php echo $row->tests_id;?>" name="result_left_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->result_left == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="r.bot_<?php echo $row->tests_id;?>" name="result_right_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->result_right == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="r.bot_<?php echo $row->tests_id;?>" name="result_wm_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->result_wm == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="r.bot_<?php echo $row->tests_id;?>" name="result_tabo_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->result_tabo == 1) echo 'checked="checked"';?> /></td>
					
					</tr>

					<?php

					}
					
					//----- set test ids in session
					$this->session->set_userdata('ids',$ids);
					//print_r($this->session->userdata('ids'));

				}

			?>

		</tbody>

	</table>

	<input type="hidden" name="ads_congig_save_all" value="ads_congig_save_all" />
	

	<button type="submit" class="btn btn-success btn-lg pull-right">Save All</button>

	<div style="clear:both; height:15px;"></div>

	</form>

	</div>

	<div class="row text-center">
		<div class="pagination"><?php echo $pagination; ?></div>
	</div>	



<script language="javascript">

	$(document).ready(function() {
		<?php if($test_top) { ?> $('#test_top').attr('checked','checked');<?php } ?>
		<?php if($test_middle) { ?>$('#test_middle').attr('checked','checked');<?php } ?>
		<?php if($test_bottom) { ?>$('#test_bottom').attr('checked','checked');<?php } ?>
		<?php if($test_left) { ?>$('#test_left').attr('checked','checked');<?php } ?>
		<?php if($test_right) { ?>$('#test_right').attr('checked','checked');<?php } ?>
		<?php if($test_tabo) { ?>$('#test_tabo').attr('checked','checked');<?php } ?>
		<?php if($test_wm) { ?>$('#test_wm').attr('checked','checked');<?php } ?>
		
		
		<?php if($result_top) { ?>$('#result_top').attr('checked','checked');<?php } ?>
		<?php if($result_middle) { ?>$('#result_middle').attr('checked','checked');<?php } ?>
		<?php if($result_bottom) { ?>$('#result_bottom').attr('checked','checked');<?php } ?>
		<?php if($result_left) { ?>$('#result_left').attr('checked','checked');<?php } ?>
		<?php if($result_right) { ?>$('#result_right').attr('checked','checked');<?php } ?>
		<?php if($result_wm) { ?>$('#result_wm').attr('checked','checked');<?php } ?>
		<?php if($result_tabo) { ?>$('#result_tabo').attr('checked','checked');<?php } ?>
		
		
		$(document).on('click','.single_test',function() {

			var test_id=$(this).val();

			var ele_id=$(this).attr('id');

			

			var overlay = $('<div id="overlay"><div id="indicator"><img src="<?php echo base_url();?>assets/img/ajax-loader.gif" /></div> </div>');

			overlay.appendTo(document.body);

			if(this.checked)

			{

				var url="<?php echo site_url();?>admin/tests/batch_test_ad_config";

				$.post(url,{option:'all',test_id:test_id,value:'yes',ele_id:ele_id},function(data) {

					$('#overlay').remove();

					$('#config_container').html(data);

					

				});

			}

			else

			{

				var url="<?php echo site_url();?>admin/tests/batch_test_ad_config";

				$.post(url,{option:'all',test_id:test_id,value:'no',ele_id:0},function(data) {

					$('#overlay').remove();

					$('#config_container').html(data);

				});

			}

		});

		

		

		

		// this is for single col for all test

		$(document).on('click','.single_col',function() {

			var col_name=$(this).val();

			var ele_id=$(this).attr('id');
			//alert(ele_id); return false;
			var test_type="3";

			var overlay = $('<div id="overlay"><div id="indicator"><img src="<?php echo base_url();?>assets/img/ajax-loader.gif" /></div> </div>');

			overlay.appendTo(document.body);

			if(this.checked)

			{

				var url="<?php echo site_url();?>admin/tests/test_ad_config_all_test";

				$.post(url,{col_name:col_name,value:'yes',ele_id:ele_id,test_type:test_type},function(data) {

					$('#overlay').remove();

					$('#config_container').html(data);

				});

			}

			else

			{

				var url="<?php echo site_url();?>admin/tests/test_ad_config_all_test";

				$.post(url,{col_name:col_name,value:'no',ele_id:0,test_type:test_type},function(data) {

					$('#overlay').remove();

					$('#config_container').html(data);

				});

			}

		});

		

		

		$(document).on('click','.test_wm',function() {

			var test_id=$(this).val();

			if(this.checked)

			{

				$("#qtop2_"+test_id).prop('checked',false);

			}

			

		});

		

		$(document).on('click','.result_wm',function() {

			var test_id=$(this).val();

			if(this.checked)

			{

				$("#qtop_"+test_id).prop('checked',false);

			}

			

		});

		// this is for single col for single test

		$(document).on('click','.individual3333',function() {

			var col_name=$(this).attr('name');

			var test_id=$(this).val();

			

			var overlay = $('<div id="overlay"><div id="indicator"><img src="<?php echo base_url();?>assets/img/ajax-loader.gif" /></div> </div>');

			overlay.appendTo(document.body);

			if(this.checked)

			{

				var url="<?php echo site_url();?>admin/tests/test_ad_config_single_col";

				$.post(url,{col_name:col_name,test_id:test_id,value:'yes',ele_id:0},function(data) {

					//alert(data);

					$('#overlay').remove();

					$('#config_container').html(data);

				});

			}

			else

			{

				var url="<?php echo site_url();?>admin/tests/test_ad_config_single_col";

				$.post(url,{col_name:col_name,test_id:test_id,value:'no'},function(data) {

					//alert(data);

					$('#overlay').remove();

					$('#config_container').html(data);

				});

			}

		});

		

		

		//class="navbar-fixed-top"

		$(window).scroll(function() {

		

		var scrollTop = $(window).scrollTop();

		//alert(scrollTop);

		if(scrollTop >= 140)

		{

			//alert(scrollTop);

			$('.table_head').addClass('navbar-fixed-top'); 

			return false;

		}

		//alert(scrollTop)

		});

		
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

<style type="text/css">

	.container {

		width:1280px ;

	}

	

	#overlay {

		position: fixed;

		top: 0;

		left: 0;

		width: 100%;

		height: 100%;

		background-color: #000;

		filter:alpha(opacity=50);

		-moz-opacity:0.5;

		-khtml-opacity: 0.5;

		opacity: 0.5;

		z-index: 10000;

		

	}

	#indicator {

		z-index: 10000;

		color:#FF0000;

		font-size:20px;

		height:50px;

		position:absolute;

		left:45%;

		top:45%;

	}

</style>



  <script language="javascript" type="text/javascript" >

    $(document).ready(function(){

      // add 30 more rows to the table

      var row = $('table#mytable > tbody > tr:first');

      //var row2 = $('table#mytable2 > tbody > tr:first');

      /*for (i=0; i<30; i++) {

        $('table#mytable > tbody').append(row.clone());

        //$('table#mytable2 > tbody').append(row2.clone());

      }*/



      // make the header fixed on scroll

      $('.table-fixed-header').fixedHeader();

    });

  </script>


 <script language="javascript">
// REGISTRATION FORM VALIDATION (THE SHORTER FORM)
jQuery(document).ready(function () {

	jQuery('#search_form').validate({});

}); // end document.ready

</script>