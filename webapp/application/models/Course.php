<?php

class BlankCourseCodeException extends Exception
{}

class BlankCourseNameException extends Exception
{}

class BlankDurationException extends Exception
{}

class BlankCategoryException extends Exception
{}

class Course extends ActiveRecord\Model
{

    static $table_name = 'courses';
    static $primary_key = 'id';

    static $has_many = array(
        array(
            'enrollments',
            'class_name'=>'Enrollment',
            'foreign_key'=>'course_id'),
        array(
            'organization_enrollments',
            'class_name'=>'OrganizationEnrollment',
            'foreign_key'=>'course_id'
            )
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
        $course = Course::all(array(
                    'joins'=>array('organization_enrollments'),
                    'conditions'=>array('org_id = ? AND is_active = ?',$org_id,1)
                    )
                );
        return $course;
    }

    public function list_enrolled($member_id)
    {
        $courses = Course::all(array(
                    'joins'=>array('enrollments'),
                    'conditions'=>array('member_id = ? AND is_active = ? AND is_deleted = ?',$member_id,1,0)
                    )
                );
        return $courses;
    }

    public function list_deactivated($member_id)
    {
        $courses = Course::all(array(
                    'joins'=>array('enrollments'),
                    'conditions'=>array('member_id = ? AND is_deleted = ? AND is_active = ?',$member_id,0,0)
                    )
                );
        return $courses;
    }

    public function list_available_org($org_id)
    {
        $course = Course::all(array(
                    'joins'=>array('organization_enrollments'),
                    'conditions'=>array('org_id = ? AND is_active = ?',$org_id,1)
                    )
                );
        return $course;
    }

    public function list_deactivated_org($org_id)
    {
        $course = Course::all(array(
                    'joins'=>array('organization_enrollments'),
                    'conditions'=>array('org_id = ? AND is_deleted = ? AND is_active = ?',$org_id,0,0)
                    )
                );
        return $course;
    }

    public static function create($data)
    {
    	$course = new course();

    	$course->course_code = $data['course_code'];
        $course->course_name = $data['course_name'];
        $course->duration_in_hrs = $data['duration_in_hrs'];
    	$course->category = $data['category'];

        $course->save();
    }

}