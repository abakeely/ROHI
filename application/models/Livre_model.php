<?php
class Livre_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_livre($id = FALSE){
		if ($id === FALSE)
		{
			$zSql= "select * from livre order by id , 0, 1";
                        $query = $this->db->query($zSql);
                        $oRow = $query->result_array();
                        $zQuery->free_result(); // The $query result object will no longer be available
                        return $oRow;
		}

		$zQuery = $this->db->get_where('livre', array('id' => $id));
		return current($zQuery->result());
	}
	
	public function get_livre_by_critere($_iThemeId,&$_iNbrTotal = 0){

		global $db;

		$toColumns = array( 
			0 => 'livre.id', 
			1 => 'theme_livre.libele',
			2 => 'cote_livre',
			3 => 'titre_livre',
			4 => 'auteur_livre.libele', 
			5 => 'edition_livre',
			6 => 'lieu_livre.libele',
			7 => 'langue_livre.libele',
		);

		$oRequest = $_REQUEST;

		//$where = $this->get_where($oData);
		$zSql = "select SQL_CALC_FOUND_ROWS *, livre.id as Id,theme_livre.libele as zThemeLivre,cote_livre,titre_livre,auteur_livre.libele as zAuteur,
				edition_livre,lieu_livre.libele as zLieuLivre,langue_livre.libele as zLangue
				from livre 
				INNER JOIN theme_livre ON theme_livre.id = theme_livre_id
				LEFT JOIN auteur_livre ON auteur_livre.id = auteur_livre_id
				LEFT JOIN lieu_livre ON lieu_livre.id = lieu_livre_id
				LEFT JOIN langue_livre ON langue_livre.id = langue_livre_id
		";
		
		
		$zSql .= " where theme_livre_id = " . $_iThemeId ;

		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( theme_livre.libele LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR cote_livre LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR titre_livre LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR auteur_livre.libele LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR edition_livre LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR lieu_livre.libele LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR langue_livre.libele LIKE '%".$oRequest['search']['value']."%' )";
		}

		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			} else {
				$zSql.=" ORDER BY livre.id DESC";
			}


			if (isset($oRequest['start'])){
				$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
			} else {
				$zSql.=" LIMIT 0,10   ";
			}
		} else {
			$zSql.=" ORDER BY livre.id DESC ";
			$zSql.=" LIMIT 0,10   ";
		}

		$zQuery = $this->db->query($zSql);
		$result = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount = $this->db->query($zQueryDataCount) ;
        $toRow = $toDataCount->result_array();
		
		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}

		return $result;
	}
	
	public function search_livre($texte){
		$zSql = " select * from ( ";
		$zSql .= " SELECT livre.* FROM livre join theme_livre on theme_livre.id = livre.theme_livre_id where theme_livre.libele like '%$texte%'";
		$zSql .= " union ";
		$zSql .= " SELECT livre.* FROM livre join auteur_livre on auteur_livre.id = livre.auteur_livre_id where auteur_livre.libele like '%$texte%'";
		$zSql .= " union ";
		$zSql .= " SELECT livre.* FROM livre join lieu_livre on lieu_livre.id = lieu_livre_id where lieu_livre.libele like '%$texte%'";
		$zSql .= " union ";
		
		$zSql .= " SELECT livre.* FROM livre  where titre_livre  like '%$texte%'";
		$zSql .= " union "; 
		$zSql .= " SELECT livre.* FROM livre  where cote_livre  like '%$texte%'";
		$zSql .= " union ";
		
		
		$zSql .= " SELECT livre.* FROM livre join langue_livre on langue_livre.id = langue_livre_id where langue_livre.libele like '%$texte%' ";
		$zSql .= " ) livre_view ";
		$zSql .= " where livre_view.titre_livre like '%$texte%' or livre_view.cote_livre like '%$texte%' or  livre_view.edition_livre like '%$texte%' ";
		
		$zQuery = $this->db->query($zSql);
		$result = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $result;
	}
	
	public function get_list_langue_by_critere($oData){
		$where = $this->get_where($oData);
		$zSql = "select langue_livre_id from livre where ".$where." group by langue_livre_id";
		$zQuery = $this->db->query($zSql);
		$result = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $result;
	}
	
	public function get_list_lieu_by_critere($oData){
		$where = $this->get_where($oData);
		$zSql = "select lieu_livre_id from livre where ".$where." group by lieu_livre_id";
		$zQuery = $this->db->query($zSql);
		$result = $query->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $result;
	}
	
	public function get_list_edition_by_critere($oData){
		$where = $this->get_where($oData);
		$zSql = "select edition_livre from livre where ".$where." group by edition_livre";
		$zQuery = $this->db->query($zSql);
		$result = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $result;
	}
	
	public function get_list_auteur_by_critere($oData){
		$where = $this->get_where($oData);
		$zSql = "select auteur_livre_id from livre where ".$where." group by auteur_livre_id";
		$zQuery = $this->db->query($zSql);
		$result = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $result;
	}
	
	
	
	public function get_list_titre_by_critere($oData){
		$where = $this->get_where($oData);
		$zSql = "select titre_livre from livre where ".$where." group by titre_livre";
		$query = $this->db->query($zSql);
		$result = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $result;
	} 
	
	public function get_list_cote_by_critere($oData){
		$where = $this->get_where($oData);
		$zSql = "select cote_livre from livre where ".$where." group by cote_livre";
		$query = $this->db->query($zSql);
		$result = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $result;
	} 
	
	
	
	private function get_where($oData){
		$where = "1=1 ";
		if(isset($oData['theme_livre_id']))
			$where .= " and theme_livre_id = ".$oData['theme_livre_id'];
		
		if(isset($oData['titre_livre']))
			$where .= " and titre_livre='".$oData['titre_livre']."'";
		
		if(isset($oData['cote_livre']))
			$where .= " and cote_livre='".$oData['cote_livre']."'";
				
			
		if(isset($oData['auteur_livre_id']))
			$where .= " and auteur_livre_id=".$oData['auteur_livre_id'];
		
		if(isset($oData['edition_livre']))
			$where .= " and edition_livre=".$oData['edition_livre'];
		
		if(isset($oData['lieu_livre_id']))
			$where .= " and lieu_livre_id=".$oData['lieu_livre_id'];
			
		if(isset($oData['langue_livre_id']))
			$where .= " and langue_livre_id=".$oData['langue_livre_id'];
		
		if(isset($oData['format_livre']))
			$where .= " and format_livre='".$oData['format_livre']."'";
		
		if(isset($oData['nombre_page_livre']))
			$where .= " and nombre_page_livre=".$oData['nombre_page_livre'];
		
		if(isset($oData['nombre_explaire_livre']))
			$where .= " and nombre_explaire_livre=".$oData['nombre_explaire_livre'];
		
		if(isset($oData['id']))
			$where .= " and id=".$oData['id'];
		
		return $where;
	}
	
	function get_livre_by_cote($_sCote){
		$zQuery = $this->db->get_where('livre', array('cote_livre' => $_sCote));
		return $zQuery->oRow();
	}
	
	function get_livre_by_id($livre_id){
		$zSql = "select lv.id id_livre,t.libele theme,t.id id_theme,lv.cote_livre,lv.titre_livre,aul.libele auteur,lv.edition_livre,llv.libele lieu,lglv.libele langue,lv.npmbre_explaire_livre ";
		$zSql .= " from livre  lv";
		$zSql .= " join  theme_livre t on lv.theme_livre_id = t.id";
		$zSql .= " join auteur_livre aul on lv.auteur_livre_id = aul.id";
		$zSql .= " join lieu_livre llv on lv.lieu_livre_id = llv.id";
		$zSql .= " join langue_livre lglv on lv.langue_livre_id = lglv.id";
		$zSql .= " where lv.id= ".$livre_id;
		$zQuery = $this->db->query($zSql);
        $oRow = $query->result_array();
		return current($oRow) ;
	}
	
}
?>