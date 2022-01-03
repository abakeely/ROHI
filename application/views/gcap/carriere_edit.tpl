{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<script type="text/javascript" src="{$zBasePath}assets/common/js/app/carriere.js?{$zClearCache}"></script>
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Gestion de carriere{$oData.zTitre}</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des Carri&egrave;res</a></li>
									<li class="breadcrumb-item">Edit</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
                                <ul class="tabs">
                                    <li class="tab-link {if $oData.sTab=="verify"}current{/if}" onclick="verifyValide();verifyProjetValide();" imodeid="1" data-tab="tab-1" id="liTab-1" >
                                        V&eacute;rification des pieces
                                    </li>
                                    <li class="tab-link {if $oData.sTab=="project"}current{/if}" onclick="verifyValide();verifyProjetValide();" imodeid="2" data-tab="tab-2" id="liTab-2" >
                                        &Eacute;laboration du projet
                                    </li>
                                    <li class="tab-link {if $oData.sTab=="be"}current{/if}" onclick="verifyValide();verifyProjetValide();" imodeid="3" data-tab="tab-3" id="liTab-3" >
                                        &Eacute;laboration des BE
                                    </li>
                                </ul>
                                <div id="tab-1" class="tab-content {if $oData.sTab=="verify"}current{/if}">
                                    <!--*Debut Contenue*-->
                                    <div class="row1">
                                        <form action="{$zBasePath}carriere/save/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.iId}" method="POST" name="formulaireVerification" id="formulaireVerification" enctype="multipart/form-data">
                                            <input type="hidden" name="sPar" id="sPar" value="{$oData.oVerify.sPar}">
                                            <input type="hidden" name="iTailleVerify" id="iTailleVerify" value="{$oData.oVerify.iNombrePieceaVerifier}">
                                            <fieldset id="field-1">
                                                {assign var=iIdDoc value="0"}
                                                {foreach from=$oData.oVerify.toPieceaVerifier item=oPieceaVerifier}
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="field">
                                                            <p class="ligneVerify"><input class="form-control" type="checkbox" id="doc{$iIdDoc}" name="doc{$iIdDoc}" value="{$oPieceaVerifier.pieceaVerifier_id}" {if $oPieceaVerifier.check}checked{/if}/> {$oPieceaVerifier.pieceaVerifier_libelle}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                {assign var=iIdDoc value=$iIdDoc+1}
                                                {/foreach}
                                                <div class="clearfix">
                                                    <div class="col-sm-12 text-center">
                                                        <input class="form-control" type="button" class="button" onClick="validationVerify(validerVerification);" name="" id="Suivant" value="Suivant">
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>

                                    <!--*Fin Contenue*-->
                                </div>
                                <div id="tab-2" class="tab-content {if $oData.sTab=="project"}current{/if}">
                                    <!--*Debut Contenue*-->
                                    <div class="row1">
                                        {if $oData.oProject.oElaborationProjet.elaborationProjet_type=="contrat-de-travail"}
                                        <form action="{$zBasePath}carriere/saveProject/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.iId}" method="POST" name="formulaireProjet" id="formulaireProjet" enctype="multipart/form-data">
                                            <fieldset  id="field-2">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Date du Projet</label>
                                                            <input class="form-control" type="text" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oElaborationProjet.elaborationProjet_date|date_format2}" name="dateProjet" id="dateProjet" value="{$oData.oProject.oElaborationProjet.elaborationProjet_date}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Num&eacute;ro Lettre</label>
                                                            <input class="form-control" type="text" name="numeroLettre" id="numeroLettre" value="{$oData.oProject.oContratdeTravail.contratdeTravail_numeroLettre}" placeholder="Num&eacute;ro" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Date Lettre</label>
                                                            <input class="form-control" type="text" name="dateLettre" id="dateLettre" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oContratdeTravail.contratdeTravail_dateLettre|date_format2}"value="{$oData.oProject.oContratdeTravail.contratdeTravail_dateLettre}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                {if ($oData.oProject.oContratdeTravail.contratdeTravail_par=="remplacement-numerique") || ($oData.oVerify.sPar=="remplacement-numerique")}
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Immatriculation de l'agent &agrave; remplacer</label>
                                                            <input class="form-control" type="text" name="immatriculationaRemplacer" id="immatriculationaRemplacer" value="{$oData.oProject.oCandidatRemplacement.matricule}" onclick="putMask();" onfocusout="rechercheParMatricule();" placeholder="Immatriculation" class="obligatoire chiffres"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>En remplacement num&eacute;rique de</label>
                                                            <input class="form-control" type="text" name="nomAgentaRemplacer" id="nomAgentaRemplacer" value="{$oData.oProject.oCandidatRemplacement.nom} {$oData.oProject.oCandidatRemplacement.prenom}" placeholder="Nom et Pr&eacute;nom" disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Corps de l'agent a remplacer</label>
                                                            <select id="corpsAgentaRemplacer" name="corpsAgentaRemplacer" class="form-control obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toCorps item=oCorps}
                                                                <option {if $oData.oProject.oParRemplacementNumerique.parRemplacementNumerique_CorpsId==$oCorps.id} selected="selected"{/if} value="{$oCorps.id}">{$oCorps.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Grade de l'agent a remplacer</label>
                                                            <select id="gradeAgentaRemplacer" name="gradeAgentaRemplacer" class="form-control obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toGrade item=oGrade}
                                                                <option {if $oData.oProject.oParRemplacementNumerique.parRemplacementNumerique_GradeId==$oGrade.id} selected="selected"{/if} value="{$oGrade.id}">{$oGrade.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Statut dans l'administration</label>
                                                            <select id="statut" name="statut" class="form-control obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                <option {if $oData.oProject.oParRemplacementNumerique.parRemplacementNumerique_statutFin=="Démission"}selected="selected"{/if} value="Démission">D&eacute;mission</p>
                                                                <option {if $oData.oProject.oParRemplacementNumerique.parRemplacementNumerique_statutFin=="admis à la Retraite"}selected="selected"{/if} value="admis à la Retraite">&Agrave; la Retraite</p>
                                                                <option {if $oData.oProject.oParRemplacementNumerique.parRemplacementNumerique_statutFin=="Décédé"}selected="selected"{/if} value="Décédé">D&eacute;c&eacute;d&eacute;</p>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Date de D&eacute;mission/d'admission a la retraite/de D&eacute;c&egrave;s</label>
                                                            <input type="text" name="datedAdmission" id="datedAdmission" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oParRemplacementNumerique.parRemplacementNumerique_datedeFin|date_format2}" value="{$oData.oProject.oParRemplacementNumerique.parRemplacementNumerique_datedeFin}" placeholder="s&eacute;l&eacute;ctionner la date" class="form-control withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                {/if}
                                                <div class="row">
                                                    
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Chapitre</label>
                                                            <input type="text" name="chapitre" id="chapitre" value="{$oData.oProject.oContratdeTravail.contratdeTravail_chapitre}" placeholder="Chapitre" class="form-control obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Ministere</label>
                                                            <select id="ministere" name="ministere" class="form-control obligatoire" onchange="changeSigle();">
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toMinistere item=oMinistere}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_MinistereId==$oMinistere.ministere_id} selected="selected"{/if} sigle="{$oMinistere.ministere_sigle}" value="{$oMinistere.ministere_id}">{$oMinistere.ministere_libelle}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>D&eacute;partement</label>
                                                            <select id="departement" name="departement" class="form-control obligatoire" onchange="dependanceSigle('departement');">
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toDepartement item=oDepartement}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_DepartementId==$oDepartement.id} selected="selected"{/if} sigle="{$oDepartement.sigle_departement}" value="{$oDepartement.id}">{$oDepartement.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Direction</label>
                                                            <select id="direction" name="direction" class="form-control obligatoire" onchange="dependanceSigle('direction');">
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toDirection item=oDirection}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_DirectionId==$oDirection.id} selected="selected"{/if} sigle="{$oDirection.sigle_direction}" value="{$oDirection.id}">{$oDirection.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Service</label>
                                                            <select id="service" name="service" class="form-control obligatoire" onchange="changeSigle();">
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toService item=oService}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_ServiceId==$oService.id} selected="selected"{/if} sigle="{$oService.sigle_service}" value="{$oService.id}">{$oService.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Sigle</label>
                                                            <input type="text" name="sigle" id="sigle" value="{$oData.oProject.oElaborationProjet.elaborationProjet_sigle}" placeholder="Sigle"  class="form-control obligatoire" disabled/>
                                                            <input type="hidden" name="sigleHidden" id="sigleHidden" value="{$oData.oProject.oElaborationProjet.elaborationProjet_sigle}" placeholder="Sigle"  class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Immatriculation</label>
                                                            <input type="text" name="immatriculation" id="immatriculation" value="{$oData.oProject.oCandidatRecherche.candidat_matricule}" onclick="putMask();" onfocusout="rechercheParMatricule();" placeholder="Immatriculation" class="form-control obligatoire chiffres"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="field">
                                                            <label>D&eacute;nomination</label>
                                                            <select id="denomination" name="denomination" class="form-control obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                <option {if $oData.oProject.oCandidatRecherche.candidat_denomination=="Monsieur"}selected="selected"{/if} value="Monsieur">Monsieur</p>
                                                                <option {if $oData.oProject.oCandidatRecherche.candidat_denomination=="Madame"}selected="selected"{/if} value="Madame">Madame</p>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="field">
                                                            <label>Nom</label>
                                                            <input type="text" name="nom" id="nom" class="form-control" value="{$oData.oProject.oCandidatRecherche.candidat_nom}" placeholder="Nom"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="field">
                                                            <label>Pr&eacute;nom(s)</label>
                                                            <input type="text" name="prenom" id="prenom" class="form-control" value="{$oData.oProject.oCandidatRecherche.candidat_prenom}" placeholder="Pr&eacute;nom(s)"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="field">
                                                            <label>Dur&eacute;e</label> 
                                                            <input type="text" name="duree" id="duree" class="form-control" value="{$oData.oProject.oElaborationProjet.elaborationProjet_dureeService}" placeholder="Dur&eacute;e" class="obligatoire chiffres"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="field">
                                                            <label>Date de prise de Service</label>
                                                            <input type="text" name="datePriseService" id="datePriseService" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oElaborationProjet.elaborationProjet_datePriseService|date_format2}" value="{$oData.oProject.oElaborationProjet.elaborationProjet_datePriseService}" placeholder="s&eacute;l&eacute;ctionner la date" class="form-control withDatePicker obligatoire priseDeService"/>
                                                            <p class="message priseDeService" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Lieu d'exercice d'emploi</label>
                                                            <input type="text" name="lieuExercicedEmploi" id="lieuExercicedEmploi" value="{$oData.oProject.oElaborationProjet.elaborationProjet_lieuExerciceEmploi}" placeholder="Lieu d'exercice d'emploi" class="form-control obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Corps d'assimilation</label>
                                                            <select id="corpsdAssimilation" name="corpsdAssimilation" class="form-control obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toCorps item=oCorps}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_CorpsId==$oCorps.id} selected="selected"{/if} value="{$oCorps.id}">{$oCorps.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Fonction</label>
                                                            <input type="text" name="fonction" id="fonction" value="{$oData.oProject.oElaborationProjet.elaborationProjet_fonction}" placeholder="Fonction" class="form-control obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Corps</label>
                                                            <select id="corps" name="corps" class="form-control obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toCorps item=oCorps}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_CorpsId==$oCorps.id} selected="selected"{/if} value="{$oCorps.id}">{$oCorps.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Grade</label>
                                                            <select id="grade" name="grade" class="form-control obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toGrade item=oGrade}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_GradeId==$oGrade.id} selected="selected"{/if} value="{$oGrade.id}">{$oGrade.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Indice</label>
                                                            <select id="indice" name="indice" class="form-control obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toIndice item=oIndice}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_IndiceId==$oIndice.id} selected="selected"{/if} value="{$oIndice.id}">{$oIndice.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Groupe</label>
                                                            <select id="groupe" name="groupe" class="form-control obligatoire" >
                                                                <option {if $oData.oProject.oContratdeTravail.contratdeTravail_groupe==1} selected="selected" {/if} value="1">I</p>
                                                                <option {if $oData.oProject.oContratdeTravail.contratdeTravail_groupe==2} selected="selected" {/if}value="2">II</p>
                                                                <option {if $oData.oProject.oContratdeTravail.contratdeTravail_groupe==3} selected="selected" {/if}value="3">III</p>
                                                                <option {if $oData.oProject.oContratdeTravail.contratdeTravail_groupe==4} selected="selected" {/if}value="4">IV</p>
                                                                <option {if $oData.oProject.oContratdeTravail.contratdeTravail_groupe==5} selected="selected" {/if}value="5">V</p>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div style="margin:50px"class="clearfix">
                                                    <div class="field  col-sm-12 text-center">
                                                        <input type="button" class="button" onClick="javascript:history.go(-1);" name="" id="Annuler" value="Annuler">
                                                        <input type="button" class="button" onClick="validationDate(validerProjet);" name="" id="Suivant" value="Suivant">
                                                        {if $oData.oVerify.iId!==null}<a href="{$zBasePath}carriere/imprimer/{$oData.oVerify.zHashModule}/{$oData.oVerify.zHashUrl}/{$oData.sTab}/{$oData.oVerify.iId}" target="_blank"><input type="button" class="button" name="" id="Imprimer" value="Imprimer"/></a>{/if}
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                        {/if}
                                        {if $oData.oProject.oElaborationProjet.elaborationProjet_type=="engagement-eld"}
                                        <form action="{$zBasePath}carriere/saveProject/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.iId}" method="POST" name="formulaireProjet" id="formulaireProjet" enctype="multipart/form-data">
                                            <fieldset  id="field-2">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Date du Projet</label>
                                                            <input type="text" name="dateProjet" id="dateProjet" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oElaborationProjet.elaborationProjet_date|date_format2}"  value="{$oData.oProject.oElaborationProjet.elaborationProjet_date}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Ministere</label>
                                                            <select id="ministere" name="ministere" class="obligatoire" onchange="changeSigle();">
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toMinistere item=oMinistere}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_MinistereId==$oMinistere.ministere_id} selected="selected"{/if} sigle="{$oMinistere.ministere_sigle}" value="{$oMinistere.ministere_id}">{$oMinistere.ministere_libelle}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>D&eacute;partement</label>
                                                            <select id="departement" name="departement" class="obligatoire" onchange="dependanceSigle('departement');">
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toDepartement item=oDepartement}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_DepartementId==$oDepartement.id} selected="selected"{/if} sigle="{$oDepartement.sigle_departement}" value="{$oDepartement.id}">{$oDepartement.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Direction</label>
                                                            <select id="direction" name="direction" class="obligatoire" onchange="dependanceSigle('direction');">
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toDirection item=oDirection}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_DirectionId==$oDirection.id} selected="selected"{/if} sigle="{$oDirection.sigle_direction}" value="{$oDirection.id}">{$oDirection.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Service</label>
                                                            <select id="service" name="service" class="obligatoire" onchange="changeSigle();">
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toService item=oService}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_ServiceId==$oService.id} selected="selected"{/if} sigle="{$oService.sigle_service}" value="{$oService.id}">{$oService.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Sigle</label>
                                                            <input type="text" name="sigle" id="sigle" value="{$oData.oProject.oElaborationProjet.elaborationProjet_sigle}" placeholder="Sigle"  class="form-control obligatoire" disabled/>
                                                            <input type="hidden" name="sigleHidden" id="sigleHidden" value="{$oData.oProject.oElaborationProjet.elaborationProjet_sigle}" placeholder="Sigle"  class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Immatriculation</label>
                                                            <input type="text" name="immatriculation" id="immatriculation" value="{$oData.oProject.oCandidatRecherche.candidat_matricule}" onclick="putMask();" onfocusout="rechercheParMatricule();" placeholder="Immatriculation" class="obligatoire chiffres"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="field">
                                                            <label>D&eacute;nomination</label>
                                                            <select id="denomination" name="denomination" class="obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                <option {if $oData.oProject.oCandidatRecherche.candidat_denomination=="Monsieur"}selected="selected"{/if} value="Monsieur">Monsieur</p>
                                                                <option {if $oData.oProject.oCandidatRecherche.candidat_denomination=="Madame"}selected="selected"{/if} value="Madame">Madame</p>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="field">
                                                            <label>Nom</label>
                                                            <input class="form-control" type="text" name="nom" id="nom" value="{$oData.oProject.oCandidatRecherche.candidat_nom}" placeholder="Nom"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="field">
                                                            <label>Pr&eacute;nom(s)</label>
                                                            <input class="form-control" type="text" name="prenom" id="prenom" value="{$oData.oProject.oCandidatRecherche.candidat_prenom}" placeholder="Pr&eacute;nom(s)"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Fonction</label>
                                                            <input type="text" name="fonction" id="fonction" value="{$oData.oProject.oElaborationProjet.elaborationProjet_fonction}" placeholder="Fonction" class="form-control obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="field">
                                                            <label>Dur&eacute;e</label>
                                                            <input type="text" name="duree" id="duree" value="{$oData.oProject.oElaborationProjet.elaborationProjet_dureeService}" placeholder="Dur&eacute;e"  class="form-control obligatoire chiffres"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="field">
                                                            <label>Date de prise de Service</label>
                                                            <input type="text" name="datePriseService" id="datePriseService" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{{$oData.oProject.oElaborationProjet.elaborationProjet_datePriseService}|date_format2}"value="{$oData.oProject.oElaborationProjet.elaborationProjet_datePriseService}" placeholder="s&eacute;l&eacute;ctionner la date" class="form-control withDatePicker obligatoire priseDeService"/>
                                                            <p class="message priseDeService" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Date de naissance</label>
                                                            <input type="text" name="datedeNaissance" id="datedeNaissance" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oCandidatRecherche.candidat_datedeNaissanc|date_format2}" value="{$oData.oProject.oCandidatRecherche.candidat_datedeNaissance}" placeholder="s&eacute;l&eacute;ctionner la date" class="form-control withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Lieu de naissance</label>
                                                            <input type="text" name="lieudeNaissance" id="lieudeNaissance" value="{$oData.oProject.oCandidatRecherche.candidat_lieudeNaissance}" placeholder="Lieu de Naissance" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>titre/Attestation de qualification</label>
                                                            <input type="text" name="attestationdeQualification" id="attestationdeQualification" value="{$oData.oProject.oEngagementELD.decisiondEngagementELD_attestationdeQualification}" placeholder="Attestation de Qualification" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Lieu d'exercice d'emploi</label>
                                                            <input type="text" name="lieuExercicedEmploi" id="lieuExercicedEmploi" value="{$oData.oProject.oElaborationProjet.elaborationProjet_lieuExerciceEmploi}" placeholder="Lieu d'exercice d'emploi" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>R&eacute;mun&eacute;ration de base</label>
                                                            <!--<select id="remunerationdeBase" name="remunerationdeBase" class="obligatoire" >
                                                                <option selected="selected" value="Fonction">Fonction</p>
                                                            </select>-->
                                                            <input type="text" name="remunerationdeBase" id="remunerationdeBase" value="{$oData.oProject.oEngagementELD.decisiondEngagementELD_remunerationdeBase}" placeholder="R&eacute;mun&eacute;ration de base" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Imputation budg&eacute;taire</label>
                                                            <input type="text" name="imputationBudgetaire" id="imputationBudgetaire" value="{$oData.oProject.oElaborationProjet.elaborationProjet_imputationBudgetaire}" placeholder="Imputation budg&eacute;taire" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Situation de famille</label>
                                                            <select id="situationdeFamille" name="situationdeFamille" class="obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                <option {if $oData.oProject.oCandidatRecherche.candidat_situationdeFamille=="Célibataire"} selected="selected"{/if} value="Célibataire">C&eacute;libataire</p>
                                                                <option {if $oData.oProject.oCandidatRecherche.candidat_situationdeFamille=="Marié"} selected="selected"{/if} value="Marié">Mari&eacute;e</p>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                {if ($oData.oProject.oEngagementELD.decisiondEngagementELD_par=="remplacement-numerique") || ($oData.oVerify.sPar=="remplacement-numerique")}
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Immatriculation</label>
                                                            <input type="text" name="immatriculationaRemplacer" id="immatriculationaRemplacer" value="{$oData.oProject.oCandidatRemplacement.matricule}" onclick="putMask();" onfocusout="rechercheParMatricule();" placeholder="Immatriculation" class="obligatoire chiffres"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>En remplacement num&eacute;rique de</label>
                                                            <input type="text" name="nomAgentaRemplacer" id="nomAgentaRemplacer" value="{$oData.oProject.oCandidatRemplacement.nom} {$oData.oProject.oCandidatRemplacement.prenom}" placeholder="Nom et Pr&eacute;nom" disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Corps de l'agent a remplacer</label>
                                                            <select id="corpsAgentaRemplacer" name="corpsAgentaRemplacer" class="obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toCorps item=oCorps}
                                                                <option {if $oData.oProject.oParRemplacementNumerique.parRemplacementNumerique_CorpsId==$oCorps.id} selected="selected"{/if} value="{$oCorps.id}">{$oCorps.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Statut dans l'administration</label>
                                                            <select id="statut" name="statut" class="obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                <option {if $oData.oProject.oParRemplacementNumerique.parRemplacementNumerique_statutFin=="Démission"}selected="selected"{/if} value="Démission">D&eacute;mission</p>
                                                                <option {if $oData.oProject.oParRemplacementNumerique.parRemplacementNumerique_statutFin=="admis à la Retraite"}selected="selected"{/if} value="admis à la Retraite">&Agrave; la Retraite</p>
                                                                <option {if $oData.oProject.oParRemplacementNumerique.parRemplacementNumerique_statutFin=="Décédé"}selected="selected"{/if} value="Décédé">D&eacute;c&eacute;d&eacute;</p>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Date de D&eacute;mission/d'admission a la retraite/de D&eacute;c&egrave;s</label>
                                                            <input type="text" name="datedAdmission" id="datedAdmission" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oParRemplacementNumerique.parRemplacementNumerique_datedeFin|date_format2}" value="{$oData.oProject.oParRemplacementNumerique.parRemplacementNumerique_datedeFin}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-8">
                                                        <div class="field">
                                                            <label>R&eacute;f&eacute;rence de l'acte</label>
                                                            <input type="text" name="referencedelActe" id="referencedelActe" value="{$oData.oProject.oParRemplacementNumerique.parRemplacementNumerique_referenceActeAdministratif}" placeholder="R&eacute;f&eacute;rence de l'acte" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="field">
                                                            <label>Date de l'Acte</label>
                                                            <input type="text" name="dateActe" id="dateActe" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oParRemplacementNumerique.parRemplacementNumerique_dateReferenceActeAdministratif|date_format2}" value="{$oData.oProject.oParRemplacementNumerique.parRemplacementNumerique_dateReferenceActeAdministratif}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                {else if ($oData.oProject.oEngagementELD.decisiondEngagementELD_par=="dotation-poste-budgetaire") || ($oData.oVerify.sPar=="dotation-poste-budgetaire")}
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Num&eacute;ro Lettre</label>
                                                            <input type="text" name="numeroLettre" id="numeroLettre" value="{$oData.oProject.oParDotationPosteBudgetaire.parDotationPosteBudgetaire_numeroLettre}" placeholder="Num&eacute;ro" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Date Lettre</label>
                                                            <input type="text" name="dateLettre" id="dateLettre" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oParDotationPosteBudgetaire.parDotationPosteBudgetaire_dateLettre|date_format2}" value="{$oData.oProject.oParDotationPosteBudgetaire.parDotationPosteBudgetaire_dateLettre}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                {/if}
                                                <div style="margin:50px"class="clearfix">
                                                    <div class="field  col-sm-12 text-center">
                                                        <input type="button" class="button" onClick="javascript:history.go(-1);" name="" id="Annuler" value="Annuler">
                                                        <input type="button" class="button" onClick="validationDate(validerProjet);" name="" id="Suivant" value="Suivant">
                                                        {if $oData.oVerify.iId!==null}<a href="{$zBasePath}carriere/imprimer/{$oData.oVerify.zHashModule}/{$oData.oVerify.zHashUrl}/{$oData.sTab}/{$oData.oVerify.iId}" target="_blank"><input type="button" class="button" name="" id="" value="Imprimer"></a>{/if}
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                        {/if}
                                        {if $oData.oProject.oElaborationProjet.elaborationProjet_type=="engagement-ecd"}
                                        <form action="{$zBasePath}carriere/saveProject/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.iId}" method="POST" name="formulaireProjet" id="formulaireProjet" enctype="multipart/form-data">
                                            <fieldset  id="field-2">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Date du Projet</label>
                                                            <input type="text" name="dateProjet" id="dateProjet" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oElaborationProjet.elaborationProjet_date|date_format2}" value="{$oData.oProject.oElaborationProjet.elaborationProjet_date}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Ministere</label>
                                                            <select id="ministere" name="ministere" class="obligatoire" onchange="changeSigle();">
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toMinistere item=oMinistere}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_MinistereId==$oMinistere.ministere_id} selected="selected"{/if} sigle="{$oMinistere.ministere_sigle}" value="{$oMinistere.ministere_id}">{$oMinistere.ministere_libelle}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>D&eacute;partement</label>
                                                            <select id="departement" name="departement" class="obligatoire" onchange="dependanceSigle('departement');">
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toDepartement item=oDepartement}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_DepartementId==$oDepartement.id} selected="selected"{/if} sigle="{$oDepartement.sigle_departement}" value="{$oDepartement.id}">{$oDepartement.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Direction</label>
                                                            <select id="direction" name="direction" class="obligatoire" onchange="dependanceSigle('direction');">
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toDirection item=oDirection}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_DirectionId==$oDirection.id} selected="selected"{/if} sigle="{$oDirection.sigle_direction}" value="{$oDirection.id}">{$oDirection.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Service</label>
                                                            <select id="service" name="service" class="obligatoire" onchange="changeSigle();">
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toService item=oService}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_ServiceId==$oService.id} selected="selected"{/if} sigle="{$oService.sigle_service}" value="{$oService.id}">{$oService.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Sigle</label>
                                                            <input type="text" name="sigle" id="sigle" value="{$oData.oProject.oElaborationProjet.elaborationProjet_sigle}" placeholder="Sigle"  class="obligatoire" disabled/>
                                                            <input type="hidden" name="sigleHidden" id="sigleHidden" value="{$oData.oProject.oElaborationProjet.elaborationProjet_sigle}" placeholder="Sigle"  class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Immatriculation</label>
                                                            <input type="text" name="immatriculation" id="immatriculation" value="{$oData.oProject.oCandidatRecherche.candidat_matricule}" onclick="putMask();" onfocusout="rechercheParMatricule();" placeholder="Immatriculation" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="field">
                                                            <label>D&eacute;nomination</label>
                                                            <select id="denomination" name="denomination" class="obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                <option {if $oData.oProject.oCandidatRecherche.candidat_denomination=="Monsieur"}selected="selected"{/if} value="Monsieur">Monsieur</p>
                                                                <option {if $oData.oProject.oCandidatRecherche.candidat_denomination=="Madame"}selected="selected"{/if} value="Madame">Madame</p>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="field">
                                                            <label>Nom</label>
                                                            <input type="text" name="nom" id="nom" value="{$oData.oProject.oCandidatRecherche.candidat_nom}" placeholder="Nom"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="field">
                                                            <label>Pr&eacute;nom(s)</label>
                                                            <input type="text" name="prenom" id="prenom" value="{$oData.oProject.oCandidatRecherche.candidat_prenom}" placeholder="Pr&eacute;nom(s)"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Fonction</label>
                                                            <input type="text" name="fonction" id="fonction" value="{$oData.oProject.oElaborationProjet.elaborationProjet_fonction}" placeholder="Fonction" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Date de naissance</label>
                                                            <input type="text" name="datedeNaissance" id="datedeNaissance" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oCandidatRecherche.candidat_datedeNaissance|date_format2}" value="{$oData.oProject.oCandidatRecherche.candidat_datedeNaissance}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Lieu de naissance</label>
                                                            <input type="text" name="lieudeNaissance" id="lieudeNaissance" value="{$oData.oProject.oCandidatRecherche.candidat_lieudeNaissance}" placeholder="Lieu de Naissance" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>CIN</label>
                                                            <input type="text" name="cin" id="cin" value="{$oData.oProject.oCandidatRecherche.candidat_cin}" onclick="putMaskCIN();" placeholder="CIN"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Cat&eacute;gorie</label>
                                                            <input type="text" name="categorie" id="categorie" value="{$oData.oProject.oEngagementECD.decisiondEngagementECD_categoriedEmploi}" placeholder="Cat&eacute;gorie d'emploi" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Lieu d'exercice d'emploi</label>
                                                            <input type="text" name="lieuExercicedEmploi" id="lieuExercicedEmploi" value="{$oData.oProject.oElaborationProjet.elaborationProjet_lieuExerciceEmploi}" placeholder="Lieu d'exercice d'emploi" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Dur&eacute;e de l'engagement</label>
                                                            <input type="text" name="dureedelEngagement" id="dureedelEngagement" value="{$oData.oProject.oEngagementECD.decisiondEngagementECD_dureeEngagement}" placeholder="Dur&eacute;e de l'engagement" class="obligatoire chiffres"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>D&eacute;but P&eacute;riode</label>
                                                            <input type="text" name="debutPeriode" id="debutPeriode" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oEngagementECD.decisiondEngagementECD_debutPeriode|date_format2}" value="{$oData.oProject.oEngagementECD.decisiondEngagementECD_debutPeriode}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message debut" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Fin P&eacute;riode</label>
                                                            <input type="text" name="finPeriode" id="finPeriode" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oEngagementECD.decisiondEngagementECD_finPeriode|date_format2}" value="{$oData.oProject.oEngagementECD.decisiondEngagementECD_finPeriode}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Cat&eacute;gorie d'emploi</label>
                                                            <select id="categoriedEmploi" name="categoriedEmploi" class="obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                <option value="1">M1</p>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Indice d'emploi</label>
                                                            <select id="indicedEmploi" name="indicedEmploi" class="obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                <option value="1">125 CT</p>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Mission</label>
                                                            <input type="text" name="mission" id="mission" value="{$oData.oProject.oEngagementECD.decisiondEngagementECD_mission}" placeholder="Mission" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Objectif(D&eacute;fis)</label>
                                                            <input type="text" name="objectif" id="objectif" value="{$oData.oProject.oEngagementECD.decisiondEngagementECD_objectifs}" placeholder="Objectif(D&eacute;fis)" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Indicateur d'Objectif</label>
                                                            <input type="text" name="indicateurdObjectif" id="indicateurdObjectif" value="{$oData.oProject.oEngagementECD.decisiondEngagementECD_indicateursObjectifs}" placeholder="Indicateur d'Objectif" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Activit&eacute;</label>
                                                            <input type="text" name="activite" id="activite" value="{$oData.oProject.oEngagementECD.decisiondEngagementECD_activite}" placeholder="Activit&eacute;" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Financement</label>
                                                            <input type="text" name="financement" id="financement" value="{$oData.oProject.oEngagementECD.decisiondEngagementECD_financement}" placeholder="Financement" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Imputation budg&eacute;taire</label>
                                                            <input type="text" name="imputationBudgetaire" id="imputationBudgetaire" value="{$oData.oProject.oElaborationProjet.elaborationProjet_imputationBudgetaire}" placeholder="Imputation budg&eacute;taire" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Situation de famille</label>
                                                            <select id="situationdeFamille" name="situationdeFamille" class="obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                <option {if $oData.oProject.oCandidatRecherche.candidat_situationdeFamille=="Célibataire"} selected="selected"{/if} value="Célibataire">C&eacute;libataire</p>
                                                                <option {if $oData.oProject.oCandidatRecherche.candidat_situationdeFamille=="Marié"} selected="selected"{/if} value="Marié">Mari&eacute;e</p>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div style="margin:50px"class="clearfix">
                                                    <div class="field col-sm-12 text-center">
                                                        <input type="button" class="button" onClick="javascript:history.go(-1);" name="" id="Annuler" value="Annuler">
                                                        <input type="button" class="button" onClick="validationDate(validerProjet,1);" name="" id="Suivant" value="Suivant">
                                                        {if $oData.oVerify.iId!==null}<a href="{$zBasePath}carriere/imprimer/{$oData.oVerify.zHashModule}/{$oData.oVerify.zHashUrl}/{$oData.sTab}/{$oData.oVerify.iId}" target="_blank"><input type="button" class="button" name="" id="" value="Imprimer"></a>{/if}
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                        {/if}
                                        {if $oData.oProject.oElaborationProjet.elaborationProjet_type=="arrete-de-nomination"}
                                        <form action="{$zBasePath}carriere/saveProject/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.iId}" method="POST" name="formulaireProjet" id="formulaireProjet" enctype="multipart/form-data">
                                            <fieldset id="field-2">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Date du Projet</label>
                                                            <input type="text" name="dateProjet" id="dateProjet" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oElaborationProjet.elaborationProjet_date|date_format2}" value="{$oData.oProject.oElaborationProjet.elaborationProjet_date}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Corps</label>
                                                            <select id="corps" name="corps" class="obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toCorps item=oCorps}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_CorpsId==$oCorps.id} selected="selected"{/if} value="{$oCorps.id}">{$oCorps.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Grade</label>
                                                            <select id="grade" name="grade" class="obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toGrade item=oGrade}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_GradeId==$oGrade.id} selected="selected"{/if} value="{$oGrade.id}">{$oGrade.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Indice</label>
                                                            <select id="indice" name="indice" class="obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toIndice item=oIndice}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_IndiceId==$oIndice.id} selected="selected"{/if} value="{$oIndice.id}">{$oIndice.libele}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Num&eacute;ro du D&eacute;cret</label>
                                                            <input type="text" name="numeroduDecret" id="numeroduDecret" value="{$oData.oProject.oArrete.arretedeNomination_numeroDecret}" placeholder="Num&eacute;ro du D&eacute;cret" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Date du D&eacute;cret</label>
                                                            <input type="text" name="dateduDecret" id="dateduDecret"  data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oArrete.arretedeNomination_dateDecret|date_format2}" value="{$oData.oProject.oArrete.arretedeNomination_dateDecret}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Num&eacute;ro du D&eacute;cret Additif</label>
                                                            <input type="text" name="numeroduDecretAdditif" id="numeroduDecretAdditif" value="{$oData.oProject.oArrete.arretedeNomination_numeroDecretAdditif}" placeholder="Num&eacute;ro du D&eacute;cret Additif" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Date du D&eacute;cret Additif</label>
                                                            <input type="text" name="dateduDecretAdditif" id="dateduDecretAdditif" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oArrete.arretedeNomination_dateDecretAdditif|date_format2}" value="{$oData.oProject.oArrete.arretedeNomination_dateDecretAdditif}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Num&eacute;ro de l'Arr&ecirc;t&eacute; portant ouverture du concours</label>
                                                            <input type="text" name="numeroArrete" id="numeroArrete" value="{$oData.oProject.oArrete.arretedeNomination_numeroArrete}" placeholder="Num&eacute;ro de l'Arr&ecirc;t&eacute; portant ouverture du concours" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Date</label>
                                                            <input type="text" name="dateArrete" id="dateArrete" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oArrete.arretedeNomination_dateArrete|date_format2}" value="{$oData.oProject.oArrete.arretedeNomination_dateArrete}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Ecole de Formation</label>
                                                            <input type="text" name="ecoleFormation" id="ecoleFormation" value="{$oData.oProject.oArrete.arretedeNomination_ecole}" placeholder="Ecole de formation" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Promotion</label>
                                                            <input type="text" name="promotion" id="promotion" value="{$oData.oProject.oArrete.arretedeNomination_promotion}" placeholder="Promotion" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Diplome</label>
                                                            <input type="text" name="diplome" id="diplome" value="{$oData.oProject.oArrete.arretedeNomination_diplome}" placeholder="Diplome" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Section</label>
                                                            <input type="text" name="section" id="section" value="{$oData.oProject.oArrete.arretedeNomination_section}" placeholder="Section" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Nombre de postes disponibles au concours direct</label>
                                                            <input type="text" name="postesDisponibles" id="postesDisponibles" value="{$oData.oProject.oArrete.arretedeNomination_nombrePostesDisponibles}" placeholder="Nombre de postes disponibles au concours direct" class="obligatoire chiffres"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Nombre de postes requis</label>
                                                            <input type="text" name="postesRequis" id="postesRequis" value="{$oData.oProject.oArrete.arretedeNomination_nombrePostesRequis}" placeholder="Nombre de postes requis" class="obligatoire chiffres"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Date de la liste des candidats admis</label>
                                                            <input type="text" name="dateCandidatsAdmis" id="dateCandidatsAdmis" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oArrete.arretedeNomination_dateListeAdmis|date_format2}" value="{$oData.oProject.oArrete.arretedeNomination_dateListeAdmis}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Date de la liste d&eacute;finitive</label>
                                                            <input type="text" name="dateDefinitive" id="dateDefinitive" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oArrete.arretedeNomination_dateListeDefinitive|date_format2}" value="{$oData.oProject.oArrete.arretedeNomination_dateListeDefinitive}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Bonification d'anciennet&eacute;</label>
                                                            <input type="text" name="bonification" id="bonification" value="{$oData.oProject.oArrete.arretedeNomination_bonificationdAnciennete}" placeholder="Bonification d'anciennet&eacute;" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Num&eacute;ro d'arr&ecirc;t&eacute; de la Bonification d'anciennet&eacute;</label>
                                                            <input type="text" name="numeroBonification" id="numeroBonification" value="{$oData.oProject.oArrete.arretedeNomination_numeroArreteBonification}" placeholder="Num&eacute;ro d'arr&ecirc;t&eacute; de la Bonification d'anciennet&eacute;" class="obligatoire"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="field">
                                                            <label>Date d'arr&ecirc;t&eacute; de la Bonification d'anciennet&eacute;</label>
                                                            <input type="text" name="dateBonification" id="dateBonification" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.oProject.oArrete.arretedeNomination_dateArreteBonification|date_format2}" value="{$oData.oProject.oArrete.arretedeNomination_dateArreteBonification}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Immatriculation</label>
                                                            <input type="text" name="immatriculation" id="immatriculation" value="{$oData.oProject.oCandidatRecherche.candidat_matricule}" onclick="putMask();" onfocusout="rechercheParMatricule();" placeholder="Immatriculation" class="obligatoire chiffres"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="field">
                                                            <label>Nom</label>
                                                            <input type="text" name="nom" id="nom" value="{$oData.oProject.oCandidatRecherche.candidat_nom}" placeholder="Nom"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="field">
                                                            <label>Pr&eacute;nom(s)</label>
                                                            <input type="text" name="prenom" id="prenom" value="{$oData.oProject.oCandidatRecherche.candidat_prenom}" placeholder="Pr&eacute;nom(s)"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Ministere</label>
                                                            <select id="ministere" name="ministere" class="obligatoire">
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                {foreach from=$oData.oProject.toMinistere item=oMinistere}
                                                                <option {if $oData.oProject.oElaborationProjet.elaborationProjet_MinistereId==$oMinistere.ministere_id} selected="selected"{/if} sigle="{$oMinistere.ministere_sigle}" value="{$oMinistere.ministere_id}">{$oMinistere.ministere_libelle}</p>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Situation de famille</label>
                                                            <select id="situationdeFamille" name="situationdeFamille" class="obligatoire" >
                                                                <option selected="selected" sigle="" value="">Selectionner</p>
                                                                <option {if $oData.oProject.oCandidatRecherche.candidat_situationdeFamille=="Célibataire"} selected="selected"{/if} value="Célibataire">C&eacute;libataire</p>
                                                                <option {if $oData.oProject.oCandidatRecherche.candidat_situationdeFamille=="Marié"} selected="selected"{/if} value="Marié">Mari&eacute;e</p>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Imputation budg&eacute;taire</label>
                                                            <input type="text" name="imputationBudgetaire" id="imputationBudgetaire" value="{$oData.oProject.oElaborationProjet.elaborationProjet_imputationBudgetaire}" placeholder="Imputation budg&eacute;taire"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin:50px"class="clearfix">
                                                    <div class="field col-sm-12 text-center">
                                                        <input type="button" class="button" onClick="javascript:history.go(-1);" name="" id="Annuler" value="Annuler">
                                                        <input type="button" class="button" onClick="validation(validerProjet);" name="" id="Suivant" value="Suivant">
                                                        {if $oData.oVerify.iId!==null}<a href="{$zBasePath}carriere/imprimer/{$oData.oVerify.zHashModule}/{$oData.oVerify.zHashUrl}/{$oData.sTab}/{$oData.oVerify.iId}" target="_blank"><input type="button" class="button" name="" id="" value="Imprimer"></a>{/if}
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                        {/if}
                                    </div>

                                    <!--*Fin Contenue*-->
                                </div>
                                <div id="tab-3" class="tab-content {if $oData.sTab=="be"}current{/if}">
                                    <!--*Debut Contenue*-->
                                    <form action="{$zBasePath}carriere/saveBE/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.iId}" method="POST" name="formulaireBE" id="formulaireBE" enctype="multipart/form-data">
                                        <fieldset  id="field-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="field">
                                                                <label>Ministere</label>
                                                                <select id="ministereBE" name="ministereBE" class="obligatoireBE" onchange="changeSigleBE();">
                                                                    <option selected="selected" sigle="" value="">Selectionner</p>
                                                                    {foreach from=$oData.oBE.toMinistere item=oMinistere}
                                                                    <option {if $oData.oBE.oBE.elaborationduBE_MinistereId==$oMinistere.ministere_id} selected="selected"{/if} sigle="{$oMinistere.ministere_sigle}" value="{$oMinistere.ministere_id}">{$oMinistere.ministere_libelle}</p>
                                                                    {/foreach}
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="field">
                                                                <label>D&eacute;partement</label>
                                                                <select id="departementBE" name="departementBE" class="obligatoireBE" onchange="dependanceSigleBE('departement');">
                                                                    <option selected="selected" sigle="" value="">Selectionner</p>
                                                                    {foreach from=$oData.oBE.toDepartement item=oDepartement}
                                                                    <option {if $oData.oBE.oBE.elaborationduBE_DepartementId==$oDepartement.id} selected="selected"{/if} sigle="{$oDepartement.sigle_departement}" value="{$oDepartement.id}">{$oDepartement.libele}</p>
                                                                    {/foreach}
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="field">
                                                                <label>Direction</label>
                                                                <select id="directionBE" name="directionBE" class="obligatoireBE"  onchange="dependanceSigleBE('direction');">
                                                                    <option selected="selected" sigle="" value="">Selectionner</p>
                                                                    {foreach from=$oData.oBE.toDirection item=oDirection}
                                                                    <option {if $oData.oBE.oBE.elaborationduBE_DirectionId==$oDirection.id} selected="selected"{/if} sigle="{$oDirection.sigle_direction}" value="{$oDirection.id}">{$oDirection.libele}</p>
                                                                    {/foreach}
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="field">
                                                                <label>Service</label>
                                                                <select id="serviceBE" name="serviceBE" class="obligatoireBE"  onchange="changeSigleBE();">
                                                                    <option selected="selected" sigle="" value="">Selectionner</p>
                                                                    {foreach from=$oData.oBE.toService item=oService}
                                                                    <option {if $oData.oBE.oBE.elaborationduBE_ServiceId==$oService.id} selected="selected"{/if} sigle="{$oService.sigle_service}" value="{$oService.id}">{$oService.libele}</p>
                                                                    {/foreach}
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="field">
                                                                <label>Sigle</label>
                                                                <input type="text" name="sigleBE" id="sigleBE" value="{$oData.oBE.oBE.elaborationduBE_sigle}" placeholder="Sigle"  class="obligatoireBE" disabled/>
                                                                <input type="hidden" name="sigleBEHidden" id="sigleBEHidden" value="{$oData.oBE.oBE.elaborationduBE_sigle}" placeholder="Sigle"  class="obligatoireBE"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="field">
                                                                <label>Expediteur</label>
                                                                <input type="text" name="expediteur" id="expediteur" value="{$oData.oBE.oBE.elaborationduBE_expediteur}" placeholder="Expediteur" class="obligatoireBE"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="field">
                                                                <label>Destinataire</label>
                                                                <input type="text" name="destinataire" id="destinataire" value="{$oData.oBE.oBE.elaborationduBE_destinataire}" placeholder="Destinataire" class="obligatoireBE"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="field">
                                                        <label>Nombre</label>
                                                        <input type="text" name="nombre" id="nombre" value="{$oData.oBE.oBE.elaborationduBE_nombreaEnvoyer}" placeholder="Nombre" disabled/>
                                                        <input type="hidden" name="nombreHidden" id="nombreHidden" value="{$oData.oBE.oBE.elaborationduBE_nombreaEnvoyer}" placeholder="Nombre"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="field">
                                                        <label> </label>
                                                        <label> </label>
                                                        <input type="button" class="button plusOuMoins" onClick="beAdd();" name="ajoutNombre" id="ajoutNombre" value="+">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="candidats">
                                            {assign var=iIdMatBE value="0"}
                                            {foreach from=$oData.oBE.toProjet item=oProjet}
                                                <div id="candidat{$iIdMatBE}" class="row candidat">
                                                    <!--<div class="col-md-2">
                                                        <div class="field">
                                                            <label>Matricule</label>
                                                            <input type="text" class="matriculeBE obligatoireBE chiffresBE" name="matriculeBE{$iIdMatBE}" id="matriculeBE{$iIdMatBE}" value="{$oProjet.candidat_matricule}" placeholder="Matricule" onclick="putMask();" onfocusout="beRechercheParMatricule({$iIdMatBE});"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="field">
                                                            <label>Date du projet</label>
                                                            <input type="text" class="withDatePicker dateBE obligatoireBE" name="dateBE{$iIdMatBE}" id="dateBE{$iIdMatBE}" value="{$oProjet.elaborationProjet_date}" placeholder="s&eacute;l&eacute;ctionner la date" onfocusout="beRechercheParMatricule({$iIdMatBE});"/>
                                                            <p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
                                                        </div>
                                                    </div>-->
                                                    <div class="col-md-10">
                                                        <div class="field">
                                                            <label>Nom(s) et Pr&eacute;nom(s)</label>
                                                            <!--<input type="text" class="nomsPrenoms" name="nomsPrenoms{$iIdMatBE}" id="nomsPrenoms{$iIdMatBE}" value="{$oProjet.candidat_nom} {$oProjet.candidat_prenom}" placeholder="Nom(s) et Pr&eacute;nom(s)" disabled/>
                                                            -->
                                                            <input type="text" class="nomsPrenoms" name="nomsPrenoms{$iIdMatBE}" id="nomsPrenoms{$iIdMatBE}" value="{$oProjet}" placeholder="Nom(s) et Pr&eacute;nom(s)"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="field">
                                                            <label> </label>
                                                            <label> </label>
                                                            <input type="button" class="button retirer  plusOuMoins" onClick="beRemove({$iIdMatBE});" name="retireNombre" id="retireNombre" value="-">
                                                        </div>
                                                    </div>
                                                </div>
                                            {assign var=iIdMatBE value=$iIdMatBE+1}
                                            {/foreach}
                                            </div>
                                            <div style="margin:50px"class="clearfix">
                                                <div class="field col-sm-12 text-center">
                                                    <input type="button" class="button" onClick="javascript:history.go(-1);" name="" id="Annuler" value="Annuler">
                                                    <input type="button" class="button" onClick="validationBE(saveBE);" name="" id="Valider" value="Valider">
                                                    {if $oData.oVerify.iId!==null}<a href="{$zBasePath}carriere/imprimerBE/{$oData.oVerify.zHashModule}/{$oData.oVerify.zHashUrl}/{$oData.sTab}/{$oData.oVerify.iId}" target="_blank"><input type="button" class="button" name="" id="" value="Imprimer"></a>{/if}
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                    <!--*Fin Contenue*-->
                                </div>

                                <div id="calendar"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /Page Content -->
                    
        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->

{include_php file=$zFooter}

{literal}
<style>

form .small {
    width: 15%!important;
}

@media only screen and (max-width: 1300px){
	.col-md-3info {
		width: 100%!important;
		float: none!important;
		padding:10px!important;
	}
}

</style>
<script>
changeSigle();
changeSigleBE();
verifyValide();

function rechercheParMatricule()
{
    var inputMatricule = document.getElementById("immatriculation");
    var inputMatriculeRemp = document.getElementById("immatriculationaRemplacer");
    var nom = document.getElementById("nom");
    var prenom = document.getElementById("prenom");
    var cin = document.getElementById("cin");
    var nomPrenomRemp = document.getElementById("nomAgentaRemplacer");
    var lien = "{/literal}{$zBasePath}carriere/findCandidatbyMatricule{literal}";
    if(inputMatricule!=null)
    {
        if(isNormalInteger(inputMatricule.value))
        {
            $.ajax({
                type : "POST",
                url  : lien,
                dataType : "html",
                data : {"matricule" : inputMatricule.value},
                success: function(data){
                    if($.trim(data)){
                        var reponse = JSON.parse(data);
                        nom.value = reponse["candidat_nom"];
                        prenom.value = reponse["candidat_prenom"];
                        if(cin!=null)
                        {
                            cin.value = reponse["candidat_cin"];
                        }
                    }
                }
            });
        }
        else
        {
            nom.value = "";
            prenom.value = "";
            if(cin!=null)
            {
                cin.value = "";
            }
        }
    }

    if(inputMatriculeRemp!=null)
    {
        if(isNormalInteger(inputMatriculeRemp.value))
        {
            lien = lien +"/1";
            $.ajax({
                type : "POST",
                url  : lien.replace(/\s/g, ''),
                dataType : "html",
                data : {"matricule" : inputMatriculeRemp.value},
                success: function(data){
                    if(data!=""){
                        var reponse= JSON.parse(data);
                        nomPrenomRemp.value = reponse["nom"]+" "+reponse["prenom"];
                    }
                }
            });
        }
        else
        {
            nomPrenomRemp.value = "";
        }
    }

    return false;  //stop the actual form post !important!
}

/*function beRechercheParMatricule(iId)
{
    var inputMatricule = document.getElementById("matriculeBE"+iId);
    var nomPrenom = document.getElementById("nomsPrenoms"+iId);
    var lien = "{/literal}{$zBasePath}carriere/findCandidatbyMatriculeBE{literal}";
    if(isNormalInteger(inputMatricule.value))
    {
        $.ajax({
            type : "POST",
            url  : lien,
            dataType : "html",
            data : {"matricule" : inputMatricule.value},
            success: function(data){
                nomPrenom.value = data;
            }
        });
    }
    else
    {
        nomPrenom.value = "";
    }
    
    return false;  //stop the actual form post !important!
}*/

function dependanceSigle(sDropdown)
{
    //var Ministere = $("#ministere");
	var Dept = $("#departement");
	var Dir = $("#direction");
	var Serv = $("#service");
	//var MinistereId = Ministere.val();
	var DeptId = Dept.val();
	var DirId = Dir.val();
	var ServId = Serv.val();
	var lien = "{/literal}{$zBasePath}carriere/dependanceSigle/{literal}"+sDropdown;
	$.ajax({
		type : "POST",
		url  : lien.replace(/\s/g, ''),
		dataType : "html",
		data : {"departement" : DeptId,"direction" : DirId},
		success: function(data){
            var reponse= JSON.parse(data);
			//remplissageDropDown(MinistereId,Ministere,reponse["toMinistere"],"ministere_id","ministere_sigle","ministere_libelle");
			//remplissageDropDown(DeptId,Dept,reponse["toDepartement"],"id","sigle_departement","libele");
            switch(sDropdown)
            {
                case "departement":
                    remplissageDropDown(Dir,reponse["toDirection"],"id","sigle_direction","libele");
                    remplissageDropDown(Serv,reponse["toService"],"id","sigle_service","libele");
				    break;
			    case "direction":
                    remplissageDropDown(Serv,reponse["toService"],"id","sigle_service","libele");
				    break;
                default:
                    break;
            }
			
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
            alert(xhr.responseText);
            alert(thrownError);
		},
        async: false
	});
    changeSigle();
	return false;  //stop the actual form post !important!
}

function dependanceSigleBE(sDropdown)
{
	//var Ministere = $("#ministereBE");
	var Dept = $("#departementBE");
	var Dir = $("#directionBE");
	var Serv = $("#serviceBE");
	//var MinistereId = Ministere.val();
	var DeptId = Dept.val();
	var DirId = Dir.val();
	var ServId = Serv.val();
	var lien = "{/literal}{$zBasePath}carriere/dependanceSigle/{literal}"+sDropdown;
	$.ajax({
		type : "POST",
		url  : lien.replace(/\s/g, ''),
		dataType : "html",
		data : {"departement" : DeptId,"direction" : DirId},
		success: function(data){
            var reponse= JSON.parse(data);
			//remplissageDropDown(MinistereId,Ministere,reponse["toMinistere"],"ministere_id","ministere_sigle","ministere_libelle");
			//remplissageDropDown(DeptId,Dept,reponse["toDepartement"],"id","sigle_departement","libele");
			switch(sDropdown)
            {
                case "departement":
                    remplissageDropDown(Dir,reponse["toDirection"],"id","sigle_direction","libele");
                    remplissageDropDown(Serv,reponse["toService"],"id","sigle_service","libele");
				    break;
			    case "direction":
                    remplissageDropDown(Serv,reponse["toService"],"id","sigle_service","libele");
				    break;
                default:
                    break;
            }
            
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
            alert(xhr.responseText);
            alert(thrownError);
		},
        async: false
	});
    changeSigleBE();
	return false;  //stop the actual form post !important!
}

function validerVerification()
{
    verifyValide();
    verifyProjetValide();
    nextTab(1,2);
}

function validerProjet()
{
    verifyValide();
    verifyProjetValide();
    nextTab(2,3);
}

function saveBE()
{
    var formVerification = $('#formulaireVerification');
    var formProjet = $('#formulaireProjet');
    var formBE = $('#formulaireBE');
    var sUrlVerification = "{/literal}{$zBasePath}carriere/save/{$oData.oVerify.zHashModule}/{$oData.oVerify.zHashUrl}/{$oData.oVerify.iId}{literal}";
    var sUrlProjet = "{/literal}{$zBasePath}carriere/saveProject/{$oData.oVerify.zHashModule}/{$oData.oVerify.zHashUrl}/{literal}";
    var sUrlBE = "{/literal}{$zBasePath}carriere/saveBE/{$oData.oVerify.zHashModule}/{$oData.oVerify.zHashUrl}/{literal}";
    var lien = "{/literal}{$zBasePath}carriere/liste/{$oData.oVerify.zHashModule}"{literal};
    var iTest = "{/literal}{$oData.oVerify.iId}{literal}";
    
    //alert("Début de l'enregistrement");
    $.ajax({
        type : "POST",
        url  : sUrlVerification.replace(/\s/g, ''),
        dataType : "html",
        data : formVerification.serialize()
    }).done(
        function (data) {
            sUrlProjet = sUrlProjet + data;
            sUrlBE = sUrlBE + data;
            $.ajax({
                type : "POST",
                url  : sUrlProjet.replace(/\s/g, ''),
                dataType : "html",
                data : formProjet.serialize()
            }).done(
                function (data) {
                    //alert(data);
                    $.ajax({
                        type : "POST",
                        url  : sUrlBE.replace(/\s/g, ''),
                        dataType : "html",
                        data : formBE.serialize(),
                        success: function(data){
                            /*if(!isNormalInteger(iTest))
                            {
                                window.location.href = lien.replace(/\s/g, '');
                            }
                            else{
                                alert("Enregistrement termine!");
                            }*/
                            window.location.href = lien.replace(/\s/g, '');
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status);
                            alert(xhr.responseText);
                            alert(thrownError);
                        }
                    });
                }
            ).fail(
                function (xhr, textStatus) {
                    alert(xhr.status);
                    alert(xhr.responseText);
                }
            );
        }
    ).fail(
        function (xhr, textStatus) {
            alert(xhr.status);
            alert(xhr.responseText);
        }
    );

    if(isNormalInteger(iTest))
    {
        return false;  //stop the actual form post !important!
    }
    else
    {
        return true;
    }
}

$(document).ready(function() {
	$('#dataTables-example-0').dataTable({bFilter: false, bInfo: false,searching: false});
});

</script>
{/literal}
<style>
{literal}

.plusOuMoins{
    line-height:10px!important;
    font-size:30px!important;
}

.ligneVerify{
    font-size:medium;
}

.errorPlaceholder::-moz-placeholder {
    opacity: 1;
    color: red!important;
}

.errorPlaceholder::-webkit-input-placeholder {
    opacity: 1;
    color: red!important;
}
.errorPlaceholder:-moz-placeholder {
    opacity: 1;
    color: red!important;
}
.errorPlaceholder::-moz-placeholder {
    opacity: 1;
    color: red!important;
}
.errorPlaceholder:-ms-input-placeholder {
    opacity: 1;
    color: red!important;
}
.errorPlaceholder::-ms-input-placeholder {
    opacity: 1;
    color: red!important;
}
.errorPlaceholder::placeholder {
    opacity: 1;
    color: red!important;
}

.even{
	background-color: #f9f9f9!important;
}

table tr.even td {
    background-color: #f9f9f9!important;
}

.dataTables_filter {
	display:none!important;
}

#dataTables-example-0_length {
	display:none!important;
}

.dataTables_info {
	display:none!important;
}
.dataTables_paginate {
	float:right;
	padding-right:100px;
}

.dataTables_filter, .dataTables_info { display: none; }
{/literal}
</style>