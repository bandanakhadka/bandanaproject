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

	public function enroll_course()
	{	
		if(isset($_POST['course_id']))
		{
			$course = Course::find_by_id($_POST['course_id']);
			$member = Member::find_by_id($this->session->userdata['member_id']);

			$data = array(
				'course'=>$course,
				'member'=>$member
				);

			Enrollment::create($data);

			redirect('dashboard');
		}

		$list['courses'] = Course::list_enroll($this->session->userdata('member_id'));
		$list['flag'] = 1;

		$this->load->view('enroll_form',$list);
	}

	public function unenroll()
	{
		if(isset($_POST['course_id']))
		{
			$enrollment = Enrollment::find_by_course_id_and_member_id($_POST['course_id'],$this->session->userdata['member_id']);

			$enrollment->delete();

			redirect('dashboard');
		}

		$list['courses'] = Course::list_unenroll($this->session->userdata('member_id'));
		$list['flag'] = 0;

		$this->load->view('enroll_form',$list);
	}

}