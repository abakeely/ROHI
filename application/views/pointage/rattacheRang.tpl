{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
{include_php file=$zHeader}
<div class="page-header">
	<div class="row align-items-center">
		<div class="col-12">
			<h3 class="page-title">Rang</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
				<li class="breadcrumb-item"><a href="{$zBasePath}">Flux agents / visiteurs</a></li>
				<li class="breadcrumb-item">Rang</li>
			</ul>
		</div>
	</div>
</div>
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
			<div class="SSttlPage">
			<div id="searchAcc">
				<div class="card punch-status">
					<h5>RECHERCHE</h5>
					<form action="{$zBasePath}pointage/liste/pointage-electronique/rang" method="POST" style="display:block" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
						<fieldset>
								<div class="row1">
									<div class="cell">
										<div class="field">
											<label>Date d&eacute;but *</label>
											<input type="text" name="date_debut" autocomplete="off" style="width:189px!important" id="date_debut" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDateDebut|date_format2}" value="{$oData.zDateDebut}" onChange="setFinDateTransaction(this.value)" placeholder="s&eacute;l&eacute;ctionner la date de d&eacute;but" class="form-control datedropper-range-fiche obligatoire">
										</div>
									</div>
								</div>
								<div class="row1">
									<div class="cell">
										<div class="field">
											<label>Date fin *</label>
											<input type="text" name="date_fin" autocomplete="off" style="width:189px!important" id="date_fin" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDateFin|date_format2}" value="{$oData.zDateFin}" placeholder="s&eacute;l&eacute;ctionner la date fin" class="form-control datedropper-range-fiche obligatoire">
										</div>
									</div>
								</div>
								{if $oData.iCompteActif == COMPTE_ADMIN}
								<div class="row1 clearfix">
									<div class="cell small">
										<div class="field"> 
											<label>Departement</label>
											<select style="height:37px;" id="iDepartementId" name="iDepartementId" class="obligatoire" onChange="getOrganisation('{$zBasePath}',1,this.value);">
												<option value="">s&eacute;l&eacute;ctionner un d&eacute;partement</option>
												{foreach from=$oData.oDepartement item=oDepartement }
												<option {if $oDepartement.id == $oData.oDataSearch.iDepartementId} selected="selected" {/if} value="{$oDepartement.id}">&nbsp;{$oDepartement.libele}</option>
												{/foreach}
											</select>
										</div>
									</div>
								</div>
								<br>
								{/if}
								<div class="row1 clearfix" >
									<div class="cell">
										<div class="field">
											<input type="button" class="button" onClick="validerRang(1);" name="" id="" value="Voir rang">
											<input type="button" class="button" onClick="validerRang(2);" name="" id="" value="Rapport en PDF">
											<input type="button" class="button" onClick="validerRang(3);" name="" id="" value="Rapport en Excel">
										</div>
									</div>
								</div>
							</fieldset>
					</form>
				</div>
				</div>
			</div>
			<br/><br/>
			<div class="contenuePage">

			<!--*Debut Contenue*-->
			<div class="">
			<table class="table table-striped table-bordered table-hover" id="dataTables1-example">
				<thead>
					<tr>
						<th>RANG</th>
						<th>Matricule</th>
						<th>Nom</th>
						<th>Pr&eacute;nom</th>
						<th>D&eacute;partement</th>
						<th style="width:10%">Nb heures totales travaill&eacute;es</th>
					</tr>
				</thead>
				<tbody>
					{assign var=iIncrement value="0"}
					{if sizeof($oData.toGetAllRang)>0}
					{foreach from=$oData.toGetAllRang item=oListeRattache }
					<tr {if $iIncrement%2 == 0} class="even" {/if}>
						<td>{$oListeRattache["rang"]}</td>
						<td>{$oListeRattache["matricule"]}</td>
						<td>{$oListeRattache["nom"]|upper}</td>
						<td>{$oListeRattache["prenom"]}</td>
						<td>{$oListeRattache["path"]}</td>
						<td>{$oListeRattache["total_heure_effectue"]}</td>
					</tr>
					{assign var=iIncrement value=$iIncrement+1}
					{/foreach}
					{else}
					<tr><td style="text-align:center;" colspan="11">Aucun enregistrement correspondant</td></tr>
					{/if}
				</tbody>
			</table>
			</div>

		<!--*Fin Contenue*-->
		</div>
		</div>
		<div id="calendar"></div>
	</div>
	
</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>
{if sizeof($oData.oListe)>0}
{literal}
<style>
.separateur.separateur1, h3 {
    border-bottom: none!important;
}
</style>
<script>
	$(document).ready(function() {
		$('#dataTables1-example').dataTable();
	});
</script>
{/literal}
{/if}
<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
<input type="hidden" name="iElementId" id="iValueId" value=""> 
<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}pointage/liste/pointage-electronique/rang">
<input type="hidden" name="zUrlPdf" id="zUrlPdf" value="{$zBasePath}pointage/liste/{$oData.zHashModule}/pdf">
<input type="hidden" name="zUrlExcel" id="zUrlExcel" value="{$zBasePath}pointage/liste/{$oData.zHashModule}/excel">
</form>
{include_php file=$zFooter}
</div>

</body>
</html>