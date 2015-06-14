<?php 

class User_model extends MY_Model{

	protected $_table_name = 'users';
	public $order_by = 'name DESC';
	//validation rules
	public $rules = ['username' => 	['field'	=> 'username', //can be name/email
					 			 	 'label' 	=> 'Username',
					 			 	 'rules' 	=> 'trim|required'],
					 
					 'password' =>	['field'	=> 'password',
					 			 	 'label' 	=> 'Password',
					 			 	 'rules' 	=> 'trim|required'] ];
	//admin validation rules
	public $rules_admin = ['name' 	=>	['field'	=> 'name',
				 			 	 	  	 'label' 	=> 'Name',
						 			  	 'rules' 	=> 'trim|required|callback__uniqueName'], //when editing user, username must be unique (custom validation fn)

						   'email' 	=>	['field'	=> 'email',
				 			 	 	  	 'label' 	=> 'Email',
						 			  	 'rules' 	=> 'trim|required|callback__uniqueEmail'], //also unique email

						   'password' 	=>	['field'	=> 'password',
						 			  		 'label' 	=> 'Password',
						 			  		 'rules' 	=> 'trim|matches[password_confirm]'], //when editing user, password is NOT required (if we dont neeed to update password too)
						   
						   'password_confirm'	=>	['field'	=> 'password_confirm',
							 			  		  	 'label' 	=> 'Confirm password',
							 					   	 'rules' 	=> 'trim|matches[password]'] ];

	function __construct(){
		parent::__construct();
	}


	public function login(){

		//get single result (second parameter=true) that matches "email" and "password"
		$user = $this->get_by('(name = "' . $this->input->post('username') . '" ' . 
							  'OR email = "' . $this->input->post('username') . '") ' .
							  'AND password = "' . $this->hashPassword($this->input->post('password')) . '"',
							  TRUE);
		

		if(count($user) > 0 ){
			//log in user with returned data in "user" var
			$data = ['id'			=> $user->id,
					 'name'			=> $user->name,
					 'email'	  	=> $user->email,
					 'isLoggedIn'	=> TRUE];

			$this->session->set_userdata($data);
		}
	}


	public function logout(){
		$this->session->sess_destroy();
	}


	public function isLoggedIn(){
		/* returns BOOLEAN */
		
		return (boolean) $this->session->userdata('isLoggedIn');
	}


	public function hashPassword($string){
		/* returns "string" hash with some salts */

		return hash('sha512', strlen($string) . $string . config_item('encryption_key'));
	}


	public function getEmptyUser(){
		/* create new empty user class */

		$user = new stdClass();

		$user->name = '';
		$user->email = '';
		$user->password = '';
		
		return $user;
	}
}

 ?>