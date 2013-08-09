<?php

class Migration_Add_column_to_member extends CI_Migration
{
	public function up()
	{
		$fields = array(
			'organization_id'=>array(
				'type'=>'int'
				)
			);

		$this->dbforge->add_column('member',$fields);

	}

	public function down()
	{
		$this->dbforge->drop_column('member','organization_id');

	}
}