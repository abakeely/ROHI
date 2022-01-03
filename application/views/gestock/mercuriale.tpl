{include_php file=$zCssJs}
<link rel="stylesheet" href="{$zBasePath}assets/reclassement/css/style.css" />
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<script type="text/javascript" src="{$zBasePath}assets/common/js/vendor/jquery-ui.js"></script>
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Outils > Mercuriale</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des stocks</a></li>
									<li class="breadcrumb-item">{$oData.zLibelle}</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="SSttlPage">
									<div class="cell">
										<div class="field text-center">
											<form action="#" target="_self" method="POST" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
												<fieldset>
													<div class="row1 clearfix">
														<div class="cell" style="text-align:left;">
															<div class="field">
																<label>&nbsp;</label>
																<input type="button" id="dialog-add-mercuriale" class="button" value="Nouvelle Article">
																<a href="{$zBasePath}gestock/imprimer/stock/mercuriale-output" style="text-decoration:none" class="btn button imprimer"><i class="la la-print"></i>&nbsp;&nbsp;Exporter</a>
																<a href="{$zBasePath}gestock/imprimer/stock/mercuriale" target="_blank" style="text-decoration:none" class="btn button imprimer"><i class="la la-print"></i>&nbsp;&nbsp;Imprimer</a>
															</div>
														</div>
													</div>
												</fieldset>
											</form>
										</div>
									</div>
								</div>

								<div class="col-xs-12">
									<table id="table-liste-mercuriale" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
										<thead>
											<tr>
												<th id="numeroId" style="width:5%!important">N°</th>
												<th id="iType">Type de fourniture</th>
												<th id="Article">Article</th>
												<th id="Spec" style="width:40%!important">Spécification</th>
												<th id="Unite">Unité</th>
												<th id="Prix" style="width:10%!important">Prix (en Ariary)</th>
												<th id="Action" style="width:8%!important">Action</th>
											</tr>
										</thead>
										
									</table>
								</div>
								<div id="calendar"></div>

								<form name="formDelete" id="formDelete" action="{$zBasePath}gestock/delete/stock/mercuriale" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cette article ?">
									<input type="hidden" name="iElementId" id="iValueId" value="">
								</form>
								<div id="dialogmercuriale" title="Dialog Title"></div>
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

	$(document).ready (function ()
	{

	$("#dialog-add-mercuriale").click(function() {
		
		$('#dialogmercuriale').dialog('option', 'title', 'Formulaire ajout article');
        $('#buttonId').button('option', 'label', 'Ajouter');
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}gestock/edit/stock/mercuriale",
			type: 'get',
			data: {
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialogmercuriale").html(data);
				$("#dialogmercuriale").dialog("open");
			},
			async: false
		})
	});

	$("#dialogmercuriale").dialog({
		autoOpen: false,
		width: '50%',
		modal:true,
		title: 'Formulaire Fiche article',
		close: 'X',
		open: function () {
			$.ui.dialog.prototype._allowInteraction = function(e) {
				return !!$(e.target).closest('.ui-dialog, .ui-datepicker, .select2-drop').length;
			};
		},
		modal: true,
		buttons: [{
					id: "buttonId",
					click: function() {

						iRet = 1 ;
						$(".obligatoire").each (function ()
						{
							$(this).parent().removeClass("error");
							if($(this).val()=="")
							{
								$(this).parent().addClass("error");
								 iRet = 0 ;
							}
						}) ;

						
						if (iRet == 1){
							var $form = $("#formulaireEdit");
							var formdata = (window.FormData) ? new FormData($form[0]) : null;
							var data = (formdata !== null) ? formdata : $form.serialize();
							$.ajax({
								url: $form.attr('action'),
								type: $form.attr('method'),
								contentType: false, // obligatoire pour de l'upload
								processData: false, // obligatoire pour de l'upload
								dataType: 'json', // selon le retour attendu
								data: data,
								success: function (response) {
									$("#dialogmercuriale").dialog("close");
									zListemercuriale.ajax.reload();
								}
							});
						}
					}
				},{
					text: "Fermer",
					click: function() {
						$(this).dialog("close")
					}
				}]
	});


	var zListemercuriale = $('#table-liste-mercuriale').DataTable( {
		
		"processing": true,
		"serverSide": true,
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}gestock/getAjax/stock/mercuriale", // json datasource
			data: function ( d ) {
				d.zDate = $("#zDate").val()
			},
			type: "post",  // method  , by default get
			error: function(){  // error handling

			}
		},
		"autoWidth": false,
		"fnInitComplete": function() {

            $("#numeroId").css("width","2%!important");
			$("#iType").css("width","30%!important");
			$("#Article").css("width","25%!important");
			$("#Spec").css("width","10%!important");
			$("#Unite").css("width","40%!important");
			$("#Prix").css("width","10%!important");
			$("#Action").css("width","10%!important");
        }
    }); 

	$("#table-liste-mercuriale").on("click", ".suppr", function(){
	    var iElement = $(this).attr("dataSuppr");
		if (confirm ($("#zMessage").val()))
		{
			$("#iValueId").val(iElement) ; 
			var $form = $("#formDelete");
			var formdata = (window.FormData) ? new FormData($form[0]) : null;
			var data = (formdata !== null) ? formdata : $form.serialize();
			$.ajax({
				url: $form.attr('action'),
				type: $form.attr('method'),
				contentType: false, // obligatoire pour de l'upload
				processData: false, // obligatoire pour de l'upload
				dataType: 'json', // selon le retour attendu
				data: data,
				success: function (response) {
					$("#dialogmercuriale").dialog("close");
					zListemercuriale.ajax.reload();
				}
			});
			
		}
	});

	
	$("#table-liste-mercuriale").on("click", ".dialog-link", function(){
		$('#dialogmercuriale').dialog('option', 'title', 'Formulaire prix article');
        $('#buttonId').button('option', 'label', 'Modifier');
	    var iFournitureId = $(this).attr("iFournitureId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}gestock/edit/stock/mercuriale",
			type: 'get',
			data: {
				iFournitureId:iFournitureId
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialogmercuriale").html(data);
				$("#dialogmercuriale").dialog("open");
				event.preventDefault()
			},
			async: false
		})
			
	});

	
	
	});

</script>
<style>
#cssmenu li {font-size:1.2em;}
.ui-widget-overlay {
  /*opacity: 0.6!important;*/
  filter: Alpha(Opacity=50);
  background-color: gray;
}
th, td {
    width: 0px!important;
}
</style>
{/literal}