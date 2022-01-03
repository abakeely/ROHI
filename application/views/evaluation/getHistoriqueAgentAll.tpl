
<div class="row">
		<div class="col-sm-12">
		
				<div class="table-responsive">
<table id="evaluation-table">
	
		
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th style="width:10px;">Date</th>
						<th style="width:30%;">Evaluateur</th>
						<th>Note efficacité</th>
						<th>Note Ponctualité</th>
						<th style="width:20px;">Mois</th>
						<th style="width:20px;">Ann&eacute;e</th>
						<th style="width:12%">Fiche Evaluation</th>
					</tr>
				</thead>
				<tbody>
					{assign var=iIncrement value="0"}
					{if sizeof($oListeHistoriqueAgent)>0}
					{foreach from=$oListeHistoriqueAgent item=oListeHistorique }
					{assign var=iMois value=$oListeHistorique.noteEvaluation_moisNote}
					<tr {if $iIncrement%2 == 0} class="even" {/if}>
						<td style="width:10px;">{$oListeHistorique.noteEvaluation_dateNotation|date_format:"%d/%m/%Y"}</td>
						<td>{$oListeHistorique.nomEvaluateur}</td>
						<td>{if $oListeHistorique.noteEvaluation_noteValue != ''}{$oListeHistorique.noteEvaluation_noteValue|replace:'.':','}/5{/if}</td>
						<td>{if $oListeHistorique.noteEvaluation_notePonctualite != ''}{$oListeHistorique.noteEvaluation_notePonctualite|replace:'.':','}/5{/if}</td>
						<td style="width:15px;">{$toMonth.$iMois}</td>
						<td style="width:15px;">{$oListeHistorique.noteEvaluation_anneeNote}</td>
						<td style="text-align:center;width:30px;"><a href="{$zBasePath}cv/fpdf_fe/{$oListeHistorique.iCandidatId}?iDate={$oListeHistorique.noteEvaluation_id}" target="_blank"><i class="la la-file-pdf-o" aria-hidden="true" tada-toggle="tooltip" data-original-title="Fiche Evaluation"></i></a></td>
					</tr>
					{assign var=iIncrement value=$iIncrement+1}
					{/foreach}
					{else}
					<tr><td style="text-align:center;border:none" colspan="6">Aucune note pour l'agent</td></tr>
					{/if}
				</tbody>
			</table>
		</div>

</table>
</div>
</div>
{literal}
<style>
th, td {
font-size:13px
}
</style>
{/literal}