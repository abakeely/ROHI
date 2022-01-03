<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emploi_model extends MY_Model {

	public $table='emploi';
	public $join =array();	

	public function __construct()
	{
		parent::__construct();
	}
}