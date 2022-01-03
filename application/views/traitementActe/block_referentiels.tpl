<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
<div id="saisieActe">
	<div class="panel-body">
		<h3>Referentiels</h3>
	</div>
	<div class="row">
		<input type="hidden" value="INITIATLISATION_DU_PROJET_ACTE" id="ticket_niveau"/>
		<div class="form col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Type(*) </b></label>
			</div>
			<select class="form-control" name="type_refentiel" id="type_refentiel" onchange="referentiel()">
				<option value="--choise--">-Choisir-</option>
				<option value="t_agent_situation">Agents de l'Etat</option>
				<option value="t_corps">Corps</option>
				<option value="t_indicegrd">Corps/Grade/Indice</option>
				<option value="t_mouvement">Mouvement</option>
				<option value="t_affectation">Historiques affectations</option>
				<option value="t_avance">Historiques avancements</option>
				<option value="t_ministere">Ministere</option>
				<option value="departement">Departement</option>
				<option value="direction">Direction</option>
				<option value="service">Service</option>
			</select>
		</div>
	</div>
	<div class="row">
		<table id="table-liste-extrants">
			<thead>
            
			</thead>
		</table>
	</div>
</div>
{literal}
<script>
	var dataPlan = {$oData.jsonData};
</script>
<script>
	function referentiel(){
		
		var type_refentiel	=	$("#type_refentiel").val() ;
		if( type_refentiel == "t_agent_situation"){
			var thead		=	["Nom","Prenoms","Matricule","Cin","Corps","Grade","Indice","Telephone"];
			var zColum		=	"agent_nom,agent_prenoms,agent_matricule,agent_cin,corps_code,grade_code,indice,agent_numero_tel";
		}
		if( type_refentiel == "t_corps"){
			var thead		=	["Corps code","Corps libelle","Categorie code"];
			var zColum		=	"corps_code,corps_libelle,categorie_code";
		}
		if( type_refentiel == "t_mouvement"){
			var thead		=	["Mouvement code","Mouvement libelle"];
			var zColum		=	"mouvement_code,mouvement_libelle";
		}
		if( type_refentiel == "t_ministere"){
			var thead		=	["Ministere code","Ministere libelle"];
			var zColum		=	"min_code,min_libelle";
		}
		if( type_refentiel == "t_affectation"){
			var thead		=	["Numero d'enregistrement","Matricule","Commune","Fivondronana","Section","Date affectation"];
			var zColum		=	"acte_numero_enreg,agent_matricule,commune_code,fiv_code,section_code,agent_affectation_date";
		}
		if( type_refentiel == "t_avance"){
			var thead		=	["Numero d'enregistrement","Matricule","Coprs","Grade","Categorie","Date avance","Rang"];
			var zColum		=	"acte_numero_enreg,agent_matricule,corps_code,grade_code,categorie_code,avance_date,avance_rang";
		}
		if( type_refentiel == "departement"){
			var thead		=	["Identifiant","Libelle","Sigle"];
			var zColum		=	"id,libele,sigle_departement";
		}
		if( type_refentiel == "direction"){
			var thead		=	["Identifiant","Libelle","Sigle"];
			var zColum		=	"id,libele,sigle_direction";
		}
		if( type_refentiel == "service"){
			var thead		=	["Identifiant","Libelle","Sigle"];
			var zColum		=	"id,libele,sigle_service";
		}
		if( type_refentiel == "t_indicegrd"){
			var thead		=	["Corps code","Corps libelle","Categorie Code","Grade code","Indice","Grade precedent","Grade suivant"];
			var zColum		=	"corps_code,corps_libelle,categorie_code,grade_code,indice,grade_precedent,grade_suivant";
		}
		var zHead			=    "<tr>";
	    for( var iIndex = 0;iIndex < thead.length;iIndex++){
			zHead			=    zHead + "<th>"+thead[iIndex]+"</th>";
	    }
			zHead			=    zHead + "</tr>";

		$('#table-liste-extrants thead').html(zHead);
		if ($.fn.DataTable.isDataTable('#table-liste-extrants')) {
			$('#table-liste-extrants').DataTable().destroy();
		}
		$('#table-liste-extrants tbody').empty();
		var table = $('#table-liste-extrants').DataTable( {
			"processing": true,
			"serverSide": true,
			"ordering": true,
			"order": [[ 0, "desc" ]],
			"pageLength": 5,
			"ajax":{
				url :"{/literal}{$zBasePath}{literal}Referentiel/ajaxDataTable", 
				data: function ( d ) {
					d.type_refentiel=type_refentiel,
					d.zColum=zColum
				},
				type: "post",  
				error: function(){  
				}
			}
		});
	}

</script>
{/literal}