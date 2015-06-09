<?php



/* MY_Controller extends CI_Controller with additional things like 
   initialized $data array, or loaded data[site_name] */
class MY_Controller extends CI_Controller{

	public $data = array();

	function __construct(){
		parent::__construct();
		
		$this->data['errors'] = array();
		$this->data['site_name'] = config_item('site_name');
	}

}
?>