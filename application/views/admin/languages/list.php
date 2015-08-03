
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
		<a href="<?php echo site_url();?>admin/languages/add"><button class="btn pull-right btn-primary" type="button">+Add new</button></a>
	</div>

	<div class="clear_space" style="height:10px;"></div>
	<div class="row">
	<table id="no-more-tables" class="table table-striped table-hover"> 
		<thead>
			<tr>
			<th> # </th>
			<th>Language Name</th>
			<th>Language Code</th>
			<th>Status</th>
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
						<td data-title="Language Name"><?php echo $row->language_name;?></td>
						<td data-title="Language Code"><?php echo $row->language_code;?></td>	
						<td data-title="Status"><?php if($row->status == 1) echo "Active"; else echo "Inactive"; ?></td>					
						<td data-title="Action">
							<a href="<?php echo site_url();?>admin/languages/edit/<?php echo $row->language_id;?>"><span title="Edit" class="glyphicon glyphicon-pencil"></span> Edit</a> &nbsp; &nbsp;
							<a onclick="javascript: return confirm('Are you sure to delete this?')" href="<?php echo site_url();?>admin/languages/delete/<?php echo $row->language_id;?>"> <span title="Edit" class="glyphicon glyphicon-trash"></span> Delete</a>  &nbsp; &nbsp;
							
						</td>
						
					</tr>
					<?php
					}
				}
			?>
		</tbody>
	</table>

</div>

