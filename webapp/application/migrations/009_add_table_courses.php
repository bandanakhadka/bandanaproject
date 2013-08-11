<?php

class Migration_Add_table_courses extends CI_Migration
{
	public function up()
	{
		$Paroms = array(
			'id'=>array(
				'type'=>'int',
				'constraint'=>5,
				'auto_increment'=>true
				),
			'course_code'=>array(
				'type'=>'varchar',
				'constraint'=>256
				),
			'course_name'=>array(
				'type'=>'varchar',
				'constraint'=>256
				),
			'duration_in_hrs'=>array(
				'type'=>'int',
				'constraint'=>5
				),
			'category'=>array(
				'type'=>'varchar',
				'constraint'=>256
				),
			'created_at'=>array(
				'type'=>'datetime'
				),
			'updated_at'=>array(
				'type'=>'datetime')
			);

		$this->dbforge->add_field($Paroms);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table('courses');

	}

	public function down()
	{
		$this->dbforge->drop_table('courses');
	}
}