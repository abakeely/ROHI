 <?php $this->load->view('cv/details_cv');?>
 <div id="content-wrap" class="row"> 

  <form class="form-horizontal" role="form" name="cv" id="cv" action="create_cv" method="POST">
	<div class="col-md-12">
		<br>
		<!-- 
   <div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<a href="new_cv" class="btn btn-primary form-control">Ajout nouveau candidat(e)</a>
					</div>
					<div class="col-md-7"></div>
	</div>
	-->
	<div class="row separateur"><div class="col-md-12">Listes des Agents conn&eacute;ct&eacute;s</div></div>
	<br>
	<hr>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	     <thead>
		   <tr >
			<th>Ordre</th>
			<th>IP</th>
			<th>Last activity</th>
			<th>Data</th> 
			<th>Navigateur</th> 
		  </tr>
	    </thead>
		
		<?php 
		$ordre = 0;
		foreach ($list_session as $session){ 
			$ordre++;
			
		?>  
		 <tr>
			<td><?php echo $ordre; ?></td>
			<td><?php echo $session->ip_address; ?></td>
			<td><?php echo $session->session_id; ?></td>
			<td><?php echo $session->user_data; ?></td>
			<td><?php echo $session->user_agent; ?></td>
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