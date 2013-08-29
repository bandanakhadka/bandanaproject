<?php

class Organizations extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            return $this->load->view('organization_form');   
        }
        
        $data = array(
            'name' => $_POST['org_name'],
            'address' => $_POST['address'],
            'telephone' => $_POST['telephone'],
            'email' => $_POST['email']
        );
		
        try
        {
    	    $organization = Organization::create($data);
        }

        catch(BlankNameException $e)
        {
            $message['message'] = $e->getMessage();
            return $this->load->view('organization_form',$message); 
        }

        catch(BlankOrgAddressException $e)
        {
            $message['message'] = $e->getMessage();
            return $this->load->view('organization_form',$message); 
        }

        catch(BlankTelephoneException $e)
        {
            $message['message'] = $e->getMessage();
            return $this->load->view('organization_form',$message); 
        }

        catch(BlankOrgEmailException $e)
        {
            $message['message'] = $e->getMessage();
            return $this->load->view('organization_form',$message); 
        }

        $list['current_org'] = $organization;
        $list['organizations'] = Organization::list_all();
	    $this->load->view('organization_added',$list);

	}

    public function add_courses($org_id)
    {

        $list['courses'] = Course::list_all();
        $list['flag']  = 0;

        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            return $this->load->view('organization_enroll',$list);   
        }

        try
        { 
            if(!array_key_exists('checklist',$_POST)) 
            {
                throw new Exception("No course selected. Please select courses to add.");
            }

            foreach($_POST['checklist'] as $post) 
            { 
                $data['organization']= Organization::find_by_id($org_id); 
                $data['course']=Course::find_by_id($post);

                $enrollment= OrganizationEnrollment::create($data); 
            } 
        }

        catch(Exception $e) 
        {
            $list['message'] =  $e->getMessage();
            $list['courses'] = Course::all();
            $list['flag']  = 0;

            return $this->load->view('organization_enroll',$list);
        } 

        catch(EnrollmentException $e) 
        {
            $list['message'] =  $e->getMessage();
            $list['courses'] = Course::all();
            $list['flag']  = 0;

            return $this->load->view('organization_enroll',$list);
        }

        catch(InactiveException $e)
        {
            $list['message'] =  $e->getMessage();
            $list['courses'] = Course::all();
            $list['flag']  = 0;

            return $this->load->view('organization_enroll',$list);
        }

        catch(DeletedException $e)
        {
            $list['message'] =  $e->getMessage();
            $list['courses'] = Course::all();
            $list['flag']  = 0;

            return $this->load->view('organization_enroll',$list);
        }

    }

    public function deactivate_courses($org_id)
    {
        $organization = Organization::find_by_id($org_id);
        $courses = array();
        $org_enrollments = $organization->organization_enrollments;

        foreach ($org_enrollments as $org_enrollment)
        {
            if($org_enrollment->is_active == 1)
            {
                 $courses[] = $org_enrollment->course;

            }
        }

        $list['courses'] = $courses;
        $list['flag']  = 1;

        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            if(empty($list['courses']))
            {
                $list['message'] = "No courses added yet. Deactivation not possible.";
                return $this->load->view('no_options',$list);
            }
            return $this->load->view('organization_enroll',$list);   
        }
    
        try
        {
            if(!array_key_exists('checklist',$_POST)) 
            {
                throw new Exception("No course selected. Please select courses to deactivate.");
            }
        }

        catch(Exception $e)
        {
            $list['message'] =  $e->getMessage();
            $list['courses'] = $courses;
            $list['flag']  = 2;

            return $this->load->view('organization_enroll',$list);
        }
        
        foreach($_POST['checklist'] as $post) 
        {
            $enrollment = OrganizationEnrollment::find_by_org_id_and_course_id_and_is_active($org_id,$post,1);
            $enrollment->deactivate();
        }        

    }

    public function activate_courses($org_id)
    {
        $organization = Organization::find_by_id($org_id);
        $courses = array();
        $org_enrollments = $organization->organization_enrollments;

        foreach ($org_enrollments as $org_enrollment)
        {
            if($org_enrollment->is_active == 0 && $org_enrollment->is_deleted == 0)
            {
                 $courses[] = $org_enrollment->course;

            }
        }

        $list['courses'] = $courses;
        $list['flag']  = 2;

        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            if(empty($list['courses']))
            {
                $list['message'] = "No courses deactivated yet. Activation not possible.";
                return $this->load->view('no_options',$list);
            }
            return $this->load->view('organization_enroll',$list);   
        }

        try
        {
            if(!array_key_exists('checklist',$_POST)) 
            {
                throw new Exception("No course selected. Please select courses.");
            }
        }

        catch(Exception $e)
        {
            $list['message'] =  $e->getMessage();
            $list['courses'] = $courses;
            $list['flag']  = 2;

            return $this->load->view('organization_enroll',$list);
        }

        foreach($_POST['checklist'] as $post) 
        {
            $enrollment = OrganizationEnrollment::find_by_org_id_and_course_id_and_is_active($org_id,$post,0);
            $enrollment->activate();
        } 
    }

    public function delete_courses($org_id)
    {
        $organization = Organization::find_by_id($org_id);
        $courses = array();
        $org_enrollments = $organization->organization_enrollments;

        foreach ($org_enrollments as $org_enrollment)
        {
            if($org_enrollment->is_active == 1)
            {
                 $courses[] = $org_enrollment->course;

            }
        }

        $list['courses'] = $courses;
        $list['flag']  = 3;

        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            if(empty($list['courses']))
            {
                $list['message'] = "No courses added yet. Deletion not possible.";
                return $this->load->view('no_options',$list);
            }
            return $this->load->view('organization_enroll',$list);   
        }

        try
        {
            if(!array_key_exists('checklist',$_POST)) 
            {
                throw new Exception("No course selected. Please select courses.");
            }
        }

        catch(Exception $e)
        {
            $list['message'] =  $e->getMessage();
            $list['courses'] = $courses;
            $list['flag']  = 3;

            return $this->load->view('organization_enroll',$list);
        }

        foreach($_POST['checklist'] as $post) 
        {
            $enrollment = OrganizationEnrollment::find_by_org_id_and_course_id_and_is_deleted_and_is_active($org_id,$post,0,1);
            $enrollment->delete();
        } 
    }

    public function view_members($organization_id)
    {
        $organization = Organization::find_by_id($organization_id);

        foreach ($organization->members as $member)
        {
            echo $member->first_name." ".$member->last_name."<br>";
        }
    }

    public function enroll_all_members_in_course($org_id)
    {
        $organization = Organization::find_by_id($org_id);
        $courses = array();
        $org_enrollments = $organization->organization_enrollments;

        foreach ($org_enrollments as $org_enrollment)
        {
            if($org_enrollment->is_active == 1)
            {
                 $courses[] = $org_enrollment->course;

            }
        }

        $list['courses'] = $courses;

        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            if(empty($list['courses']))
            {
                $list['message'] = "No courses available.";
                return $this->load->view('no_options',$list);
            }
            return $this->load->view('enroll_all_members',$list);   
        }

        try
        {
            $course = Course::find_by_id($_POST['course']);
            $course->check_is_valid();

            $org_enroll = OrganizationEnrollMent::find_by_org_id_and_course_id($org_id,$course->id);
            $org_enroll->check_is_valid();

            $organization = Organization::find_by_id($org_id);        
            $organization->enroll_members_in_course($course);
        }

        catch(InactiveException $e)
        {
            $list['courses'] = $courses;
            $list['message'] = $e->getMessage();
            return $this->load->view('enroll_all_members',$list);
        }

        catch(DeletedException $e)
        {
            $list['courses'] = $courses;
            $list['message'] = $e->getMessage();
            return $this->load->view('enroll_all_members',$list);
        }

        catch(Exception $e)
        {
            $list['courses'] = $courses;
            $list['message'] = $e->getMessage();
            return $this->load->view('enroll_all_members',$list);
        }

    }

    public function count($org_id)
    {
        $organization = Organization::find_by_id($org_id);
        $organization->regenerate();
        echo "<br><br>Total Members: ".$organization->member_count."<br><br>Total Courses Available: ".$organization->org_enrollment_count;
    }

}