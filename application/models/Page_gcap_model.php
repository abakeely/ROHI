 <?php
class Page_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		if($this->db->insert('page', $oData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function get_Menu($_iUserId = FALSE, $_iModuleActif, $_iSessionCompte, $_zHashUrl = ''){
		
		$DB1 = $this->load->database('gcap', TRUE);

		if ($_iSessionCompte == "") {
			$_iSessionCompte = 1 ; 
		}

		$zSql= "SELECT page.* FROM module
				INNER JOIN privilege ON privilege_moduleId = module_id
				INNER JOIN compte ON privilege_compteId = compte_id
				INNER JOIN modulepage ON modulePage_moduleId = module_id
				INNER JOIN page ON modulePage_pageId = page_id
				WHERE modulePage_moduleId = $_iModuleActif 
				AND page_actif=1" ;

		if ($_zHashUrl!=''){

			$iParentId = $this->getParentZHashUrl($_zHashUrl);
			if ($iParentId != ''){
				$zSql .= " AND  page_parent = " . $iParentId;
			}
		}
				
		
		$zSql.= " AND ($_iSessionCompte BETWEEN Page_compteMin AND Page_compteMax OR (page_exception = $_iSessionCompte ))
				GROUP BY page_id ORDER BY page_ordre ASC ";

		//echo $zSql ;die;

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}

	public function __get_Menu($_iUserId = FALSE, $_iModuleActif, $_iSessionCompte, $_iMenuId){
		
		$DB1 = $this->load->database('gcap', TRUE);

		if ($_iSessionCompte == "") {
			$_iSessionCompte = 1 ; 
		}

		$zSql= "SELECT page.* FROM module
				INNER JOIN privilege ON privilege_moduleId = module_id
				INNER JOIN compte ON privilege_compteId = compte_id
				INNER JOIN usercompte ON userCompte_compteId = compte_id
				INNER JOIN modulepage ON modulePage_moduleId = module_id
				INNER JOIN page ON modulePage_pageId = page_id
				WHERE page_niveau = 2 AND modulePage_moduleId = $_iModuleActif  
				AND $_iSessionCompte BETWEEN Page_compteMin AND Page_compteMax 
				GROUP BY page_id ORDER BY page_ordre ASC ";

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}

	public function getParentZHashUrl($_zHashUrl){
		
		//$DB1 = $this->load->database('gcap', TRUE);
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 

		$zSql= "SELECT page_parent FROM $zDatabaseGcap.page WHERE page_zHashUrl = '".$_zHashUrl."' LIMIT 0,1";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->row_array();
		$zQuery->free_result();

		$iPageParent = '';

		if (is_array($oRow)){
			$iPageParent = $oRow['page_parent'];
		}
		return $iPageParent;
	}

	public function get_Content($_zHashUrlId){
		
		//$DB1 = $this->load->database('gcap', TRUE);
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 

		$zSql= "SELECT * FROM $zDatabaseGcap.sfao WHERE sfao_zHashUrl = '".$_zHashUrlId."'";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->row_array();
		$zQuery->free_result();

		return $oRow;
	}
	

	public function update($oData,$_zPageId){
		
		global $db;
		$DB1 = $this->load->database('default', TRUE);
		$zDatabaseGcap =  $db['gcap']['database'] ; 
		$DB1->update($zDatabaseGcap.'.sfao', $oData, "sfao_zHashUrl = '$_zPageId'");
	}
}
?>