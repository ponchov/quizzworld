
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


					
					$ids=array();
					foreach($test_list as $row)

					{ //echo "<pre>"; print_r($row);exit;
						$ids[]=$row->tests_id;
						$i++;
						$all_cheched=true;
						if($row->test_top == 0) $all_cheched=false;
						else if($row->test_middle == 0) $all_cheched=false;
						else if($row->test_middle2 == 0) $all_cheched=false;
						else if($row->test_bottom == 0) $all_cheched=false;
						
						
						if($row->test_top == 0) $test_top=false;
						if($row->test_middle == 0) $test_middle=false;
						if($row->test_middle2 == 0) $test_middle2=false;
						if($row->test_bottom == 0) $test_bottom=false;

						

					?>

					<tr>
						<td data-title="No"><input type="hidden" name="tests[]" value="<?php echo $row->tests_id;?>" /><input <?php if($all_cheched) echo 'checked="checked"';?>  type="checkbox" class="single_test"   id="test_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" /></td>
						<td data-title="Test Title"><?php echo $row->title;?></td>
						<td><input class="individual" type="checkbox"  id="t.top_<?php echo $row->tests_id;?>" name="test_top_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_top == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="t.mid_<?php echo $row->tests_id;?>" name="test_middle_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_middle == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="t.mid2_<?php echo $row->tests_id;?>" name="test_middle2_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_middle2 == 1) echo 'checked="checked"';?> /></td>
						<td><input class="individual" type="checkbox"  id="t.bot_<?php echo $row->tests_id;?>" name="test_bottom_<?php echo $row->tests_id;?>" value="<?php echo $row->tests_id;?>" <?php if($row->test_bottom == 1) echo 'checked="checked"';?> /></td>

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
		<?php if($test_middle2) { ?>$('#test_middle2').attr('checked','checked');<?php } ?>
		<?php if($test_bottom) { ?>$('#test_bottom').attr('checked','checked');<?php } ?>

	});

</script>





  


 