<div id="saisieActe">
	<div class="panel-body">
		<h3>Information de l'acte</h3>
	</div>
	<div class="row">
		<input type="hidden" value="INITIATLISATION_DU_PROJET_ACTE" id="ticket_niveau"/>
		<div class="form col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Numero du projet(*) </b></label>
			</div>
			<input type="text" class="form-control obligatoire" placeholder="Numero de l'acte"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ticket_sigle" value="">
		</div>
		<div class="form col-md-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Designation de l'acte(*) </b></label>
			</div>
			<!--input type="text" class="form-control obligatoire" placeholder="Decret / Arrete / Decision"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ticket_designation" value=""-->
			<select id="ticket_designation" name="ticket_designation" class="form-control obligatoire" placeholder="Mouvement" data-placement="top" data-toggle="tooltip">
				<option  value="--select--">Selectionner</option>
				<option  value="Decret">Decret</option>
				<option  value="Arrete">Arrete</option>
				<option  value="Decison">Decison</option>
			</select>
		</div>
		<div class="form col-md-5">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Portant(*) </b></label>
			</div>
			<input type="text" class="form-control obligatoire" placeholder="Portant"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ticket_libelle" value="">
		</div>
		<div class="form col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Du(*) </b></label>
			</div>
			<input type="text" class="form-control obligatoire datepicker" placeholder="Date de l'acte"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="date_acte" value="">
		</div>
	</div>
	<div class="row">
		<div class="form col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Statut (*) </b></label>
			</div>
			<select id="ticket_statut_agent" name="ticket_statut_agent" class="form-control obligatoire" placeholder="Statut de l'agent" data-placement="top" data-toggle="tooltip">
				<option  value="1">Fonctionnaire</option>
				<option  value="2">Non Fonctionnaire</option>
			</select>
		</div>
		<div class="form col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Matricule(*) </b></label>
			</div>
			<input type="text" class="form-control obligatoire" placeholder="Matricule"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Matricule"  id="ticket_matricule" value="">
		</div>
		<div class="form col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Poste Agent Numero(*) </b></label>
			</div>
			<div id="wrap_poste_agent_numero"></div>
			<!--input type="text" class="form-control obligatoire" placeholder="Poste Agent Numero"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ticket_poste_agent_numero" value=""--->
		</div>
		<div class="form col-md-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Groupe Mouvement(*) </b></label>
			</div>
			<select class="form-control obligatoire" placeholder="Groupe des actes" data-placement="top" data-toggle="tooltip" onchange="setSubCategory('t_projet','projet_groupe_id',this.value,'ticket_processus_code')">
				<option  value="-1">Selectionner</option>
				{foreach from=$oData.toGroupeActes item=oGroupeActe }
					<option value="{$oGroupeActe.id}">{$oGroupeActe.id}--{$oGroupeActe.projet_groupe_libelle}</option>
				{/foreach}
			</select>
			
		</div>
		<div class="form col-md-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Mouvement(*) </b></label>
			</div>
			<select id="ticket_processus_code" class="form-control obligatoire" placeholder="Mouvement" data-placement="top" data-toggle="tooltip" >
				<option  value="-1">Selectionner</option>
			</select>
			
		</div>
	</div>
	<div class="row">
		<div class="form col-md-12">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Commentaire(*) </b></label>
			</div>
			<textarea class="form-control" id="ticket_commentaire" name="zLocalite" style="width:100%;height:110px;"></textarea>
		</div>
	</div>
</div>