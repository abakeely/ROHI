<?php 
	$date_depo = date('d/m/Y');
	
	$nom = $user_edit['nom'];
	$prenom = $user_edit['prenom'];
	$date_naiss = "";
	
	$corps_edit =  0;
	$grade_edit =  0;
	$indice_edit =  0;
	
	$nbr_enfant = 0;
	$date_prise_service = '';
	
	if($exist_cv){
		if(isset($user_edit['matricule'])){
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
	}
	else{
		$date_naiss = $matricule['date_naissance'];
		$corps_edit = $matricule['corps_id'];
		$grade_edit = $matricule['grade_id'];
		$indice_edit = $matricule['indice_id'];
		$nbr_enfant = $matricule['nb_enfant'];
		$date_prise_service = $matricule['date_service'];
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

		//$statut_edit = $candidat->statut['libele'];	
		
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

		.help-block {width:500px!important;}
		
    </style>
 <div id="content-wrap" class="row"> 
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

	?>
  <input type="hidden" id="date_compare" name="date_compare"  value="">
	<div class="col-md-12">
           
            <br>
            <div class="row separateur"><div class="col-md-12">Informations Administratives</div></div>
            <br>
	   <div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-3 libele_form">
					<label class="control-label "> Statut </label>
			</div>
			<div class="col-md-3">
					<select class="form-control" placeholder="Status" name="statut" data-placement="top" <?php if ((string)$user_edit['statut'] != '0') echo 'disabled="disabled"' ;?> data-toggle="tooltip" data-original-title="Hamarino ny momba anao na ECD, na ELD, na EMO, na ES, na EFA, na Fonctionnaire"id="statut">
							<?php foreach($list_statut as $d){ 
									$selected = ($d['id'] == $statut_edit)  ? ' selected="selected"' : '';
							?>
									<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
							<?php }?>
					</select>
			</div>
			<div class="col-md-5"></div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-3 libele_form">
					<label class="control-label "> Corps </label>
			</div>
			
			<div class="col-md-3">
                            <select id="corps" class="form-control" placeholder="Status" name="corps" <?php if ((string)$corps_edit != '0') echo 'disabled="disabled"' ;?> data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « corps »-nao dia mila misafidy ianao">
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
			<div class="col-md-3"></div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-3 libele_form">
					<label class="control-label "> Grade </label>
			</div>
			<div class="col-md-3">
					<select class="form-control" placeholder="Status" name="grade" <?php if ((string)$grade_edit != '0') echo 'disabled="disabled"' ;?> data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « Grade »-nao dia mila misafidy ianao" id="grade">
							<?php 
							
								foreach($list_grade as $d){ 
									//$selected = ($d['id'] == $grade_edit)  ? ' selected="selected"' : '';

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
			<div class="col-md-2">
                        <?php if($autre_grade == ''){?>
                        <input type="text" name="autre_grade" class="form-control" id="autre_grade" style="display: none"/>
                        <?php } else{?>
                          <input type="text" name="autre_grade" class="form-control" id="autre_grade" value="<?php echo $autre_grade;?>"/>
                        <?php }?>
            </div>
			<div class="col-md-3"></div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-3 libele_form">
					<label class="control-label "> Indice </label>
			</div>
			<div class="col-md-3">
					<select class="form-control" placeholder="Status" name="indice" <?php if ((string)$indice_edit != 0) echo 'disabled="disabled"' ;?>  data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « Indice »-nao nao dia mila misafidy ianao" id="indice">
							<?php 
								foreach($list_indice as $d){ 
									//$selected = ($d['id'] == $indice_edit)  ? ' selected="selected"' : '';

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
			<div class="col-md-2">
                        <?php if($autre_indice == ''){?>
                        <input type="text" name="autre_indice" class="form-control" id="autre_indice" style="display: none"/>
                        <?php } else{?>
                          <input type="text" name="autre_indice" class="form-control" id="autre_indice" value="<?php echo $autre_indice;?>"/>
                        <?php }?>
            </div>
			<div class="col-md-3"></div>
		</div>
		<br>
		<div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3 labelForm libele_form">
                            <label class="control-label">Date de prise de service</label>
                    </div>
                    <div class="col-md-3" id="date_prise_service_div">
                            <input type="text" id="date_prise_service" class="form-control" placeholder="Date de prise de service" data-placement="top" data-toggle="tooltip" data-original-title="Ampidiro ny  andro/volana/taona  nidiranao niasa teto amin’ny Ministeran’ny Fitantanambola sy ny Teti-bola" name="date_prise_service" value="<?php echo $date_prise_service;?>"/>
                            <span class="la la-calendar txt-danger form-control-feedback" style="top:11px;right:12px;"></span>
                    </div>
                    <div class="col-md-5"></div>
        </div>
		<div class="row message"></div>
		<br>
		<div class="row separateur"><div class="col-md-12">Etat Civil</div></div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label"> Photo </label>
			</div>
			<div class="col-md-3">
				<input type="file"  class="file_upload" name="photo" data-toggle="tooltip" data-original-title= "Safidio sy ampidiro ny sarinao"id="photo"/>
			</div>
			<div class="col-md-2">
                            <img src="<?php echo $image_url;?>" width="80px"/>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label"> Nom </label>
			</div>
			<div class="col-md-6">
                            <input type="text"  class="form-control" placeholder="Nom " name="nom" id="nom" value="<?php echo $nom; ?>" disabled="disabled">
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label"> Pr&eacute;noms </label>
			</div>
			<div class="col-md-6">
				<input type="text" class="form-control" placeholder="Pr&eacute;nom(s)" name="prenom" id="nom" value="<?php echo $prenom; ?>" disabled="disabled">
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<br>
		<div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3 labelForm libele_form">
                            <label class="control-label">Date de Naissance</label>
                    </div>
                    <div class="col-md-3">
                            <input type="text" id="date_naiss" class="form-control"  placeholder="Date de Naissance" name="date_naiss" value="<?php echo $date_naiss;?>" >
                            <span class="la la-calendar txt-danger form-control-feedback" style="top:11px;right:12px;"></span>
                    </div>
                    <div class="col-md-5"></div>
        </div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label">Situation Matrimoniale</label>
			</div>
			<div class="col-md-3">
				<select class="form-control" placeholder="Situation Matrimoniale" name="sit_mat" data-toggle="tooltip" data-original-title= "Hamarino ny momba anao : Manambady, na Misaraka, na Mpitovo, na Maty Vady"id="sit_mat" onchange="changeDest()">
					<?php foreach($list_sit_mat as $sit){ 
						$selected = ($sit['id'] != $sit_matri) ? '' : 'selected="selected"';
					?>
						<option  value=<?php echo $sit['id'];?>  <?php echo ' '.$selected; ?>><?php echo $sit['libele'];?> </option>
					<?php }?>
				</select>
			</div>
			<div class="col-md-5">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-3 labelForm libele_form">
				<label class="control-label">Nombre d&acute;enfants</label>
			</div>
			<div class="col-md-3">
				<input type="text" id="nbr_enfant" style="width:45px;" maxlength="2" class="form-control" name="nbr_enfant" data-toggle="tooltip" data-original-title= " Soraty ny isan’ny ankizy"value="<?php echo $nbr_enfant;?>">
			</div>
			<div class="col-md-5"></div>
                </div>
                <br>
                <div class="row separateur"><div class="col-md-12">Adresse et Contact</div></div>
                <br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label">Adresse Actuelle <b><font color='red'> * </font></b> </label>
			</div>
			<div class="col-md-6">
				<input type="text" id="addresse" class="form-control" placeholder="Adresse" name="addresse" data-toggle="tooltip" data-original-title= "Soraty ny toeram-ponenao ankehitriny" id="sit_mat"value="<?php echo $adress;?>">
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label">T&eacute;l&eacute;phone <b><font color='red'> * </font></b> </label>
			</div>
			<div class="col-md-6">
				<input type="text" id="phone" class="form-control" placeholder="T&eacute;l&eacute;phone" name="phone" data-toggle="tooltip" data-original-title= "Ampidiro ny laharan'ny finday anao (iray ihany)" value="<?PHP ECHO $phone;?>">
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label">Adresse El&eacute;ctronique  </label>
			</div>
			<div class="col-md-6">
				<input type="text" id="email" class="form-control" placeholder="E-mail" name="email" data-toggle="tooltip" data-original-title= "Ampidiro ny mailaka" value="<?php echo $email;?>">
			</div>
			<div class="col-md-2">
			</div>
		</div>
                <br>
                <div class="row separateur"><div class="col-md-12">Formations</div></div>
                <br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-2">
                            <label class="control-label libele_form">Dipl&ocirc;mes Obtenus( commencer par le plus r&eacute;cent) <b><font color='red'> * </font></b> </label>               
			</div>
			<div class="col-md-9">
                            <div class="row" >
                                <div class="col-md-12" id="tableDiplome">
                                    <input type="hidden" value="<?php echo sizeof($diplome_list)?>" id="size_diplome"/>   
                                 <?php $i=0; foreach($diplome_list as $diplome){$i++;?>
                                       <div class="row diplome_row" id="diplome_row_<?php echo $i;?>">
                                            <div class="col-md-2"><input class="form-control" placeholder="Diplomes" type="text" name="diplome_name[]" value="<?php echo $diplome['diplome_name'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                                            <div class="col-md-3"><input class="form-control" placeholder="Fili&egrave;re" type="text" name="diplome_discipline[]" value="<?php echo $diplome['diplome_disc'];?>" data-toggle="tooltip" data-original-title= "Soraty ny sampam-pianarana"/></div>
		                                    <div class="col-md-2"><input class="form-control input_date"  maxLength="4"  id="diplome_date_<?php echo $i;?>" onChange="testDate('<?php echo $i;?>')" placeholder="Ann&eacute;e d&grave;obtention" type="text" name="diplome_date[]" value="<?php echo $diplome['diplome_date'];?>" data-toggle="tooltip" data-original-title= "Soraty ny taona nahazoanao ilay mari-pahaizana"/></div>
                                            <div class="col-md-2"><input class="form-control " placeholder="Etablissement " type="text" name="diplome_etablissement[]" value="<?php echo $diplome['diplome_etab'];?>" data-toggle="tooltip" data-original-title= "Soraty ny toeram-pianarana nahazoanao ilay mari-pahaizana"/></div>                                           
                                            <div class="col-md-2"><input class="form-control" placeholder="Pays" type="text" name="diplome_pays[]" value="<?php echo $diplome['diplome_pays'];?>" data-toggle="tooltip" data-original-title= "Soraty ny anaran'ilay firenena nahazoanao ilay mari-pahaizana"/></div>
                                            <?php if($i!=1){ ?>
                                            <div class="col-md-1"><button class="form-control btn_close" type="button" onclick="<?php echo 'deleteDiplome('.$i.')';?>"><i class="la la-minus-circle"></i></button></div>    
                                            <?php } ?>
                                       </div>
                                 <?php }?>
                                </div>
                            </div>    
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                <button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="ajoutDiplome"> Ajouter un Dipl&ocirc;me</button>
                                </div>
                                <div class="col-md-9"></div>
                            </div> 
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-2 libele_form">
				<label class="control-label">Domaines de Compétences <b><font color='red'> * </font></b>
				</label>
			</div>
			<div class="col-md-8">
				<textarea name="domaine" id="domaine" class="form-control" rows=5  data-toggle="tooltip" data-original-title= "Soraty ireo karazana traikefa hafa voafehinao"><?php echo $domaine_edit;?></textarea>
			</div>
			<div class="col-md-1">
			</div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-9" style="font-size: 1.1em;"> <u>Exemples</u>:
                      Fiscalité, gestion de projet,marketing,finances, comptabilité

			</div>					
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-2 libele_form">
				<label class="control-label">Autres 
				</label>
			</div>
			<div class="col-md-8">
				<textarea name="autre_domaine" id="autre_domaine" class="form-control" rows=5  data-toggle="tooltip" data-original-title= "Soraty  raha manana traikela lanampiny ianao"><?php echo $autre_domaine_edit;?></textarea>
			</div>
			<div class="col-md-1">
			</div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-9" style="font-size: 1.1em;"> <u>Exemple </u>:
                            permis de conduire ,
                            formation premier secours 
			</div>					
		</div>
		<br>
		<div class="row separateur"><div class="col-md-12">Parcours professionnel</div></div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-2 libele_form">
				<label class="control-label ">Poste <b><font color='red'> * </font></b> </label>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<input type="text" class="form-control" placeholder="Poste" name="poste" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny asa amandrarahanao"  id="poste" value="<?php echo $poste; ?>">
					</div>
				</div>
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-9" style="font-size: 1.1em;"> 
				<div class="row">
					<div class="col-md-12">
						<u>Exemple </u>:
		                Chef de service / Comptable
	                </div> 
                </div>
			</div>					
		</div>
		<br>
	<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-2 libele_form">
				<label class="control-label ">Activit&eacute; (Etudier les dossier entrant) <b><font color='red'> * </font></b> </label>
			</div>
			<div class="col-md-4" id="table_activite">
				<?php $i=0; foreach($activite_list as $activite){$i++;?>
				<div class="row" id="row_activite_<?php echo $i;?>">
					<?php if($i!=1) { echo "<br>"; }?>
					<div class="col-md-10">
						<input type="text" class="form-control" placeholder="Activit&eacute;" name="activite[]" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny asa amandrarahanao"  value="<?php echo $activite['libele'];?>">
					</div>
				    <?php if($i!=1){?> 
                    <div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo 'deleteActivite('.$i.')';?>"><i class="la la-minus-circle"></i></button></div>    
                    <?php }?>
				</div>
				<?php }?>
			</div>
			<div class="col-md-2">
			</div>
	</div>	
		<br>
		<div class="row">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-9">
					<div class="row"> 
						<div class="col-md-3">
							<button style="background: none repeat scroll 0px 0px olivedrab;color:white" type="button" class="form-control" id="ajoutActivite" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy ny asa efa nosahaninao hatramin’izay" >Ajouter un activite</button>
						</div>
						<div class="col-md-9">
					</div>
					</div>
				</div>
		  </div>  
		<br>
		<div class="row">
		  <div class="col-md-1"></div>
            <div class="col-md-2 libele_form">
                <label class="control-label">Parcours( commencer par votre poste actuel)<b><font color='red'> * </font></b> </label>               
			</div>
			    <div class="col-md-9">
                        <div class="row" >
                          <div class="col-md-12" id="tableParcours">
                            <input type="hidden" value="<?php echo sizeof($parcours_list)?>" id="size_parcours"/>   
                               <?php $i=0; foreach($parcours_list as $parcours){$i++;?>
                                <div class="row diplome_row" id="parcours_row_<?php echo $i;?>">
                                   <div class="col-md-2">
								   <input class="form-control input_date"maxLength="4" id="date_debut_<?php echo $i;?>" onChange="testDate('<?php echo $i;?>')" placeholder="Ann&eacute;e / D&eacute;but" type="text" name="date_debut[]" value="<?php echo $parcours['date_debut'];?>" data-toggle="tooltip" data-original-title= "Soraty ny taona nanombohanao niasa tao amin'ny sampan-draharaha"/></div>
                                      <div class="col-md-2"><input class="form-control input_date" maxLength="4"  id="date_fin_<?php echo $i;?>" onChange="testDate('<?php echo $i;?>')" placeholder="Ann&eacute;e / Fin" type="text" name="date_fin[]" value="<?php echo $parcours['date_fin'];?>" data-toggle="tooltip" data-original-title= "Soraty ny taona farany niasanao tao amin'ny sampandraharaha"/></div>
					                   <div class="col-md-3">
									   <input class="form-control" placeholder="Poste" type="text" name="par_poste[]" value="<?php echo $parcours['par_poste'];?>" data-toggle="tooltip" data-original-title= "Soraty ny asa na andraikitra nosahaninao"/></div>
                                            <div class="col-md-3"><input class="form-control" placeholder="Departement" type="text" name="par_departement[]" value="<?php echo $parcours['par_departement'];?>" data-toggle="tooltip" data-original-title= "Soraty ny Departemanta na sampan-draharaha  misy anao"/></div>                  
                                            <?php if($i!=1){?> 
                                            <div class="col-md-1"><button class="form-control btn_close" type="button" onclick="<?php echo 'deleteParcours('.$i.')';?>"><i class="la la-minus-circle"></i></button></div>    
                                            <?php }?>
                                </div>
                                    <?php }?>
                             </div>
                        </div>    
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                <button style="background: none repeat scroll 0px 0px olivedrab;color:white" type="button" class="form-control" id="ajoutParcours" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy ny asa efa nosahaninao hatramin’izay" >Ajouter un parcours</button>
                                </div>
                                <div class="col-md-9"></div>
                            </div> 
			    </div>
		</div>
		<!--debut  modification du 13-05-2016 -->
		<br>
		<div class="row">
          <div class="col-md-1"></div>
           <div class="col-md-3 libele_form">
              <label class="control-label "> Pays </label><font color="red"> *</font></b>
           </div>
              <div class="col-md-3">
                   <select class="form-control" placeholder="pays" name="pays" data-placement="top" data-toggle="tooltip" data-original-title="Safidio ny anarany ilay firenena nahazoanao ilay mari-pahaizana"id="pays">
                        <?php foreach($list_pays as $d){ 
							$selected = ($d['id'] == $pays_edit)  ? ' selected="selected"' : '';
                        ?>
                        <option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
                        <?php }?>
                   </select>
              </div>
            <div class="col-md-5"></div>
		</div>
		<br>
		<div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3 libele_form">
                            <label class="control-label ">Province </label><font color="red"> *</font></b>
                    </div>
                    <div class="col-md-3">
                            <select class="form-control" placeholder="province" name="province" data-toggle="tooltip" data-original-title="Safidio ny Faritany misy anao"  id="province">
                                <?php if($user_edit['exist_cv'] && $province_edit){ ?>      
                                <option  value=<?php echo $province_edit['id'];?>><?php echo $province_edit['libele'];?></option>
                                <?php } ?>
                            </select>
                    </div>
                    <div class="col-md-5"></div>
		</div>
		<br>
		<div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3 libele_form">
                            <label class="control-label "> R&eacute;gion </label><font color="red"> *</font></b>
                    </div>
                    <div class="col-md-3">
                            <select class="form-control" placeholder="Region" name="region"  data-toggle="tooltip" data-original-title="Safidio ny Faritra misy anao" id="region">
                                <?php if($user_edit['exist_cv'] && $region_edit){ ?>   
                                <option  value=<?php echo $region_edit['id'];?>><?php echo $region_edit['libele'];?></option>
                                <?php } ?> 
                            </select>
                    </div>
                    <div class="col-md-5"></div>
		</div>
        <br>
		<div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3 libele_form">
                        <label class="control-label "> District </label><font color="red"> *</font></b>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" placeholder="district" name="district" data-placement="top" data-toggle="tooltip" data-original-title="safidio ny Distrika misy anao" id="district">
                            <option  value="0">-------</option> 
							<?php foreach($list_district as $d){ 
                                    $selected = ($d->id == $district_edit)  ? ' selected="selected"' : '';
                            ?>
                                    <option  value=<?php echo $d->id;?> <?php echo $selected;?>><?php echo $d->libele;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-md-5"></div>
		</div>
        <br>		
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label">D&eacute;partement  </label><b><font color="red"> * </font></b>
			</div>
			<div class="col-md-6">
				<select class="form-control" placeholder="Departement" name="departement" data-toggle="tooltip" data-original-title= "Safidio ny Departemanta na sampan-draharaha misy anao" id="departement">
					<option  value="0">-------</option> 
                        <?php foreach($list_departement as $d){ 
						$selected = ($d['id'] == $departement_edit)  ? ' selected="selected"' : '';
					?>
						<option  value=<?php echo $d['id'];?> <?php echo $selected;?> ><?php echo $d['libele'];?></option>
					<?php }?>
				</select>
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label "> Direction </label><b><font color="red"> *</font></b>
			</div>
			<div class="col-md-6">
                 <select class="form-control" placeholder="Direction" name="direction" data-toggle="tooltip" data-original-title= "Safidio ny Foibem-pitondrana misy anao " id="direction">
					<option  value="0">-------</option> 
                           <?php foreach($list_direction as $d){ 
						$selected = ($d['id'] == $direction_edit)  ? ' selected="selected"' : '';
					?>
						<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
					<?php }?> 
				</select>
			</div>
		</div>
		<br>
        <div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label "> Service </label><font color="red"> *</font></b>
			</div>
			<div class="col-md-6">
				<select class="form-control" placeholder="Service" name="service" data-toggle="tooltip" data-original-title= "Safidio  ny sampan-draharaha  misy anao " id="service">
					<option  value="0">-------</option> 
                                        <?php foreach($list_service as $d){ 
						$selected = ($d['id'] == $service_edit)  ? ' selected="selected"' : '';
					?>
						<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
					<?php }?>
				</select>
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label "> SOA </label>
			</div>
			<div class="col-md-6" id="div_soa">
				<?php foreach($soa_list as $d){ ?>
					<div class="row">
					<?php 
					if(substr_count($soa_edit, $d['id']) > 0 ){
					?>
						<input type="checkbox" name="soa[]" value=<?php echo $d['id'];?> checked="checked" /><?php echo $d['libele']?>
					<?php } else{?> 
						<input type="checkbox" name="soa[]" value=<?php echo $d['id'];?> /><?php echo $d['libele']?><?php } ?>  	
					</div>
					<?php } ?>                                    
			</div>
                        <div class="col-md-2">
                            <?php if($autre_service == ''){?>
                            <input type="text" name="autre_service" class="form-control" id="autre_service" style="display: none"/>
                            <?php } else{?>
                              <input type="text" name="autre_service" class="form-control" id="autre_service" value="<?php echo $autre_service;?>"/>
                            <?php }?>
                        </div>
			<div class="col-md-2">
			</div>
		</div>   
		<br>
		<div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-3 libele_form">
                            <label class="control-label "> Division </label>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control" placeholder="Division" name="division" data-toggle="tooltip" data-original-title="Safidio ny Division misy anao" id="division">
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
                        <input type="text" name="autre_division" class="form-control" id="autre_division" style="display: none"/>
                        <?php } else{?>
                          <input type="text" name="autre_division" class="form-control" id="autre_division" value="<?php echo $autre_division;?>"/>
                        <?php }?>
                    </div>
                    <div class="col-md-2"></div>
	        </div>
		 <br>
             
		<!-- fin modification du 13-05-2016 -->
        <br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label ">Porte <b><font color='red'> * </font></b> </label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control" placeholder="Porte" name="porte" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny varavarana ny toeram-piasanao"  id="porte" value="<?php echo $porte; ?>">
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-8" style="font-size: 1.1em;"> <u>Exemple </u>:
                           P15 / BOX2 
			</div>					
		</div>
		<br>
		
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label ">Lieu de travail <b><font color='red'> * </font></b> </label>
			</div>
			<div class="col-md-6">
				<input type="text" class="form-control" placeholder="Lieu de travail" name="lacalite_service" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny toeram-piasanao"  id="lacalite_service" value="<?php echo $lacalite_service; ?>">
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-8" style="font-size: 1.1em;"> <u>Exemple </u>:
                            Immeuble Finances Antaninarenina / SONACO Ambanidia 
			</div>					
		</div>
		<br>
		<div class="row">
		<div class="col-md-1">
			<input type="hidden"  name="id"  value="<?php echo $id; ?>">
		</div>
		</div>
		<br>
		<b><font color='red' size="5rem"> * </font></b><font size="3rem">  Les champs marqu&eacute;s d'une &eacute;toile sont obligatoires.</font>
		<?php // if ($user_edit['role']=='user'){?>
		<div class="row">
                    <div class="col-md-6"></div>
                    
                    <div class="col-md-2">
                            <input type='submit' class="btn btn-primary form-control " data-toggle="tooltip" data-original-title=" Tsindrio rehefa feno daholo ny momba anao rehetra " value='Enregistrer' />	
                    </div>
					
                <?php if($user_edit['exist_cv']){ ?>
                    <div class="col-md-2">
                        <a href="#" class="btn btn-primary form-control " data-toggle="tooltip" data-original-title=" Tsindrio dia afaka manonta ny mari-pankasitrahanao"  onclick="certificat()"> <font style="font-size: 1em;"> Imprimer attestation</font></a>
                    </div>
		<?php } ?>
				<?php if($user_edit['exist_cv']){ ?>
                    <div class="col-md-2">
                        <a href="<?php echo base_url();?>cv/fpdf_cv" class="btn btn-primary form-control " data-toggle="tooltip" data-original-title=" Tsindrio dia afaka manonta ny CV'nao ianao" target="_blank" > <font style="font-size: 1em;"> Imprimer CV </font></a>
                    </div>
		<?php } ?>
		</div>
        <br>
		<?php //}?>
	</div>
	</form> 
  </div>
  <div id="certificat"></div>
  <script>
    $('input').popover({
	trigger: 'manual',
	    'placement': 'bottom',
	    container: 'body',
		html:true,
		animation:false});
	$('label').tooltip();	
	$('textarea').tooltip();
	$('input').tooltip();
    $('select').tooltip();
    $('button').tooltip();
    $('a').tooltip();
    
    
    function certificat(){
        $.ajax({
            url: "<?php echo base_url();?>" + "cv/certificat",
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
    $(document).ready(function() {
		<?php if ($user_edit['role']=='admin'){?>
			$(".form-control").attr('readonly','readonly');	
			$(".form-control").attr('disabled','disabled');	
		<?php }?>
        
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
				
				direction : {
					validators : {
						greaterThan: {
							value: 0,
							inclusive: false,
							message: 'Veuillez S&eacute;lectionner votre Direction'
				        }
				    }
				},
				
				service : {
					validators : {
						greaterThan: {
							value: 0,
							inclusive: false,
							message: 'Veuillez S&eacute;lectionner votre Service'
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
	});
  </script>		