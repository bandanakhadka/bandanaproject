<?php

class EnrollmentTest extends CIUnit_TestCase
{
	protected $tables = array(
		'enrollment'=>'enrollment',
		'courses'=>'courses',
		'member'=>'member'
		);

	public function __construct()
	{
		parent::__construct();
	}

	public function setUp()
	{
		parent::setUp();
	}

	public function tearDown()
	{
		parent::tearDown();
	}

	public function test_set_course()
	{
		$enrollment = new Enrollment();
		$course = Course::find_by_id($this->courses_fixt['1']['id']);
		$enrollment->course = $course;
		$this->assertEquals($enrollment->course_id,$course->id);
	}

	public function test_set_course_inactive_exception()
	{
		$enrollment = new Enrollment();
		$course = Course::find_by_id($this->courses_fixt['2']['id']);
		$this->setExpectedException('InactiveException');
		$enrollment->course = $course;		
	}

	public function test_set_course_deleted_exception()
	{
		$enrollment = new Enrollment();
		$course = Course::find_by_id($this->courses_fixt['3']['id']);
		$this->setExpectedException('DeletedException');
		$enrollment->course = $course;		
	}

	public function test_set_member()
	{
		$enrollment = new Enrollment();
		$member = Member::find_by_id($this->member_fixt['1']['id']);
		$enrollment->member = $member;
		$this->assertEquals($enrollment->member_id,$member->id);
	}

	public function test_set_member_inactive_exception()
	{
		$enrollment = new Enrollment();
		$member = Member::find_by_id($this->member_fixt['2']['id']);
		$this->setExpectedException('InactiveException');
		$enrollment->member = $member;
	}

	public function test_set_member_deleted_exception()
	{
		$enrollment = new Enrollment();
		$member = Member::find_by_id($this->member_fixt['3']['id']);
		$this->setExpectedException('DeletedException');
		$enrollment->member = $member;
	}

	public function test_create_with_exception()
	{
		$course = Course::find_by_id($this->courses_fixt['4']['id']);
		$member = Member::find_by_id($this->member_fixt['1']['id']);
		
		$this->setExpectedException('UnavailableEnrollmentException');
		$enrollment = Enrollment::create(array(
		 			'course'=>$course,
		 			'member'=>$member 		
		 			)
				);		
	}
	
	public function test_create()
	{
		$course = Course::find_by_id($this->courses_fixt['1']['id']);
		$member = Member::find_by_id($this->member_fixt['1']['id']);
		
		$enrollment = Enrollment::create(array(
		 			'course'=>$course,
		 			'member'=>$member	 		
		 			)
				);

		$this->assertEquals($enrollment->course_id,$course->id);
		$this->assertEquals($enrollment->member_id,$member->id);
		$this->assertEquals($enrollment->is_active,1);
		$this->assertEquals($enrollment->is_deleted,0);
	}

	public function test_create_new_if_deleted()
	{
		$course = Course::find_by_id($this->courses_fixt['1']['id']);
		$member = Member::find_by_id($this->member_fixt['4']['id']);
		
		$enrollment = Enrollment::create(array(
		 			'course'=>$course,
		 			'member'=>$member 		
		 			)
				);

		$this->assertEquals($enrollment->course_id,$course->id);
		$this->assertEquals($enrollment->member_id,$member->id);
		$this->assertEquals($enrollment->is_active,1);
		$this->assertEquals($enrollment->is_deleted,0);		
	}

	public function test_create_exception_if_deactivated()
	{
		$course = Course::find_by_id($this->courses_fixt['4']['id']);
		$member = Member::find_by_id($this->member_fixt['4']['id']);
		
		$this->setExpectedException('UnavailableEnrollmentException');
		$enrollment = Enrollment::create(array(
		 			'course'=>$course,
		 			'member'=>$member 		
		 			)
				);		
	}


}