<?php

class Migration_Add_table_organizationenrollment extends CI_Migration
{
	public function up()
	{
		$Paroms = array(
			'id'=>array(
				'type'=>'int',
				'constraint'=>5,
				'auto_increment'=>true
				),
			'course_id'=>array(
				'type'=>'int',
				'constraint'=>5
				),
			'org_id'=>array(
				'type'=>'int',
				'constraint'=>5
				),
			'created_at'=>array(
				'type'=>'datetime'
				),
			'updated_at'=>array(
				'type'=>'datetime'
				),
			'is_active'=>array(
				'type'=>'int'
				),
			'is_deleted'=>array(
				'type'=>'int'				
				)
			);

		$this->dbforge->add_field($Paroms);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table('organization_enrollment');

	}

	public function down()
	{
		$this->dbforge->drop_table('organization_enrollment');
	}
}