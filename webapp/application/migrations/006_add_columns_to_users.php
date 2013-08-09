<?php

class Migration_Add_columns_to_users extends CI_Migration
{
	public function up()
	{
		$fields = array(
			'member_id'=>array(
				'type'=>'int'
				)
			);

		$this->dbforge->add_column('users',$fields);

	}

	public function down()
	{
		$this->dbforge->drop_column('users','member_id');
	}
}