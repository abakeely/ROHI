<?php
/**
* @package ROHI
* @subpackage Home
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Home extends MY_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->model('matricule_model','matricule');
    }
    
    
    public function index(){
        $data = array();
        $this->load->view('home',$data);
    }
 }
?>