<?php

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if(!$member_id = $this->session->userdata('member_id'))
		{
			$this->session->set_flashdata('error', 'You are not logged in. Please login to continue.');
			redirect('login');
		}

		if(!$member = Member::find_by_id($member_id))
		{
			$this->session->set_flashdata('error', 'You are not logged in. Please login to continue.');
			redirect('login');
		}
	}

	public function index()
	{
		$member_id = $this->session->userdata('member_id');
		$member = Member::find_by_id($member_id);

		if(isset($this->session))
		{
			return $this->load->view('dashboard',array('member'=>$member));	
		}
		
	}
}