<div class="jumbotron" text-align="center">
	<h1>Add  Records</h1>
	<?php echo form_open('welcome/addRecord');?>
		 <?php echo validation_errors('<div class="alert alert-danger">','</div>');?>
		<input type="text" name="firstName" value="<?php echo set_value('firstName')?>" class="form-control" placeholder="First Name"/><br>
		<input type="text" name="lastName" value="<?php echo set_value('lastName'); ?>" class="form-control" placeholder="Last Name" /><br>
		<input type="text" name="position" value="<?php echo set_value('position')?>" class="form-control" placeholder="Position" /><br>
		<input type="text" name="salary" value="<?php echo set_value('salary')?>" class="form-control" placeholder="Salary" /><br>
		
		<input type="submit" value="Add Record" class="btn btn-success">
	</form>
</div>

<hr />

