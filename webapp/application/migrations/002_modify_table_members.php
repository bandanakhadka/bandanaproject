<?php

class Migration_Modify_table_members extends CI_Migration
{
	public function up()
	{
		$fields = array(
			'address'=>array(
				'type'=>'varchar',
				'constraint'=>256
				),
			'contact_number'=>array(
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

		$this->dbforge->add_column('members',$fields);

	}

	public function down()
	{
		$this->dbforge->drop_column('members','address');
		$this->dbforge->drop_column('members','contact_number');
		$this->dbforge->drop_column('members','created_at');
		$this->dbforge->drop_column('members','updated_at');
	}
}