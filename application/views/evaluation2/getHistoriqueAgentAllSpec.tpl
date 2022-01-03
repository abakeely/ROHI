<div class="row separateur"><div class="col-md-12">Les notes d'évaluation trimestrielles de {$oCandidatUser.0->nom}&nbsp;{$oCandidatUser.0->prenom} {$zSuite}</div></div>
<br>
<table id="evaluation-table">
	<tr>
		<td colspan="2" style="border:none">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th>Date</th>
						<th>Evaluateur</th>
						<th>Moyenne</th>
						<th>Evaluable</th>
						<th>Période</th>
						<th>Ann&eacute;e</th>
						<th>Fiche Evaluation</th>
					</tr>
				</thead>
				<tbody>
					{if sizeof($oListeHistoriqueAgentNew)>0}
						{assign var=iIncrement value="0"}
						{foreach from=$oListeHistoriqueAgentNew item=oListeHistorique }
						{assign var=iMois value=$oListeHistorique.noteEvaluation_moisNote}
						<tr {if $iIncrement%2 == 0} class="even" {/if}>
							<td>{$oListeHistorique.noteEvaluation_dateNotation|date_format:"%d/%m/%Y"}</td>
							<td>{$oListeHistorique.nomEvaluateur}</td>
							<td>{if $oListeHistorique.fMoyenneNote!='0'}{$oListeHistorique.fMoyenneNote|number_format:1:",":"."} / 20{/if}</td>
							<td>{if $oListeHistorique.noteEvaluation_evaluable == 1}Oui{else}Non{/if}</td>
							<td>{$oListeHistorique.periode}</td>
							<td>{$oListeHistorique.noteEvaluation_anneeNote}</td>
							<td style="text-align:center"><a href="{$zBasePath}cv/fpdf_feNew/{$oListeHistorique.iCandidatId}?iDate={$oListeHistorique.noteEvaluation_id}" target="_blank"><i class="la la-file-pdf-o" aria-hidden="true" tada-toggle="tooltip" data-original-title="Fiche Evaluation"></i></a>
							{*&nbsp;&nbsp;<a href="#" title="" class="tooltip">
										Récapitulation
										<span style="width:500px;top:-350px;left:-300px;background: rgb(54, 133, 152);color:white;">	
												<h1 class="recap" style="text-align:center">{$oListeHistorique.periode}</h1>
												<br/>
												{$oListeHistorique.zCritereAndNote}
										</span>
									</a>*} 
							</td>
						</tr>
						{assign var=iIncrement value=$iIncrement+1}
						{/foreach}
					{else}
					<tr>
						<td colspan="7" style="text-align:center">Aucune note pour cet agent</td>
					</tr>
					{/if}
				</tbody>
			</table>
			{$oData.zPagination}
		</td>
	</tr>
</table>

{literal}
<style>
th, td {
font-size:13px
}
h1.recap {
	font-size:1.4em;
	color:white;
	font-weight:blod;
	border-bottom:1px solid white;
	padding-bottom:12px;
}
#noteCritere th { 
	border: 1px solid #e2e2e2!important;
	text-align:center;
	background: #357c6e;
	font-weight:bold;
}

#noteCritere td { 
	border: 1px solid #e2e2e2!important;
	color: #3d423e;
}

#noteCritere {
	margin:0!important ;
	font-size:1em!important;
}
.notationCritere
{
	margin:0!important ;
	border:none!important;
}

.etoile
{
	padding:5px!important ;
}
input[type=radio] {
    height:20px;
	width:20px; 
	vertical-align: middle;
}
</style>
{/literal}