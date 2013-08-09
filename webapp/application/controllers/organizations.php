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

        $list['organizations'] = Organization::list_all();
	    $this->load->view('organization_added',$list);

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