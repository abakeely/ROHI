{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb"><a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="{$zBasePath}">RH</a> <span>&gt;</span> <a href="{$zBasePath}">Gestion des absences</a> <span>&gt;</span> Décision</div>
	
	<section id="content">
        {include_php file=$zLeft}	
        <link rel="stylesheet" href="{$zBasePath}assets/css/raterater.css"/>
        <script src="{$zBasePath}assets/js/raterater.jquery.js"></script>
        <div id="innerContent">
            <div id="ContentBloc">
                <h2>Liste des Agents à Evaluer</h2>

                <div class="contenuePage">

                    <!--*Debut Contenue*-->



                    <form class="form-horizontal bv-form Cv-form" role="form" name="cv" id="cv_form"
                          action="http://rohi.dev/cv/create_cv" method="POST" enctype="multipart/form-data"
                          novalidate="novalidate">
                        <input type="hidden" name="corps" id="corps" value="" data-original-title="" title="">
                        <input type="hidden" name="grade" id="grade" value="" data-original-title="" title="">
                        <input type="hidden" name="indice" id="indice" value="" data-original-title=""
                               title=""><input type="hidden" name="pays1" id="pays1" value="2" data-original-title=""
                                               title=""> <input type="hidden" name="province1" id="province1" value="2"
                                                                data-original-title="" title=""> <input type="hidden"
                                                                                                        name="region1"
                                                                                                        id="region1"
                                                                                                        value="1"
                                                                                                        data-original-title=""
                                                                                                        title=""> <input
                            type="hidden" name="district1" id="district1" value="13" data-original-title="" title="">
                        <input type="hidden" name="departement1" id="departement1" value="2" data-original-title=""
                               title=""> <input type="hidden" name="direction1" id="direction1" value="3"
                                                data-original-title="" title=""> <input type="hidden" name="service1"
                                                                                        id="service1" value="163"
                                                                                        data-original-title="" title="">
                        <input type="hidden" name="division1" id="division1" value="0" data-original-title="" title="">
                        <input type="hidden" id="date_compare" name="date_compare" value=""
                               data-original-title="" title="">

                        <div class="col-md-12">

                            <!----------------- bloc Details ---------------->
                            <div class="headblock">
                                <div class="left User-photo">
                                    <img src="img/9829.jpg">
                                </div>

                                <div class="User-details">
                                    <div class="row" style="width:100%">
                                        <div class="cell">
                                            <div class="field">
                                                <label><b>Nom :</b> 
                                                {if $oCandidat[0]->nom!=''}
                                                {$oCandidat[0]->nom}
                                                {else}
                                                {$oUser.nom}
                                                {/if}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="field">
                                            <label>Prénom(s) : 
                                            {if $oCandidat[0]->nom!=''}
                                            {$oCandidat[0]->prenom}     
                                            {else}
                                            {$oUser.prenom}
                                            {/if}
                                            </label>

                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="cell">
                                            <div class="field">
                                                <label>Matricule : 
                                                {if $oCandidat[0]->nom!=''}
                                                {$oCandidat[0]->matricule}     
                                                {else}
                                                {$oUser.im}
                                                {/if}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>

                                </div>
                                <div class="clearfix"></div>
                                <div class="fileChange">
                                    <label for="photo">Modifier
                                        <input type="file" class="file_upload" name="photo" data-toggle="tooltip" data-original-title="Safidio sy ampidiro ny sarinao" id="photo"  data-bv-field="photo">
                                    </label>
                                    <i class="form-control-feedback" data-bv-icon-for="photo"></i>
                                    <small class="help -block" data-bv-validator="regexp" data-bv-for="photo"
                                           data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez
                                        choisir un fichier de type jpeg,png,gif
                                    </small>
                                </div>
                            </div>
                            <!----------------- Fin bloc Details ---------------->
                        </div>
                        <div class="col-xs-12 col-sm-6 pull-right">
                            <!----------------- bloc Toogle ---------------->
                            <div class="panel panel-default">
                                <div class="panel-title">
                                    <a  href="#EtatCivil" data-toggle="collapse" class="">Etat Civil</a>
                                </div>
                                <div id="EtatCivil" class="panel-collapse">
                                    <div class="panel-body">
                                        <div class="libele_form">
                                            <label class="control-label" data-original-title="" title="" ><b> Nom </b></label>
                                        </div>
                                        <div class="form">
                                            <input type="text" class="form-control" placeholder="Nom " name="nom" id="nom" value="{if $oCandidat[0]->nom!=''}{$oCandidat[0]->nom}{else}{$oUser.nom}{/if}" disabled="disabled" data-original-title="" title="">
                                        </div>
                                        <div class="libele_form">
                                            <label class="control-label" data-original-title="" title=""><b> Prénoms</b> </label>
                                        </div>
                                        <div class="form">
                                            <input type="text" class="form-control" placeholder="Prénom(s)" name="prenom" id="nom" value="{if $oCandidat[0]->nom!=''}{$oCandidat[0]->prenom}{else}{$oUser.prenom}{/if}" disabled="disabled" data-original-title="" title="">
                                        </div>
                                        <div class="labelForm libele_form">
                                            <label class="control-label" data-original-title="" title=""><b>Date de
                                                Naissance</b></label>
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="text" id="date_naiss" class="form-control"
                                                   placeholder="Date de Naissance" name="date_naiss" value="{if $oCandidat[0]->nom!=''}{$oCandidat[0]->date_naiss}{else}{$oUser.date_naiss}{/if}"
                                                   data-original-title="" title="" data-bv-field="date_naiss">
                                            <span class="input-group-addon">  <span class="la la-calendar form-control-feedback"></span></span>
                                        </div>
                                        <div  class="form">
                                            <i
                                                    class="form-control-feedback" data-bv-icon-for="date_naiss"
                                                    style="display: none; top: 0px;"></i>

                                            <small class="help-block" data-bv-validator="notEmpty"
                                                   data-bv-for="date_naiss" data-bv-result="NOT_VALIDATED"
                                                   style="display: none;">Veuillez enter votre date de naissance
                                            </small>
                                            <small class="help-block" data-bv-validator="callback"
                                                   data-bv-for="date_naiss" data-bv-result="NOT_VALIDATED"
                                                   style="display: none;">Please enter a valid value
                                            </small>
                                        </div>
                                        <div class="libele_form">
                                            <label class="control-label" data-original-title="" title=""><b>Situation
                                                Matrimoniale</b></label>
                                        </div>
                                        <div  class="form">
                                            <select class="form-control" placeholder="Situation Matrimoniale"
                                                    name="sit_mat" data-toggle="tooltip"
                                                    data-original-title="Hamarino ny momba anao : Manambady, na Misaraka, na Mpitovo, na Maty Vady"
                                                    id="sit_mat" onchange="changeDest()" data-bv-field="sit_mat">
                                                <option value="1">Selectionner</option>
                                            </select><i class="form-control-feedback" data-bv-icon-for="sit_mat"
                                                        style="display: none; top: 0px;"></i>
                                            <small class="help-block" data-bv-validator="greaterThan"
                                                   data-bv-for="sit_mat" data-bv-result="NOT_VALIDATED"
                                                   style="display: none;">Veuillez Sélectionner la situation
                                                matrimoniale
                                            </small>
                                        </div>
                                        <div class="labelForm libele_form">
                                            <label class="control-label" data-original-title="" title=""><b>Nombre
                                                d´enfants</b></label>
                                        </div>
                                        <div  class="form">
                                            <input type="text" id="nbr_enfant" style="width:45px;" maxlength="2"
                                                   class="form-control" name="nbr_enfant" data-toggle="tooltip"
                                                   data-original-title=" Soraty ny isan’ny ankizy" value="{if $oCandidat[0]->nom!=''}{$oCandidat[0]->nbr_enfant}{else}{$oUser.nbr_enfant}{/if}"
                                                   data-bv-field="nbr_enfant"><i class="form-control-feedback"
                                                                                 data-bv-icon-for="nbr_enfant"
                                                                                 style="display: none; top: 0px;"></i>
                                            <small class="help-block" data-bv-validator="notEmpty"
                                                   data-bv-for="nbr_enfant" data-bv-result="NOT_VALIDATED"
                                                   style="display: none;">Veuillez remplir le nombre d'enfant
                                            </small>
                                            <small class="help-block" data-bv-validator="numeric"
                                                   data-bv-for="nbr_enfant" data-bv-result="NOT_VALIDATED"
                                                   style="display: none;">Le nombre d'enfant entré n'est pas valide
                                            </small>
                                            <small class="help-block" data-bv-validator="stringLength"
                                                   data-bv-for="nbr_enfant" data-bv-result="NOT_VALIDATED"
                                                   style="display: none;">Please enter a value with valid length
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-title">
                                    <a  href="#CoordonneesUser"  data-toggle="collapse"  class="collapsed">Coordonnées</a>
                                </div>
                                <div id="CoordonneesUser" class="panel-collapse collapse"">
                                <div class="panel-body">
                                    <div class="libele_form">
                                        <label class="control-label" data-original-title="" title=""><b>Adresse
                                            Actuelle </b><b><font color="red"> * </font></b> </label>
                                    </div>
                                    <div class="form">
                                        <input type="text" id="addresse" class="form-control" placeholder="Adresse"
                                               name="addresse" data-toggle="tooltip"
                                               data-original-title="Soraty ny toeram-ponenao ankehitriny"
                                               value="{$oCandidat[0]->address}" data-bv-field="addresse"><i
                                            class="form-control-feedback" data-bv-icon-for="addresse"
                                            style="display: none; top: 0px;"></i>
                                        <small class="help-block" data-bv-validator="notEmpty"
                                               data-bv-for="addresse" data-bv-result="NOT_VALIDATED"
                                               style="display: none;">Veuillez remplir votre adresse
                                        </small>
                                    </div>

                                    <div class="libele_form">
                                        <label class="control-label" data-original-title=""
                                               title=""><b>Téléphone </b><b><font color="red"> * </font></b>
                                        </label>
                                    </div>
                                    <div class="form">
                                        <input type="text" id="phone" class="form-control" placeholder="Téléphone"
                                               name="phone" data-toggle="tooltip"
                                               data-original-title="Ampidiro ny laharan&#39;ny finday anao (iray ihany)"
                                               value="{$oCandidat[0]->phone}" data-bv-field="phone"><i
                                            class="form-control-feedback" data-bv-icon-for="phone"
                                            style="display: none; top: 0px;"></i>
                                        <small class="help-block" data-bv-validator="notEmpty" data-bv-for="phone"
                                               data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez
                                            remplir votre téléphone
                                        </small>
                                    </div>

                                    <div class="libele_form">
                                        <label class="control-label" data-original-title="" title=""><b>Adresse
                                            Eléctronique</b> </label>
                                    </div>
                                    <div class="form">
                                        <input type="text" id="email" class="form-control" placeholder="E-mail"
                                               name="email" data-toggle="tooltip"
                                               data-original-title="Ampidiro ny mailaka"
                                               value="{$oCandidat[0]->email}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!----------------- Fin bloc Toogle ---------------->
                </div>
                <div class="col-xs-12 col-sm-6 pull-left">
                    <div class="panel panel-default">

                        <!--                                            ONGLETS-->
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" class="collapsed" href="#InformationsAdministratives">Informations Administratives</a>
                            </div>
                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" class="collapsed" href="#Carrieres">Carri&egrave;res</a>
                            </div>
                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" class="collapsed" href="#Formations">Formations</a>
                            </div>
                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" class="collapsed" href="#ParcoursProfessionnel">Parcours professionnel</a>
                            </div>

                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" class="collapsed" href="#Loisirs">Loisirs et Activit&eacute;s annexes</a>
                            </div>
                        </div>

                        <!--                                            ONGLETS-->

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 SubmitCv text-center">
                    <div class="panel panel-default">
                        <div id="InformationsAdministratives" class="panel-collapse collapse">
                            <div class="panel-body">
                                <!--                                                    INFO ADMIN-->
                                <!----------------- bloc Toogle ---------------->

                                <h3>Informations administratives</h3>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b> Statut </b></label>
                                </div>
                                <div class="form">
                                    <select class="form-control" placeholder="Status" name="statut" data-placement="top" disabled="disabled" data-toggle="tooltip" data-original-title="Hamarino ny momba anao na ECD, na ELD, na EMO, na ES, na EFA, na Fonctionnaire" id="statut">
                                        <option value="1">Sélectionner</option>
                                        
                                    </select>
                                </div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b> Corps</b> </label>
                                </div>
                                <div class="form">
                                    <select id="corps" class="form-control" placeholder="Status" name="corps" disabled="disabled" data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « corps »-nao dia mila misafidy ianao">
                                        <option value="0">Sélectionner</option>
                                        
                                    </select>
                                </div>
                                <div class="form">
                                    <input type="text" name="autre_corps" class="form-control" id="autre_corps" style="display: none" data-original-title="" title="">
                                </div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b> Grade</b> </label>
                                </div>
                                <div class="form">
                                    <select class="form-control" placeholder="Status" name="grade" disabled="disabled" data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « Grade »-nao dia mila misafidy ianao" id="grade">
                                        <option value="0">Sélectionner</option>
                                        
                                    </select>
                                </div>
                                <div class="form">
                                    <input type="text" name="autre_grade" class="form-control" id="autre_grade" style="display: none" data-original-title="" title="">
                                </div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b> Indice </b></label>
                                </div>
                                <div class="form">
                                    <select class="form-control" placeholder="Status" name="indice" disabled="disabled" data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « Indice »-nao nao dia mila misafidy ianao" id="indice">
                                        <option value="0">Indice</option>
                                        
                                    </select>
                                </div>
                                <div class="form">
                                    <input type="text" name="autre_indice" class="form-control" id="autre_indice" style="display: none" data-original-title="" title="">
                                </div>
                                <div class="labelForm libele_form">
                                    <label class="control-label" data-original-title="" title=""><b>Date de prise de service</b></label>
                                </div>
                                <div class="form-group input-group form"  id="date_prise_service_div">
                                    <input type="text" id="date_prise_service" class="form-control" placeholder="Date de prise de service" data-placement="top" data-toggle="tooltip" data-original-title="Ampidiro ny  andro/volana/taona  nidiranao niasa teto amin’ny Ministeran’ny Fitantanambola sy ny Teti-bola" name="date_prise_service" value="{$oCandidat[0]->date_prise_service}" data-bv-field="date_prise_service">
                                    <span class="input-group-addon">  <span class="la la-calendar form-control-feedback"></span></span>
                                    <small class="help-block" data-bv-validator="notEmpty" data-bv-for="date_prise_service" data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez enter votre date du prise de service</small><small class="help-block" data-bv-validator="callback" data-bv-for="date_prise_service" data-bv-result="NOT_VALIDATED" style="display: none;">La Date de service doit être inférieur à la date de naissance</small>
                                </div>

                                <!----------------- Fin bloc Toogle ---------------->
                            </div>
                            <!--                                                    INFO ADMIN-->

                        </div>
                        <div id="Carrieres" class="panel-collapse collapse">
                            <div class="panel-body">
                                <!--                                                    INFO ADMIN-->
                                <!----------------- bloc Toogle ---------------->
                                <h3>Carrieres</h3>

                                
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title="">Avancement</label>
                                </div>
                                <div class="form">

                                    <fieldset>
                                        <table id="dataTables-example">
                                            <thead>
                                            <tr>
                                                <th style="text-align:center;">Code Corps</th>
                                                <th style="text-align:center;">Code Grade</th>
                                                <th style="text-align:center;">Date Effet</th>
                                            </tr>
                                            </thead>
                                            <tbody><tr class="even">
                                                <td style="text-align:center;">J08A</td>
                                                <td style="text-align:center;">ST0E</td>
                                                <td style="text-align:center;">14/12/2010</td>
                                            </tr>
                                            
                                            </tbody></table>
                                    </fieldset>
                                </div>

                                <div class=" message"></div>
                                <!----------------- Fin bloc Toogle ---------------->
                            </div>
                            <!--                                                    INFO ADMIN-->

                        </div>

                        <div id="Formations" class="panel-collapse collapse">
                            <div class="panel-body">
                                <h3>Formations</h3>

                                <!--                                        Contents-->

                                <div class="libele_form">
                                    <input type="hidden" value="3" id="size_diplome" data-original-title="" title="">
                                    <label class="control-label" data-original-title="" title=""><b>Diplômes Obtenus (Commencer par le plus récent) </b><b><font color="red"> * </font></b></label>
                                 
                                <table class="tableau" id="tableDiplome">
                                    <tbody>

                                    <tr id="diplome_row_1">
                                        <td><input class="form-control" placeholder="Diplomes" type="text" name="diplome_name[]" value="Ingénieur" data-toggle="tooltip" data-original-title="Soraty ny mari-pahaizana ambony azonao farany" data-bv-field="diplome_name[]"><i class="form-control-feedback" data-bv-icon-for="diplome_name[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_name[]" style="display: none; top: 0px;"></i></td>
                                        <td><input class="form-control" placeholder="Filière" type="text" name="diplome_discipline[]" value="Informatique" data-toggle="tooltip" data-original-title="Soraty ny sampam-pianarana" data-bv-field="diplome_discipline[]"><i class="form-control-feedback" data-bv-icon-for="diplome_discipline[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_discipline[]" style="display: none; top: 0px;"></i></td>
                                        <td><input class="form-control input_date" maxlength="4" id="diplome_date_1" onchange="testDate('1')" placeholder="Année d`obtention" type="text" name="diplome_date[]" value="2006" data-toggle="tooltip" data-original-title="Soraty ny taona nahazoanao ilay mari-pahaizana" data-bv-field="diplome_date[]"><i class="form-control-feedback" data-bv-icon-for="diplome_date[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_date[]" style="display: none; top: 0px;"></i></td>
                                        <td><input class="form-control " placeholder="Etablissement " type="text" name="diplome_etablissement[]" value="ISPM" data-toggle="tooltip" data-original-title="Soraty ny toeram-pianarana nahazoanao ilay mari-pahaizana" data-bv-field="diplome_etablissement[]"><i class="form-control-feedback" data-bv-icon-for="diplome_etablissement[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_etablissement[]" style="display: none; top: 0px;"></i></td>
                                        <td><input class="form-control" placeholder="Pays" type="text" name="diplome_pays[]" value="Madagascar" data-toggle="tooltip" data-original-title="Soraty ny anaran'ilay firenena nahazoanao ilay mari-pahaizana" data-bv-field="diplome_pays[]"><i class="form-control-feedback" data-bv-icon-for="diplome_pays[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_pays[]" style="display: none; top: 0px;"></i></td>

                                    </tr>
                                    

                                        <td style="width:15px!important"><button class="btn_close" type="button" onclick="deleteDiplome(3)" data-original-title="" title=""><i class="la la-minus-circle"></i></button></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="buttonForm">
                                    <button type="button" class="form-control" data-toggle="tooltip" data-original-title="Tsindrio ra hanampy diplaoma" id="ajoutDiplome"> Ajouter un Diplôme</button>
                                </div>


                                <!-------------------------------------->

                                <div class="libele_form" style="background:none;">
                                    <label class="control-label" data-original-title="" title=""><b>Domaines de Compétences </b><b><font color="red"> * </font></b>
                                    </label>
                                </div>
                                <div class="form" style="background:none;">
                                    <textarea name="domaine" id="domaine" class="form-control" rows="5" data-toggle="tooltip" data-original-title="Soraty ireo karazana traikefa hafa voafehinao" data-bv-field="domaine">{$oCandidat[0]->domaine}</textarea><i class="form-control-feedback" data-bv-icon-for="domaine" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="domaine" style="display: none; top: 0px;"></i>
                                    <small class="help-block" data-bv-validator="notEmpty" data-bv-for="domaine" data-bv-result="NOT_VALIDATED" style="display: none;">Le domaine est obligatoire</small>
                                </div>


                                <div class="aide"> <u>Exemples</u>:
                                    Fiscalité, gestion de projet,marketing,finances, comptabilité

                                </div>
                                <div class="libele_form" style="background:none;">
                                    <label class="control-label" data-original-title="" title=""><b>Autres </b>
                                    </label>
                                </div>
                                <div class="form">
                                    <textarea name="autre_domaine" id="autre_domaine" class="form-control" rows="5" data-toggle="tooltip" data-original-title="Soraty  raha manana traikela lanampiny ianao">{$oCandidat[0]->autre_domaine}</textarea>
                                </div>
                                <div class="aide"> <u>Exemple </u>:
                                    permis de conduire ,
                                    formation premier secours
                                </div>
                                <!--                                        Contents-->



                            </div>
                        </div>
                        <div id="ParcoursProfessionnel" class="panel-collapse collapse">
                            <div class="panel-body">
                                <h3>Parcours professionnel</h3>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b>Poste </b><b><font color="red"> * </font></b> </label>
                                </div>
                                <div class="form">
                                    <input type="text" class="form-control" placeholder="Poste" name="poste" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny asa amandrarahanao" id="poste" value="{$oCandidat[0]->poste} " data-bv-field="poste"><i class="form-control-feedback" data-bv-icon-for="poste" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="poste" style="display: none; top: 0px;"></i>
                                    <small class="help-block" data-bv-validator="notEmpty" data-bv-for="poste" data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez remplir votre poste</small></div>
                                <div class="aide">
                                    <u>Exemple </u>:Chef de service / Comptable
                                </div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b>Activité (Etudier les dossiers entrants)</b> <b><font color="red"> * </font></b> </label>
                                </div>
                                <div class="form">
                                    <table id="table_activite">
                                        <tbody><tr id="row_activite_1">
                                            <td style="padding:2px;width:90%"><input type="text" class="form-control" placeholder="Activité" name="activite[]" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny asa amandrarahanao" value="Développer des application de la Direction" data-bv-field="activite[]"><i class="form-control-feedback" data-bv-icon-for="activite[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="activite[]" style="display: none; top: 0px;"></i></td>


                                        </tr>
                                        </tbody></table>
                                    <small class="help-block" data-bv-validator="notEmpty" data-bv-for="activite[]" data-bv-result="NOT_VALIDATED" style="display: none;">Votre Activité est obligatoire</small></div>
                                <div class="buttonForm">
                                    <button  type="button" class="form-control" id="ajoutActivite" data-toggle="tooltip" data-original-title="Tsindrio ra hanampy ny asa efa nosahaninao hatramin’izay">Ajouter une activité</button>
                                </div>
                                <div class="libele_form">
                                    <input type="hidden" value="1" id="size_parcours" data-original-title="" title="">
                                    <label class="control-label" data-original-title="" title=""><b>Parcours (Commencer par votre poste actuel)</b></label>
                                </div>
                                <table class="tableau" id="tableParcours">
                                    <tbody>
                                    <tr id="parcours_row_1">
                                        <td>&nbsp;</td>
                                        <td><input class="form-control input_date" maxlength="4" id="date_debut_1" onchange="testDate('1')" placeholder="Année / Début" type="text" name="date_debut[]" value="2016" data-toggle="tooltip" data-original-title="Soraty ny taona nanombohanao niasa tao amin'ny sampan-draharaha" data-bv-field="date_debut[]"><i class="form-control-feedback" data-bv-icon-for="date_debut[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="date_debut[]" style="display: none; top: 0px;"></i></td>

                                        <td><input class="form-control input_date" maxlength="4" id="date_fin_1" onchange="testDate('1')" placeholder="Année / Fin" type="text" name="date_fin[]" value="" data-toggle="tooltip" data-original-title="Soraty ny taona farany niasanao tao amin'ny sampandraharaha" data-bv-field="date_fin[]"><i class="form-control-feedback" data-bv-icon-for="date_fin[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="date_fin[]" style="display: none; top: 0px;"></i></td>

                                        <td><input class="form-control" placeholder="Poste" type="text" name="par_poste[]" value="Informaticien Développeur " data-toggle="tooltip" data-original-title="Soraty ny asa na andraikitra nosahaninao" data-bv-field="par_poste[]"><i class="form-control-feedback" data-bv-icon-for="par_poste[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="par_poste[]" style="display: none; top: 0px;"></i></td>

                                        <td><input class="form-control" placeholder="Departement" type="text" name="par_departement[]" value="SG/DRHA" data-toggle="tooltip" data-original-title="Soraty ny Departemanta na sampan-draharaha  misy anao" data-bv-field="par_departement[]"><i class="form-control-feedback" data-bv-icon-for="par_departement[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="par_departement[]" style="display: none; top: 0px;"></i></td>

                                    </tr>
                                    </tbody>
                                </table>

                                <div class="buttonForm">
                                    <button  type="button" class="form-control" id="ajoutParcours" data-toggle="tooltip" data-original-title="Tsindrio ra hanampy ny asa efa nosahaninao hatramin’izay">Ajouter un parcours</button>
                                </div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b> Pays </b></label><font color="red"> *</font>
                                </div>
                                <div class="form" style="background:none;">
                                    <select class="form-control" placeholder="pays" name="pays" data-placement="top" data-toggle="tooltip" data-original-title="Safidio ny anarany ilay firenena nahazoanao ilay mari-pahaizana" id="pays" data-bv-field="pays">
                                        <option value="1">Sélectionner</option>
                                        
                                    </select>
                                    <i class="form-control-feedback" data-bv-icon-for="pays" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="pays" style="display: none; top: 0px;"></i>
                                    <small class="help-block" data-bv-validator="greaterThan" data-bv-for="pays" data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez Sélectionner votre Pays</small></div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b>Province</b> </label><font color="red"> *</font>
                                </div>
                                <div class="form">
                                    <select class="form-control" placeholder="province" name="province" data-toggle="tooltip" data-original-title="Safidio ny Faritany misy anao" id="province" data-bv-field="province">
                                        <option  value=2>ANTANANARIVO</option>
                                    </select>
                                    <i class="form-control-feedback" data-bv-icon-for="province" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="province" style="display: none; top: 0px;"></i>
                                    <small class="help-block" data-bv-validator="greaterThan" data-bv-for="province" data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez Sélectionner votre Province</small></div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b> Région</b> </label><font color="red"> *</font>
                                </div>
                                <div class="form">
                                    <select class="form-control" placeholder="Region" name="region" data-toggle="tooltip" data-original-title="Safidio ny Faritra misy anao" id="region" data-bv-field="region">
                                        <option  value=1>Analamanga</option>
                                    </select>
                                    <i class="form-control-feedback" data-bv-icon-for="region" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="region" style="display: none; top: 0px;"></i>
                                    <small class="help-block" data-bv-validator="greaterThan" data-bv-for="region" data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez Sélectionner votre Region</small></div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b> District</b> </label><font color="red"> *</font>
                                </div>
                                <div class="form">
                                    <select class="form-control" placeholder="district" name="district" data-placement="top" data-toggle="tooltip" data-original-title="safidio ny Distrika misy anao" id="district" data-bv-field="district">
                                        <option value="0">-------</option>
                                        </select><i class="form-control-feedback" data-bv-icon-for="district" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="district" style="display: none; top: 0px;"></i>
                                    <small class="help-block" data-bv-validator="greaterThan" data-bv-for="district" data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez Sélectionner votre District</small></div>
                                <div class="libele_form">
                                    <label class="control-label" data-original-title="" title=""><b>Département</b>  </label><b><font color="red"> * </font></b>
                                </div>
                                <div class="form">
                                    <select class="form-control" placeholder="Departement" name="departement" data-toggle="tooltip" data-original-title="Safidio ny Departemanta na sampan-draharaha misy anao" id="departement" data-bv-field="departement">
                                        <option value="0">-------</option>
                                        
                                    </select><i class="form-control-feedback" data-bv-icon-for="departement" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="departement" style="display: none; top: 0px;"></i>
                                    <small class="help-block" data-bv-validator="greaterThan" data-bv-for="departement" data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez Sélectionner votre Departement</small></div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b> Direction</b> </label><b></b>
                                </div>
                                <div class="form">
                                    <select class="form-control" placeholder="Direction" name="direction" data-toggle="tooltip" data-original-title="Safidio ny Foibem-pitondrana misy anao " id="direction">
                                        <option value="0">-------</option>
                                        

                                    </select>
                                </div>
                                <div class="libele_form">
                                    <label class="control-label" data-original-title="" title=""><b> Service</b> </label>
                                </div>
                                <div class="form">
                                    <select class="form-control" placeholder="Service" name="service" data-toggle="tooltip" data-original-title="Safidio  ny sampan-draharaha  misy anao " id="service">
                                        <option value="0">-------</option>
                                        
                                    </select>
                                </div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b> SOA</b> </label>
                                </div>
                                <div id="div_soa">
                                    
                                </div>
                                <div class="form">
                                    <input type="text" name="autre_service" class="form-control" id="autre_service" style="display: none" data-original-title="" title="">
                                </div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b> Division</b> </label>
                                </div>
                                <div class="form">
                                    <select class="form-control" placeholder="Division" name="division" data-toggle="tooltip" data-original-title="Safidio ny Division misy anao" id="division">
                                        <option value="999999">-------</option>
                                        <option value="0">AUTRES</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="autre_division" class="form-control" id="autre_division" style="display: none" data-original-title="" title="">
                                </div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b>Porte</b> <b><font color="red"> * </font></b> </label>
                                </div>
                                <div class="form" style="background:none;">
                                    <input type="text" class="form-control" placeholder="Porte" name="porte" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny varavarana ny toeram-piasanao" id="porte" value="{$oCandidat[0]->porte}" data-bv-field="porte"><i class="form-control-feedback" data-bv-icon-for="porte" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="porte" style="display: none; top: 0px;"></i>
                                    <small class="help-block" data-bv-validator="notEmpty" data-bv-for="porte" data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez remplir votre porte ou code porte</small></div>
                                <div class="aide"> <u>Exemple </u>:
                                    P15 / BOX2
                                </div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b>Lieu de travail</b> <b><font color="red"> * </font></b> </label>
                                </div>
                                <div class="form">
                                    <input type="text" class="form-control" placeholder="Lieu de travail" name="lacalite_service" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny toeram-piasanao" id="lacalite_service" value="{$oCandidat[0]->lacalite_service}" data-bv-field="lacalite_service"><i class="form-control-feedback" data-bv-icon-for="lacalite_service" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="lacalite_service" style="display: none; top: 0px;"></i>
                                    <small class="help-block" data-bv-validator="notEmpty" data-bv-for="lacalite_service" data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez remplir votre localité de service</small></div>
                                <div class="aide"> <u>Exemple </u>:
                                    Immeuble Finances Antaninarenina / SONACO Ambanidia
                                </div>

                            </div>
                        </div>
                        <div id="Loisirs" class="panel-collapse collapse">
                            <div class="panel-body">
                                <!--                                                    INFO ADMIN-->
                                <!----------------- bloc Toogle ---------------->
                                <h3>Loisirs et Activit&eacute;s annexes</h3>

                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b>label</b> </label>
                                </div>

                                <div class="form">
                                    <textarea name="label" class="form-control" id="loisirs" data-original-title="" title=""></textarea>
                                </div>
                                <div class=" message"></div>
                                <!----------------- Fin bloc Toogle ---------------->
                            </div>
                            <!--                                                    INFO ADMIN-->

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 SubmitCv text-center">
                    <font><b><font color="red" size="5rem"> * </font></b>  Les champs marqués d'une étoile sont obligatoires.</font>
                </div>
                <div class="col-xs-12 col-sm-12 SubmitCv text-center">

                    <input type="submit" class="btn btn-primary form-control " data-toggle="tooltip" data-original-title=" Tsindrio rehefa feno daholo ny momba anao rehetra " value="Enregistrer">

                    <a href="http://rohi.dev/cv/mon_cv#" class="btn btn-primary form-control " data-toggle="tooltip" data-original-title=" Tsindrio dia afaka manonta ny mari-pankasitrahanao" onclick="certificat()"> <font style="font-size: 1em;"> Imprimer attestation</font></a>

                    <a href="http://rohi.dev/cv/fpdf_cv/" class="btn btn-primary form-control " data-toggle="tooltip" data-original-title=" Tsindrio dia afaka manonta ny CV'nao ianao" target="_blank"> <font style="font-size: 1em;"> Imprimer CV </font></a>

                </div>
                </form>



                <!--*Fin Contenue*-->
            </div>
        </div>
</div>


<link rel="stylesheet" href="css/fullcalendar.min.css"/>
<div id="calendar"></div>
</section>

	<section id="rightContent" class="clearfix">
		{include_php file=$zRight}
	</section>
	{include_php file=$zFooter}
</div>
</body>
</html>