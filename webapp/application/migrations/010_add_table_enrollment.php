<?php

class Migration_Add_table_enrollment extends CI_Migration
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
			'member_id'=>array(
				'type'=>'int',
				'constraint'=>5
				),
			'enrolled_at'=>array(
				'type'=>'datetime')
			);

		$this->dbforge->add_field($Paroms);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table('enrollment');

	}

	public function down()
	{
		$this->dbforge->drop_table('enrollment');
	}
}