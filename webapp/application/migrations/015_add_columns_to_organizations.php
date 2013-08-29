<?php

class Migration_Add_columns_to_organizations extends CI_Migration
{
	public function up()
	{
		$fields = array(
			'member_count'=>array(
				'type'=>'int'
				),
			'org_enrollment_count'=>array(
				'type'=>'int'
				
				)
			);

		$this->dbforge->add_column('organizations',$fields);

	}

	public function down()
	{
		$this->dbforge->drop_column('organizations','member_count');
		$this->dbforge->drop_column('organizations','org_enrollment_count');
	}
}