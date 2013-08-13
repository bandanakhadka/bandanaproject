<?php

class BlankFirstNameException extends Exception
{}

class BlankLastNameException extends Exception
{}

class BlankSexException extends Exception
{}

class BlankAddressException extends Exception
{}

class BlankContactException extends Exception
{}

class BlankEmailException extends Exception
{}

class BlankOrganizationException extends Exception
{}

class Member extends ActiveRecord\Model
{

    static $table_name = 'member';
    static $primary_key = 'id';

    static $has_one = array(
        array(
        'user',
        'class_name'=>'User',
        'foreign_key'=>'member_id')
    );

    static $belongs_to = array(
            array('organization',
            'class_name'=>'Organization',
            'foreign_key'=>'organization_id')
    );

    static $has_many = array(
        array(
        'enrollments',
        'class_name'=>'Enrollment',
        'foreign_key'=>'member_id'
        /*'conditions'=> array('is_deleted'=>0)*/)
    );

    public function set_first_name($first_name)
	{
        if($first_name=='')
        {
            throw new BlankFirstNameException("First Name Required!");              
        }

    	$this->assign_attribute('first_name',$first_name);
    }

    public function set_last_name($last_name)
	{
        if($last_name=='')
        {
            throw new BlankLastNameException("Last Name Required!");                
        }

    	$this->assign_attribute('last_name',$last_name);
    }

    public function set_address($address)
    {
        if($address=='')
        {
            throw new BlankAddressException("Address field cannot be empty!");                
        }

        $this->assign_attribute('address',$address);
    }

    public function set_contact_number($contact_number)
    {
        if($contact_number=='')
        {
            throw new BlankContactException("Contact number required!");                
        }

        $this->assign_attribute('contact_number',$contact_number);
    }

    public function set_sex($sex)
	{
        if($sex=='')
        {
            throw new BlankSexException("Sex field cannot be empty!");                
        }

    	$this->assign_attribute('sex',$sex);
    }

    public function set_email($email)
	{
        if($email=='')
        {
            throw new BlankEmailException("Email Address Required!");                
        }

    	$this->assign_attribute('email',$email);
    }

    public function set_organization($organization)
    {
        if(!$organization)
        {
            throw new BlankOrganizationException("Please select an Organization!");                
        }
        $this->assign_attribute('organization_id',$organization->id);
    }

    public function get_first_name()
	{
    	return $this->read_attribute('first_name');
    }

    public function get_last_name()
	{
    	return $this->read_attribute('last_name');
    }

    public function get_sex()
	{
    	return $this->read_attribute('sex');
    }

    public function get_email()
	{
    	return $this->read_attribute('email');
    }

    public static function create($data)
    {
    	$member = new Member();

    	$member->first_name = $data['first_name'];
    	$member->last_name = $data['last_name'];
    	$member->sex = $data['sex'];
        $member->address = $data['address'];
        $member->contact_number = $data['contact_number'];
    	$member->email = $data['email'];
        $member->organization = $data['organization'];

        $user = User::create(array(
            'user_name' => $data['user_name'],
            'password' => $data['password'],
            'confirm_password' =>$data['confirm_password'],
            'email' => $data['email'])
        );

        $member->save();
       
        $user->member = $member;
        $user->save();

    	return $member;

    }

    public function delete()
    {
        $this->is_active = 0;
        $this->is_deleted = 1;

        $this->save();
    }

    public function deactivate()
    {
        $this->is_active = 0;
        $this->is_deleted = 0;

        $this->save();
    }

    public function activate()
    {
        $this->is_active = 1;
        $this->is_deleted = 0;

        $this->save();
    }

}