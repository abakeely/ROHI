<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poste_model extends MY_Model {

	public $table='poste';
	public $join =array();	

	public function __construct()
	{
		parent::__construct();
	}
}