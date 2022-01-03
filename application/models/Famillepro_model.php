<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Famillepro_model extends MY_Model 
{

	public $table='famillepro';
	public $join =array();	

	public function __construct()
	{
		parent::__construct();
	}

/*	public function read($where=array())
	{
		$return=array();
		$this->db->select();
		if(!empty($where))
		{
			$this->db->where($where);
		}
		$return=$this->db->from($this->table)->get()->result();
		return $return;
	}*/
}