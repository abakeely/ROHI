<?php

class Cron extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Transaction_pointage_model','TransactionService');
		$this->load->model('Pointage_model','PointageService');

		$this->sessionStartCompte();
	}
	public function maj_pointage($mois,$annee){
		$this->TransactionService->tropBe($mois,$annee);
	}
}


?>