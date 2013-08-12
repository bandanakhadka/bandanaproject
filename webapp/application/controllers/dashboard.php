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
		$courses = Course::list_enrolled($member_id,$member->organization_id);

		if(isset($this->session))
		{
			return $this->load->view('dashboard',array('member'=>$member,'courses'=>$courses));	
		}
		
	}

	public function enroll_course()
	{
		$member = Member::find_by_id($this->session->userdata['member_id']);

		if($_SERVER['REQUEST_METHOD'] !== 'POST')
		{
			$list['courses'] = Course::list_available($member->organization_id);
			$list['flag'] = 1;

			return $this->load->view('enroll_form',$list);
		}	
		
		$course = Course::find_by_id($_POST['course_id']);

		$data = array(
			'course'=>$course,
			'member'=>$member
			);

		try
		{
			Enrollment::create($data);
		}

		catch(UnavailableEnrollmentException $e)
		{
			$list['message'] = $e->getMessage();
            $list['courses'] = Course::list_available($member->organization_id);
            $list['flag'] = 1;

            return $this->load->view('enroll_form',$list);
		}

		catch(BlankEnrollmentException $e)
		{
			$list['message'] = $e->getMessage();
            $list['courses'] = Course::list_available($member->organization_id);
            $list['flag'] = 1;

            return $this->load->view('enroll_form',$list);
		}

		redirect('dashboard');
	}

	public function unenroll()
	{
		if($_SERVER['REQUEST_METHOD'] !== 'POST')
		{
			$member_id = $this->session->userdata('member_id');
			$member = Member::find_by_id($member_id);

			/*foreach($member->enrollments as $enrollment)
			{
				$enroll[] = $enrollment->course;
			}

			$list['courses'] = $enroll;*/

			$list['courses'] = Course::list_enrolled($this->session->userdata('member_id'),$member->organization_id);
			$list['flag'] = 0;

			return $this->load->view('enroll_form',$list);
		}
		
		$enrollment = Enrollment::find_by_course_id_and_member_id($_POST['course_id'],$this->session->userdata['member_id']);

		if($enrollment)
		{
			$enrollment->delete();
		}

		redirect('dashboard');
				
	}

}