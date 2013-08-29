<?php

class Courses extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $list['organizations'] = Organization::list_all();

        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            return $this->load->view('course_form',$list);   
        }
       
        $data = array(
            'course_code' => $_POST['course_code'],
            'course_name' => $_POST['course_name'],
            'duration_in_hrs' => $_POST['duration_in_hrs'],
            'category' => $_POST['category'],
        );
		
        try
        {
    	    $course = Course::create($data);
        }

        catch(BlankCourseCodeException $e)
        {
            $list['message'] = $e->getMessage();
            $list['organizations'] = Organization::list_all();
            return $this->load->view('course_form',$list); 
        }

        catch(BlankCourseNameException $e)
        {
            $list['message'] = $e->getMessage();
            $list['organizations'] = Organization::list_all();
            return $this->load->view('course_form',$list); 
        }

        catch(BlankDurationException $e)
        {
            $list['message'] = $e->getMessage();
            $list['organizations'] = Organization::list_all();
            return $this->load->view('course_form',$list); 
        }

        catch(BlankCategoryException $e)
        {
            $list['message'] = $e->getMessage();
            $list['organizations'] = Organization::list_all();
            return $this->load->view('course_form',$list); 
        }

        $list['courses'] = Course::list_all();
	    $this->load->view('course_added',$list);

	}

}