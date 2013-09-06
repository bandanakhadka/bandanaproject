<?php

include_once('Exceptions.php');

class User extends ActiveRecord\Model
{
    static $table_name = 'users';
    static $primary_key = 'id';

    static $belongs_to = array(
        array('member',
        'class_name'=>'Member',
        'foreign_key'=>'member_id')
    );

    public function set_user_name($user_name)
    {
        if ($user_name=='')
        {
            throw new BlankUserNameException("User Name Required!");
        }

        if($this->is_new_record())
        {
            if(User::exists(array('user_name'=>$user_name)))
            { 
                throw new UnavailableUserNameException("Username already exists! Enter a new username."); 
            }
        }

        else
        {
            if (User::exists(array('conditions'=>array('user_name = ? and id!= ?',$user_name,$this->id))))
            {                
                throw new UnavailableUserNameException("Username already exists! Enter a new username.");
            }
        }

        $this->assign_attribute('user_name',$user_name);
    } 


    /*public function set_user_name($user_name)
    {
        if($user_name=='')
        {
            throw new BlankUserNameException("User Name Required!");              
        }
      
        $user = User::find('all',array('conditions'=>array('user_name = ?',$user_name)));

        if($user)
        {
            throw new UnavailableUserNameException("Username already exists! Enter a new username.");
        }

        $this->assign_attribute('user_name',$user_name);
    }*/

    public function set_password($password)
	{
        if($password=='')
        {
            throw new BlankPasswordException("Password Required!");              
        }
        
    	$this->assign_attribute('password',sha1($password));
    }

    public function set_email($email)
	{
    	$this->assign_attribute('email',$email);
    }

    public function set_member($member)
    {
        $this->assign_attribute('member_id',$member->id);
    }

    public function get_user_name()
    {
        return $this->read_attribute('user_name');
    }

    public function get_password()
	{
    	return $this->read_attribute('password');
    }

    public function get_email()
    {
        return $this->read_attribute('email');
    }


    public static function check_login($data)
    {
        $password = sha1($data['password']);
        $user = User::find_by_user_name($data['user_name']);
        
        if(!$user)
        {
            throw new UserInvalidException("Invalid Username!");
        }

        if($user->password==$password)
        {
            return $user;
        }
        
        throw new UserPasswordInvalidException("Invalid Password!");
    }

    public static function create($data)
    {
    	$user = new User();

        $user->user_name = $data['user_name'];
    	$user->email = $data['email'];
    	$user->password = $data['password'];

        if($data['password']!=$data['confirm_password'])
        {
            throw new ConfirmPasswordException("Your password does not match!");
        }

        $user->save();

    	return $user;

    }

}