<?php

class Dashboard extends SessionController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$courses = array();
		$enrollments = $this->member->enrollments;
		foreach($enrollments as $enrollment)
		{
			if($enrollment->is_active == 1)
			{
				$courses[] = $enrollment->course;
			}
			
		}

		return $this->load_view('dashboard',array('courses'=>$courses));	
		
	}

	public function enroll_course()
	{
		$courses = array();
		$org_enrollments = $this->member->organization->organization_enrollments;
		foreach($org_enrollments as $org_enrollment)
		{
			$courses[] = $org_enrollment->course;
		}

		if($_SERVER['REQUEST_METHOD'] !== 'POST')
		{
			$list['courses'] = $courses;
			$list['flag'] = 0;
			//$list['table'] = Member::echo_table_name();
			//$this->member->echo_table_name();

			return $this->load_view('enroll_form',$list);
		}	
		
		try
		{
			if(!$_POST['course_id'])
			{
				throw new Exception("No course selected!! Please select one.");
			}

			$course = Course::find_by_id($_POST['course_id']);
			
			$data = array(
				'course'=>$course,
				'member'=>$this->member
				);

			$org_enrollment = OrganizationEnrollment::find_valid_by_course_id_and_org_id($_POST['course_id'],$this->member->organization_id);
			
			//$org_enrollment->check_is_valid();
			Enrollment::create($data);
		}
		
		catch(Exception $e)
		{
			$list['message'] = $e->getMessage();
            $list['courses'] = $courses;
            $list['flag'] = 0;

            return $this->load_view('enroll_form',$list);
		}

		catch(InactiveException $e)
		{
			$list['message'] = $e->getMessage();
            $list['courses'] = $courses;
            $list['flag'] = 0;

            return $this->load_view('enroll_form',$list);
		}

		catch(DeletedException $e)
		{
			$list['message'] = $e->getMessage();
            $list['courses'] = $courses;
            $list['flag'] = 0;

            return $this->load_view('enroll_form',$list);
		}

		catch(UnavailableEnrollmentException $e)
		{
			$list['message'] = $e->getMessage();
            $list['courses'] = $courses;
            $list['flag'] = 0;

            return $this->load_view('enroll_form',$list);
		}

		catch(BlankEnrollmentException $e)
		{
			$list['message'] = $e->getMessage();
            $list['courses'] = $courses;
            $list['flag'] = 0;

            return $this->load_view('enroll_form',$list);
		}

		redirect('dashboard');
	}

	public function unenroll()
	{
		$courses = array();
		$enrollments = $this->member->enrollments;
		foreach($enrollments as $enrollment)
		{
			if($enrollment->is_active == 1)
			{
				$courses[] = $enrollment->course;
			}
			
		}

		if($_SERVER['REQUEST_METHOD'] !== 'POST')
		{
			$list['courses'] = $courses;
			$list['flag'] = 1;

			return $this->load_view('enroll_form',$list);
		}
		
		$enrollment = Enrollment::find_valid_by_course_id_and_member_id($_POST['course_id'],$this->member->id);

		if($enrollment)
		{
			$enrollment->delete();
		}

		redirect('dashboard');
				
	}

	public function deactivate()
	{
		$courses = array();
		$enrollments = $this->member->enrollments;
		foreach($enrollments as $enrollment)
		{
			if($enrollment->is_active == 1)
			{
				$courses[] = $enrollment->course;
			}
			
		}

		if($_SERVER['REQUEST_METHOD'] !== 'POST')
		{
			$list['courses'] = $courses;
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
		$courses = array();
		$enrollments = $this->member->enrollments;
		foreach($enrollments as $enrollment)
		{
			if($enrollment->is_active == 0 && $enrollment->is_deleted == 0)
			{
				$courses[] = $enrollment->course;
			}
			
		}

		if($_SERVER['REQUEST_METHOD'] !== 'POST')
		{
			$list['courses'] = $courses;
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