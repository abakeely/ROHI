<?php 
/**
* @package ROHI
* @subpackage Menu
* @author Division Recherche et Développement Informatique
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();

class Menu extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	
        
    public function change_menu($id_menu){
        	$this->session->set_userdata('menu',$id_menu);
        	if($id_menu == 1){
        		redirect(base_url()."cv/mon_cv");
        	}
        	else if($id_menu == 2){
        		redirect(base_url()."formation/rapport_locale");
        	}
        	else if($id_menu == 4){
        		redirect(base_url()."demande/demande_decision");
        	}elseif($id_menu == 5){
        		redirect(base_url());
        	}else{
        		redirect(base_url()."");
        		
        	}
        	
     }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */