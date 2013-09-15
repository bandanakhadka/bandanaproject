<!DOCTYPE html>
<html lang="en">

	<?php
    	include_once('header-1.php');
  	?>

		<div class="container">
			<?php
				if(isset($table))
				{
					echo "Table: ".$table;
				}
			?>

			<form class="form-signin" method="post">
			    <h2 class="form-signin-heading">Select a Course</h2>
				<p>
			    	<select class="form-control" name="course_id">
				    	<option></option>	    	
						<?php foreach($courses as $course){  ?>
						<option value="<?php echo $course->id;?>"><?php echo $course->course_name;?></option>
						<?php } ?>
				 	</select>
				</p>

				<p>
					<? if($flag==0): ?>
					 
			    		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Enroll</button>
			    	
			    	<? elseif($flag==1): ?>
			   
			    	<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Unenroll</button>
			    
			    	<? elseif($flag==2): ?>
			    	<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Deactivate</button>
			    
			    	<? else: ?>
			    	
			    	<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Activate</button>
			    	<? endif ?>
			    </p>	    
			</form>		     
		</div>		
	</body>
</html>