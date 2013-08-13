<!DOCTYPE html>
	<html lang="en">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <title>Add Courses Form</title>
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

	<div id="course">
	 
	    <p class="heading"><h4>Add New Course</h4></p>

	    <form method="post">

		    <p>
		        <label for="course_code">Course Code: </label>
		        <input type="text" name="course_code">
		    </p>
		 
		 	<p>
		        <label for="course_name">Course Name: </label>
		        <input type="text" name="course_name">
		    </p>

			<p>
		        <label for="duration_in_hrs">Duration in Hours: </label>
		        <input type="text" name="duration_in_hrs">
		    </p>

		    <p>
		        <label for="category">Category: </label>
		        <input type="category" name="category">
		    </p>

		    <p>
		    	<input type="submit" name="submit" value="Add Course">
		    </p>
	 
	    </form>
	 
	</div>
	 
	</body>
	</html>