<?php

class Dashboard extends SessionController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$courses = Course::list_enrolled($this->member->id,$this->member->organization_id);

		if(isset($this->session))
		{
			//return $this->load->view('dashboard',array('member'=>$member,'courses'=>$courses));
			return $this->load_view('dashboard',array('courses'=>$courses));	
		}
		
	}

	public function enroll_course()
	{
		if($_SERVER['REQUEST_METHOD'] !== 'POST')
		{
			$list['courses'] = Course::list_available($this->member->organization_id);
			$list['flag'] = 0;

			return $this->load_view('enroll_form',$list);
		}	
		
		$course = Course::find_by_id($_POST['course_id']);

		$data = array(
			'course'=>$course,
			'member'=>$this->member
			);

		try
		{
			Enrollment::create($data);
		}

		catch(UnavailableEnrollmentException $e)
		{
			$list['message'] = $e->getMessage();
            $list['courses'] = Course::list_available($this->member->organization_id);
            $list['flag'] = 0;

            return $this->load_view('enroll_form',$list);
		}

		catch(BlankEnrollmentException $e)
		{
			$list['message'] = $e->getMessage();
            $list['courses'] = Course::list_available($this->member->organization_id);
            $list['flag'] = 0;

            return $this->load_view('enroll_form',$list);
		}

		redirect('dashboard');
	}

	public function unenroll()
	{
		if($_SERVER['REQUEST_METHOD'] !== 'POST')
		{
			$list['courses'] = Course::list_enrolled($this->member->id);
			$list['flag'] = 1;

			return $this->load_view('enroll_form',$list);
		}
		
		$enrollment = Enrollment::find_by_course_id_and_member_id_and_is_deleted($_POST['course_id'],$this->member->id,0);

		if($enrollment)
		{
			$enrollment->delete();
		}

		redirect('dashboard');
				
	}

	public function deactivate()
	{
		if($_SERVER['REQUEST_METHOD'] !== 'POST')
		{
			$list['courses'] = Course::list_enrolled($this->member->id);
			$list['flag'] = 2;

			return $this->load_view('enroll_form',$list);
		}
		
		$enrollment = Enrollment::find_by_course_id_and_member_id_and_is_deleted_and_is_active($_POST['course_id'],$this->member->id,0,1);

		if($enrollment)
		{
			$enrollment->deactivate();
		}

		redirect('dashboard');
				
	}

	public function activate()
	{
		if($_SERVER['REQUEST_METHOD'] !== 'POST')
		{
			$list['courses'] = Course::list_deactivated($this->member->id);
			$list['flag'] = 3;

			return $this->load_view('enroll_form',$list);
		}
		
		$enrollment = Enrollment::find_by_course_id_and_member_id_and_is_deleted_and_is_active($_POST['course_id'],$this->member->id,0,0);

		if($enrollment)
		{
			$enrollment->activate();
		}

		redirect('dashboard');
				
	}

}