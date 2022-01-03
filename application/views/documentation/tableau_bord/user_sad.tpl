{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Listes agents connectés à SAD</h3>
								<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item"><a href="{$zBasePath}">Archives et Documentations</a></li>
								<li class="breadcrumb-item">Tableau de Bord</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div align="right">
										<a href="{$zBasePath}tableau_bord/couv_connect_sad/sad/agent-connecte-sad" class="btn">PRECEDENT</a>
								</div>
								<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
									<div align="center">LISTES DES AGENTS CONNECTES A SAD</div>
								</h3>
								
								<form action="#" method="POST" style="height: 53px; padding: 9px;">
									<div class="col-md-3">
											<input type="text" id="dateDeb" class="form-control" placeholder="Date D&eacute;ebut" data-placement="top">
												<span class="la la-calendar txt-danger form-control-feedback" style="top:11px;right:12px;"></span>
									</div>
									<div class="col-md-3">
											<input type="text" id="dateFin" class="form-control datepicker" placeholder="Date Fin" data-placement="top">
											<span class="la la-calendar txt-danger form-control-feedback" style="top:11px;right:12px;"></span>
									</div>
									<div class="col-md-2">
											<button type="button" class="form-control" onclick="rechercher()">AFFICHER</button>
									</div>
								</form>
								<br><br>			
								<table class="table table-striped table-bordered table-hover" id="table_liste_pret">
									<thead>
										<tr>
											<th>Ordre</th>
											<th>Date de connexion</th>
											<th>IM</th>
											<th>Nom et Pr&eacute;noms</th>
											<th>D&eacute;partement</th>
											<th>Région</th>
											<th>Localite de service</th>
										</tr>
									</thead>	
									<tbody>
									{assign var=ordreIncrement value="0"}
									{foreach from=$oData.list_user item=user}
										<tr>
											<td>{$ordre}</td>
											<td>{$user.date_last_connection}</td>
											<td>{$user.im}</td>
											<td>{$user.nom}&nbsp;{$user.prenom}</td>
											<td>{$user.departement}</td>
											<td>{$user.region}</td>
											<td>{$user.lacalite_service}</td>
										</tr>
									{assign var=ordreIncrement value=$ordreIncrement+1}
									{/foreach}
									</tbody>
								</table>		
								<div id="calendar"></div>
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
 setTimeout(function() { location.reload() },900000);
 function rechercher(){
	var dateDeb = document.getElementById("dateDeb").value;
	var dateFin = document.getElementById("dateFin").value;
	document.location.href = "
{/literal}{$zBasePath}
{literal}documentation/list_user_sad/"+dateDeb+"/"+dateFin;
 }
 $(document).ready(function() {
 $("#dateDeb").datepicker({
		 language: "fr",
		 autoclose: true,
		 todayHighlight: true,
		 format: "yyyy-mm-dd"
 });
 $("#dateFin").datepicker({
		 language: "fr",
		 autoclose: true,
		 todayHighlight: true,
		 format: "yyyy-mm-dd"
 });
 });
 
 $(document).ready(function() {
  $('#table_liste_pret').dataTable();
	});
</script>
{/literal}