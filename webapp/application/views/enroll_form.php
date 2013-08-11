<!DOCTYPE html>
	<html lang="en">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <title>Signup Form</title>
	</head>
	<body>
		<?php
			if(isset($message))
			{
				echo $message;
			}

			if($this->session->flashdata('error'))
			{
				echo $this->session->flashdata('error');
			}

			if($this->session->flashdata('success'))
			{
				echo $this->session->flashdata('success');
			}
		?>
	 
	<div id="signup_form">
	 
	    <p class="heading"><h4>Select a Course</h4></p>

		<form method="post">
			<p>
		    	<label for="course">Course: </label>
		    	<select name="course_id">
			    	<option></option>	    	
					<?php foreach($courses as $course){  ?>
					<option value="<?php echo $course->id;?>"><?php echo $course->course_name;?></option>
					<?php } ?>
			 	</select>
			</p>

			<p>
				<?php if($flag==1)
				{ ?>
		    	<input type="submit" name="submit" value="Enroll">
		    	<?php }
		    	else 
		    	{ ?>
		    	<input type="submit" name="submit" value="UnEnroll">
		    	<?php } ?>
		    </p>		    
		</form>