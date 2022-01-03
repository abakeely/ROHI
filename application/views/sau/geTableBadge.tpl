<table id="dynamic-table" class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>Matricule</th>
			<th>Agent</th>
			<th>Num Badge</th>
			<th>Agent de saisie</th>
			<th>Date d'entrée</th>
			<th>Heure d'entrée</th>
			<th>Date de sortie</th>
			<th>Heure de sortie</th>
			<th>Action/Agent de sortie</th>
		</tr>
	</thead>
	<tbody>
		{if sizeof($toBadgeUser)>0}
		{foreach from=$toBadgeUser item=oListe }
		<tr>
			<td>
				<a href="#">{$oListe.matricule}</a>
			</td>
			<td>
				<a href="#">{$oListe.nom}&nbsp;{$oListe.prenom}</a>
			</td>
			<td>
				<a href="#">{$oListe.badge_nom}</a>
			</td>
			<td>
				{$oListe.zPrenomSaisie}
			</td>
			<td>{$oListe.attribution_dateEntree|date_format:"%d/%m/%Y"}</td>
			<td>{$oListe.attribution_heureEntree}</td>
			<td id="dateSortie_{$oListe.attribution_id}">{$oListe.attribution_dateSortie|date_format:"%d/%m/%Y"}</td>
			<td id="heureSortie_{$oListe.attribution_id}">{$oListe.attribution_heureSortie}</td>
			</td>
			<td id="bouton_{$oListe.attribution_id}">
				{if $oListe.attribution_dateSortie ==''}
				<button class="btn btn-xs btn-danger" onClick="setRendreBadge({$oListe.attribution_id})" setDemandeId="{$oListe.attribution_id}">
					Rendre le badge
					<i class="ace-icon la la-arrow-right icon-on-right"></i>
				</button>
				{else}
					{$oListe.zPrenomSortie}
				{/if}
			</td>
		</tr>
		{/foreach}
		{else}
		<tr><td style="text-align:center;border:none" colspan="12">Aucun enregistrement</td></tr>
		{/if}
	</tbody>
</table>
<script type="text/javascript">
{literal}
			
			jQuery(function($) {
			
				var myTable = 
				$('#dynamic-table')
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					 null,null,null,null,null, null,null,null,
					  { "bSortable": false }
					],
					"aaSorting": [],
					
					select: {
						style: 'multi'
					},
					"iDisplayLength": 100
				} );

			});

			function setRendreBadge(_iId)
			{
					var iAttributionId = _iId;
					$.ajax({
						url: "{/literal}{$zBasePath}{literal}sau/setUpdateAttributionDate" ,
						method: "POST",
						data: {iAttributionId:iAttributionId},
						success: function(data, textStatus, jqXHR) {
							var oReturn = jQuery.parseJSON(data);
							$("#dateSortie_"+iAttributionId).html(oReturn.zDateAttribution);
							$("#heureSortie_"+iAttributionId).html(oReturn.zHeureAttribution);
							$("#bouton_"+iAttributionId).html(oReturn.zPrenomSortie);
						},
						async: false
					});
			}


			$(document).ready (function ()
			{
				$(".submitRendreBadge").on('click', function(e) {
					
					
					var iAttributionId = $(this).attr('setDemandeId');
					$.ajax({
						url: "{/literal}{$zBasePath}{literal}sau/setUpdateAttributionDate" ,
						method: "POST",
						data: {iAttributionId:iAttributionId},
						success: function(data, textStatus, jqXHR) {
							var oReturn = jQuery.parseJSON(data);
							$("#dateSortie_"+iAttributionId).html(oReturn.zDateAttribution);
							$("#heureSortie_"+iAttributionId).html(oReturn.zHeureAttribution);
							$("#bouton_"+iAttributionId).html(oReturn.zPrenomSortie);
						},
						async: false
					});
				});
			});
{/literal}
</script>
