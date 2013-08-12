<?php

class BlankCourseCodeException extends Exception
{}

class BlankCourseNameException extends Exception
{}

class BlankDurationException extends Exception
{}

class BlankCategoryException extends Exception
{}

class BlankOrgException extends Exception
{}

class Course extends ActiveRecord\Model
{

    static $table_name = 'courses';
    static $primary_key = 'id';

    static $belongs_to = array(
        array(
            'organization',
            'class_name'=>'Organization',
            'foreign_key'=>'org_id')
    );

    static $has_many = array(
        array(
            'enrollments',
            'class_name'=>'Enrollment',
            'foreign_key'=>'course_id')
    );

    public function set_course_code($course_code)
    {
        if($course_code=='')
        {
            throw new BlankCourseCodeException("Course Code Required!");              
        }

        $this->assign_attribute('course_code',$course_code);
    }

    public function set_course_name($course_name)
	{
        if($course_name=='')
        {
            throw new BlankCourseNameException("Course Name Required!");              
        }

    	$this->assign_attribute('course_name',$course_name);
    }

    public function set_duration_in_hrs($duration_in_hrs)
    {
        if($duration_in_hrs=='')
        {
            throw new BlankDurationException("Duration Required!");              
        }

        $this->assign_attribute('duration_in_hrs',$duration_in_hrs);
    }

    public function set_category($category)
    {
        if($category=='')
        {
            throw new BlankCategoryException("Category Required!");              
        }

        $this->assign_attribute('category',$category);
    }

    public function set_organization($organization)
    {
        if(!$organization)
        {
            throw new BlankOrgException("Please select an Organization!");              
        }
        $this->assign_attribute('org_id',$organization->id);
    }

    public function get_course_code()
    {
        return $this->read_attribute('course_code');
    }

    public function get_course_name()
    {
        return $this->read_attribute('course_name');
    }

    public function get_duration_in_hrs()
    {
        return $this->read_attribute('duration_in_hrs');
    }

    public function get_category()
    {
        return $this->read_attribute('category');
    }

    public function list_all()
    {
    	$course = Course::find('all');
    	return $course;
    }

    public function list_available($org_id)
    {
        $course = Course::all(array('conditions'=>array('org_id=?',$org_id)));
        return $course;
    }

    public function list_enrolled($member_id,$org_id)
    {
        $courses = Course::all(array(
                    'joins'=>array('enrollments'),
                    'conditions'=>array('member_id = ? AND org_id = ? AND is_deleted = ?',$member_id,$org_id,0)
                    )
                );
        return $courses;
    }

    public static function create($data)
    {
    	$course = new course();

    	$course->course_code = $data['course_code'];
        $course->course_name = $data['course_name'];
        $course->duration_in_hrs = $data['duration_in_hrs'];
    	$course->category = $data['category'];
        $course->organization = $data['organization'];

        $course->save();
    }

}