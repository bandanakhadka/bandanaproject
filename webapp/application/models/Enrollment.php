<?php

class Enrollment extends ActiveRecord\Model
{

    static $table_name = 'enrollment';
    static $primary_key = 'id';

    static $belongs_to = array(
        array(
            'members',
            'class_name'=>'Member',
            'foreign_key'=>'member_id'),
        array(
            'courses',
            'class_name'=>'Course',
            'foreign_key'=>'course_id')
    );

    public function set_course($course)
    {
        $this->assign_attribute('course_id',$course->id);
    }

    public function set_member($member)
	{
    	$this->assign_attribute('member_id',$member->id);
    }

    public static function create($data)
    {
    	$enrollment = new Enrollment();

    	$enrollment->course = $data['course'];
        $enrollment->member = $data['member'];
        $enrollment->is_active = 1;

        $enrollment->save();
    }

    public function delete()
    {

        $this->is_active = 0;
        $this->is_deleted = 1;

        $this->save();
    }

}