<?php

class MemberTest extends CIUnit_TestCase
{
	protected $tables = array(
		'member'=>'member',
		'users'=>'users',
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

	public function test_set_first_name()
	{
		$member = new Member();
		$member->first_name = "bandana";
		$this->assertEquals($member->first_name,"bandana");
	}

	public function test_set_last_name()
	{
		$member = new Member();
		$member->last_name = "khadka";
		$this->assertEquals($member->last_name,"khadka");
	}

	public function test_set_sex()
	{
		$member = new Member();
		$member->sex = "Female";
		$this->assertEquals($member->sex,"Female");
	}

	public function test_set_address()
	{
		$member = new Member();
		$member->address = "ktm";
		$this->assertEquals($member->address,"ktm");
	}

	public function test_set_contact_number()
	{
		$member = new Member();
		$member->contact_number = 234456;
		$this->assertEquals($member->contact_number,234456);
	}

	public function test_set_email()
	{
		$member = new Member();
		$member->email = "bandana@mail.com";
		$this->assertEquals($member->email,"bandana@mail.com");
	}

	public function test_set_organization()
	{
		$member = new Member();
		$organization = Organization::find_by_id($this->organizations_fixt['1']['id']);
		$member->organization = $organization;
		$this->assertEquals($member->organization_id,$organization->id);
	}

	public function test_set_mock_organization()
	{ 
 		$member = new Member();
        $mock = $this->getMockBuilder('Organization')
        			 ->disableOriginalConstructor()
        			 ->getMock();

        $member->organization = $mock;
        $this->assertNull($member->organization_id);
 		$this->assertNull($mock->id);      
	}

	public function test_set_organization_is_active()
	{
		$member = new Member();
		$organization = Organization::find_by_id($this->organizations_fixt['2']['id']);
		$this->setExpectedException('InactiveException');
		$member->organization = $organization;
	}

	public function test_set_organization_is_deleted()
	{
		$member = new Member();
		$organization = Organization::find_by_id($this->organizations_fixt['3']['id']);
		$this->setExpectedException('DeletedException');
		$member->organization = $organization;
	}

	public function test_first_name_exception()
	{
		$member = new Member();
		$this->setExpectedException('BlankFirstNameException');
		$member->first_name = "";
	}

	public function test_last_name_exception()
	{
		$member = new Member();
		$this->setExpectedException('BlankLastNameException');
		$member->last_name = "";
	}

	public function test_sex_exception()
	{
		$member = new Member();
		$this->setExpectedException('BlankSexException');
		$member->sex = "";
	}

	public function test_address_exception()
	{
		$member = new Member();
		$this->setExpectedException('BlankAddressException');
		$member->address = "";
	}

	public function test_contact_exception()
	{
		$member = new Member();
		$this->setExpectedException('BlankContactException');
		$member->contact_number = "";
	}

	public function test_email_exception()
	{
		$member = new Member();
		$this->setExpectedException('BlankEmailException');
		$member->email = "";
	}

	public function test_organization_exception()
	{
		$member = new Member();
		$this->setExpectedException('InvalidOrganizationException');
		$member->organization = NULL;
		$this->setExpectedException('InvalidOrganizationException');
		$member->organization = 'usfiw fiuey';
	}

	public function test_create()
	{
		$organization = Organization::find_by_id($this->organizations_fixt['1']['id']);

		$member = Member::create(array(
		 			'first_name'=> 'bandana',
		 			'last_name'=>'khadka',
		 			'sex'=>'Female',
		 			'address'=>'ktm',		 		
		 			'contact_number'=>234456,
		 			'email'=>'bandana@mail.com',
		 			'organization'=>$organization
		 			)
				);

		$this->assertEquals($member->first_name,'bandana');
		$this->assertEquals($member->last_name,'khadka');
		$this->assertEquals($member->sex,'Female');
		$this->assertEquals($member->address,'ktm');
		$this->assertEquals($member->contact_number,234456);
		$this->assertEquals($member->email,'bandana@mail.com');
		$this->assertEquals($member->organization_id, $organization->id);
		$this->assertEquals($member->is_active,1);
		$this->assertEquals($member->is_deleted,0);
	}

}