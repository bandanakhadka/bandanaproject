<?php 
if(isset($message))
{
	echo $message;
}
?>


<form method = "post">
	<select name="course">
		<?php foreach($courses as $course) { ?>
		<option value="<?=$course->id?></options>"><?=$course->course_name?></option>
		<?php } ?>
	</select>
	<input type = "submit" value="Enroll all Members"></td>
</form>
