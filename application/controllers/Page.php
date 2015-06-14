<?php 

class Page extends Frontend_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('page_model');
	}


	public function index(){

	}


	public function create(){
		$data = ['title'		=> 'My title, changed',
				 'body'			=> 'some body also changed bla bla'];

		$id = $this->page_model->update(6, $data);
		var_dump($id);
	}


	public function delete(){
		$this->page_model->delete(6);
	}

}

 ?>