<form action="{$zBasePath}gestock/save/stock/entree" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data">
	<fieldset>
		<table>
			<div class=" clearfix">
			<div class="cell">
				<div class="field">
					<table>
						<thead>
							<tr>
								<th>N°</th>
								<th>Désignation</th>
								<th>Specificités Techniques</th>
								<th>Unité</th>
								<th>Qté Min</th>
								<th>Qté Max</th>
								<th>PU</th>
								<th>Montant Min</th>
								<th>Montant Max</th>
							</tr>
						</thead>
						<tbody id="addedRows">
							{if sizeof($oData.toGetPrevisionArticle)>0}
							{assign var=iIncrement value="1"}
							{assign var=iPrixUnitaireTotal value="0"}
							{assign var=iPrixMontantMinTotal value="0"}
							{assign var=iPrixMontantMaxTotal value="0"}
							{foreach from=$oData.toGetPrevisionArticle item=oListe }
							
							
							{assign var=fPrixMontantMin value=$oListe.quantiteMin*$oListe.PrixUnitaire}
							{assign var=iQuantiteMin value=$oListe.quantiteMin|string_format:"%d"}
							{assign var=iQuantiteMax value=$iQuantiteMin*5}
							{assign var=fPrixMontantMax value=$iQuantiteMax*$oListe.PrixUnitaire}
							<tr class="even">
								<td>{$oListe.fourniture_id}</td>
								<td>{$oListe.fourniture_article}</td>
								<td>{$oListe.fourniture_specification}</td>
								<td>{$oListe.typeUnite_libelle}</td>
								<td>{$iQuantiteMin}</td>
								<td>{$iQuantiteMax|string_format:"%d"}</td>
								<td>{$oListe.PrixUnitaire|number_format:2:",":"  "}&nbsp;Ar</td>
								<td>{$fPrixMontantMin|number_format:2:",":"  "}&nbsp;Ar</td>
								<td>{$fPrixMontantMax|number_format:2:",":"  "}&nbsp;Ar</td>
							</tr>
							{assign var=iPrixUnitaireTotal value=$iPrixUnitaireTotal+$oListe.PrixUnitaire}
							{assign var=iPrixMontantMinTotal value=$iPrixMontantMinTotal+$fPrixMontantMin}
							{assign var=iPrixMontantMaxTotal value=$iPrixMontantMaxTotal+$fPrixMontantMax}
							{/foreach}
							<tr class="even" style="font-weight:bold">
								<td colspan="6" style="text-align:right"><strong>Total&nbsp;</strong></td>
								<td><strong>{$iPrixUnitaireTotal|number_format:2:",":"  "}&nbsp;Ar</strong></td>
								<td><strong>{$iPrixMontantMinTotal|number_format:2:",":"  "}&nbsp;Ar</strong></td>
								<td><strong>{$iPrixMontantMaxTotal|number_format:2:",":"  "}&nbsp;Ar</strong></td>
							</tr>
							{else}
								<tr>
									<td colspan="9">Aucun enregistrement</td>
								</tr>
							{/if}
						</tbody>
					</table>
				</div>
			</div>
		</div>	
		</table>
	</fieldset>
</form>
