<?php

class Migration_Add_table_organizations extends CI_Migration
{
	public function up()
	{
		$Paroms = array(
			'id'=>array(
				'type'=>'int',
				'constraint'=>5,
				'auto_increment'=>true
				),
			'name'=>array(
				'type'=>'varchar',
				'constraint'=>256
				),
			'address'=>array(
				'type'=>'varchar',
				'constraint'=>256
				),
			'telephone'=>array(
				'type'=>'varchar',
				'constraint'=>256
				),
			'email'=>array(
				'type'=>'varchar',
				'constraint'=>256
				),
			'created_at'=>array(
				'type'=>'datetime'
				),
			'updated_at'=>array(
				'type'=>'datetime'
				)

			);
		$this->dbforge->add_field($Paroms);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table('organizations');

	}

	public function down()
	{
		$this->dbforge->drop_table('organizations');
	}
}