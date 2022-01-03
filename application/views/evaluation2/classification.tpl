{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
{include_php file=$zHeader}
<div class="page-header">
	<div class="row align-items-center">
		<div class="col-12">
			<h3 class="page-title">CLASSIFICATION DES AGENTS PAR GROUPE DE FONCTION</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
				<li class="breadcrumb-item"><a href="{$zBasePath}">RH</a></li>
				<li class="breadcrumb-item"><a href="{$zBasePath}">Evaluation</a></li>
				<li class="breadcrumb-item">Classification</li>
			</ul>
		</div>
	</div>
</div>
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<table border="1">
		  <tr>
			<th style="vertical-align:middle" rowspan="2">AGENTS DE SURFACE</th>
			<th style="vertical-align:middle" rowspan="2">AGENTS EXECUTANTS</th>
			<th  colspan="2">CADRES SUPERIEURS</th>
		  </tr>
		  <tr>
			<th>Agents d'encadrement</th>
			<th>Dirigeants</th>
		  </tr>
		  <tr>
			<td>Coursier</td>
			<td>Chef de bureau</td>
			<td>Chef de service</td>
			<td>Ministre</td>
		  </tr>
		   <tr>
			<td>Chauffeurs</td>
			<td>Assistant</td>
			<td>Chef de division</td>
			<td>Secrétaire Général</td>
		  </tr>
		   <tr>
			<td>Gardien</td>
			<td>Personnel de surface</td>
			<td>Chef de section</td>
			<td>Directeur Général</td>
		  </tr>
		   <tr>
			<td></td>
			<td>Secrétaire</td>
			<td></td>
			<td>Directeur</td>
		  </tr>
		  <tr>
			<td></td>
			<td>Chargé d'Etudes</td>
			<td></td>
			<td>Coordonnateur</td>
		  </tr>
		  <tr>
			<td></td>
			<td>Comptable</td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td>Médecin</td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td>Infirmier</td>
			<td></td>
			<td></td>
		  </tr>
		  
		</table>
	</div>
	<div id="calendar"></div>
	</div>
</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>
<input type="hidden" name="zUrlFiche" id="zUrlFiche" value="{$zBasePath}avis/fiche/titre-de-paiement">
<input type="hidden" name="zUrlImpression" id="zUrlImpression" value="{$zBasePath}avis/imprimer/titre-de-paiement">
{literal}
<style>

#ContentBloc td { 
border: 1px solid #e2e2e2!important;
color: #3d423e;
}

table tr th:first-child {
     border-radius: 0px !important; 
}

table tr th:last-child {
     border-radius: 0px !important; 
}

table tr th {
    background: rgba(0, 0, 0, 0.2) !important;
	border:1px solid black;
}

</style>
{/literal}
{include_php file=$zFooter}
</div>

</body>
</html>