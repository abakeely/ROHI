{include_php file=$zCssJs}
<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<link rel="stylesheet" href="{$zBasePath}assets/common/css/fullcalendar.min.css"/>
<link rel="stylesheet" href="{$zBasePath}assets/css/statistique.css"/>
<script src="{$zBasePath}assets/easyweb/js/primitives.min.js"></script>
<link href="{$zBasePath}assets/easyweb/css/primitives.css" rel="stylesheet">

<script src="{$zBasePath}assets/easyweb/js/jquery.jqGrid.min.js"></script>
<script src="{$zBasePath}assets/easyweb/js/grid.locale-en.js"></script>
<script src="{$zBasePath}assets/easyweb/js/jstree.min.js"></script>

<link href="{$zBasePath}assets/easyweb/css/jquery-ui-1.10.4.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery.jqGrid.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery_grid_customize.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jstree.css" rel="stylesheet">
<script src="{$zBasePath}assets/message/js/mustache.js"></script>
		<!-- Main Wrapper -->
			<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								{* <h3 class="page-title">{$oData.zLibelle}</h3> *}
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
								<div id="tab_menu">
										<ul class="tabs">
											<li><a  href="{$zBasePath}/GestionStructure/index">Gestion organigramme</a></li>
											<li><a  href="{$zBasePath}/GestionStructure/rapprochement">Rapprochement des agents</a></li>
											<!--li><a  href="{$zBasePath}/GestionStructure/statistiques">Statistiques</a></li-->
											<li><a  href="{$zBasePath}/GestionStructure/evaluation">Evaluation</a></li>
											<li><a  href="{$zBasePath}/GestionStructure/rapprochementEnMasse">Rapprochement en masse</a></li>
											<li><a  href="{$zBasePath}/GestionStructure/outilRH">Outil RH</a></li>
											<!--li><a  href="{$zBasePath}/GestionStructure/administration">Administration</a></li-->
										</ul> 
										<div id="organigramme_link">
											{$oData.zTemplate}
										</div>
									
								</div>             
			
								<input type="hidden" id="div_localite_curent">
								<input type="hidden" id="div_structure_curent">
								<input type="hidden" id="curent_page">

								<div style="display:none;" id="template_structure" >
									<div class="form col-md-3" id="structure_niveau_[[source.niveau]]">
										<div class="libele_form">
											<label class="control-label label_rohi " data-original-title="" title=""><b> [[source.libelle]](*) </b></label>
										</div>
										[[#source]]
										<select class="form-control"   onChange="getChild($(this),[[source.niveau]]);"   name="[[source.name]]">
											<option  value="0">-------</option> 
											[[#list]]
											<option value="[[child_id]]">[[child_libelle]]</option>
											[[/list]]
										</select>
										[[/source]]
									</div>
								</div>

								<div style="display:none;" id="template_localite" >
									<div class="form col-md-3" id="localite_niveau_[[source.niveau]]">
										<div class="libele_form">
											<label class="control-label label_rohi " data-original-title="" title=""><b> [[source.libelle]](*) </b></label>
										</div>
										[[#source]]
										<select class="form-control" onChange="getLocalite($(this),'[[source.niveau_suivant]]',[[source.niveau]]);" id="[[source.name]]_id" name="[[source.name]]">
											<option  value="0">-------</option> 
											[[#list]]
											<option value="[[localite_id]]">[[localite_libelle]]</option>
											[[/list]]
										</select>
										[[/source]]
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
<style>
	th {
		width: 41px !important;
		color:#a88484 !important;
	}
</style>
<script>
$(document).ready(function() {
	$("#div_localite_curent").val("div_localite_organigramme");
	$("#div_structure_curent").val("div_structure_organigramme");
	$("#curent_page").val("organigramme");
	/*$("#tab_menu" ).tabs({
		  collapsible: true
	});*/
});

function setCurent(tab){
	$("#div_localite_curent").val("div_localite_"+tab);
	$("#div_structure_curent").val("div_structure_"+tab);
	$("#curent_page").val(tab);
}

function getLocalite(curent_element,type_localite,niveau){
	var val_curent_element = curent_element.val() ;
	var div_localite	   = $("#div_localite_curent").val();
	var div_structure	   = $("#div_structure_curent").val();
	var structure_name	   = "";
	if(niveau == 1){
		var libelle			= "Province";
		var niveau_suivant	= "REGION";
		structure_name	    = "province";
	}
	if(niveau == 2){
		var libelle			= "Regions";
		var niveau_suivant  = "DISTRICT";
		structure_name	    = "regions";
	}
	if(niveau == 3){
		var libelle			= "District";
		var niveau_suivant = "";
		structure_name	    = "district";
	}
	if(niveau == 4){
		getDepartementByDistrictid(val_curent_element);
	}


	if (niveau<4){
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}GestionStructure/getLocalite/",
			type: 'post',
			data: {
				parent_id	: val_curent_element,
				type_localite	: type_localite
			},
			success: function(data, textStatus, jqXHR) {  
				for( var iIndex = niveau+1;iIndex<20;iIndex++){
					$('#localite_niveau_'+iIndex).remove();
				}
				data = data.replace("not allowed ", "");
				var donnees					=	JSON.parse(data);
				if(donnees.length > 0){
					var structure				= {};
					structure.libelle			= libelle;
					structure.list				= donnees;
					structure.name				= structure_name;
					structure.niveau			= niveau+1;
					structure.niveau_suivant	= niveau_suivant;
					Mustache.tags				= ["[[", "]]"];
					var template_child			= $('#template_localite').html();
					Mustache.parse(template_child);
					var rendered				= Mustache.render(template_child, {source :structure});
					//alert('#'+div_localite);
					$('#'+div_localite).append(rendered);
				}
				
			}
		});
	}
}


function getDepartementByDistrictid(district_id){
	var niveau = 0;
	$.ajax({
		url: "{/literal}{$zBasePath}{literal}GestionStructure/getDepartementByDistrictid/",
		type: 'post',
		data: {
			district_id	: district_id,
			tree_type	: "DEPT"
		},
		success: function(data, textStatus, jqXHR) {  
			for( var iIndex = niveau+1;iIndex<20;iIndex++){
				$('#structure_niveau_'+iIndex).remove();
			}
			data = data.replace("not allowed ", "");
			var donnees					=	JSON.parse(data);
			
			if(donnees.length > 0){
				var structure				= {};
				structure.libelle			= "Departement";
				structure.list				= donnees;
				structure.niveau			= niveau+1;
				Mustache.tags				= ["[[", "]]"];
				var template_structure			= $('#template_structure').html();
				Mustache.parse(template_structure);
				var rendered				= Mustache.render(template_structure, {source :structure});
				if ( $("#curent_page").val() == "organigramme" ){
					$('#div_org').append(rendered);
				}else{
					$('#div_rap').append(rendered);
				}
			}
		}
	});
}

function getChild(curent_element,niveau){
	var val_curent_element = curent_element.val() ;
	getDetailStructure(val_curent_element);
	$("#parent_id").val(val_curent_element);

	$.ajax({
		url: "{/literal}{$zBasePath}{literal}GestionStructure/getChild/",
		type: 'post',
		data: {
			parent_id	: val_curent_element,
			tree_type	: "2",//CHILD DIRECT: 1 ,  CHILD HIERACHIQUE: 2 
			district_id:$("#district_id").val()
		},
		success: function(data, textStatus, jqXHR) {  
			for( var iIndex = niveau+1;iIndex<20;iIndex++){
				$('#structure_niveau_'+iIndex).remove();
			}
			data = data.replace("not allowed ", "");
			var donnees					=	JSON.parse(data);
			if(donnees.length > 0){
				var structure				= {};
				structure.libelle			= "Structure Fils";
				structure.list				= donnees;
				structure.niveau			= niveau+1;
				Mustache.tags				= ["[[", "]]"];
				var template_structure		= $('#template_structure').html();
				Mustache.parse(template_structure);
				var rendered				= Mustache.render(template_structure, {source :structure});
				if ( $("#curent_page").val() == "organigramme" ){
					$('#div_org').append(rendered);
				}else{
					$('#div_rap').append(rendered);
				}
				
			}
		}
	});
}


function getDetailStructure(curent_element){
	$.ajax({
		url: "{/literal}{$zBasePath}{literal}GestionStructure/getDetailStructure/",
		type: 'post',
		data: {
			child_id	: curent_element,
		},
		success: function(data, textStatus, jqXHR) {  
			data = data.replace("not allowed ", "");
			var donnees					= JSON.parse(data);
			$("#soa_code").val(donnees.soa_code);
			$("#path").val(donnees.path);
			$("#structure_id").val(donnees.child_id);
		}
	});
}
</script>
{/literal}
</body>
</html>