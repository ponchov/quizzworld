

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

		<div class="col-xs-9 col-md-10 col-sm-10 text-right">

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
							<a href="<?php echo site_url();?>admin/tests/questions/<?php echo $test_id; ?>/<?php echo $language->language_code;?>"><span class="label <?php echo $label_class; ?>"><?php echo $language->language_code; ?></span></a>
						<?php
						} 
					}
				}

			?>

		</div>

		<div class="col-xs-3 col-md-2 col-sm-2">

		<?php 		
			//echo $lang;
			if($lang=='') $lan='en'; else $lan=$lang;
			
		 ?>		 
		<?php if($lan == 'en') { ?>
		 <a href="<?php echo site_url();?>admin/tests/add_question/<?php echo $test_id; ?>/<?php echo $lan; ?>"><button class="btn pull-right btn-primary" type="button">+Add new</button></a>
		<?php } ?>
		<?php /*?><a href="<?php echo site_url();?>admin/tests/add_question/<?php echo $test_id; ?>/en"><button class="btn pull-right btn-primary" type="button">+Add new</button></a><?php */?>
		</div>

	</div>



	<div class="clear_space" style="height:10px;"></div>

	<div class="row">

	<table id="no-more-tables" class="table table-striped table-hover"> 

		<thead>

			<tr>

			<th> # </th>

			<th>Test</th>			

			<th>Question</th>

			<th> Status </th>

			<th class="col-sm-5"> Action </th>

			</tr>

		</thead>

		<tbody>

			<?php
				/*echo "<pre>";
				print_r($question_list);*/
				if($question_list)

				{	

					$i=0;

					foreach($question_list as $row)

					{

						$i++;

					?>

					<tr>

						<td data-title="No"><?php echo $i; ?> </td>

						<td data-title="Test Title"><?php echo $row->title;?></td>											

						<td data-title="Answere"><?php echo $row->question;?></td>

						<td data-title="Status">

							<?php 

								if($row->status == 1) echo "Active"; else echo "Inactive";

							?>

						</td>

						<td data-title="Action">							

							<a href="<?php echo site_url();?>admin/tests/question_edit/<?php echo $row->test_questionid;?>/<?php echo $test_id; ?>/<?php echo $lan; ?>">Edit</a> &nbsp; &nbsp;

							<a href="<?php echo site_url();?>admin/tests/answers/<?php echo $row->test_questionid;?>/<?php echo $lan; ?>">Answers</a> &nbsp; &nbsp;							

							<a onclick="javascript: return confirm('Are you sure to delete this?')" href="<?php echo site_url();?>admin/tests/question_delete/<?php echo $row->test_question_id;?>/<?php echo $test_id; ?>/<?php echo $lan; ?>"> Delete</a>  &nbsp; &nbsp;

							<?php 
								

										if($language_list)
										{
											foreach($language_list as $language)
											{
												$language_content=$this->test_model->get_queston_content($row->test_questionid, $language->language_code);
												//echo $lan;
												if($language_content) $label_class="label-info"; else $label_class="label-default";
													if(in_array($language->language_code,$access_language) && in_array($language->language_code,$tests_languages))
													{
													?>
													&nbsp;&nbsp; <a href="<?php echo site_url();?>admin/tests/question_content/<?php echo $test_id; ?>/<?php echo $row->test_questionid;?>/<?php echo $language->language_code;?>"><span class="label <?php echo $label_class; ?>"><?php echo $language->language_code; ?></span></a>
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



