<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->data['page_title'] = 'sCMS';

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('user_model');


		//redirect to login page, if user is not logged (except login, logout pages)
		if( !$this->user_model->isLoggedIn() ){
			if( !(uri_string()=='admin/user/login' || uri_string()=='admin/user/logout') ){
				redirect('admin/user/login');
			}
		}
	}

}

 ?>