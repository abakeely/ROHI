<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr>
			<th>Date</th>
			<th>Evaluateur</th>
			<th>Note efficacité</th>
			<th>Note Ponctualité</th>
			<th>Evaluable</th>
			<th>Mois</th>
			<th>Ann&eacute;e</th>
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
			<td>{if $oListeHistorique.noteEvaluation_noteValue != ''}{$oListeHistorique.noteEvaluation_noteValue|replace:'.':','} / 5{/if}</td>
			<td>{if $oListeHistorique.noteEvaluation_notePonctualite != ''}{$oListeHistorique.noteEvaluation_notePonctualite|replace:'.':','}/5{/if} </td>
			<td>{if $oListeHistorique.noteEvaluation_evaluable == 1}Oui{else}Non{/if}</td>
			<td>{$toMonth.$iMois}</td>
			<td>{$oListeHistorique.noteEvaluation_anneeNote}</td>
		</tr>
		{assign var=iIncrement value=$iIncrement+1}
		{/foreach}
		{else}
		<tr><td style="text-align:center;border:none" colspan="6">Aucune note pour l'agent</td></tr>
		{/if}
	</tbody>
</table>
{$oData.zPagination}
