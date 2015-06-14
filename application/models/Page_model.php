<?php 

class Page_model extends MY_Model{
	protected $_table_name = 'pages'; 
	public $order_by = 'title DESC';
	public $rules = ['title' => ['field'	=> 'title',
					 			 'label' 	=> 'Title',
					 			 'rules' 	=> 'trim|required|max_length[100]'],

					 'body' => 	['field'	=> 'body',
					 			 'label' 	=> 'Body',
					 			 'rules' 	=> 'trim|required'],
					 
					 'slug' => 	['field'	=> 'slug',
					 			 'label' 	=> 'Slug',
					 			 'rules' 	=> 'trim|required|max_length[100]|url_title|callback__uniqueSlug'] //url_title - creates human-friendly URL string
					 /*
					 'order' => ['field'	=> 'order',
					 			 'label' 	=> 'Order',
					 			 'rules' 	=> 'trim|is_natural'] */ ];



	public function getEmptyPage(){
		/* create new empty user class */

		$page = new stdClass();

		$page->title = '';
		$page->body = '';
		$page->slug = '';
		//$page->order = '';
		
		return $page;
	}

}

 ?>