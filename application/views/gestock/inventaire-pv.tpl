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
								<h3 class="page-title">Liste des PV</h3>
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
											<form name="outPout" id="outPout" action="" method="POST">
												<fieldset>
													<div class="row1 clearfix">
														<div class="cell" style="text-align:left;">
															<div class="field">
																<label>&nbsp;</label>
																<input type="hidden" name="CheckList" id="checkList" target="_self" value="">
																<a href="#" style="text-decoration:none" iTarget="0" getAction="{$zBasePath}gestock/imprimer/stock/invetaire-pv-output" class="btn button imprimer"><i class="la la-print"></i>&nbsp;&nbsp;Exporter</a>
																<a href="#" iTarget="1" getAction="{$zBasePath}gestock/imprimer/stock/invetaire-pv" style="text-decoration:none" class="btn button imprimer"><i class="la la-print"></i>&nbsp;&nbsp;Imprimer</a>
															</div>
														</div>
													</div>
												</fieldset>
											</form>
										</div>
									</div>
								</div>

								<div class="col-xs-12">
									<table id="table-liste-pv" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
										<thead>
											<tr>
												<th style="text-align:center;">&nbsp;</th>
												<th>N°</th>
												<th>Réf du PV</th>
												<th>Date de création</th>
												<th>Type de fourniture</th>
												<th>Action</th>
											</tr>
										</thead>
										
									</table>
								</div>
								<div id="calendar"></div>

								<form name="formDelete" id="formDelete" action="{$zBasePath}gestock/delete/stock/inventaire-pv" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet inventaire PV ?">
									<input type="hidden" name="iElementId" id="iValueId" value="">
								</form>
								<div id="dialogEntreeStock" title="Dialog Title"></div>
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

	
	
	var zListePv = $('#table-liste-pv').DataTable( {
		"processing": true,
		"serverSide": true,
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}gestock/getAjax/stock/invetaire-pv", // json datasource
			data: function ( d ) {
				d.zDate = $("#zDate").val()
			},
			type: "post",  // method  , by default get
			error: function(){  // error handling

			}
		}
    }); 

	$("#table-liste-pv").on("click", ".dialog-link", function(){
		$('#dialogEntreeStock').dialog('option', 'title', 'Formulaire entrée en stock');
        $('#buttonId').button('option', 'label', 'Modifier');
	    var iFournitureId = $(this).attr("iFournitureId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}gestock/edit/stock/entree",
			type: 'get',
			data: {
				iFournitureId:iFournitureId
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialogEntreeStock").html(data);
				$("#dialogEntreeStock").dialog("open");
				event.preventDefault()
			},
			async: false
		})
			
	});

	$("#table-liste-pv").on("click", ".suppr", function(){
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
					zListePv.ajax.reload();
				}
			});
			
		}
	});

	$('.imprimer').click(function(){
		
		var iAction = $(this).attr("getAction");
		iTarget = $(this).attr("iTarget");
		$("#outPout").removeAttr("target");
		if (iTarget==0){
			$("#outPout").attr("target","_self");
		} else {
			$("#outPout").attr("target","_blank");
		}
		$("#outPout").attr("action",iAction);
		$("#outPout").submit();
		
	});

	$("#table-liste-pv").on("click", ".checkPv", function(){
	    var iPvId = $(this).attr("checkAttr");

		var iCheckList = $("#checkList").val();

		if (iCheckList==""){
			$("#checkList").val(iPvId)
		} else {
			
			var iValue = $(this).is(':checked');  

			switch (iValue) {
				case true:
					iCheckList += "," + iPvId;
					$("#checkList").val(iCheckList);
					break;

				case false:
					var zFinal="";
					toSplit = iCheckList.split(",");
					for(i=0;i<toSplit.length;i++){
						if(iPvId != toSplit[i]){
							if (zFinal==""){
								zFinal = toSplit[i];
							} else {
								zFinal += "," + toSplit[i];
							}
						}
					}
					$("#checkList").val(zFinal);
					break;
			}
			
			
		}

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