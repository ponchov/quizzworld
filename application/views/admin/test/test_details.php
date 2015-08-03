 <link href="<?php echo base_url();?>assets/css//ekko-lightbox.css" rel="stylesheet">

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

<?php 

	

	$questions_list=$this->test_model->get_questions($test_info->testid,$lang_code);

	

	//echo "<pre>";

	//print_r($questions_list);



?>





<div class="row test_detais">

	<div class="col-sm-5"><b><?php echo $test_info->title; ?></b></div>

	<div class="col-sm-3">

		<?php

		if($test_info->image)

		{

		?>

		<a href="<?php echo base_url(); ?>assets/img/image/<?php echo $test_info->image; ?>" data-toggle="lightbox">

			<img src="<?php echo base_url(); ?>assets/img/image/<?php echo $test_info->image; ?>" height="100" width="150"/>

		</a>

		<?php

		}

		?>

	</div>

	<?php if($this->session->userdata('user_type') ==4 ) { ?>

		<div class="col-sm-2"><a href="<?php echo site_url();?>admin/tests/graphic_edit/<?php echo $test_info->testid; ?>/<?php echo $lang_code; ?>/details/#image" class="btn btn-success"><?php if($test_info->image) echo "Edit"; else echo "Add";?> main image</a></div>

	<?php } else { ?>

	<div class="col-sm-2"><a href="<?php echo site_url();?>admin/tests/test_edit/<?php echo $test_info->testid; ?>/<?php echo $lang_code; ?>/details/#image" class="btn btn-success"><?php if($test_info->image) echo "Edit"; else echo "Add";?> main image</a></div>

	<?php } ?>

	<?php if($this->session->userdata('user_type') !=4 ) { ?><div class="col-sm-2"><a href="<?php echo site_url(); ?>admin/tests/test_edit/<?php echo $test_info->testid; ?>/<?php echo $lang_code; ?>/details" target="_blank" class="btn btn-primary">Edit</a></div><?php } ?>

</div>

	<?php

		$questions_list=$this->test_model->get_questions($test_info->testid,$lang_code);

		if($questions_list)

		{

			$j=0;

			foreach($questions_list as $questions)

			{

			$j++;

			$answer_list=$this->test_model->get_answers($questions->test_questionid,$lang_code)

			?>

				<div class="row test_detais">

					<div class="col-sm-9 col-sm-offset-1"><b><?php echo $j;?>.</b> <?php echo $questions->question; ?></div>

					<?php if($this->session->userdata('user_type') !=4 ) { ?><div class="col-sm-2"><a href="<?php echo site_url(); ?>admin/tests/question_edit/<?php echo $questions->test_questionid; ?>/<?php echo $test_info->testid; ?>/<?php echo $lang_code; ?>/details" target="_blank" class="btn btn-primary">Edit</a></div><?php } ?>

				</div>

				<div class="row test_detais">

					<div class="col-sm-2">

						<?php if($test_info->is_real_test == 1 ) { ?>

							<?php if($this->session->userdata('user_type') ==4 ) { ?>

								<a href="<?php echo site_url();?>admin/tests/graphic_question_edit/<?php echo $questions->test_questionid; ?>/<?php echo $test_info->testid; ?>/<?php echo $lang_code; ?>/details/" class="btn btn-success"><?php if($questions->image) echo "Edit"; else echo "Add";?> image</a>

							<?php } else { ?>

								<a href="<?php echo site_url();?>admin/tests/question_edit/<?php echo $questions->test_questionid; ?>/<?php echo $test_info->testid; ?>/<?php echo $lang_code; ?>/details" class="btn btn-success"><?php if($questions->image) echo "Edit"; else echo "Add";?> image</a>

							<?php } ?>

							<?php

							if($questions->image)

							{

							?>

							<br /> <br />

							<a href="<?php echo base_url(); ?>assets/img/image/<?php echo $questions->image; ?>" data-toggle="lightbox">

								<img src="<?php echo base_url(); ?>assets/img/image/<?php echo $questions->image; ?>" height="100" width="150"/>

							</a>

							<?php 

							}

							?>

						<?php } ?>

					</div>

					

					<div class="col-sm-10">

					

					<?php

						if($answer_list)

						{

							$i=0;

							foreach($answer_list as $answer)

							{

								$i++;

								?>

								<div class="col-sm-7"><?php echo $answer->answere; ?></div>

								<div class="col-sm-3">Marks: <?php echo $answer->marks; ?></div>

								<?php if($this->session->userdata('user_type') !=4 ) { ?><div class="col-sm-2 test_detais"><a href="<?php echo site_url(); ?>admin/tests/answer_edit/<?php echo $answer->answereid; ?>/<?php echo $questions->test_questionid; ?>/<?php echo $lang_code; ?>/details" target="_blank" class="btn btn-primary">Edit</a></div><?php } ?>

								<?php

							}

						}

					?>

						

				   </div>

				</div>

			<?php 

			}

		}

		

	?>

	

	<?php if($test_info->is_real_test == 0) { ?>

	<div class="row">

		<div class="col-xs-6 col-sm-6 col-md-6">

			<div id="result_text_labal">Result Text : </div>

			<div id="result_text">  

				<?php 				

					 $result=str_replace("</h2>",'/',trim($test_info->result_text));

					 $result=explode('/',$result);

					 echo $result['0'];

				?>

			</div>

		</div>

		<div class="col-xs-6 col-sm-6 col-md-6 text-right">

			<?php if($this->session->userdata('user_type') !=4 ) { ?>

				<a class="btn btn-primary add_result_text_btn" href="<?php echo site_url(); ?>admin/tests/test_edit/<?php echo $test_info->testid; ?>/<?php echo $lang_code; ?>/details">Add Result Text</a>

			<?php } ?>

		</div>

	</div>

	<?php } ?>

	

	<div class="row">

		<table id="no-more-tables" class="table table-striped table-hover">

		<thead>

			<tr>

				<th>Result</th>

				<th>Interval Start</th>

				<th>Interval To</th>

				<?php if($this->session->userdata('user_type') !=4 ) { ?><th>Action</th><?php } ?>

			</tr>

		</thead>

		<tbody>

		<?php 

			$resutl_list=$this->test_model->get_result_options($test_info->testid,$lang_code);

			if($resutl_list)

			{

				foreach($resutl_list as $resutl)

				{

				?>

					 <tr>

					 	<td>
							<b><?php echo $resutl->result; ?></b>
							<p><?php echo $resutl->result_description; ?></p>
							<?php
								if($resutl->test_result_img)
								{
									?>
									<img src="<?php echo base_url();?>assets/img/test_result_img/<?php echo $resutl->test_result_img;?>" height="150" />
									<?php
								}
							?>
						</td>

						<td><?php echo $resutl->interval_from; ?></td>

						<td><?php echo $resutl->interval_to; ?></td>

						<?php if($this->session->userdata('user_type') !=4 ) { ?><td><a href="<?php echo site_url(); ?>admin/tests/result_option_edit/<?php echo $resutl->result_optionid; ?>/<?php echo $test_info->testid; ?>/<?php echo $lang_code; ?>/details" target="_blank" class="btn btn-primary">Edit</a></td><?php } ?>

						

					 </tr>

					

				<?php 

				}

			}

		?>

		<tbody>

		</table>

		<?php if($this->session->userdata('user_type') == 4 ) { ?>

		<form action="<?php echo site_url(); ?>admin/tests/all_image_added" method="post">

			<input type="checkbox" name="all_image_added" id="all_image_added" value="1" <?php if($test_info->all_image_added) echo 'checked="checked"'; ?>   /> All Image Added

			<input type="hidden" name="add_image" value="add_image"  />

			<input type="hidden" name="test_id" value="<?php echo $test_info->tests_id?>"  />

			<input class="btn btn-primary" type="submit" value="Save"  /> 

		</form>

		<?php } ?>

		

		<?php if($this->session->userdata('user_type') == 3 ) { ?>

		<form action="<?php echo site_url(); ?>admin/tests/all_content_ready" method="post">

			<input type="checkbox" name="all_content_ready" id="all_content_ready" value="1" <?php if($test_info->all_content_ready) echo 'checked="checked"'; ?>   /> All Content Ready

			<input type="hidden" name="content_ready" value="content_ready"  />

			<input type="hidden" name="test_id" value="<?php echo $test_info->tests_id; ?>"  />

			<input class="btn btn-primary" type="submit" value="Save"  /> 

		</form>

		<?php } ?>

		

	</div>

	



 <script src="<?php echo base_url();?>assets/js/ekko-lightbox.js"></script>



<style type="text/css">

	.test_detais

	{

		margin-bottom:10px;

	}

	#result_text

	{

		float:left;

	}

	#result_text h2

	{

		margin:0;

		padding-left:5px;

	}

	.add_result_text_btn

	{

		font-size:20px;

	}

	

	#result_text_labal

	{

		float:left;

		font-size:16px;

		font-weight:bold;

		padding-top:5px;

	}



</style>



<script type="text/javascript">

	$(document).ready(function ($) {



		// delegate calls to data-toggle="lightbox"

		$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {

			event.preventDefault();

			return $(this).ekkoLightbox({

				onShown: function() {

					if (window.console) {

						return console.log('Checking our the events huh?');

					}

				}

			});

		});





	});

</script>