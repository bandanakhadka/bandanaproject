<!DOCTYPE html>
<html lang="en">
	<?php
    	include_once('header.php');
  	?>

  	<body>
    	<div class="container">
			<form class="form-signin" method = "post">
				<h2 class="form-signin-heading">Select Courses</h2>
				<p>
					<select class="form-control" name="course">
						<option value="" disabled selected>Select a Course</option>
						<?php 
							foreach($courses as $course) { 
						?>
						<option value="<?=$course->id?></options>"><?=$course->course_name?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Enroll all Members</button>
				</p>
			</form>

			<hr>

			<?php 
			    include_once('footer.php');
			?>
		</div>
	</body>
</html>

