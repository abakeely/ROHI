{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
{include_php file=$zHeader}
<div class="page-header">
	<div class="row align-items-center">
		<div class="col-12">
			<!--h3 class="page-title">Recapitulation absence des agents</h3-->
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
				<li class="breadcrumb-item"><a href="#">RH</a></li>
				<li class="breadcrumb-item"><a href="#">Gestion absence</a></li>
				<li class="breadcrumb-item">Récapitulation</li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="card mb-0">
			<div class="card-body">
				<div id="container">
					<section id="content">
        			{include_php file=$zLeft}	
						<div id="innerContent">
							<div id="ContentBloc">
								<div class="row filter-row">
									<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
										<input type="text" id="iDateSerach1" name="iDateSerach1" placeholder="s&eacute;l&eacute;ctionner l'année" class="form-control myYaer" data-dd-opt-format="Y" data-dd-opt-preset="onlyYear" placeholder="yyyy" readonly="true" value="{$smarty.session.zDateToDayDefault|date_format:"%Y"}" autocomplete="off" data-dd-opt-default-date="{$smarty.session.zDateToDayDefault}">
									</div>
									<div class="col-3">
									<button id="recap-excel" class="btn btn-primary">Rapport en Excel</button>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					
					<div class="contenuePage">

				<!--*Debut Contenue*-->
						<div class="row">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-body">

									  <div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
			<thead>
				<tr>
					<th vertical-align="middle" align="center">Photo</th>
					<th>Matricule</th>
					<th>Nom</th>
					<th>Pr&eacute;noms</th>
					<th>Service</th>
					<th>Site</th>
					<th>Ann&eacute;e</th>
					<th>Recapitulation</th>
					
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		{* {$oData.zPagination} *}
		</div>

    <!--*Fin Contenue*-->
    </div></div>
	</div>
	</div>
	<form action="{$zBasePath}gcap/extrants/gestion-absence/compte-gcap-all-excel/" style="display:block!important" method="POST" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
	<input type="hidden" name="iDateSerach" id="iDateSerach" value="">
	</form>
	</div>
</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>
<script>

{literal}

var recap = $('#dataTables-example').DataTable( {
	"processing": true,
	"serverSide": true,
	columnDefs: [
		{ className: 'text-center', targets: [0] },
	],
	"order": [[ 0, "desc" ]],
	"pageLength": 5,
	"ajax":{
		url :"{/literal}{$zBasePath}{literal}gcap/extrants/gestion-absence/compte-gcap-all-ajax", 
		data: function ( d ) {
			d.date = $("#iDateSerach1").val();
		},
		type: "post",  
		error: function(){  

		}
	}
}); 

$("#recap-excel").click(function(){
	$("#iDateSerach").val($("#iDateSerach1").val());
	$("#formulaireTransaction").attr("target", "_blank");
	$("#formulaireTransaction").submit();
})

function exporterRecap(){
	$("#formulaireTransaction").attr("target", "_blank");
	$("#formulaireTransaction").submit();
}
function getListeRecap(){
	recap.ajax.reload();
}

new dateDropper({
  selector: '.myYaer',
  format: '2021',
  defaultDate: true,
  expandable: false,
  onChange: function (res) {
	getListeRecap();
  }
});

{/literal}

</script>
{literal}
<style>
.text-center {
	text-align:center;
}
</style>
{/literal}
<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
<input type="hidden" name="iElementId" id="iValueId" value="">
<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}pointage/liste/{$oData.zHashModule}/{$oData.zHashUrl}">
</form>
{include_php file=$zFooter}
</div>

</body>
</html>