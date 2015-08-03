	<?php  
	if($this->session->flashdata('success_message'))
	{
	?>
		<div class="alert alert-success">  
		  <a class="close" data-dismiss="alert">x</a>  
		  <strong>Success!</strong><?php echo $this->session->flashdata('success_message');?>  
		</div> 
	<?php
	}

	?>

	<div class="row">
		<div class="col-xs-8 col-sm-10 col-md-10 text-right">
			<?php
				$tests_languages=$this->test_model->get_tests_languages($test_id);
				if($this->session->userdata('access_language')) $access_language=explode(',',$this->session->userdata('access_language'));
				else $access_language=array();
				
				if($lang == '') $label_all="label-info"; else $label_all="label-default";

				if($language_list)
				{

					foreach($language_list as $language)
					{

						if($lang == $language->language_code) $label_class="label-info"; else $label_class="label-default";
						
						if(in_array($language->language_code,$access_language) && in_array($language->language_code,$tests_languages))
						{
						?>

							<a href="<?php echo site_url();?>admin/tests/result_option/<?php echo $test_id; ?>/<?php echo $language->language_code;?>"><span class="label <?php echo $label_class; ?>"><?php echo $language->language_code; ?></span></a>

						<?php 
						}

					}

				}

				

			?>

			

		</div>

		<div class="col-xs-4 col-sm-2 col-md-2 text-right">
			<?php 		

			if($lang=='') $lan='all'; else $lan=$lang;
		 ?>	
		 	<?php if($lan == 'en' ) { ?>
			<a href="<?php echo site_url();?>admin/tests/add_result_option/<?php echo $test_id; ?>/<?php echo $lan; ?>"><button class="btn pull-right btn-primary" type="button">+Add new</button></a>
			<?php } ?>
		</div>

		

	</div>



	<div class="clear_space" style="height:10px;"></div>

	<div class="row">

	<table id="no-more-tables" class="table table-striped table-hover"> 

		<thead>

			<tr>

			<th> # </th>

			<th>Interval Start</th>			

			<th>Interval To</th>

			<th> Result </th>

			<th class="<?php if($lang == '') echo "col-sm-5"; ?>"> Action </th>

			</tr>

		</thead>

		<tbody>

			<?php

				if($result_options)

				{	

					$i=0;

					foreach($result_options as $row)

					{

						$i++;

					?>

					<tr>

						<td data-title="No"><?php echo $i; ?> </td>

						<td data-title="Test Title"><?php echo $row->interval_from;?></td>											

						<td data-title="Answere"><?php echo $row->interval_to;?></td>

						<td data-title="Answere"><?php echo $row->result;?></td>

						<td data-title="Action">

							<a href="<?php echo site_url();?>admin/tests/result_option_edit/<?php echo $row->result_optionid;?>/<?php echo $test_id; ?>/<?php echo $lan; ?>">Edit</a> &nbsp; &nbsp;

							<a onclick="javascript: return confirm('Are you sure to delete this?')" href="<?php echo site_url();?>admin/tests/result_option_delete/<?php echo $row->result_option_id;?>/<?php echo $test_id; ?>/<?php echo $lan; ?>"> Delete</a>  &nbsp; &nbsp;

							<?php 


										echo "&nbsp;";
										if($language_list)
										{
											foreach($language_list as $language)
											{
												$language_content=$this->test_model->get_result_content($row->result_optionid, $language->language_code);
												if($language_content) $label_class="label-info"; else $label_class="label-default";
												
												if(in_array($language->language_code,$access_language) && in_array($language->language_code,$tests_languages))
												{
												?>
												&nbsp; <a href="<?php echo site_url();?>admin/tests/result_content/<?php echo $row->result_optionid;?>/<?php echo $test_id; ?>/<?php echo $language->language_code;?>"><span class="label <?php echo $label_class; ?>"><?php echo $language->language_code; ?></span></a>
												<?php 
												}
											}
										}
									
 							?>

						</td>

						

					</tr>

					<?php

					}

				}

			?>

		</tbody>

	</table>



</div>



