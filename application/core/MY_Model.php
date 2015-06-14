<?php 

class MY_Model extends CI_Model{

	protected $_table_name = '';
	protected $_primary_key = 'id';
	protected $_filter_int = 'intval'; //intval($var) returns integer value of $var
	public $order_by = NULL;
	public $rules = array(); //validation rules
	protected $_timestamps = FALSE;


	function __construct(){
		parent::__construct();
	}


	public function arrayFromPost($items){
		$data = array();

		foreach($items as $item){
			$data[$item] = $this->input->post($item); 
		}

		return $data;
	}


	public function get($id = NULL, $limit_single = FALSE){
		/* if id is specified, returns entry with that id
		   if not, returns all entries
		   if single is true and id is not specified, returns single entry */


		if($id != NULL){ //one result
			$filter = $this->_filter_int; //set $filter as filter_int
			$id = $filter($id); //set id as filtered value of id

			$this->db->where($this->_primary_key, $id);

			if(isset($this->order_by) && strlen($this->order_by)>0)
				$this->db->order_by($this->order_by);

			return $this->db->get($this->_table_name)->row(); //return exactly one result for specified id (row)
		}

		else{ //all results
			if(isset($this->order_by) && strlen($this->order_by)>0){
				$this->db->order_by($this->order_by);
			}
			
			if($limit_single)
				return $this->db->get($this->_table_name)->row();
			else
				return $this->db->get($this->_table_name)->result(); //return all results, since id wasnt specified (result)
		}
 
	}


	public function get_by($where, $limit_single = FALSE){

		$this->db->where($where);
		return $this->get(NULL, $limit_single); //call my fn "get()" with only "where" and "limit" specified 
	}


	public function create($data){
		/* inserts new entry
		   returns id of inserted(updated) item */

		if( !isset($data) )
			return FALSE;


		//create timestamps, if "_timestamps" set to true
		if($this->_timestamps){
			$date_now = date('Y-m-d H:i:s');

			//if id is not specified, create new entry (so add "created" entry as well)
			if(!isset($id))
				$data['created'] = $date_now;

			//and "modified" entry - in both cases (new or update)
			$data['modified'] = $date_now;
		}

		if(!isset($data[$this->_primary_key])) //if primary key is not set in data, set it to NULL
			$data[$this->_primary_key] = NULL;


		//insert
		$this->db->set($data);
		$this->db->insert($this->_table_name);	
		
		return $this->db->insert_id();
	}


	public function update($id, $data){
		/* updates selected item */

		if(!isset($id) || !isset($data))
			return FALSE;


		//create timestamps, if "_timestamps" set to true
		if($this->_timestamps){
			$date_now = date('Y-m-d H:i:s');

			//if id is not specified, create new entry (so add "created" entry as well)
			if(!isset($id))
				$data['created'] = $date_now;

			//and "modified" entry - in both cases (new or update)
			$data['modified'] = $date_now;
		}	


		//filter id
		$filter = $this->_filter_int; //load filter
		$id = $filter($id); //filter id

		//update
		$this->db->set($data);
		$this->db->where($this->_primary_key, $id);
		$this->db->update($this->_table_name);
		

		return $id;
	}


	public function delete($id){
		/* deletes item with selected id */
		
		if(!isset($id))
			return FALSE;

		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
	}

}


 ?>