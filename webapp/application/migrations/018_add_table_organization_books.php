<?php

class Migration_Add_table_organization_books extends CI_Migration
{
	public function up()
	{
		$Paroms = array(
			'id'=>array(
				'type'=>'int',
				'constraint'=>5,
				'auto_increment'=>true
				),
			'book_id'=>array(
				'type'=>'int'
				),
			'org_id'=>array(
				'type'=>'int'
				),
			'total_books'=>array(
				'type'=>'int'
				),
			'available_books'=>array(
				'type'=>'int'
				),
			'issued_books'=>array(
				'type'=>'int'
				),
			'is_active'=>array(
				'type'=>'int'
				),
			'is_deleted'=>array(
				'type'=>'int'				
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
		$this->dbforge->create_table('organization_books');

	}

	public function down()
	{
		$this->dbforge->drop_table('organization_books');
	}
}