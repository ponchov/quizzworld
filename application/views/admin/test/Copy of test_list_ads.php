	<div class="clear_space" style="height:10px;"></div>
	<div class="col-xs-6 col-sm-6 col-md-6">		
		<form class="form-horizontal" action="<?php echo site_url(); ?>admin/tests/search_ads_config/" method="post" id="search_form">
			<div class="form-group">			
			<div class="col-xs-7 col-sm-5 col-md-5">
				<input class="form-control required" type="text" name="search_test_ads" id="search_test_ads" value="<?php if($this->session->userdata('search_test_ads')) echo $this->session->userdata('search_test_ads'); ?>" />
			</div>	
			<div class="col-xs-5 col-sm-4 col-md-4">				
				<input class="btn btn-primary" type="submit" value="Search" />
			</div>		
		</div>
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

			

			<th>T.Top <br /> <input type="checkbox" class="single_col" value="test_top" id="test_top" /></th>

			<th>T.Middle <br /> <input type="checkbox" class="single_col" value="test_middle" id="test_middle" /></th>

			<th>T.Middle2 <br /> <input type="checkbox" class="single_col" value="test_middle2" id="test_middle2" /></th>

			<th>T.Bottom <br /> <input type="checkbox" class="single_col" value="test_bottom" id="test_bottom" /> </th>

			<th>T.Left  <br /> <input type="checkbox" class="single_col" value="test_left" id="test_left" /></th>

			<th>T.Right  <br /> <input type="checkbox" class="single_col" value="test_right" id="test_right" /></th>
			
			
			
			<th>K.Top <br /> <input type="checkbox" class="single_col" value="knowledge_top" id="knowledge_top" /> </th>
			<th>K.Middle  <br /> <input type="checkbox" class="single_col" value="knowledge_middle" id="knowledge_middle" /></th>
			<th>K.Bottom  <br /> <input type="checkbox" class="single_col" value="knowledge_bottom" id="knowledge_bottom" /></th>
			
			<th>TW.Top <br /> <input type="checkbox" class="single_col" value="twist_top" id="twist_top" /> </th>
			<th>TW.Middle  <br /> <input type="checkbox" class="single_col" value="twist_middle" id="twist_middle" /></th>
			<th>TW.Bottom  <br /> <input type="checkbox" class="single_col" value="twist_bottom" id="twist_bottom" /></th>

			

			<th>Q.Top <br /> <input type="checkbox" class="single_col" value="question_top" id="question_top" /></th>

			<th>Q.Top2 <br /> <input type="checkbox" class="single_col" value="question_top2" id="question_top2" /></th>

			<th>Q.Middle <br /> <input type="checkbox" class="single_col" value="question_middle" id="question_middle" /></th>

			<th>Q.Bottom <br /> <input type="checkbox" class="single_col" value="question_bottom" id="question_bottom" /></th>

			<th>Q.Bottom2 <br /> <input type="checkbox" class="single_col" value="question_bottom2" id="question_bottom2" /></th>

			<th>Q.Left <br /> <input type="checkbox" class="single_col" value="question_left" id="question_left" /></th>

			<th>Q.Right <br /> <input type="checkbox" class="single_col" value="question_right" id="question_right" /></th>

			

			<th>R.Top <br /> <input type="checkbox" class="single_col" value="result_top" id="result_top" /></th>

			<th>R.Middle <br /> <input type="checkbox" class="single_col" value="result_middle" id="result_middle" /></th>

			<th>R.Middle2 <br /> <input type="checkbox" class="single_col" value="result_middle2" id="result_middle2" /></th>

			<th>R.Bottom <br /> <input type="checkbox" class="single_col" value="result_bottom" id="result_bottom" /></th>

			<th>R.Left <br /> <input type="checkbox" class="single_col" value="result_left" id="result_left" /></th>

			<th>R.Right <br /> <input type="checkbox" class="single_col" value="result_right" id="result_right" /></th>



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

					$test_middle2=true;

					$test_bottom=true;

					$test_left=true;

					$test_right=true;
					
					$knowledge_top=true;
					$knowledge_middle=true;
					$knowledge_bottom=true;
					
					$twist_top=true;
					$twist_middle=true;
					$twist_bottom=true;

					$question_top=true;

					$question_top2=true;

					$question_middle=true;

					$question_bottom=true;

					$question_bottom2=true;

					$question_left=true;

					$question_right=true;

					$result_top=true;

					$result_middle=true;

					$result_middle2=true;

					$result_bottom=true;

					$result_left=true;

					$result_right=true;

					
					$ids=array();
					foreach($test_list as $row)

					{ //echo "<pre>"; print_r($row);exit;
						
						
						$ids[]=$row->tests_id;
						$i++;

						

						/*$config_info['test_id']=$row->tests_id;

						$config_info['test_top']=1;

						$config_info['test_middle']=1;

						$config_info['test_bottom']=1;

						$config_info['test_left']=1;

						$config_info['test_right']=1;

						$config_info['question_top']=1;

						$config_info['question_middle']=1;

						$config_info['question_bottom']=1;

						$config_info['question_left']=1;

						$config_info['question_right']=1;

						$config_info['result_top']=1;

						$config_info['result_middle']=1;

						$config_info['result_middle2']=1;

						$config_info['result_bottom']=1;

						$config_info['result_left']=1;

						$config_info['result_right']=1;

						$this->db->insert('tests_ad_config',$config_info);*/

						$all_cheched=true;

						if($row->test_top == 0) $all_cheched=false;

						else if($row->test_middle == 0) $all_cheched=false;

						else if($row->test_middle2 == 0) $all_cheched=false;

						else if($row->test_bottom == 0) $all_cheched=false;

						else if($row->test_left == 0) $all_cheched=false;

						else if($row->test_right == 0) $all_cheched=false;
						
						
						else if($row->knowledge_top == 0) $all_cheched=false;
						else if($row->knowledge_middle == 0) $all_cheched=false;
						else if($row->knowledge_bottom == 0) $all_cheched=false;

						else if($row->twist_top == 0) $all_cheched=false;
						else if($row->twist_middle == 0) $all_cheched=false;
						else if($row->twist_bottom == 0) $all_cheched=false;

						

						else if($row->question_top == 0 && $row->question_top2 == 0) $all_cheched=false;

						//else if($row->question_top2 == 0) $all_cheched=false;

						else if($row->question_middle == 0) $all_cheched=false;

						else if($row->question_bottom == 0) $all_cheched=false;

						else if($row->question_bottom2 == 0) $all_cheched=false;

						else if($row->question_left == 0) $all_cheched=false;

						else if($row->question_right == 0) $all_cheched=false;

						

						else if($row->result_top == 0) $all_cheched=false;

						else if($row->result_middle == 0) $all_cheched=false;

						else if($row->result_middle2 == 0) $all_cheched=false;

						else if($row->result_bottom == 0) $all_cheched=false;

						else if($row->result_left == 0) $all_cheched=false;

						else if($row->result_right == 0) $all_cheched=false;

						

						

						

						

						if($row->test_top == 0) $test_top=false;

						//echo $test_top; echo "<br>";

						if($row->test_middle == 0) $test_middle=false;

						

						if($row->test_middle2 == 0) $test_middle2=false;

						

						if($row->test_bottom == 0) $test_bottom=false;

						

						if($row->test_left == 0) $test_left=false;
						
						
						if($row->knowledge_top == 0) $knowledge_top=false;
						if($row->knowledge_middle == 0) $knowledge_middle=false;
						if($row->knowledge_bottom == 0) $knowledge_bottom=false;
						
						if($row->twist_top == 0) $twist_top=false;
						if($row->twist_middle == 0) $twist_middle=false;
						if($row->twist_bottom == 0) $twist_bottom=false;

						if($row->test_right == 0) $test_right=false;

						

						if($row->question_top == 0) $question_top=false;

						

						if($row->question_top2 == 0) $question_top2=false;

						

						if($row->question_middle == 0) $question_middle=false;

						

						if($row->question_bottom == 0) $question_bottom=false;

						

						if($row->question_bottom2 == 0) $question_bottom2=false;

						

						if($row->question_left == 0) $question_left=false;

						

						if($row->question_right == 0) $question_right=false;

						

						if($row->result_top == 0) $result_top=false;

						

						if($row->result_middle == 0) $result_middle=false;

						

						if($row->result_middle2 == 0) $result_middle2=false;

						

						if($row->result_bottom == 0) $result_bottom=false;

						

						if($row->result_left == 0) $result_left=false;

						

						if($row->result_right == 0) $result_right=false;

						



					?>

					<tr>

						<td data-title="No"><input type="hidden" name="tests[]" value="<?php echo $row->tests_id;?>" /><input <?php if($all_cheched) echo 'checked="checked"';?>  type="checkbox" class="single_test"   id="test_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" /></td>

						<td data-title="Test Title"><?php echo $row->title;?></td>

						

						<td><input class="individual" type="checkbox"  id="t.top_<?php echo $row->tests_id;?>" name="test_top_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_top == 1) echo 'checked="checked"';?> /></td>

						<td><input class="individual" type="checkbox"  id="t.mid_<?php echo $row->tests_id;?>" name="test_middle_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_middle == 1) echo 'checked="checked"';?> /></td>

						<td><input class="individual" type="checkbox"  id="t.mid2_<?php echo $row->tests_id;?>" name="test_middle2_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_middle2 == 1) echo 'checked="checked"';?> /></td>

						<td><input class="individual" type="checkbox"  id="t.bot_<?php echo $row->tests_id;?>" name="test_bottom_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_bottom == 1) echo 'checked="checked"';?> /></td>

						<td><input class="individual" type="checkbox"  id="t.left_<?php echo $row->tests_id;?>" name="test_left_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_left == 1) echo 'checked="checked"';?> /></td>

						<td><input class="individual" type="checkbox"  id="t.right_<?php echo $row->tests_id;?>" name="test_right_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_right == 1) echo 'checked="checked"';?> /></td>
						
						<td><input class="individual" type="checkbox"  id="k.top_<?php echo $row->tests_id;?>" name="knowledge_top_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->knowledge_top == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="k.middle_<?php echo $row->tests_id;?>" name="knowledge_middle_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->knowledge_middle == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="k.bottom_<?php echo $row->tests_id;?>" name="knowledge_bottom_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->knowledge_bottom == 1) echo 'checked="checked"';?> /></td>
						
						<td><input class="individual" type="checkbox"  id="tw.top_<?php echo $row->tests_id;?>" name="twist_top_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->twist_top == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="tw.middle_<?php echo $row->tests_id;?>" name="twist_middle_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->twist_middle == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="tw.bottom_<?php echo $row->tests_id;?>" name="twist_bottom_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->twist_bottom == 1) echo 'checked="checked"';?> /></td>
						

						

						<td><input class="individual question_top" type="checkbox"  id="qtop_<?php echo $row->tests_id;?>" name="question_top_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->question_top == 1) echo 'checked="checked"';?> /></td>

						<td><input class="individual question_top2" type="checkbox"  id="qtop2_<?php echo $row->tests_id;?>" name="question_top2_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->question_top2 == 1) echo 'checked="checked"';?> /></td>

						

						<td><input class="individual" type="checkbox"  id="q.mid_<?php echo $row->tests_id;?>" name="question_middle_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->question_middle == 1) echo 'checked="checked"';?> /></td>

						<td><input class="individual" type="checkbox"  id="q.bot_<?php echo $row->tests_id;?>" name="question_bottom_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->question_bottom == 1) echo 'checked="checked"';?> /></td>

						<td><input class="individual" type="checkbox"  id="q.bot2_<?php echo $row->tests_id;?>" name="question_bottom2_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->question_bottom2 == 1) echo 'checked="checked"';?> /></td>

						

						<td><input class="individual" type="checkbox"  id="q.left_<?php echo $row->tests_id;?>" name="question_left_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->question_left == 1) echo 'checked="checked"';?> /></td>

						<td><input class="individual" type="checkbox"  id="q.right_<?php echo $row->tests_id;?>" name="question_right_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->question_right == 1) echo 'checked="checked"';?> /></td>

						

						<td><input class="individual" type="checkbox"  id="r.top_<?php echo $row->tests_id;?>" name="result_top_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->result_top == 1) echo 'checked="checked"';?> /></td>

						<td><input class="individual" type="checkbox"  id="r.mid_<?php echo $row->tests_id;?>" name="result_middle_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->result_middle == 1) echo 'checked="checked"';?> /></td>

						<td><input class="individual" type="checkbox"  id="r.mid2_<?php echo $row->tests_id;?>" name="result_middle2_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->result_middle2 == 1) echo 'checked="checked"';?> /></td>

						<td><input class="individual" type="checkbox"  id="r.bot_<?php echo $row->tests_id;?>" name="result_bottom_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->result_bottom == 1) echo 'checked="checked"';?> /></td>

						<td><input class="individual" type="checkbox"  id="r.left_<?php echo $row->tests_id;?>" name="result_left_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->result_left == 1) echo 'checked="checked"';?> /></td>

						<td><input class="individual" type="checkbox"  id="r.right_<?php echo $row->tests_id;?>" name="result_right_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->result_right == 1) echo 'checked="checked"';?> /></td>

						

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

		//alert(<?php echo $test_top;?>);

		<?php if($test_top) { ?> $('#test_top').attr('checked','checked');<?php } ?>

		<?php if($test_middle) { ?>$('#test_middle').attr('checked','checked');<?php } ?>

		<?php if($test_middle2) { ?>$('#test_middle2').attr('checked','checked');<?php } ?>

		<?php if($test_bottom) { ?>$('#test_bottom').attr('checked','checked');<?php } ?>

		<?php if($test_left) { ?>$('#test_left').attr('checked','checked');<?php } ?>

		<?php if($test_right) { ?>$('#test_right').attr('checked','checked');<?php } ?>

		
		<?php if($knowledge_top) { ?>$('#knowledge_top').attr('checked','checked');<?php } ?>
		<?php if($knowledge_middle) { ?>$('#knowledge_middle').attr('checked','checked');<?php } ?>
		<?php if($knowledge_bottom) { ?>$('#knowledge_bottom').attr('checked','checked');<?php } ?>
		
		<?php if($twist_top) { ?>$('#twist_top').attr('checked','checked');<?php } ?>
		<?php if($twist_middle) { ?>$('#twist_middle').attr('checked','checked');<?php } ?>
		<?php if($twist_bottom) { ?>$('#twist_bottom').attr('checked','checked');<?php } ?>
		

		<?php if($question_top) { ?>$('#question_top').attr('checked','checked');<?php } ?>

		<?php if($question_top2) { ?>$('#question_top2').attr('checked','checked');<?php } ?>

		<?php if($question_middle) { ?>$('#question_middle').attr('checked','checked');<?php } ?>

		<?php if($question_bottom) { ?>$('#question_bottom').attr('checked','checked');<?php } ?>

		<?php if($question_bottom2) { ?>$('#question_bottom2').attr('checked','checked');<?php } ?>

		<?php if($question_left) { ?>$('#question_left').attr('checked','checked');<?php } ?>

		<?php if($question_right) { ?>$('#question_right').attr('checked','checked');<?php } ?>

		

		<?php if($result_top) { ?>$('#result_top').attr('checked','checked');<?php } ?>

		<?php if($result_middle) { ?>$('#result_middle').attr('checked','checked');<?php } ?>

		<?php if($result_middle2) { ?>$('#result_middle2').attr('checked','checked');<?php } ?>

		<?php if($result_bottom) { ?>$('#result_bottom').attr('checked','checked');<?php } ?>

		<?php if($result_left) { ?>$('#result_left').attr('checked','checked');<?php } ?>

		<?php if($result_right) { ?>$('#result_right').attr('checked','checked');<?php } ?>

		

		

		

		

		

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

			var overlay = $('<div id="overlay"><div id="indicator"><img src="<?php echo base_url();?>assets/img/ajax-loader.gif" /></div> </div>');

			overlay.appendTo(document.body);

			if(this.checked)

			{

				var url="<?php echo site_url();?>admin/tests/test_ad_config_all_test";

				$.post(url,{col_name:col_name,value:'yes',ele_id:ele_id},function(data) {

					$('#overlay').remove();

					$('#config_container').html(data);

				});

			}

			else

			{

				var url="<?php echo site_url();?>admin/tests/test_ad_config_all_test";

				$.post(url,{col_name:col_name,value:'no',ele_id:0},function(data) {

					$('#overlay').remove();

					$('#config_container').html(data);

				});

			}

		});

		

		

		$(document).on('click','.question_top',function() {

			var test_id=$(this).val();

			if(this.checked)

			{

				$("#qtop2_"+test_id).prop('checked',false);

			}

			

		});

		

		$(document).on('click','.question_top2',function() {

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