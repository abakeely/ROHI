<?php 
	
	$zDisabled = "";
	$date_depo = date('d/m/Y');
	
	$nom = $user_edit['nom'];
	$prenom = $user_edit['prenom'];
	$date_naiss = "";
	
	$corps_edit =  0;
	$grade_edit =  0;
	$indice_edit =  0;
	$nbr_enfant = 0;
	$date_prise_service = '';
	
	$matricule = "ECD";
	if(isset($user_edit['matricule'])){
		$matricule = $user_edit['matricule'];
		if(isset($user_edit['matricule']['date_naissance']))
			$date_naiss = $user_edit['matricule']['date_naissance'];

		if(sizeof($user_edit['matricule']['corps_id'])>0)
			$corps_edit = $user_edit['matricule']['corps_id'];
		
		if(sizeof($user_edit['matricule']['grade_id'])>0)
			$grade_edit = $user_edit['matricule']['grade_id'];
		
		if(sizeof($user_edit['matricule']['indice_id'])>0)
			$indice_edit = $user_edit['matricule']['indice_id']; 
		
		if(isset($user_edit['matricule']['nb_enfant']))
			$nbr_enfant = $user_edit['matricule']['nb_enfant'];
		
		if(isset($user_edit['matricule']['date_service']))
			$date_prise_service = $user_edit['matricule']['date_service'];

	}
	
    $date_service = "";
	$sexe = 1;
	$exp = "";
	$empl = "";
	$phone  = "";
	$adress = "";
	$sex = 1;
	$niveau_edit = '';
	$domaine_edit = '';
    $autre_domaine_edit = '';
	$sit_matri = 0;
	$id = "";
	
	$matricule = $user_edit['im'];
	$email = "";
	$fonction_actuel = "";
	$lacalite_service = "";
	$porte = "";
	$poste = "";
        
	$temp1 = array('diplome_name'=>'','diplome_disc'=>'','diplome_etab'=>'','diplome_date'=>'','diplome_pays'=>'');
	$diplome_list = array(0=>$temp1);
	$temp2 = array('date_debut'=>'','date_fin'=>'','par_poste'=>'','par_departement'=>'');
	$parcours_list = array(0=>$temp2);
	
	
	$type_contrat_edit = "";
	$departement_edit = "";
        
	$direction_edit = "";
	$service_edit = "";
	$division_edit = "";
	
	$district_edit = "";
	$region_edit = "";
	$province_edit = "";
	$pays_edit = "";
        
	$date_maj ="";
	$dernier_emp = "";
	$nom_conjoint = "";

	$anciennete_der_emp = "";
	$cin = "";
	$etablissement = "";
	
	$poste_ant = "";
	$image_url = base_url().'assets/upload/default.jpg';
	
	$autre_division = "";
	$autre_service = "";
	$autre_direction = "";
	
	$autre_indice = "";
	$autre_corps = "";
	$autre_grade = "";
	
	$statut_edit = $user_edit['statut'];
	
	
	$soa_edit = 0;
	$soa_list = array();
	if($user_edit['exist_cv']){
		$soa_edit = $candidat->soa;
		$soa_list = $candidat->soa_list;
		$nom = $candidat->nom;
		$prenom = $candidat->prenom;
		$sexe = $candidat->sexe;
		$date_naiss = $candidat->date_naiss;
        
		$phone = $candidat->phone;
		$adress = $candidat->address;
		$sex = $candidat->sexe;
		
		$domaine_edit = $candidat->domaine;
        $autre_domaine_edit = $candidat->autre_domaine;
                
		$sit_matri = $candidat->sit_mat;
		$id = $candidat->id;
		
		
		$porte = $candidat->porte;
		$poste = $candidat->poste;
		$email = $candidat->email;
		$matricule = $candidat->matricule;
                
		$diplome_list = $candidat->diplome_list;
		$parcours_list = $candidat->parcours_list;
		$activite_list = $candidat->activite_list;
		
		$fonction_actuel = $candidat->fonction_actuel;
		$lacalite_service = $candidat->lacalite_service;
		
		$corps_edit = $candidat->corps;
		$grade_edit = $candidat->grade;
		$indice_edit = $candidat->indice;   
		
		$departement_edit = $candidat->departement; 
		$direction_edit =  $candidat->direction; 
		$service_edit =  $candidat->service; 
		$division_edit = $candidat->division; 
		
		$district_edit = $candidat->district_id;
		$region_edit = $candidat->region;
		$province_edit = $candidat->province;
		$pays_edit = $candidat->pays_id;
		
		$date_prise_service= $candidat->date_prise_service;
		
		
		$nbr_enfant = $candidat->nbr_enfant;
		$image_url = $candidat->image_url;

		if($division_edit=="0" || $division_edit=="999999" )
			$autre_division = $candidat->autre_division;
		
		if($service_edit=="0" || $service_edit=="999999")
			$autre_service = $candidat->autre_service;
		
		if($direction_edit=="0" || $direction_edit=="999999")
			$autre_direction = $candidat->autre_direction;
					
	
		if($corps_edit=="0" || $corps_edit=="999999" )
			$autre_corps = $candidat->autre_corps;
		
		if($grade_edit=="0" || $grade_edit=="999999")
			$autre_grade = $candidat->autre_grade;
		
		if($indice_edit=="0" || $indice_edit=="999999")
			$autre_indice = $candidat->autre_indice; 	
		
	}
	
	/* Modif Îles aux trésors */
        
     $statut_edit = ($statut_edit == null)?0:$statut_edit ; 
	 $corps_edit = ($corps_edit == null)?0:$corps_edit ; 
	 $grade_edit = ($grade_edit == null)?0:$grade_edit ; 
	 $indice_edit = ($indice_edit == null)?0:$indice_edit ; 
	 
	 $url_post = base_url(). "cv/create_cv";
	 if(isset($edit_cv))
	 	$url_post = base_url(). "cv/edit_by_resp";
	 
	 if(empty($activite_list)){
	 	$temp3 = array('libele'=>'');
	 	$activite_list = array(0=>$temp3);
	 }
?>
    <style>
        body{
         background: none repeat scroll 0% 0% ghostwhite;
        }

		.form-control {
			display: block;
			width: 100%;
			/* height: 34px; */
			padding: 4px 2px!important;
			font-size: 12px!important;
		}

		td, th {
			padding: 9px;
			font-size: 11px;
		}

		.help-block {width:500px!important;}

		#dataTables-example_paginate {display:none}
		
		}
		
    </style>	
 <div id="content-wrap" style="background-color:#E2DDD7;" > 
  <form class="form-horizontal" role="form" name="cv" id="cv_form" action="<?php echo $url_post?>" method="POST" enctype="multipart/form-data">
  <?php 

  	if(isset($edit_cv)){
  		echo '<input type="hidden" name="candidat_id" id="candidat_id" value="'.$candidat_id_edit.'">';
  	}
	/* disabled */
	if ((string)$corps_edit != '0') 
	{
		echo '<input type="hidden" name="corps" id="corps" value="'.$corps_edit.'">';
	}

	?>

	<?php 

	if ((string)$grade_edit != '0') 
	{
		echo '<input type="hidden" name="grade" id="grade" value="'.$grade_edit.'">';
	}

	?>

	<?php 

	if ((string)$indice_edit != '0') 
	{
		echo '<input type="hidden" name="indice" id="indice" value="'.$indice_edit.'">';
	}

	if ($departement_edit != "" && $departement_edit > 0){

		$zDisabled = '';

		echo '<input type="hidden" name="pays1" id="pays1" value="'.$pays_edit.'"> ';
		echo '<input type="hidden" name="province1" id="province1" value="'.$province_edit['id'].'"> ';
		echo '<input type="hidden" name="region1" id="region1" value="'.$region_edit['id'].'"> ';
		echo '<input type="hidden" name="district1" id="district1" value="'.$district_edit.'"> ';
		echo '<input type="hidden" name="departement1" id="departement1" value="'.$departement_edit.'">  ';
		echo '<input type="hidden" name="direction1" id="direction1" value="'.$direction_edit.'">  ';
		echo '<input type="hidden" name="service1" id="service1" value="'.$service_edit.'">  ';
		echo '<input type="hidden" name="division1" id="division1" value="'.$division_edit.'"> ';
	}

	if(isset($edit_cv)){
  		$zDisabled = '';
  	}

	?>
	<style>
		@media screen and (max-width:999px){
			.div_img_profil{
				max-height: none;
				text-align: center;
			}
		}
		@media screen and (min-width:1000px){
			.div_img_profil{
				max-height: 5em;
			}
			.div_info_profil{
				left: 17px;top: 27px;
			}
		}
		
	</style>
  <input type="hidden" id="date_compare" name="date_compare"  value="">
<!-- IMAGE NOM PRENOM-->
<br><br>
<div class="row div_img_profil">
	<div class="col-md-2"></div>
	<div class="col-md-8">
	    <div class="row">
			<div class="col-md-2" style="background: none;z-index:9"> 
				<img src="<?php echo $image_url;?>" style="width:150px;border-radius: 81px;height:150px;border: 5px solid #DBA988;z-index: 999;"/>
			</div>
			<div class="col-md-10 div_info_profil">
				<div class="row" style="background: #E2DDD7;border-radius: 13px;height: 93px;border: solid #DBA988;">
					<div class="col-md-12 libele_form" style="text-align: left;margin-left: 40px;">
						<label class="control-label"> <?php echo $nom.' '.$prenom ?> </label>
						<br>
						<label class="control-label"> <?php echo $matricule; ?> </label>
						<br>
						<label class="control-label"> <?php echo $poste; ?> </label>
					</div>				
				</div>				
				<div class="row">
					<input type="file"  class="file_upload" name="photo" data-toggle="tooltip" data-original-title= "Safidio sy ampidiro ny sarinao"id="photo"/>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>
<br><br>

<div class="row" style="max-height: 5em;"><br></div>

<div class="row" style="height: 14em;margin-right: -4px;">
	<div class="col-md-6">
		<div class="row separateur separateur1" id="div_info_admin" onclick="showClass('div_info_admin')"><div class="col-md-10" id="icon_div_info_admin"><i class="la la-angle-down"></i>&nbsp;Informations Administratives</div></div>
		
		 <div class="row"><br></div>
		 <!--------------------------------------> 
		<div class="row separateur separateur1" id="div_carriere" onclick="showClass('div_carriere')"><div class="col-md-6" id="icon_div_carriere"><i class="la la-angle-down"></i>&nbsp;Carriere</div></div>	
		<div class="row"><br></div>
		 <!--------------------------------------> 
		<div class="row separateur separateur1" id="div_formation" onclick="showClass('div_formation')"><div class="col-md-6" id="icon_div_formation"><i class="la la-angle-down"></i>&nbsp;Formation</div></div>
		 
		<div class="row"><br></div>
		<!--------------------------------------> 
		<div class="row separateur separateur1" id="div_parcours" onclick="showClass('div_parcours')"><div class="col-md-10" id="icon_div_parcours"><i class="la la-angle-down"></i>&nbsp;Parcours Professionnels</div></div>
		
	</div>
	
	<!--------------------------------- col-md-6 -------------------------->
	<div class="col-md-6">
		<div class="row separateur separateur1" style="margin-bottom: 8px" id="div_etat_civil" onclick="hideClass('div_etat_civil')"><div class="col-md-6" id="icon_div_etat_civil"><i class="la la-angle-up"></i>&nbsp;Etat Civil</div></div>
		<!-- DIV ETAT CIVIL -->
		<div class="row div_etat_civil">
			<div class="col-md-5 labelForm libele_form">
					<label class="control-label">Date de Naissance</label>
			</div>
			<div class="col-md-5">
					<input type="text" id="date_naiss" class="form-control" style="border: 1px solid #354E30 !important;"  placeholder="Date de Naissance" name="date_naiss" value="<?php echo $date_naiss;?>" >
					<span class="la la-calendar txt-danger form-control-feedback" style="top:11px;right:12px;"></span>
			</div>
		</div>
		<div class="row div_etat_civil">
			<div class="col-md-5 libele_form">
				<label class="control-label">Situation Matrimoniale</label>
			</div>
			<div class="col-md-5">
				<select class="form-control" placeholder="Situation Matrimoniale" style="border: 1px solid #354E30 !important;" name="sit_mat" data-toggle="tooltip" data-original-title= "Hamarino ny momba anao : Manambady, na Misaraka, na Mpitovo, na Maty Vady"id="sit_mat" onchange="changeDest()">
					<?php foreach($list_sit_mat as $sit){ 
						$selected = ($sit['id'] != $sit_matri) ? '' : 'selected="selected"';
					?>
						<option  value=<?php echo $sit['id'];?>  <?php echo ' '.$selected; ?>><?php echo $sit['libele'];?> </option>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="row div_etat_civil">
			<div class="col-md-5 labelForm libele_form">
				<label class="control-label">Nombre d&acute;enfants</label>
			</div>
			<div class="col-md-5">
				<input type="text" id="nbr_enfant" style="border: 1px solid #354E30 !important; width:45px;" maxlength="2" class="form-control" name="nbr_enfant" data-toggle="tooltip" data-original-title= " Soraty ny isan’ny ankizy"value="<?php echo $nbr_enfant;?>">
			</div>
		</div>
		<!-- FIN DIV ETAT CIVIL -->
		
		<div class="row separateur separateur1" style="margin-top: 9px" id="div_cordonne" onclick="showClass('div_cordonne')"><div class="col-md-6" id="icon_div_cordonne"><i class="la la-angle-down"></i>&nbsp;Coordonnée</div></div>
	</div>	
</div>
<div class="row" style="margin-right: -4px;">
  <div class="col-md-12">
		<!-- INFO ADMIN -->
		<div class="row div_info_admin"><br></div>
		<div class="row separateur separateur1 div_info_admin" style="background:#DBA988!important"><div class="col-md-12">Informations Administratives</div></div>
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
			<div class="col-md-2"></div>
			<div class="col-md-3 libele_form" style="background:none; ">
					<label class="control-label "> Statut </label>
			</div>
			<div class="col-md-3" style="background:none; ">
					<select class="form-control" style="border: 1px solid #354E30 !important;" placeholder="Status" name="statut" data-placement="top" <?php if ((string)$user_edit['statut'] != '0') echo 'disabled="disabled"' ;?> data-toggle="tooltip" data-original-title="Hamarino ny momba anao na ECD, na ELD, na EMO, na ES, na EFA, na Fonctionnaire"id="statut">
							<?php foreach($list_statut as $d){ 
									$selected = ($d['id'] == $statut_edit)  ? ' selected="selected"' : '';
							?>
									<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
							<?php }?>
					</select>
			</div>
		</div>
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
			<div class="col-md-2"></div>
			<div class="col-md-3 libele_form" style="background:none; ">
					<label class="control-label "> Corps </label>
			</div>
			<div class="col-md-3" style="background:none; ">
							<select id="corps" class="form-control" style="border: 1px solid #354E30 !important;" placeholder="Status" name="corps" <?php if ((string)$corps_edit != '0') echo 'disabled="disabled"' ;?> data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « corps »-nao dia mila misafidy ianao">
							<?php
							foreach($list_corps as $d){ 

									$selected = "";

									if((string)$d['id'] == (string)$corps_edit)
									{
										$selected = ' selected="selected"';
									}

									
							?>
									<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
							<?php }?>
							<option  value="0">AUTRES</option> 
							</select>
			</div>
			<div class="col-md-2">
						<?php if($autre_corps == ''){?>
						<input type="text" name="autre_corps" class="form-control" id="autre_corps" style="display: none"/>
						<?php } else{?>
						  <input type="text" name="autre_corps" class="form-control" id="autre_corps" value="<?php echo $autre_corps;?>"/>
						<?php }?>
			</div>
		</div>
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
			<div class="col-md-2"></div>
			<div class="col-md-3 libele_form" style="background:none; ">
					<label class="control-label "> Grade </label>
			</div>
			<div class="col-md-3" style="background:none; ">
					<select class="form-control" placeholder="Status" style="border: 1px solid #354E30 !important;" name="grade" <?php if ((string)$grade_edit != '0') echo 'disabled="disabled"' ;?> data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « Grade »-nao dia mila misafidy ianao" id="grade">
							<?php 
							
								foreach($list_grade as $d){ 

									$selected = '';

									if((string)$d['id'] == (string)$grade_edit)
									{
										$selected = ' selected="selected"';
									}
							?>
									<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
							<?php }?>
									<option  value="0">AUTRES</option> 
					</select>
			</div>
		</div>
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
			<div class="col-md-2"></div>
			<div class="col-md-3 libele_form" style="background:none; ">
					<label class="control-label "> Indice </label>
			</div>
			<div class="col-md-3" style="background:none; ">
					<select class="form-control" placeholder="Status" style="border: 1px solid #354E30 !important;" name="indice" <?php if ((string)$indice_edit != 0) echo 'disabled="disabled"' ;?>  data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « Indice »-nao nao dia mila misafidy ianao" id="indice">
							<?php 
								foreach($list_indice as $d){ 

									$selected = "";

									if((string)$d['id'] == (string)$indice_edit)
									{
										$selected = ' selected="selected"';
									}

							?>
									<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
							<?php }?>
									<option  value="0">AUTRES</option> 
					</select>
			</div>
		</div>
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
			<div class="col-md-2"></div>
			<div class="col-md-3 labelForm libele_form" style="background:none;">
					<label class="control-label">Date de prise de service</label>
			</div>
			<div class="col-md-3" id="date_prise_service_div" style="background:none; ">
					<input type="text" id="date_prise_service" style="border: 1px solid #354E30 !important;" class="form-control" placeholder="Date de prise de service" data-placement="top" data-toggle="tooltip" data-original-title="Ampidiro ny  andro/volana/taona  nidiranao niasa teto amin’ny Ministeran’ny Fitantanambola sy ny Teti-bola" name="date_prise_service" value="<?php echo $date_prise_service;?>"/>
					<span class="la la-calendar txt-danger form-control-feedback" style="top:11px;right:12px;"></span>
			</div>
		</div>
		
		<div class="row div_info_admin"><br></div>
			<div class="row div_info_admin">
				<div class="col-md-2"></div>
				<div class="col-md-3 libele_form" style="background:none; ">
					<label class="control-label">Fonction Actuelle <b><font color='#DBA988'> * </font></b> </label>
				</div>
			<div class="col-md-3" style="background:none; ">
				<input type="text" class="form-control" style="border: 1px solid #354E30 !important;" placeholder="Fonction actuelle" name="poste" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny asa amandrarahanao"  id="poste" value="<?php echo $poste; ?>">
			</div>
		</div>
		
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
			<div class="col-md-2"></div>
			<div class="col-md-3 libele_form" style="background:none; ">
				<label class="control-label">Domaines de Compétences <b><font color='#DBA988'> * </font></b>
				</label>
			</div>
			<div class="col-md-3" style="background:none; ">
				<textarea name="domaine" id="domaine" class="form-control" style="border: 1px solid #354E30 !important;" rows=5  data-toggle="tooltip" data-original-title= "Soraty ireo karazana traikefa hafa voafehinao"><?php echo $domaine_edit;?></textarea>
			</div>
		</div>
		
		<!--<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
		<div class="col-md-2"></div>
			<div class="col-md-3 libele_form" style="background:none; ">
				<label class="control-label">Autres 
				</label>
			</div>
			<div class="col-md-3" style="background:none; ">
				<textarea name="autre_domaine" id="autre_domaine"  style="border: 1px solid #354E30 !important;" class="form-control" rows=5  data-toggle="tooltip" data-original-title= "Soraty  raha manana traikela lanampiny ianao"><?php echo $autre_domaine_edit;?></textarea>
			</div>
		</div>-->
		
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
				<div class="col-md-2"></div>
					<div class="col-md-3 libele_form" style="background:none; ">
						<label class="control-label "> Activit&eacute; (Etudier les dossiers entrants)<b><font color='#DBA988'> * </font></b> </label>
					</div>
			<div class="col-md-5" >
				<table id="table_activite">
				<?php $i=0; foreach($activite_list as $activite){$i++;?>
				<tr id="row_activite_<?php echo $i;?>">
					<?php if($i!=1) { echo "<br>"; }?>
						<td style="padding:2px;width:90%"><input type="text" class="form-control" style="border: 1px solid #354E30 !important;" placeholder="Activit&eacute;" name="activite[]" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny asa amandrarahanao"  value="<?php echo $activite['libele'];?>"></td>
				    <?php if($i!=1){?> 
                    <td><button class="form-control btn_close" type="button" onclick="<?php echo 'deleteActivite('.$i.')';?>"><i class="la la-minus-circle"></i></button>   
                    <?php }?></td>
				</tr>
				<?php }?>
				</table>
			</div>
		</div>
		
		<div class="row div_info_admin">
			<div class="col-md-5"></div>
			<div class="col-md-2">
				<button style="background: none repeat scroll 0px 0px #98B6B4;color:white; border: 1px none !important;" type="button" class="form-control" id="ajoutActivite" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy ny asa efa nosahaninao hatramin’izay" >Ajouter une activit&eacute;</button>
			</div>
			<div class="col-md-3"></div>
		</div> 
		
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
				<div class="col-md-2"></div>
					<div class="col-md-3 libele_form" style="background:none; ">
						<label class="control-label ">Loisirs et Activitées Annexes <b><font color='#DBA988'> * </font></b> </label>
					</div>
			<div class="col-md-5" >
				<table id="table_activite">
				<?php $i=0; foreach($activite_list as $activite){$i++;?>
				<tr id="row_activite_<?php echo $i;?>">
					<?php if($i!=1) { echo "<br>"; }?>
						<td style="padding:2px;width:90%"><input type="text" class="form-control" style="border: 1px solid #354E30 !important;" placeholder="Activit&eacute;" name="activite[]" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny asa amandrarahanao"  value="<?php echo $activite['libele'];?>"></td>
				    <?php if($i!=1){?> 
                    <td><button class="form-control btn_close" type="button" onclick="<?php echo 'deleteActivite('.$i.')';?>"><i class="la la-minus-circle"></i></button>   
                    <?php }?></td>
				</tr>
				<?php }?>
				</table>
			</div>
		</div>
		
		<div class="row div_info_admin">
			<div class="col-md-5"></div>
			<div class="col-md-2">
				<button style="background: none repeat scroll 0px 0px #98B6B4;color:white; border: 1px none !important;" type="button" class="form-control" id="ajoutActivite" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy ny asa efa nosahaninao hatramin’izay" >Ajouter activit&eacute; Annexes</button>
			</div>
			<div class="col-md-3"></div>
		</div> 
		
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
		  <div class="col-md-2"></div>
		   <div class="col-md-3 libele_form" style="background:none; ">
			  <label class="control-label "> Pays </label><font color="#DBA988"> *</font></b>
		   </div>
			  <div class="col-md-3" style="background:none; ">
				   <select <?php echo $zDisabled; ?> class="form-control" style="border: 1px solid #354E30 !important;" placeholder="pays" name="pays" data-placement="top" data-toggle="tooltip" data-original-title="Safidio ny anarany ilay firenena nahazoanao ilay mari-pahaizana"id="pays">
						<?php foreach($list_pays as $d){ 
							$selected = ($d['id'] == $pays_edit)  ? ' selected="selected"' : '';
						?>
						<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
						<?php }?>
				   </select>
			  </div>
		</div>
		
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
			<div class="col-md-2"></div>
			<div class="col-md-3 libele_form" style="background:none; ">
				<label class="control-label ">Province </label><font color="#DBA988"> *</font></b>
			</div>
			<div class="col-md-3" style="background:none; ">
				<select <?php echo $zDisabled; ?> class="form-control"  style="border: 1px solid #354E30 !important;"placeholder="province" name="province" data-toggle="tooltip" data-original-title="Safidio ny Faritany misy anao"  id="province">
					<?php foreach($list_province as $province){ ?>
						<?php if($user_edit['exist_cv'] && $province_edit==$province['id']){ ?>      
							<option  value=<?php echo $province['id'];?> selected="selected"><?php echo $province['libele'];?></option>
						<?php } else {?>
							<option  value=<?php echo $province['id'];?>><?php echo $province['libele'];?></option>
						<?php } ?>
					<?php } ?>
				</select>
			</div>
		</div>
		
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
			<div class="col-md-2"></div>
			<div class="col-md-3 libele_form" style="background:none; ">
					<label class="control-label "> R&eacute;gion </label><font color="#DBA988"> *</font></b>
			</div>
			<div class="col-md-3" style="background:none; ">
					<select <?php echo $zDisabled; ?> class="form-control" style="border: 1px solid #354E30 !important;" placeholder="Region" name="region"  data-toggle="tooltip" data-original-title="Safidio ny Faritra misy anao" id="region" <?php /*if($user_edit['role']=="chef")echo 'disabled="disabled"';*/?>>
					   <?php foreach($list_region as $region){ ?> 
							<?php if($user_edit['exist_cv'] && $region['id'] == $region_edit){ ?>   
								<option  value=<?php echo $region['id'];?> selected="selected"><?php echo $region['libele'];?></option>
							<?php } else{ ?> 
								<option  value=<?php echo $region['id'];?>><?php echo $region['libele'];?></option>
							<?php } ?>
					   <?php } ?>
					</select>
			</div>
		</div>
		
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
			<div class="col-md-2"></div>
			<div class="col-md-3 libele_form" style="background:none; ">
				<label class="control-label "> District </label><font color="#DBA988"> *</font></b>
			</div>
			<div class="col-md-3" style="background:none; ">
				<select <?php echo $zDisabled; ?> class="form-control" style="border: 1px solid #354E30 !important;" placeholder="district" name="district" data-placement="top" data-toggle="tooltip" data-original-title="safidio ny Distrika misy anao" id="district">
					<option  value="0">-------</option> 
					<?php foreach($list_district as $d){ 
							$selected = ($d->id == $district_edit)  ? ' selected="selected"' : '';
					?>
							<option  value=<?php echo $d->id;?> <?php echo $selected;?>><?php echo $d->libele;?></option>
					<?php }?>
				</select>
			</div>
		</div>
		
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
			<div class="col-md-2"></div>
			<div class="col-md-3 libele_form" style="background:none; ">
				<label class="control-label">D&eacute;partement  </label><b><font color="#DBA988"> * </font></b>
			</div>
			<div class="col-md-3" style="background:none; ">
				<select <?php echo $zDisabled; ?> class="form-control" style="border: 1px solid #354E30 !important;" placeholder="Departement" name="departement" data-toggle="tooltip" data-original-title= "Safidio ny Departemanta na sampan-draharaha misy anao" id="departement"<?php if($user_edit['role']=="chef");?>>
					<option  value="0">-------</option> 
						<?php foreach($list_departement as $d){ 
						$selected = ($d['id'] == $departement_edit)  ? ' selected="selected"' : '';
					?>
						<option  value=<?php echo $d['id'];?> <?php echo $selected;?> ><?php echo $d['libele'];?></option>
					<?php }?>
				</select>
			</div>
		</div>
		
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
			<div class="col-md-2"></div>
			<div class="col-md-3 libele_form" style="background:none; ">
				<label class="control-label "> Direction </label><b></b>
			</div>
			<div class="col-md-3" style="background:none; ">
				 <select <?php echo $zDisabled; ?> class="form-control" style="border: 1px solid #354E30 !important;" placeholder="Direction" name="direction" data-toggle="tooltip" data-original-title= "Safidio ny Foibem-pitondrana misy anao " id="direction" <?php if($user_edit['role']=="chef");?>>
					<option  value="0">-------</option> 
						   <?php foreach($list_direction as $d){ 
						$selected = ($d['id'] == $direction_edit)  ? ' selected="selected"' : '';
					?>
						<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
					<?php }?> 
				</select>
			</div>
		</div>
		
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
			<div class="col-md-2"></div>
			<div class="col-md-3 libele_form" style="background:none; ">
				<label class="control-label "> Service </label></b>
			</div>
			<div class="col-md-3" style="background:none; ">
				<select <?php echo $zDisabled; ?> class="form-control" style="border: 1px solid #354E30 !important;" placeholder="Service" name="service" data-toggle="tooltip" data-original-title= "Safidio  ny sampan-draharaha  misy anao " id="service" <?php if($user_edit['role']=="chef");?>>
					<option  value="0">-------</option> 
										<?php foreach($list_service as $d){ 
						$selected = ($d['id'] == $service_edit)  ? ' selected="selected"' : '';
					?>
						<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
					<?php }?>
				</select>
			</div>
		</div>
		
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin"><br></div>
		<?php if (sizeof($soa_list)> 0){ ?>
			<div class="row div_info_admin">
				<div class="col-md-2"></div>
				<div class="col-md-3 libele_form" style="background:none; ">
					<label class="control-label "> SOA </label>
				</div>
				<div class="col-md-3" id="div_soa" style="background:none; ">
					<?php foreach($soa_list as $d){ ?>
						<div class="row">
						 <?php echo $d['libele'];?> 
						</div>		
					<?php } ?> 		
				</div>
				<div class="col-md-2">
					<?php if($autre_service == ''){?>
					<input type="text" name="autre_service" class="form-control" style="border: 1px solid #354E30 !important;" id="autre_service" style="display: none"/>
					<?php } else{?>
					  <input type="text" name="autre_service" class="form-control" id="autre_service" value="<?php echo $autre_service;?>"/>
					<?php }?>
				</div>
			</div>  
			<?php } ?>
			
		<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
			<div class="col-md-2"></div>
			<div class="col-md-3 libele_form" style="background:none; ">
					<label class="control-label "> Division </label>
			</div>
			<div class="col-md-3" style="background:none; ">
				<select <?php echo $zDisabled; ?> class="form-control" style="border: 1px solid #354E30 !important;" placeholder="Division" name="division" data-toggle="tooltip" data-original-title="Safidio ny Division misy anao" id="division">
						<option  value="999999">-------</option> 
						<?php foreach($list_division as $d){ 
								$selected = ($d['id'] == $division_edit)  ? ' selected="selected"' : '';
						?>
								<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
						<?php }?>
						<option  value="0">AUTRES</option>        
				</select>
			</div>
			<div class="col-md-2">
				<?php if($autre_division == ''){?>
				<input type="text" name="autre_division" class="form-control" style="border: 1px solid #354E30 !important;" id="autre_division" style="display: none"/>
				<?php } else{?>
				  <input type="text" name="autre_division" class="form-control" id="autre_division" value="<?php echo $autre_division;?>"/>
				<?php }?>
			</div>
			<div class="col-md-2"></div>
		 </div>
		 
		 <div class="row div_info_admin"><br></div>
			<div class="row div_info_admin">
				<div class="col-md-2"></div>
				<div class="col-md-3 libele_form" style="background:none; ">
					<label class="control-label ">Porte <b><font color='#DBA988'> * </font></b> </label>
				</div>
			<div class="col-md-3" style="background:none; ">
				<input type="text" class="form-control" placeholder="Porte" style="border: 1px solid #354E30 !important;" name="porte" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny varavarana ny toeram-piasanao"  id="porte" value="<?php echo $porte; ?>">
			</div>
		</div>
		
		
		<div class="row div_info_admin"><br></div>
			<div class="row div_info_admin">
				<div class="col-md-2"></div>
				<div class="col-md-3 libele_form" style="background:none; ">
					<label class="control-label ">Localité de service cas de mise a dispo <b><font color='#DBA988'> * </font></b> </label>
				</div>
					<input type="checkbox"> Non
					<input type="checkbox"> Departemnt MFB
					<input type="checkbox"> Autre que MFB 
		    </div>
		
		<!--<div class="row div_info_admin"><br></div>
		<div class="row div_info_admin">
				<div class="col-md-2"></div>
					<div class="col-md-3 libele_form" style="background:none; ">
						<label class="control-label ">Localité de service cas de mise a dispo <b><font color='#DBA988'> * </font></b> </label>
					</div>
			<table class="notationCritere" style="width:100%">
				<tr>
					<td style="width:100%;vertical-align:top;" colspan="2"><p class="check" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left;background: rgba(255, 255, 255, 0);;background: rgba(255, 255, 255, 0);"><label>Localité de service</label>
					
					</p>
					Oui : <input type="radio" style="width:14px;height:14px;" class="radioCarte"   value="1">
					Non : <input type="radio" style="width:14px;height:14px;" class="radioCarte"  checked="checked" value="0">
					
					</td>
				</tr>
			</table>
		</div>
		</div>-->
		
		
		
		
		
		
		
		
		
		
		
		
		 <div class="row div_info_admin"><br></div>
			<div class="row div_info_admin">
				<div class="col-md-2"></div>
				<div class="col-md-3 libele_form" style="background:none; ">
					<label class="control-label ">Lieu de travail <b><font color='#DBA988'> * </font></b> </label>
				</div>
			<div class="col-md-3" style="background:none; ">
				<input type="text" class="form-control" placeholder="Lieu de travail" style="border: 1px solid #354E30 !important;" name="lacalite_service" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny toeram-piasanao"  id="lacalite_service" value="<?php echo $lacalite_service; ?>">
			</div>
		</div>
		<!-- FIN INFO ADMIN -->
		
		<!-- DEBUR CARRIERE -->
		<div class="row div_carriere"><br></div>
		<div class="row separateur separateur1 div_carriere" style="background:#DBA988!important"><div class="col-md-12">Carrière</div></div>
		<div class="row div_carriere"><br></div>
		<div class="row div_carriere">
		<?php include "avance.page.php" ;?>
		<div class="row message"></div>
		<?php include "carriere.php"    ;?>
		<br>
		</div>
		<!-- FIN CARRIERE -->
		
		<!-- INFO FORMATION -->
		<div class="row div_formation"><br></div>
		<div class="row separateur separateur1 div_formation" style="background:#DBA988!important"><div class="col-md-12">Formation</div></div>
		<div class="row div_formation"><br></div>
		<div class="row div_formation">
			<table class="tableau">
				<tbody>
					<tr>
						<td>
							<input type="hidden" value="<?php echo sizeof($diplome_list)?>" id="size_diplome"/>   
							<label style="font-size: 14px;" class="control-label libele_form">Dipl&ocirc;mes Obtenus (Commencer par le plus r&eacute;cent) <b><font color='#DBA988'> * </font></b> </label>   
						</td>
					</tr>
					</tbody>
			</table>
			<table class="tableau" id="tableDiplome">
				<tbody>
					<?php $i=0; foreach($diplome_list as $diplome){$i++;?>
					<tr id="diplome_row_<?php echo $i;?>">
						<td><input class="form-control" placeholder="Diplomes" style="border: 1px solid #354E30 !important;" type="text" name="diplome_name[]" value="<?php echo $diplome['diplome_name'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></td>
						<td><input class="form-control" placeholder="Fili&egrave;re" style="border: 1px solid #354E30 !important;" type="text" name="diplome_discipline[]" value="<?php echo $diplome['diplome_disc'];?>" data-toggle="tooltip" data-original-title= "Soraty ny sampam-pianarana"/></td>
						<td><input class="form-control input_date"  maxLength="4" style="border: 1px solid #354E30 !important;" id="diplome_date_<?php echo $i;?>" onChange="testDate('<?php echo $i;?>')" placeholder="Ann&eacute;e d&grave;obtention" type="text" name="diplome_date[]" value="<?php echo $diplome['diplome_date'];?>" data-toggle="tooltip" data-original-title= "Soraty ny taona nahazoanao ilay mari-pahaizana"/></td>
						<td><input class="form-control " placeholder="Etablissement " style="border: 1px solid #354E30 !important;" type="text" name="diplome_etablissement[]" value="<?php echo $diplome['diplome_etab'];?>" data-toggle="tooltip" data-original-title= "Soraty ny toeram-pianarana nahazoanao ilay mari-pahaizana"/></td>
						<td><input class="form-control" placeholder="Pays" type="text" style="border: 1px solid #354E30 !important;"name="diplome_pays[]" value="<?php echo $diplome['diplome_pays'];?>" data-toggle="tooltip" data-original-title= "Soraty ny anaran'ilay firenena nahazoanao ilay mari-pahaizana"/></td>

						<?php if($i!=1){ ?>
						<td style="width:15px!important"><button class="btn_close" type="button" onclick="<?php echo 'deleteDiplome('.$i.')';?>"><i class="la la-minus-circle"></i></button></td>
						<?php } ?>
					</tr>
					<?php }?>
					</tbody>
			</table>
			
		</div>
		<div class="row div_formation"><br></div>
		<div class="row div_formation">
			<div class="col-md-9"></div>
			<div class="col-md-2">
				<button style="background: none repeat scroll 0px 0px #98B6B4;color:white; border: 1px none !important;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="ajoutDiplome"> Ajouter un Dipl&ocirc;me</button>
			</div>
			<div class="col-md-1"></div>
		</div>	
		
		<br>
		
		<div class="row div_formation">
			<table class="tableau">
				<tbody>
					<tr>
						<td>
							<input type="hidden" value="<?php echo sizeof($diplome_list)?>" id="size_diplome"/>   
							<label style="font-size: 14px;" class="control-label libele_form">Stage et Formation de courte durée <b><font color='#DBA988'> * </font></b> </label>   
						</td>
					</tr>
					</tbody>
			</table>
			<table class="tableau" id="tableDiplome">
				<tbody>
					<?php $i=0; foreach($diplome_list as $diplome){$i++;?>
					<tr id="diplome_row_<?php echo $i;?>">
						<td><input class="form-control" placeholder="Diplomes" style="border: 1px solid #354E30 !important;" type="text" name="diplome_name[]" value="<?php echo $diplome['diplome_name'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></td>
						<td><input class="form-control" placeholder="Fili&egrave;re" style="border: 1px solid #354E30 !important;" type="text" name="diplome_discipline[]" value="<?php echo $diplome['diplome_disc'];?>" data-toggle="tooltip" data-original-title= "Soraty ny sampam-pianarana"/></td>
						<td><input class="form-control input_date"  maxLength="4" style="border: 1px solid #354E30 !important;" id="diplome_date_<?php echo $i;?>" onChange="testDate('<?php echo $i;?>')" placeholder="Ann&eacute;e d&grave;obtention" type="text" name="diplome_date[]" value="<?php echo $diplome['diplome_date'];?>" data-toggle="tooltip" data-original-title= "Soraty ny taona nahazoanao ilay mari-pahaizana"/></td>
						<td><input class="form-control " placeholder="Etablissement " style="border: 1px solid #354E30 !important;" type="text" name="diplome_etablissement[]" value="<?php echo $diplome['diplome_etab'];?>" data-toggle="tooltip" data-original-title= "Soraty ny toeram-pianarana nahazoanao ilay mari-pahaizana"/></td>
						<td><input class="form-control" placeholder="Pays" type="text" style="border: 1px solid #354E30 !important;"name="diplome_pays[]" value="<?php echo $diplome['diplome_pays'];?>" data-toggle="tooltip" data-original-title= "Soraty ny anaran'ilay firenena nahazoanao ilay mari-pahaizana"/></td>

						<?php if($i!=1){ ?>
						<td style="width:15px!important"><button class="btn_close" type="button" onclick="<?php echo 'deleteDiplome('.$i.')';?>"><i class="la la-minus-circle"></i></button></td>
						<?php } ?>
					</tr>
					<?php }?>
					</tbody>
			</table>
		</div>
		<div class="row div_formation"><br></div>
		<div class="row div_formation">
			<div class="col-md-9"></div>
			<div class="col-md-2">
				<button style="background: none repeat scroll 0px 0px #98B6B4;color:white; border: 1px none !important;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="ajoutDiplome"> Ajouter stage</button>
			</div>
			<div class="col-md-1"></div>
		</div>
		
		<!-- FIN INFO FORMATION -->	
		<!-- DIV PARCOURS -->
		<div class="row div_parcours"><br></div>
		<div class="row separateur separateur1 div_parcours" style="background:#DBA988!important"><div class="col-md-12">Parcours Professionnels</div></div>
		<div class="row div_parcours"><br></div>		
		<div class="row div_parcours">
			<div class="col-md-1">
			</div>
			<table class="tableau">
				<tbody>
					<tr>
						<td>
							<input type="hidden" value="<?php echo sizeof($parcours_list)?>" id="size_parcours"/>     
							<label style="font-size: 14px;" class="control-label libele_form">Parcours (Commencer par votre poste actuel) <b><font color='#DBA988'> * </font></b> </label>   
						</td>
					</tr>
					</tbody>
			</table>
		</div>
		<div class="row div_parcours">
			<table class="tableau"  id="tableParcours">
				<tbody>
					<?php $i=0; foreach($parcours_list as $parcours){$i++;?>
					<tr id="parcours_row_<?php echo $i;?>">
						<td>&nbsp;</td>
						<td><input class="form-control input_date"maxLength="4" style="border: 1px solid #354E30 !important;" id="date_debut_<?php echo $i;?>" onChange="testDate('<?php echo $i;?>')" placeholder="Ann&eacute;e / D&eacute;but" type="text" name="date_debut[]" value="<?php echo $parcours['date_debut'];?>" data-toggle="tooltip" data-original-title= "Soraty ny taona nanombohanao niasa tao amin'ny sampan-draharaha"/></td>

						<td><input class="form-control input_date" maxLength="4" style="border: 1px solid #354E30 !important;" id="date_fin_<?php echo $i;?>" onChange="testDate('<?php echo $i;?>')" placeholder="Ann&eacute;e / Fin" type="text" name="date_fin[]" value="<?php echo $parcours['date_fin'];?>" data-toggle="tooltip" data-original-title= "Soraty ny taona farany niasanao tao amin'ny sampandraharaha"/></td>

						<td><input class="form-control" placeholder="Poste" style="border: 1px solid #354E30 !important;" type="text" name="par_poste[]" value="<?php echo $parcours['par_poste'];?>" data-toggle="tooltip" data-original-title= "Soraty ny asa na andraikitra nosahaninao"/></td>

						<td><input class="form-control" placeholder="Departement" style="border: 1px solid #354E30 !important;" type="text" name="par_departement[]" value="<?php echo $parcours['par_departement'];?>" data-toggle="tooltip" data-original-title= "Soraty ny Departemanta na sampan-draharaha  misy anao"/></td>

						<?php if($i!=1){ ?>
						<td style="width:15px!important;"><button class="btn_close" style="border: 1px solid #354E30 !important;" type="button" onclick="<?php echo 'deleteParcours('.$i.')';?>"><i class="la la-minus-circle"></i></button></td>
						<?php } ?>
					</tr>
					<?php }?>
					</tbody>
			</table>
		</div>

		<div class="row div_parcours">
			<div class="col-md-9"></div>
			<div class="col-md-2">
					<button style="background: none repeat scroll 0px 0px #98B6B4;color:white; border: 1px none !important;" type="button" class="form-control" id="ajoutParcours" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy ny asa efa nosahaninao hatramin’izay" >Ajouter un parcours</button>
				</div>
			<div class="col-md-1"></div>
		</div> 
		<!-- FIN DIV PARCOURS -->
		
		<!-- DIV CORDONNE -->
		<div class="row div_cordonne"><br></div>
		<div class="row separateur separateur1 div_cordonne" style="background:#DBA988!important"><div class="col-md-12">Coordonnée</div></div>
		<div class="row div_cordonne"><br></div>
		<div class="row  div_cordonne">
			<div class="col-md-2"></div>
			<div class="col-md-3 libele_form" style="background:none; ">
				<label class="control-label">Adresse Actuelle <b><font color='#DBA988'> * </font></b> </label>
			</div>
			<div class="col-md-3" style="background:none; ">
				<input type="text" id="addresse" class="form-control" style="border: 1px solid #354E30 !important;" placeholder="Adresse" name="addresse" data-toggle="tooltip" data-original-title= "Soraty ny toeram-ponenao ankehitriny" id="sit_mat"value="<?php echo $adress;?>">
			</div>
			
		</div>
		<div class="row div_cordonne"><br></div>
		<div class="row div_cordonne">
			<div class="col-md-2"></div>
			<div class="col-md-3 libele_form" style="background:none; ">
				<label class="control-label">T&eacute;l&eacute;phone <b><font color='#DBA988'> * </font></b> </label>
			</div>
			<div class="col-md-3" style="background:none; ">
				<input type="text" id="phone" class="form-control" style="border: 1px solid #354E30 !important;" placeholder="T&eacute;l&eacute;phone" name="phone" data-toggle="tooltip" data-original-title= "Ampidiro ny laharan'ny finday anao (iray ihany)" value="<?PHP ECHO $phone;?>">
			</div>
		</div>
		
		<div class="row div_cordonne"><br></div>
		<div class="row div_cordonne">
			<div class="col-md-2"></div>
			<div class="col-md-3 libele_form" style="background:none; ">
				<label class="control-label">Adresse El&eacute;ctronique  </label>
			</div>
			<div class="col-md-3" style="background:none; ">
				<input type="text" id="email" class="form-control" style="border: 1px solid #354E30 !important;" placeholder="E-mail" name="email" data-toggle="tooltip" data-original-title= "Ampidiro ny mailaka" value="<?php echo $email;?>">
			</div>
		</div>
		<!-- DIV CORDONNE -->
	</div>
</div>
<br>
<div class="row" style="margin-right: -4px;">
	<div class="col-md-6"></div>
	
	<div class="col-md-2">
			<input type='submit' class="btn btn-primary form-control " style="background-color:#354E30; border: 1px none !important" data-toggle="tooltip" data-original-title=" Tsindrio rehefa feno daholo ny momba anao rehetra " value='Enregistrer' />	
	</div>
	
<?php if($user_edit['exist_cv']){ ?>
	<div class="col-md-2">
		<a href="#" class="btn btn-primary form-control " style="background-color:#354E30; border: 1px none !important; ;padding: 8px 0px !important;" data-toggle="tooltip" data-original-title=" Tsindrio dia afaka manonta ny mari-pankasitrahanao"  onclick="certificat(<?php if(isset($edit_cv)) echo $candidat->id;?>)"> <font style="font-size: 1em;"> Imprimer attestation</font></a>
	</div>
<?php } ?>
<?php if($user_edit['exist_cv']){ ?>
	<div class="col-md-2">
		<a href="<?php echo base_url();?>cv/fpdf_cv/<?php if(isset($edit_cv)) echo $candidat->id;?>" class="btn btn-primary form-control " style="background-color:#354E30; border: 1px none !important; ;padding: 8px 0px !important;" data-toggle="tooltip" data-original-title=" Tsindrio dia afaka manonta ny CV'nao ianao" target="_blank" > <font style="font-size: 1em;"> Imprimer CV </font></a>
	</div>
<?php } ?>
</div>
</form> 
<br><br>
<div id="certificat"></div>
</div>
  <style>
	div.separateur {
		background: #98B6B4!important;
		/*width:100%;*/
		height:26px;
		padding: 4px;
		border-radius: 5px;
	}
	
	bouton {
		background: #98B6B4!important;
		/*width:100%;*/
		height:26px;
		padding: 4px;
		border-radius: 5px;
	}
	
	
	td {
		padding: 6px;
		text-align: left;
		border-bottom: none!important; 
	}

	.tableau {
		margin:0!important;
	}
	.div_info_admin{display : none}
	.div_formation{display : none}
	.div_parcours{display : none}
	.div_etat_civil{display : block}
	.div_cordonne{display : none}
	.separateur{
		cursor:pointer
	}
</style>	
<script>
	function showClass(divClass){
		
		hideClass("div_info_admin");
		hideClass("div_carriere");
		hideClass("div_formation");
		hideClass("div_parcours");
		hideClass("div_cordonne");
		
		activateBootStrapControl();
		$("."+divClass).show();
		$("#"+divClass).attr("onclick","hideClass('"+divClass+"')");
		$("#icon_"+divClass+" i").attr('class','la la-angle-up');
	}
	function hideClass(divClass){
		$("."+divClass).hide();
		$("#"+divClass).attr("onclick","showClass('"+divClass+"')");
		$("#icon_"+divClass+" i").attr('class','la la-angle-down');
	}
	
	function certificat(_id){
		if (_id != undefined) {
			zUrl = "cv/certificat/" + _id ; 
		} else {
			zUrl = "cv/certificat" ; 
		}
		$.ajax({
            url: "<?php echo base_url();?>" + zUrl ,
            type: 'get',
            success: function(data, textStatus, jqXHR) {
                $('#certificat').html('');
                $('#certificat').html(data);
                $('#certificat').show();
                $('#certificat_cv').show();
                $('#modalDetail').modal();
                
            },
            async: false
         });
    }
	
	function activateBootStrapControl(){
		indexDiplome = document.getElementById('size_diplome').value;
        indexParcours = document.getElementById('size_parcours').value;
        
        var now = new Date();
		var dateLast = new Date('12/31/1945');
		var dateNaissMin = new Date(now.getFullYear()-18, now.getMonth(), now.getDate());
		var dateNaissAffiche = dateNaissMin.getDate() + '/' +dateNaissMin.getMonth() + '/' + dateNaissMin.getFullYear();
		var dateNaissAffiche1 = new Date(dateNaissMin.getDate() + '/' +dateNaissMin.getMonth() + '/' + dateNaissMin.getFullYear());

		$("#date_compare").val(dateNaissAffiche);
		
		$("#date_prise_service").datepicker({
			 language: "fr",
			 autoclose: true,
			 todayHighlight: true,
			 format: "dd/mm/yyyy"
		});
		
		$("#date_prise_service").datepicker("setStartDate", dateLast);
		
		//$("#date_prise_service").datepicker('update', now);
		
		$("#date_prise_service").mask("99/99/9999");                  
		$("#date_naiss").datepicker({
			 language: "fr",
			 autoclose: true,
			 todayHighlight: true,
			 format: "dd/mm/yyyy"
		});

		
		$("#date_prise_service").on("change", function(a) {
			$('#cv_form').bootstrapValidator('revalidateField', 'date_prise_service');
		})

		$("#phone").on("change", function(a) {
			$('#cv_form').bootstrapValidator('revalidateField', 'phone');
		})

		$("#date_naiss").on("change", function(a) {
			$('#cv_form').bootstrapValidator('revalidateField', 'date_naiss');
		})
		
		$("input[name='diplome_date[]']").on("change", function(a) {
			$('#cv_form').bootstrapValidator('revalidateField', 'diplome_date[]');
		})
		
		$("#date_naiss").mask("99/99/9999");
		$("#date_naiss").datepicker("setEndDate", dateNaissAffiche1);

		$("input[name='date_debut[]']").mask('9999');
		$("input[name='date_fin[]']").mask('9999');
		$("input[name='diplome_date[]']").mask('9999');
		
		$('#cv_form').bootstrapValidator({
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			excluded:':not(:visible)',
			onError: function(e) {
                             //bootbox.alert('Veuillez remplir les champs obligatoires');
                        },
			onSuccess: function(e) {
                            
			},
			fields : {
				date_naiss : {
					validators : {
						notEmpty : {
							message : 'Veuillez enter votre date de naissance'
						},
						callback: {
							callback: function(value, validator) {
								var date = value.split('/');
								var year = date[2];
								var now = new Date();
								var yearNow = now.getFullYear();
								var diff = yearNow-year;
								return  {
									valid :(diff > 17 && diff <61) , 
									message: 'La date de naissance doit être entre '+ (yearNow -60) + ' et  '+ (yearNow-18)
								}
							}
						}
					},
					date : {
						format : 'DD/MM/YYYY',
						max: dateNaissAffiche1,
						message : 'Veuillez entrer une date de naissance valide'
					}
				}, 
				photo : {
					validators : {
						regexp: {
							regexp: /\.(gif|jpg|jpeg|tiff|png)$/i,
							message: 'Veuillez choisir un fichier de type jpeg,png,gif'
						}
					}
				}, 
				date_prise_service : {
					validators : {
						notEmpty : {
							message : 'Veuillez enter votre date du prise de service'
						},
						callback: {
							message: 'La Date de service doit être inférieur à la date de naissance',
							callback: function(value, validator, $field) {
								if (value === '') {
									return true;
								}
								var zDatedeNaissance =  $("#date_naiss").val();
								var zDatedePriseService =  $("#date_prise_service").val();

								var toDateService = zDatedePriseService.split('/');
								var toDateNaissance = zDatedeNaissance.split('/');
								
								
								var d1 = new Date(toDateNaissance[2],toDateNaissance[1]-1,toDateNaissance[0]); 
								var d2 = new Date(toDateService[2],toDateService[1]-1,toDateService[0]); 

								if(d1 > d2)
								{

										return {
											valid: false,       // or true
											message: 'La Date de service doit être inf&eacute;rieur à la date de naissance'
										}
								}
								else
								{
									return {
										valid: true,       // or true
									}
								}
								return true;
							}
						}
					}
				},
				sit_mat : {
					validators : {
						greaterThan: {
							value: 1,
							inclusive: false,
							message: 'Veuillez S&eacute;lectionner la situation matrimoniale'
						}
					}
				},
				nbr_enfant : {
					validators : {
						notEmpty : {
							message : 'Veuillez remplir le nombre d\'enfant'
						},
						numeric : {
							message : 'Le nombre d\'enfant entr&eacute; n\'est pas valide'
						}
					} 
				},
				addresse : {
					validators : {
						notEmpty : {
							message : 'Veuillez remplir votre adresse'
						}
					}
				},
				phone: {
					validators : {
						notEmpty : {
							message : 'Veuillez remplir votre t&eacute;l&eacute;phone'
						}
					}
                },
				lacalite_service: {
					validators : {
						notEmpty : {
							message : 'Veuillez remplir votre localit&eacute; de service'
						}
					}
				},


				porte: {
					validators : {
						notEmpty : {
							message : 'Veuillez remplir votre porte ou code porte'
						}
					}
				},

				poste: {
					validators : {
						notEmpty : {
							message : 'Veuillez remplir votre poste'
						}
					}
				},
				
                'par_poste[]': {
					validators : {
						notEmpty : {
							message : 'Le poste est obligatoire'
						}
					}
				},
				
				'activite[]': {
					validators : {
						notEmpty : {
							message : 'Votre Activit&eacute; est obligatoire'
						}
					}
				},
				
				'par_departement[]': {
					validators : {
						notEmpty : {
							message : 'Departement  obligatoire'
						}
					}
				},
                domaine: {
					validators : {
						notEmpty : {
							message : 'Le domaine est obligatoire'
						}
					}
				},
				
				pays : {
					validators : {
						greaterThan: {
							value: 0,
							inclusive: false,
							message: 'Veuillez S&eacute;lectionner votre Pays'
				        }
				    }
				},
				
			    province : {
					validators : {
						greaterThan: {
							value: 0,
							inclusive: false,
							message: 'Veuillez S&eacute;lectionner votre Province'
				        }
				    }
				},
								
				region : {
					validators : {
						greaterThan: {
							value: 0,
							inclusive: false,
							message: 'Veuillez S&eacute;lectionner votre Region'
				        }
				    }
				},
				
				district : {
					validators : {
						greaterThan: {
							value: 0,
							inclusive: false,
							message: 'Veuillez S&eacute;lectionner votre District'
				        }
				    }
				},
				departement : {
					validators : {
						greaterThan: {
							value: 0,
							inclusive: false,
							message: 'Veuillez S&eacute;lectionner votre Departement'
				        }
				    }
				},
                'diplome_name[]': {
					validators : {
						notEmpty : {
							message : 'Le diplome est obligatoire'
						}
					}
				},
                'diplome_discipline[]': {
					validators : {
						notEmpty : {
							message : 'La filiere est obligatoire'
						}
					}
				},
                'diplome_etablissement[]': {
					validators : {
						notEmpty : {
							message : ' obligatoire'
						}
					}
				},
                'diplome_date[]': {
					validators : {
						notEmpty : {
							message : ' obligatoire'
						}
					}
                },
                'diplome_pays[]': {
					validators : {
						notEmpty : {
							message : ' obligatoire'
						}
					}
				},
            }
		});
        $("#phone").mask("999 99 999 99"); 
	}
</script>		