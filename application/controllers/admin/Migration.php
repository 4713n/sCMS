<?php 

class Migration extends Admin_Controller{

	public function __construct(){
		parent::__construct();
	}


	public function index(){
		
		$this->load->library('migration');

		/* "migration->current()" below will look for current
			"migration_version" (application/config/migration)
			then look for file starting with that number inside 
			"application/migrations" and then run that migration
			(for example: migration_version is "1", then it looks 
			for a file starting with "001_") */
	
		if( !$this->migration->current() ){
			show_error( $this->migration->error_string() );
		}
		else{
			echo "Migration complete";
		}
	}

}

 ?>