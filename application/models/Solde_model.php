<?php
class Solde_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	

	 public  function f_500($v_categorie ,$v_indice ,$v_date ) {
		$sql			=	" select a.*,(v_500+v_501+v_502+v_503+v_506)solde_de_base  from rohi.t_bareme a where a.categorie ='".$v_categorie."' and a.indice ='".$v_indice."' LIMIT 1";

		$query			=	$this->db->query($sql); 
		$row			=	$query->row_array();				

		//$solde_de_base	=	$row["v_500"] + $row["v_500"] + $row["v_501"] + $row["v_502"] + $row["v_503"] + $row["v_506"];
		$solde_de_base	=	$row["solde_de_base"] ;
		return $solde_de_base;
	 }

	 public  function  nb_jour_proratra($p_date_debut, $p_date_fin){
		
		$t_dates_debut		=	explode('/',$p_date_debut);
		$t_dates_fin		=	explode('/',$p_date_fin);

		$annee_date_debut	=	$t_dates_debut[2];
		$annee_date_fin		=	$t_dates_fin[2];

		$mois_date_debut	=	$t_dates_debut[1];
		$mois_date_fin		=	$t_dates_fin[1];

		$jour_date_debut	=	$t_dates_debut[0];
		$jour_date_fin		=	$t_dates_fin[0];

		$v_annee			=   $annee_date_fin - $annee_date_debut;

		if ($mois_date_fin < $mois_date_debut) {
			$v_mois			=	$mois_date_fin + 12 - $mois_date_debut;
			$v_annee		=	$v_annee - 1;
		}else{
			$v_mois			=   $mois_date_fin-$mois_date_debut;
		}
		
		
		$nb_iteration		=	($v_annee * 12) + $v_mois;
		$v_nb_jours			=	$nb_iteration * 30;
		$v_jours			=	$jour_date_debut;
		
		
		if ($v_jours > 30) {
			$v_jours = 30;
		}
		
		$v_nb_jours			= $v_nb_jours + (30 - $v_jours + 1);
		$v_jours			= $jour_date_fin;
		
		if ($v_jours > 30) {
			$v_jours		= 30;
		}
		 
		if ($mois_date_fin == "02" ) {
		   if ($v_jours > 27) {
			  $v_jours	= 30;
		   }
		}
		
		$v_nb_jours			= $v_nb_jours - (30 - $v_jours);
		$nb_jour_proratra	= $v_nb_jours;

		return $nb_jour_proratra;
	}

	public  function calcul_proratra($p_date_debut, $p_date_fin,$montant){
		
		$t_dates_debut		=	explode('/',$p_date_debut);
		$t_dates_fin		=	explode('/',$p_date_fin);

		$annee_date_debut	=	$t_dates_debut[2];
		$annee_date_fin		=	$t_dates_fin[2];
		$mois_date_debut	=	$t_dates_debut[1];
		$mois_date_fin		=	$t_dates_fin[1];
		$jour_date_debut	=	$t_dates_debut[0];
		$jour_date_fin		=	$t_dates_fin[0];
		$v_annee			=   $annee_date_fin - $annee_date_debut;
		if ($mois_date_fin < $mois_date_debut) {
			$v_mois			=	$mois_date_fin + 12 - $mois_date_debut;
			$v_annee		=	$v_annee - 1;
		}else{
			$v_mois			=   $mois_date_fin-$mois_date_debut;
		}
		$nb_iteration		=	($v_annee * 12) + $v_mois;
		$prorata			=	$montant*$nb_iteration;
		$v_jours			=	$jour_date_debut;
		if ($v_jours > 30) {
			$v_jours = 30;
		}
		$prorata			=	round($prorata+ (($montant*(30-$v_jours+1))/30)) ;
		$v_jours			= $jour_date_fin;
		if ($v_jours > 30) {
			$v_jours		= 30;
		}
		if ($mois_date_fin == "02" ) {
		   if ($v_jours > 27) {
			  $v_jours	= 30;
		   }
		}

		$prorata			= round($prorata - (($montant*(30-$v_jours))/30)) ;



		return $prorata;
	}

	public  function f_538($v_ministere_code,$p_date_debut, $p_date_fin,$p_solde_de_base){
      
	  /*$p_date_debut			=	"15/01/2018";
	  $p_date_fin			=	"28/02/2018";*/
	  $p_solde_de_base		=	$p_solde_de_base;
	 // $p_solde_de_base		=	$p_solde_de_base-8200;

	 
	  $t_dates_effet		=	explode('/',$p_date_debut);
	  $t_dates_calcul		=	explode('/',$p_date_fin);

      $v_mois_effet			=	$t_dates_effet[1];
      $v_annee_effet		=	$t_dates_effet[2];

	  $v_mois_calcul		=	$t_dates_calcul[1];
      $v_annee_calcul		=	$t_dates_calcul[2];
      
	  $montant				= 0;
      
      if ($v_ministere_code == "21" or $v_ministere_code == "23" ){

        if ( $this->toDateSQL($p_date_debut) < $this->toDateSQL("01/06/2003") ){
          $montant			= 0;
        }else{
          // cas prorata
          if ($v_annee_effet == $v_annee_calcul){
              //mensuelle
              if ($v_mois_calcul == "01" or 
				  $v_mois_calcul == "02" or 
				  $v_mois_calcul == "03" or 
				  $v_mois_calcul == "04" or 
				  $v_mois_calcul == "05" or 
				  $v_mois_calcul == "06" or 
				  $v_mois_calcul == "07" or 
				  $v_mois_calcul == "08" or 
				  $v_mois_calcul == "09" or 
				  $v_mois_calcul == "10" or 
				  $v_mois_calcul == "11" or 
				  $v_mois_calcul == "12" ){

                  if ($v_mois_effet == $v_mois_calcul){
                      $montant			= ($p_solde_de_base * 3) / 5;
					  $nb_jour_prorata	= $this->nb_jour_proratra($p_date_debut,$p_date_fin) ;
					  $montant			= ($nb_jour_prorata/30) * $montant;
                  }else{
                      $montant			= ($p_solde_de_base) * 3 / 5;
                  }
              }
               
				  //trimestrielle
              if  ($v_mois_calcul == "03" or $v_mois_calcul == "09" ){
		
                  if ( $v_mois_calcul == "03" ){
                      if ($v_mois_effet <= "03") {
                          $montant		   = $montant * 3;
                          $nb_jour_prorata = $this->nb_jour_proratra($p_date_debut,$p_date_fin) ;
						  $montant		   = ($nb_jour_prorata/90) * $montant;
                      }
                  }else{
                      if ($v_mois_effet > "06" and $v_mois_effet <= "09"){
                          $montant		   = $montant * 3;
                          $nb_jour_prorata = $this->nb_jour_proratra($p_date_debut,$p_date_fin) ;
						  $montant		   = ($nb_jour_prorata/90) * $montant;
                      }else{
                          $montant		   = $montant * 3;
					  }
				  }
			  }

              //semestrielle
              if  ($v_mois_calcul == "06" or $v_mois_calcul == "12"){

                  if ($v_mois_calcul == "06"){
                      if ($v_mois_effet <= "06"){
                          $montant		   = $montant * 13;
						  $nb_jour_prorata = $this->nb_jour_proratra($p_date_debut,$p_date_fin) ;
						  $montant		   = ($nb_jour_prorata/180) * $montant;
                      }
                  }else{
                      if ($v_mois_effet > "06" ){
                          $montant         = $montant * 13;
                          $nb_jour_prorata = $this->nb_jour_proratra($p_date_debut,$p_date_fin) ;
						  $montant		   = ($nb_jour_prorata/180) * $montant;
                      }else{
                          $montant         = $montant * 13;
					  }
                  }
              }
          //cas taux plein
          }else{
              //mensuelle
              if ($v_mois_calcul == "01" or 
				  $v_mois_calcul == "02" or 
				  $v_mois_calcul == "03" or 
				  $v_mois_calcul == "04" or 
				  $v_mois_calcul == "05" or 
				  $v_mois_calcul == "06" or 
				  $v_mois_calcul == "07" or 
				  $v_mois_calcul == "08" or 
				  $v_mois_calcul == "09" or 
				  $v_mois_calcul == "10" or 
				  $v_mois_calcul == "11" or 
				  $v_mois_calcul == "12" ){

                  $montant = ($p_solde_de_base * 3) / 5;
              }
              //trimestrielle
              if  ($v_mois_calcul == "03" or $v_mois_calcul == "09" ){

                  $montant = $montant * 3;
			  }

              //semestrielle
              if  ($v_mois_calcul == "06" or $v_mois_calcul == "12"){
                  $montant = $montant * 13;
              }
           }
		 }
	   }

	   return $montant;
	}

	public  function f_563( $v_ministere_code,$p_date_debut, $p_date_fin,$p_solde_de_base){
	  
	 /* $p_date_debut		=	"15/10/2018";
	  $p_date_fin			=	"01/01/2018";*/
	  $p_solde_de_base		=	$p_solde_de_base;
	  $p_solde_de_base		=	$p_solde_de_base;
	
	  $t_dates_effet		=	explode('/',$p_date_debut);
	  $t_dates_calcul		=	explode('/',$p_date_fin);

      $v_mois_effet			=	$t_dates_effet[1];
      $v_annee_effet		=	$t_dates_effet[2];

	  $v_mois_calcul		=	$t_dates_calcul[1];
      $v_annee_calcul		=	$t_dates_calcul[2];
      
	  $montant				= 0;
      if ($v_ministere_code == "21" or $v_ministere_code == "23" ){

        if ( $this->toDateSQL($p_date_debut) < $this->toDateSQL("01/06/2003") ){
          $montant			= 0;
        }else{
          // cas prorata
	
          if ($v_annee_effet == $v_annee_calcul){
              //mensuelle
              if ($v_mois_calcul == "01" or 
				  $v_mois_calcul == "02" or 
				  $v_mois_calcul == "03" or 
				  $v_mois_calcul == "04" or 
				  $v_mois_calcul == "05" or 
				  $v_mois_calcul == "06" or 
				  $v_mois_calcul == "07" or 
				  $v_mois_calcul == "08" or 
				  $v_mois_calcul == "09" or 
				  $v_mois_calcul == "10" or 
				  $v_mois_calcul == "11" or 
				  $v_mois_calcul == "12" ){

                  if ($v_mois_effet == $v_mois_calcul){
                      $montant = ($p_solde_de_base * 2) / 5;
                      $montant = $this->nb_jour_proratra($p_date_debut,$p_date_fin) * $montant / 30;
                  }else{
                      $montant = ($p_solde_de_base) * 2 / 5;
                  }
				  $montant = ($p_solde_de_base) * 2 / 5;
              }
               
				  //trimestrielle
              if  ($v_mois_calcul == "03" or $v_mois_calcul == "09" ){
                  if ( $v_mois_calcul == "03" ){
                      if ($v_mois_effet <= 3) {
                          $montant = $montant*4;
						  $nb_jour_prorata = $this->nb_jour_proratra($p_date_debut,$p_date_fin) ;
                          $montant = ($nb_jour_prorata /90)* $montant;
                      }
                  }else{
                      if ($v_mois_effet > "06" and $v_mois_effet <= "09"){
                          $montant = $montant*4;
						  $nb_jour_prorata = $this->nb_jour_proratra($p_date_debut,$p_date_fin) ;
                          $montant = ($nb_jour_prorata /90)* $montant;
                      }else{
                          $montant = $montant*4;
					  }
				  }
			  }

              //semestrielle
              if  ($v_mois_calcul == "06" or $v_mois_calcul == "12"){

                  if ($v_mois_calcul == "06"){
                      if ($v_mois_effet <= "06"){
                          $montant = $montant*10;
						  $nb_jour_prorata = $this->nb_jour_proratra($p_date_debut,$p_date_fin) ;
                          $montant = ($nb_jour_prorata /180)* $montant;
                      }
                  }else{
                      if ($v_mois_effet > "06" ){
                          $montant = $montant*10;
						  $nb_jour_prorata = $this->nb_jour_proratra($p_date_debut,$p_date_fin) ;
                          $montant = ($nb_jour_prorata /180)* $montant;
                      }else{
                          $montant = $montant*10;
					  }
                  }
              }
          //cas taux plein
          }else{
              //mensuelle
			 // echo $v_mois_calcul;
			  //echo $p_solde_de_base;die;
              if ($v_mois_calcul == "01" or 
				  $v_mois_calcul == "02" or 
				  $v_mois_calcul == "03" or 
				  $v_mois_calcul == "04" or 
				  $v_mois_calcul == "05" or 
				  $v_mois_calcul == "06" or 
				  $v_mois_calcul == "07" or 
				  $v_mois_calcul == "08" or 
				  $v_mois_calcul == "09" or 
				  $v_mois_calcul == "10" or 
				  $v_mois_calcul == "11" or 
				  $v_mois_calcul == "12" ){
				
                  $montant = (($p_solde_de_base * 2) / 5);
              }
              //trimestrielle
              if  ($v_mois_calcul == "03" or $v_mois_calcul == "09" ){

                  $montant = (($p_solde_de_base * 2) / 5)*4;
			  }

              //semestrielle
              if  ($v_mois_calcul == "06" or $v_mois_calcul == "12"){
                  $montant = (($p_solde_de_base * 2) / 5)*10;
              }
           }
		 }
	   }

	   return $montant;
	}

	/**
    * Fonction de formatage de date FR en date EN (format mysql)
    *
    * @param string $datefr Date FR
    * @return string $datesql Date UK (ou NULL)
    */
     public function toDateSQL($datefr) {
        $datefr = trim($datefr);
        $d = explode('/',$datefr);
        if ($d[0]<>"") {
            if(strlen($d[2]) > 4) // La date FR est au format jj/mm/aaaa hh:mm:ss
            {
                $tDate = explode (" ", $d[2]) ;
                $datesql = $tDate[0]."-".$d[1]."-".$d[0] ." ".$tDate[1];
            }
            else
            {
                $datesql = $d[2]."-".$d[1]."-".$d[0];
            }
            return $datesql;
        }
        return "NULL";
    }    
    /**
    * Fonction de formatage de date format mysql en date FR
    *
    * @param string $datesql Date FR
    * @return string $datefr Date FR (ou chaîne vide)
    */
    
    public function toDateFR($datesql, $setTime = true) {
        
        $datesql = trim($datesql);
        if (strlen($datesql)>=10 && $datesql!="0000-00-00 00:00:00" && $datesql!="") {
            $date = substr($datesql, 0,10);
            $d = explode('-',$date);
            $datefr = $d[2]."/".$d[1]."/".$d[0];
            
            // time
            if ($setTime)
            {
                if ( strlen ( $datesql ) == 19 ) {
                    $time = substr ( $datesql, 11 ) ;
                    $datefr .= ' ' . $time ;
                }
            }
            
            return $datefr;
        }
        return "";
    }



}
?>
