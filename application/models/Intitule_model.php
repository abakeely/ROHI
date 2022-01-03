<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intitule_model extends MY_Model {

	public $table='intitule';
	public $join =array();	

	public function __construct()
	{
		parent::__construct();
	}
}