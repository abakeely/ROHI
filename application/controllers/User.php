<?php
/**
* @package ROHI
* @subpackage User
* @author Division Recherche et Développement Informatique
*/

ob_start();
class User extends MY_Controller {

    public function __construct()
    {
            parent::__construct();
			$this->remove_connect_to_sad();
			$this->load->model('user_model','user');
            $this->load->model('matricule_model','matricule');
            $this->load->model('corps_model','corps');
            $this->load->model('grade_model','grade');
            $this->load->model('indice_model','indice');
			$this->load->model('statut_model','statut');
			$this->load->model('user_historique_model','user_historique');
			$this->load->model('error_user_historique_model','error');
			$this->load->model('session_model');
			$this->load->model('usercompte_gcap_model','UserCompte');
			$this->load->model('accueil_gcap_model','Accueil');
			$this->load->model('Candidat_model','Candidat');
    }
	
    public function test_menu(){
    	$this->load->view('templates/headerSad');
    	$this->load->view('templates/footerSad');
    }
    
    
    public function verify_im_nom($im,$nom){
       $data = array();
       $message = "";
       $statut = 1;
       if($this->user->existe_mat($im)){
               $statut = 2;
               $message = "Votre matricule est d&eacute;j&agrave; utilis&eacute;";
        }
        else if($this->matricule->existe($im)){
            if($this->matricule->verifier_mat_nom($im,$nom)){
               $mat =  current($this->matricule->get_matricule($im));
               $data['prenom'] = $mat['prenom'];
               $data['cin'] = $mat['cin'];
			   $statut = 1;
            }
            else{
                $statut = 3;
                $message = "Votre nom ne correspond pas &agrave;  votre matricule<br>Veuillez v&eacute;rifier s'il vous plait";
            }
        }
        else{
            $statut = 4;
        }
		
       $data['statut'] = $statut;
       $data['msg'] = $message;
       echo json_encode($data);
    }

    public function index(){
        if($this->checkConnect()){
        	$this->load_my_view('cv/home',$data);
        }
        else{
            redirect('user/login');
        }
    }
    
    public function connect(){
		global $oSmarty ; 
		session_start();
		$zPassword = isset($_POST['password'])?$_POST['password']:'';
        $login = isset($_POST['login'])?$_POST['login']:'';

		$user 					= 	$this->user->get_user_by_login_passWd($login, $zPassword);
		if(isset($user['password']) && (string)$user['password'] != ""){
			
            $user = $this->user->get_user_by_login_passWd($login, $zPassword);
            $candidat = $this->Candidat->get_by_user_id($user["id"]);
			$matricule = null;
            if(is_numeric($matricule)){
                $matricule = $this->matricule->get_matricule($user['im']);
            }
            else{
                $matricule = current($this->matricule->get_matricule($user['im'],$user['nom']));
            }
			
            $user['matricule'] = $this->complete_matricule($matricule);
			/// modification session 
			$session_data = array('login'=>$user['login'],'id'=>$user['id'],'menu'=>0,'role'=>$user['role'],'im'=>$user['im']);
			$_SESSION["userdata"] = $session_data; 
			$this->session->set_userdata($session_data);
			
			/*$is_active_user				= $this->user->is_active_user($user["id"]);
			if( $is_active_user["maj_effectue"] !="OUI"	){
				$destinataire			=	array();
				$destinataire["email"]	=	$candidat[0]->email;
				$destinataire["nom"]	=	$user['nom'];
				$destinataire["prenom"]	=	$user['prenom'];
				
				$zBody 					= 	$oSmarty->fetch( ADMIN_TEMPLATE_PATH . "common/mail/confirmation_auth.tpl" );
			}*/
			
            /// fin modification session  
			redirect('cv/index');
         }
         else{
             /*$statut1 = $this->statut->get_statut();
			 $data['list_statut'] = $statut1;
			 $data['message'] =  "Pseudo ou Mot de passe incorrect";*/

			 $statut1 = $this->statut->get_statut();
			 $data['list_statut'] = $statut1;
			 $data['message'] =  "Pseudo ou Mot de passe incorrect";
             //$this->load_my_view_Login('common/login/login.tpl',$data);

			 $oStatut = $this->statut->get_statut();
			 $oData = $this->get_all_corps_indice_grade();
			 $oData['list_statut'] = $oStatut;
			 $oData['zTitle'] = ucfirst(strtolower("Authentification")) ;
			 $oData['zLibelle'] = ucfirst(strtolower("Authentification")) ;
			 $iModuleId=0;

			 $toGetHomeArticle = $this->Accueil->getHomeArticle();
			 $oData['toGetHomeArticle'] = $toGetHomeArticle;
			 $oData['date'] = date("YmdHis");
			 $this->load_my_view_Login('common/login/login.tpl',$oData);

         }
    }
    
    public function check_matricule($im=FALSE)
    {
        if($im){
            $matricule = $this->matricule->get_matricule($im);
            $data = array();
            if($matricule){
                $data['status'] = 'ok';
                $data['im'] = $matricule['libele']; 
                $data['nom'] = $matricule['nom_prenom']; 
            }
            else
                $data['status'] = 'ko';
         }
         echo json_encode($data);
    }
   
   
	public function create(){
        $matricule = $_POST['matricule'];
		$matricule = str_replace(" ","",$matricule);
        $nom = $_POST['nom'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        
        $prenom = $_POST['prenom'];
        $sexe = $_POST['sexe'];
        $cin = $_POST['cin'];
		$statut = $_POST['statut'];

		$msg_error = '';
		
		$list_statut = $this->statut->get_statut();
		$data['list_statut'] = $list_statut;

        $matricule_bo = null;
        if($statut == 3 || $statut == 5 || $statut == 7 || $statut == 8)
			$matricule_bo =  current($this->matricule->get_matricule($matricule));

		$corps = null;
		$indice = null;
		$grade = null;
		if($matricule_bo!=null){
			$corps = $matricule_bo['corps_id'];
			$indice = $matricule_bo['indice_id'];
			$grade = $matricule_bo['grade_id'];
		}
        
        $data['matricule'] = $matricule;
        $data['nom'] = $nom;
		$data['prenom'] = $prenom;
		$data['cin'] = $cin;
		$data['sexe'] = $sexe;
        $data['login'] = $login;
		$data['statut'] = $statut;
        $data['password'] = $password;
        $data['confirm_password'] = $confirm_password;

        $msg_error = '';
        $error = true;
        
		if($statut == 3 || $statut == 5 || $statut == 7 || $statut == 8){ // cas de ELD, FA, HEE et FONCTIONNAIRE
			if(!$this->user->existe_mat($matricule)){
				if($this->matricule->existe($matricule)){ 
						if($this->matricule->verifier_mat_nom($matricule,$nom)){
								 if(!$this->user->existe($login)){
										 if($password == $confirm_password){
												 $obj = array();
												 $obj['login'] = $login;
												 $obj['password'] = $password;
												 $obj['im'] = $matricule;
												 $obj['role'] = 'user';
												 $obj['sexe'] = $sexe;
												 $obj['cin'] = $cin;
												 
												 $obj['nom'] = $nom;
												 $obj['prenom'] = $prenom;
												 $obj['corps_id'] = $corps;
												 $obj['indice_id'] = $indice;
												 $obj['grade_id'] = $grade;
												 $obj['statut'] = $statut;
												 $obj['validate'] = true;
												 
												 $iUserId = $this->user->createUser($obj);

												 /* modif tojo*/
												 $this->user->update_password($iUserId,$data);
												 $error = false;
										 }
										 else{
												 $msg_error = "Votre mot de passe ne correspond pas &agrave; sa confirmation";
										 }
								 }
								 else{
										 $msg_error = "Le Pseudo existe d&eacute;j&agrave;";
								 }
						 }
						 else
						 {
								 $msg_error = "Votre nom ne correspond pas &agrave; votre matricule";
								 
						 }
				}
				else{ // matricule n'existe pas dans la base STI
					/*
					if(!$this->user->existe($login)){
						if($password == $confirm_password){
								$obj = array();
								$obj['login'] = $login;
								$obj['password'] = $password;
								$obj['im'] = $matricule;
								$obj['role'] = 'user';
								$obj['sexe'] = $sexe;
								$obj['cin'] = $cin;
								$obj['nom'] = $nom;
								$obj['prenom'] = $prenom;
								$obj['corps_id'] = null;
								$obj['indice_id'] = null;
								$obj['grade_id'] = null;
								$obj['statut'] = $statut;
								$obj['validate'] = false;
								$this->user->createUser($obj);
								$error = false;
						}
						else{
								$msg_error = "Votre mot de passe ne correspod pas a sa confirmation";
						}
					}
					else{
							$msg_error = "Login d&eacute;j&agrave utiliser <br> Opter pour votre matricule";
					}*/
					$msg_error = "Veuillez remplir le formulaire ROHI, disponible aupr&egrave;s de votre Responsable Personnel. Nous vous  remercions de votre collaboration.";
				}
			}
			else{
					$msg_error = "Votre matricule est d&eacute;j&agrave; utilis&eacute; par un autre utilisateur";
			}
		}
		else{
			// cas de ECD,EMO,...
			/*
			if(!$this->user->existe($login)){
				if($password == $confirm_password){
						$obj = array();
						$obj['login'] = $login;
						$obj['password'] = $password;
						$obj['im'] = $matricule;
						$obj['role'] = 'user';
						$obj['sexe'] = $sexe;
						$obj['cin'] = $cin;
						$obj['nom'] = $nom;
						$obj['prenom'] = $prenom;
						$obj['corps_id'] = null;
						$obj['indice_id'] = null;
						$obj['grade_id'] = null;
						$obj['statut'] = $statut;
						$obj['validate'] = false;
						$this->user->createUser($obj);
						$error = false;
				}
				else{
						$msg_error = "Votre mot de passe ne correspod pas a sa confirmation";
				}
			}
			else{
					$msg_error = "Login existe d&eacute;j&agrave; utiliser >Opter pour votre matricule";
			}*/
			$msg_error = "Veuillez remplir le formulaire ROHI, disponible aupr&egrave;s de votre Responsable Personnel. Nous vous  remercions de votre collaboration.";
		}
		
        if($error){
            $data['message'] =  $msg_error;
			// creation historique
			$now = date('Y-m-d\TH:i:s');
			$data_histo = array();
			$data_histo['message_error'] = $msg_error;
			$data_histo['date'] = $now ;
			$data_histo['host_user'] = $this->get_user_data('ip_address');
			$data_histo['agent_user'] = $_SERVER['HTTP_USER_AGENT'];
			
			$this->error->create_error($data_histo);
			// fin creatin historique
			$data['type'] = 2;
            $this->load_my_view_Login('common/login/login.tpl',$data);
        }
        else{
            $user = $this->user->get_user_by_login($login);
            session_start();
            if($matricule_bo!=null)
				$user['matricule'] = $this->complete_matricule($matricule_bo);
            
			/// modification session 
			$session_data = array('login'=>$user['login'],'id'=>$user['id']);
			$this->session->set_userdata($session_data);
            /// fin modification session  
			// creation historique
			$now = date('Y-m-d\TH:i:s');
			$data_histo = array();
			$data_histo['user_id'] = $user['id'];
			$data_histo['type'] = 'CREATE_USER';
			$data_histo['date'] = $now ;
			$data_histo['host_user'] = $this->get_user_data('ip_address');
			$data_histo['agent_user'] = $_SERVER['HTTP_USER_AGENT'];
			
			$this->user_historique->create_user_historique($data_histo);
			// fin creatin historique
			//$data['message'] =  "Votre compte a &eacute;t&eacute; bien cr&eacute;e, veuillez connectez maintenant";
			//$data['type'] = 0;
			redirect('cv/index/2');
            // $this->load_my_view_Login('common/login/login.tpl',$data);
        }
    }
    
    public function deconnect(){
        $this->session->sess_destroy();
        redirect('accueil/login');
    }

	public function deconnexion(){
        $this->session->sess_destroy();
        redirect('accueil/login');
    } 
	
	public function list_user_no_cv(){
		$this->checkConnexion();
		global $oSmarty ;
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		$oData = array();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 71;
		$oData['list_user'] = $this->user->get_user_no_cv();
		$this->load_my_view_Common('user/liste_user.tpl',$oData,$iModuleId);
	}
	//affichage ip et des agent connectés
	/*public function list_user_connected(){
		$this->checkConnexion();
		$data = array();
		$data['list_session'] = $this->session_model->session_connected();
		$this->load_my_view('user/user_connected',$data);
	}*/
	
	//insertion liste des agents en ligne
	public function list_user_connected(){
		$this->checkConnexion();
		global $oSmarty ;
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		$oData = array();
		$list_user_connected = array();
		$list = $this->session_model->session_connected();
		$oArrayUser = array();
		foreach($list as $d){
			$str = $d->user_data;
			$array_data = str_word_count($str,1);
			$login = $array_data[8];
			$user = $this->user->get_user_by_login($login);

			if (!in_array($login, $oArrayUser)){

				array_push ($oArrayUser, $login);
				$user['ip'] = $d->ip_address;

				if (isset($user['id'])){
					$candidat = current($this->candidat->get_by_user_id($user['id']));
					if($candidat){
						$user['local_serv'] = $candidat->lacalite_service;
						$dep = $this->departement->get_departement($candidat->departement);
						$user['dep'] = $dep?$dep['libele']:'';
						$dir = $this->direction->get_direction($candidat->direction);
						$user['dir'] = $dir?$dir['libele']:'';
						$ser = $this->service->get_service($candidat->service);
						$user['ser'] = $ser?$ser['libele']:'';
						$distr = $this->district->get_district($candidat->district);
						$user['distr'] = $distr?$distr['libele']:'';
					}

					array_push($list_user_connected,$user);
				}
				
			}
		}
		$oData['oUser']=$oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 70;
		$oData['list_user'] = $list_user_connected;
		$this->load_my_view_Common('user/user_connected.tpl',$oData,$iModuleId);
	}
	//fin insertion agents en ligne
	
	public function change_mdp(){
		$this->load->view('change_password');
	}
	
	public function change_mot_passe(){
		$data_change_password = array();
		$im = $this->input->post("matricule");
		$isCheckCarte = $this->input->post("isCheckCarte");
		$iNumCarte = $this->input->post("carte");

		$cin = $this->input->post("cin");
		$phone = $this->input->post("phone");
		$data_change_password['login'] = $this->input->post("login");
		$data_change_password['password'] = $this->input->post("password");
		
		$confirm_password = $this->input->post("confirm_password");
		$statut_user = $this->input->post("statut");
		
		$statut = $this->statut->get_statut();
		$data = $this->get_all_corps_indice_grade();
		$data['list_statut'] = $statut;
		
		$data['im'] = $im ;
		$data['cin'] = $cin ;
		$data['phone'] = $phone ;
		$data['login'] = $data_change_password['login'] ;
		$data['type'] = 1; 
		
		if($statut_user<=2)
			$user = $this->user->get_user_by_cin($cin);
		else{
			$im = str_replace(' ','',$im);
			$user = $this->user->get_user_by_matricule(trim($im));
		}
		if($im || $statut_user<=2){
			if($user){
				$candidat = current($this->candidat->get_by_user_id($user['id']));

				$zCinCandidat = str_replace(" ",'',$candidat->cin);
				$zCINTest = str_replace(" ",'',$cin);
				
				if($zCinCandidat==$zCINTest){

					$zPhoneCandidat = str_replace(" ",'',$candidat->phone);

					$zPhoneNTest = str_replace(" ",'',$phone);
					
					if($zPhoneCandidat==$zPhoneNTest){

						if($data_change_password['password'] == $confirm_password ){
							if(!$this->user->existe_login($data_change_password['login'])){
								
								$this->load->model('Transaction_pointage_model','Transaction');

								/* tojo */
								//$isCheckCarte = 0 ; 
								/* tojo */

								if ($isCheckCarte == 1) {

									$iBadgeNumber = $this->Transaction->getBadgeNumber($user['id']);

									$iNumCarte = str_replace(" ","",$iNumCarte);
									$iRet = $this->Transaction->CheckImCarte($iBadgeNumber,(int)$iNumCarte);

									if ($iRet == 1) {
										$this->Transaction->update_password($user['id'],$data_change_password,TRUE);
										$data['message'] = "Vos acc&egrave;s sont valid&eacute;s, vous pouvez acc&eacute;der directement &agrave; ROHI avec vos nouveaux acc&egrave;s. Merci!";
									} else {
								
										$this->Transaction->UpdateAcces($user['id'],$data_change_password);

										$data['type'] = 0;
										//$data['message'] = "Votre demande est en attente de moderation, la DRHA vous contactera. Merci!";
										$data['message'] = "Carte inexistante, veuillez contacter votre &eacute;valuateur ou votre responsable personnel pour valider vos acc&egrave;s sinon veuillez patienter, la DRHA vous contactera pour la validation. Merci!";
									}
								
								} else {
								
									$this->Transaction->UpdateAcces($user['id'],$data_change_password);
									
									/*$this->user->update_user($user['id'],$data_change_password);
									$this->user->update_password($user['id'],$data_change_password);*/

									$data['type'] = 0;
									//$data['message'] = "Votre demande est en attente de moderation, la DRHA vous contactera. Merci!";
									/*$data['message'] = "Veuillez contacter votre &eacute;valuateur ou votre responsable personnel pour valider vos acc&egrave;s sinon veuillez patienter, la DRHA vous contactera pour la validation. Merci!";*/

									/*$data['message'] = "Veuillez contacter votre &eacute;valuateur ou contacter la Division communication de la DRHA pour la validation. Merci!<br><br> <strong>Comm DRHA :</strong><br> -  032 11 083 63 <br> -  032 11 083 61 <br>";*/

									$data['message'] = "Veuillez contacter votre &eacute;valuateur ou contacter la Division communication de la DRHA pour la validation. Merci!<br><br> <strong>Comm DRHA :</strong><br> -  032 11 082 17<br>";


								}


								$this->load_my_view_Login('common/login/login.tpl',$data);
							}
							else{
								$data['message'] = "Pseudo deja utilis&eacute; par un autre utilisateur";
								$this->load_my_view_Login('common/login/login.tpl',$data);
							}
						}
						else{
							$data['message'] = "Mot de passe ne correspond pas &agrave; sa confirmation";
							$this->load_my_view_Login('common/login/login.tpl',$data);
						}
					}
					else{
						$data['message'] = "T&eacute;l&eacute;phone incorrect";
						$this->load_my_view_Login('common/login/login.tpl',$data);
					}
				}
				else{
					$data['message'] = "CIN incorrect";
					$this->load_my_view_Login('common/login/login.tpl',$data);
				}
			}
			else{
				if($statut_user<=2)
					$data['message'] = "CIN incorrect";
				else
					$data['message'] = "IM incorrect";
				$this->load_my_view_Login('common/login/login.tpl',$data);
			}
		}
    }
    
    public function test_pdf(){
    	$this->load->library('pdf');
		$pdf = $this->pdf->load(); 
		
		$pdfFilePath = FCPATH."assets/essai.pdf";
		$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); 
		$html = $this->load->view('login',null,true);
		
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		redirect(base_url()."assets/essai.pdf");
    }
    
    public function respers($succes=false){
    	global $oSmarty ;
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		$oData = array();
		$oData['oUser']=$oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 73;
    	if($succes)
    		$oData['msg'] = "Operation effectu&eacute;e";
    	$this->load_my_view_Common('resp/form_search.tpl',$oData,$iModuleId);
    }

	protected function toLocaliteAgentUser($oData, $_oUser,$_iMode=0){


		$zdir = $_oUser['dir'] ; 
		$toExplodedir = explode("-",$zdir);

		$zService = $_oUser['serv'] ; 
		$toExplodeService = explode("-",$zService);

		$zSelectSouService = "";
		$zSelectDivision = "";

		$zSelectService = "";
		$zSelectSouService = "";
		$iSousServiceId = 0;

		if($_oUser['serv'] != 0){
			if(sizeof($toExplodeService)>0){
				 
				if(isset($toExplodeService[1])){
					$iServiceId = $toExplodeService[1];
					$iSousServiceId = $toExplodeService[0];
					$zSelectSouService = $this->getStructure(2,"SER_".$toExplodeService[1],$iServiceId,$_iMode);
					$zSelectDivision = $this->getStructure(3,"SER_".$toExplodeService[1],0,$iSousServiceId,$_iMode);

				} else {
					$iServiceId = $toExplodeService[0];
				}
			}

			if($_oUser['dir'] == ''){
				$zSelectDirection = $this->getStructure(1,"SER_".$_oUser['dep'],0,$iServiceId,$_iMode);
			}
			
		}

		if($_oUser['dir'] != ''){
			
			if(sizeof($toExplodedir)>0){
				
				if(isset($toExplodedir[1])){
					$zSelectDirection = $this->getStructure(1,"DIR_".$_oUser['dep'],0,$toExplodedir[1],$_iMode);
					
					$zSelectService = $this->getStructure(2,"DIR_".$toExplodedir[1],0,$toExplodedir[0],$_iMode);
					$zSelectSouService = $this->getStructure(3,"DIR_".$toExplodedir[0],0,$iServiceId,$_iMode);

				} else {
					$zSelectDirection = $this->getStructure(1,"DIR_".$_oUser['dep'],0,$toExplodedir[0],$_iMode);
					$zSelectService = $this->getStructure(2,"SER_".$toExplodedir[0],0,$iServiceId,$_iMode); 

				}
			}
		}

		$oData['zSelectDirection'] = $zSelectDirection;
		$oData['zSelectService']   = $zSelectService;
		$oData['zSelectSouService']= $zSelectSouService;
		$oData['zSelectDivision']  = $zSelectDivision;

		return $oData;
	}

	/** 
	* form liste cv
	*
	* @param integer $candidat_id identifiant du candidat
	* @return view
	*/
    function get_data_list_for_form_cv1($candidat_id=false){
            $data = array();
            if($candidat_id){
            	$candidat = current($this->candidat->get_by_id($candidat_id));
            }
            else{
            	$candidat = $this->get_connected_candidat();
            }

			$user = $this->user->get_user($candidat->user_id);
            
            $sit_mat = $this->situation_mat->get_situation();
            $niveau = $this->niveau->get_niveau();

            $corps = $this->corps->get_corps();
            $grade = $this->grade->get_grade();
            $indice = $this->indice->get_indice();
            
            
			$data = $this->toLocaliteAgentUser($data, $user);

            $division = array();
            if(isset($candidat->service)){
           		 $division = $this->division->get_division_by_service_id($candidat->service);
            }
            
			$statut = $this->statut->get_statut();
            $district = $this->district->get_district();
           // var_dump($district);
            $pays = $this->pays->get_pays();
            
            
            $data['list_sit_mat'] = $sit_mat;
            $data['list_niveau'] =  $niveau;

            $data['list_corps'] = $corps;
            $data['list_grade'] = $grade;
            $data['list_indice'] = $indice;
            
            //$data['list_direction'] = $direction;
            // $data['list_service'] = $service;
            $data['list_district'] = $district;
            $data['list_pays'] = $pays;
            //$data['list_division'] = $division;
            
			$data['list_statut'] = $statut;
			$data['list_province'] = $this->province->get_province();
            $data['edit'] = false;
            return $data;
            
     }
    
	
	//***** modif lucia
    public function search_matricule() {
    	global $oSmarty ;
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		$oData = array();
		$oData['oUser']=$oUser;
		$oData['oCandidat'] = $oCandidat;
		

    	$identifiant = $_POST['im'];
		$type = $_POST['type'];
		if($type=="cin"){
			$message = "CIN";
			$cin = $identifiant;
			$user = $this->user->get_user_by_cin($cin);
			if(!empty($user)){
				$candidat = $this->candidat->get_by_user_id($user['id']);
			}
		}
		else{
			$message = "Matricule";
			$im = $identifiant;	
			$candidat = $this->candidat->get_candidat_by_matricule($im);
		}

    	if(!empty($candidat)){
			$candidat = current($candidat);
    		$oData['candidat'] = $candidat;
			$user = $this->user->get_user($candidat->user_id);

    		$oData['user_edit'] = $user;
    		$departement = $this->departement->get_departement();
    		$oData['list_departement'] = $departement;

    		$oData['departement_edit'] = $user['dep'];
    		$oData['direction_edit'] = $user['dir'];
    		$oData['service_edit'] = $user['serv'];
    		$oData['reg_edit'] = $user['reg'];
			$oData['province_edit'] = $candidat->province_id;
			
			$oData['district_edit'] = $candidat->district_id;
			$oData['pays_edit'] = $candidat->pays_id;
			if($user['dep'])
				$oData['list_direction'] = $this->direction->get_by_departement($user['dep']);
			if($user['dir'])
				$oData['list_service'] = $this->service->get_by_direction($user['dir']);
		
			$oData['list_region'] = $this->region->get_region();
			$oData['list_district'] = $this->district->get_district();
			$oData['list_province'] = $this->province->get_province();
			$oData['list_pays'] = $this->pays->get_pays();
			//var_dump($data['province_edit']);
			$oData['menu'] = 73;
			$oData['oData1'] = $this->get_data_list_for_form_cv1($candidat->id);
			$this->load_my_view_Common('resp/result_search.tpl',$oData,$iModuleId);

		}
		else{
			$oData['msg'] = "Matricule incorrect";
			$oData['menu'] = 73;
			$this->load_my_view_Common('resp/form_search.tpl',$oData,$iModuleId);
		}
    }
   /* function valide_respers(){
    	$data = array();
    	$user_id = $_POST['user_id'];
    	$dep= $_POST['departement'];
    	$dir = $_POST['direction'];
    	$serv = $_POST['service'];
    	$reg = $_POST['region'];
    	if($user_id!=null){
    		$user = $this->user->get_user($user_id);
    		$candiat = current($this->candidat->get_by_user_id($user_id));
    		$data = array();
			$data['dep'] = null;
			$data['dir'] = null ;
			$data['serv'] = null;
			$data['reg'] = null;
			$candiat->region_id = $reg;
    		if($dep!='0' && $dep!='9999'){
    			$data['dep'] = $dep*1;
    			$candiat->departement = $dep*1;
    			$candiat->direction = null;
    			$candiat->service = null;
    			$candiat->division = null;
    			if($dir!='0' && $dir!='9999'){
    				$data['dir'] = $dir*1 ;
					$candiat->direction = $dir*1;
    				if($serv!='0' && $serv!='9999'){
    					$data['serv'] = $serv*1;
						$candiat->service = $serv*1;
    				}
    			}
				$data['role'] = 'chef';
				$data['reg'] = $reg*1 ;
    			$this->user->update_user($user_id,$data);
				$this->UserCompte->setCompteRespPers($user_id);
    			$this->candidat->update($candiat,$candiat->id);
				
				$user = $this->user->get_user($user_id);
				$candiat = current($this->candidat->get_by_user_id($user_id));
    		}
    	}
    	
    	redirect('user/respers/succes');
		
    }*/
	
	//***** modif lucia
    function valide_respers(){
    	$data = array();
    	$user_id = $_POST['user_id'];
    	$dep= $_POST['departement'];
    	$dir = $_POST['direction'];
    	$serv = $_POST['service'];
    	$reg = $_POST['region'];
		
		$province = $_POST['province'];
		$district = $_POST['district'];
		$pays = $_POST['pays'];
		
    	if($user_id!=null){
    		$user = $this->user->get_user($user_id);
    		$candidat = current($this->candidat->get_by_user_id($user_id));

    		$data = array();
			$data['dep'] = null;
			$data['dir'] = null ;
			$data['serv'] = null;
			$data['reg'] = $candidat->region_id;
			$data['distr'] = null;

			$departement 	= $_POST['departement'];

			/****************** Sauvegarde direction et service ****************/
			
			$zDirection = "";
			$zService = "";

			$toDirection = array();
			$toService = array();

			for ($i=sizeof($_POST['iRattachement'])-1;$i>=0;$i--){

				$zValue = $_POST['iRattachement'][$i];
				$toExplode = explode("_",$zValue);
				switch($toExplode[0]){

					case "DIR":
						array_push($toDirection,$toExplode[1]);
						break;

					case "SER":
						array_push($toService,$toExplode[1]);
						break;

				}
			}

			$zDirection = implode("-",$toDirection);
			$zService = implode("-",$toService);
				
			$data['dep'] = $_POST['departement'];
			$data['dir'] = $zDirection;
			$data['serv'] = $zService;

			$this->user->update_user($user_id,$data);
			$this->UserCompte->setCompteRespPers($user_id);

			/*$candiat->region_id = $reg;
			$candiat->province_id = $province;
			$candiat->district_id = $district;
			$candiat->pays_id = $pays;
    		if($dep!='0' && $dep!='9999'){
    			$data['dep'] = $dep*1;
    			$candiat->departement = $dep*1;
    			$candiat->direction = null;
    			$candiat->service = null;
    			$candiat->division = null;
    			if($dir!='0' && $dir!='9999'){
    				$data['dir'] = $dir*1 ;
					$candiat->direction = $dir*1;
    				if($serv!='0' && $serv!='9999'){
    					$data['serv'] = $serv*1;
						$candiat->service = $serv*1;
    				}
    			}
				$data['role'] = 'chef';
				$data['reg'] = $reg*1 ;
    			$this->user->update_user($user_id,$data);
				$this->UserCompte->setCompteRespPers($user_id);
    			//$this->candidat->update($candiat,$candiat->id);
				
				$user = $this->user->get_user($user_id);
				//$candiat = current($this->candidat->get_by_user_id($user_id));
    		}*/

    	}
    	
    	redirect('user/respers/succes');
		
    }
    
    function list_respers($succes = false){
    	$this->checkConnexion(array('admin'));
		global $oSmarty ;
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		$oData = array();
    	$list_user = $this->user->get_list_respers();
    	$list_candidat = array();
    	foreach($list_user as $user){
    		$candidat = current($this->candidat->get_by_user_id($user['id']));
    		$candidat->departement = $user['dep'];
    		$candidat->direction = $user['dir'];
    		$candidat->service = $user['serv'];
    		$candidat->region_id = $user['reg'];
    		$candidat->division = null;
    		//$candidat = $this->complete_candidat_for_form($candidat);
    		array_push($list_candidat,$candidat);
    	}
    	if($succes)
    		$oData['msg'] = "Operation effectue avec succes";
    	$oData['oUser']=$oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 74;
		$oData['list_candidat'] = $this->complete_array_canditat($list_candidat);
    	$this->load_my_view_Common('user/list_respers.tpl',$oData,$iModuleId);
    }
    
    function delete_respers($user_id=false){
    	if($user_id){
    		$this->user->update_respers_to_user($user_id);
    	}
    	redirect('user/list_respers/succes');
    }
	
	function change_password($user_id=false){
		global $oSmarty ;
		$oUser 				= 	array();
		$oCandidat 			= 	array();
		$iRet 				= 	$this->check($oUser, $oCandidat);
		//$iModuleId 			= 	1;
    	
    	$oData['oUser']		=	$oUser;
		$oData['oCandidat'] = 	$oCandidat;
    	$this->load_my_view_Common('user/change_password.tpl',$oData,$iModuleId);
    }
	
    function modifierMotDePasse($user_id=false){
		global $oSmarty ;
		$oUser 					= 	array();
		$oCandidat 				= 	array();
		$iRet 					= 	$this->check($oUser, $oCandidat);
		$iModuleId 				= 	1;
		$oData['oUser']			= 	$oUser;
		$oData['oCandidat']		= 	$oCandidat;
		$ancien_mot_de_passe 	= 	$_POST['ancien_mot_de_passe'];
		$nouveau_mot_de_passe 	= 	$_POST['nouveau_mot_de_passe'];
		$user_id				=	$oUser["id"];
		$this->user->modifierMotDePasse($user_id,$nouveau_mot_de_passe) ;
    }
    
}
?>