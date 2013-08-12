<?php

class Migration_Add_column_to_courses extends CI_Migration
{
	public function up()
	{
		$fields = array(
			'org_id'=>array(
				'type'=>'int'
				)
			);

		$this->dbforge->add_column('courses',$fields);

	}

	public function down()
	{
		$this->dbforge->drop_column('courses','org_id');
	}
}