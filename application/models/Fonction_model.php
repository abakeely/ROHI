<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fonction_model extends MY_Model {

	public $table='fonction';
	public $join =array();	

	public function __construct()
	{
		parent::__construct();
	}
}