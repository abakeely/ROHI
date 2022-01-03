<div id="saisieActe">
	<div class="panel-body">
		<h3>Information de l'acte</h3>
	</div>
	<div class="row">
		<input type="hidden" value="ATTRIBUTION_VISA" id="ticket_niveau"/>
		<div class="col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Numero du ticket(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Numero du ticket"  name="ticket_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ticket_code" value="">
		</div>
		<div class="col-md-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Designation de l'acte(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Designation de l'acte"  name="ticket_designation" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ticket_designation" value="" readonly="true" class="readonly">
		</div>
		<div class="col-md-5">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Portant(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Portant"  name="ticket_libelle" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ticket_libelle" value="" readonly="true" class="readonly">
		</div>
		<div class="col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Code Mvt(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code Mvt"  name="ticket_processus_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ticket_processus_code" value="" readonly="true" class="readonly">
		</div>
	</div>
	<div class="panel-body">
		<h3>Identification de l'agent</h3>
	</div>

	<div class="row">
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Matricule(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Matricule"  name="poste_agent_numero" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="poste_agent_numero" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Cin(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Cin"  name="agent_cin" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="agent_cin" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-4">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Nom(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Nom"  name="agent_nom" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="agent_nom" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Prenoms(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Prenoms"  name="agent_prenoms" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="agent_prenoms" value="" readonly="true" class="readonly">
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Date de naissance(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Date de naissance"  name="agent_date_nais" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="agent_date_nais" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Situation Matrimoniale(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Situation Matrimoniale"  name="sit_matrimoniale" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="sit_matrimoniale" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Sexe(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Sexe"  name="agent_sexe" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="agent_sexe" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-4">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Matricule conjointe(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Matricule conjointe"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="INDEFINI" readonly="true" class="readonly">
		</div>
	</div>

	<div class="row">
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Nombre d'enfants(-20 ans)(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Nombre d'enfants(-20 ans)"  name="enfant_mineur" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="enfant_mineur" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Nombre d'enfants(+20 ans)(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Nombre d'enfants(+20 ans)"  name="enfant_majeur" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="enfant_majeur" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Code logement(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code logement"  name="code_logement" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="code_logement" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code ameublement(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code ameublement"  name="code_ameublement" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="code_ameublement" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code sanction(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code sanction"  name="sanction_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="sanction_code" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code section(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code section"  name="section_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="section_code" value="" readonly="true" class="readonly">
		</div>
	</div>
	<div class="panel-body">
		<h3>Situation de l'agent(Ancienne position)</h3>
	</div>
	<div class="row">
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code budget(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code budget"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="00" readonly="true" class="readonly">
		</div>
		<div class="col-sm-4">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code imputation budgetaire(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code imputation budgetaire"  name="soa_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="soa_code" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code corps(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code corps"  name="corps_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="corps_code" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code grade(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code grade"  name="grade_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="grade_code" value="" readonly="true" class="readonly">
		</div>
	</div>
	<div class="row">
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Categorie code(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code Hee"  name="categorie_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="categorie_code" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Indice(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Indice"  name="indice" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="indice" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code Hee(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code Hee"  name="hee_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="hee_code" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code localite de service(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code localite de service"  name="localite_service" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="localite_service" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Mode paiement(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Mode paiement"  name="mode_paiement" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="mode_paiement" value="" readonly="true" class="readonly">
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Numero de compte bancaire ou CP(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Numero de compte bancaire ou CP"  name="numero_compte" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="numero_compte" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-4">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Anciente conserve(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Anciente conserve"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-4">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Bonification(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Bonification"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="" readonly="true" class="readonly">
		</div>
	</div>
	<div class="panel-body">
		<h3>Situation de l'agent(Nouvelle position)</h3>
	</div>
	<div class="row">
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code budget(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code budget"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="00" readonly="true" class="readonly">
		</div>
		<div class="col-sm-4">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code imputation budgetaire(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code imputation budgetaire"  name="nouveau_soa_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_soa_code" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code corps(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code corps"  name="nouveau_corps_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_corps_code" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code grade(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code grade"  name="nouveau_grade_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_grade_code" value="" readonly="true" class="readonly">
		</div>
	</div>
	<div class="row">
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code categorie(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code categorie"  name="nouveau_categorie_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_categorie_code" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code Hee(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code Hee"  name="nouveau_hee_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_hee_code" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Indice(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Indice"  name="nouveau_indice" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_indice" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-4">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code localite de service(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code localite de service"  name="nouveau_localite_service" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_localite_service" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Mode paiement(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Mode paiement"  name="nouveau_mode_paiement" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_mode_paiement" value="" readonly="true" class="readonly">
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Numero de compte bancaire ou CP(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Numero de compte bancaire ou CP"  name="nouveau_numero_compte" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_numero_compte" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-4">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Anciente conserve(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Anciente conserve"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="" readonly="true" class="readonly">
		</div>
		<div class="col-sm-4">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Bonification(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Bonification"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="" readonly="true" class="readonly">
		</div>
	</div>

	<div class="row">
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Nombre d'enfants(-20 ans)(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Nombre d'enfants(-20 ans)"  name="nouveau_enfant_mineur" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_enfant_mineur" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Nombre d'enfants(+20 ans)(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Nombre d'enfants(+20 ans)"  name="nouveau_enfant_majeur" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_enfant_majeur" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Code logement(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code logement"  name="nouveau_code_logement" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_code_logement" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code ameublement(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code ameublement"  name="nouveau_code_ameublement" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_code_ameublement" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code sanction(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code sanction"  name="nouveau_sanction_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_sanction_code" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code section(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code section"  name="nouveau_section_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_section_code" value="" readonly="true" class="readonly">
		</div>
	</div>
	<div class="row">
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Date debut contrat(*) </b></label>
			</div>
			<input type="text" class="form-control datepicker" placeholder="nouveau_date_effet"  name="nouveau_date_debut_contrat" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_date_debut_contrat" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Date fin contrat(*) </b></label>
			</div>
			<input type="text" class="form-control datepicker" placeholder="nouveau_date_effet"  name="nouveau_date_fin_contrat" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_date_fin_contrat" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Date d'effet(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="nouveau_date_effet"  name="nouveau_date_effet" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_date_effet" value="" readonly="true" class="readonly">
		</div>
	</div>
	<div class="panel-body">
		<h3>VISAS</h3>
	</div>
	<div class="row">
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Visa fin(*) </b></label>
			</div>
			<input type="text" class="form-control obligatoire" placeholder="VISA FIN"  name="numero_visa_fin" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="numero_visa_fin" value="">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Date visa fin(*) </b></label>
			</div>
			<input type="text" class="form-control datepicker obligatoire" placeholder="Date visa fin"  name="date_visa_fin" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="date_visa_fin" value="">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Signataire visa fin(*) </b></label>
			</div>
			<input type="text" class="form-control obligatoire" placeholder="Signataire visa fin"  name="signataire_visa_fin" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="signataire_visa_fin" value="">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Visa Cde(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="VISA Cde"  name="numero_visa_cf" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="numero_visa_cf" value="" readonly="true" class="readonly"> 
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Date visa Cde(*) </b></label>
			</div>
			<input type="text" class="form-control datepicker" placeholder="Date visa Cde"  name="date_visa_cf" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="date_visa_cf" value="" readonly="true" class="readonly">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Signataire visa Cde(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Signataire visa Cde"  name="signataire_visa_cf" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="signataire_visa_cf" value="" readonly="true" class="readonly">
		</div>
	</div>
	<div class="panel-body">
		<h3>Rattachement</h3>
	</div>
	<div class="row">
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Departement(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Departement"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Direction(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Direction"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Service(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Service"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Division(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Division"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Bureau(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Bureau"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Sous Bureau(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Sous Bureau"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
	</div>
	<div class="panel-body" >
		<h3>Avancements successifs</h3>
	</div>
	<div class="row">
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code Corps(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code Corps"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code Grade(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code Grade"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Indice(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Indice"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Date d'effet solde(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Date d'effet solde"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Anciente conserve(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Anciente conserve"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Date fin/ Date anciente conserve(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Date fin/ Date anciente conserve"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
	</div>
	<div id="table_avancements"></div>

	<div class="panel-body">
		<h3>RUBRIQUES DE BASES ET COMPLEMENTAIRES</h3>
	</div>
	<div class="row">
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Code Rubrique(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Code Rubrique"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Nombre/Jour/Annee(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Nombre/Jour/Annee"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
		<div class="row1">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Montant(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Montant"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
		<div class="col-sm-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Date debut(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Date debut"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
		<div class="col-sm-3">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b>Date fin(*) </b></label>
			</div>
			<input type="text" class="form-control" placeholder="Date fin"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
		</div>
	</div>
	<div id="table_rubriques"></div>
</div>