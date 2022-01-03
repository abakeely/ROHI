 <?php $this->load->view('cv/details_cv');
 	function rohi_is_empty($str){
 		$ret =  ($str == '999999' || $str == '9999' || $str == '0');
 		return $ret;
 	}
 ?>
 <div id="content-wrap" class="row"> 

  <form class="form-horizontal" role="form" name="cv" id="cv" action="create_cv" method="POST">
	<div class="col-md-12">
		<br>
		<div class="text-center" > 
			<h3><font color="DarkSlateGray">Liste responsable personnel</font></h3>
		</div>
	<br>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	     <thead>
		   <tr >
			<th style="width:10px">Ordre</th>
			<th>Statut</th>
			<th>IM</th>
			<th>Nom et Pr&eacute;noms</th>
			<th>Departement</th>
			<th>Direction</th>
			<th>Service</th>
			<th>R&eacute;gion</th>
			<th>Supprimer</th>
			<?php if(isset($valide)){?>
			<th></th>
			<?php }?> 
		  </tr>
	    </thead>
		
		<?php 
		$ordre = 0;
		foreach ($list_candidat as $candidat){ 
			$ordre++;
			$id = $candidat->id; 
			$sexe = '';
			if($candidat->sexe == 1){
				$sexe = 'Masculin';
			}
			else{
				$sexe = 'Feminin';
			}
			
		?>  
		 <tr>
			<input type="hidden" id="photo_<?php echo $id;?>" value="<?php echo $candidat->image_url;?>"/>
			<input type="hidden" id="ref_<?php echo $id;?>" value="<?php echo $candidat->id;?>"/>
			<input type="hidden" id="user_id_<?php echo $id;?>" value="<?php echo $candidat->user_id;?>"/>
			<input type="hidden" id="nom_<?php echo $id;?>" value="<?php echo $candidat->nom;?>"/>
			<input type="hidden" id="prenom_<?php echo $id;?>" value="<?php echo $candidat->prenom;?>"/>
			<input type="hidden" id="sexe_<?php echo $id;?>" value="<?php echo $sexe;?>"/>
			<input type="hidden" id="date_naiss_<?php echo $id;?>" value="<?php echo $candidat->date_naiss;?>"/>
			<input type="hidden" id="sit_mat_<?php echo $id;?>" value="<?php echo isset($candidat->sit_mat['libele'])?$candidat->sit_mat['libele']:'';?>"/>
			<input type="hidden" id="phone_<?php echo $id;?>" value="<?php echo $candidat->phone;?>"/>
			<input type="hidden" id="address_<?php echo $id;?>" value="<?php echo $candidat->address;?>"/>
			
                        
			<input type="hidden" id="im_<?php echo $id;?>" value="<?php echo $candidat->matricule;?>"/>
			<input type="hidden" id="cin_<?php echo $id;?>" value="<?php echo $candidat->cin;?>"/>
			<input type="hidden" id="type_contrat_<?php echo $id;?>" value="<?php echo isset($candidat->type_contrat)?$candidat->type_contrat:'';?>"/>
			<input type="hidden" id="fonction_actuel_<?php echo $id;?>" value="<?php echo $candidat->fonction_actuel;?>"/>
			<input type="hidden" id="departement_<?php echo $id;?>" value="<?php echo $candidat->departement;?>"/>
			<input type="hidden" id="direction_<?php echo $id;?>" value="<?php echo $candidat->direction;?>"/>
			<input type="hidden" id="service_<?php echo $id;?>" value="<?php echo $candidat->service;?>"/>
			<input type="hidden" id="division_<?php echo $id;?>" value="<?php echo $candidat->division;?>"/>
			<input type="hidden" id="email_<?php echo $id;?>" value="<?php echo $candidat->email;?>"/>
			<input type="hidden" id="localite_service_<?php echo $id;?>" value="<?php echo $candidat->lacalite_service;?>"/>
			<input type="hidden" id="diplome_<?php echo $id;?>" value="<?php echo isset($candidat->diplome)?$candidat->diplome:'';?>"/>
			
			<input type="hidden" id="domaine_<?php echo $id;?>" value="<?php echo $candidat->domaine;?>"/>
			<input type="hidden" id="date_maj_<?php echo $id;?>" value="<?php echo $candidat->date_maj;?>"/>
			
			<input type="hidden" id="corps_<?php echo $id;?>" value="<?php echo $candidat->corps;?>"/>
			<input type="hidden" id="grade_<?php echo $id;?>" value="<?php echo $candidat->grade;?>"/>
			<input type="hidden" id="indice_<?php echo $id;?>" value="<?php echo $candidat->indice;?>"/>
			<input type="hidden" id="date_service_<?php echo $id;?>" value="<?php echo isset($candidat->date_service)?$candidat->date_service:'';?>"/>
			
            <input type="hidden" id="nom_conjoint_<?php echo $id;?>" value="<?php echo isset($candidat->nom_conjoint)?$candidat->nom_conjoint:'';?>"/>
			<input type="hidden" id="nbr_enfant_<?php echo $id;?>" value="<?php echo $candidat->nbr_enfant;?>"/>
			
         
			
			<td style="width:10px"><?php echo $ordre; ?></td>
			<td><?php echo ($candidat->statut)?$candidat->statut['libele']:''; ?></td>
			<td><?php echo $candidat->matricule; ?></td>
			<td><?php echo $candidat->nom.' '.$candidat->prenom;  ?></td>
			
						
			<td><?php echo rohi_is_empty($candidat->departement)?'':$candidat->departement; ?></td>
			<td><?php echo rohi_is_empty($candidat->direction)?'':$candidat->direction; ?></td>
			<td><?php echo rohi_is_empty($candidat->service)?'':$candidat->service;?></td>
			
			<td><?php echo isset($candidat->region['libele'])?$candidat->region['libele']:'';?></td>
			
			
			<!-- COMMENTAIRE DE VISUALISATION DE CV 
			<td><a href="#" onclick="openDetail('<//?php echo $candidat->id; ?>')"><i class="la la-list-alt"></i></a></td>-->
			
			<td><a href="#" onclick="deleteRespers(<?php echo $id;?>)"><i class="la la-remove"></i></a></td>
			<!-- AFFICHE VALIDER L'AGENT -->
			<?php if(isset($valide) ){?>
			<td><?php if($user['role']=="admin" || $user['role']=="chef"){?><a href="#" onclick="valider(<?php echo $candidat->id; ?>)">valider</a><?php }?></td>
			<?php }?>    

		 </tr>
		 <?php } ?>  
   </table>		
  </div>
  <script>
	function deleteRespers(id){
		var nom = $("#nom_"+id).val();
		var prenom = $("#prenom_"+id).val();
		var user_id = $("#user_id_"+id).val();
		var html = '';
		html += '<div class="row">';
		html += ' <div class="col-md-1"></div>';
		html += ' <div class="col-md-10" style="font-size:17px">Voulez-vous supprimer : <br> '+nom+ '  '+ prenom  +' <br> de la liste du responsable personnel</div>';
		html += ' <div class="col-md-1"></div>';
		html += '</div>';
		
		bootbox.dialog({
			title: "",
	        message: html,
	        show: true,
	        className: 'box_contrat',
			buttons: {
				success: {
					label: "OK",
					className: "btn-default",
					callback: function () {
						window.location = '<?php echo base_url();?>user/delete_respers/'+user_id; 
						return true;
					}
				},
				danger: {
					label: "Annuler",
					className: "btn-default",
					callback: function() {
						return true;
					}
				}
			}							
		});
	}
	
	function getSelectDep(json){
		var ret = '<select id="departement" class="form-control" onchange="changeDepartement()">';
		ret += '<option value="9999">------------</option>';
		json.forEach(function(row) {
			ret += '<option value="'+row['id']+'">'+row['libele']+'</option>';
		});
		ret+='</select>';
		return ret;
	}
	
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
	});
	
	function valider(id){
		var nom = $('#nom_'+id).val();
		var prenom = $('#prenom_'+id).val();
		bootbox.confirm("Voulez-vous validez l&acute;agent : "+nom+' '+prenom,
			function(result) { 
					if (result === false) {
										//Do nothing
					} else {
						document.location.href = "<?php echo base_url();?>cv/valide_cv/"+id;	
					}
			}
		); 
	}
	
	function openDetail(id){
		document.getElementById('headPrint').style.display = 'none';
		document.getElementById('footPrint').style.display = 'none';
		$('#popupDetail').show();
		$('#im').text('IM : '+$('#im_'+id).attr('value')); 
                $('#cin').text('CIN : '+$('#cin_'+id).attr('value')); 
		$('#date_depot').text($('#date_depot_'+id).attr('value')); 
		$('#nom_prenom').text($('#nom_'+id).attr('value')+' '+$('#prenom_'+id).attr('value')); 
                var sex = $('#sexe_'+id).attr('value');
		$('#sexe').text(sex); 
		$('#date_naiss').text('Ne(e) le '+$('#date_naiss_'+id).attr('value')); 
		$('#sit_mat').text($('#sit_mat_'+id).attr('value')); 
		$('#experience').text($('#experience_'+id).attr('value')); 
		$('#phone').text($('#phone_'+id).attr('value')); 
		$('#domaine').text($('#domaine_'+id).attr('value'));
		$('#dernier_emp').text($('#dernier_emp_'+id).attr('value'));
		$('#address').text($('#address_'+id).attr('value'));
		$('#niveau').text($('#niveau_'+id).attr('value')); 
		$('#photo').attr("src",$('#photo_'+id).attr('value')); 
		$('#editerPop').attr("href","<?php echo base_url();?>cv/edit_cv?id="+id); 
		$('#email').text($('#email_'+id).attr('value')); 
		$('#type_contrat').text($('#type_contrat_'+id).attr('value'));
		$('#diplome').text($('#diplome_'+id).attr('value'));
		$('#fonction_actuel').text($('#fonction_actuel_'+id).attr('value'));
		$('#dep').text($('#departement_'+id).attr('value'));
		$('#dir').text($('#direction_'+id).attr('value'));
		$('#serv').text($('#service_'+id).attr('value'));
		$('#division').text($('#division_'+id).attr('value'));
		$('#lacalite_service').text($('#lacalite_service_'+id).attr('value'));
		$('#date_maj').text($('#date_maj_'+id).attr('value'));
		$('#corps').text($('#corps_'+id).attr('value'));
		$('#grade').text($('#grade_'+id).attr('value'));
		$('#indice').text($('#indice_'+id).attr('value'));
		$('#date_service').text($('#date_service_'+id).attr('value'));
                
                $('#nbr_enfant').text("Enfant : "+$('#nbr_enfant_'+id).attr('value'));
                
                var conjoint = "";
                if(sex=='Feminin'){
                    conjoint = "Conjoint : "+$('#nom_conjoint_'+id).attr('value');
                }
                else
                    conjoint = "Conjointe : "+$('#nom_conjoint_'+id).attr('value');
                
		$('#nom_conjoint').text(conjoint);
                
                $('#dernier_emp').text($('#dernier_emp_'+id).attr('value'));
                $('#anciennete_der_emp').text($('#anciennete_der_emp_'+id).attr('value'));
                var loc_serv = $('#localite_service_'+id).attr('value');
                $('#localite_service').text(loc_serv);
                
		$('#modalDetail').modal(); 
	}
	
  </script>		