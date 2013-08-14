<?php

class Login extends NonSessionController
{
    public function index() 
    {
        $this->check_session();

        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            return $this->load_view('login_form');
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
            return $this->load_view('login_form',$message);
        }

        catch(UserPasswordInvalidException $e)
        {
            $message['message'] = $e->getMessage();
            return $this->load_view('login_form',$message);
        }

        $this->session->set_userdata(array(
                'member_id'=>$user->member->id)
        );

        $this->session->set_flashdata('success', 'You are logged in successfully!');
        redirect('dashboard');

    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

}
