<?php

include_once('Exceptions.php');

class Enrollment extends BaseModel
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
        $course->check_is_valid();
        $this->assign_attribute('course_id',$course->id);
    }

    public function set_member($member)
	{
        $member->check_is_valid(); 
    	$this->assign_attribute('member_id',$member->id);
    }

    public static function check_if_exists($course,$member)
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
        return $enrollment;
    }

}