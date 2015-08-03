

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
	<div class="col-xs-9 col-md-10 col-sm-10 text-right">

			<?php
				
				if($this->session->userdata('access_language')) $access_language=explode(',',$this->session->userdata('access_language'));
				else $access_language=array();				
				 
				if($lang == '') $label_all="label-info"; else $label_all="label-default";

				if($language_list)

				{
					foreach($language_list as $language)
					{
						if($lang == $language->language_code) $label_class="label-info"; else $label_class="label-default";
						
						if(in_array($language->language_code,$access_language))						
						{
						?>
							<a href="<?php echo site_url();?>admin/categories/index/<?php echo $language->language_code;?>"><span class="label <?php echo $label_class; ?>"><?php echo $language->language_code; ?></span></a>
						<?php
						} 
					}
				}

			?>

		</div>
	<div class="col-xs-3 col-md-2 col-sm-2">

		<a href="<?php echo site_url();?>admin/categories/category_add"><button class="btn pull-right btn-primary" type="button">+Add new</button></a>

	</div>



	<div class="clear_space" style="height:10px;"></div>

	<div class="row">

	<table id="no-more-tables" class="table table-striped table-hover"> 

		<thead>

			<tr>

			<th> # </th>

			<th>Category Name</th>
			<th>Section</th>

			<th>Description</th>

			<th> Status </th>

			<th class="col-sm-5"> Action </th>

			</tr>

		</thead>

		<tbody>

			<?php

				if($category_list)

				{	

					$i=0;

					foreach($category_list as $row)

					{

						$i++;

					?>

					<tr>

						<td data-title="No"><?php echo $i; ?> </td>

						<td data-title="Category Name"><?php echo $row->category_name;?></td>	
						<td data-title="Category Name"><?php echo ucfirst($row->post_type);?></td>					

						<td data-title="Category Notes"><?php echo $row->description;?></td>

						<td data-title="Status">

							<?php 

								if($row->status == 1) echo "Active"; else echo "Inactive";

							?>

						</td>

						<td data-title="Action">

							<a href="<?php echo site_url();?>admin/categories/category_edit/<?php echo $row->category_id;?>"> <span class="glyphicon glyphicon-pencil"></span> Edit</a> &nbsp; &nbsp;

							<a onclick="javascript: return confirm('Are you sure to delete this?')" href="<?php echo site_url();?>admin/categories/category_delete/<?php echo $row->category_id;?>"> <span class="glyphicon glyphicon-trash"></span> Delete</a>  &nbsp; &nbsp;

							<?php 


									echo "&nbsp;";

									if($language_list)

									{

										foreach($language_list as $language)

										{

											$language_content=$this->category_model->get_category_content($row->categoryid, $language->language_code);

											if($language_content) $label_class="label-info"; else $label_class="label-default";
											if(in_array($language->language_code,$access_language))	
											{

											?>
	
												&nbsp; <a href="<?php echo site_url();?>admin/categories/category_content/<?php echo $row->categoryid;?>/<?php echo $language->language_code;?>"><span class="label <?php echo $label_class; ?>"><?php echo $language->language_code; ?></span></a>
	
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



