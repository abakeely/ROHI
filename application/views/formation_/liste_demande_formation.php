 <?php $this->load->view('formation/liste_demande_formation');?>
 <div id="content-wrap" class="row"> 

  <form class="form-horizontal" role="form" name="formation" id="formation" action="ajout_demande_formation" method="POST">
	<div class="col-md-12">
	<br>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	     <thead>
		   <tr >
			<th>Ordre</th>
			<th>Statut</th>
			<th>IM</th>
			<th>Nom et Pr&eacute;noms</th>
			<th>Departement</th>
			<th>Direction</th>
			<th>Service</th>
			<th>Region</th>
			<th>T&eacute;l&eacute;phone</th>
			<th>R&eacute;gion</th>
			<th>    </th>
		  </tr>
	    </thead>
		
		<?php 
		$ordre = 0;
		foreach ($list_candidat as $candidat){ 
			$ordre++;
			$id = $candidat->id; 			
		?>  
		 <tr>
			<input type="hidden" id="photo_<?php echo $id;?>" value="<?php echo $candidat->image_url;?>"/>
			<input type="hidden" id="ref_<?php echo $id;?>" value="<?php echo $candidat->id;?>"/>
			<input type="hidden" id="nom_<?php echo $id;?>" value="<?php echo $candidat->nom;?>"/>
			<input type="hidden" id="prenom_<?php echo $id;?>" value="<?php echo $candidat->prenom;?>"/>
			<input type="hidden" id="phone_<?php echo $id;?>" value="<?php echo $candidat->phone;?>"/>
			<input type="hidden" id="address_<?php echo $id;?>" value="<?php echo $candidat->address;?>"/>
			
                        
			<input type="hidden" id="im_<?php echo $id;?>" value="<?php echo $candidat->matricule;?>"/>
			<input type="hidden" id="departement_<?php echo $id;?>" value="<?php echo $candidat->departement;?>"/>
			<input type="hidden" id="direction_<?php echo $id;?>" value="<?php echo $candidat->direction;?>"/>
			<input type="hidden" id="service_<?php echo $id;?>" value="<?php echo $candidat->service;?>"/>
			<input type="hidden" id="email_<?php echo $id;?>" value="<?php echo $candidat->email;?>"/>
			<input type="hidden" id="diplome_<?php echo $id;?>" value="<?php echo $candidat->diplome;?>"/>
			
			<input type="hidden" id="domaine_<?php echo $id;?>" value="<?php echo $candidat->domaine;?>"/>
			
			<input type="hidden" id="corps_<?php echo $id;?>" value="<?php echo $candidat->corps;?>"/>
			<input type="hidden" id="grade_<?php echo $id;?>" value="<?php echo $candidat->grade;?>"/>
			<input type="hidden" id="indice_<?php echo $id;?>" value="<?php echo $candidat->indice;?>"/>
			
			<td><?php echo $ordre; ?></td>
			<td><?php echo $candidat->statut['libele']; ?></td>
			<td><?php echo $candidat->matricule; ?></td>
			<td><?php echo $candidat->nom.' '.$candidat->prenom;  ?></td>
			
						
			<td><?php echo ($candidat->departement==999999)?'':$candidat->departement; ?></td>
			<td><?php echo ($candidat->direction==999999)?'':$candidat->direction; ?></td>
			<td><?php echo ($candidat->service==999999)?'':$candidat->service;?></td>
			<td><?php echo ($candidat->division==999999)?'':$candidat->division;?></td>
			
			<td><?php echo $candidat->phone; ?></td>
			<td><?php echo isset($candidat->region['libele'])?$candidat->region['libele']:'';?></td>
			
			<!-- COMMENTAIRE DE VISUALISATION DE CV 
			<td><a href="#" onclick="openDetail('<//?php echo $candidat->id; ?>')"><i class="la la-list-alt"></i></a></td>-->
			
			<td><a href="<?php echo base_url();?>cv/edit_cv?id=<?php echo $candidat->id; ?>"><i class="la la-edit"></i></a></td>
			<!-- AFFICHE VALIDER L'AGENT -->
			<?php if(isset($valide) ){?>
			<td><?php if($user['role']=="admin"){?><a href="#" onclick="valider(<?php echo $candidat->id; ?>)">valider</a><?php }?></td>
			<?php }?>          
		 </tr>
		 <?php } ?>  
   </table>		
  </div>
  <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
	});
	
	function valider(id){
		var nom = $('#nom_'+id).val();
		var prenom = $('#prenom_'+id).val();
		bootbox.confirm("Voulez-vous validez l&cute;agent : "+nom+' '+prenom,
			function(result) { 
					if (result === false) {
										//Do nothing
					} else {
						document.location.href = "<?php echo base_url();?>cv/valide_cv/"+id;	
					}
			}
		); 
	}
	
	       
		$('#modalDetail').modal(); 
	}
	
  </script>		