<?php

include_once('Exceptions.php');

class Course extends BaseModel
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

    public static function create($data)
    {
    	$course = new course();

    	$course->course_code = $data['course_code'];
        $course->course_name = $data['course_name'];
        $course->duration_in_hrs = $data['duration_in_hrs'];
    	$course->category = $data['category'];
        $course->is_active = 1;
        $course->is_deleted = 0;

        $course->save();

        return $course;
    }

    public function upload_course($ftp,$config)
    {
        try
        {
            if($ftp->connect($config)==TRUE)
            {
                $upload = $ftp->upload('C:\Users\Mingma Sherpa\Documents\GitHub\bandanaproject\webapp\system\upload', '/courses/upload');            
                return $upload;
            }

            else
            {
                throw new FTPException("FTP connection failed!!");
            }
        }

        catch(FTPException $e)
        {
            $ftp->close();
            return FALSE;
        }
         
        $ftp->close();
        return TRUE;
    }

}