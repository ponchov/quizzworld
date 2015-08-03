
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
	$status='';
	if(!empty($_GET['status']))
	{
		$status=$_GET['status'];
	}
	?>
	<div class="row">
		<a href="<?php echo site_url();?>admin/tests/real_test_add_wizard"><button class="btn pull-right btn-primary" type="button"  style="margin:0 10px;">+Add real test</button></a>
		<a href="<?php echo site_url();?>admin/tests/test_add_wizard"><button class="btn pull-right btn-primary" type="button"  style="margin:0 10px;">+Add new 2</button></a>
		<?php if($this->session->userdata('user_type') == 1) { ?><a href="<?php echo site_url();?>admin/tests/test_add"><button class="btn pull-right btn-primary" type="button">+Add new</button></a><?php  } ?>		
		<?php if($this->session->userdata('user_type') == 1 || $this->session->userdata('user_type') == 3) { ?><a  href="<?php echo site_url();?>admin/tests/index/?status=2"><button style="margin:0 10px;" class="btn pull-right  <?php if($status == 2) echo "btn-success"; ?>" type="button">Inactive</button></a>
		<a  href="<?php echo site_url();?>admin/tests/index/?status=1"><button class="btn pull-right  <?php if($status == 1) echo "btn-success"; ?>" type="button">Active</button></a><?php } ?>
		<a  href="<?php echo site_url();?>admin/tests/simple_list"><button style="margin:0 10px;" class="btn pull-right " type="button">Simple List</button></a>
	</div>

	<div class="clear_space" style="height:10px;"></div>
	<div class="row" id="test_container">
	<table id="mytable" class="table table-striped table-hover table-fixed-header"> 
		<thead class="header">
			<tr>
			<th> # </th>
			<th class="col-sm-3">Test Title</th>
			<!--<th>Page Title</th>-->
			<?php if($this->session->userdata('user_type') != 2) { ?><th>Category Name</th><?php } ?>
			<th>Author</th>
			<?php if($this->session->userdata('user_type') == 1) { ?><th>Default ads <br /> <input type="checkbox" class="single_col" value="default_ads" id="default_ads" /></th> <?php  } ?>
			<!--<th class="col-sm-3">Description</th>-->
			<!--<th>Result</th>-->
			<th> Status  <?php if($this->session->userdata('user_type') == 1) { ?><br /> &nbsp; &nbsp; <input type="checkbox" class="single_col" value="status" id="status" /><?php } ?></th>
			<?php if($this->session->userdata('user_type') == 1) { ?><th> Editor Access <br /> <input type="checkbox" class="single_col" value="editor_control" id="editor_control" /></th> <?php  } ?>
			<th> Action </th>
			</tr>
		</thead>
		<tbody>
			<?php
				if($test_list)
				{	
					$i=0;
					$editor_control=true;
					$default_ads=true;
					$status=true;
					
					foreach($test_list as $row)
					{
						$i++;
						if($row->editor_control == 2) $editor_control=false;
						if($row->default_ads == 2) $default_ads=false;
						if($row->status == 2) $status=false;
						
						
						$camera_color="#009933";
						if($row->image == '') $camera_color="#FF0000";
						$flag_icons=$this->test_model->gerenate_flag_icon($row->flags);
					?>
					<tr>
						<td data-title="No"><?php echo $i; ?> </td>
						<td data-title="Test Title"><?php echo $row->title;?></td>
						<?php /*?><td data-title="Page Title"><?php echo $row->page_title;?></td><?php */?>
						<?php if($this->session->userdata('user_type') != 2) { ?><td data-title="Category Name"><?php echo $row->category_name;?></td><?php } ?>
						<td data-title="Category Name"><a href="<?php echo site_url();?>admin/tests/index/?user_id=<?php echo $row->created_by;?>"><?php echo $row->first_name;?> <?php echo $row->last_name;?></a></td>
						<?php if($this->session->userdata('user_type') == 1) { ?>
						<td>
						<input type="checkbox" <?php if($row->default_ads == 1) echo 'checked="checked"';?>  class="default_ads" value="<?php echo $row->tests_id;?>" />
						 <?php  if($row->default_ads == 2) { ?>&nbsp; &nbsp; <a href="<?php echo site_url();?>admin/tests/ads_edit/<?php echo $row->tests_id;?>">Edit ads</a><?php } ?>
						 </td>	
						 <?php } ?>					
						<td data-title="Status" style="text-align:center;">
							<?php 
								if(!($this->session->userdata('user_type') == 1))
								{
								if($row->status == 1) echo "Active"; else echo "Inactive";
								}
								else
								{
								?>
								<input activated_date="<?php echo $row->activated_date;?>" test_image="<?php echo $row->image;?>" type="checkbox" class="status" <?php if($row->status == 1) echo 'checked="checked"';?>  value="<?php echo $row->tests_id;?>" />
								<?php 
								} 
								?>
						</td>
						<?php if($this->session->userdata('user_type') == 1) { ?><td><input type="checkbox" class="editor_control" <?php if($row->editor_control == 1) echo 'checked="checked"';?>  value="<?php echo $row->tests_id;?>" /></td><?php } ?>
						<td data-title="Action">
							<a href="<?php echo site_url();?>admin/tests/test_edit/<?php echo $row->tests_id;?>"><span title="Edit" class="glyphicon glyphicon-pencil"></span> </a> &nbsp; 
							<?php if($this->session->userdata('user_type') != 2) { ?><a href="<?php echo site_url();?><?php echo $row->alias;?>.html" target="_blank"><span title="View" class="glyphicon glyphicon-search"></span></a> &nbsp; <?php } ?>
							<a href="<?php echo site_url();?>admin/tests/test_details/<?php echo $row->tests_id;?>">Preview </a> &nbsp; 
							<a href="<?php echo site_url();?>admin/tests/result_option/<?php echo $row->tests_id;?>">Result</a> &nbsp; 
							<a href="<?php echo site_url();?>admin/tests/questions/<?php echo $row->tests_id;?>">Questions</a> &nbsp; 
							 
							<?php if($this->session->userdata('user_type') != 2) { ?><span class="glyphicon glyphicon-camera" style="color:<?php echo $camera_color;?>;"></span> &nbsp;  <?php } ?>
							<?php if($this->session->userdata('user_type') == 1) { ?>
							<a onclick="javascript: return confirm('Are you sure to delete this?')" href="<?php echo site_url();?>admin/tests/test_delete/<?php echo $row->tests_id;?>"> <span title="Delete" class="glyphicon glyphicon-trash"></span></a>  
							<?php } ?>
							<?php echo $flag_icons;?>
						</td>
						
					</tr>
					<?php
					}
				}
			?>
		</tbody>
	</table>

	</div>
<script language="javascript">
	$(document).ready(function() {
		
		<?php if($editor_control) { ?> $('#editor_control').attr('checked','checked');<?php } ?>
		<?php if($default_ads) { ?> $('#default_ads').attr('checked','checked');<?php } ?>
		<?php if($status) { ?> $('#status').attr('checked','checked');<?php } ?>
		
		$(document).on('click','.single_col',function() {
			var col_name=$(this).val();
			var ele_id=$(this).attr('id');
			var overlay = $('<div id="overlay"><div id="indicator"><img src="<?php echo base_url();?>assets/img/ajax-loader.gif" /></div> </div>');
			overlay.appendTo(document.body);
			if(this.checked)
			{
				var url="<?php echo site_url();?>admin/tests/save_test_col";
				$.post(url,{col_name:col_name,value:'1',ele_id:ele_id},function(data) {//alert(data);
					$('#overlay').remove();
					$('#test_container').html(data);
				});
			}
			else
			{
				var url="<?php echo site_url();?>admin/tests/save_test_col";
				$.post(url,{col_name:col_name,value:'2',ele_id:0},function(data) {
					$('#overlay').remove();
					$('#test_container').html(data);
				});
			}
		});
		
		
		
		$(document).on('click','.status',function() {
			var overlay = $('<div id="overlay"><div id="indicator"><img src="<?php echo base_url();?>assets/img/ajax-loader.gif" /></div> </div>');
			overlay.appendTo(document.body);
			
			
			var test_id=$(this).val();
			var activated_date=$(this).attr('activated_date');
			//alert(activated_date);

			
			
			var url="<?php echo site_url();?>admin/tests/change_test_status";
			<?php
				if(!empty($_GET['status']))
				{
				?>
				var url="<?php echo site_url();?>admin/tests/change_test_status/?status=<?php echo $_GET['status'];?>";
				<?php
				}
			?>
			
			if(this.checked)
			{//alert(url);
				var test_image=$(this).attr('test_image');
				if(test_image == '')
				{
					alert("Please add image before active this test");
					$('#overlay').remove();
					return false;
				} 
				
				$.post(url,{test_id:test_id,option:1,activated_date:activated_date},function(data) {
					$('#overlay').remove();
					$('#test_container').html(data);
					//alert(data);
				});
			}
			else
			{
				$.post(url,{test_id:test_id,option:2},function(data) {
					$('#overlay').remove();
					$('#test_container').html(data);
				});
			}
		});
		
		
		$(document).on('click','.editor_control',function() {
			var overlay = $('<div id="overlay"><div id="indicator"><img src="<?php echo base_url();?>assets/img/ajax-loader.gif" /></div> </div>');
			overlay.appendTo(document.body);
			
			
			var test_id=$(this).val();
			
			
			var url="<?php echo site_url();?>admin/tests/set_editor_control";
			<?php
				if(!empty($_GET['status']))
				{
				?>
				var url="<?php echo site_url();?>admin/tests/set_editor_control/?status=<?php echo $_GET['status'];?>";
				<?php
				}
			?>
			
			if(this.checked)
			{//alert(url);
				
				$.post(url,{test_id:test_id,option:1},function(data) {
					$('#overlay').remove();
					$('#test_container').html(data);
					//alert(data);
				});
			}
			else
			{
				$.post(url,{test_id:test_id,option:2},function(data) {
					$('#overlay').remove();
					$('#test_container').html(data);
				});
			}
		});
		
		
		$(document).on('click','.default_ads',function() {
			var overlay = $('<div id="overlay"><div id="indicator"><img src="<?php echo base_url();?>assets/img/ajax-loader.gif" /></div> </div>');
			overlay.appendTo(document.body);
			
			var url="<?php echo site_url();?>admin/tests/change_ads_settings";
			<?php
				if(!empty($_GET['status']))
				{
				?>
				var url="<?php echo site_url();?>admin/tests/change_ads_settings/?status=<?php echo $_GET['status'];?>";
				<?php
				}
			?>
			
			var test_id=$(this).val();
			
			if(this.checked)
			{//alert(url);
				$.post(url,{test_id:test_id,option:1},function(data) {
					$('#overlay').remove();
					$('#test_container').html(data);
					//alert(data);
				});
			}
			else
			{
				$.post(url,{test_id:test_id,option:2},function(data) {
					$('#overlay').remove();
					$('#test_container').html(data);
				});
			}
		});
		
	});
</script>
<style type="text/css">

	
	#overlay {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: #000;
		filter:alpha(opacity=50);
		-moz-opacity:0.5;
		-khtml-opacity: 0.5;
		opacity: 0.5;
		z-index: 10000;
		
	}
	#indicator {
		z-index: 10000;
		color:#FF0000;
		font-size:20px;
		height:50px;
		position:absolute;
		left:45%;
		top:45%;
	}

</style>

<script language="javascript" type="text/javascript" >
    $(document).ready(function(){
      // add 30 more rows to the table
      var row = $('table#mytable > tbody > tr:first');
      //var row2 = $('table#mytable2 > tbody > tr:first');
     /* for (i=0; i<30; i++) {
        $('table#mytable > tbody').append(row.clone());
        //$('table#mytable2 > tbody').append(row2.clone());
      }*/

      // make the header fixed on scroll
      $('.table-fixed-header').fixedHeader();
    });
  </script>