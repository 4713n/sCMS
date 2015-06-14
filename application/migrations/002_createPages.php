<?php 

class Migration_CreatePages extends CI_Migration{

	//up is function for CREATE pages table
	public function up(){
		$this->dbforge->add_field([
			'id' 	 	=>   ['type'		   => 'INT',
						 	  'constraint'     => '11',
						  	  'unsigned'	   => TRUE,
						  	  'auto_increment' => TRUE],
			
			'title'	 	=> 	 ['type' 	   => 'VARCHAR',
							  'constraint' => '100'],

			'body'		=>   ['type' 	   => 'TEXT'],

			//slug = short name using human-readable keywords to identify a page (like "city-news-local-89" etc.)
			'slug'	 	=>	 ['type' 	   => 'VARCHAR',
							  'constraint' => '100'],

			'page_order'		=>   ['type' 	   => 'INT',
									  'constraint' => '11'],

			'created TIMESTAMP',
			'modified TIMESTAMP'
		]);

		$this->dbforge->add_key('id', TRUE); //add "id" as key, true for setting it as primary key
		$this->dbforge->create_table('pages');
	}


	//down is function for DROP pages table
	public function down(){
		$this->dbforge->drop_table('pages');
	}

}

 ?>