<?php

class BlankNameException extends Exception
{}

class BlankOrgAddressException extends Exception
{}

class BlankTelephoneException extends Exception
{}

class BlankOrgEmailException extends Exception
{}

class Organization extends ActiveRecord\Model
{

    static $table_name = 'organizations';
    static $primary_key = 'id';

    static $has_many = array(
        array(
        'members',
        'class_name'=>'Member',
        'foreign_key'=>'organization_id')
    );

    public function set_name($name)
	{
        if($name=='')
        {
            throw new BlankNameException("Organization Name Required!");              
        }

    	$this->assign_attribute('name',$name);
    }

    public function set_address($address)
    {
        if($address=='')
        {
            throw new BlankOrgAddressException("Address Required!");              
        }

        $this->assign_attribute('address',$address);
    }

    public function set_telephone($telephone)
    {
        if($telephone=='')
        {
            throw new BlankTelephoneException("Telephone Required!");              
        }

        $this->assign_attribute('telephone',$telephone);
    }

    public function set_email($email)
	{
        if($email=='')
        {
            throw new BlankOrgEmailException("Email Address Required!");              
        }

    	$this->assign_attribute('email',$email);
    }

    public function list_all()
    {
    	$organization = Organization::find('all');
    	return $organization;
    }

    public static function create($data)
    {
    	$organization = new Organization();

    	$organization->name = $data['name'];
        $organization->address = $data['address'];
        $organization->telephone = $data['telephone'];
    	$organization->email = $data['email'];

        $organization->save();
    }

}