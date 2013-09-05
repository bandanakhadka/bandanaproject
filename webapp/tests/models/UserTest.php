<?php

class UserTest extends CIUnit_TestCase
{
	protected $tables = array(
		'users'=>'users',
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

	public function test_set_username()
	{
		$user = new User();
		$user->user_name = "bandana";
		$this->assertEquals($user->user_name,"bandana");
	}

	public function test_set_username_while_editing()
	{
		$user = new User();
		$user->user_name = "bandana";
		$user->save();
		$user->user_name = "asdf";
		$this->assertEquals($user->user_name,"asdf");
	}

	public function test_set_password()
	{
		$user = new User();
		$user->password = "bandana";
		$this->assertEquals($user->password,sha1("bandana"));
	}

	public function test_set_email()
	{
		$user = new User();
		$user->email = "bandana";
		$this->assertEquals($user->email,"bandana");
	}

	public function test_set_member()
	{
		$member = Member::find_by_id($this->member_fixt['1']['id']);
		$user = new User();
		$user->member = $member;
		$this->assertEquals($user->member_id,$member->id);
	}

	public function test_username_exception()
	{
		$user = new User();
		$this->setExpectedException('BlankUserNameException');
		$user->user_name = "";
	}

	public function test_username_unavailable_exception_for_new_record()
	{
		$user = new User();
		$user->user_name='aaaa';
		$user->save();

		$new_user = new User();
		$this->setExpectedException('UnavailableUserNameException');
		$new_user->user_name = "aaaa";
	}

	public function test_username_unavailable_exception_for_existing_record()
	{
		$user = new User();
		$user->user_name = "bandana";
		$user->save();

		$new_user = new User();
		$new_user->user_name = "asdf";
		$new_user->save();
		$this->setExpectedException('UnavailableUserNameException');
		$new_user->user_name = "bandana";

	}

	public function test_password_exception()
	{
		$user = new User();
		$this->setExpectedException('BlankPasswordException');
		$user->password = "";
	}

	public function test_create_with_exception()
	{
		$this->setExpectedException('ConfirmPasswordException');
		$user = User::create(array(
		 			'user_name'=>'aaaa',
		 			'password'=>'aaaa',
		 			'confirm_password'=>'ghj',
		 			'email'=>'bandana@mail.com'
		 			)
				);
	}

	public function test_create()
	{
		$user = User::create(array(
		 			'user_name'=>'aaaa',
		 			'password'=>'aaaa',
		 			'confirm_password'=>'aaaa',
		 			'email'=>'bandana@mail.com'
		 			)
				);

		$this->assertEquals($user->user_name,'aaaa');
		$this->assertEquals($user->password,sha1('aaaa'));
		$this->assertEquals($user->email,'bandana@mail.com');
	}

	public function test_check_login_invalid_user()
	{
		$this->setExpectedException("UserInvalidException");
		$user = User::check_login(array('user_name'=>'bandana','password'=>''));
	}

	public function test_check_login_invalid_password()
	{
		$this->setExpectedException("UserPasswordInvalidException");
		$user = User::check_login(array('user_name'=>'user','password'=>''));
	}

	public function test_check_login_valid()
	{
		$user = User::check_login(array('user_name'=>'user','password'=>'bbb'));
		$user1 = User::find_by_id($this->users_fixt['1']['id']);
		$this->assertEquals($user->id,$user1->id);
	}

}