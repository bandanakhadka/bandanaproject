<?php

include_once('Exceptions.php');

class Organization extends BaseModel
{

    static $table_name = 'organizations';
    static $primary_key = 'id';

    static $has_many = array(
        array(
        'members',
        'class_name'=>'Member',
        'foreign_key'=>'organization_id'),
        array(
        'organization_enrollments',
        'class_name'=>'OrganizationEnrollment',
        'foreign_key'=>'org_id')
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

    public function get_name()
    {
        return $this->read_attribute('name');
    }

    public function get_address()
    {
        return $this->read_attribute('address');
    }

    public function get_telephone()
    {
        return $this->read_attribute('telephone');
    }

    public function get_email()
    {
        return $this->read_attribute('email');
    }

    private function count_members()
    {
        $count = count($this->members);
        return $count;
    }

    private function count_org_enrollments()
    {
        $count = count($this->organization_enrollments);
        return $count;
    }

    public function regenerate()
    {
        $member_count = $this->count_members();
        $this->assign_attribute('member_count',$member_count);

        $org_enrollment_count = $this->count_org_enrollments();
        $this->assign_attribute('org_enrollment_count',$org_enrollment_count);

        $this->save();
    }

    public function enroll_members_in_course($course)
    {
        $connect = Enrollment::connection();

        try
        {
            $connect->transaction();
              
            foreach($this->members as $member)
            {
                if(!self::has_enrollments($member, $course))
                {                
                    $enrollment = Enrollment::create(array('course'=>$course, 'member'=>$member));
                } 
            }

            $connect->commit();         
        }

        catch(Exception $e)
        {
            $connect->rollback();
            throw $e;
        }
    }

    private static function has_enrollments($member, $course)
    {
        return Enrollment::exists(array(
                                'conditions'=>array(
                                'member_id = ? AND course_id = ?',$member->id,$course->id)
            )
        );
    }

    public static function create($data)
    {
    	$organization = new Organization();

    	$organization->name = $data['name'];
        $organization->address = $data['address'];
        $organization->telephone = $data['telephone'];
    	$organization->email = $data['email'];
        $organization->is_active = 1;
        $organization->is_deleted = 0;

        $organization->save();

        return $organization;
    }

}