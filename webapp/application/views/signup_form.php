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
	 
	    <p class="heading"><h4>New User Signup</h4></p>

	    <form method='post'>

		    <p>
		        <label for="first_name">Firstname: </label>
		        <input type="text" name="first_name" >
		    </p>

		    <p>
		        <label for="last_name">Lastname: </label>
		        <input type="text" name="last_name" >
		    </p>

		    <p>
		        <label for="sex">Sex: </label>
		        <select name="sex">
		        	<option></option>
		        	<option value="male">Male</option>
		        	<option value="female">Female</option>
			 	</select>
		    </p>
		 
		 	<p>
		        <label for="address">Address: </label>
		        <input type="text" name="address" >
		    </p>

			<p>
		        <label for="contact_number">Contact Number: </label>
		        <input type="text" name="contact_number" >
		    </p>

		    <p>
		        <label for="email">E-mail: </label>
		        <input type="email" name="email" >
		    </p>

		    <p>
		    	<label for="organization">Organization: </label>
		    	<select name="organization_id">
			    	<option></option>	    	
					<?php foreach($organizations as $organization){  ?>
					<option value="<?php echo $organization->id;?>"><?php echo $organization->name;?></option>
					<?php } ?>
			 	</select>
			</p>

		    <p>
		        <label for="user_name">Username: </label>
		        <input type="text" name="user_name" >
		    </p>

		    <p>
		        <label for="password">Password: </label>
		        <input type="password" name="password" >
		    </p>

		    <p>
		        <label for="pass_conf">Confirm Password: </label>
		        <input type="password" name="pass_conf" >
		    </p>
		    
		    <p>
		    	<input type="submit" name="submit" value="Create my account">
		    </p>
	 
	    </form>
	 
	</div>
	 
	<a href="login"><h3>Log In</h3></a>

	</body>
	</html>