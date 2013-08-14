<?php

class Signup extends NonSessionController
{
    public function index() 
    {
        $this->check_session();

        $list['organizations'] = Organization::list_all();

        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            return $this->load_view('signup_form',$list);
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

            return $this->load_view('signup_form',$message); 
        }

        catch(BlankLastNameException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load_view('signup_form',$message); 
        }

        catch(BlankSexException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load_view('signup_form',$message); 
        }
        
        catch(BlankAddressException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load_view('signup_form',$message); 
        }

        catch(BlankContactException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load_view('signup_form',$message); 
        }

        catch(BlankEmailException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load_view('signup_form',$message); 
        }

        catch(BlankOrganizationException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load_view('signup_form',$message); 
        }

        catch(BlankUserNameException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load_view('signup_form',$message); 
        }

        catch(UnavailableUserNameException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load_view('signup_form',$message); 
        }

        catch(BlankPasswordException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load_view('signup_form',$message); 
        }

        catch(ConfirmPasswordException $e)
        {
            $message['message'] = $e->getMessage();
            $message['organizations'] = Organization::list_all();

            return $this->load_view('signup_form',$message); 
        }

        $this->session->set_userdata( array(
                'member_id'=>$member->id)
        );

        redirect('dashboard');

    }

}