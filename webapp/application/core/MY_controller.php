<?php

class SessionController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->data = array();
		$member_id = $this->session->userdata('member_id');
		$this->member = Member::find_by_id($member_id);
		$this->data['current_member'] = $this->member;
		$this->data['current_organization'] = $this->member->organization;

		if(!$member_id || !$this->member)
		{
			$this->session->set_flashdata('error', 'You are not logged in. Please login to continue.');
			redirect('login');
		}

	}

	public function load_view($path,$data=array())
	{
		$this->data['courses'] = array_key_exists('courses',$data) ? $data['courses'] : null;
		$this->data['flag'] = array_key_exists('flag', $data) ? $data['flag'] : null;
		$this->data['message'] = array_key_exists('message', $data) ? $data['message'] : null;
		$this->data['table'] = array_key_exists('table', $data) ? $data['table'] : null;

		$this->load->view($path,$this->data);
	}
	
}



class NonSessionController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->data = array();
	}

	/*public function load_view($path,$data=array())
	{
		$this->data['courses'] = array_key_exists('courses',$data) ? $data['courses'] : null;
		$this->data['flag'] = array_key_exists('flag', $data) ? $data['flag'] : null;
		$this->data['message'] = array_key_exists('message', $data) ? $data['message'] : null;
		$this->data['organizations'] = array_key_exists('organizations', $data) ? $data['organizations'] : null;
		$this->data['current_org'] = array_key_exists('current_org', $data) ? $data['current_org'] : null;

		$this->load->view($path,$this->data);
	}*/

	public function check_session()
	{
		if($this->session->userdata('member_id'))
        {
            $this->session->set_flashdata('logout', 'You are logged in. Please log out for a new signup.');
            redirect('dashboard');
        }
	}
}