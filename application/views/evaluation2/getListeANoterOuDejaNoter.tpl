<div id="table-liste-evaluer-{$iModeId}_wrapper" class="dataTables_wrapper form-inline" role="grid">
	 <table id="table-liste-evaluer-{$iModeId}" class="dataTable no-footer" aria-describedby="table-liste-evaluer-1_info">
		<thead>
			<tr>
				<th>&nbsp;</th>
				<th>Nom</th>
				<th>Pr&eacute;nom</th>
				<th>Matricule</th>
				<th>Lieu de Service</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			{assign var=iIncrement111 value=1}
			{if sizeof($toListe)>0}
			{foreach from=$toListe item=oListeAgent }
			<tr>
				<td>
					<img src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload/{$oListeAgent.id}.{$oListeAgent.type_photo}" style="width:50px;height:50px;border-radius: 50%;">
				</td>
				<td>{$oListeAgent.nom}</td>
				<td>{$oListeAgent.prenom}</td>
				<td>{$oListeAgent.matricule}</td> 
				<td>{$oListeAgent.path}</td> 
				<td>
					<a class="btn btn-sm btn-primary dialog-link mt-2" iAgentId="{$oListeAgent.user_id}">Evaluer</a>
					&nbsp;&nbsp;&nbsp;
					<!--a class="btn btn-sm  btn-danger dialog-link-manuel-localite mt-2" title="Supprimer" alt="Supprimer" dataSuppr="{$oListeAgent.user_id}" class="action suppr" iAgentId="{$oListeAgent.user_id}">Supprimer</a-->
				</td>
			</tr>
			
			{/foreach}
			{else}
			<tr><td style="text-align:center;" colspan="4">Aucun enregistrement correspondant</td></tr>
			{/if}
		</tbody>
	</table>
</div>
{literal}
<script>
$(document).ready (function ()
{
	
	$( ".dialog-link" ).click(function( event ) {
		$("#userANoteId").val("");
		$("#noteOfUserId").val("");
		$("#dialog").html();
		var iUserId = $(this).attr("iAgentId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}critere/getInfoUser/" + iUserId ,
			type: 'get',
			data: { 
				iEvaluateur:1,
				iAnneeSelected : $('#iAnnee').val(),
				iMoisSelected : $('#iPeriode').val()
			},
			success: function(data, textStatus, jqXHR) {
				
				$("#dialog").html(data);	
				$( "#dialog" ).dialog( "open" );
				
				event.preventDefault();
			},
			async: false
		});
		
	});

	$( ".dialog-link-localite" ).click(function( event ) {
		$("#dialog2").html();
		var iUserId = $(this).attr("iAgentId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}critere/getInfoUserChangeLocalite/" + iUserId ,
			type: 'get',
			data: { iEvaluateur:1},
			success: function(data, textStatus, jqXHR) {
				
				$("#dialog2").html(data);	
				$( "#dialog2" ).dialog( "open" );
				
				event.preventDefault();
			},
			async: false
		});
		
	});

	$( ".dialog-link-manuel-localite" ).click(function( event ) {
		$("#dialog3").html();
		var zTitle = $(this).attr("title");
		var iUserTarget = $(this).attr("iAgentId");
		$("#iUserId").val(iUserTarget);
		switch (zTitle) {

			case "Supprimer":
				$('#dialog3').dialog('option', 'title', 'Suppression d\'un agent dans la liste des évalués');
				//$('#buttonId').button('option', 'label', 'Supprimer');
				$('#buttonId').html('Supprimer');
				$('#iModeForChange').val(1);
				var iUserTarget = $(this).attr("iAgentId");
				var iModeForChange = $('#iModeForChange').val();
				break;

			case "Approuver":
				$('#dialog3').dialog('option', 'title', 'Approuvé l\' agent dans la liste des évalués');
				//$('#buttonId').button('option', 'label', 'Approuver');
				$('#buttonId').html('Approuver');
				$('#iModeForChange').val(2);
				var iUserTarget = $(this).attr("iAgentId");
				var iModeForChange = $('#iModeForChange').val();
				break;

			case "Desapprouver":
				$('#dialog3').dialog('option', 'title', 'Désapprouvé l\' agent dans la liste des évalués');
				//$('#buttonId').button('option', 'label', 'Désapprouvé');
				$('#buttonId').html('Désapprouvé');
				$('#iModeForChange').val(3);
				var iUserTarget = $(this).attr("iAgentId");
				var iModeForChange = $('#iModeForChange').val();
				break;

			case "Changement":
				$('#dialog3').dialog('option', 'title', 'Changement situation administrative');
				//$('#buttonId').button('option', 'label', 'Modifier');
				$('#buttonId').html('Modifier');
				$('#iModeForChange').val(4);
				var iUserTarget = $(this).attr("iAgentId");
				var iModeForChange = $('#iModeForChange').val();
				break;


		}
		
		var iUserId = $(this).attr("iAgentId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}critere/getInfoChangeManuel/" + iUserId ,
			type: 'post',
			data: { iModeForChange:iModeForChange,iUserTarget:iUserTarget},
			success: function(data, textStatus, jqXHR) {
				
				$("#dialog3").html(data);	
				$( "#dialog3" ).dialog( "open" );
				
				event.preventDefault();
			},
			async: false
		});
		
	});

	// Hover states on the static widgets
	$( ".dialog-link, #icons li" ).hover(
		function() {
			$( this ).addClass( "ui-state-hover" );
		},
		function() {
			$( this ).removeClass( "ui-state-hover" );
		}
	);

	// Link to open the dialog
	{/literal}
	{if sizeof($toListe)>0}
	{literal}
	$("#table-liste-evaluer-{/literal}{$iModeId}{literal}").dataTable();
	{/literal}
	{/if}
	{literal}
})
</script>
{/literal}