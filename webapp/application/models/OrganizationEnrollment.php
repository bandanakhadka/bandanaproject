<?php

class EmptyException extends Exception
{}

class EnrollmentException extends Exception
{}

class OrganizationEnrollment extends ActiveRecord\Model
{

    static $table_name = 'organization_enrollment';
    static $primary_key = 'id';

    static $belongs_to = array(
        array(
            'organization',
            'class_name'=>'Organization',
            'foreign_key'=>'org_id'),
        array(
            'course',
            'class_name'=>'Course',
            'foreign_key'=>'course_id')
    );

    public function set_course($course)
    {
        $this->assign_attribute('course_id',$course->id);
    }

    public function set_organization($organization)
	{
    	$this->assign_attribute('org_id',$organization->id);
    }

    public static function is_empty()
    {
        throw new EmptyException("No course selected. Please select courses.");
    }

    public function check_if_exists($course,$organization)
    {
        $org_enrollment = OrganizationEnrollment::find_by_course_id_and_org_id_and_is_deleted($course->id,$organization->id,0);

        if($org_enrollment)
        {
            throw new EnrollmentException("This enrollment already exists! Select another course for enrollment.");
        }
    }

    public static function create($data)
    {
    	$org_enrollment = new OrganizationEnrollment();

    	$org_enrollment->course = $data['course'];
        $org_enrollment->organization = $data['organization'];
        $org_enrollment->is_active = 1;
        $org_enrollment->is_deleted = 0;

        self::check_if_exists( $data['course'],$data['organization']);

        $org_enrollment->save();
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