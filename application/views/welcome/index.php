<div class="jumbotron" text-align="center">
	<h1>List of Records</h1>

	<table class="table table-stripe">
		<?php if (isset($current_user->email)) : ?>
			<a href="<?php echo site_url('welcome/add') ?>" class="btn pull-right btn-success">Add Record</a>
		<?php endif; ?>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Position</th>
			<th>Salary</th>
			<th>Options</th>
		</tr>
		<?php foreach($data as $records): ?>
		<tr class="itemInfo-<?php echo $records->id;?>">
			
			<td><?php echo $records->first_name;?></td>
			<td><?php echo $records->last_name;?></td>
			<td><?php echo $records->position;?></td>
			<td><?php echo $records->salary;?></td>
			<td><a href="<?php echo site_url('welcome/edit/id/'.$records->id);?>">Edit</a> | 
			<a href="#" onclick="return goDelete('<?php echo $records->id;?>')">Delete</a></td>
			
		</tr>
		<?php endforeach;?>
	</table>
</div>

<hr />
<script type="text/javascript">
	function goDelete(id){
		var x = confirm('Are you sure you want to delete this?');
		if(x){
			$(".itemInfo"+id).fadeOut("slow");
			$.post("<?php echo site_url('welcome/delete')?>", {id:id}, function(data){
				
			});
		}else{
			
		}
	}

</script>

