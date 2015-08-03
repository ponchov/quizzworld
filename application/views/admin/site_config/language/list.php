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
	



	<div class="clear_space" style="height:10px;"></div>
	<div class="row">

	<table id="mytable" class="table table-striped table-hover table-fixed-header"> 
		<thead class="header">
			<tr>
			<th>S.NO </th>
			<th>Language Name</th>
			<th>Language Code</th>
			<th> Action </th>
			</tr>
		</thead>

		<tbody>

			<?php
				if($language_list)
				{	
					$i=0;
					foreach($language_list as $row)
					{
						$i++;
					?>

					<tr>
						<td data-title="No"><?php echo $i; ?> </td>
						<td data-title="First Name"><?php echo ucfirst($row->language_name);?> </td>
						<td data-title="Last Name"><?php echo $row->language_code;?> </td>
						<td data-title="Action">
							<?php 
								if($this->session->userdata('access_language')) $access_language=explode(',',$this->session->userdata('access_language'));
								else $access_language=array();								

								if($language_list)
								{
									foreach($language_list as $language)
									{
										$language_content=$this->site_config_model->get_language($row->language_id, $language->language_code);
										if($language_content) $label_class="label-info"; else $label_class="label-default";
										
										if(in_array($language->language_code,$access_language))
										{
									?>																						
										 <a class="language_level" href="<?php echo site_url(); ?>admin/site_config/language_translate/<?php echo $row->language_id; ?>/<?php echo $language->language_code; ?>"><span class="label <?php echo $label_class; ?>"><?php echo $language->language_code; ?></span></a>
										&nbsp;
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



