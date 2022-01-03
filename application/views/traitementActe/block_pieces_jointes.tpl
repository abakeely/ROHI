<div id="saisieActe">
	<div class="panel-body">
		<h3>Pieces jointes</h3>
	</div>
	<div class="row">
		<input type="hidden" value="INITIATLISATION_DU_PROJET_ACTE" id="ticket_niveau"/>
		{foreach from=$oData.list_pieces_jointes item=oPiecesJointes }
			<div class="form col-md-8">
			  <input type="checkbox"  value="{$oPiecesJointes.id}" name="pieces_jointes">
			  <label for="pieces_jointes">{$oPiecesJointes.pieces_libelle}</label>
			</div>
		{/foreach}
	</div>
	<div class="row">
		
	</div>
</div>