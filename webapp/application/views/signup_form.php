<!DOCTYPE html>
<html lang="en">

	<?php
	include_once('header.php');
	?>

	<body>
		<div class="container">
		    <form class="form-signin" method="post">
		    	<h2 class="form-signin-heading">New Member Signup</h2>
			    <p>
			        <input type="text" class="form-control" placeholder="First Name" name="first_name" autofocus>
			    </p>

			    <p>
			        <input type="text" class="form-control" placeholder="Last Name" name="last_name" >
			    </p>

			    <p>
			        <select class="form-control" name="sex">
			        	<option value="" disabled selected>Select Gender</option>
			        	<option value="male">Male</option>
			        	<option value="female">Female</option>
				 	</select>
			    </p>
			 
			 	<p>
			        <input type="text" class="form-control" placeholder="Address" name="address" >
			    </p>

				<p>
			        <input type="text" class="form-control" placeholder="Contact Number" name="contact_number" >
			    </p>

			    <p>
			        <input type="text" class="form-control" placeholder="E-mail" name="email" >
			    </p>

			    <p>
			    	<select class="form-control" name="organization_id" >
				    	<option value="" disabled selected>Select Organization</option>	    	
						<?php foreach($organizations as $organization){  ?>
						<option value="<?php echo $organization->id;?>"><?php echo $organization->name;?></option>
						<?php } ?>
				 	</select>
				</p>

			    <p>
			        <input type="text" class="form-control" placeholder="User Name" name="user_name" >
			    </p>

			    <p>
			        <input type="password" class="form-control" placeholder="Password" name="password" >
			    </p>

			    <p>
			        <input type="password" class="form-control" placeholder="Confirm Password" name="pass_conf" >
			    </p>
			    
			    <p>
			    	<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Create my Account</button>
			    </p>	

			    <a href="/login"><h3>Log In</h3></a>	 
		    </form>			    

		    <hr>

		    <?php 
		    	include_once('footer.php');
		    ?>	 
		</div>		
	</body>
</html>