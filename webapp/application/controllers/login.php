<?php

class Login extends NonSessionController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index() 
    {
        $this->check_session();

        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            return $this->load->view('login_form');
        }

        $data_user = array(
            'user_name'=> $_POST['user_name'],
            'password'=> $_POST['password']
        );

        try
        {
            $user = User::check_login($data_user);
        }

        catch(UserInvalidException $e)
        {
            $message['message'] = $e->getMessage();
            return $this->load->view('login_form',$message);
        }

        catch(UserPasswordInvalidException $e)
        {
            $message['message'] = $e->getMessage();
            return $this->load->view('login_form',$message);
        }

        $this->session->set_userdata(array(
                'member_id'=>$user->member->id)
        );

        $org_name = $user->member->organization->name;

        $cookie_value = $this->input->cookie('org_cookie') ? $this->input->cookie('org_cookie') : null;

        if($cookie_value && $cookie_value == $org_name)
        {
            $this->session->set_flashdata('success', 'Welcome to '.$cookie_value.'!');
        }
        else
        {
            $cookie = array(
                'name'=>'org_cookie',
                'value'=>$org_name,
                'expire'=>'56565'
                );
            $this->input->set_cookie($cookie);
            $this->session->set_flashdata('success', 'You are logged in successfully!');
        }

        redirect('goto/my/dashboard');

    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

}
