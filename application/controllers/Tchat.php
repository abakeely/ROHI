<?php
/**
* @package ROHI
* @subpackage Home
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Tchat extends MY_Controller {

    public function __construct(){
         parent::__construct();
         $this->load->model('Tchat_model','TchatModel');
    }
    
    
    public function getNbNouveauMessage(){
		$oUser				=   array();
		$oCandidat			=   array();
		$iRet				=   $this->check($oUser, $oCandidat);
		$nbMessage			=	0 ;
		$result				=	$this->TchatModel->getNbNouveauMessage($oUser[id]);
		if(sizeof($result) > 0){
			$nbMessage		=	$result["nb_message"] ;
		}
        echo ($nbMessage);
    }

    public function majView(){
		$oUser				=   array();
		$oCandidat			=   array();
		$iRet				=   $this->check($oUser, $oCandidat);
		$nbMessage			=	0 ;
		$this->TchatModel->majView($oUser[id]);
    }
 }
?>