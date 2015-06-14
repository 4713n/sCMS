<?php 

class ControlPanel extends Admin_Controller{

	public function __construct(){
		parent::__construct();
	}


	public function index(){
		$this->data['contentView'] = 'admin/controlpanel/index';
		$this->load->view('admin/_layout_main', $this->data);
	}


	public function modal(){
		$this->load->view('admin/_layout_login', $this->data);
	}
}

 ?>