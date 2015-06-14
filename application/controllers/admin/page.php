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


		$this->form_validation->set_rules( $this->page_model->rules );


		if($this->form_validation->run() == TRUE){
			
			$data = $this->page_model->arrayFromPost(['title', 'body', 'slug']);

			//new page
			if($id==NULL){
				$this->page_model->create($data);
			}
			
			//edit page
			else{
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


	/* function with "_" prefix (for example "public function _uniqueName()") is NOT accessible from URL
	   private functions are also hidden from url, but for this specific function it needs to be done via 
	   "_" prefix (works only with codeigniter), because this fn needs to be called from other class and that 
	   cant be done when fn is private */
	public function _uniqueSlug($string=NULL){
		/* check if given slug exists, except slug is for current page */
		
		$this->db->where('slug', $this->input->post('slug'));

		//..exclude slug for current page (segment 4 contains current page id)
		if( $this->uri->segment(4) )
			$this->db->where('id !=', $this->uri->segment(4));

		$page = $this->page_model->get(NULL); //no id (get by where condition)

		if(count($page) > 0){
			$this->form_validation->set_message('_uniqueSlug', '<span style="color:red">%s must be unique. Choose other one.</span>');
			return FALSE;
		}
		else
			return TRUE;
	}

}

 ?>