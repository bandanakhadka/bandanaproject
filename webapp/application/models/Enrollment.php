<?php

class UnavailableEnrollmentException extends Exception
{}

class BlankEnrollmentException extends Exception
{}

class Enrollment extends ActiveRecord\Model
{

    static $table_name = 'enrollment';
    static $primary_key = 'id';

    static $belongs_to = array(
        array(
            'member',
            'class_name'=>'Member',
            'foreign_key'=>'member_id'),
        array(
            'course',
            'class_name'=>'Course',
            'foreign_key'=>'course_id')
    );

    public function set_course($course)
    {
        if(!$course)
        {
            throw new BlankEnrollmentException("Please select a course to enroll!");              
        }
        $this->assign_attribute('course_id',$course->id);
    }

    public function set_member($member)
	{
    	$this->assign_attribute('member_id',$member->id);
    }

    public function check_if_exists($course,$member)
    {
        $enrollment = Enrollment::find_by_course_id_and_member_id_and_is_deleted($course->id,$member->id,0);

        if($enrollment)
        {
            throw new UnavailableEnrollmentException("This enrollment already exists! Select another course for enrollment.");
        }
    }

    public static function create($data)
    {
    	$enrollment = new Enrollment();

    	$enrollment->course = $data['course'];
        $enrollment->member = $data['member'];
        $enrollment->is_active = 1;
        $enrollment->is_deleted = 0;

        self::check_if_exists( $data['course'],$data['member']);

        $enrollment->save();
    }

    public function delete()
    {
        $this->is_active = 0;
        $this->is_deleted = 1;

        $this->save();
    }

    public function deactivate()
    {
        $this->is_active = 0;
        $this->is_deleted = 0;

        $this->save();
    }

    public function activate()
    {
        $this->is_active = 1;
        $this->is_deleted = 0;

        $this->save();
    }

}