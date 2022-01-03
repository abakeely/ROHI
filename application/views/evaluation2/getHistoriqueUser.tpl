<form>
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
		{assign var=iIncrement value="0"}
		{if sizeof($oListeHistoriqueAgent)>0}
		{foreach from=$oListeHistoriqueAgent item=oListeHistorique }
		{assign var=iMois value=$oListeHistorique.noteEvaluation_moisNote}
		<tr {if $iIncrement%2 == 0} class="even" {/if}>
			<td>{$oListeHistorique.noteEvaluation_dateNotation|date_format:"%d/%m/%Y"}</td>
			<td>{$oListeHistorique.nomEvaluateur}</td>
			<td>{if $oListeHistorique.fMoyenneNote!='0'}{$oListeHistorique.fMoyenneNote|number_format:1:",":"."} / 20{/if}</td>
			<td>{if $oListeHistorique.noteEvaluation_evaluable == 1}Oui{else}Non{/if}</td>
			<td>{$oListeHistorique.periode}</td>
			<td>{$oListeHistorique.noteEvaluation_anneeNote}</td>
			<td><a href="{$zBasePath}cv/fpdf_fe/{$oListeHistorique.iCandidatId}?iDate={$oListeHistorique.noteEvaluation_id}" target="_blank"><i class="la la-file-pdf-o" aria-hidden="true" tada-toggle="tooltip" data-original-title="Fiche Evaluation"></i></a>
			&nbsp;&nbsp;<a href="#" title="" class="tooltip">
						Récapitulation
						<span style="width:500px;top:-350px;left:-300px;background: rgb(54, 133, 152);color:white;">	
								<h1 class="recap">{$oListeHistorique.periode}</h1>
								<br/>
								{$oListeHistorique.zCritereAndNote}
						</span>
					</a>
			</td>
		</tr>
		{assign var=iIncrement value=$iIncrement+1}
		{/foreach}
		{else}
		<tr><td style="text-align:center;border:none" colspan="7">Aucune note pour l'agent</td></tr>
		{/if}
	</tbody>
</table>
</form>