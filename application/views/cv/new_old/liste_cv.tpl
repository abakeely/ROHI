{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
 <section id="content">
        {include_php file=$zLeft}	
        <div id="ContentBloc">
			<h2>Liste de tous les agents</h2>
			<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> Agent MFB à valider</div>
			<div class="contenuePage">	
				
				<br><br><br>
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
						<th>Division</th>
						<th>R&eacute;gion</th>
						
						<th></th>
						{if $oData.valide}
						<th></th>
						{/if}
						<th></th>
					  </tr>
					</thead>
					
					<tbody>
					{assign var=ordre value="0"}
					{foreach from=$oData.list_candidat item=oCandidat}
						{assign var=ordre value=$ordre+1}
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
						
						<td>{if $oCandidat->region.libele}{$oCandidat->region.libele}{/if}</td>
						
						
						<!-- COMMENTAIRE DE VISUALISATION DE CV 
						<td><a href="#" onclick="openDetail('<//?php echo $candidat->id; ?>')"><i class="la la-list-alt"></i></a></td>-->
						
						<td><a href="{$zBasePath}cv2/mon_cv?id={$id}"><i class=""><i class="la la-share" aria-hidden="true"></i></a></td>
						 
						<!-- AFFICHE VALIDER L'AGENT -->
						{if $oData.valide}
						<td>{if $oData.oUser.role=="admin" || $oData.oUser.role=="chef"}<a href="#" onclick="valider({$id})">valider</a>{/if}</td>
						{/if}   
						<td><a href="{$zBasePath}cv2/add_to_my_dep/{$id}">Ajouter</i></a></td>
					 </tr>
					{/foreach} 
					</tbody>
			   </table>
			</div>
		
		</div>
		<link rel="stylesheet" href="{$zBasePath}assets/common/css/fullcalendar.min.css"/>
		<div id="calendar"></div>
    </section>

    <section id="rightContent" class="clearfix">
		{include_php file=$zRight}
	</section>
	{literal}
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
								document.location.href = "{/literal}{$zBasePath}{literal}cv2/valide_cv/"+id;	
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
				$('#editerPop').attr("href","<?php echo base_url();?>cv/mon_cv?id="+id); 
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
	{/literal}
    {include_php file=$zFooter}
</div>
</body>
</html>