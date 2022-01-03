
 <style>
 	.modal-header .modal-footer{
 		background : #91c149;
 	}
 </style>
 <div id="content-wrap" class="row"> 
	<div class="col-md-12">
		<br>
		<div class="text-center" > 
			<h4><font color="DarkSlateGray">Mouvement</font></h4>
		</div>
	<br>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	     <thead>
		   <tr >
			<th style="width:10px">Ordre</th>
			<th>Agent</th>
			<th>Respers</th>
			<th>Ancien D&eacute;pt/Dir/Sce</th>
			<th>Nouveau D&eacute;pt/Dir/Sce</th>
			<th>Situation</th>
			<th>Date</th>
		  </tr>
	    </thead>
		
		<?php 
		$ordre = 0;
		foreach ($list_mvt as $mvt){ 
			$ordre++;
			
		?>  
		 <tr>
			
			<td style="width:10px"><?php echo $ordre; ?></td>
			<td><?php echo $mvt['candidat_nom']; ?></td>
			<td><?php echo  $mvt['resp_nom'];?></td>
			<td><?php echo $mvt['old_dep_str']; ?></td>
			<td><?php echo $mvt['new_dep_str']; ?></td>
			<td><?php echo  $mvt['type'];?></td>
			<td><?php echo  $mvt['date'];?></td>
			         
		 </tr>
		 <?php } ?>  
   </table>		
  </div>
  <script>

  function openPopup(id){
		var nom = $("#nom_"+id).val();
		var prenom = $("#prenom_"+id).val();
		var json = [];
		<?php if(isset($list_service)){?>
		json = <?php echo $list_service;?>;
		<?php }?>
		var html = '';
		html += '<div class="row">';
		html += ' <div class="col-md-1"></div>';
		html += ' <div class="col-md-10" style="font-size: 17px;">Veuillez choisir le service de : '+nom+ '  '+ prenom  +'</div>';
		html += ' <div class="col-md-1"></div>';
		html += '</div><br>';
		html += '<div class="row">';
		html += '   <div class="row">';
		html += '	    <div class="col-md-3 libele_form" ><label class="control-label">Service</label></div>';
		html += '		<div class="col-md-8">'+  getSelectService(json) + '</div>';
		html += '	    <div class="col-md-1"></div>';
		html += '   </div><br>';
		
		bootbox.dialog({
			title: "Message de confirmation",
	        message: html,
	        show: true,
	        className: 'box_contrat',
			buttons: {
				success: {
					label: "RENVOYER",
					className: "btn-default",
					callback: function () {
						var serv = $('#service').val();
						window.location = '<?php echo base_url();?>cv/add_to_my_dep/'+id+'/'+serv; 
						return true;
					}
				},
				danger: {
					label: "ANNULER",
					className: "btn-default",
					callback: function() {
						return true;
					}
				}
			}							
		});
	}
	
	function getSelectService(json){
		var ret = '<select id="service" class="form-control" onchange="changeDepartement()">';
		ret += '<option value="9999">------------</option>';
		json.forEach(function(row) {
			ret += '<option value="'+row['id']+'">'+row['libele']+'</option>';
		});
		ret+='</select>';
		return ret;
	}
	
	function changeDepart(){
           var valeur = $('#departement').val();
           $.ajax({
                    url: base_url() + "json/direction/"+valeur,
                    type: 'get',
                    success: function(data, textStatus, jqXHR) {
                          var obj = jQuery.parseJSON(data);
                          $('#direction').html('');
                          var select_option ='';
                          var exist = false;
                          select_option += '<option value="999999">------</option>';
                          obj.forEach(function(module) {
                              select_option += '<option value="'+module['id']+'">'+module['libele']+'</option>';
                              exist = true;
                          });
                          select_option += '<option value="0">AUTRES</option>';
                          if(!exist){
                              $('#service').html('');
                              $('#service').html(select_option);
                              $('#division').html('');
                              $('#division').html(select_option);
                          }
                          $('#direction').html(select_option);
                    },
                    async: false
            });
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