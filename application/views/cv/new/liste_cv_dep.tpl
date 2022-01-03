{include_php file=$zCssJs}
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
						    {function name=rohi_is_empty}
								{if $str == '999999' || $str == '9999' || $str == '0'}
									<td></td>
								{else}
									<td>{$str}</td>
								{/if}
							{/function}
							<h3 class="page-title">Liste des agents par direction</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item">Agent du MFB</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="col-xs-12">
					<div class="box">
							<div class="card-body">
									<form class="form-horizontal" role="form" name="cv" id="cv" action="create_cv" method="POST">
									<div class="col-md-12">
									<br>
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
											<th>Division</th>
											<th>R&eacute;gion</th>
											{if $oData.valide}
												<th></th>
											{/if}
											<th></th>
											<th></th>
											<th></th>
											
											
										  </tr>
										</thead>
										
										{assign var=ordre value="0"}
									{foreach from=$oData.list_candidat item=oCandidat}
										{assign var=ordre value=$ordre++}
										{assign var=id value=$oCandidat->id}
										{assign var=sexe value=''}
										{if $oCandidat->sexe == 1}
											{assign var=sexe value='Masculin'}
										{else}
											{assign var=sexe value='Feminin'}
										{/if}
									 
									 <tr>
										<input type="hidden" id="photo_{$id}" value="{$oCandidat->image_url}"/>
										<input type="hidden" id="ref_{$id}" value="{$id}"/>
										<input type="hidden" id="nom_{$id}" value="{$oCandidat->nom}"/>
										<input type="hidden" id="prenom_{$id}" value="{$oCandidat->prenom}"/>
										<input type="hidden" id="sexe_{$id}" value="{$sexe}"/>
										<input type="hidden" id="date_naiss_{$id}" value="{$oCandidat->date_naiss}"/>
										<input type="hidden" id="sit_mat_{$id}" value="{if $oCandidat->sit_mat.libele}{$oCandidat->sit_mat.libele}{/if}"/>
										<input type="hidden" id="phone_{$id}" value="{$oCandidat->phone}"/>
										<input type="hidden" id="address_{$id}" value="{$oCandidat->adress}"/>
										
													
										<input type="hidden" id="im_{$id}" value="{$oCandidat->matricule}"/>
										<input type="hidden" id="cin_{$id}" value="{$oCandidat->cin}"/>
										<input type="hidden" id="type_contrat_{$id}" value="{if $oCandidat->type_contrat}{$oCandidat->type_contrat}{/if}"/>
										<input type="hidden" id="fonction_actuel_{$id}" value="{$oCandidat->fonction_actuel}"/>
										<input type="hidden" id="departement_{$id}" value="{$oCandidat->departement}"/>
										<input type="hidden" id="direction_{$id}" value="{$oCandidat->direction}"/>
										<input type="hidden" id="service_{$id}" value="{$oCandidat->service}"/>
										<input type="hidden" id="division_{$id}" value="{$oCandidat->division}"/>
										<input type="hidden" id="email_{$id}" value="{$oCandidat->email}"/>
										<input type="hidden" id="localite_service_{$id}" value="{$oCandidat->lacalite_service}"/>
										<input type="hidden" id="diplome_{$id}" value="{if $oCandidat->diplome}{$oCandidat->diplome}{/if}"/>
										
										<input type="hidden" id="domaine_{$id}" value="{$oCandidat->domaine}"/>
										<input type="hidden" id="date_maj_{$id}" value="{$oCandidat->date_maj}"/>
										
										<input type="hidden" id="corps_{$id}" value="{$oCandidat->corps}"/>
										<input type="hidden" id="grade_{$id}" value="{$oCandidat->grade}"/>
										<input type="hidden" id="indice_{$id}" value="{$oCandidat->indice}"/>
										<input type="hidden" id="date_service_{$id}" value="{if $oCandidat->date_service}{$oCandidat->date_service}{/if}"/>
										
										<input type="hidden" id="nom_conjoint_{$id}" value="{if $oCandidat->nom_conjoint}{$oCandidat->nom_conjoint}{/if}"/>
										<input type="hidden" id="nbr_enfant_{$id}" value="{$oCandidat->nbr_enfant}"/>
										
									 
										
										<td style="width:10px">{$ordre}</td>
										<td>{if $oCandidat->statut.libele}{$oCandidat->statut.libele}{/if}</td>
										<td>{$oCandidat->matricule}</td>
										<td>{$oCandidat->nom} {$oCandidat->prenom}</td>
										
										{if $oCandidat->departement=='999999' || $oCandidat->departement=='9999' || $oCandidat->departement=='0'}
											<td></td>
										{else}
											<td>{$oCandidat->departement}</td>
										{/if}
										{if $oCandidat->direction=='999999' || $oCandidat->direction=='9999' || $oCandidat->direction=='0'}
											<td></td>
										{else}
											<td>{$oCandidat->direction}</td>
										{/if}
										{if $oCandidat->service=='999999' || $oCandidat->service=='9999' || $oCandidat->service=='0'}
											<td></td>
										{else}
											<td>{$oCandidat->service}</td>
										{/if}
										{if $oCandidat->division=='999999' || $oCandidat->division=='9999' || $oCandidat->division=='0'}
											<td></td>
										{else}
											<td>{$oCandidat->division}</td>
										{/if}
										
										<td style="cursor:pointer"  ="openCV({$id})">{if $oCandidat->region.libele}{$oCandidat->region.libele}{/if}</td>
										
										{if $oData.valide}
										<td>{if $oData.oUser.role=="admin" || $oData.oUser.role=="chef"}<a href="#" onclick="valider({$id})">valider</a>{/if}</td>
										{/if}  
										<td><a onclick="openPopup('{$id}')" href="#"><i class="la la-reply-all" aria-hidden="true" tada-toggle="tooltip" data-original-title = "Changement des Informations Admin"></i></a></td>
										<td><a  href="fpdf_fe/{$id}" target="_blank"><i class="la la-file-pdf-o" aria-hidden="true" tada-toggle="tooltip" data-original-title = "Fiche Evaluation" ></i></a></td>
										<td><a  href="mon_cv?id={$id}" target="_blank"><i class="la la-file-text-o" aria-hidden="true" tada-toggle="tooltip" data-original-title = "CV" ></i></a></td>
												
									 </tr>
									{/foreach}  
								   </table>		
								  </div>
								</form>
							
							</div>
					</div>
				</div>
		</div>
		<!-- /Page Content -->
			
	</div>
	<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->
{literal}
	<script>
	$(document).ready(function(){
		$('#dataTables-example').dataTable();
		$('i').tooltip();
	});
	function openCV(id){
		window.location = '{/literal}{$zBasePath}{literal}cv2/mon_cv?id='+id; 
	}
	
	function openPopup(id){
		var nom = $("#nom_"+id).val();
		var prenom = $("#prenom_"+id).val();
		
		var json = {/literal}{if $oData.list_departement && $oData.list_departement!=""}{$oData.list_departement}{else}1{/if}{literal};
		var jsonReg = {/literal}{if $oData.list_region && $oData.list_region!=""}{$oData.list_region}{else}1{/if}{literal};
		var html = '';
		html += '<div class="row">';
		html += ' <div class="col-md-1"></div>';
		html += ' <div class="col-md-10" style="font-size: 17px;">Veuillez choisir le nouveau D&eacute;partement, Direction, Service et Region de  : '+nom+ '  '+ prenom  +'</div>';
		html += ' <div class="col-md-1"></div>';
		html += '</div><br>';
		html += '<div class="row">';
		html += '   <div class="row">';
		html += '	    <div class="col-md-3 libele_form" ><label class="control-label">Nouveau D&eacute;partement</label></div>';
		html += '		<div class="col-md-8">'+  getSelectDep(json) + '</div>';
		html += '	    <div class="col-md-1"></div>';
		html += '   </div><br>';
		html += '   <div class="row">';
		html += '	    <div class="col-md-3 libele_form"><label class="control-label">Nouveau Direction</label></div>';
		html += '		<div class="col-md-8"><select onchange="changeDirection()" name="direction" id="direction" class="form-control"><option value="9999">------------</option></select></div>';
		html += '	    <div class="col-md-1"></div>';
		html += '   </div><br>';
		html += '   <div class="row">';
		html += '	    <div class="col-md-3 libele_form"><label class="control-label">Nouveau Service</label></div>';
		html += '		<div class="col-md-8"><select name="service" id="service" class="form-control"><option value="9999">------------</option></select></div>';
		html += '	    <div class="col-md-1"></div>';
		html += '   </div><br>';
		html += '   <div class="row">';
		html += '	    <div class="col-md-3 libele_form"><label class="control-label">Nouveau <br>Region</label></div>';
		html += '		<div class="col-md-8">'+  getSelectReg(jsonReg) + '</div>';
		html += '	    <div class="col-md-1"></div>';
		html += '   </div><br><br><br>';
		
		
		bootbox.dialog({
				title:"Changement des Informations Administratifs",	
			message: html,
			show: true,
			className: 'box_contrat',
			buttons: {
				success: {
					label: "Transf&eacute;rer",
					className: "btn-default",
					callback: function () {
						var dep = $('#departement').val();
						var dir = $('#direction').val();
						var serv = $('#service').val();
						var reg = $('#region').val();
						//alert('<?php echo base_url();?>cv/remove_from_my_dep/'+id+'/'+dep+'/'+dir+'/'+serv);
						window.location = '{/literal}{$zBasePath}{literal}cv2/remove_from_my_dep/'+id+'/'+dep+'/'+dir+'/'+serv+'/'+reg;
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

	function getSelectReg(json){
		var ret = '<select id="region" class="form-control" >';
		ret += '<option value="9999">------------</option>';
		json.forEach(function(row) {
			ret += '<option value="'+row['id']+'">'+row['libele']+'</option>';
		});
		ret+='</select>';
		return ret;
	}
	function valider(id){
		var nom = $('#nom_'+id).val();
		var prenom = $('#prenom_'+id).val();
		bootbox.confirm("Voulez-vous validez l&acute;agent : "+nom+' '+prenom,
			function(result) { 
					if (result === false) {
						//Do nothing
					} else {
						document.location.href = "{/literal}{$zBasePath}{literal}cv/valide_cv/"+id;	
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
		$('#editerPop').attr("href","{/literal}{$zBasePath}{literal}cv/mon_cv?id="+id); 
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
{/literal}
{include_php file=$zFooter}
		