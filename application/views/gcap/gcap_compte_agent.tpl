{include_php file=$zCssJs}
<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								{* <h3 class="page-title">Saisie du contenu du projet d'acte</h3> *}
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Suivi des actes</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="clear"></div>
								<div id="innerContent">
									<ul class="tabs">
										<li><a href="#mes_decisions">Mes d&eacute;cisions</a></li>
									</ul>
									<div id="mes_decisions">
										<div class="panel-body">
											<h3>Information de l'acte</h3>
										</div>
										<div class="row">
											<input type="hidden" value="INITIATLISATION_DU_PROJET_ACTE" id="ticket_niveau"/>
											<div class="form col-md-2">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Numero du projet(*) </b></label>
												</div>
												<input type="text" class="form-control obligatoire" placeholder="Numero de l'acte"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ticket_sigle" value="">
											</div>
											<div class="form col-md-3">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Designation de l'acte(*) </b></label>
												</div>
												<!--input type="text" class="form-control obligatoire" placeholder="Decret / Arrete / Decision"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ticket_designation" value=""-->
												<select id="ticket_designation" name="ticket_designation" class="form-control obligatoire" placeholder="Mouvement" data-placement="top" data-toggle="tooltip">
													<option  value="--select--">Selectionner</option>
													<option  value="Decret">Decret</option>
													<option  value="Arrete">Arrete</option>
													<option  value="Decison">Decison</option>
												</select>
											</div>
											<div class="form col-md-7">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Portant(*) </b></label>
												</div>
												<input type="text" class="form-control obligatoire" placeholder="Portant"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ticket_libelle" value="">
											</div>
										</div>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-4">
												<a class="form-control btn-primary bouton" onclick="saveProjetActe()" type="submit"/>ENREGISTRER</a>
											</div>
										</div>
									</div>
								</div>   
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
					
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}          
		
							
{literal}
<script>
$(document).ready(function() {
	setMask();
	$("#innerContent" ).tabs({
		  collapsible: true
	});
});

function saveProjetActe(){
	var iValide	=	validateFields();
	if(iValide == 1){
		$.ajax({
				url: "{/literal}{$zBasePath}{literal}TraitementActe/saveProjetActe/",
				type: 'post',
				data: {
					ticket_poste_agent_numero: $("#ticket_poste_agent_numero").val(),
					ticket_libelle: $("#ticket_libelle").val(),
					ticket_processus_code: $("#ticket_processus_code").val(),
					ticket_commentaire: $("#ticket_commentaire").val(),
					ticket_sigle: $("#ticket_sigle").val(),
					ticket_designation: $("#ticket_designation").val(),
					ticket_niveau: $("#ticket_niveau").val(),
				},
				success: function(data, textStatus, jqXHR) {  
					cleanFields();
					//alert(" Ticket Numero : "+data);
					jAlert(" Ticket Numero : "+data, 'Message de confirmation');
				}
		});
	}
}

function cleanFields(){
	$(".form-control").each (function (){
		$(this).val("");
	}) ;
}

function validateFields(){
	var iValide = 1;
	$(".obligatoire").each (function (){
		if($(this).val()=="" || $(this).val()=="--select--"){
			$(this).addClass("required");
			iValide = 0;
		}else{
			$(this).removeClass("required");
		}
	}) ;

	return iValide;
}

function setMask(){
	$("#ticket_poste_agent_numero").mask("9999999");  
}

function setSubCategory(p_categoryTable,p_categoryField,p_categoryValue,p_subCategory_id){
	$("#"+p_subCategory_id).html("");
	var html = "" ;
	$.ajax({
		url: "{/literal}{$zBasePath}{literal}Referentiel/getSubCategory/",
		type: 'post',
		data: {
			p_categoryTable: p_categoryTable,
			p_categoryField: p_categoryField,
			p_categoryValue: p_categoryValue
		},
		success: function(data, textStatus, jqXHR) {  
			var resultats = JSON.parse(data);
			for ( var iIndex = 0; iIndex<resultats.length ;iIndex++  ){
				html = html + "<option value='"+resultats[iIndex].projet_code+"'>"+resultats[iIndex].projet_libelle+"</option>";
			}
			$("#"+p_subCategory_id).append(html);
		}
	}); 

	return false;
}

</script>
{/literal}