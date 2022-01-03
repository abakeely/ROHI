<?php
class Gestock_sgrh_model extends CI_Model {

	public function __construct(){
		$this->load->database('gestock');
	}
	
	public function insertCommande($oData){
		$DB1 = $this->load->database('gestock', TRUE);
		if($DB1->insert('gestock_commande', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function updateCommande($oData, $_iCommandeId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->update('gestock_commande', $oData, "commande_id = $_iCommandeId");
	}

	public function insertUnite($oData){
		$DB1 = $this->load->database('gestock', TRUE);
		if($DB1->insert('gestock_typeunite', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function updateUnite($oData, $iTypeUniteId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->update('gestock_typeunite', $oData, "typeUnite_id = $iTypeUniteId");
	}


	public function insertTypeFourniture($oData){
		$DB1 = $this->load->database('gestock', TRUE);
		if($DB1->insert('gestock_typefourniture', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function updateTypeFourniture($oData, $iTypeFournitureId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->update('gestock_typefourniture', $oData, "typeFourniture_id = $iTypeFournitureId");
	}

	public function insertFourniture($oData){
		$DB1 = $this->load->database('gestock', TRUE);
		if($DB1->insert('gestock_fourniture', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function updateFourniture($oData, $_iFournitureId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->update('gestock_fourniture', $oData, "fourniture_id = $_iFournitureId");
	}

	public function insertFournitureCommande($oData){
		$DB1 = $this->load->database('gestock', TRUE);
		if($DB1->insert('gestock_fourniturecommande', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function updateFournitureCommande($oData, $_iFournitureCommandeId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->update('gestock_fourniturecommande', $oData, "fournitureCommande_id = $_iFournitureCommandeId");
	}

	public function insertNotification($oData){
		$DB1 = $this->load->database('gestock', TRUE);
		if($DB1->insert('gestock_notification', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function updateNotification($oData, $_iNotificationId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->update('gestock_notification', $oData, "notification_id = $_iNotificationId");
	}


	public function SetApplicableMercuriale($_iFournitureId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->query('UPDATE gestock_mercuriale SET mercuriale_applicable = 0 WHERE mercuriale_fournitureId = ' . $_iFournitureId);
		$zSql= "SELECT mercuriale_id FROM gestock_mercuriale WHERE mercuriale_fournitureId = ".$_iFournitureId." ORDER BY mercuriale_id DESC LIMIT 0,1";
		$zQuery = $DB1->query($zSql);
		$oMercurial = $zQuery->result_array();

		foreach ($oMercurial as $oMercurial){
			$DB1->query('UPDATE gestock_mercuriale SET mercuriale_applicable = 1 WHERE mercuriale_id = ' . $oMercurial['mercuriale_id']);
		}
		
	}

	public function deleteCompte($_iUserId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 
		$this->db->query('delete from '.$zDatabaseGcap.'.usercompte where userCompte_userId = '.$_iUserId.' AND userCompte_compteId = ' . COMPTE_GESTIONNAIRE_STOCK);
	}

	public function insertMercuriale($oData){
		$DB1 = $this->load->database('gestock', TRUE);
		if($DB1->insert('gestock_mercuriale', $oData)){
			return $DB1->insert_id();
		}else return false;
	} 

	public function updateMercuriale($oData, $_iMercurialeId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->update('gestock_mercuriale', $oData, "mercuriale_id = $_iMercurialeId");
	}

	public function insertStock($oData){
		$DB1 = $this->load->database('gestock', TRUE);
		if($DB1->insert('gestock_stock', $oData)){
			return $DB1->insert_id();
		}else return false;
	} 

	public function updateStock($oData, $_iSotckId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->update('gestock_stock', $oData, "stock_id = $_iSotckId");
	}


	public function insertFraction($oData){
		$DB1 = $this->load->database('gestock', TRUE);
		if($DB1->insert('gestock_fractionstock', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function deleteFourniture($_iFournitureId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->query('delete from gestock_fourniture where fourniture_id = '.$_iFournitureId);
	}

	public function deleteMercuriale($_iFournitureId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->query('delete from gestock_mercuriale where mercuriale_fournitureId = '.$_iFournitureId);
	}

	public function deleteMercurialeId($_iMercurialeId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->query('delete from gestock_mercuriale where mercuriale_id = '.$_iMercurialeId);
	}

	public function deleteRebusId($_iRebusId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->query('delete from gestock_rebut where rebut_id = '.$_iRebusId);
	}

	public function deleteUnite($_iTypeUniteId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->query('delete from gestock_typeunite where typeUnite_id = '.$_iTypeUniteId);
	} 

	public function deleteTypeFourniture($_iTypeFournitureId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->query('delete from gestock_typefourniture where typeFourniture_id = '.$_iTypeFournitureId);
	} 

	public function deletePvArticleId($_iArticleId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->query('delete from gestock_pvarticle where pvArticle_id = '.$_iArticleId);
	}

	public function deleteEnteeStockId($_iStockId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->query('delete from gestock_stock where stock_id = '.$_iStockId);
	}

	public function deleteArticlePv($_iPvId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->query('delete from gestock_pvarticle where pvArticle_pvId = '.$_iPvId);
	}

	public function deletePv($_iPvId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->query('delete from gestock_pv where pv_id = '.$_iPvId);
	}

	public function insertPv($oData){
		$DB1 = $this->load->database('gestock', TRUE);
		if($DB1->insert('gestock_pv', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function updatePv($oData, $_iPvId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->update('gestock_pv', $oData, "pv_id = $_iPvId");
	}

	public function insertRebut($oData){
		$DB1 = $this->load->database('gestock', TRUE);
		if($DB1->insert('gestock_rebut', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function updateRebut($oData, $_iRebutId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->update('gestock_rebut', $oData, "rebut_id = $_iRebutId");
	}

	public function insertPvArticle($oData){
		$DB1 = $this->load->database('gestock', TRUE);
		if($DB1->insert('gestock_pvarticle', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function updatePvArticle($oData, $_iPvArticleId){
		$DB1 = $this->load->database('gestock', TRUE);
		$DB1->update('gestock_pvarticle', $oData, "pvArticle_id = $_iPvArticleId");
	}

	public function getPvId($_iId)
	{

		$DB1 = $this->load->database('gestock', TRUE);
		$zDatabaseOrigin =  $db['gestock']['database'] ; 
		$zSql= "select * from gestock_pv INNER JOIN gestock_typefourniture ON typeFourniture_id = pv_typeFournitureId where pv_id = '$_iId'";
		$zQuery = $DB1->query($zSql);
		return $zQuery->row_array();
	}


	public function getTypeUniteId($_iId)
	{

		$DB1 = $this->load->database('gestock', TRUE);
		$zDatabaseOrigin =  $db['gestock']['database'] ; 
		$zSql= "select * from gestock_typeunite where typeUnite_id = '$_iId'";
		$zQuery = $DB1->query($zSql);
		return $zQuery->row_array();
	}

	public function getTypeFournitureId($_iId)
	{

		$DB1 = $this->load->database('gestock', TRUE);
		$zDatabaseOrigin =  $db['gestock']['database'] ; 
		$zSql= "select * from gestock_typefourniture where typeFourniture_id = '$_iId'";
		$zQuery = $DB1->query($zSql);
		return $zQuery->row_array();
	}

	public function getTypeArticleId($_iId)
	{

		$DB1 = $this->load->database('gestock', TRUE);
		$zDatabaseOrigin =  $db['gestock']['database'] ; 
		$zSql= "select * from gestock_typefourniture WHERE typeFourniture_id = '$_iId'";
		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}

	public function getNotificationMoisEtAnnee($_iUserId)
	{

		$DB1 = $this->load->database('gestock', TRUE);
		$zDatabaseOrigin =  $db['gestock']['database'] ; 
		$zSql= "select * from ".$zDatabaseOrigin.".gestock_notification WHERE notification_userId = '$_iUserId' AND notification_mois = ".date("m")." AND notification_annee = ".date("Y")."";
		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}

	public function getAllUserSubordonnees ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, &$zNotIn="",$iAffiche=0) {

		global $db;

		$DB1 = $this->load->database('gestock', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		switch ($_iCompteActif)
		{
			case COMPTE_AGENT :
			case COMPTE_EVALUATEUR :
				$zUserId = $_iUserId ; 
				break;

			case COMPTE_RESPONSABLE_PERSONNEL :
			case COMPTE_AUTORITE :

				if ($_oUser['dir'] != 0) {
					
					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = ".$_oUser['dir']." " ; 

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}

					if ($_oUser['reg'] != 0){
						$zSql .= " AND c12.region_id = ".$_oUser['reg']; 
					}

				} else {
					
					$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = '".$_oCandidat[0]->direction."' AND c12.region_id = ".$_oCandidat[0]->region_id." " ;
				}

				if ($_oUser['im'] == '350210' ||  $_oUser['im'] == '260011') {
					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement IN (1,2) " ;
				}

				$zSql  .= " AND (sanction='0' || sanction='' || sanction='00' || sanction IS NULL)  " ;

				//echo $zSql ; 


				$zQuery = $DB1->query($zSql);
				$toCandidatUser = $zQuery->result_array();

				$toCandidatUserMatricule = array();
				foreach ($toCandidatUser as $oCandidatUser)
				{
					array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}

				$zUserId = -1;
				if (sizeof ($toCandidatUserMatricule) > 0) {

					$zUserId = implode(",", $toCandidatUserMatricule);
				}

				break;

			case COMPTE_GESTIONNAIRE_STOCK :
			
				break;

			case COMPTE_ADMIN :
				$zUserId = "" ; 
				$zNotIn = " AND user_id <> " . $_iUserId . " AND (sanction='0' || sanction='' || sanction='00' || sanction IS NULL)"; 
				break;
		}

		return $zUserId ; 
	}

	public function getInfoFourniture($_iArticleId){

		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;
		
		$oRequest = $_REQUEST;

		$zSql = " SELECT typeFourniture_Sigle,(SELECT COUNT(commande_id)+1 FROM gestock_commande) AS countCommande FROM gestock_fourniture 
				  INNER JOIN gestock_typefourniture ON fourniture_typeId = typeFourniture_id
				  WHERE fourniture_id = " . $_iArticleId  ; 

		$zQuery = $DB1->query($zSql);
		$toGetInfoFourniture = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toGetInfoFourniture[0];

	}

	public function getLastCommande(){

		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;
		
		$oRequest = $_REQUEST;

		$zSql = " SELECT (COUNT(commande_id)+1) as iCount FROM gestock_commande " ; 

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$iCount = sizeof($oRow);

		return $iCount;
	}

	public function getTypeFourniture(){

		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;
		
		$oRequest = $_REQUEST;

		$zSql = " SELECT * FROM $zDatabaseStock.gestock_typefourniture "; 

		$zQuery = $DB1->query($zSql);
		$toGetTypeFourniture = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toGetTypeFourniture;
 
	}


	 public function getListeAgent($_iDirectionId,&$_iNbrTotal){

		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;
		$zDatabaseGcap   =  $db['gcap']['database'] ;

		$oRequest = $_REQUEST;
		
		$toColumns = array( 
			0 => 'c.id', 
			1 => 'c.nom',
			2 => 'c.prenom',
			3 => 'c.matricule',
			4 => 's.libele',
		);

		$zSql = " SELECT SQL_CALC_FOUND_ROWS *,IFNULL((SELECT userCompte_compteId FROM $zDatabaseGcap.usercompte WHERE userCompte_userId = c.user_id AND userCompte_compteId=".COMPTE_GESTIONNAIRE_STOCK."),0) as iCompteSotck FROM $zDatabaseOrigin.candidat c INNER JOIN $zDatabaseOrigin.service s ON c.service=s.id  WHERE direction = " . $_iDirectionId; 


		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( c.id LIKE '%".$oRequest['search']['value']."%' ";    
			$zSql.=" OR c.nom LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR c.prenom LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR s.libele LIKE '%".$oRequest['search']['value']."%' )";
		}

		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			}

			if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
				$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
			}
		} else {
			$zSql.=" ORDER BY c.nom ASC  LIMIT 0,10   ";
		}

		$zQuery = $DB1->query($zSql);
		$toGetListeAgent = $zQuery->result_array();
		$zQuery->free_result(); 

        // nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount = $DB1->query($zQueryDataCount) ;

        $toRow = $toDataCount->result_array();
		
		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}
		
		return $toGetListeAgent;
	}

	public function getUnite(){

		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;
		
		$oRequest = $_REQUEST;

		$zSql = " SELECT * FROM $zDatabaseStock.gestock_typeunite "  ; 

		$zQuery = $DB1->query($zSql);
		$toGetUnite = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toGetUnite;

	}

	public function getFournitureId($_iFournitureId = ''){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;

		$zSql= "SELECT * FROM $zDatabaseStock.gestock_fourniture  ";

		if ($_iFournitureId != '') {
			$zSql .= " WHERE fourniture_id = '" . $_iFournitureId ."'" ; 
		}

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;

	}

	public function getMercurialFournitureId($_iFournitureId = ''){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;

		$zSql= "SELECT * FROM $zDatabaseStock.gestock_mercuriale  ";

		if ($_iFournitureId != '') {
			$zSql .= " WHERE mercuriale_fournitureId = '" . $_iFournitureId ."'" ; 
		}

		$zSql .= " ORDER BY mercuriale_id DESC LIMIT 0,1 "  ; 

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;

	}

	public function getMercurialFournitureApplicableId($_iFournitureId = ''){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;

		$zSql= "SELECT * FROM $zDatabaseStock.gestock_mercuriale  WHERE mercuriale_fournitureId = '" . $_iFournitureId ."' AND mercuriale_applicable = 1 ORDER BY mercuriale_applicable DESC LIMIT 0,1 " ; 

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;

	}

	public function getStockFournitureId($_iFournitureId = ''){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;

		$zSql= "SELECT * FROM $zDatabaseStock.gestock_stock  ";

		if ($_iFournitureId != '') {
			$zSql .= " WHERE stock_fournitureId = '" . $_iFournitureId ."'" ; 
		}

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;

	}



	public function getTestCommandeQuantite($_iArticleId){

		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;

		
		$oRequest = $_REQUEST;

		$zSql = " SELECT SQL_CALC_FOUND_ROWS *,fourniture_id AS iFournitureId,IFNULL((SELECT SUM(rebut_quantite) FROM gestock_rebut WHERE rebut_fournitureId = iFournitureId),0) AS rebut,ifnull((SELECT (SUM(stock_quantite)-rebut) FROM $zDatabaseStock.gestock_stock WHERE stock_fournitureId = iFournitureId),0) AS iQuantiteTotal,
		ifnull((SELECT SUM(fournitureCommande_quantite) FROM $zDatabaseStock.gestock_fourniturecommande WHERE fournitureCommande_fournitureId = iFournitureId AND fournitureCommande_typeId=".COMMANDE_NORMAL." AND fournitureCommande_statutId=".LIVRER." ),0) AS commandePris FROM gestock_fourniture WHERE fourniture_id = " . $_iArticleId ; 

		$zQuery = $DB1->query($zSql);
		$toGetTestCommandeQuantite = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toGetTestCommandeQuantite;

	}

	public function getFractionStock($_iArticleId){

		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;

		
		$oRequest = $_REQUEST;

		$zSql = " SELECT stock_id AS iSotckId,((stock_quantite) - IFNULL((SELECT SUM(fractionStock_quantite) FROM gestock_fractionstock INNER JOIN gestock_fourniturecommande ON fractionStock_fournitureCommandeId = fournitureCommande_fournitureId WHERE fractionStock_stockId = iSotckId AND fournitureCommande_typeId=".COMMANDE_NORMAL." AND fournitureCommande_statutId=".LIVRER."),0)) AS quantiteReel FROM gestock_stock WHERE stock_fournitureId = ". $_iArticleId ." HAVING quantiteReel > 0" ; 

		$zQuery = $DB1->query($zSql);
		$toGetTestCommandeQuantite = $zQuery->result_array();
		$zQuery->free_result(); 


		return $toGetTestCommandeQuantite;

	}

	public function getListeArticlePv($_iPvId){

		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;

		
		$oRequest = $_REQUEST;

		$zSql = " SELECT * FROM $zDatabaseStock.gestock_pvarticle INNER JOIN $zDatabaseStock.gestock_fourniture ON fourniture_id = pvArticle_articleId 
		LEFT JOIN $zDatabaseStock.gestock_rebut ON rebut_pvArticleId = pvArticle_id 
		WHERE pvArticle_pvId = ". $_iPvId ." " ; 

		$zQuery = $DB1->query($zSql);
		$toGetTestCommandeQuantite = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toGetTestCommandeQuantite;

	}

	public function getInfoUser($_iUserId){

		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;

		
		$oRequest = $_REQUEST;

		$zSql = " SELECT sigle_departement,sigle_direction,sigle_service,sigle_module,
				d.libele as departementNom,
				di.libele as directionNom,
				s.libele as serviceNom,
				m.libele as divisionNom
				FROM $zDatabaseOrigin.candidat
				INNER JOIN $zDatabaseOrigin.departement d ON d.id = departement
				INNER JOIN $zDatabaseOrigin.direction di ON di.id = direction
				LEFT JOIN $zDatabaseOrigin.service s ON s.id = service
				LEFT JOIN $zDatabaseOrigin.module m ON m.id = division
				WHERE user_id = " . $_iUserId  ; 

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		foreach ($oRow as $toRow1){
			if ($toRow1['sigle_service']!=''){
				$zSigle = $toRow1['sigle_service'];
			} elseif ($toRow1['sigle_direction']!=''){
				$zSigle = $toRow1['sigle_direction'];
			} elseif ($toRow1['sigle_departement']!=''){
				$zSigle = $toRow1['sigle_departement'];
			}
		}

		return $zSigle;

	}

	public function getListeCommande(&$_iNbrTotal = 0,$_this='',$_iTypeId, $_zUserId='',$_iArticleId='',$_iTypeArticleId=''){
		
		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;

		$toColumns = array( 
			0 => 'commande_id', 
			1 => 'commande_numero',
			2 => 'commande_date',
			3 => 'ca.nom',
			4 => 'tf.typeFourniture_libelle',
			5 => 'st.statut_libelle',
		);

		$oRequest = $_REQUEST;

		$zSql = " SELECT SQL_CALC_FOUND_ROWS * FROM $zDatabaseStock.gestock_commande c 
		INNER JOIN $zDatabaseOrigin.candidat ca ON ca.user_id = c.commande_userId
		INNER JOIN $zDatabaseOrigin.service s ON ca.service = s.id
		INNER JOIN $zDatabaseStock.gestock_fourniturecommande fc ON fc.fournitureCommande_commandeId = c.commande_id
		INNER JOIN $zDatabaseStock.gestock_typecommande tc ON fc.fournitureCommande_typeId = tc.typeCommande_id 
		INNER JOIN $zDatabaseStock.gestock_statut st ON fc.fournitureCommande_statutId = st.statut_id 
		INNER JOIN $zDatabaseStock.gestock_fourniture f ON fc.fournitureCommande_fournitureId = f.fourniture_id
		INNER JOIN $zDatabaseStock.gestock_typeunite ON typeUnite_id = f.fourniture_uniteId
		INNER JOIN $zDatabaseStock.gestock_typefourniture tf ON f.fourniture_typeId = tf.typeFourniture_id WHERE fc.fournitureCommande_typeId = " . $_iTypeId ; 

		if ($_zUserId != '' && $_zUserId != 0){
			$zSql .= " AND commande_userId IN (".$_zUserId.")";
		}

		if ($_iArticleId != '' && $_iArticleId != 0){
			$zSql .= " AND f.fourniture_id  = ".$_iArticleId." ";
		}

		if ($_iTypeArticleId != '' && $_iTypeArticleId != 0){
			$zSql .= " AND tf.typeFourniture_id = ".$_iTypeArticleId." ";
		}


		if ($oRequest['iAgent'] != ""){
			$zSql .= " AND (ca.nom like '%".$oRequest['iAgent']."%' OR ca.prenom like '%".$oRequest['iAgent']."%') ";
		}

		if ($oRequest['zService'] != ""){
			$zSql .= " AND (s.sigle_service like '%".$oRequest['zService']."%' OR s.libele like '%".$oRequest['zService']."%') ";
		}

		if ($oRequest['zRef'] != ""){
			$zSql .= " AND c.commande_numero like '%".$oRequest['zRef']."%' ";
		}

		if ($oRequest['zDate'] != ""){
			$zSql .= " AND c.commande_date LIKE '%".$_this->date_fr_to_en($oRequest['zDate'],'/','-')."%' ";
		}

		if ($oRequest['zArticle'] != ""){
			$zSql .= " AND fourniture_article like '%".$oRequest['zArticle']."%' ";
		}

		if ($oRequest['zUnite'] != ""){
			$zSql .= " AND typeUnite_libelle like '%".$oRequest['zUnite']."%' ";
		}

		if ($oRequest['zQuantite'] != ""){
			$zSql .= " AND fournitureCommande_quantite like '%".$oRequest['zQuantite']."%' ";
		}

		if ($oRequest['iType'] != ""){
			$zSql .= " AND typeFourniture_libelle like '%".$oRequest['iType']."%' ";
		}

		if ($oRequest['zDate1'] != "" && $oRequest['zDate2'] != ''){
			
			$zDate1 = $_this->date_fr_to_en($oRequest['zDate1'],'/','-');
			$zDate2 = $_this->date_fr_to_en($oRequest['zDate2'],'/','-');
			$zSql .= " AND c.commande_date BETWEEN '".$zDate1."' AND '".$zDate2."'  ";
		}

		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( ca.nom LIKE '%".$oRequest['search']['value']."%' ";    
			$zSql.=" OR ca.prenom LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR c.commande_numero LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR c.commande_date LIKE '%".$_this->date_fr_to_en($oRequest['search']['value'],'/','-')."%' ";
			$zSql.=" OR tf.typeFourniture_libelle LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR st.statut_libelle LIKE '%".$oRequest['search']['value']."%' )";
		}

		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			}

			if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
				$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
			}
		} else {
			$zSql.=" ORDER BY f.fourniture_id ASC  LIMIT 0,10   ";
		}

		//echo $zSql ; 

		$zQuery = $DB1->query($zSql);
		$toGetInventaire = $zQuery->result_array();
		$zQuery->free_result(); 

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount = $DB1->query($zQueryDataCount) ;

        $toRow = $toDataCount->result_array();
		
		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}


		return $toGetInventaire;
	}

	public function getListeCommandeExpression(&$_iNbrTotal = 0,$_this='',$_iTypeId){
		
		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;

		$toColumns = array( 
			0 => 'fourniture_id', 
			1 => 'fourniture_article',
			2 => 'typeFourniture_libelle',
		);

		$oRequest = $_REQUEST;

		/*$zSql = " SELECT SQL_CALC_FOUND_ROWS * FROM $zDatabaseStock.gestock_commande c INNER JOIN $zDatabaseOrigin.candidat ca ON ca.user_id = c.commande_userId
		INNER JOIN $zDatabaseStock.gestock_fourniturecommande fc ON fc.fournitureCommande_commandeId = c.commande_id
		INNER JOIN $zDatabaseStock.gestock_typecommande tc ON fc.fournitureCommande_typeId = tc.typeCommande_id 
		INNER JOIN $zDatabaseStock.gestock_statut st ON fc.fournitureCommande_statutId = st.statut_id 
		INNER JOIN $zDatabaseStock.gestock_fourniture f ON fc.fournitureCommande_fournitureId = f.fourniture_id
		INNER JOIN $zDatabaseStock.gestock_typeunite ON typeUnite_id = f.fourniture_uniteId
		INNER JOIN $zDatabaseStock.gestock_typefourniture tf ON f.fourniture_typeId = tf.typeFourniture_id WHERE fc.fournitureCommande_typeId = " . $_iTypeId ; */

		$zSql = " SELECT SQL_CALC_FOUND_ROWS *,fourniture_id as IfournitureId,(SELECT SUM(fournitureCommande_quantite) FROM $zDatabaseStock.gestock_fourniturecommande fc WHERE fournitureCommande_typeId = ".EXPRESSION_BESOIN." AND fournitureCommande_fournitureId = IfournitureId ) as fournitureCommande_quantite
		FROM $zDatabaseStock.gestock_fourniture f 
		INNER JOIN $zDatabaseStock.gestock_typeunite ON typeUnite_id = f.fourniture_uniteId
		INNER JOIN $zDatabaseStock.gestock_typefourniture tf ON f.fourniture_typeId = tf.typeFourniture_id "  ;

		
		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( fourniture_article LIKE '%".$oRequest['search']['value']."%' ";    
			$zSql.=" OR typeFourniture_libelle LIKE '%".$oRequest['search']['value']."%' )";
		}

		$zSql.=" HAVING fournitureCommande_quantite > 0 ";

		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			}

			if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
				$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
			}
		} else {
			$zSql.=" ORDER BY f.fourniture_id ASC  LIMIT 0,10   ";
		}

		$zQuery = $DB1->query($zSql);
		$toGetInventaire = $zQuery->result_array();
		$zQuery->free_result(); 


		// nombre des résultats trouvés
		$zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

		$toDataCount = $DB1->query($zQueryDataCount) ;

		$toRow = $toDataCount->result_array();

		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}


		return $toGetInventaire;
	}

	public function getListeCommandeFiche($_iCommandeId){
		
		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;

		

		$zSql = " SELECT SQL_CALC_FOUND_ROWS * FROM $zDatabaseStock.gestock_fourniturecommande fc
		INNER JOIN $zDatabaseStock.gestock_typecommande tc ON fc.fournitureCommande_typeId = tc.typeCommande_id 
		INNER JOIN $zDatabaseStock.gestock_statut st ON fc.fournitureCommande_statutId = st.statut_id 
		INNER JOIN $zDatabaseStock.gestock_fourniture f ON fc.fournitureCommande_fournitureId = f.fourniture_id
		INNER JOIN $zDatabaseStock.gestock_typeunite ON typeUnite_id = f.fourniture_uniteId
		INNER JOIN $zDatabaseStock.gestock_typefourniture tf ON f.fourniture_typeId = tf.typeFourniture_id
		WHERE fc.fournitureCommande_typeId = " . COMMANDE_NORMAL . " AND fournitureCommande_commandeId = " . $_iCommandeId ; 
		
		$zQuery = $DB1->query($zSql);
		$toGetListeCommande = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toGetListeCommande;
	}

	public function getListeFournitureCommandeFiche($_iFournitureId){
		
		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;

		

		$zSql = " SELECT SQL_CALC_FOUND_ROWS * FROM $zDatabaseStock.gestock_fourniturecommande fc
		INNER JOIN $zDatabaseStock.gestock_commande c ON fc.fournitureCommande_commandeId = c.commande_id 
		INNER JOIN $zDatabaseStock.gestock_fourniture f ON fc.fournitureCommande_fournitureId = f.fourniture_id
		INNER JOIN $zDatabaseOrigin.candidat ca ON c.commande_userId = ca.user_id
		INNER JOIN $zDatabaseOrigin.service s ON s.id = ca.service
		WHERE fc.fournitureCommande_typeId = " . EXPRESSION_BESOIN . " AND fournitureCommande_fournitureId = " . $_iFournitureId ; 

		$zQuery = $DB1->query($zSql);
		$toGetListeCommande = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toGetListeCommande;
	}


	public function getListeCommandeAgent(&$_iNbrTotal = 0,$_this='',$_iTypeId, $_zUserId='',$_iArticleId='',$_iTypeArticleId=''){
		
		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseStock  =  $db['gestock']['database'] ;

		$toColumns = array( 
			0 => 'commande_id', 
			1 => 'commande_numero',
			2 => 'commande_date',
			3 => 'fourniture',
		);

		$oRequest = $_REQUEST;

		$zSql = " SELECT SQL_CALC_FOUND_ROWS *,
		
		( SELECT GROUP_CONCAT( CONCAT ('<i class=\'fa fa-hand-o-right\'></i>&nbsp;&nbsp;           ',fourniture_article,' | <strong style=\"color:blue\">quantité</strong> : ',fournitureCommande_quantite,' ',CASE  WHEN  fournitureCommande_quantite <=1 THEN typeUnite_libelle ELSE typeUnite_plurielle END,' | <strong >Etat :</strong>',statut_libelle) SEPARATOR '<br/><br/>') FROM $zDatabaseStock.gestock_fourniturecommande fc
		INNER JOIN $zDatabaseStock.gestock_typecommande tc ON fc.fournitureCommande_typeId = tc.typeCommande_id 
		INNER JOIN $zDatabaseStock.gestock_statut st ON fc.fournitureCommande_statutId = st.statut_id 
		INNER JOIN $zDatabaseStock.gestock_fourniture f ON fc.fournitureCommande_fournitureId = f.fourniture_id
		INNER JOIN $zDatabaseStock.gestock_typeunite ON typeUnite_id = f.fourniture_uniteId
		INNER JOIN $zDatabaseStock.gestock_typefourniture tf ON f.fourniture_typeId = tf.typeFourniture_id 
		WHERE fournitureCommande_commandeId = c.commande_id AND fc.fournitureCommande_typeId = " . $_iTypeId . " ) AS fourniture
		
		FROM $zDatabaseStock.gestock_commande c INNER JOIN $zDatabaseOrigin.candidat ca ON ca.user_id = c.commande_userId
		INNER JOIN $zDatabaseStock.gestock_fourniturecommande fc ON fc.fournitureCommande_commandeId = c.commande_id
		WHERE fc.fournitureCommande_typeId = " . $_iTypeId ; 

		if ($_zUserId != '' && $_zUserId != 0){
			$zSql .= " AND commande_userId IN (".$_zUserId.")";
		}

		if ($_iArticleId != '' && $_iArticleId != 0){
			$zSql .= " AND f.fourniture_id  = ".$_iArticleId." ";
		}

		if ($_iTypeArticleId != '' && $_iTypeArticleId != 0){
			$zSql .= " AND tf.typeFourniture_id = ".$_iTypeArticleId." ";
		}

		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( ca.nom LIKE '%".$oRequest['search']['value']."%' ";    
			$zSql.=" OR ca.prenom LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR c.commande_numero LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR c.commande_date LIKE '%".$_this->date_fr_to_en($oRequest['search']['value'],'/','-')."%' ";
			$zSql.=" OR fourniture LIKE '%".$oRequest['search']['value']."%' )";
		}

		$zSql.=" GROUP BY c.commande_id  ";

		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			}

			if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
				$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
			}
		} else {
			$zSql.=" ORDER BY c.commande_id ASC  LIMIT 0,10   ";
		}

		$zQuery = $DB1->query($zSql);
		$toGetInventaire = $zQuery->result_array();
		$zQuery->free_result(); 


		// nombre des résultats trouvés
		$zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

		$toDataCount = $DB1->query($zQueryDataCount) ;

		$toRow = $toDataCount->result_array();

		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}

		return $toGetInventaire;
	}



	public function getInfoInventaire(&$_iNbrTotal = 0,$_this='',$_iLimit=0){
		
		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['gestock']['database'] ;

		$toColumns = array( 
			0 => 'fourniture_id', 
			1 => 'fourniture_article',
			2 => 'typeUnite_libelle',
			3 => 'iQuantiteTotal',
			4 => 'commandePris'
		);

		$oRequest = $_REQUEST;
		
		$zSqlDate="";
		$zSqlStockDate="";
		if ($oRequest['zDate'] != ""){
			$zDate		= $_this->date_fr_to_en($oRequest['zDate'],'/','-'); 
			$zSqlDate   = " AND commande_date <= '".$zDate."'";
			$zSqlStockDate  = " AND stock_date <= '".$zDate."'";
		} else {
			$zSqlDate   = " AND commande_date <= '".date("Y-m-d")."'";
			$zSqlStockDate  = " AND stock_date <= '".date("Y-m-d")."'";
		}

		$zSql = " SELECT SQL_CALC_FOUND_ROWS *,fourniture_id AS iFournitureId,IFNULL((SELECT SUM(rebut_quantite) FROM gestock_rebut WHERE rebut_fournitureId = iFournitureId),0) AS 			  rebut,
				  (SELECT (SUM(stock_quantite)-rebut) FROM $zDatabaseOrigin.gestock_stock WHERE stock_fournitureId = iFournitureId $zSqlStockDate) AS iQuantiteTotal,
				  ifnull((SELECT SUM(fournitureCommande_quantite) FROM $zDatabaseOrigin.gestock_fourniturecommande INNER JOIN $zDatabaseOrigin.gestock_commande ON fournitureCommande_commandeId = commande_id WHERE fournitureCommande_fournitureId = iFournitureId AND fournitureCommande_typeId=".COMMANDE_NORMAL." AND fournitureCommande_statutId=".LIVRER." $zSqlDate ),0) AS commandePris,typeFourniture_sigle,
                  (100-(( ifnull((SELECT SUM(fournitureCommande_quantite) FROM $zDatabaseOrigin.gestock_fourniturecommande INNER JOIN $zDatabaseOrigin.gestock_commande ON fournitureCommande_commandeId = commande_id WHERE fournitureCommande_fournitureId = iFournitureId AND fournitureCommande_typeId=".COMMANDE_NORMAL." AND fournitureCommande_statutId=".LIVRER." $zSqlDate),0)
                  / (SELECT (SUM(stock_quantite)-rebut) FROM $zDatabaseOrigin.gestock_stock WHERE stock_fournitureId = iFournitureId $zSqlStockDate))*100)) AS pourcentage FROM gestock_fourniture f
				  INNER JOIN gestock_typefourniture ON fourniture_typeId = typeFourniture_id
				  INNER JOIN gestock_typeunite ON fourniture_uniteId = typeunite_id " ; 


		//echo $zSql ; 

		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( f.fourniture_id LIKE '%".$oRequest['search']['value']."%' ";    
			$zSql.=" OR f.fourniture_article LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR f.fourniture_specification LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR typeUnite_libelle LIKE '%".$oRequest['search']['value']."%' )";
		}

		if ($oRequest['iNumero'] != ""){
			$zSql.=" AND fourniture_id LIKE '%".$oRequest['iNumero']."%' ";
		} 

		if ($oRequest['zArticle'] != ""){
			$zSql.=" AND fourniture_article  LIKE '%".$oRequest['zArticle']."%' ";
		} 

		if ($oRequest['zUnite'] != ""){
			$zSql.=" AND typeUnite_libelle LIKE '%".$oRequest['zUnite']."%' ";
		} 

		if ($oRequest['iStockActuel'] != ""){
			$zSql.=" AND iQuantiteTotal LIKE '%".$oRequest['iStockActuel']."%' ";
		} 

		if ($oRequest['iQteCommande'] != ""){
			$zSql.=" AND commandePris LIKE '%".$oRequest['iQteCommande']."%' ";
		} 

		if (sizeof($oRequest)>0){
			
			$zSql.=" HAVING iQuantiteTotal > 0";
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			} else {
				$zSql.=" ORDER BY f.fourniture_article ASC ";
			}

			if ($_iLimit==0){
				if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
					$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
				}
			}
		} else {

			$zSql.=" HAVING iQuantiteTotal > 0";
			$zSql.=" ORDER BY f.fourniture_article ASC ";
			
			if ($_iLimit==0){
				$zSql.=" LIMIT 0,10   ";
			}
		}

		$zQuery = $DB1->query($zSql);
		$toGetInventaire = $zQuery->result_array();
		$zQuery->free_result(); 


		// nombre des résultats trouvés
		$zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

		$toDataCount = $DB1->query($zQueryDataCount) ;

		$toRow = $toDataCount->result_array();

		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}


		return $toGetInventaire;
	}

	public function getListeMercuriale(&$_iNbrTotal = 0,$_this='',$_iLimit=0){
		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['gestock']['database'] ;

		$toColumns = array( 
			0 => 'fourniture_id', 
			1 => 'typeFourniture_libelle',
			2 => 'fourniture_article',
			3 => 'fourniture_specification',
			4 => 'typeUnite_libelle'
		);

		$oRequest = $_REQUEST;
		
		$zSqlDate="";
		$zSqlStockDate="";
		if ($oRequest['zDate'] != ""){
			$zDate		= $_this->date_fr_to_en($oRequest['zDate'],'/','-'); 
			$zSqlDate   = " AND commande_date <= '".$zDate."'";
			$zSqlStockDate  = " AND stock_date <= '".$zDate."'";
		} 

		$zSql = " SELECT SQL_CALC_FOUND_ROWS *,ifnull((select mercuriale_prix from $zDatabaseOrigin.gestock_mercuriale WHERE mercuriale_fournitureId=fourniture_id
				  AND mercuriale_applicable=1),0) as mercuriale_prix FROM $zDatabaseOrigin.gestock_fourniture
				  INNER JOIN $zDatabaseOrigin.gestock_typeunite ON typeUnite_id = fourniture_uniteId
				  INNER JOIN $zDatabaseOrigin.gestock_typefourniture ON fourniture_typeId = typeFourniture_id" ; 


		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( typeFourniture_libelle LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR fourniture_article LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR fourniture_specification LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR typeUnite_libelle LIKE '%".$oRequest['search']['value']."%' )";
		}
		

		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			}

			if ($_iLimit==0){
				if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
					$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
				}
			}
		} else {
			$zSql.=" ORDER BY fourniture_id ";

			if ($_iLimit==0){
				$zSql.=" LIMIT 0,10   ";
			}
		}

		//echo $zSql ; 

		$zQuery = $DB1->query($zSql);
		$toGetInventaire = $zQuery->result_array();
		$zQuery->free_result(); 


		// nombre des résultats trouvés
		$zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

		$toDataCount = $DB1->query($zQueryDataCount) ;

		$toRow = $toDataCount->result_array();

		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}

		return $toGetInventaire;

	}

	public function getListeInventairePv($zCheckList,&$_iNbrTotal = 0,$_this='',$_iLimit=0){
		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['gestock']['database'] ;

		$toColumns = array( 
			0 => 'pv_id', 
			1 => 'pv_reference',
			2 => 'pv_date',
			3 => 'typeFourniture_libelle',
		);

		$oRequest = $_REQUEST;
		

		$zSql = " SELECT SQL_CALC_FOUND_ROWS * FROM $zDatabaseOrigin.gestock_pv
				  INNER JOIN $zDatabaseOrigin.gestock_typefourniture ON typeFourniture_id = pv_typeFournitureId" ; 

		if ($zCheckList != ''){
			$zSql.=" AND pv_id IN (".$zCheckList .")  ";
		}

		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( pv_id LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR pv_reference LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR pv_date LIKE '%".$_this->date_fr_to_en($oRequest['search']['value'],'/','-')."%' ";
			$zSql.=" OR typeFourniture_libelle LIKE '%".$oRequest['search']['value']."%' )";
		}
		

		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			}

			if ($_iLimit==0){
				if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
					$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
				}
			}
		} else {
			$zSql.=" ORDER BY pv_id ASC ";

			if ($_iLimit==0){
				$zSql.=" LIMIT 0,10   ";
			}
		}

		$zQuery = $DB1->query($zSql);
		$toGetInventairePv = $zQuery->result_array();
		$zQuery->free_result(); 


		// nombre des résultats trouvés
		$zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

		$toDataCount = $DB1->query($zQueryDataCount) ;

		$toRow = $toDataCount->result_array();

		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}


		return $toGetInventairePv;

	}

	public function getAllListFournitureEnStock($_zTerm="aa", $_iFiltre){
		
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['gestock']['database'] ;
		
		$zSql= "SELECT * FROM $zDatabaseOrigin.gestock_fourniture WHERE (fourniture_article LIKE '%$_zTerm%') ";

		if ($_iFiltre != 0){
			$zSql .= "  AND fourniture_typeId = ".$_iFiltre."";
		}

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $oRow;
	}

	public function getConsommateurDRHA($_zTerm="aa", $_iFiltre){
		
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$zSql= "SELECT * FROM $zDatabaseOrigin.candidat WHERE (nom LIKE '%$_zTerm%' OR prenom LIKE '%$_zTerm%') AND direction = ".DIRECTION_DRHA."";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $oRow;
	}

	public function statistiqueTaux(){
		
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['gestock']['database'] ;
		
		$zSql= "SELECT fourniture_article,ifnull((SELECT SUM(fournitureCommande_quantite) FROM $zDatabaseOrigin.gestock_fourniturecommande INNER JOIN $zDatabaseOrigin.gestock_commande ON fournitureCommande_commandeId = commande_id WHERE fournitureCommande_fournitureId = fourniture_id AND fournitureCommande_typeId=".COMMANDE_NORMAL." AND fournitureCommande_statutId=".LIVRER."),0) as quantiteConsomme FROM $zDatabaseOrigin.gestock_fourniture GROUP BY fourniture_id";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		return $oRow;
	}

	public function statistiqueConsommeeSurTotal($_iUserId=0){
		
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['gestock']['database'] ;
		$zDatabaseRohi   =  $db['default']['database'] ;
		
		$zSql= "SELECT IFNULL(prenom,nom) as nom,user_id as iUserId, ((ifnull((SELECT SUM(fournitureCommande_quantite) FROM $zDatabaseOrigin.gestock_fourniturecommande INNER JOIN $zDatabaseOrigin.gestock_commande ON fournitureCommande_commandeId = commande_id WHERE commande_userId = iUserId AND fournitureCommande_typeId=".COMMANDE_NORMAL." AND fournitureCommande_statutId=".LIVRER."),0)) / ifnull((SELECT SUM(fournitureCommande_quantite) FROM $zDatabaseOrigin.gestock_fourniturecommande INNER JOIN $zDatabaseOrigin.gestock_commande ON fournitureCommande_commandeId = commande_id WHERE fournitureCommande_typeId=".COMMANDE_NORMAL." AND fournitureCommande_statutId=".LIVRER."),1))*100 as fraction FROM $zDatabaseOrigin.gestock_commande INNER JOIN 
		$zDatabaseRohi.candidat ON commande_userId = user_id WHERE 1 ";

		if ($_iUserId != 0){
			$zSql .= " AND commande_userId = " . $_iUserId ; 
		}

		$zSql .= " GROUP BY commande_userId " ; 

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}

	public function statistiqueArticleSurTotal($_iArticleId=0){
		
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['gestock']['database'] ;
		$zDatabaseRohi   =  $db['default']['database'] ;
		
		$zSql= "SELECT *,fourniture_id as iFournitureId, ((ifnull((SELECT SUM(fournitureCommande_quantite) FROM $zDatabaseOrigin.gestock_fourniturecommande INNER JOIN $zDatabaseOrigin.gestock_commande ON fournitureCommande_commandeId = commande_id WHERE fournitureCommande_fournitureId = iFournitureId AND fournitureCommande_typeId=".COMMANDE_NORMAL." AND fournitureCommande_statutId=".LIVRER."),0)) / ifnull((SELECT SUM(stock_quantite) FROM $zDatabaseOrigin.gestock_stock WHERE stock_fournitureId=iFournitureId),1))*100 as fraction FROM $zDatabaseOrigin.gestock_fourniture WHERE 1 ";

		if ($_iArticleId != 0){
			$zSql .= " AND fourniture_id = " . $_iArticleId ; 
		}

		$zSql .= " GROUP BY fourniture_id HAVING fraction > 0" ; 

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}

	public function getPrevisionArticle(){
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['gestock']['database'] ;
		$zDatabaseRohi   =  $db['default']['database'] ;

		/* les mois écoulement de  produit */
		$iDenominateur = $this->getDenominateur();
		
		$zSql= "SELECT *,fourniture_id as iFournitureId,

		(CASE  
				WHEN  
			    (SELECT COUNT(fournitureCommande_quantite) FROM $zDatabaseOrigin.gestock_fourniturecommande INNER JOIN $zDatabaseOrigin.gestock_commande ON fournitureCommande_commandeId = commande_id  WHERE fournitureCommande_fournitureId = iFournitureId AND fournitureCommande_typeId = ".EXPRESSION_BESOIN."
				AND YEAR(commande_date) = '".date("Y")."') > 0 
		
			
				THEN 

				(SELECT SUM(fournitureCommande_quantite) FROM $zDatabaseOrigin.gestock_fourniturecommande INNER JOIN $zDatabaseOrigin.gestock_commande ON fournitureCommande_commandeId = commande_id  WHERE fournitureCommande_fournitureId = iFournitureId 
				AND YEAR(commande_date) = '".date("Y")."')
					
					
				ELSE 

				(IFNULL((SELECT SUM(stock_quantite) FROM $zDatabaseOrigin.gestock_stock WHERE stock_fournitureId=iFournitureId),0) 
				/IFNULL((SELECT SUM(fournitureCommande_quantite) FROM $zDatabaseOrigin.gestock_fourniturecommande INNER JOIN $zDatabaseOrigin.gestock_commande ON fournitureCommande_commandeId = commande_id WHERE fournitureCommande_fournitureId = iFournitureId 
				AND fournitureCommande_typeId=".COMMANDE_NORMAL." AND fournitureCommande_statutId=".LIVRER." AND YEAR(commande_date)='".date("Y")."'),1) * ".$iDenominateur.")
					
					
		END) as quantiteMin,
		
		
		(SELECT AVG(mercuriale_prix) FROM $zDatabaseOrigin.gestock_mercuriale WHERE mercuriale_fournitureId = iFournitureId) as PrixUnitaire from $zDatabaseOrigin.gestock_fourniture 
		INNER JOIN $zDatabaseOrigin.gestock_typeunite ON typeUnite_id = fourniture_uniteId ORDER BY fourniture_id ASC";

		//echo $zSql ;

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}

	public function getDenominateur(){

		global $db;
		$DB1 = $this->load->database('gestock', TRUE);
		
		$zDatabaseStock  =  $db['gestock']['database'] ;

		$zSql = " SELECT COUNT(DISTINCT(MONTH(commande_date))) AS iDenominateur FROM gestock_commande WHERE YEAR(commande_date) = '".date("Y")."' " ; 

		$zQuery = $DB1->query($zSql);
		$toGetInfoFourniture = $zQuery->result_array();
		$zQuery->free_result(); 

		foreach($toGetInfoFourniture as $toRow1){
			$iDenominateur = $toRow1['iDenominateur'];
		}

		return $iDenominateur;
	}

	public function statistiqueTe(){
		
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['gestock']['database'] ;
		$zDatabaseRohi   =  $db['default']['database'] ;

		/* les mois écoulement de  produit */
		$iDenominateur = $this->getDenominateur();
		
		$zSql= "SELECT *,fourniture_id as iFournitureId,
		IFNULL((SELECT SUM(stock_quantite) FROM $zDatabaseOrigin.gestock_stock WHERE stock_fournitureId=iFournitureId),0)  AS stockTotal,
		IFNULL((SELECT SUM(fournitureCommande_quantite) FROM $zDatabaseOrigin.gestock_fourniturecommande INNER JOIN $zDatabaseOrigin.gestock_commande ON fournitureCommande_commandeId = commande_id WHERE fournitureCommande_fournitureId = iFournitureId 
		AND fournitureCommande_typeId=".COMMANDE_NORMAL." AND fournitureCommande_statutId=".LIVRER." AND YEAR(commande_date)='".date("Y")."') / ".$iDenominateur.",1) AS consommationAnuel,
		IFNULL((SELECT SUM(stock_quantite) FROM $zDatabaseOrigin.gestock_stock WHERE stock_fournitureId=iFournitureId),0) 
		/IFNULL((SELECT SUM(fournitureCommande_quantite) FROM $zDatabaseOrigin.gestock_fourniturecommande INNER JOIN $zDatabaseOrigin.gestock_commande ON fournitureCommande_commandeId = commande_id WHERE fournitureCommande_fournitureId = iFournitureId 
		AND fournitureCommande_typeId=".COMMANDE_NORMAL." AND fournitureCommande_statutId=".LIVRER." AND YEAR(commande_date)='".date("Y")."') / ".$iDenominateur.",1) AS fraction  FROM $zDatabaseOrigin.gestock_fourniture GROUP BY fourniture_id HAVING stockTotal <> 0";


		//echo $zSql ; 
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}

	public function statistiqueRc($_iArticleId=''){
		
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['gestock']['database'] ;
		$zDatabaseRohi   =  $db['default']['database'] ;
		
		$zSql= "SELECT *,fourniture_id as iFournitureId,
		IFNULL((SELECT SUM(stock_quantite) FROM $zDatabaseOrigin.gestock_stock WHERE stock_fournitureId=iFournitureId),0)  AS stockTotal,
		IFNULL((SELECT SUM(fournitureCommande_quantite) FROM $zDatabaseOrigin.gestock_fourniturecommande INNER JOIN $zDatabaseOrigin.gestock_commande ON fournitureCommande_commandeId = commande_id WHERE fournitureCommande_fournitureId = iFournitureId 
		AND fournitureCommande_typeId=".COMMANDE_NORMAL." AND fournitureCommande_statutId=".LIVRER." AND YEAR(commande_date)='".date("Y")."'),1) AS consommationAnuel,
		IFNULL((SELECT SUM(fournitureCommande_quantite) FROM $zDatabaseOrigin.gestock_fourniturecommande INNER JOIN $zDatabaseOrigin.gestock_commande ON fournitureCommande_commandeId = commande_id WHERE fournitureCommande_fournitureId = iFournitureId 
		AND fournitureCommande_typeId=".COMMANDE_NORMAL." AND fournitureCommande_statutId=".LIVRER." AND YEAR(commande_date)='".date("Y")."'),1)/IFNULL((SELECT SUM(stock_quantite) FROM $zDatabaseOrigin.gestock_stock WHERE stock_fournitureId=iFournitureId),0)*100  AS fraction  FROM $zDatabaseOrigin.gestock_fourniture WHERE 1 ";


		if ($_iArticleId != '' && $_iArticleId != 0){
			$zSql .= " AND fourniture_id = " . $_iArticleId;
		}

		$zSql .= " GROUP BY fourniture_id  ";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}




	public function getListeStock(&$_iNbrTotal = 0,$_this='',$_iLimit=0){
		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['gestock']['database'] ;

		$toColumns = array( 
			0 => 'fourniture_id', 
			1 => 'typeFourniture_libelle',
			2 => 'fourniture_article',
			3 => 'typeUnite_libelle',
			4 => 'stock_quantite'
		);

		$oRequest = $_REQUEST;
		

		$zSql = " SELECT SQL_CALC_FOUND_ROWS *,IFNULL((SELECT SUM(rebut_quantite) FROM gestock_rebut WHERE rebut_fournitureId = fourniture_id),0) AS rebut,ifnull((select (SUM(stock_quantite)-rebut) FROM $zDatabaseOrigin.gestock_stock WHERE stock_fournitureId = fourniture_id),0) as stock_quantite, ifnull((SELECT SUM(fournitureCommande_quantite) FROM $zDatabaseOrigin.gestock_fourniturecommande INNER JOIN $zDatabaseOrigin.gestock_commande ON fournitureCommande_commandeId = commande_id WHERE fournitureCommande_fournitureId = fourniture_id AND fournitureCommande_typeId=".COMMANDE_NORMAL." AND fournitureCommande_statutId=".LIVRER." $zSqlDate),0) as quantiteConsomme FROM 
				  $zDatabaseOrigin.gestock_fourniture 
				  INNER JOIN $zDatabaseOrigin.gestock_typeunite ON typeUnite_id = fourniture_uniteId
				  INNER JOIN $zDatabaseOrigin.gestock_typefourniture ON fourniture_typeId = typeFourniture_id" ; 


		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( typeFourniture_libelle LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR fourniture_article LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR typeUnite_libelle LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR stock_quantite LIKE '%".$oRequest['search']['value']."%' )";
		}


		if ($oRequest['zType'] != ""){
			$zSql .= " AND typeFourniture_libelle like '%".$oRequest['zType']."%' ";
		}

		if ($oRequest['zArticle'] != ""){
			$zSql .= " AND fourniture_article like '%".$oRequest['zArticle']."%' ";
		}

		if ($oRequest['iUnite'] != ""){
			$zSql .= " AND typeUnite_libelle like '%".$oRequest['iUnite']."%' ";
		}

		if ($oRequest['iQuantiteActuel'] != "" || $oRequest['iQuantiteConsomme']){
			
			$zSql .= " HAVING 1 ";
			if ($oRequest['iQuantiteActuel'] != ""){
				$zSql .= " AND stock_quantite = '".$oRequest['iQuantiteActuel']."' ";
			}
			
			if ($oRequest['iQuantiteConsomme'] != ""){
				$zSql .= " AND quantiteConsomme = '".$oRequest['iQuantiteConsomme']."' ";
			}
		}

		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			} else {
				$zSql.=" ORDER BY fourniture_article ASC ";
			}

			if ($_iLimit==0){
				if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
					$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
				}
			} else {
				$zSql.=" LIMIT 0,10   ";
			}
		} else {
			$zSql.=" ORDER BY fourniture_article ASC ";
			if ($_iLimit==0){
				$zSql.=" LIMIT 0,10   ";
			}
		}

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 


		// nombre des résultats trouvés
		$zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

		$toDataCount = $DB1->query($zQueryDataCount) ;

		$toRow = $toDataCount->result_array();

		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}


		return $oRow;

	}


	public function getListeUnite(&$_iNbrTotal = 0,$_this='',$_iLimit=0){
		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['gestock']['database'] ;

		

		$toColumns = array( 
			0 => 'typeUnite_id', 
			1 => 'typeUnite_libelle'
		);

		$oRequest = $_REQUEST;
		

		$zSql = " SELECT SQL_CALC_FOUND_ROWS * FROM gestock_typeunite " ; 


		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( typeUnite_libelle LIKE '%".$oRequest['search']['value']."%' ) ";
		}
		
		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			} else {
				$zSql.=" ORDER BY typeUnite_libelle ASC ";
			}

			if ($_iLimit==0){
				if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
					$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
				}
			} else {
				$zSql.=" LIMIT 0,10   ";
			}
		} else {
			$zSql.=" ORDER BY typeUnite_libelle ASC ";
			if ($_iLimit==0){
				$zSql.=" LIMIT 0,10   ";
			}
		}

		$zQuery = $DB1->query($zSql);
		$toGetInventaire = $zQuery->result_array();
		$zQuery->free_result(); 


		// nombre des résultats trouvés
		$zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

		$toDataCount = $DB1->query($zQueryDataCount) ;

		$toRow = $toDataCount->result_array();

		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}


		return $toGetInventaire;

	}

	public function getListeFourniture(&$_iNbrTotal = 0,$_this='',$_iLimit=0){
		global $db;
		$DB1 = $this->load->database('gestock', TRUE);

		$zDatabaseOrigin =  $db['gestock']['database'] ;

		$toColumns = array( 
			0 => 'typeFourniture_id', 
			1 => 'typeFourniture_libelle'
		);

		$oRequest = $_REQUEST;
		

		$zSql = " SELECT SQL_CALC_FOUND_ROWS * FROM gestock_typefourniture " ; 


		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( typeFourniture_libelle LIKE '%".$oRequest['search']['value']."%' ) ";
		}
		
		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			} else {
				$zSql.=" ORDER BY typeFourniture_libelle ASC ";
			}

			if ($_iLimit==0){
				if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
					$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
				}
			} else {
				$zSql.=" LIMIT 0,10   ";
			}
		} else {
			$zSql.=" ORDER BY typeFourniture_libelle ASC ";
			if ($_iLimit==0){
				$zSql.=" LIMIT 0,10   ";
			}
		}

		$zQuery = $DB1->query($zSql);
		$toGetInventaire = $zQuery->result_array();
		$zQuery->free_result(); 


		// nombre des résultats trouvés
		$zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

		$toDataCount = $DB1->query($zQueryDataCount) ;

		$toRow = $toDataCount->result_array();

		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}

		return $toGetInventaire;

	}

	public function InventairePermanentPdf ($_toListe, $_iFlag, $_zDate) {

		require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

			$oPdf=new FPDF();
			$oPdf->AddPage("P");

			$oPdf->SetAutoPageBreak(400);

			//Fields Name position
			$Y_Fields_Name_position = 20;
			//Table position, under Fie*lds Name
			$Y_Table_Position = 26;

			//First create each Field Name
			//Gray color filling each Field Name box

			$oPdf->SetFillColor(255,255,255);
			//$oPdf->AddFont('trebuc','','trebuc.php');
			//Bold Font for Field Name
			$oPdf->SetFont('Times','',9);
			//$oPdf->SetY($Y_Fields_Name_position);

			$oPdf->SetX(10);
			$oPdf->Cell(200,7,'REPOBLIKAN\'I MADAGASIKARA',0,0,'C',1);
			$oPdf->Ln();

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','I');
			$oPdf->Cell(200,7,'Fitiavana - Tanindrazana - Fandrosoana',0,0,'C',1);

			$oPdf->SetFont('Times','',9);

			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(100,7,utf8_decode('  MINISTERE DES FINANCES ET DU BUDGET'),0,0,'L',1);

			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(70,7,'SECRETARIAT GENERAL',0,0,'C',1);

			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(100,7,'  Direction des Ressources Humaines et de l\'Appui',0,0,'L',1);
			
			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->SetX(10);

			$oPdf->Cell(200,7,'INVENTAIRE PERMANENT EN DATE DU ' . $_zDate,0,0,'C',1);

			$zImageLogoUrl = PATH_ROOT_DIR.'/assets/gcap/images/def3.jpg';

			$oPdf->Image($zImageLogoUrl,10,5,22.5);

			$zImageDrha = PATH_ROOT_DIR.'/assets/gcap/images/def1.jpg';

			$oPdf->Image($zImageDrha,177,5,22.5);

			
			$oPdf->Ln();



			//=================================================================
			$oPdf->SetFont('Times','',9);


			$oPdf->SetX(10);
			$oPdf->Cell(20,7,utf8_decode('N°'),1,0,'C',1);

			$oPdf->SetX(30);
			$oPdf->Cell(80,7,'Article',1,0,'C',1);

			$oPdf->SetX(110);
			$oPdf->Cell(25,7,utf8_decode('Unité'),1,0,'C',1);

			$oPdf->SetX(135);
			$oPdf->Cell(25,7,utf8_decode('Qé totale'),1,0,'C',1);

			$oPdf->SetX(160);
			$oPdf->Cell(25,7,utf8_decode('Qté commandée'),1,0,'C',1);

			$oPdf->SetX(185);
			$oPdf->Cell(20,7,utf8_decode('Contrôle'),1,0,'C',1);

			$oPdf->Ln();

			$oPdf->SetFillColor(255,255,255);
			//=================================================================
			$oPdf->SetFont('Times','',9);


			$i=0;
			foreach ($_toListe as $oListe) {

				$zBorder = "LR" ; 
				if ($i == 0) {
					$zBorder = "TLR";
				}
				
				if ($i == sizeof($_toListe)-1) {
					$zBorder = "BLR";
				}

				$iPosition = (int)$oPdf->GetY();

				if ($iPosition == 283) {
					$zBorder = "BLR";
				}

			
				if ($iPosition == 290) {
					$zBorder = "TLR";
					$oPdf->SetX(10);
					$oPdf->Cell(20,7,utf8_decode('N°'),1,0,'C',1);

					$oPdf->SetX(30);
					$oPdf->Cell(80,7,'Article',1,0,'C',1);

					$oPdf->SetX(110);
					$oPdf->Cell(25,7,utf8_decode('Unité'),1,0,'C',1);

					$oPdf->SetX(135);
					$oPdf->Cell(25,7,utf8_decode('Qé totale'),1,0,'C',1);

					$oPdf->SetX(160);
					$oPdf->Cell(25,7,utf8_decode('Qté commandée'),1,0,'C',1);

					$oPdf->SetX(185);
					$oPdf->Cell(20,7,utf8_decode('Contrôle'),1,0,'C',1);

					$oPdf->Ln();

					$oPdf->SetFillColor(255,255,255);
				}

				$oPdf->SetX(10);
				$oPdf->Cell(20,7,$oListe['fourniture_id'],$zBorder,0,'C',1);

				$oPdf->SetX(30);
				$oPdf->Cell(80,7,utf8_decode($oListe['fourniture_article']). " | " . utf8_decode($oListe['typeFourniture_sigle']) ,$zBorder,0,'L',1);

				$oPdf->SetX(110);
				$oPdf->Cell(25,7,substr(utf8_decode($oListe['typeUnite_libelle']) , 0, 15),$zBorder,0,'C',1);

				$oPdf->SetX(135);
				$oPdf->Cell(25,7,utf8_decode($oListe['iQuantiteTotal']),$zBorder,0,'C',1);

				$oPdf->SetX(160);
				$oPdf->Cell(25,7,utf8_decode($oListe['commandePris']),$zBorder,0,'C',1);

				$zControle = "";
				if ($oListe['pourcentage'] >= 20){
					$zControle = "Correct";
				} elseif ($oListe['pourcentage'] > 7  AND $oListe['pourcentage'] < 20){
					$zControle = "Contrôle";
				} elseif ($oListe['pourcentage'] <= 7){ 
					$zControle = "Alerte";
				}

				$oPdf->SetX(185);
				$oPdf->Cell(20,7,utf8_decode($zControle),$zBorder,0,'C',1);

				$oPdf->Ln();
				
				$i++;
			}

			$oPdf->Ln();

			
			if ($oPdf->GetY()> 400){
				$oPdf->AddPage();
			}

			$oPdf->Cell(175,7,utf8_decode(' Arrêté le présent tableau au nombre de '. sizeof($_toListe).' articles '),0,0,'L',1);

			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->Cell(175,7,utf8_decode(' Le responsable magasin '),0,0,'R',1);

			if ($_iFlag == 0){
				$oPdf->Output();
			} else {
				$oPdf->Output("inventaire-permanent-".date("mdYHms").".pdf","D");
			}
	}

	public function ListeStockPdf ($_toListe, $_iFlag) {

		require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

			$oPdf=new FPDF();
			$oPdf->AddPage("P");

			$oPdf->SetAutoPageBreak(270);

			//Fields Name position
			$Y_Fields_Name_position = 20;
			//Table position, under Fie*lds Name
			$Y_Table_Position = 26;

			//First create each Field Name
			//Gray color filling each Field Name box

			$oPdf->SetFillColor(255,255,255);
			//$oPdf->AddFont('trebuc','','trebuc.php');
			//Bold Font for Field Name
			$oPdf->SetFont('Times','',9);
			//$oPdf->SetY($Y_Fields_Name_position);

			$oPdf->SetX(10);
			$oPdf->Cell(200,7,'REPOBLIKAN\'I MADAGASIKARA',0,0,'C',1);
			$oPdf->Ln();

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','I');
			$oPdf->Cell(200,7,'Fitiavana - Tanindrazana - Fandrosoana',0,0,'C',1);

			$oPdf->SetFont('Times','',9);

			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(100,7,utf8_decode('  MINISTERE DES FINANCES ET DU BUDGET'),0,0,'L',1);

			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(70,7,'SECRETARIAT GENERAL',0,0,'C',1);

			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(100,7,'  Direction des Ressources Humaines et de l\'Appui',0,0,'L',1);
			
			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(200,7,'ENTREE EN STOCK ',0,0,'C',1);

			$zImageLogoUrl = PATH_ROOT_DIR.'/assets/gcap/images/def3.jpg';

			$oPdf->Image($zImageLogoUrl,10,5,22.5);

			$zImageDrha = PATH_ROOT_DIR.'/assets/gcap/images/def1.jpg';

			$oPdf->Image($zImageDrha,177,5,22.5);

			
			$oPdf->Ln();



			//=================================================================
			$oPdf->SetFont('Times','',9);

			$oPdf->SetX(10);
			$oPdf->Cell(20,7,utf8_decode('N°'),1,0,'C',1);

			$oPdf->SetX(30);
			$oPdf->Cell(80,7,utf8_decode('Article'),1,0,'C',1);

			$oPdf->SetX(110);
			$oPdf->Cell(30,7,utf8_decode('Unité'),1,0,'C',1);

			$oPdf->SetX(140);
			$oPdf->Cell(30,7,utf8_decode('Quantité totale'),1,0,'C',1);

			$oPdf->SetX(170);
			$oPdf->Cell(30,7,utf8_decode('Quantite consommée'),1,0,'C',1);

			$oPdf->Ln();

			$oPdf->SetFillColor(255,255,255);
			//=================================================================
			$oPdf->SetFont('Times','',9);


			$i=0;
			foreach ($_toListe as $oListe) {

				$zBorder = "LR" ; 
				if ($i == 0) {
					$zBorder = "TLR";
				}
				
				if ($i == sizeof($_toListe)-1) {
					$zBorder = "BLR";
				}

				$iPosition = (int)$oPdf->GetY();

				if ($iPosition == 283) {
					$zBorder = "BLR";
				}
			
				if ($iPosition == 290) {
					$zBorder = "TLR";
					$oPdf->SetX(10);
					$oPdf->Cell(20,7,utf8_decode('N°'),1,0,'C',1);

					$oPdf->SetX(30);
					$oPdf->Cell(80,7,utf8_decode('Article'),1,0,'C',1);

					$oPdf->SetX(110);
					$oPdf->Cell(30,7,utf8_decode('Unité'),1,0,'C',1);

					$oPdf->SetX(140);
					$oPdf->Cell(30,7,utf8_decode('Quantité totale'),1,0,'C',1);

					$oPdf->SetX(170);
					$oPdf->Cell(30,7,utf8_decode('Quantite consommée'),1,0,'C',1);

					$oPdf->Ln();

					$oPdf->SetFillColor(255,255,255);
				}

				$oPdf->SetX(10);
				$oPdf->Cell(20,7,$oListe['fourniture_id'],$zBorder,0,'C',1);

				$oPdf->SetX(30);
				$oPdf->Cell(80,7,utf8_decode($oListe['fourniture_article']). " | " . $oListe['typeFourniture_sigle'],$zBorder,0,'L',1);

				$oPdf->SetX(110);
				$oPdf->Cell(30,7,substr(utf8_decode($oListe['typeUnite_libelle']) , 0, 23),$zBorder,0,'C',1);

				$oPdf->SetX(140);
				$oPdf->Cell(30,7,utf8_decode($oListe['stock_quantite']),$zBorder,0,'C',1);

				$oPdf->SetX(170);
				$oPdf->Cell(30,7,utf8_decode($oListe['quantiteConsomme']),$zBorder,0,'C',1);

				$oPdf->Ln();
				
				$i++;
			}

			$oPdf->Ln();

			
			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			$oPdf->Cell(175,7,utf8_decode(' Arrêté le présent tableau au nombre de '. sizeof($_toListe).' articles '),0,0,'L',1);

			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->Cell(175,7,utf8_decode(' Le responsable magasin '),0,0,'R',1);

			if ($_iFlag == 0){
				$oPdf->Output();
			} else {
				$oPdf->Output("entree-stock-".date("mdYHms").".pdf","D");
			}
	}


	public function ListeMercurialePdf ($_toListe, $_iFlag) {

		require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

			$oPdf=new FPDF();
			$oPdf->AddPage("P");

			$oPdf->SetAutoPageBreak(270);

			//Fields Name position
			$Y_Fields_Name_position = 20;
			//Table position, under Fie*lds Name
			$Y_Table_Position = 26;

			//First create each Field Name
			//Gray color filling each Field Name box

			$oPdf->SetFillColor(255,255,255);
			//$oPdf->AddFont('trebuc','','trebuc.php');
			//Bold Font for Field Name
			$oPdf->SetFont('Times','',9);
			//$oPdf->SetY($Y_Fields_Name_position);

			$oPdf->SetX(10);
			$oPdf->Cell(200,7,'REPOBLIKAN\'I MADAGASIKARA',0,0,'C',1);
			$oPdf->Ln();

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','I');
			$oPdf->Cell(200,7,'Fitiavana - Tanindrazana - Fandrosoana',0,0,'C',1);

			$oPdf->SetFont('Times','',9);

			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(100,7,utf8_decode('  MINISTERE DES FINANCES ET DU BUDGET'),0,0,'L',1);

			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(70,7,'SECRETARIAT GENERAL',0,0,'C',1);

			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(100,7,'  Direction des Ressources Humaines et de l\'Appui',0,0,'L',1);

			
			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(200,7,'MERCURIALE',0,0,'C',1);
			$oPdf->Ln();

			$zImageLogoUrl = PATH_ROOT_DIR.'/assets/gcap/images/def3.jpg';

			$oPdf->Image($zImageLogoUrl,10,5,22.5);

			$zImageDrha = PATH_ROOT_DIR.'/assets/gcap/images/def1.jpg';

			$oPdf->Image($zImageDrha,177,5,22.5);

			//=================================================================
			$oPdf->SetFont('Times','',9);

			$oPdf->SetX(10);
			$oPdf->Cell(20,7,utf8_decode('N°'),1,0,'C',1);

			$oPdf->SetX(30);
			$oPdf->Cell(100,7,'Article',1,0,'C',1);


			$oPdf->SetX(130);
			$oPdf->Cell(40,7,utf8_decode('Unité'),1,0,'C',1);

			$oPdf->SetX(170);
			$oPdf->Cell(25,7,utf8_decode('Prix'),1,0,'C',1);


			$oPdf->Ln();

			$oPdf->SetFillColor(255,255,255);
			//=================================================================
			$oPdf->SetFont('Times','',9);


			$i=0;
			foreach ($_toListe as $oListe) {

				$zBorder = "LR" ; 
				if ($i == 0) {
					$zBorder = "TLR";
				}
				
				if ($i == sizeof($_toListe)-1) {
					$zBorder = "BLR";
				}

				$iPosition = (int)$oPdf->GetY();

				if ($iPosition == 283) {
					$zBorder = "BLR";
				}

			
				if ($iPosition == 290) {
					$zBorder = "TLR";
					$oPdf->SetX(10);
					$oPdf->Cell(20,7,utf8_decode('N°'),1,0,'C',1);

					$oPdf->SetX(30);
					$oPdf->Cell(100,7,'Article',1,0,'C',1);


					$oPdf->SetX(130);
					$oPdf->Cell(40,7,utf8_decode('Unité'),1,0,'C',1);

					$oPdf->SetX(170);
					$oPdf->Cell(25,7,utf8_decode('Prix'),1,0,'C',1);

					$oPdf->Ln();

					$oPdf->SetFillColor(255,255,255);
				}


				$oPdf->SetX(10);
				$oPdf->Cell(20,7,$oListe['fourniture_id'],$zBorder,0,'C',1);

				$oPdf->SetX(30);
				$oPdf->Cell(100,7,nl2br(utf8_decode($oListe['fourniture_article']) . " | " . $oListe['typeFourniture_sigle']),$zBorder,0,'L',1);

				$oPdf->SetX(130);
				$oPdf->Cell(40,7,substr(utf8_decode($oListe['typeUnite_libelle']) , 0, 25),$zBorder,0,'C',1);

				$oPdf->SetX(170);
				$oPdf->Cell(25,7,number_format($oListe['mercuriale_prix'], 2, ',', ' ') . " Ar",$zBorder,0,'C',1);

				$oPdf->Ln();
				
				$i++;
			}

			$oPdf->Ln();

			
			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			$oPdf->Cell(175,7,utf8_decode(' Arrêté le présent tableau au nombre de '. sizeof($_toListe).' articles '),0,0,'L',1);

			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->Cell(175,7,utf8_decode(' Le responsable magasin '),0,0,'R',1);

			if ($_iFlag == 0){
				$oPdf->Output();
			} else {
				$oPdf->Output("mercuriale-".date("mdYHms").".pdf","D");
			}
	}



	public function ListeInventairePvPdf ($_toListe,$_this, $_iFlag) {

		require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

			$oPdf=new FPDF();
			$oPdf->AddPage("P");

			$oPdf->SetAutoPageBreak(270);

			//Fields Name position
			$Y_Fields_Name_position = 20;
			//Table position, under Fie*lds Name
			$Y_Table_Position = 26;

			//First create each Field Name
			//Gray color filling each Field Name box

			$oPdf->SetFillColor(255,255,255);
			//$oPdf->AddFont('trebuc','','trebuc.php');
			//Bold Font for Field Name
			$oPdf->SetFont('Times','',9);
			//$oPdf->SetY($Y_Fields_Name_position);

			$oPdf->SetX(10);
			$oPdf->Cell(200,7,'REPOBLIKAN\'I MADAGASIKARA',0,0,'C',1);
			$oPdf->Ln();

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','I');
			$oPdf->Cell(200,7,'Fitiavana - Tanindrazana - Fandrosoana',0,0,'C',1);

			$oPdf->SetFont('Times','',9);

			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(100,7,utf8_decode('  MINISTERE DES FINANCES ET DU BUDGET'),0,0,'L',1);

			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(70,7,'SECRETARIAT GENERAL',0,0,'C',1);

			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(100,7,'  Direction des Ressources Humaines et de l\'Appui',0,0,'L',1);

			
			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(200,7,'LISTE DES PV',0,0,'C',1);
			$oPdf->Ln();

			$zImageLogoUrl = PATH_ROOT_DIR.'/assets/gcap/images/def3.jpg';

			$oPdf->Image($zImageLogoUrl,10,5,22.5);

			$zImageDrha = PATH_ROOT_DIR.'/assets/gcap/images/def1.jpg';

			$oPdf->Image($zImageDrha,177,5,22.5);

			
			$oPdf->Ln();



			//=================================================================
			$oPdf->SetFont('Times','',9);

			$oPdf->SetX(10);
			$oPdf->Cell(20,7,utf8_decode('N°'),1,0,'C',1);

			$oPdf->SetX(30);
			$oPdf->Cell(70,7,utf8_decode('Réference du pv'),1,0,'C',1);

			$oPdf->SetX(100);
			$oPdf->Cell(40,7,utf8_decode('Date de création'),1,0,'C',1);

			$oPdf->SetX(140);
			$oPdf->Cell(60,7,utf8_decode('Type de fourniture'),1,0,'C',1);

			$oPdf->Ln();

			$oPdf->SetFillColor(255,255,255);
			//=================================================================
			$oPdf->SetFont('Times','',9);


			$i=0;
			foreach ($_toListe as $oListe) {

				$zBorder = "TLRB" ; 
				if ($i == 0) {
					$zBorder = "TLRB";
				}
				
				if ($i == sizeof($_toListe)-1) {
					$zBorder = "BLRT";
				}

				$oPdf->SetX(10);
				$oPdf->Cell(20,7,$i+1,$zBorder,0,'C',1);

				$oPdf->SetX(30);
				$oPdf->Cell(70,7,$oListe['pv_reference'],$zBorder,0,'C',1);

				$oPdf->SetX(100);
				$oPdf->Cell(40,7,$_this->date_en_to_fr($oListe['pv_date'],'-','/'),$zBorder,0,'C',1);

				$oPdf->SetX(140);
				$oPdf->Cell(60,7,utf8_decode($oListe['typeFourniture_libelle']),$zBorder,0,'C',1);

				$oPdf->Ln();
				
				$i++;
			}

			$oPdf->Ln();

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			$zAvecS = "procès-verbal";
			if (sizeof($_toListe)>1){
				$zAvecS = "procès-verbaux";
			}

			$zArticleDe = " de ";
			if ((sizeof($_toGetListeArticlePv)== 1)){
				$zArticleDe = " d' ";
			}

			$oPdf->Cell(200,7,utf8_decode('Liste arrêté au nombre ' . $zArticleDe . $this->int2str(sizeof($_toListe)). ' ('.sizeof($_toListe).') '.$zAvecS.'.'),0,0,'L',1);
			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->Cell(175,7,utf8_decode(' Le responsable magasin '),0,0,'R',1);
			
			

			if ($_iFlag == 0){
				$oPdf->Output();
			} else {
				$oPdf->Output("pv-inventaire-".date("mdYHms").".pdf","D");
			}
	}

	public function PvEditPdf ($_oPv,$_toGetListeArticlePv,$_this, $_iFlag) {

		require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

			$oPdf=new FPDF();
			$oPdf->AddPage("P");

			$oPdf->SetAutoPageBreak(270);

			//Fields Name position
			$Y_Fields_Name_position = 20;
			//Table position, under Fie*lds Name
			$Y_Table_Position = 26;

			//First create each Field Name
			//Gray color filling each Field Name box

			$oPdf->SetFillColor(255,255,255);
			//$oPdf->AddFont('trebuc','','trebuc.php');
			//Bold Font for Field Name
			$oPdf->SetFont('Times','',9);
			//$oPdf->SetY($Y_Fields_Name_position);

			$oPdf->SetX(10);
			$oPdf->Cell(200,7,'REPOBLIKAN\'I MADAGASIKARA',0,0,'C',1);
			$oPdf->Ln();

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','I');
			$oPdf->Cell(200,7,'Fitiavana - Tanindrazana - Fandrosoana',0,0,'C',1);

			$oPdf->SetFont('Times','',9);

			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(100,7,utf8_decode('  MINISTERE DES FINANCES ET DU BUDGET'),0,0,'L',1);

			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(70,7,'SECRETARIAT GENERAL',0,0,'C',1);

			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(100,7,'  Direction des Ressources Humaines et de l\'Appui',0,0,'L',1);

			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',12);
			$oPdf->Cell(200,7,'PV D\'INVENTAIRE PHYSIQUE',0,0,'C',1);

			$oPdf->SetFont('Times','I',9);

			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(200,7,'REFERENCE DU PV : '. $_oPv['pv_reference'],0,0,'C',1);

			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(200,7,'En Date du '. $_this->date_en_to_fr($_oPv['pv_date'],'-','/'),0,0,'C',1);
			$oPdf->Ln();

			$oPdf->SetFont('Times','',9);


			$zImageLogoUrl = PATH_ROOT_DIR.'/assets/gcap/images/def3.jpg';

			$oPdf->Image($zImageLogoUrl,10,5,22.5);

			$zImageDrha = PATH_ROOT_DIR.'/assets/gcap/images/def1.jpg';

			$oPdf->Image($zImageDrha,177,5,22.5);
			
			$oPdf->Ln();

			//=================================================================
			$oPdf->SetFont('Times','',9);

			$oPdf->SetX(10);
			$oPdf->Cell(40,7,utf8_decode('Article'),1,0,'C',1);

			$oPdf->SetX(50);
			$oPdf->Cell(30,7,utf8_decode('Stock initial'),1,0,'C',1);

			$oPdf->SetX(80);
			$oPdf->Cell(30,7,utf8_decode('Stock physique'),1,0,'C',1);

			$oPdf->SetX(110);
			$oPdf->Cell(20,7,utf8_decode('Rebut'),1,0,'C',1);

			$oPdf->SetX(130);
			$oPdf->Cell(30,7,utf8_decode('Stock final'),1,0,'C',1);

			$oPdf->SetX(160);
			$oPdf->Cell(40,7,utf8_decode('Obsérvation'),1,0,'C',1);

			$oPdf->Ln();

			$oPdf->SetFillColor(255,255,255);
			//=================================================================
			$oPdf->SetFont('Times','',9);


			$i=0;
			foreach ($_toGetListeArticlePv as $oListe) {

				$zBorder = "TLRB" ; 
				if ($i == 0) {
					$zBorder = "TLRB";
				}
				
				if ($i == sizeof($_toGetListeArticlePv)-1) {
					$zBorder = "TBLR";
				}

				$oPdf->SetX(10);
				$oPdf->Cell(40,7,utf8_decode($oListe['fourniture_article']),$zBorder,0,'C',1);

				$oPdf->SetX(50);
				$oPdf->Cell(30,7,utf8_decode($oListe['pvArticle_stockInitiale']),$zBorder,0,'C',1);

				$oPdf->SetX(80);
				$oPdf->Cell(30,7,utf8_decode($oListe['pvArticle_StockPhysique']),$zBorder,0,'C',1);

				$oPdf->SetX(110);
				$oPdf->Cell(20,7,utf8_decode($oListe['pvArticle_rebut']),$zBorder,0,'C',1);

				$oPdf->SetX(130);
				$oPdf->Cell(30,7,utf8_decode($oListe['pvArticle_stockFinale']),$zBorder,0,'C',1);

				$oPdf->SetX(160);
				$oPdf->Cell(40,7,utf8_decode($oListe['pvArticle_observation']),$zBorder,0,'C',1);

				$oPdf->Ln();
				
				$i++;
			}

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			$zArticleDe = " de ";
			$zAvecS = "";
			if (sizeof($_toGetListeArticlePv)>1){
				$zAvecS = "s";
			}

			if ((sizeof($_toGetListeArticlePv)== 1)){
				$zArticleDe = " d' ";
			}

			$oPdf->Ln();
			$oPdf->Ln();

			$oPdf->Cell(200,7,utf8_decode('Liste arrêté de PV d\'inventaire physique au nombre ' . $zArticleDe . $this->int2str(sizeof($_toGetListeArticlePv)). ' ('.sizeof($_toGetListeArticlePv).') article'.$zAvecS.'.'),0,0,'L',1);
			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->Cell(175,7,utf8_decode(' Le responsable magasin '),0,0,'R',1);

			if ($_iFlag == 0){
				$oPdf->Output();
			} else {
				$oPdf->Output("pv-inventaire-".date("mdYHms").".pdf","D");
			}
	}


	function int2str($_iNombre)
	{
		$oConvert = explode('.',$_iNombre);
		if (isset($oConvert[1]) && $oConvert[1]!=''){
		return $this->int2str($oConvert[0]).'Dinars'.' et '.$this->int2str($oConvert[1]).'Centimes' ;
		}
		if ($_iNombre<0) return 'moins '.$this->int2str(-$_iNombre);
		if ($_iNombre<17){
		switch ($_iNombre){
		case 0: return 'zero';
		case 1: return 'un';
		case 2: return 'deux';
		case 3: return 'trois';
		case 4: return 'quatre';
		case 5: return 'cinq';
		case 6: return 'six';
		case 7: return 'sept';
		case 8: return 'huit';
		case 9: return 'neuf';
		case 10: return 'dix';
		case 11: return 'onze';
		case 12: return 'douze';
		case 13: return 'treize';
		case 14: return 'quatorze';
		case 15: return 'quinze';
		case 16: return 'seize';
		}
		} else if ($_iNombre<20){
		return 'dix-'.$this->int2str($_iNombre-10);
		} else if ($_iNombre<100){
		if ($_iNombre%10==0){
		switch ($_iNombre){
		case 20: return 'vingt';
		case 30: return 'trente';
		case 40: return 'quarante';
		case 50: return 'cinquante';
		case 60: return 'soixante';
		case 70: return 'soixante-dix';
		case 80: return 'quatre-vingt';
		case 90: return 'quatre-vingt-dix';
		}
		} elseif (substr($_iNombre, -1)==1){
		if( ((int)($_iNombre/10)*10)<70 ){
		return $this->int2str((int)($_iNombre/10)*10).'-et-un';
		} elseif ($_iNombre==71) {
		return 'soixante-et-onze';
		} elseif ($_iNombre==81) {
		return 'quatre-vingt-un';
		} elseif ($_iNombre==91) {
		return 'quatre-vingt-onze';
		}
		} elseif ($_iNombre<70){
		return $this->int2str($_iNombre-$_iNombre%10).'-'.$this->int2str($_iNombre%10);
		} elseif ($_iNombre<80){
		return $this->int2str(60).'-'.$this->int2str($_iNombre%20);
		} else{
		return $this->int2str(80).'-'.$this->int2str($_iNombre%20);
		}
		} else if ($_iNombre==100){
		return 'cent';
		} else if ($_iNombre<200){
		return $this->int2str(100).' '.$this->int2str($_iNombre%100);
		} else if ($_iNombre<1000){
		return $this->int2str((int)($_iNombre/100)).' '.$this->int2str(100).' '.$this->int2str($_iNombre%100);
		} else if ($_iNombre==1000){
		return 'mille';
		} else if ($_iNombre<2000){
		return $this->int2str(1000).' '.$this->int2str($_iNombre%1000).' ';
		} else if ($_iNombre<1000000){
		return $this->int2str((int)($_iNombre/1000)).' '.$this->int2str(1000).' '.$this->int2str($_iNombre%1000);
		}
		else if ($_iNombre==1000000){
		return 'millions';
		}
		else if ($_iNombre<2000000){
		return $this->int2str(1000000).' '.$this->int2str($_iNombre%1000000).' ';
		}
		else if ($_iNombre<1000000000){
		return $this->int2str((int)($_iNombre/1000000)).' '.$this->int2str(1000000).' '.$this->int2str($_iNombre%1000000);
		}
	}



	
}
?>