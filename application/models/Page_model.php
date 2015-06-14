<?php 

class Page_model extends MY_Model{
	protected $_table_name = 'pages';
	protected $_primary_key = 'id';
	protected $_filter_int = 'intval'; //intval($var) returns integer value of $var
	protected $_order_by = '';
	protected $_rules = array();
	protected $_timestamps = FALSE;
}

 ?>