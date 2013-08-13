<?php

class Organizations extends CI_Controller
{

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
                OrganizationEnrollment::is_empty();
            }

            foreach($_POST['checklist'] as $post) 
            { 
                $data['organization']= Organization::find_by_id($org_id); 
                $data['course']=Course::find_by_id($post);

                $enrollment= OrganizationEnrollment::create($data); 
            } 
        }

        catch(EmptyException $e) 
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

        /*$list['current_org'] = Organization::find_by_id($org_id);
        $list['organizations'] = Organization::list_all();
        $this->load->view('organization_added',$list);*/
    }

    public function deactivate_courses($org_id)
    {

        $list['courses'] = Course::list_available_org($org_id);
        $list['flag']  = 1;

        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            return $this->load->view('organization_enroll',$list);   
        }
 
        if(!array_key_exists('checklist',$_POST)) 
        {
            OrganizationEnrollment::is_empty();
        }
        
        foreach($_POST['checklist'] as $post) 
        {
            $enrollment = OrganizationEnrollment::find_by_org_id_and_course_id_and_is_active($org_id,$post,1);
            $enrollment->deactivate();
        }        

    }

    public function activate_courses($org_id)
    {

        $list['courses'] = Course::list_deactivated_org($org_id);
        $list['flag']  = 2;

        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            return $this->load->view('organization_enroll',$list);   
        }

        if(!array_key_exists('checklist',$_POST)) 
        {
            OrganizationEnrollment::is_empty();
        }

        foreach($_POST['checklist'] as $post) 
        {
            $enrollment = OrganizationEnrollment::find_by_org_id_and_course_id_and_is_active($org_id,$post,0);
            $enrollment->activate();
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

}