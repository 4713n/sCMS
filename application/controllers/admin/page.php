<?php 

class Page extends Admin_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('page_model');
	}


	public function index($sort=''){

		if(isset($sort)){
			$sort = $this->input->get('sort');

			//check if passed "order_by" is ok
			$order_available = ['title'		=> 'title', 
								'modified'	=> 'datetime', 
								'added'		=> 'datetime'];

			if( array_key_exists($sort, $order_available) )
				$this->page_model->order_by = $order_available[$sort] . ' DESC';
			else
				$this->page_model->order_by = 'title DESC'; //default sort
			
		}


		$this->data['pages'] = $this->page_model->get();

		$this->data['contentView'] = 'admin/page/index';
		$this->load->view('admin/_layout_main', $this->data);
	}


	function edit($id = NULL){
		/* - edit existing page (id specified)
		   - add a new page (id not specified) */


		//if editing existing page (id!=null)
		if($id != NULL){
			$this->data['page'] = $this->page_model->get($id, NULL);
			
			//no page found with that id
			if(count($this->data['page']) < 1){
				$this->session->set_flashdata('errors', 'Page could not be found');
				$this->data['page'] = $this->page_model->getEmptyPage(); //page with empty values
			}
		}
		//if creating new page (id=null)
		else{
			$this->data['page'] = $this->page_model->getEmptyPage(); //page with empty values
		}


		$rules_admin = $this->page_model->rules_admin;

		//if adding a new page (id=null), then add "required" rule for password
		if($id == NULL)
			$rules_admin['password']['rules'] = $rules_admin['password']['rules'] . '|required';

		$this->form_validation->set_rules($rules_admin);


		if($this->form_validation->run() == TRUE){
			//new page
			if($id==NULL){
				$data = $this->page_model->arrayFromPost(['name', 'email', 'password']);
				$data['password'] = $this->page_model->hashPassword($data['password']);
				$this->page_model->create($data);
			}
			
			//edit page
			else{
				if( strlen(trim($this->data['password'])) > 0 ){ //if new password is set
					$data = $this->page_model->arrayFromPost(['name', 'email', 'password']);
					$data['password'] = $this->page_model->hashPassword($data['password']);
				}
				else{ //new pwd not set, let password without changes
					$data = $this->page_model->arrayFromPost(['name', 'email']);
				}

				$this->page_model->update($id, $data);
			}

			redirect('admin/page');
		}

		$this->data['contentView'] = 'admin/page/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}


	function delete($id){
		$this->page_model->delete($id);
		redirect('admin/page');
	}


	public function login(){

		//redirect, if already logged in
		if( $this->page_model->isLoggedIn() ){
			redirect('admin/controlpanel');
		}

		$rules = $this->page_model->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == TRUE){
			if($this->page_model->login()){
				redirect('admin/controlpanel');
			}
			else{
				$this->session->set_flashdata('loginError', 'Wrong pagename/password');
				redirect('admin/page/login');
			}
		}
	
		$this->data['page_title'] = 'sCMS Login [Admin]';
		$this->load->view('admin/_layout_login', $this->data);
	}


	public function logout(){
		$this->page_model->logout();

		redirect('admin/page/login');
	}


	/* function with "_" prefix (for example "public function _uniqueName()") is NOT accessible from URL
	   private functions are also hidden from url, but for this specific function it needs to be done via 
	   "_" prefix (works only with codeigniter), because this fn needs to be called from other class and that 
	   cant be done when fn is private */
	public function _uniqueName($string=NULL){
		/* check if given name exists, but current page is exception */
		
		$this->db->where('name', $this->input->post('name'));

		//..except name of current page (segment 4 contains page id)
		if( $this->uri->segment(4) ){
			$this->db->where('id !=', $this->uri->segment(4));
		}

		$page = $this->page_model->get(NULL, TRUE); //no id (get by where condition), limit single=true (one match is sufficient for this)

		if(count($page) > 0){
			$this->form_validation->set_message('_uniqueName', '<span style="color:red">%s is already taken. Choose other one.</span>');
			return FALSE;
		}
		else
			return TRUE;
	}


	public function _uniqueEmail($string=NULL){
		/* check if given email exists, but current page is exception */

		$this->db->where('email', $this->input->post('email'));
		
		//..except email of current page (segment 4 contains page id)
		if( $this->uri->segment(4) ){
			$this->db->where('id !=', $this->uri->segment(4));
		}

		$page = $this->page_model->get(NULL, TRUE); //no id (get by where condition), limit single=true (one match is sufficient for this)
		echo var_dump($page);

		if(count($page) > 0){
			$this->form_validation->set_message('_uniqueEmail', '<span style="color:red">%s is already registered. Choose other one.</span>');
			return FALSE;
		}
		else
			return TRUE;
	}
}

 ?>