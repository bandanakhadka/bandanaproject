<?php

class OrganizationEnrollmentTest extends CIUnit_TestCase
{
	protected $tables = array(
		'organization_enrollment'=>'organization_enrollment',
		'courses'=>'courses',
		'organizations'=>'organizations'
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
		$org_enrollment = new OrganizationEnrollment();
		$course = Course::find_by_id($this->courses_fixt['1']['id']);
		$org_enrollment->course = $course;
		$this->assertEquals($org_enrollment->course_id,$course->id);
	}

	public function test_set_course_inactive_exception()
	{
		$org_enrollment = new OrganizationEnrollment();
		$course = Course::find_by_id($this->courses_fixt['2']['id']);
		$this->setExpectedException('InactiveException');
		$org_enrollment->course = $course;
	}

	public function test_set_course_deleted_exception()
	{
		$org_enrollment = new OrganizationEnrollment();
		$course = Course::find_by_id($this->courses_fixt['3']['id']);
		$this->setExpectedException('DeletedException');
		$org_enrollment->course = $course;
	}

	public function test_set_organization()
	{
		$org_enrollment = new OrganizationEnrollment();
		$organization = Organization::find_by_id($this->organizations_fixt['1']['id']);
		$org_enrollment->organization = $organization;
		$this->assertEquals($org_enrollment->org_id,$organization->id);
	}

	public function test_set_organization_inactive_exception()
	{
		$org_enrollment = new OrganizationEnrollment();
		$organization = Organization::find_by_id($this->organizations_fixt['2']['id']);
		$this->setExpectedException('InactiveException');
		$org_enrollment->organization = $organization;
	}

	public function test_set_organization_deleted_exception()
	{
		$org_enrollment = new OrganizationEnrollment();
		$organization = Organization::find_by_id($this->organizations_fixt['3']['id']);
		$this->setExpectedException('DeletedException');
		$org_enrollment->organization = $organization;
	}

	public function test_create_with_exception()
	{

		$course = Course::find_by_id($this->courses_fixt['1']['id']);
		$organization = Organization::find_by_id($this->organizations_fixt['1']['id']);

		$this->setExpectedException('EnrollmentException');
		$org_enrollment = OrganizationEnrollment::create(array(
		 			'course'=>$course,
		 			'organization'=>$organization	 		
		 			)
				);		
	}
	
	public function test_create()
	{
		$course = Course::find_by_id($this->courses_fixt['4']['id']);
		$organization = Organization::find_by_id($this->organizations_fixt['1']['id']);
		
		$org_enrollment = OrganizationEnrollment::create(array(
		 			'course'=>$course,
		 			'organization'=>$organization	 		
		 			)
				);

		$this->assertEquals($org_enrollment->course_id,$course->id);
		$this->assertEquals($org_enrollment->org_id,$organization->id);
		$this->assertEquals($org_enrollment->is_active,1);
		$this->assertEquals($org_enrollment->is_deleted,0);
	}

	public function test_create_new_if_deleted()
	{
		
		$course = Course::find_by_id($this->courses_fixt['4']['id']);
		$organization = Organization::find_by_id($this->organizations_fixt['4']['id']);
		
		$org_enrollment = OrganizationEnrollment::create(array(
		 			'course'=>$course,
		 			'organization'=>$organization	 		
		 			)
				);

		$this->assertEquals($org_enrollment->course_id,$course->id);
		$this->assertEquals($org_enrollment->org_id,$organization->id);
		$this->assertEquals($org_enrollment->is_active,1);
		$this->assertEquals($org_enrollment->is_deleted,0);		
	}

}