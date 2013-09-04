<?php

class OrganizationTest extends CIUnit_TestCase
{
	protected $tables = array(
		'organizations'=>'organizations',
		'organization_enrollment'=>'organization_enrollment',
		'member'=>'member', 
		'courses'=>'courses'
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

	public function test_set_name()
	{
		$organization = new Organization();
		$organization->name = "Olive Media";
		$this->assertEquals($organization->name,"Olive Media");
	}

	public function test_set_address()
	{
		$organization = new Organization();
		$organization->address = "chabahil";
		$this->assertEquals($organization->address,"chabahil");
	}

	public function test_set_telephone()
	{
		$organization = new Organization();
		$organization->telephone = 123456;
		$this->assertEquals($organization->telephone,123456);
	}

	public function test_set_email()
	{
		$organization = new Organization();
		$organization->email = "olivemedia@mail.com";
		$this->assertEquals($organization->email,"olivemedia@mail.com");
	}

	public function test_regenerate()
	{
		$organization = Organization::find_by_id(1);

		$this->assertEquals($organization->member_count,0);
		$this->assertEquals($organization->org_enrollment_count,0);

		$organization->regenerate();

		$this->assertEquals($organization->member_count,2);
		$this->assertEquals($organization->org_enrollment_count,1);
	}

	public function test_count_members()
	{
		$method = new ReflectionMethod('Organization', 'count_members');
		$method->setAccessible(true);

		$organization = Organization::find_by_id(1);
		$value = $method->invoke($organization);
		$this->assertEquals($value,2);
	}

	public function test_name_exception()
	{
		$organization = new Organization();
		$this->setExpectedException('BlankNameException');
		$organization->name = "";
	}

	public function test_address_exception()
	{
		$organization = new Organization();
		$this->setExpectedException('BlankOrgAddressException');
		$organization->address = "";
	}

	public function test_telephone_exception()
	{
		$organization = new Organization();
		$this->setExpectedException('BlankTelephoneException');
		$organization->telephone = "";
	}

	public function test_email_exception()
	{
		$organization = new Organization();
		$this->setExpectedException('BlankOrgEmailException');
		$organization->email = "";
	}
	
	public function test_create()
	{
		$organization = Organization::create(array(
		 			'name'=> 'Olive Media',
		 			'address'=>'chabahil',
		 			'telephone'=>123456,
		 			'email'=>'olivemedia@mail.com',		 		
		 			)
				);

		$this->assertEquals($organization->name,'Olive Media');
		$this->assertEquals($organization->address,'chabahil');
		$this->assertEquals($organization->telephone,123456);
		$this->assertEquals($organization->email,'olivemedia@mail.com');
	}

	public function test_enroll_members_in_course()
	{
		$organization = Organization::find_by_id($this->organizations_fixt['1']['id']);
		$org_enrollment = OrganizationEnrollment::find_by_id($this->organization_enrollment_fixt['1']['id']);

		$organization->enroll_members_in_course($org_enrollment->course);

		foreach($organization->members as $member)
		{
			$enrollment = Enrollment::find_by_member_id_and_course_id($member->id,$org_enrollment->course_id);
			$this->assertEquals($enrollment->member_id,$member->id);
			$this->assertEquals($enrollment->course_id,$org_enrollment->course_id);
		}
	}

}