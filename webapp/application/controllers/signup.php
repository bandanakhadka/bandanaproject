<?php

class Signup extends CI_Controller
{
    public function index() 
    {
        if($this->session->userdata('member_id'))
        {
            $this->session->set_flashdata('logout', 'You are logged in. Please log out for a new signup.');
            redirect('dashboard');
        }

        $list['organizations'] = Organization::list_all();

        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            return $this->load->view('signup_form',$list);
        }

        $organization = Organization::find_by_id($_POST['organization_id']);

        $data = array(
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'sex' => $_POST['sex'],
            'address' => $_POST['address'],
            'contact_number' => $_POST['contact_number'],
            'user_name' => $_POST['user_name'],
            'password' => $_POST['password'],
            'confirm_password' => $_POST['pass_conf'],
            'email' => $_POST['email'],
            'organization' => $organization
        );

        try
        {
            $member = Member::create($data);
        }

        catch(BlankFirstNameException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load->view('signup_form',$message); 
        }

        catch(BlankLastNameException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load->view('signup_form',$message,$list); 
        }

        catch(BlankSexException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load->view('signup_form',$message); 
        }
        
        catch(BlankAddressException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load->view('signup_form',$message,$list); 
        }

        catch(BlankContactException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load->view('signup_form',$message,$list); 
        }

        catch(BlankEmailException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load->view('signup_form',$message,$list); 
        }

        catch(BlankUserNameException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load->view('signup_form',$message,$list); 
        }

        catch(UnavailableUserNameException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load->view('signup_form',$message,$list); 
        }

        catch(BlankPasswordException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load->view('signup_form',$message,$list); 
        }

        catch(ConfirmPasswordException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load->view('signup_form',$message,$list); 
        }

        $this->session->set_userdata( array(
                'member_id'=>$member->id)
        );

        redirect('dashboard');

    }

}