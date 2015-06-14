<?php 

class Migration_CreateUsers extends CI_Migration{

	//up is function for CREATE users table
	public function up(){
		$this->dbforge->add_field([
			'id' 	 	=>   ['type'		   => 'INT',
						 	  'constraint'     => '11',
						  	  'unsigned'	   => TRUE,
						  	  'auto_increment' => TRUE],

			'email'	 	=> 	 ['type' 	   => 'VARCHAR',
							  'constraint' => '100'],

			'name'		=>   ['type' 	   => 'VARCHAR',
							  'constraint' => '100'],

			'password' 	=>	 ['type' 	   => 'VARCHAR',
							  'constraint' => '1000'],

			'created TIMESTAMP',
			'modified TIMESTAMP'
		]);

		$this->dbforge->add_key('id', TRUE); //add "id" as key, true for setting it as primary key
		$this->dbforge->create_table('users');
	}


	//down is function for DROP users table
	public function down(){
		$this->dbforge->drop_table('users');
	}

}

 ?>