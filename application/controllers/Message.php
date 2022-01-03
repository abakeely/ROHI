<?php
/**
* @package ROHI
* @subpackage Message
* @author Division Recherche et Développement Informatique
*/

class Message Extends MY_Controller {
        
    public function __construct(){
		parent::__construct();

		$this->sessionStartCompte();
		
	}
    
    public function module ($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iUserId=0){
		$oUser			=	array();
		$oCandidat		=	array();
		$iRet			=	$this->check($oUser, $oCandidat);

		if ($_iUserId > 0) {
			$oUser		=	$this->user->get_user($_iUserId);
    		$oCandidat	=	$this->candidat->get_by_user_id($oUser['id']);
		}
		
		$iCompteActif = $this->getSessionCompte();
		
		if($iRet==1){
			$oPersonneMemeService			=	$this->connected->get_same_service($oCandidat[0]->service);
			$oLastMessage					=	$this->message->get_last_message($oUser["id"]);
			$oData['oUser']					=	$oUser;
			$oData['oCandidat']				=	$oCandidat;
			$oData['session_pseudo']		=	$_SESSION["session_compte"];
			$oData['oMemeService']			=	$oPersonneMemeServiceChecked;
			$iModuleId						=	$this->module->get_by_module_zHashModule($_zHashModule);
			$iCompteActif					=   $this->getSessionCompte();
			
			switch($iModuleId){
				
				case MESSAGERIE_INSTANTANNE :
					$oData['zHashUrl']		=	$_zHashUrl ; 
					$oData['zHashModule']	=	$_zHashModule ;
					$oConnected				=	$this->connected->get_user_connected();
					if(isset($oConnected)){
						$iCond=0;
						foreach($oConnected as $oResult){
							$iUserId=(int)$oResult['connected_userId'];
							$oUserNomPrenom=$oResult['oUserNomPrenom'];
							$zNom=$oUserNomPrenom['nom'];
							$zPrenom=$oUserNomPrenom['prenom'];
							$zNomPrenom=$zNom;
							$zNomPrenom .= " ";
							$zNomPrenom .=$zPrenom;
							if(!empty($oUserNomPrenom['type_photo'])){
								$oUserConnected[$iCond]['idPhoto']=$oUserNomPrenom['id'];
								$oUserConnected[$iCond]['typePhoto']=$oUserNomPrenom['type_photo'];
							}else{
								$oUserConnected[$iCond]['idPhoto']="user_default";
								$oUserConnected[$iCond]['typePhoto']="png";
							}
							$oUserConnected[$iCond]['iUserId']=$iUserId;
							$oUserConnected[$iCond]['zNomPrenom']=$zNomPrenom;
							
							$iCond++;
						}
						$oData['oConnected']		=	$oUserConnected;
						$oData['oCandidat']			=	$oCandidat;
						$oData['oLastMessage']		=	$oLastMessage;
					}else $oData['oConnected']=null;
					switch($_zHashUrl){
						case 'tchat':
							$oData['menu'] = 56;
							$oData['zLibelle'] = "" ;
							$this->load_my_view_Chat('message/chat_socket.tpl',$oData, $iModuleId);
							break;
						case 'forum' :
							$oData['menu'] = 57;
							$oData['zLibelle'] = "" ;
							
							$this->load_my_view_Chat('message/chat.tpl',$oData, $iModuleId);
							break;
					}
					
					break;
			}
		}
	}
	
	public function autocomplete (){
		$zSearchKeyword= $this->postGetValue("query","");
		
		$oResultSearch=$this->connected->get_search_result($zSearchKeyword);
		$iCond=0;
		if($oResultSearch != null){
			foreach($oResultSearch as $value){
				
				$oUserNomPrenom=$value['oUserNomPrenom'];
				$zNom=$oUserNomPrenom['nom'];
				$zPrenom=$oUserNomPrenom['prenom'];
				$zNomPrenom=$zNom;
				$zNomPrenom .= " ";
				$zNomPrenom .=$zPrenom;
				$oResult[$iCond]['userId']=$oUserNomPrenom['user_id'];
				$oResult[$iCond]['nomPrenom']=$zNomPrenom;
				$iCond++;
				
			}
		} else $oResult=[];
		
		$zToReturn= json_encode($oResult);
		echo $zToReturn;
	}
	
	public function connected_client () {
		
		global $oSmarty;
		$oConnected				=	$this->connected->get_user_connected();
		$iUserIdCrypted			=	$this->postGetValue("userId","");
		$iUserConnectedId		=	$this ->decryptionGarina($iUserIdCrypted);
		$iSelectedValue			=	$this->postGetValue("selectValue","");
		$oCandidat				=	$this->candidat->get_by_user_id($iUserConnectedId);
		$oPersonneMemeService	=	$this->connected->get_same_service($oCandidat[0]->service);
		$oPersonneMemeServiceChecked = $this->checkConnectedState($oPersonneMemeService);
		
		if(isset($oConnected)){
			$iCond=0;
			foreach($oConnected as $oResult){
				$iUserId=(int)$oResult['connected_userId'];
				$oUserNomPrenom=$oResult['oUserNomPrenom'];
				$zNom=$oUserNomPrenom['nom'];
				$zPrenom=$oUserNomPrenom['prenom'];
				$zNomPrenom=$zNom;
				$zNomPrenom .= " ";
				$zNomPrenom .=$zPrenom;
				if(!empty($oUserNomPrenom['type_photo'])){
					$oUserConnected[$iCond]['idPhoto']=$oUserNomPrenom['id'];
					$oUserConnected[$iCond]['typePhoto']=$oUserNomPrenom['type_photo'];
				}else{
					$oUserConnected[$iCond]['idPhoto']="user_default";
					$oUserConnected[$iCond]['typePhoto']="png";
				}
				
				$oUserConnected[$iCond]['iUserId']=$iUserId;
				$oUserConnected[$iCond]['zNomPrenom']=$zNomPrenom;
				$iCond++;
			}
			$oData['oConnected']=$oUserConnected;
		}else $oData['oConnected']=null;
		$oData['oMemeService'] = $oPersonneMemeServiceChecked;
		$oSmarty->assign("oData",$oData) ;
		$oSmarty->assign("iUserId",$iUserConnectedId) ;
		$oSmarty->assign("iSelectedValue",$iSelectedValue) ;
		$oSmarty->assign('zBasePath', base_url());
		$zResult = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "message/connected.tpl" ) ;
		echo $zResult ;
			
	}
	
	public function checkConnectedState ($_oPersonneToCheck) {
		if(isset($_oPersonneToCheck)){
			$iCond = 0;
			foreach($_oPersonneToCheck as $oPTC) {
				//var_dump($oPTC['user_id']);die();
				$iUserId=(int)$oPTC['user_id'];
				$zNom=$oPTC['nom'];
				$zPrenom=$oPTC['prenom'];
				$zNomPrenom=$zNom;
				$zNomPrenom .= " ";
				$zNomPrenom .=$zPrenom;
				if(!empty($oPTC['type_photo'])){
					$oUserConnectedCheck[$iCond]['idPhoto']=$oPTC['id'];
					$oUserConnectedCheck[$iCond]['typePhoto']=$oPTC['type_photo'];
				}else{
					$oUserConnectedCheck[$iCond]['idPhoto']="user_default";
					$oUserConnectedCheck[$iCond]['typePhoto']="png";
				}

				
				$oUserConnectedCheck[$iCond]['iUserId']=$iUserId;
				$oUserConnectedCheck[$iCond]['zNomPrenom']=$zNomPrenom;
				$zState = 0;//$this->connected->checkState($iUserId);
				$oUserConnectedCheck[$iCond]['state'] = $zState;
				$iCond++;
			}
			return $oUserConnectedCheck;
		}else return null;
		
	}
	
	public function send_message (){
		$zMessage				=	$this->postGetValue("message","");
		$iTimeStamp				=	time();
		$iDestinataireId		=	$this->postGetValue("destinataireId","");
		$oUser=$this->get_current_user();
		$iExpediteurId=$oUser['id'];
		
		$oDataMessage['message_expediteurId']=$iExpediteurId;
		$oDataMessage['message_destinataireId']=$iDestinataireId;
		$oDataMessage['message_texte']=$zMessage;
		$oDataMessage['message_date']=$iTimeStamp;
		
		$this->message->insert($oDataMessage);
		
		
	}
	
	public function get_message (){
		global $oSmarty;
		$oUser=$this->get_current_user();
		
		$iTimeStamp = $this->postGetValue("timestamp","");
		$iDestinataireId = $this->postGetValue("destinataireId","");
		$oMessage=$this->message->get_message($iTimeStamp,$oUser['id'],$iDestinataireId);
		
		$oSmarty->assign('zBasePath', base_url());
		$oSmarty->assign('oMessage',$oMessage) ;
		$oSmarty->assign('oUser',$oUser);
		$zResult = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "message/conversation.tpl" ) ;
		echo $zResult ;
		//var_dump($oMessage);
		
		
	}
	
	public function decryptionGarina ($_zUserId){
		$tabUserId = explode("*",$_zUserId);
		$zUserId="";
		for($i=0 ; $i < sizeof($tabUserId) ; $i++){
			switch($tabUserId[$i]){
				case "q1" :
					$zUserId .= "0";
					break;
				case "z0" :
					$zUserId .= "1";
					break;
				case "e5" :
					$zUserId .= "2";
					break;
				case "m7" :
					$zUserId .= "3";
					break;
				case "p2" :
					$zUserId .= "4";
					break;
				case "c3" :
					$zUserId .= "5";
					break;
				case "t4" :
					$zUserId .= "6";
					break;
				case "g9" :
					$zUserId .= "7";
					break;
				case "k6" :
					$zUserId .= "8";
					break;
				case "r8" :
					$zUserId .= "9";
					break;
			}
		}
		$iUserId = (int)$zUserId;
		return $iUserId;
		
	}
    
    

}
?>