<div class="jumbotron" text-align="center">
	<h1>Edit  Records</h1>
	<?php echo form_open('welcome/editSuccessfully');?>
		 <?php echo validation_errors('<div class="alert alert-danger">','</div>');?>
		<input type="text" name="firstName" value="<?php echo $data->first_name;?>" class="form-control" placeholder="First Name"/><br>
		<input type="text" name="lastName" value="<?php echo $data->last_name; ?>" class="form-control" placeholder="Last Name" /><br>
		<input type="text" name="position" value="<?php echo $data->position;?>" class="form-control" placeholder="Position" /><br>
		<input type="text" name="salary" value="<?php echo $data->salary;?>" class="form-control" placeholder="Salary" /><br>
		
		<input type="hidden" name="recordId" value="<?php echo $data->id;?>" />
		<input type="submit" value="Edit Record	" class="btn btn-success">
	</form>
</div>

<hr />

