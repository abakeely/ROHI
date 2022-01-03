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
								{* <h3 class="page-title">Agents > Situation irrégulière</h3> *}
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
										<li><a href="#saisieActe">Saisie de contenu</a></li>
										<li><a href="#Referentiels">Referentiels</a></li>
									</ul>
									<div id="saisieActe">
										{include file='application/views/traitementActe/block_saisie_preparation_projet.tpl'}
									</div>

									<div id="Referentiels">
										{include file='application/views/traitementActe/block_referentiels.tpl'}
									</div>
									
									<div class="panel-body">
										<div class="row">
											<div class="col-md-2">
												<a class="form-control btn-primary bouton" onclick="saveProjetActe()" type="submit"/><center>ENREGISTRER</center></a>
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
	$( ".datepicker" ).datepicker({
			dateFormat: "dd/mm/yy",
			showOtherMonths: true,
			selectOtherMonths: false,
	});
	$("#innerContent" ).tabs({
		  collapsible: true
	});
	
	$("#ticket_matricule").change(function(){
		getPosteAgentNumero();
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
					date_acte:$("#date_acte").val(),
				},
				success: function(data, textStatus, jqXHR) {  
					cleanFields();
					//alert(" Ticket Numero : "+data);
					alert(" Ticket Numero : "+data, 'Message de confirmation');
					window.location.href ="{/literal}{$zBasePath}{literal}traitementActe/saisieContenu?ticket_code="+data+"";
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
	//$("#ticket_poste_agent_numero").mask("9999999");  
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

function getPosteAgentNumero(){
	$.ajax({
		url: "{/literal}{$zBasePath}{literal}TraitementActe/getPosteAgentNumero/",
		type: 'post',
		data: {
			matricule: $("#ticket_matricule").val()
		},
		success: function(data, textStatus, jqXHR) {  		
			var list_poste	=	"<select class='form-control obligatoire' id='ticket_poste_agent_numero'>" ;
			var resultats = JSON.parse(data);
			/*list_poste	=	list_poste + "<option>"+"0"+$("#ticket_matricule").val()+"</option>" ;
			list_poste	=	list_poste + "<option>"+"1"+$("#ticket_matricule").val()+"</option>" ;
			list_poste	=	list_poste + "<option>"+"A"+$("#ticket_matricule").val()+"</option>" ;
			list_poste	=	list_poste + "<option>"+"B"+$("#ticket_matricule").val()+"</option>" ;*/
			for ( var iIndex = 0; iIndex<resultats.length ;iIndex++  ){
				list_poste	=	list_poste + "<option>"+resultats[iIndex].poste_agent_numero+"</option>" ;
			}
			list_poste	=	list_poste + "</select>" ;
		
			$("#wrap_poste_agent_numero").html(list_poste);
		}
	});
}

</script>
{/literal}