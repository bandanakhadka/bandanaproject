<!DOCTYPE html>
<html lang="en">
	<?php
		include_once('header.php');
	?>
	<body>
		<div class="container">
		    <form class="form-signin" method="post">
		    	<h2 class="form-signin-heading">Add New Course</h2>
			    <p>
			        <input type="text" class="form-control" placeholder="Course Code" name="course_code" autofocus>
			    </p>
			 
			 	<p>
			        <input type="text" class="form-control" placeholder="Course Name" name="course_name">
			    </p>

				<p>
			        <input type="text" class="form-control" placeholder="Duration In Hours" name="duration_in_hrs">
			    </p>

			    <p>
			        <input type="text" class="form-control" placeholder="Category" name="category">
			    </p>

			    <p>
			    	<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Add Course</button>
			    </p>	 
		    </form>

		    <hr>

		    <?php 
		        include_once('footer.php');
		    ?>	 
		</div>	 
	</body>
</html>