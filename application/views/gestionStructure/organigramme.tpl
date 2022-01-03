
<div class="panel-body">
	<div  class="col-md-4">
		<div  id="jqGridArborescence" style="max-width:500px;height:500px;overflow:auto"></div>
	</div>
	<div  class="col-md-8">
		<div id="basicdiagram" style="width:100%;height:495px; border-style: solid;overflow:hidden;" />
	</div>
</div>

<div  id="div_creation_structure" style="display:none;">
	<form  name="formulaireCreationStructure" id="formulaireCreationStructure" enctype="multipart/form-data">
	<input type="hidden"   name="parent_id" id="parent_id">
	<h3>Structure de rattachement</h3>
	<div class="row" id="div_structure_organigramme"></div>
	<div class="row">
		<div class="col-md-5">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Structure libelle(*) </b></label>
			</div>
			<input type="text" class="form-control obligatoire" placeholder="Structure libelle"  name="add_child_libelle" data-placement="top" data-toggle="tooltip" data-original-title="Structure libelle"  id="add_child_libelle">
		</div>
		<div class="col-md-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Structure rang(*) </b></label>
			</div>
			<select  class="form-control" placeholder="rang" name="add_rang" id="add_rang" data-toggle="tooltip">
				<option  value="0">-------</option> 
				<option  value="DEPT">Departement</option> 
				<option  value="DIR">Direction</option> 
				<option  value="SCE">Service</option> 
				<option  value="DIV">Division</option> 
				<option  value="BUR">Bureau</option> 
			</select>

		</div>
		<div class="col-md-4">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Soa code(*) </b></label>
			</div>
			<input type="text" class="form-control obligatoire" placeholder="Soa code"  name="add_soa_code" data-placement="top" data-toggle="tooltip" data-original-title="Soa code"  id="add_soa_code">
		</div>
	 </div>
	<div class="row">
		
		<div class="col-md-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Structure sigle(*) </b></label>
			</div>
			<input type="text" class="form-control obligatoire" placeholder="Structure sigle"  name="add_sigle" data-placement="top" data-toggle="tooltip" data-original-title="Structure sigle"  id="add_sigle">
		</div>
		<div class="col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> &nbsp;</b></label>
			</div>
			<input id="btnCreateStructure" class="form-control btn-primary bouton"  value="ENREGISTRER" />
		</div>
	 </div>
  </form>
</div>

<div  id="div_add_user" style="display:none;">
	<form  name="formulaireRapprochementUnitaire" id="formulaireRapprochementUnitaire" enctype="multipart/form-data">
	<input type="hidden"   name="child_rapprochement_unitaire" id="child_rapprochement_unitaire">
	<h3>Rapprochement Unitaire</h3>
	<div class="row">
		<div class="col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Statut(*) </b></label>
			</div>
			<select onchange="selectStatutAgent($(this))" class="form-control" id="rapprochement_unitaire_statut_agent" name="rapprochement_unitaire_statut_agent" data-toggle="tooltip">
				<option  value="FONCTIONNAIRE" selected="selected">Fonctionnaire/EFA/HEE</option> 
				<option  value="ECD">ECD</option> 
			</select>
		</div>
		<div class="col-md-2" id="block_edit_matricule">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Matricule(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Matricule"  id="rapprochement_unitaire_matricule" name="rapprochement_unitaire_matricule" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="rapprochement_unitaire_matricule" value="" >
		</div>
		<div class="col-md-3" id="block_edit_cin">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> CIN(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="CIN"  id="rapprochement_unitaire_cin" name="rapprochement_unitaire_cin" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  value="" >
		</div>
		<div class="col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Type(*) </b></label>
			</div>
			<select  class="form-control" placeholder="rapprochement_unitaire_type_agent" id="rapprochement_unitaire_type_agent" name="rapprochement_unitaire_type_agent" data-toggle="tooltip">
				<option  value="AUTORITE">Autorite</option> 
				<option  value="RESPERS">Responsable Pers</option> 
				<option  value="EVALUATEUR">Evaluateur</option> 
				<option  value="PREMIER_RESPONSABLE">Premier responsable</option> 
				<option  value="AGENT" selected="selected">Agent</option> 
				
				<option  value="AGENT-AUTORITE" >Agent-Autorite</option> 
				<option  value="AGENT-RESPERS" >Agent-Responsable Pers</option> 
				<option  value="AGENT-EVALUATEUR" >Agent-Evaluateur</option> 
				<option  value="AGENT-PREMIER_RESPONSABLE" >Agent-Premier responsable</option> 
				
				
			</select>
		</div>
		<div class="col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Opération(*) </b></label>
			</div>
			<select  class="form-control" placeholder="rapprochement_unitaire_type_operation" id="rapprochement_unitaire_type_operation" name="rapprochement_unitaire_type_operation" data-toggle="tooltip">
				<option  value="AJOUTER">Ajouter</option> 
				<option  value="ENLEVER">Enlever</option> 
			</select>
		</div>
		<div class="col-md-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Soa code </b></label>
			</div>
			<input type="text" class="form-control obligatoire" placeholder="Soa code" id="rapprochement_unitaire_soa_code" name="rapprochement_unitaire_soa_code" data-placement="top" data-toggle="tooltip" data-original-title="Soa code"  id="rapprochement_unitaire_soa_code">
		</div>
		<div class="col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>&nbsp;</b></label>
			</div>
			<input id="btnRapprochementUnitaire" class="form-control btn-primary bouton"  value="ENREGISTRER" />		
		</div>
	 </div>
	</form>
</div>
<div  id="div_mes_conges" style="display:none;">
	<table id="jqGridMesConges"></table>
	<div id="jqGridPagerMesConges"></div>
</div>
<div  id="div_edit_structure" style="display:none;">
	<form  name="formulaireModificationStructure" id="formulaireModificationStructure" enctype="multipart/form-data">
	<input type="hidden"   name="child_id_edit_structure" id="child_id_edit_structure">
	<input type="hidden"   name="agent_selectionner" id="agent_selectionner">
	<h3>Modification</h3>
	<div class="row">
		<div class="col-md-5">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Libelle structure(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="libelle" id="edit_child_libelle"  name="edit_child_libelle" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  value="" >
		</div>
		<div class="col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Rang(*) </b></label>
			</div>
			<select  class="form-control" placeholder="rang" id="edit_rang" name="edit_rang" data-toggle="tooltip">
				<option  value="0">-------</option> 
				<option  value="DEPT">Departement</option> 
				<option  value="DIR">Direction</option> 
				<option  value="SCE">Service</option> 
				<option  value="DIV">Division</option> 
				<option  value="BUR">Bureau</option> 
			</select>
		</div>
		<div class="col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Sigle structure(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Sigle structure"  id="edit_sigle" name="edit_sigle" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  value="" >
		</div>
		<div class="col-md-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Chemin structure(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Chemin structure"  id="edit_path" name="edit_path" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  value="" >
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Soa structure(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Soa structure"   id="edit_soa_code" name="edit_soa_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  value="" >
		</div>
		<div class="col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>&nbsp;</b></label>
			</div>
			<input id="btnModificationStructure" class="form-control btn-primary bouton"  value="ENREGISTRER"/>		</div>
	</div>
	</form>
</div>


<div  id="div_list_agent" style="display:none;">
	<h3 id="jqGridTitle"></h3>
	<table>
		<tr><td id="list_autorite"></td></td><td id="imprimer_agents"></td></tr>
	</table>
	<div>
		<h3></h3>
	</div>
	<table id="jqGrid"></table>
	<div id="jqGridPager"></div>
</div>

<div id="template_detail_agent" style="display:none">
	<table>
		 <tbody>
			<tr>
			   <td><b>Nom: <a class="lien_cv" target="_blank" href="http://rohi.mef.gov.mg:8088/ROHI/cv2/mon_cv?id=[[data.id]]">[[data.nom]]</a></b></td>
			   <td>Pr&eacute;noms: [[data.prenom]]</td>
			   <td>Phone: [[data.phone]]</td>
			   <td rowspan="10" valign="top"><img style="width:90px;border-radius:50px;" src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload/[[data.id]].[[data.type_photo]]"></td>
			</tr>
			<tr>
			   <td>Adresse: [[data.address]]</td>
			   <td>Poste:   [[data.poste]]</td>
			   <td>Domaine: [[data.domaine]]</td>
			</tr>
			<tr>
			   <td>E-mail: <a class="lien_cv"  href="mailto:[[data.email]]">[[data.email]]</a></td>
			   <td>Coprs: [[data.corps]] (Categorie: [[data.categorie]])</td>
			   <td>Grade: [[data.grade]] (Indice: [[data.indice]])</td>
			</tr>
			<tr>

			   <td>Sanction: [[data.sanction_libelle]]</td>
			   <td>Date sanction: [[data.dateSanction]]</td>
			   <td>Date prise de service: [[data.date_prise_service]]</td>
			</tr>
			<tr>
			   <td>Date de naissance :[[data.date_naiss]]([[data.age]] ans)</td>
			   <td>Cin: [[data.cin]]</td>
			   <td>Chemin: [[data.path]]</td>
			</tr>
		</tbody>
	</table>
</div>
{literal}
<style>
	.lien_cv {
		color:blue !important;
	}
	.lien_cv:hover {
		color:blue !important;
	}
	.soptclass {
		color:blue !important;
	}
	.clearsearchclass {
		color:blue !important;
	}
	.ui-icon-closethick {
		color:blue !important;
	}
	.bp-title,.bp-title-frame{
		background:#ff9b4466!important;
	}

	#jqGrid_subgrid{
		width:0px!important;
	}
	.btnorg{
		height:20px!important;
	}
</style>

<script type='text/javascript'>
    $(document).ready(function () {
		renderMyStructure();
		//renderOrganigramme("204");
    });

	function renderMyStructure(){
		 $('#jqGridArborescence').jstree({
			'core' : {
				'data' : {
					"url" : "{/literal}{$zBasePath}{literal}GestionStructure/renderMyStructure",
					"dataType" : "json" // needed only if you do not supply JSON headers
				}
			}
		 });

		$('#jqGridArborescence').on('changed.jstree', function (e, data) {
			var CurrentNode = $("#jqGridArborescence").jstree("get_selected");
			renderOrganigramme(CurrentNode[0]);
		}).jstree();
	}

	function renderOrganigramme(child_id){

		$.ajax({
			url: "{/literal}{$zBasePath}{literal}GestionStructure/getStructures/",
			type: 'post',
			data: {
				tree_type	: "",
				child_id	: child_id
			},
			success: function(data, textStatus, jqXHR) {  
				data = data.replace("not allowed ", "");
				var donnees					=	JSON.parse(data);
				var options = new primitives.orgdiagram.Config();
				var items = [] ;
				console.log(donnees);
				for (var iIndex= 0; iIndex < donnees.length; iIndex++){
					var ligne = new primitives.orgdiagram.ItemConfig({
						id: donnees[iIndex].child_id,
						parent: donnees[iIndex].parent_id,
						title: donnees[iIndex].sigle + " ("+donnees[iIndex].nb+")" ,
						description: donnees[iIndex].content,
						image: "http://rohi.mef.gov.mg:8088//ROHI/assets/upload/"+donnees[iIndex].candidat_id+"."+donnees[iIndex].type_photo,
						soa:donnees[iIndex].soa_code,
						path:donnees[iIndex].path,
						rang:donnees[iIndex].rang,
						sigle:donnees[iIndex].sigle
					});
					items.push(ligne);
				}
				options.items = items;
				options.cursorItem = 0;
				options.templates = [getDepartmentTitleTemplate()];
				options.onItemRender = onTemplateRender;
				options.hasSelectorCheckbox = primitives.common.Enabled.False;
				options.normalLevelShift = 20;
				options.dotLevelShift = 20;
				options.lineLevelShift = 10;
				options.normalItemsInterval = 10;
				options.dotItemsInterval = 10;
				options.lineItemsInterval = 4;
				options.onMouseClick = onMouseClick;
				options.templates = [getCursorTemplate()];
				options.defaultTemplateName = "CursorTemplate";
				jQuery("#basicdiagram").orgDiagram(options);
				jQuery("#basicdiagram").orgDiagram("update", primitives.orgdiagram.UpdateMode.Refresh);
			}
		});
		$("#rapprochement_unitaire_matricule").mask("999999");
		$("#rapprochement_unitaire_cin").mask("999 999 999 999");
		$("#rapprochement_unitaire_soa_code").mask("99-99-9-999-99999");
		$("#block_edit_matricule").show();
		$("#block_edit_cin").hide();
		
	}

    function onTemplateRender(event, data) {
		switch (data.renderingMode) {
			case primitives.common.RenderingMode.Create:
			break;
			case primitives.common.RenderingMode.Update:
			break;
		}
		var itemConfig = data.context;
		if (data.templateName == "DepartmentTitleTemplate") {
			data.element.find("[name=titleBackground]").css({ "background": itemConfig.itemTitleColor });

			var fields = ["title"];
			for (var index = 0; index < fields.length; index++) {
				var field = fields[index];
				var element = data.element.find("[name=" + field + "]");
				if (element.text() != itemConfig[field]) {
					element.text(itemConfig[field]);
				}
			}
		}
    }


     function getDepartmentTitleTemplate() {
		var result = new primitives.orgdiagram.TemplateConfig();
			result.name = "DepartmentTitleTemplate";
			result.isActive = false;

		var buttons = [];
			result.buttons = buttons;
			result.itemSize = new primitives.common.Size(200, 30);
			result.minimizedItemSize = new primitives.common.Size(3, 3);

		var itemTemplate = jQuery(
			'<div class="bp-item bp-corner-all bt-item-frame">'
			+ '<div name="titleBackground" class="bp-item bp-corner-all bp-title-frame" style="top: 2px; left: 2px; width: 196px; height: 25px;">'
			+ '<div name="title" class="bp-item bp-title" style="top: 3px; left: 6px; width: 188px; height: 23px; text-align:center;">'
			+ '</div>'
			+ '</div>'
			+ '</div>'
		).css({
			width: result.itemSize.width + "px",
			height: result.itemSize.height + "px"
		}).addClass("bp-item");
			result.itemTemplate = itemTemplate.wrap('<div>').parent().html();
		return result;
    }

	function getCursorTemplate() {
		var result = new primitives.orgdiagram.TemplateConfig();
		result.name = "CursorTemplate";
		result.itemSize = new primitives.common.Size(120, 100);
		result.minimizedItemSize = new primitives.common.Size(3, 3);
		result.cursorPadding = new primitives.common.Thickness(3, 3, 50, 8);

		var cursorTemplate = jQuery("<div></div>").css({
			position: "absolute",
			overflow: "hidden",
			width: (result.itemSize.width + result.cursorPadding.left + result.cursorPadding.right) + "px",
			height: (result.itemSize.height + result.cursorPadding.top + result.cursorPadding.bottom) + "px"
		});

		var cursorBorder = jQuery("<div></div>").css({
			width: (result.itemSize.width + result.cursorPadding.left + 1) + "px",
			height: (result.itemSize.height + result.cursorPadding.top + 1) + "px"
		}).addClass("bp-item bp-corner-all bp-cursor-frame");
		cursorTemplate.append(cursorBorder);

		var bootStrapVerticalButtonsGroup = jQuery("<div></div>").css({
			position: "absolute",
			overflow: "hidden",
			top: result.cursorPadding.top + "px",
			left: (result.itemSize.width + result.cursorPadding.left + 5) + "px",
			width: "35px",
			height: (result.itemSize.height + 1) + "px"
		}).addClass("btn-group btn-group-vertical");

		bootStrapVerticalButtonsGroup.append('<button class="btn btnorg" data-buttonname="add_structure" type="button"><i class="la la-plus"></i></button>');
		bootStrapVerticalButtonsGroup.append('<button class="btn btnorg" data-buttonname="user" type="button"><i class="la la-address-book"></i></button>');
		bootStrapVerticalButtonsGroup.append('<button class="btn btnorg " data-buttonname="edit" type="button"><i class="la la-edit"></i></button>');
		bootStrapVerticalButtonsGroup.append('<button class="btn btnorg " data-buttonname="info" type="button"><i class="la la-user"></i></button>');
		bootStrapVerticalButtonsGroup.append('<button class="btn btnorg " data-buttonname="users" type="button"><i class="la la-users"></i></button>');
		bootStrapVerticalButtonsGroup.append('<button class="btn btnorg " data-buttonname="new" type="button"><i class="la la-plus"></i></button>');

		cursorTemplate.append(bootStrapVerticalButtonsGroup);
		result.cursorTemplate = cursorTemplate.wrap('<div>').parent().html();
		return result;
	}

    function onMouseClick(event, data) {
		var target = jQuery(event.originalEvent.target);
		if (target.hasClass("btn") || target.parent(".btn").length > 0) {
			var button = target.hasClass("btn") ? target : target.parent(".btn");
			var buttonname = button.data("buttonname");
			if ( buttonname == "user"){
				$("#child_rapprochement_unitaire").val(data.context.id);
				$("#rapprochement_unitaire").val(data.context.soa);
				formRapprochement(data.context.title);
			}else if(buttonname == "info"){
				console.log(data.context);
				loadAgent(data.context,"info");
			}else if(buttonname == "edit"){
				$("#child_id_edit_structure").val(data.context.id);
				$("#edit_child_libelle").val(data.context.description);
				$("#edit_soa_code").val(data.context.soa);
				$("#edit_rang").val(data.context.rang);
				$("#edit_sigle").val(data.context.sigle);
				$("#edit_path").val(data.context.path);
				formEditStructure(data.context.title);
			}else if(buttonname == "users"){
				loadAgent(data.context,"users");
			}else if(buttonname == "add_structure"){
				formCreationStructure(data.context.id);
			}
			data.cancel = true;
		}
	}
	function formCreationStructure (parent_id){
		$("#parent_id").val(parent_id);
		$( "#div_creation_structure" ).dialog({autoOpen: true,width: '75%',title: 'Nouveau structure ',close: 'X',modal: true,	});
		
	}
	function formEditStructure(title){
		$( "#div_edit_structure" ).dialog({autoOpen: true,width: '75%',title: 'Modification du structure '+title,close: 'X',modal: true,	});
	}
	function formRapprochement(title){
		$( "#div_add_user" ).dialog({autoOpen: true,width: '75%',title: 'Rapprocher un agent '+title,close: 'X',modal: true,	});
	}
	function loadAgent(structure,type){
		
		$("#agent_selectionner").val("") ;
		console.log(structure);
		
		$( "#div_list_agent" ).dialog({autoOpen: true,width: '75%',title: 'Liste des agents',close: 'X',modal: true	});
		
		var jqGridTitle	=	" Liste des agents dans : " + structure.description + " - " +structure.title  ;
		$("#jqGridTitle").html(jqGridTitle);

		getDetailStructure1(structure.id);
		
		$("#jqGrid").jqGrid("clearGridData", true);
		var dataurl		=	"";
		if (type === "users"){
			dataurl		=	"{/literal}{$zBasePath}{literal}GestionStructure/ajaxGetAgent1";
		}
		if(type === "info"){
			dataurl		=	"{/literal}{$zBasePath}{literal}GestionStructure/ajaxGetAgent";
		}
		//alert(dataurl);
		var lastsel;
		$("#jqGrid").jqGrid({
			url: dataurl,
			mtype: "GET",
			datatype: "json",
			postData: { child_id:structure.id},
			colModel: [
				{ label:'User Id', name: 'user_id',key: true,  hidden:true, width: 1 },
				{ label:'Matricule', name: 'matricule', width: 50,searchoptions :  { sopt : ["eq"]} , editable: false },
				{ label:'Nom', name: 'nom', width: 70,searchoptions :  { sopt : ["eq"]} , editable: true  },
				{ label:'Prenoms', name: 'prenom', width: 70,searchoptions :  { sopt : ["eq"]} , editable: true },
				{ label:'Poste', name: 'poste', width: 50 ,searchoptions :  { sopt : ["eq"]}  , editable: true},
				{ label:'Phone', name: 'phone', width: 50 ,searchoptions :  { sopt : ["eq"]} , editable: true}
			],
			viewrecords: true,
			width: 1525,
			height: 250,
			rowNum: 5,
			scroll: false,
			subGrid: true, // set the subGrid property to true to show expand buttons for each row
            subGridRowExpanded: showChildGrid, // javascript function that will take care of showing the child grid
			pager: "#jqGridPager",
			editurl :"{/literal}{$zBasePath}{literal}GestionStructure/majSituationAgent",
			onSelectRow: function(id){
				if(id && id!==lastsel){
					var rowKey = $("#jqGrid").jqGrid('getGridParam',"selrow");
					$("#agent_selectionner").val(rowKey) ;
					$('#jqGrid').jqGrid('restoreRow',lastsel);
					$('#jqGrid').jqGrid('editRow',id,true);
					lastsel=id;
				}
			}
		});
		jQuery("#jqGrid").jqGrid().setGridParam({url :dataurl,postData:{ child_id:structure.id} } ).trigger("reloadGrid");
		// activate the toolbar searching
        $('#jqGrid').jqGrid('filterToolbar',{restoreFromFilters : true, searchOperators : true});
		$("#jqGrid").jqGrid('navGrid',"#jqGridPager", {edit: true, add: true, del: false,search:false,position:"left",transaction:"left"},{bSubmit: "Enregistrer",bCancel: "Annuler"},{bSubmit: "Enregistrer",bCancel: "Annuler"});
		var btn = $("#transaction").html();
		// add first custom button
		if (typeof btn === "undefined"){
			$('#jqGrid').navButtonAdd('#jqGridPager',{
				buttonicon: "ui-icon-mail-closed",
				title: "Send Mail",
				caption: "Mes decisions de cong&eacutes;",
				position: "last",
				onClickButton: 
				mesDecisionsDeConges,
				id:"conge"
			});
			// add second custom button
			$('#jqGrid').navButtonAdd('#jqGridPager',{
				buttonicon: "ui-icon-mail-closed",
				title: "Send Mail",
				caption: "Mes Transactions",
				transaction: "last",
				onClickButton: mesTransactions,
				id:"transaction"
			});
			// add second custom button
			$('#jqGrid').navButtonAdd('#jqGridPager',{
				buttonicon: "ui-icon-mail-closed",
				title: "Send Mail",
				caption: "Mes archives",
				transaction: "last",
				onClickButton: mesArchives,
				id:"archives"
			});
		}
	}
	
	// the event handler on expanding parent row receives two parameters
    // the ID of the grid tow  and the primary key of the row
	function getDetailStructure1(structureId) {
		$.ajax({
			url: '{/literal}{$zBasePath}{literal}GestionStructure/getDetailStructure1/',
			type: "GET",
			data: {
				child_id: structureId,
			},
			success: function (data) {
				var data					= JSON.parse(data);;
			  $("#list_autorite").html("Autorite: " +data.autorite); //filled!
			  $("#list_evalueateur").html("Evaluateur: "+data.evaluateur); //filled!
			 // $("#list_respers").html("Respers: "+data.responsablepers); //filled!
			  $("#imprimer_agents").html("<a href='/ROHI/GestionStructure/imprimerAgentDansStructure/"+structureId+"'><i style='font-size:22px;' class='la la-print'></i></a>"); //filled!
			}
		});
	}
	function showChildGrid(parentRowID, parentRowKey) {
		$.ajax({
			url: '{/literal}{$zBasePath}{literal}GestionStructure/ajaxGetDetailAgent',
			type: "GET",
			data: {
				parentRowID: parentRowKey,
			},
			success: function (data) {
				//$("#" + parentRowID).append(html);
				var discussion					= JSON.parse(data);;
				Mustache.tags					= ["[[", "]]"];
				var template_detail_agent		= $('#template_detail_agent').html();
				Mustache.parse(template_detail_agent);
				var rendered					= Mustache.render(template_detail_agent, {data :discussion});
			
				$('#'+parentRowID).append(rendered);
			}
		});
	}

	function selectStatutAgent(curent_element){
		if( curent_element.val()  == "ECD" ){
			$("#block_edit_matricule").hide();
			$("#block_edit_cin").show();
		}else{
			$("#block_edit_matricule").show();
			$("#block_edit_cin").hide();
		}
	}

	function mesDecisionsDeConges() {
        $('#div_mes_conges').dialog({
			autoOpen: true,
			modal: true,
			width:750
		});
		var user_id	=	$("#agent_selectionner").val();
		$("#jqGridMesConges").jqGrid('setGridParam',{postData:{ user_id:user_id}}).trigger('reloadGrid');
		$("#jqGridMesConges").jqGrid({
				url: '{/literal}{$zBasePath}{literal}GestionStructure/mesDecisions/',
				postData: { user_id:user_id},
                mtype: "GET",
                datatype: "json",
                colModel: [
					{ label: 'Matricule', name: 'matricule',width:90,},
					{ label: 'Identifiant', name: 'decision_id',key: true,width:80,frozen:true},
					{ label: 'UserId', name: 'decision_userId',width:70,editable:true,hidden:true},
                    { label: 'Nom', name: 'nom',width:180},
                    { label: 'Prenoms', name: 'prenom',width:180},
                    { label: 'Annee', name: 'decision_annee',width:180,editable:true},
					{ label: 'Numero', name: 'decision_numero',width:270,editable:true}
                ],
				loadonce : true,
                height: 250,
                width: 750,
                rowNum: 10,
                pager: "#jqGridPagerMesConges",				
				autowidth: true,
				scroll: false,
				subGrid: true, // set the subGrid property to true to show expand buttons for each row
                subGridRowExpanded: detailDeMesDecisions, // javascript function that will take care of showing the child grid
			    subGridOptions : {
					// load the subgrid data only once
					// and the just show/hide
					reloadOnExpand :false,
					// select the row when the expand column is clicked
					selectOnExpand : false 
				},
				autowidth: true,
				shrinkToFit : false,
				editurl :"{/literal}{$zBasePath}{literal}GestionStructure/manageDecisionConges",
		  }).trigger('reloadGrid'); 
		  $("#jqGridMesConges").jqGrid("setGridParam", { datatype: "json" } ).trigger("reloadGrid", [{ current: true }]); 
		  $("#jqGridMesConges").jqGrid('navGrid',"#jqGridPagerMesConges", {edit: true, add: true, del: true,search:false},{bSubmit: "Enregistrer",bCancel: "Annuler"},{bSubmit: "Enregistrer",bCancel: "Annuler"});
    }

	// the event handler on expanding parent row receives two parameters
        // the ID of the grid tow  and the primary key of the row
      function detailDeMesDecisions(parentRowID, parentRowKey) {
            var childGridID = parentRowID + "_table";
            var childGridPagerID = parentRowID + "_pager";
            // send the parent row primary key to the server so that we know which grid to show
            var childGridURL = "detailDeMesDecisions?decision_id=" + parentRowKey;
            // add a table and pager HTML elements to the parent grid row - we will render the child grid here
            $('#' + parentRowID).append('<table id=' + childGridID + '></table><div id=' + childGridPagerID + ' class=scroll></div>');

            $("#" + childGridID).jqGrid({
                url: childGridURL,
                mtype: "GET",
                datatype: "json",
                page: 1,
                colModel: [
                    { label: 'Gcap Id', name: 'gcap_id', key: true, width: 75,hidden:true },
                    { label: 'Date debut', name: 'gcap_dateDebut', width: 150,editable:true,formatter: 'date', formatoptions: {newformat: 'd/m/Y'} },
                    { label: 'Date fin', name: 'gcap_dateFin', width: 150 ,editable:true,formatter: 'date', formatoptions: {newformat: 'd/m/Y'} },
                    { label: 'Nombre de Jour', name: 'fraction_nbrJour', editable:true,width: 150 },
                    { label: 'Motif', name: 'gcap_motif', width: 180,editable:true },
                    { label: 'Lieu de Jouissance', name: 'gcap_lieuJouissance', width: 125,editable:true }
                ],
				loadonce: true,
				scroll: false,
                height: '100%',
                pager: "#" + childGridPagerID,
				rowList: [],        // disable page size dropdown
				pgbuttons: false,     // disable page control like next, back button
				pgtext: null,         // disable pager text like 'Page 0 of 10'
				viewrecords: false,   // disable current view record text like 'View 1-10 of 100' ,
				autowidth: true,
				shrinkToFit : false,
				editurl :"{/literal}{$zBasePath}{literal}GestionStructure/manageDetailDeMesDecisions",
            });
			 $("#" + childGridID).jqGrid('navGrid',"#" + childGridPagerID, {edit: true, add: true, del: true,search:false},{bSubmit: "Enregistrer",bCancel: "Annuler"},{bSubmit: "Enregistrer",bCancel: "Annuler"});
        }

		function mesTransactions() {
			alert("mesTransactions.");
		}
		function mesArchives() {
			alert("mesArchives");
		}
		//creation d'un structure
		$("#btnCreateStructure").click(function(){
			if ( confirm("Voulez vous vraiment vraiment faire cet action?") ) {
				$.ajax({
					url: '{/literal}{$zBasePath}{literal}GestionStructure/createStructure',
					type: "GET",
					data: {
						add_child_libelle	: 	$("#add_child_libelle").val(),
						add_rang			:	$("#add_rang").val(),
						add_soa_code		:	$("#add_soa_code").val(),
						add_sigle			:	$("#add_sigle").val(),
						parent_id			:	$("#parent_id").val(),
					},
					success: function (data) {
						$("#add_child_libelle").val("");
						$("#add_rang").val("");
						$("#add_soa_code").val("");
						$("#add_sigle").val("");
						var parent_id	=	$("#parent_id").val();
						renderOrganigramme(parent_id);
						return false;
					}
				});	
			}
		});
		//attachement d'un agent 
		$("#btnRapprochementUnitaire").click(function(){
			if ( confirm("Voulez vous vraiment vraiment faire cet action?") ) {
				$.ajax({
					url: '{/literal}{$zBasePath}{literal}GestionStructure/rapprochementUnitaire',
					type: "GET",
					data: {
						rapprochement_unitaire_statut_agent		: 	$("#rapprochement_unitaire_statut_agent").val(),
						rapprochement_unitaire_matricule		:	$("#rapprochement_unitaire_matricule").val(),
						rapprochement_unitaire_type_agent		:	$("#rapprochement_unitaire_type_agent").val(),
						rapprochement_unitaire_type_operation	:	$("#rapprochement_unitaire_type_operation").val(),
						rapprochement_unitaire_soa_code			:	$("#rapprochement_unitaire_soa_code").val(),
						child_rapprochement_unitaire			:	$("#child_rapprochement_unitaire").val(),
						rapprochement_unitaire_cin				:	$("#rapprochement_unitaire_cin").val(),
					},
					success: function (data) {
						$("#rapprochement_unitaire_statut_agent").val("");
						$("#rapprochement_unitaire_matricule").val("");
						$("#rapprochement_unitaire_type_agent").val("");
						$("#rapprochement_unitaire_type_operation").val("");
						$("#rapprochement_unitaire_soa_code").val("");
						var parent_id	=	$("#parent_id").val();
						renderOrganigramme(parent_id);
						return false;
					}
				});	
			} else {
				return false;
			}
		});
		//modification d'un structure 
		$("#btnModificationStructure").click(function(){
				if ( confirm("Voulez vous vraiment vraiment faire cet action?") ) {
				$.ajax({
					url: '{/literal}{$zBasePath}{literal}GestionStructure/updateStructure',
					type: "GET",
					data: {
						edit_child_libelle		: 	$("#edit_child_libelle").val(),
						edit_rang				:	$("#edit_rang").val(),
						edit_sigle				:	$("#edit_sigle").val(),
						edit_path				:	$("#edit_path").val(),
						edit_soa_code			:	$("#edit_soa_code").val(),
						child_id_edit_structure :	$("#child_id_edit_structure").val(),
					},
					success: function (data) {
						$("#edit_child_libelle").val("");
						$("#rapprochement_unitaire_matricule").val("");
						$("#edit_rang").val("");
						$("#edit_path").val("");
						$("#edit_soa_code").val("");
						$(".ui-dialog-titlebar-close").click();
						var parent_id 	=	$("#child_id_edit_structure").val();
						renderOrganigramme(parent_id);
						return false;
					}
				});	
			} else {
				return false;
			}
		});
  </script>
{/literal}