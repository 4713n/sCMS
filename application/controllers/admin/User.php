<?php 

class User extends Admin_Controller{
	
	public function __construct(){
		parent::__construct();
	}


	public function index($sort=''){

		if(isset($sort)){
			$sort = $this->input->get('sort');

			//check if passed "order_by" is ok
			$order_available = ['username'	=> 'name', 
								'email'		=> 'email', 
								'added'		=> 'datetime'];

			if( array_key_exists($sort, $order_available) )
				$this->user_model->order_by = $order_available[$sort] . 'DESC';
			else
				$this->user_model->order_by = 'name DESC'; //default sort
			
		}


		//get list of all users, except current user
		$this->db->where('id !=', $this->session->userdata('id'));
		$this->data['users'] = $this->user_model->get();

		$this->data['contentView'] = 'admin/user/index';
		$this->load->view('admin/_layout_main', $this->data);
	}


	function edit($id = NULL){
		/* - edit existing user (id specified)
		   - add a new user (id not specified) */


		//disable editing actual user via this method (if id passed in url)
		if( $this->uri->segment(4)==$this->session->userdata('id') )
			redirect('admin/user');

		//if editing existing user (id!=null)
		if($id != NULL){
			$this->data['user'] = $this->user_model->get($id, NULL);
			
			//no user found with that id
			if(count($this->data['user']) < 1){
				$this->session->set_flashdata('errors', 'User could not be found');
				$this->data['user'] = $this->user_model->getEmptyUser(); //user with empty values
			}
		}
		//if creating new user (id=null)
		else{
			$this->data['user'] = $this->user_model->getEmptyUser(); //user with empty values
		}


		$rules_admin = $this->user_model->rules_admin;

		//if adding a new user (id=null), then add "required" rule for password
		if($id == NULL)
			$rules_admin['password']['rules'] = $rules_admin['password']['rules'] . '|required';

		$this->form_validation->set_rules($rules_admin);


		if($this->form_validation->run() == TRUE){
			//new user
			if($id==NULL){
				$data = $this->user_model->arrayFromPost(['name', 'email', 'password']);
				$data['password'] = $this->user_model->hashPassword($data['password']);
				$this->user_model->create($data);
			}
			
			//edit user
			else{
				if( strlen(trim($this->data['password'])) > 0 ){ //if new password is set
					$data = $this->user_model->arrayFromPost(['name', 'email', 'password']);
					$data['password'] = $this->user_model->hashPassword($data['password']);
				}
				else{ //new pwd not set, let password without changes
					$data = $this->user_model->arrayFromPost(['name', 'email']);
				}

				$this->user_model->update($id, $data);
			}

			redirect('admin/user');
		}

		$this->data['contentView'] = 'admin/user/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}


	function delete($id){
		$this->user_model->delete($id);
		redirect('admin/user');
	}


	public function login(){

		//redirect, if already logged in
		if( $this->user_model->isLoggedIn() ){
			redirect('admin/controlpanel');
		}

		$rules = $this->user_model->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == TRUE){
			if($this->user_model->login()){
				redirect('admin/controlpanel');
			}
			else{
				$this->session->set_flashdata('loginError', 'Wrong username/password');
				redirect('admin/user/login');
			}
		}
	
		$this->data['page_title'] = 'sCMS Login [Admin]';
		$this->load->view('admin/_layout_login', $this->data);
	}


	public function logout(){
		$this->user_model->logout();

		redirect('admin/user/login');
	}


	/* function with "_" prefix (for example "public function _uniqueName()") is NOT accessible from URL
	   private functions are also hidden from url, but for this specific function it needs to be done via 
	   "_" prefix (works only with codeigniter), because this fn needs to be called from other class and that 
	   cant be done when fn is private */
	public function _uniqueName($string=NULL){
		/* check if given name exists, but current user is exception */
		
		$this->db->where('name', $this->input->post('name'));

		//..except name of current user (segment 4 contains user id)
		if( $this->uri->segment(4) ){
			$this->db->where('id !=', $this->uri->segment(4));
		}

		$user = $this->user_model->get(NULL, TRUE); //no id (get by where condition), limit single=true (one match is sufficient for this)

		if(count($user) > 0){
			$this->form_validation->set_message('_uniqueName', '<span style="color:red">%s is already taken. Choose other one.</span>');
			return FALSE;
		}
		else
			return TRUE;
	}


	public function _uniqueEmail($string=NULL){
		/* check if given email exists, but current user is exception */

		$this->db->where('email', $this->input->post('email'));
		
		//..except email of current user (segment 4 contains user id)
		if( $this->uri->segment(4) ){
			$this->db->where('id !=', $this->uri->segment(4));
		}

		$user = $this->user_model->get(NULL, TRUE); //no id (get by where condition), limit single=true (one match is sufficient for this)
		echo var_dump($user);

		if(count($user) > 0){
			$this->form_validation->set_message('_uniqueEmail', '<span style="color:red">%s is already registered. Choose other one.</span>');
			return FALSE;
		}
		else
			return TRUE;
	}
}

 ?>