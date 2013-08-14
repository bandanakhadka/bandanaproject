<!DOCTYPE html>
	<html lang="en">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <title>Organizations</title>
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
	<p class="heading"><h4>Select Courses</h4></p>

		<form method="post">
			<p>
		    	<label for="course">Courses: <br><br></label>
		    	<?php foreach($courses as $course){  ?>
		    	<input type="checkbox" name="checklist[]" value="<?php echo $course->id;?>"><?php echo $course->course_name;?><br>
				<?php } ?>
				<br>
				<?php 
				if($flag==0)
					{ ?>
				<input type="submit" name="submit" value="Add" />
				<?php 
				}
				elseif($flag==1)
					{ ?>
				<input type="submit" name="submit" value="Deactivate" />
				<?php
				}
				elseif($flag==2) 
					{ ?>
				<input type="submit" name="submit" value="Activate" />
				<?php } 
				else 
					{ ?>
				<input type="submit" name="submit" value="Delete" />
				<?php } ?>
				</p>
	
	</div>
	</body>
	</html>