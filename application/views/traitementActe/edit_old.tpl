{include_php file=$zCssJs}
<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
{include_php file=$zHeader}
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<h2>Initialisation du projet d'acte</h2>
		<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="#">RH</a> <span>&gt;</span> <a href="#">Gestion des absences</a> <span>&gt;</span> Suivi des actes</div>
		<div class="clear"></div>
			<div id="innerContent">
            <div id="saisieActe">
				<div class="panel-body">
					<h3>Information de l'acte</h3>
				</div>
				<div class="row">
					<div class="col-md-2">
						<div class="libele_form">
							<label class="control-label label_rohi " data-original-title="" title=""><b> Numero du ticket(*) </b></label>
						</div>
						<input type="text" class="form-control" placeholder="Numero du ticket"  name="ticket_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ticket_code" value="{$oData.ticket_code}">
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
						<input type="text" class="form-control" placeholder="Portant"  name="ticket_processus_code" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ticket_processus_code" value="" readonly="true" class="readonly">
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
						<input type="text" class="form-control datepicker" placeholder="nouveau_date_effet"  name="nouveau_date_effet" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_date_effet" value="" >
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
						<input type="text" class="form-control" placeholder="VISA FIN"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
					</div>
					<div class="row1">
						<div class="libele_form">
							<label class="control-label label_rohi " data-original-title="" title=""><b>Date visa fin(*) </b></label>
						</div>
						<input type="text" class="form-control" placeholder="Date visa fin"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
					</div>
					<div class="row1">
						<div class="libele_form">
							<label class="control-label label_rohi " data-original-title="" title=""><b>Signataire visa fin(*) </b></label>
						</div>
						<input type="text" class="form-control" placeholder="Signataire visa fin"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
					</div>
					<div class="row1">
						<div class="libele_form">
							<label class="control-label label_rohi " data-original-title="" title=""><b>Visa Cde(*) </b></label>
						</div>
						<input type="text" class="form-control" placeholder="VISA Cde"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value=""> 
					</div>
					<div class="row1">
						<div class="libele_form">
							<label class="control-label label_rohi " data-original-title="" title=""><b>Date visa Cde(*) </b></label>
						</div>
						<input type="text" class="form-control" placeholder="Date visa Cde"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
					</div>
					<div class="row1">
						<div class="libele_form">
							<label class="control-label label_rohi " data-original-title="" title=""><b>Signataire visa Cde(*) </b></label>
						</div>
						<input type="text" class="form-control" placeholder="Signataire visa Cde"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="" >
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
						<select class="form-control" placeholder="Departement"  onChange="getLocaliteCv('{$zBasePath}',1,this.value);" name="departement" data-toggle="tooltip" data-original-title= "Safidio ny Departemanta na sampan-draharaha misy anao" id="departement"{if $zRole=='chef'}{/if}>
							<option  value="0">-------</option> 
							{foreach from=$oData.list_departement item=oDepartement}
								{if $oDepartement.id != 1}
								<option  value={$oDepartement.id} {if $oDepartement.id==$oCandidatCv->departement}selected="selected"{/if}>{$oDepartement.libele}</option>
								{/if}
							{/foreach}
						</select>
					</div>
					<div class="col-sm-2" id="iLocalite_1">
						{$oData.zSelectDirection}
					</div>
					<div class="col-sm-2" id="iLocalite_2">
						{$oData.zSelectService}
					</div>
					<div class="col-sm-2" id="iLocalite_3">
						{$oData.zSelectSouService}
					</div>
					<div class="col-sm-2"  id="iLocalite_4">
						{$oData.zSelectDivision}
					</div>
					<div class="col-sm-2" id="iLocalite_5">
							{$oData.zSelectBureau}
					</div>
				</div>
				<div class="panel-body" >
					<h3>Avancements successifs</h3>
				</div>
				<div class="row">
					<h2 style="float:right;font-size:14px;margin:-52px 0 0 0;min-width:150px;" onclick="ajouterAvancement()">+Ajouter avancements</h2>
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
					<h2 style="float:right;font-size:14px;margin:-52px 0 0 0;min-width:150px;" onclick="ajouterRubrique()">+Ajouter rubriques</h2>
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
			
			<div class="panel-body">
				<div class="row">
					<div class="col-md-4">
						<a class="form-control btn-primary bouton" onclick="saveActe()" type="submit"/>ENREGISTRER</a>
					</div>
				</div>
			</div>
		</div>.               
	</div>

</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>

</form>
{include_php file=$zFooter}
</div>
{literal}

<script>

$(document).ready(function(){
		$( ".datepicker" ).datepicker({
			dateFormat: "dd/mm/yy",
			showOtherMonths: true,
			selectOtherMonths: false,

		});
		var ticket_code = $("#ticket_code").val();
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}TraitementActe/getInfoTicket/",
			type: 'post',
			data: {
				ticket_code:ticket_code
			},
			success: function(data, textStatus, jqXHR) {
				var data				=	JSON.parse(data);
				$("#ticket_designation").val(data.ticket_designation);
				$("#ticket_libelle").val(data.ticket_libelle);
				$("#ticket_processus_code").val(data.ticket_processus_code);

				var poste_agent_numero	=	data.ticket_poste_agent_numero;
				getInfoAgent(poste_agent_numero);

				var mouvement_code		=	data.ticket_processus_code;
				getInfoFields(mouvement_code);

			}
		});

		
	});
	
	function saveActe(){
		$.ajax({
				url: "{/literal}{$zBasePath}{literal}TraitementActe/majDerniereSituation",
				type: 'post',
				data: {
					poste_agent_numero	: $("#poste_agent_numero").val(),
					ticket_code			: $("#ticket_code").val(),
					mouvement_code		: $("#ticket_processus_code").val(),
					niveau_mouvement	: "SAISIE",
					nouveau_date_effet	: $("#nouveau_date_effet").val(),
					statut				: "SAISIE",
					nouveau_corps_code	: $("#nouveau_corps_code").val(),
					nouveau_grade_code	: $("#nouveau_grade_code").val(),
					nouveau_indice		: $("#nouveau_indice").val(),
					nouveau_soa_code	: $("#nouveau_soa_code").val(),
					nouveau_uadm_code	: $("#nouveau_uadm_code").val(),
					nouveau_section_code: $("#nouveau_section_code").val(),
					nouveau_date_debut_contrat	: $("#nouveau_date_debut_contrat").val(),
					nouveau_date_fin_contrat	: $("#nouveau_date_fin_contrat").val(),
					nouveau_localite_service	: $("#nouveau_localite_service").val(),
					nouveau_fiv_code			: $("#nouveau_fiv_code").val(),
					nouveau_region_code			: $("#nouveau_region_code").val(),
					nouveau_sanction_code		: $("#nouveau_sanction_code").val(),
					nouveau_hee_code			: $("#nouveau_hee_code").val(),
					nouveau_categorie_code		: $("#nouveau_categorie_code").val(),
					nouveau_mode_paiement		: $("#nouveau_mode_paiement").val(),
					nouveau_numero_compte		: $("#nouveau_numero_compte").val(),
				},
				success: function(data, textStatus, jqXHR) {  
					cleanFields();
					alert(" Ticket Numero : "+data);
				}
		});
	}

	function getInfoAgent(poste_agent_numero){ticket_code
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}TraitementActe/getInfoAgent/",
			type: 'post',
			data: {
				poste_agent_numero:poste_agent_numero
			},
			success: function(data, textStatus, jqXHR) {
				var resultat = JSON.parse(data);
				$("#poste_agent_numero").val(resultat.poste_agent_numero);
				$("#agent_matricule").val(resultat.agent_matricule);
				$("#agent_nom").val(resultat.agent_nom);
				$("#agent_prenoms").val(resultat.agent_prenoms);
				$("#agent_cin").val(resultat.agent_cin);
				$("#agent_date_nais").val(resultat.agent_date_nais);
				if(resultat.sit_matrimoniale){
					$("#sit_matrimoniale").val(resultat.sit_matrimoniale);
				}else{
					$("#sit_matrimoniale").val("C");
				}
				$("#agent_sexe").val(resultat.agent_sexe);
				$("#enfant_mineur").val(resultat.enfant_mineur);
				$("#enfant_majeur").val(resultat.enfant_majeur);
				$("#code_logement").val(resultat.code_logement);
				$("#code_ameublement").val(resultat.code_ameublement);
				$("#sanction_code").val(resultat.sanction_code);
				$("#section_code").val(resultat.section_code);
				$("#soa_code").val(resultat.soa_code);
				$("#corps_code").val(resultat.corps_code);
				$("#categorie_code").val(resultat.categorie_code);
				$("#grade_code").val(resultat.grade_code);
				$("#categorie_code").val(resultat.categorie_code);
				$("#indice").val(resultat.indice);
				$("#mode_paiement").val(resultat.mode_paiement);
				$("#numero_compte").val(resultat.numero_compte);
				$("#hee_code").val(resultat.hee_code);
				

				$("#nouveau_enfant_mineur").val(resultat.enfant_mineur);
				$("#nouveau_enfant_majeur").val(resultat.enfant_majeur);
				$("#nouveau_code_logement").val(resultat.code_logement);
				$("#nouveau_code_ameublement").val(resultat.code_ameublement);
				$("#nouveau_sanction_code").val(resultat.sanction_code);
				$("#nouveau_section_code").val(resultat.section_code);
				$("#nouveau_soa_code").val(resultat.soa_code);
				$("#nouveau_corps_code").val(resultat.corps_code);
				$("#nouveau_grade_code").val(resultat.grade_code);
				$("#nouveau_categorie_code").val(resultat.categorie_code);
				$("#nouveau_indice").val(resultat.indice);
				$("#nouveau_mode_paiement").val(resultat.mode_paiement);
				$("#nouveau_numero_compte").val(resultat.numero_compte);
				$("#nouveau_hee_code").val(resultat.hee_code);
				$("#nouveau_date_debut_contrat").val(resultat.date_debut_contrat);
				$("#nouveau_date_fin_contrat").val(resultat.date_fin_contrat);

				
			}
		});
	}

	function getInfoFields(mouvement_code){
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}TraitementActe/getFields/",
			type: 'post',
			data: {
				mouvement_code: mouvement_code
			},
			success: function(data, textStatus, jqXHR) {
				var mouvement_champ     = data;
				var tz_mouvement_champ  = mouvement_champ.split(";");
				for (var iIndex = 0;iIndex<tz_mouvement_champ.length ;iIndex++ ){
					$("#nouveau_"+tz_mouvement_champ[iIndex].trim()).removeAttr("readonly");
				}
			}
		});
	}

	function getMissionAll(poste_agent_numero){
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}TraitementActe/getMissionAll/",
			type: 'post',
			data: {
				poste_agent_numero: poste_agent_numero
			},
			success: function(data, textStatus, jqXHR) {
				var resultat = JSON.parse(data);
			}
		});
	}

	function ajouterRubrique(){
		var ligne =         '<div class="row">';
		var ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Code Rubrique(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Code Rubrique"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

		    ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Nombre/Jour/Annee(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Nombre/Jour/Annee"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

			ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Montant(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Montant"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

			ligne = ligne + '<div class="col-sm-3">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Date debut(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Date debut"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

			ligne = ligne + '<div class="col-sm-3">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Date fin(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Date fin"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

		$("#table_rubriques").append(ligne);
	} 

	function ajouterAvancement(){
		var ligne =         '<div class="row">';
		var ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Code Corps(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Code Corps"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

		    ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Code Grade(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Code Grade"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

			ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Indice(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Indice"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

			ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Date d\'effet solde(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Date d\'effet solde"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

			ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Anciente conserve(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Anciente conserve"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

			ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Date fin/ Date anciente conserve(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Date fin/ Date anciente conserve"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

		$("#table_avancements").append(ligne);
	} 

</script>
{/literal}
</body>
</html>