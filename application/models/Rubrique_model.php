<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rubrique_model extends MY_Model {

	public $table='rubrique';
	public $join =array();	

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_list_rubrique()
	{
		return $this->read();
	}
}