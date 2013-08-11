<?php

class Courses extends CI_Controller
{

    public function index()
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            return $this->load->view('course_form');   
        }
        
        $data = array(
            'course_code' => $_POST['course_code'],
            'course_name' => $_POST['course_name'],
            'duration_in_hrs' => $_POST['duration_in_hrs'],
            'category' => $_POST['category']
        );
		
        try
        {
    	    $course = Course::create($data);
        }

        catch(BlankCourseCodeException $e)
        {
            $message['message'] = $e->getMessage();
            return $this->load->view('course_form',$message); 
        }

        catch(BlankCourseNameException $e)
        {
            $message['message'] = $e->getMessage();
            return $this->load->view('course_form',$message); 
        }

        catch(BlankDurationException $e)
        {
            $message['message'] = $e->getMessage();
            return $this->load->view('course_form',$message); 
        }

        catch(BlankCategoryException $e)
        {
            $message['message'] = $e->getMessage();
            return $this->load->view('course_form',$message); 
        }

        $list['courses'] = Course::list_all();
	    $this->load->view('course_added',$list);

	}

    /*public function view_members($organization_id)
    {
        $organization = Organization::find_by_id($organization_id);

        foreach ($organization->members as $member)
        {
            echo $member->first_name." ".$member->last_name."<br>";
        }
    }*/

}