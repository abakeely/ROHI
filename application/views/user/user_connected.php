 <?php $this->load->view('cv/details_cv');?>
 <div id="content-wrap" class="row"> 

  <form class="form-horizontal" role="form" name="cv" id="cv" action="create_cv" method="POST">
	<div class="col-md-12">
		<br>
		<div class="text-center" > 
			<h4><font color="DarkSlateGray">Listes des Agents conn&eacute;ct&eacute;s</font></h4>
		</div>
	<br>
	<hr>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	     <thead>
		   <tr >
			<th style="width:10px"><font size="2"><font face="Times New Roman">Ordre</font></font></th>
			<th style="width:15px"><font size="2"><font face="Times New Roman">IM</font></font></th>
			<th><font size="2"><font face="Times New Roman">Nom</font></font></th>
			<th><font size="2"><font face="Times New Roman">Pr&eacute;noms</font></font></th>
			<th><font size="2"><font face="Times New Roman">D&eacute;partement</font></font></th>
			<th><font size="2"><font face="Times New Roman">Direction</font></font></th>
			<th><font size="2"><font face="Times New Roman">Service</font></font></th>
			<th><font size="2"><font face="Times New Roman">Localite de service</font></font></th>
			<th><font size="2"><font face="Times New Roman">IP</font></font></th>
		  </tr>
	    </thead>
		
		<?php 
		$ordre = 0;
		foreach ($list_user as $user){ 
			$ordre++;
			
		?>  
		 <tr>
			<td style="width:10px"><?php echo $ordre; ?></td>
			<td style="width:15px"><?php echo $user['im']; ?></td>
			<td><?php echo $user['nom']; ?></td>
			<td><?php echo $user['prenom']; ?></td>
			<td><?php echo $user['dep']; ?></td>
			<td><?php echo $user['dir']; ?></td>
			<td><?php if(isset($user['ser'])) echo $user['ser']; ?></td>
			<td><?php if(isset($user['local_serv'])) echo $user['local_serv']; ?></td>
			<td><?php echo $user['ip']; ?></td>
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
		$('#departement').text($('#departement_'+id).attr('value'));
		$('#direction').text($('#direction_'+id).attr('value'));
		$('#service').text($('#service_'+id).attr('value'));
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