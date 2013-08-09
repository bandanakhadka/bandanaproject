<?php

class Migration_Add_table_members extends CI_Migration
{
	public function up()
	{
		$Paroms = array(
			'id'=>array(
				'type'=>'int',
				'constraint'=>5,
				'auto_increment'=>true
				),
			'first_name'=>array(
				'type'=>'varchar',
				'constraint'=>256
				),
			'last_name'=>array(
				'type'=>'varchar',
				'constraint'=>256
				),
			'sex'=>array(
				'type'=>'varchar',
				'constraint'=>256
				),
			'email'=>array(
				'type'=>'varchar',
				'constraint'=>256
				)


			);
		$this->dbforge->add_field($Paroms);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table('members');

	}

	public function down()
	{
		$this->dbforge->drop_table('members');
	}
}