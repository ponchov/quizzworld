
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




<script language="javascript">

	$(document).ready(function() {
		//alert(<?php echo $test_top;?>);
		<?php if($test_top) { ?> $('#test_top').attr('checked','checked');<?php } ?>
		<?php if($test_middle) { ?>$('#test_middle').attr('checked','checked');<?php } ?>
		<?php if($test_bottom) { ?>$('#test_bottom').attr('checked','checked');<?php } ?>
		<?php if($sidebar_1) { ?>$('#sidebar_1').attr('checked','checked');<?php } ?>
		<?php if($sidebar_2) { ?>$('#sidebar_2').attr('checked','checked');<?php } ?>
		<?php if($question_bottom) { ?>$('#question_bottom').attr('checked','checked');<?php } ?>
		<?php if($question_top) { ?>$('#question_top').attr('checked','checked');<?php } ?>
		
		
		<?php if($result_top) { ?>$('#result_top').attr('checked','checked');<?php } ?>
		<?php if($result_middle) { ?>$('#result_middle').attr('checked','checked');<?php } ?>
		<?php if($result_bottom) { ?>$('#result_bottom').attr('checked','checked');<?php } ?>
		<?php if($result_left) { ?>$('#result_left').attr('checked','checked');<?php } ?>
		<?php if($result_right) { ?>$('#result_right').attr('checked','checked');<?php } ?>
		<?php if($question_top2) { ?>$('#question_top2').attr('checked','checked');<?php } ?>
		<?php if($question_bottom2) { ?>$('#question_bottom2').attr('checked','checked');<?php } ?>

	});

</script>





  


 