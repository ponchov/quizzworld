
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
		<a href="<?php echo site_url();?>admin/users/add"><button class="btn pull-right btn-primary" type="button">+Add new</button></a>
	</div>

	<div class="clear_space" style="height:10px;"></div>
	<div class="row">
	<table id="mytable" class="table table-striped table-hover table-fixed-header"> 
		<thead class="header">
			<tr>
			<th> # </th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>User Type</th>
			<th>Telephone</th>
			<th>Username</th>
			<th>Email</th>
			<th> Action </th>
			</tr>
		</thead>
		<tbody>
			<?php
				if($user_list)
				{	
					$i=0;
					foreach($user_list as $row)
					{
						$i++;
					?>
					<tr>
						<td data-title="No"><?php echo $i; ?> </td>
						<td data-title="First Name"><?php echo $row->first_name;?> </td>
						<td data-title="Last Name"><?php echo $row->last_name;?> </td>
						<td data-title="User Type"><?php if($row->user_type == 1) echo "Admin"; else if($row->user_type == 2) echo "Operator"; else if($row->user_type == 3) echo "Editor"; else if($row->user_type == 4) echo "Graphics Designer";?></td>
						<td data-title="Telephone"><?php echo $row->telephone;?></td>
						<td data-title="Username"><?php echo $row->username;?></td>	
						<td data-title="Email"><?php echo $row->email;?></td>						

						<?php /*?><td data-title="Status">
							<?php 
								if($row->status == 1) echo "Active"; else echo "Inactive";
							?>
						</td><?php */?>
						<td data-title="Action">
							<a href="<?php echo site_url();?>admin/users/edit/<?php echo $row->userid;?>">Edit</a> &nbsp; &nbsp;							
							<a onclick="javascript: return confirm('Are you sure to delete this?')" href="<?php echo site_url();?>admin/users/delete/<?php echo $row->userid;?>"> Delete</a>  &nbsp; &nbsp;
							
						</td>
						
					</tr>
					<?php
					}
				}
			?>
		</tbody>
	</table>

</div>

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