<?php
class Sequence_model extends CI_Model {

	/**
    * Formatte les variables de type mon?taire
    * @param string $currency montant ? formatter
    * @return string montant formatt?
    * @access public
    */
    public  function seqTicketNextVal() {
		global $db;
		$DB1				=  $this->load->database('sgrh', TRUE);
		$zSqlUpdate			=  "UPDATE sgrh.t_sequence SET sequence_ticket = sequence_ticket+1" ; 	
		$DB1->query($zSqlUpdate);

		$sql= " SELECT MAX(sequence_ticket) sequence_ticket FROM sgrh.t_sequence  ";
		$query = $this->db->query($sql);
		return $query->row_array();
	    
    }
    /**
    * Formatte les variables de type mon?taire
    * @param string $currency montant ? formatter
    * @return string montant formatt?
    * @access public
    */
    public  function seqMatriculeNextVal() {
		/*$oConnection	=	jDb::getConnection() ;

		$zQuery			=	"UPDATE sgrh.sequence SET sequence_matricule_provisoire = sequence_matricule_provisoire+1" ;
		$oResultSet		=	$oConnection->exec($zQuery);

		$zQuery			=	"SELECT MAX(sequence_matricule_provisoire) sequence_matricule_provisoire FROM sgrh.sequence " ;
		$oResultSet		=	$oConnection->query($zQuery);

		$oRecord		=	$oResultSet->fetch() ;

		return $oRecord ;*/
	   
    }


	/**
    * Formatte les variables de type mon?taire
    * @param string $currency montant ? formatter
    * @return string montant formatt?
    * @access public
    */
    public  function seqRapprochementNextVal() {
		/*$oConnection	=	jDb::getConnection() ;

		$zQuery			=	"UPDATE sgrh.sequence SET sequence_rapprochement = sequence_rapprochement+1" ;
		$oResultSet		=	$oConnection->exec($zQuery);

		$zQuery			=	"SELECT MAX(sequence_rapprochement) sequence_rapprochement FROM sgrh.sequence " ;
		$oResultSet		=	$oConnection->query($zQuery);

		$oRecord		=	$oResultSet->fetch() ;
		return $oRecord ;*/
	   
    }
	
}
?>