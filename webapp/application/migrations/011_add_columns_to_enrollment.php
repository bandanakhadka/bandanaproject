<?php

class Migration_Add_columns_to_enrollment extends CI_Migration
{
	public function up()
	{
		$fields = array(
			'is_active'=>array(
				'type'=>'int'
				),
			'is_deleted'=>array(
				'type'=>'int'
				
				)
			);

		$this->dbforge->add_column('enrollment',$fields);

	}

	public function down()
	{
		$this->dbforge->drop_column('enrollment','is_active');
		$this->dbforge->drop_column('enrollment','is_deleted');
	}
}