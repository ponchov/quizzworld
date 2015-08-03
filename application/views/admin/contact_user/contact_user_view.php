
<table class="table table-striped table-hover">
	<tr>
		<th style="width:30%;">Name :</th>
		<td><?php echo $contact_user_info->name;?></td>
	</tr>
	

	
	<tr>
		<th style="width:30%;">Email :</th>
		<td><?php echo $contact_user_info->email;?></td>
	</tr>

	<tr>
		<th style="width:30%;">Comments :</th>
		<td><?php echo nl2br($contact_user_info->comments);?></td>
	</tr>
</table>
