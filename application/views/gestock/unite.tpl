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
								<h3 class="page-title">Liste Type unité</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des Unites</a></li>
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
														<div class="cell1" style="text-align:left;">
															<div class="field">
																<label>&nbsp;</label>
																<input type="button" class="button dialog-add-unite" value="Ajouter type d'unité">
															</div>
														</div>
													</div>
												</fieldset>
											</form>
										</div>
									</div>
								</div>

								<div class="col-xs-12">
									<table id="table-liste-Unite" cellpadding="0" cellspacing="0" border="0" class="display" width="70%">
										<thead>
											<tr>
												<th>N°</th>
												<th>Libellé</th>
												<th>Action</th>
											</tr>
										</thead>
										
									</table>
								</div>
								<div id="calendar"></div>

								<form name="formDelete" id="formDelete" action="{$zBasePath}gestock/delete/stock/unite#" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer ce type d'unité ?">
									<input type="hidden" name="iElementId" id="iValueId" value="">
								</form>
								<div id="dialogEntreeUnite" title="Dialog Title"></div>
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

	$("#dialogEntreeUnite").dialog({
		autoOpen: false,
		width: '40%',
		modal:true,
		title: 'Formulaire Unité',
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
									$("#dialogEntreeUnite").dialog("close");
									zListeUnite.ajax.reload();
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
	
	var zListeUnite = $('#table-liste-Unite').DataTable( {
		"processing": true,
		"serverSide": true,
		"searching": false,
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}geStock/getAjax/stock/unite", // json datasource
			data: function ( d ) {
			},
			type: "post",  
			error: function(){  

			}
		}
    }); 

	function getListeUnite(){
		zListeUnite.ajax.reload();
	}

	$(".dialog-add-unite").click(function(event) {
		$('#dialogEntreeUnite').dialog('option', 'title', "Formulaire ajout type d'unité");
		$('#buttonId').button('option', 'label', 'Ajouter');
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}gestock/edit/stock/new-unite",
			type: 'get',
			data: {
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialogEntreeUnite").html(data);
				$("#dialogEntreeUnite").dialog("open");
				event.preventDefault()
			},
			async: false
		})
	});

	/*$("#table-liste-Unite").on("click", ".suppr", function(){
		var iElement = $(this).attr("dataSuppr");
		if (confirm ($("#zMessage").val()))
		{
			$("#iValueId").val(iElement) ; 
			$("#formDelete").submit();
			
		}
	});*/

	$("#table-liste-Unite").on("click", ".suppr", function(){
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
					$("#dialogEntreeUnite").dialog("close");
					zListeUnite.ajax.reload();
				}
			});
			
		}
	});

	$("#table-liste-Unite").on("click", ".dialog-link", function(){
		$('#dialogEntreeUnite').dialog('option', 'title', 'Formulaire modification unité');
        $('#buttonId').button('option', 'label', 'Modifier');
	    var iTypeUniteId = $(this).attr("iTypeUniteId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}geStock/edit/stock/new-unite",
			type: 'get',
			data: {
				iTypeUniteId:iTypeUniteId
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialogEntreeUnite").html(data);
				$("#dialogEntreeUnite").dialog("open");
				event.preventDefault()
			},
			async: false
		})
			
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

.searchCommande {
    width: 90%!important;
}
</style>
{/literal}