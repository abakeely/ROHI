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
                        <input type="hidden" name="corps" id="corps" value="J08A" data-original-title="" title="">
                        <input type="hidden" name="grade" id="grade" value="ST0E" data-original-title="" title="">
                        <input type="hidden" name="indice" id="indice" value="950" data-original-title=""
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
                        <input type="hidden" id="date_compare" name="date_compare" value="19/5/1999"
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
                                                <label><b>Nom :</b> RANDRIANANTENAINA</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="field">
                                            <label>Prénom(s) : Tojo Michaël</label>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="cell">
                                            <div class="field">
                                                <label>Matricule : 389671</label>
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
                                            <input type="text" class="form-control" placeholder="Nom " name="nom" id="nom" value="RANDRIANANTENAINA" disabled="disabled" data-original-title="" title="">
                                        </div>
                                        <div class="libele_form">
                                            <label class="control-label" data-original-title="" title=""><b> Prénoms</b> </label>
                                        </div>
                                        <div class="form">
                                            <input type="text" class="form-control" placeholder="Prénom(s)" name="prenom" id="nom" value="Tojo Michaël" disabled="disabled" data-original-title="" title="">
                                        </div>
                                        <div class="labelForm libele_form">
                                            <label class="control-label" data-original-title="" title=""><b>Date de
                                                Naissance</b></label>
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="text" id="date_naiss" class="form-control"
                                                   placeholder="Date de Naissance" name="date_naiss" value="01/05/2017"
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
                                                <option value="2" selected="selected">Célibataire</option>
                                                <option value="3" >Marié(e)</option>
                                                <option value="4">Divorcé(e)</option>
                                                <option value="5">Veuf(ve)</option>
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
                                                   data-original-title=" Soraty ny isan’ny ankizy" value="12"
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
                                               value="III K 1 ter Be Tsimbazaza" data-bv-field="addresse"><i
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
                                               value="032 11 084 05" data-bv-field="phone"><i
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
                                               value="tojo.drha@gmail.com">
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
                                <a data-toggle="collapse" data-parent="#accordion" href="#Carrieres" class="collapsed">Carri&egrave;res</a>
                            </div>
                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#Formations" class="collapsed">Formations</a>
                            </div>
                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#ParcoursProfessionnel" class="collapsed">Parcours professionnel</a>
                            </div>

                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#Loisirs" class="collapsed">Loisirs et Activit&eacute;s annexes</a>
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
                                <div class="col-xs-12 col-sm-7">
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-4">
                                            <span class="col-theme-fond themebull"></span>
                                            <p>Couleur de fond</p>
                                        </div>
                                        <div class="col-xs-4 col-sm-4">
                                            <span class="col-theme-titre themebull"></span>
                                            <p>Couleur du titre</p>
                                        </div>
                                        <div class="col-xs-4 col-sm-4">
                                            <span class="col-theme-menu themebull"></span>
                                            <p>Couleur du Menu</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-5">
                                    <div id="theme-image"></div>
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
                                    <label class="control-label " data-original-title="" title=""><b> Statut </b></label>
                                </div>
                                <div class="form">
                                    <select class="form-control" placeholder="Status" name="statut" data-placement="top" disabled="disabled" data-toggle="tooltip" data-original-title="Hamarino ny momba anao na ECD, na ELD, na EMO, na ES, na EFA, na Fonctionnaire" id="statut">
                                        <option value="1">Sélectionner</option>
                                        <option value="2">ECD</option>
                                        <option value="3">ELD</option>
                                        <option value="4">EMO</option>
                                        <option value="5" selected="selected">EFA</option>
                                        <option value="6">ES</option>
                                        <option value="7">FONCTIONNAIRE</option>
                                        <option value="8">HEE</option>
                                        <option value="9">STG</option>
                                    </select>
                                </div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b> Corps</b> </label>
                                </div>
                                <div class="form">
                                    <select id="corps" class="form-control" placeholder="Status" name="corps" disabled="disabled" data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « corps »-nao dia mila misafidy ianao">
                                        <option value="0">Sélectionner</option>
                                        <option value="1100">CONTRACTUELS ELD1 D'INDICE CT 1000 </option>
                                        <option value="2700">CONTRACTUELS ELD2 D'INDICE CT 700 </option>
                                        <option value="3001">CONTRACTUELS ELD 3 </option>
                                        <option value="3215">CONTRACTUELS ELD3 D'INDICE CT 215 </option>
                                        <option value="3250">CONTRACTUELS ELD3 D'INDICE CT 250 </option>
                                        <option value="3300">CONTRACTUELS ELD3 D'INDICE CT 300 </option>
                                        <option value="3400">CONTRACTUELS ELD3 D'INDICE CT 400 </option>
                                        <option value="4001">CONTRACTUELS ELD 4 </option>
                                        <option value="4100">CONTRACTUELS ELD4 D'INDICE CT 100 </option>
                                        <option value="4125">CONTRACTUELS ELD4 D'INDICE CT 125 </option>
                                        <option value="4135">CONTRACTUELS ELD4 D'INDICE CT 135 </option>
                                        <option value="4150">CONTRACTUELS ELD4 D'INDICE CT 150 </option>
                                        <option value="4160">CONTRACTUELS ELD4 D'INDICE CT 160 </option>
                                        <option value="4165">CONTRACTUELS ELD4 D'INDICE CT 165 </option>
                                        <option value="4175">CONTRACTUELS ELD4 D'INDICE CT 175 </option>
                                        <option value="A00A">ATTACHES DE SERVICE </option>
                                        <option value="A00B">TECNHICIENS SUP. DE SERVICE </option>
                                        <option value="A01B">CADRE A ECHELLE A1 </option>
                                        <option value="A01C">CADRE A ECHELLE A1 </option>
                                        <option value="A01D">CADRE A ECHELLE A2 </option>
                                        <option value="A01F">CADRE A ECHELLE A2 </option>
                                        <option value="A01G">CADRE A ECHELLE A3 </option>
                                        <option value="A04A">ADMI. DES ASSEMBLES PARLEMANT. </option>
                                        <option value="A04C">ADJOINT D'ADMINISTRATION CNFA </option>
                                        <option value="A06A">ADMINISTRATEURS CIVILS </option>
                                        <option value="A06B">ATTACHES D'ADMINISTRATION </option>
                                        <option value="A06C">ATTACHES D'ADMINISTRATION </option>
                                        <option value="A06E">ADJOINTS D'ADMINISTRATION </option>
                                        <option value="A08A">INSPECTEURS D'ETAT </option>
                                        <option value="A08B">CONTROLEURS D'ETAT </option>
                                        <option value="A09A">INSPECTEURS DU TRAVAIL ET L.S. </option>
                                        <option value="A11A">AGENTS DIPLOMATIQUES ET CONSUL </option>
                                        <option value="A132">GENERAL DE DIVISION </option>
                                        <option value="A133">GENERAL DE BRIGADE </option>
                                        <option value="A14A">COLONEL </option>
                                        <option value="A15A">MAGISTRATS ET MAGISTRATS SUPPLEANTS </option>
                                        <option value="A17C">INSPECTEUR ET INSPECTEURS GENERAUX PENITENTIAIRE</option>
                                        <option value="A18A">CONCEPTEUR </option>
                                        <option value="A18B">REALISATEUR </option>
                                        <option value="A18C">TECHNICIEN SUPERIEUR </option>
                                        <option value="A18D">REALISATEUR ADJOINT </option>
                                        <option value="A19A">CHEF DE BUREAU DES SERVICES FINANCIERS </option>
                                        <option value="A19B">ADMINISTRATEURS DES SERVICES FINANCIERS </option>
                                        <option value="A19C">ADMINISTRATEURS ADJOINTS DES SERVICES FINANCIERS </option>
                                        <option value="A19P">PERCEPTEURS PRINCIPAUX DES FINANCES </option>
                                        <option value="A23B">CONTROLEURS DES CONTRIBUTIONS DIRECTES </option>
                                        <option value="A23D">INSPECTEURS DES CONTRIBUTIONS DIRECTES CAT. VIII </option>
                                        <option value="A24D">INSPECTEURS  DES IMPOTS</option>
                                        <option value="A24D">INSPECTEURS DES IMPOTS</option>
                                        <option value="A25B">INSPECTEURS DES CONTRIBUTIONS INDIRECTES CAT. VIII</option>
                                        <option value="A25C">CONTROLEURS DES CONTRIBUTIONS INDIRECTES </option>
                                        <option value="A27A">INSPECTEURS ENREGISTREMENTS ET TIMBRES </option>
                                        <option value="A27B">INSPECTEURs ENREGITREMENTS ET TIMBRES </option>
                                        <option value="A29A">INSPECTEURS DES DOUANES CAT. VII </option>
                                        <option value="A29B">INSPECTEURS DES DOUANES CAT. VIII </option>
                                        <option value="A31B">INSPECTEURS DU TRESOR </option>
                                        <option value="A35A">PROGRAMMEURS /ENS. ELECTRONIQU </option>
                                        <option value="A35B">INGENIEURS PPAUX DE STATISTIQUE</option>
                                        <option value="A35C">INGENIEURS DE STATISTIQUE </option>
                                        <option value="A41A">INSPECTEURS DES DOMAINES </option>
                                        <option value="A45C">INGENIEUR D'AGRICULTURE </option>
                                        <option value="A70A">PLANIFICATEURS PRINCIPAUX </option>
                                        <option value="A70B">PLANIFICATEUR </option>
                                        <option value="A70C">ATTACHES DE PLANIFICATION </option>
                                        <option value="A88C">PROFESSEURS CERTIFIES </option>
                                        <option value="A88E">PROFESSEURS LICENCIES TECHN. </option>
                                        <option value="A88F">CHARGES ENS.EDUCATION NATIONAL </option>
                                        <option value="A88I">PROFESSEURS DE L'ENSEIGNEMENT SUPERIEUR </option>
                                        <option value="A88J">MAITRES DE CONFERENCE,RECHERCHE </option>
                                        <option value="A88K">MAITRES ASSISTANTS D'ENSEIGNEMENT SUPERIEUR, RECH.</option>
                                        <option value="A88L">ASSISTANTS D'ENSEIGNEMENT SUPERIEUR, RECH. </option>
                                        <option value="A88M">ADMINISTRATEURS D'UNIVERSITE </option>
                                        <option value="A88U">C.A.P.E.N </option>
                                        <option value="A90B">INSPECTEUR JEUNESSE ET SPORT </option>
                                        <option value="A94A">MEDECINS DIPLOMES D'ETAT (CAT. VIII) </option>
                                        <option value="A94I">MEDECINS DIPLOMES D'ETAT (CAT. IX) </option>
                                        <option value="B00A">ADJOINTS DE SERVICE </option>
                                        <option value="B06A">ADJOINTS D'ADMINISTRATION </option>
                                        <option value="B06B">ASSISTANTS D'ADMINISTRATION </option>
                                        <option value="B10A">OFFICIERS DE POLICE </option>
                                        <option value="B12A">ADJOINTS TECHNIQUES DE COOPER. </option>
                                        <option value="B13A">ASPIRANTS </option>
                                        <option value="B13D">SERGENT MAJOR </option>
                                        <option value="B15B">SECRETAIRE REDACTEUR S/CE JUD. </option>
                                        <option value="B15E">GREFFIERS DES SCES JUDICIAIRES </option>
                                        <option value="B16A">ADJ. TECH. ANIM. ET EDUC. BASE </option>
                                        <option value="B17B">ENCADREURS PENITENTIAIRE </option>
                                        <option value="B18A">ENCADREUR </option>
                                        <option value="B19A">SOUS-CHEF BUREAUX FIN. </option>
                                        <option value="B19B">PERCEPTEURS PPAUX S/CES FIN. </option>
                                        <option value="B23A">CONTROLEURS CONTRIB. DIRECTES </option>
                                        <option value="B25A">CONTROLEURS CONTRIB. INDIRECT. </option>
                                        <option value="B27A">CONTROLEURS ENREGISTR. TIMBRES </option>
                                        <option value="B29A">CONTROLEURS DES DOUANES </option>
                                        <option value="B31A">CONTROLEURS DU TRESOR </option>
                                        <option value="B53A">ADJOINTS TECHN. EAUX ET FORETS </option>
                                        <option value="B69A">ADJOINTS TECH TRAVAUX PUBLICS </option>
                                        <option value="B70A">ADJOINT TEHCNIQUES DE PLANIFICATION </option>
                                        <option value="B88A">INSTITUTEURS ET INSTITUTRICES </option>
                                        <option value="B88B">ADJOINTS D'ADM. ACADEMIQUE </option>
                                        <option value="B88F">ADJOINTS ADMINIS. D'UNIVERSITE </option>
                                        <option value="C00A">ASSISTANTS DE SERVICE </option>
                                        <option value="C01A">CADRE C ECHELLE C </option>
                                        <option value="C04A">ASSISTANTS D'ADM. DES ASS. PAR </option>
                                        <option value="C06A">ASSISTANTS D'ADMINISTRATION </option>
                                        <option value="C10A">INSPECTEURS DE POLICE </option>
                                        <option value="C12A">AGENTS TECHNIQUES DE COOPERAT. </option>
                                        <option value="C14B">GENDARMES 1ERE CLASSE </option>
                                        <option value="C14C">GENDARME 2EME CLASSE </option>
                                        <option value="C15A">ASSISTANTS DES S/CES JUDIC. </option>
                                        <option value="C16A">AGENTS TECH. ANIM. ET EDUC. B. </option>
                                        <option value="C17A">AGE.D'ENCADRE.DE L ADMINIS.PEN </option>
                                        <option value="C18A">OPERATEUR </option>
                                        <option value="C19A">PERCEPTEURS DES FIN. </option>
                                        <option value="C23A">AGENTS D'ASSIETTE CONT. DIRECT </option>
                                        <option value="C25A">AGENTS DE CONSTATATION C. I. </option>
                                        <option value="C27A">AGENTS CONSTATATION ENR. TIMBR </option>
                                        <option value="C29A">AGENTS CONSTATATION DOUANES </option>
                                        <option value="C29B">AGENTS ENCADREMENT DOUANES </option>
                                        <option value="C31A">COMPTABLES DU TRESOR </option>
                                        <option value="C35A">OPERATEURS, MONITEURS/CARTES P </option>
                                        <option value="C88A">INSTITUTEURS ET INSTITUTRICES </option>
                                        <option value="C88E">ASSISTANTS ADMINISTRIFS D'UNIVERSITE </option>
                                        <option value="D00A">EMPLOYES DE SERVICE </option>
                                        <option value="D06A">EMPLOYES D'ADMINISTRATION </option>
                                        <option value="D10A">BRIGADIERS,SOUS BRIGADIER ET AGENTS DE POLICE </option>
                                        <option value="D14A">GENDARMES STAGIAIRES </option>
                                        <option value="D17D">AGENTS PENITENTIAIRE </option>
                                        <option value="D18A">SOUS OPERATEUR </option>
                                        <option value="D25A">BRIGADIERS DES CONTRIB. IND. </option>
                                        <option value="D25B">PREPOSES DES CONTRIB. INDIRECT </option>
                                        <option value="D29A">BRIGADIERS DES DOUANES </option>
                                        <option value="D29B">PREPOSES DES DOUANES </option>
                                        <option value="D35A">PERFOREURS-VERIFIEURS,AIDES-OP </option>
                                        <option value="D69A">EMPLOYES TECH TRAVAUX PUBLICS </option>
                                        <option value="J04A">CONTRACTUELS ASSIMILES CADRE A CAT 04</option>
                                        <option value="J04B">CONTRACTUELS EFA CAT IV, B </option>
                                        <option value="J05A">CONTRACTUELS ASSIMILES CADRE A CAT 05</option>
                                        <option value="J05B">CONTRACTUELS EFA CAT V, B </option>
                                        <option value="J06A">CONTRACTUELS ASSIMILES CADRE A CAT 06</option>
                                        <option value="J07A">CONTRACTUELS ASSIMILES CADRE A CAT 07</option>
                                        <option value="J08A" selected="selected">CONTRACTUELS ASSIMILES CADRE A CAT 08</option>
                                        <option value="J94A">MEDECIN CONTRACTUEL </option>
                                        <option value="J94I">MEDECIN CONTRACTUEL </option>
                                        <option value="K00A">CONTRACTUELS ASSIMILES CADRE B CAT 03</option>
                                        <option value="L00A">CONTRACTUELS ASSIMILES CADRE C CAT 02</option>
                                        <option value="M00A">CONTRACTUELS ASSIMILES CADRE D CAT 01</option>
                                        <option value="M00B">CONTRACTUELS ASSIMILES CADRE D CAT 01</option>
                                        <option value="U01C">CONTRACTUELS ASSIMILES CADRE D DUREE INDETERMINEE CAT 01</option>
                                        <option value="U01D">CONTRACTUELS ASSIMILES CADRE D DUREE INDETERMINEE CAT 01</option>
                                        <option value="U02C">CONTRACTUELS ASSIMILES CADRE C DUREE INDETERMINEE CAT 02</option>
                                        <option value="U03B">CONTRACTUELS ASSIMILES CADRE B DUREE INDETERMINEE CAT 03</option>
                                        <option value="U04A">CONTRACTUELS ASSIMILES CADRE A DUREE INDET. CAT 04</option>
                                        <option value="U05A">CONTRACTUELS ASSIMILES CADRE A DUREE INDET. CAT 05</option>
                                        <option value="U06A">CONTRACTUELS ASSIMILES CADRE A DUREE INDET. CAT 06</option>
                                        <option value="U07A">CONTRACTUELS ASSIMILES CADRE A DUREE INDET. CAT 07</option>
                                        <option value="U08A">CONTRACTUELS ASSIMILES CADRE A DUREE INDET. CAT 08</option>
                                        <option value="U09A">CONTRACTUELS ASSIMILES CADRE A DUREE INDET. CAT 09</option>
                                        <option value="U94A">MEDECIN CONTRACTUEL INDETERMINE </option>
                                        <option value="0">AUTRES</option>
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
                                        <option value="1C1E">1C1E</option>
                                        <option value="1C2E">1C2E</option>
                                        <option value="1C3E">1C3E</option>
                                        <option value="1C4E">1C4E</option>
                                        <option value="2C1E">2C1E</option>
                                        <option value="2C2E">2C2E</option>
                                        <option value="2C3E">2C3E</option>
                                        <option value="A11E">A11E</option>
                                        <option value="A12E">A12E</option>
                                        <option value="A13E">A13E</option>
                                        <option value="A21E">A21E</option>
                                        <option value="A22E">A22E</option>
                                        <option value="A23E">A23E</option>
                                        <option value="A24E">A24E</option>
                                        <option value="A25E">A25E</option>
                                        <option value="A31E">A31E</option>
                                        <option value="A32E">A32E</option>
                                        <option value="A33E">A33E</option>
                                        <option value="A34E">A34E</option>
                                        <option value="A35E">A35E</option>
                                        <option value="A36E">A36E</option>
                                        <option value="A37E">A37E</option>
                                        <option value="A41E">A41E</option>
                                        <option value="A42E">A42E</option>
                                        <option value="A43E">A43E</option>
                                        <option value="A44E">A44E</option>
                                        <option value="A45E">A45E</option>
                                        <option value="A46E">A46E</option>
                                        <option value="A47E">A47E</option>
                                        <option value="AP2E">AP2E</option>
                                        <option value="AP3E">AP3E</option>
                                        <option value="BC2E">BC2E</option>
                                        <option value="BC3E">BC3E</option>
                                        <option value="EX1E">EX1E</option>
                                        <option value="EX2E">EX2E</option>
                                        <option value="EX3E">EX3E</option>
                                        <option value="EX4E">EX4E</option>
                                        <option value="EX5E">EX5E</option>
                                        <option value="EX6E">EX6E</option>
                                        <option value="EX7E">EX7E</option>
                                        <option value="EX8E">EX8E</option>
                                        <option value="EX9E">EX9E</option>
                                        <option value="G10E">G10E</option>
                                        <option value="G22E">G22E</option>
                                        <option value="G31E">G31E</option>
                                        <option value="G32E">G32E</option>
                                        <option value="G34E">G34E</option>
                                        <option value="G42E">G42E</option>
                                        <option value="G43E">G43E</option>
                                        <option value="G44E">G44E</option>
                                        <option value="GB3E">GB3E</option>
                                        <option value="GD3E">GD3E</option>
                                        <option value="GN1E">GN1E</option>
                                        <option value="GN2E">GN2E</option>
                                        <option value="GN3E">GN3E</option>
                                        <option value="GN4E">GN4E</option>
                                        <option value="GN5E">GN5E</option>
                                        <option value="GN6E">GN6E</option>
                                        <option value="GN7E">GN7E</option>
                                        <option value="MC1E">MC1E</option>
                                        <option value="MC2E">MC2E</option>
                                        <option value="MC3E">MC3E</option>
                                        <option value="MJ00">MJ00</option>
                                        <option value="MJ10">MJ10</option>
                                        <option value="MJ20">MJ20</option>
                                        <option value="MJ30">MJ30</option>
                                        <option value="MJ40">MJ40</option>
                                        <option value="MJ50">MJ50</option>
                                        <option value="PF2E">PF2E</option>
                                        <option value="PR1E">PR1E</option>
                                        <option value="PR2E">PR2E</option>
                                        <option value="PR3E">PR3E</option>
                                        <option value="SM1E">SM1E</option>
                                        <option value="ST0E" selected="selected">ST0E</option>
                                        <option value="ST1E">ST1E</option>
                                        <option value="0">AUTRES</option>
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
                                        <option value="212">212</option>
                                        <option value="222">222</option>
                                        <option value="231">231</option>
                                        <option value="241">241</option>
                                        <option value="242">242</option>
                                        <option value="250">250</option>
                                        <option value="257">257</option>
                                        <option value="259">259</option>
                                        <option value="260">260</option>
                                        <option value="262">262</option>
                                        <option value="269">269</option>
                                        <option value="270">270</option>
                                        <option value="273">273</option>
                                        <option value="274">274</option>
                                        <option value="275">275</option>
                                        <option value="278">278</option>
                                        <option value="279">279</option>
                                        <option value="280">280</option>
                                        <option value="283">283</option>
                                        <option value="286">286</option>
                                        <option value="291">291</option>
                                        <option value="295">295</option>
                                        <option value="298">298</option>
                                        <option value="299">299</option>
                                        <option value="300">300</option>
                                        <option value="307">307</option>
                                        <option value="308">308</option>
                                        <option value="309">309</option>
                                        <option value="310">310</option>
                                        <option value="311">311</option>
                                        <option value="315">315</option>
                                        <option value="319">319</option>
                                        <option value="320">320</option>
                                        <option value="321">321</option>
                                        <option value="323">323</option>
                                        <option value="331">331</option>
                                        <option value="335">335</option>
                                        <option value="340">340</option>
                                        <option value="350">350</option>
                                        <option value="352">352</option>
                                        <option value="355">355</option>
                                        <option value="360">360</option>
                                        <option value="370">370</option>
                                        <option value="371">371</option>
                                        <option value="375">375</option>
                                        <option value="380">380</option>
                                        <option value="385">385</option>
                                        <option value="387">387</option>
                                        <option value="393">393</option>
                                        <option value="395">395</option>
                                        <option value="400">400</option>
                                        <option value="401">401</option>
                                        <option value="403">403</option>
                                        <option value="410">410</option>
                                        <option value="415">415</option>
                                        <option value="419">419</option>
                                        <option value="420">420</option>
                                        <option value="425">425</option>
                                        <option value="429">429</option>
                                        <option value="435">435</option>
                                        <option value="440">440</option>
                                        <option value="445">445</option>
                                        <option value="453">453</option>
                                        <option value="455">455</option>
                                        <option value="460">460</option>
                                        <option value="470">470</option>
                                        <option value="480">480</option>
                                        <option value="488">488</option>
                                        <option value="490">490</option>
                                        <option value="491">491</option>
                                        <option value="500">500</option>
                                        <option value="514">514</option>
                                        <option value="515">515</option>
                                        <option value="530">530</option>
                                        <option value="540">540</option>
                                        <option value="545">545</option>
                                        <option value="555">555</option>
                                        <option value="560">560</option>
                                        <option value="570">570</option>
                                        <option value="575">575</option>
                                        <option value="580">580</option>
                                        <option value="595">595</option>
                                        <option value="600">600</option>
                                        <option value="605">605</option>
                                        <option value="620">620</option>
                                        <option value="635">635</option>
                                        <option value="640">640</option>
                                        <option value="645">645</option>
                                        <option value="650">650</option>
                                        <option value="665">665</option>
                                        <option value="675">675</option>
                                        <option value="697">697</option>
                                        <option value="700">700</option>
                                        <option value="710">710</option>
                                        <option value="715">715</option>
                                        <option value="725">725</option>
                                        <option value="730">730</option>
                                        <option value="750">750</option>
                                        <option value="761">761</option>
                                        <option value="765">765</option>
                                        <option value="780">780</option>
                                        <option value="785">785</option>
                                        <option value="800">800</option>
                                        <option value="805">805</option>
                                        <option value="810">810</option>
                                        <option value="815">815</option>
                                        <option value="825">825</option>
                                        <option value="850">850</option>
                                        <option value="865">865</option>
                                        <option value="875">875</option>
                                        <option value="880">880</option>
                                        <option value="885">885</option>
                                        <option value="897">897</option>
                                        <option value="900">900</option>
                                        <option value="910">910</option>
                                        <option value="920">920</option>
                                        <option value="930">930</option>
                                        <option value="945">945</option>
                                        <option value="950" selected="selected">950</option>
                                        <option value="955">955</option>
                                        <option value="965">965</option>
                                        <option value="970">970</option>
                                        <option value="987">987</option>
                                        <option value="995">995</option>
                                        <option value="1000">1000</option>
                                        <option value="1020">1020</option>
                                        <option value="1025">1025</option>
                                        <option value="1035">1035</option>
                                        <option value="1050">1050</option>
                                        <option value="1055">1055</option>
                                        <option value="1065">1065</option>
                                        <option value="1075">1075</option>
                                        <option value="1100">1100</option>
                                        <option value="1115">1115</option>
                                        <option value="1125">1125</option>
                                        <option value="1145">1145</option>
                                        <option value="1150">1150</option>
                                        <option value="1155">1155</option>
                                        <option value="1160">1160</option>
                                        <option value="1170">1170</option>
                                        <option value="1175">1175</option>
                                        <option value="1195">1195</option>
                                        <option value="1200">1200</option>
                                        <option value="1220">1220</option>
                                        <option value="1225">1225</option>
                                        <option value="1250">1250</option>
                                        <option value="1255">1255</option>
                                        <option value="1265">1265</option>
                                        <option value="1280">1280</option>
                                        <option value="1285">1285</option>
                                        <option value="1325">1325</option>
                                        <option value="1335">1335</option>
                                        <option value="1355">1355</option>
                                        <option value="1360">1360</option>
                                        <option value="1365">1365</option>
                                        <option value="1380">1380</option>
                                        <option value="1390">1390</option>
                                        <option value="1400">1400</option>
                                        <option value="1405">1405</option>
                                        <option value="1410">1410</option>
                                        <option value="1455">1455</option>
                                        <option value="1460">1460</option>
                                        <option value="1480">1480</option>
                                        <option value="1490">1490</option>
                                        <option value="1500">1500</option>
                                        <option value="1550">1550</option>
                                        <option value="1585">1585</option>
                                        <option value="1595">1595</option>
                                        <option value="1600">1600</option>
                                        <option value="1610">1610</option>
                                        <option value="1710">1710</option>
                                        <option value="1725">1725</option>
                                        <option value="1750">1750</option>
                                        <option value="1850">1850</option>
                                        <option value="1880">1880</option>
                                        <option value="2000">2000</option>
                                        <option value="2045">2045</option>
                                        <option value="2050">2050</option>
                                        <option value="2150">2150</option>
                                        <option value="2155">2155</option>
                                        <option value="2200">2200</option>
                                        <option value="2225">2225</option>
                                        <option value="2250">2250</option>
                                        <option value="2300">2300</option>
                                        <option value="2325">2325</option>
                                        <option value="2333">2333</option>
                                        <option value="2400">2400</option>
                                        <option value="2425">2425</option>
                                        <option value="2450">2450</option>
                                        <option value="2520">2520</option>
                                        <option value="2525">2525</option>
                                        <option value="2550">2550</option>
                                        <option value="2600">2600</option>
                                        <option value="2620">2620</option>
                                        <option value="2625">2625</option>
                                        <option value="2720">2720</option>
                                        <option value="2725">2725</option>
                                        <option value="2750">2750</option>
                                        <option value="2770">2770</option>
                                        <option value="2800">2800</option>
                                        <option value="2825">2825</option>
                                        <option value="2925">2925</option>
                                        <option value="2950">2950</option>
                                        <option value="3000">3000</option>
                                        <option value="3025">3025</option>
                                        <option value="3125">3125</option>
                                        <option value="3150">3150</option>
                                        <option value="3200">3200</option>
                                        <option value="3300">3300</option>
                                        <option value="3350">3350</option>
                                        <option value="3400">3400</option>
                                        <option value="3550">3550</option>
                                        <option value="3600">3600</option>
                                        <option value="3650">3650</option>
                                        <option value="3700">3700</option>
                                        <option value="3750">3750</option>
                                        <option value="3800">3800</option>
                                        <option value="3850">3850</option>
                                        <option value="3950">3950</option>
                                        <option value="4000">4000</option>
                                        <option value="4010">4010</option>
                                        <option value="4200">4200</option>
                                        <option value="4300">4300</option>
                                        <option value="4350">4350</option>
                                        <option value="4500">4500</option>
                                        <option value="4700">4700</option>
                                        <option value="4900">4900</option>
                                        <option value="5100">5100</option>
                                        <option value="5110">5110</option>
                                        <option value="0">AUTRES</option>
                                    </select>
                                </div>
                                <div class="form">
                                    <input type="text" name="autre_indice" class="form-control" id="autre_indice" style="display: none" data-original-title="" title="">
                                </div>
                                <div class="labelForm libele_form">
                                    <label class="control-label" data-original-title="" title=""><b>Date de prise de service</b></label>
                                </div>
                                <div class="form-group input-group form"  id="date_prise_service_div">
                                    <input type="text" id="date_prise_service" class="form-control" placeholder="Date de prise de service" data-placement="top" data-toggle="tooltip" data-original-title="Ampidiro ny  andro/volana/taona  nidiranao niasa teto amin’ny Ministeran’ny Fitantanambola sy ny Teti-bola" name="date_prise_service" value="18/04/2016" data-bv-field="date_prise_service">
                                    <span class="input-group-addon">  <span class="la la-calendar form-control-feedback"></span></span>
                                    <small class="help-block" data-bv-validator="notEmpty" data-bv-for="date_prise_service" data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez enter votre date du prise de service</small><small class="help-block" data-bv-validator="callback" data-bv-for="date_prise_service" data-bv-result="NOT_VALIDATED" style="display: none;">La Date de service doit être inférieur à la date de naissance</small>
                                </div>
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
                                            <tr>
                                                <td style="text-align:center;">J08A</td>
                                                <td style="text-align:center;">2C1E</td>
                                                <td style="text-align:center;">14/12/2011</td>
                                            </tr>
                                            <tr class="even">
                                                <td style="text-align:center;">J08A</td>
                                                <td style="text-align:center;">2C1E</td>
                                                <td style="text-align:center;">14/12/2012</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:center;">J08A</td>
                                                <td style="text-align:center;">2C2E</td>
                                                <td style="text-align:center;">14/12/2013</td>
                                            </tr>
                                            <tr class="even">
                                                <td style="text-align:center;">U08A</td>
                                                <td style="text-align:center;">2C2E</td>
                                                <td style="text-align:center;">14/12/2014</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:center;">U08A</td>
                                                <td style="text-align:center;">2C3E</td>
                                                <td style="text-align:center;">14/12/2015</td>
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
                                </div>
                                <!--<div class="row">
                                    <div class="col-xs-6 col-sm-12 col-md-4">
                                        a
                                    </div>
                                    <div class="col-xs-6 col-sm-12 col-md-4">
                                        a
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-xs-6 col-sm-12 col-md-2">
                                        a
                                    </div>
                                    <div class="col-xs-6 col-sm-12 col-md-4">
                                        a
                                    </div>
                                    <div class="col-xs-6 col-sm-12 col-md-4">
                                        a
                                    </div>
                                    <div class="col-xs-6 col-sm-12 col-md-2">
                                        a
                                    </div>
                                </div>-->
                                <table class="tableau" id="tableDiplome">
                                    <tbody>

                                    <tr id="diplome_row_1">
                                        <td><input class="form-control" placeholder="Diplomes" type="text" name="diplome_name[]" value="Ingénieur" data-toggle="tooltip" data-original-title="Soraty ny mari-pahaizana ambony azonao farany" data-bv-field="diplome_name[]"><i class="form-control-feedback" data-bv-icon-for="diplome_name[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_name[]" style="display: none; top: 0px;"></i></td>
                                        <td><input class="form-control" placeholder="Filière" type="text" name="diplome_discipline[]" value="Informatique" data-toggle="tooltip" data-original-title="Soraty ny sampam-pianarana" data-bv-field="diplome_discipline[]"><i class="form-control-feedback" data-bv-icon-for="diplome_discipline[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_discipline[]" style="display: none; top: 0px;"></i></td>
                                        <td><input class="form-control input_date" maxlength="4" id="diplome_date_1" onchange="testDate('1')" placeholder="Année d`obtention" type="text" name="diplome_date[]" value="2006" data-toggle="tooltip" data-original-title="Soraty ny taona nahazoanao ilay mari-pahaizana" data-bv-field="diplome_date[]"><i class="form-control-feedback" data-bv-icon-for="diplome_date[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_date[]" style="display: none; top: 0px;"></i></td>
                                        <td><input class="form-control " placeholder="Etablissement " type="text" name="diplome_etablissement[]" value="ISPM" data-toggle="tooltip" data-original-title="Soraty ny toeram-pianarana nahazoanao ilay mari-pahaizana" data-bv-field="diplome_etablissement[]"><i class="form-control-feedback" data-bv-icon-for="diplome_etablissement[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_etablissement[]" style="display: none; top: 0px;"></i></td>
                                        <td><input class="form-control" placeholder="Pays" type="text" name="diplome_pays[]" value="Madagascar" data-toggle="tooltip" data-original-title="Soraty ny anaran'ilay firenena nahazoanao ilay mari-pahaizana" data-bv-field="diplome_pays[]"><i class="form-control-feedback" data-bv-icon-for="diplome_pays[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_pays[]" style="display: none; top: 0px;"></i></td>

                                    </tr>
                                    <tr id="diplome_row_2">
                                        <td><input class="form-control" placeholder="Diplomes" type="text" name="diplome_name[]" value="Technicien Superieur" data-toggle="tooltip" data-original-title="Soraty ny mari-pahaizana ambony azonao farany" data-bv-field="diplome_name[]"><i class="form-control-feedback" data-bv-icon-for="diplome_name[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_name[]" style="display: none; top: 0px;"></i></td>
                                        <td><input class="form-control" placeholder="Filière" type="text" name="diplome_discipline[]" value="Informatique" data-toggle="tooltip" data-original-title="Soraty ny sampam-pianarana" data-bv-field="diplome_discipline[]"><i class="form-control-feedback" data-bv-icon-for="diplome_discipline[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_discipline[]" style="display: none; top: 0px;"></i></td>
                                        <td><input class="form-control input_date" maxlength="4" id="diplome_date_2" onchange="testDate('2')" placeholder="Année d`obtention" type="text" name="diplome_date[]" value="2003" data-toggle="tooltip" data-original-title="Soraty ny taona nahazoanao ilay mari-pahaizana" data-bv-field="diplome_date[]"><i class="form-control-feedback" data-bv-icon-for="diplome_date[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_date[]" style="display: none; top: 0px;"></i></td>
                                        <td><input class="form-control " placeholder="Etablissement " type="text" name="diplome_etablissement[]" value="ISPM" data-toggle="tooltip" data-original-title="Soraty ny toeram-pianarana nahazoanao ilay mari-pahaizana" data-bv-field="diplome_etablissement[]"><i class="form-control-feedback" data-bv-icon-for="diplome_etablissement[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_etablissement[]" style="display: none; top: 0px;"></i></td>
                                        <td><input class="form-control" placeholder="Pays" type="text" name="diplome_pays[]" value="Madagascar" data-toggle="tooltip" data-original-title="Soraty ny anaran'ilay firenena nahazoanao ilay mari-pahaizana" data-bv-field="diplome_pays[]"><i class="form-control-feedback" data-bv-icon-for="diplome_pays[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_pays[]" style="display: none; top: 0px;"></i></td>

                                        <td style="width:15px!important"><button class="btn_close" type="button" onclick="deleteDiplome(2)" data-original-title="" title=""><i class="la la-minus-circle"></i></button></td>
                                    </tr>
                                    <tr id="diplome_row_3">
                                        <td><input class="form-control" placeholder="Diplomes" type="text" name="diplome_name[]" value="Bacc" data-toggle="tooltip" data-original-title="Soraty ny mari-pahaizana ambony azonao farany" data-bv-field="diplome_name[]"><i class="form-control-feedback" data-bv-icon-for="diplome_name[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_name[]" style="display: none; top: 0px;"></i></td>
                                        <td><input class="form-control" placeholder="Filière" type="text" name="diplome_discipline[]" value="Serie D" data-toggle="tooltip" data-original-title="Soraty ny sampam-pianarana" data-bv-field="diplome_discipline[]"><i class="form-control-feedback" data-bv-icon-for="diplome_discipline[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_discipline[]" style="display: none; top: 0px;"></i></td>
                                        <td><input class="form-control input_date" maxlength="4" id="diplome_date_3" onchange="testDate('3')" placeholder="Année d`obtention" type="text" name="diplome_date[]" value="2000" data-toggle="tooltip" data-original-title="Soraty ny taona nahazoanao ilay mari-pahaizana" data-bv-field="diplome_date[]"><i class="form-control-feedback" data-bv-icon-for="diplome_date[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_date[]" style="display: none; top: 0px;"></i></td>
                                        <td><input class="form-control " placeholder="Etablissement " type="text" name="diplome_etablissement[]" value="CST Toliara" data-toggle="tooltip" data-original-title="Soraty ny toeram-pianarana nahazoanao ilay mari-pahaizana" data-bv-field="diplome_etablissement[]"><i class="form-control-feedback" data-bv-icon-for="diplome_etablissement[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_etablissement[]" style="display: none; top: 0px;"></i></td>
                                        <td><input class="form-control" placeholder="Pays" type="text" name="diplome_pays[]" value="Madagascar" data-toggle="tooltip" data-original-title="Soraty ny anaran'ilay firenena nahazoanao ilay mari-pahaizana" data-bv-field="diplome_pays[]"><i class="form-control-feedback" data-bv-icon-for="diplome_pays[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_pays[]" style="display: none; top: 0px;"></i></td>

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
                                    <textarea name="domaine" id="domaine" class="form-control" rows="5" data-toggle="tooltip" data-original-title="Soraty ireo karazana traikefa hafa voafehinao" data-bv-field="domaine">Informaticien Développeur</textarea><i class="form-control-feedback" data-bv-icon-for="domaine" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="domaine" style="display: none; top: 0px;"></i>
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
                                    <textarea name="autre_domaine" id="autre_domaine" class="form-control" rows="5" data-toggle="tooltip" data-original-title="Soraty  raha manana traikela lanampiny ianao">permis de conduire B, C, D</textarea>
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
                                    <input type="text" class="form-control" placeholder="Poste" name="poste" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny asa amandrarahanao" id="poste" value="Développeur " data-bv-field="poste"><i class="form-control-feedback" data-bv-icon-for="poste" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="poste" style="display: none; top: 0px;"></i>
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
                                        <option value="2" selected="selected">Madagascar</option>
                                        <option value="3">Afghanistan</option>
                                        <option value="4">Afrique du Sud</option>
                                        <option value="5">Albanie</option>
                                        <option value="6">Algérie</option>
                                        <option value="7">Allemagne</option>
                                        <option value="8">Andorre</option>
                                        <option value="9">Angola</option>
                                        <option value="10">Antigua-et-Barbuda</option>
                                        <option value="11">Arabie saoudite</option>
                                        <option value="12">Argentine</option>
                                        <option value="13">Arménie</option>
                                        <option value="14">Australie</option>
                                        <option value="15">Autriche</option>
                                        <option value="16">Azerbaïdjan</option>
                                        <option value="17">Bahamas</option>
                                        <option value="18">Bahreïn</option>
                                        <option value="19">Bangladesh</option>
                                        <option value="20">Barbade</option>
                                        <option value="21">Belgique</option>
                                        <option value="22">Belize</option>
                                        <option value="23">Bénin</option>
                                        <option value="24">Bhoutan</option>
                                        <option value="25">Biélorussie</option>
                                        <option value="26">Bolivie</option>
                                        <option value="27">Bosnie-Herzégovine</option>
                                        <option value="28">Botswana</option>
                                        <option value="29">Brésil</option>
                                        <option value="30">Brunei</option>
                                        <option value="31">Bulgarie</option>
                                        <option value="32">Burkina Faso</option>
                                        <option value="33">Burundi</option>
                                        <option value="34">Cambodge</option>
                                        <option value="35">Cameroun</option>
                                        <option value="36">Canada</option>
                                        <option value="37">Cap-Vert</option>
                                        <option value="38">Centrafrique</option>
                                        <option value="39">Chili</option>
                                        <option value="40">Chine</option>
                                        <option value="41">Chypre</option>
                                        <option value="42">Colombie</option>
                                        <option value="43">Comores</option>
                                        <option value="44">Congo-Brazzaville</option>
                                        <option value="45">Corée du Nord</option>
                                        <option value="46">Corée du Sud</option>
                                        <option value="47">Costa Rica</option>
                                        <option value="48">Côte d'Ivoire</option>
                                        <option value="49">Croatie</option>
                                        <option value="50">Cuba</option>
                                        <option value="51">Danemark</option>
                                        <option value="52">Djibouti</option>
                                        <option value="53">Dominique</option>
                                        <option value="54">Égypte</option>
                                        <option value="55">Émirats arabes unis</option>
                                        <option value="56">Équateur</option>
                                        <option value="57">Érythrée</option>
                                        <option value="58">Espagne</option>
                                        <option value="59">Estonie</option>
                                        <option value="60">États-Unis</option>
                                        <option value="61">Éthiopie</option>
                                        <option value="62">Fidji</option>
                                        <option value="63">Finlande</option>
                                        <option value="64">France</option>
                                        <option value="65">Gabon</option>
                                        <option value="66">Gambie</option>
                                        <option value="67">Géorgie</option>
                                        <option value="68">Ghana</option>
                                        <option value="69">Grèce</option>
                                        <option value="70">Grenade</option>
                                        <option value="71">Guatemala</option>
                                        <option value="72">Guinée</option>
                                        <option value="73">Guinée équatoriale</option>
                                        <option value="74">Guinée-Bissau</option>
                                        <option value="75">Guyana</option>
                                        <option value="76">Haïti</option>
                                        <option value="77">Honduras</option>
                                        <option value="78">Hongrie</option>
                                        <option value="79">Îles Cook</option>
                                        <option value="80">Îles Marshall</option>
                                        <option value="81">Inde</option>
                                        <option value="82">Indonésie</option>
                                        <option value="83">Irak</option>
                                        <option value="84">Iran</option>
                                        <option value="85">Irlande</option>
                                        <option value="86">Islande</option>
                                        <option value="87">Israël</option>
                                        <option value="88">Italie</option>
                                        <option value="89">Jamaïque</option>
                                        <option value="90">Japon</option>
                                        <option value="91">Jordanie</option>
                                        <option value="92">Kazakhstan</option>
                                        <option value="93">Kenya</option>
                                        <option value="94">Kirghizistan</option>
                                        <option value="95">Kiribati</option>
                                        <option value="96">Koweït</option>
                                        <option value="97">Laos</option>
                                        <option value="98">Lesotho</option>
                                        <option value="99">Lettonie</option>
                                        <option value="100">Liban</option>
                                        <option value="101">Libéria</option>
                                        <option value="102">Libye</option>
                                        <option value="103">Liechtenstein</option>
                                        <option value="104">Lituanie</option>
                                        <option value="105">Luxembourg</option>
                                        <option value="106">Macédoine</option>
                                        <option value="107">Malaisie</option>
                                        <option value="108">Malawi</option>
                                        <option value="109">Maldives</option>
                                        <option value="110">Mali</option>
                                        <option value="111">Malte</option>
                                        <option value="112">Maroc</option>
                                        <option value="113">Maurice</option>
                                        <option value="114">Mauritanie</option>
                                        <option value="115">Mexique</option>
                                        <option value="116">Micronésie</option>
                                        <option value="117">Moldavie</option>
                                        <option value="118">Monaco</option>
                                        <option value="119">Mongolie</option>
                                        <option value="120">Monténégro</option>
                                        <option value="121">Mozambique</option>
                                        <option value="122">Myanmar</option>
                                        <option value="123">Namibie</option>
                                        <option value="124">Nauru</option>
                                        <option value="125">Nicaragua</option>
                                        <option value="126">Niger</option>
                                        <option value="127">Nigeria</option>
                                        <option value="128">Niue</option>
                                        <option value="129">Norvège</option>
                                        <option value="130">Nouvelle-Zélande</option>
                                        <option value="131">Oman</option>
                                        <option value="132">Ouganda</option>
                                        <option value="133">Ouzbékistan</option>
                                        <option value="134">Pakistan</option>
                                        <option value="135">Palaos</option>
                                        <option value="136">Palestine</option>
                                        <option value="137">Panamá</option>
                                        <option value="138">Papouasie-Nouvelle-Guinée</option>
                                        <option value="139">Paraguay</option>
                                        <option value="140">Pays-Bas</option>
                                        <option value="141">Pérou</option>
                                        <option value="142">Philippines</option>
                                        <option value="143">Pologne</option>
                                        <option value="144">Portugal</option>
                                        <option value="145">Qatar</option>
                                        <option value="146">République démocratique du Congo</option>
                                        <option value="147">République dominicaine</option>
                                        <option value="148">République populaire de Chine</option>
                                        <option value="149">République tchèque</option>
                                        <option value="150">Roumanie</option>
                                        <option value="151">Royaume-Uni</option>
                                        <option value="152">Russie</option>
                                        <option value="153">Rwanda</option>
                                        <option value="154">Saint-Christophe-et-Niévès</option>
                                        <option value="155">Sainte-Lucie</option>
                                        <option value="156">Saint-Marin</option>
                                        <option value="157">Saint-Vincent-et-les-Grenadines</option>
                                        <option value="158">Salomon</option>
                                        <option value="159">Salvador</option>
                                        <option value="160">Samoa</option>
                                        <option value="161">São Tomé-et-Principe</option>
                                        <option value="162">Sénégal</option>
                                        <option value="163">Serbie</option>
                                        <option value="164">Seychelles</option>
                                        <option value="165">Sierra Leone</option>
                                        <option value="166">Singapour</option>
                                        <option value="167">Slovaquie</option>
                                        <option value="168">Slovénie</option>
                                        <option value="169">Somalie</option>
                                        <option value="170">Soudan</option>
                                        <option value="171">Sri Lanka</option>
                                        <option value="172">Suède</option>
                                        <option value="173">Suisse</option>
                                        <option value="174">Suriname</option>
                                        <option value="175">Swaziland</option>
                                        <option value="176">Syrie</option>
                                        <option value="177">Tadjikistan</option>
                                        <option value="178">Tanzanie</option>
                                        <option value="179">Tchad</option>
                                        <option value="180">Thaïlande</option>
                                        <option value="181">Timor oriental</option>
                                        <option value="182">Togo</option>
                                        <option value="183">Tonga</option>
                                        <option value="184">Trinité-et-Tobago</option>
                                        <option value="185">Tunisie</option>
                                        <option value="186">Turkménistan</option>
                                        <option value="187">Turquie</option>
                                        <option value="188">Tuvalu</option>
                                        <option value="189">Ukraine</option>
                                        <option value="190">Uruguay</option>
                                        <option value="191">Vanuatu</option>
                                        <option value="192">Vatican</option>
                                        <option value="193">Venezuela</option>
                                        <option value="194">Vietnam</option>
                                        <option value="195">Yémen</option>
                                        <option value="196">Zambie</option>
                                        <option value="197">Zimbabwe</option>
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
                                        <option value="74">Ambalavao</option>
                                        <option value="4">Ambanja</option>
                                        <option value="40">Ambato Boeny</option>
                                        <option value="70">Ambatofinandrahana</option>
                                        <option value="23">Ambatolampy</option>
                                        <option value="49">Ambatomainty</option>
                                        <option value="50">Ambatondrazaka</option>
                                        <option value="3">Ambilobe</option>
                                        <option value="109">Amboasary Atsimo</option>
                                        <option value="16">Ambohidratrimo</option>
                                        <option value="75">Ambohimahasoa</option>
                                        <option value="68">Ambositra</option>
                                        <option value="104">Ambovombe Androy</option>
                                        <option value="102">Ampanihy</option>
                                        <option value="53">Amparafaravola</option>
                                        <option value="34">Analalava</option>
                                        <option value="9">Andapa</option>
                                        <option value="54">Andilamena</option>
                                        <option value="18">Andramasina</option>
                                        <option value="20">Anjozorobe</option>
                                        <option value="99">Ankazoabo</option>
                                        <option value="17">Ankazobe</option>
                                        <option value="52">Anosibe An'ala</option>
                                        <option value="8">Antalaha</option>
                                        <option value="60">Antanambao Manampotsy</option>
                                        <option value="15">Antananarivo Avaradrano</option>
                                        <option value="13" selected="selected">Antananarivo Renivohitra</option>
                                        <option value="14">Antananarivo&nbsp;Atsimondrano</option>
                                        <option value="25">antanifotsy</option>
                                        <option value="46">Antsalova</option>
                                        <option value="21">Antsirabe I</option>
                                        <option value="22">Antsirabe II</option>
                                        <option value="1">Antsiranana I</option>
                                        <option value="2">Antsiranana II</option>
                                        <option value="29">Antsohihy</option>
                                        <option value="12">Arivonimamo</option>
                                        <option value="30">Bealanana</option>
                                        <option value="35">Befandriana Nord</option>
                                        <option value="85">Befotaka</option>
                                        <option value="105">Bekily</option>
                                        <option value="93">Belo Tsiribihina</option>
                                        <option value="106">Beloha</option>
                                        <option value="103">Benenitra</option>
                                        <option value="100">Beroroha</option>
                                        <option value="48">Besalampy</option>
                                        <option value="24">Betafo</option>
                                        <option value="101">Betioky</option>
                                        <option value="110">Betroka</option>
                                        <option value="57">Brickaville</option>
                                        <option value="71">Fandriana</option>
                                        <option value="83">Farafangana</option>
                                        <option value="26">Faratsiho</option>
                                        <option value="62">Fénérive Est</option>
                                        <option value="28">Fenoarivo Be</option>
                                        <option value="72">Fianarantsoa I</option>
                                        <option value="73">Fianarantsoa II</option>
                                        <option value="89">Iakora</option>
                                        <option value="82">Ifanadiana</option>
                                        <option value="87">Ihosy</option>
                                        <option value="76">Ikalamavony</option>
                                        <option value="81">Ikongo</option>
                                        <option value="88">Ivohibe</option>
                                        <option value="43">Kandreho</option>
                                        <option value="42">Maevatanana</option>
                                        <option value="92">Mahabo</option>
                                        <option value="36">Mahajanga I</option>
                                        <option value="37">Mahajanga II&nbsp;</option>
                                        <option value="59">Mahanoro</option>
                                        <option value="94">Maindrivazo</option>
                                        <option value="45">Maintirano</option>
                                        <option value="32">Mampikony</option>
                                        <option value="77">Manakara&nbsp;</option>
                                        <option value="66">Mananara</option>
                                        <option value="69">Manandriana</option>
                                        <option value="79">Mananjary</option>
                                        <option value="31">Mandritsara</option>
                                        <option value="91">Manja</option>
                                        <option value="19">Manjakandriana</option>
                                        <option value="67">Maroantsetra</option>
                                        <option value="61">Marolambo</option>
                                        <option value="41">Marovoay</option>
                                        <option value="10">Miarinarivo</option>
                                        <option value="86">Midongy Atsimo</option>
                                        <option value="38">Mitsinjo</option>
                                        <option value="47">Morafeno Be</option>
                                        <option value="51">Moramanga</option>
                                        <option value="97">Morombe</option>
                                        <option value="90">Morondava</option>
                                        <option value="5">Nosy BE</option>
                                        <option value="80">Nosy Varika</option>
                                        <option value="33">Port Bergé</option>
                                        <option value="65">Sainte Marie</option>
                                        <option value="98">Sakaraha</option>
                                        <option value="6">Sambava</option>
                                        <option value="39">Soalala</option>
                                        <option value="64">Soanierana Ivongo</option>
                                        <option value="11">Soavinandriana</option>
                                        <option value="108">Taolagnaro</option>
                                        <option value="55">Toamasina I</option>
                                        <option value="56">Toamasina II</option>
                                        <option value="95">Toliara I</option>
                                        <option value="96">Toliara II</option>
                                        <option value="44">Tsaratanana</option>
                                        <option value="107">Tsihombe</option>
                                        <option value="27">Tsiroanomandidy</option>
                                        <option value="111">Vangaindrano</option>
                                        <option value="58">Vatomandry</option>
                                        <option value="63">Vavatenina</option>
                                        <option value="7">Vohémar</option>
                                        <option value="78">Vohipeno</option>
                                        <option value="84">vondrozo</option>
                                    </select><i class="form-control-feedback" data-bv-icon-for="district" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="district" style="display: none; top: 0px;"></i>
                                    <small class="help-block" data-bv-validator="greaterThan" data-bv-for="district" data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez Sélectionner votre District</small></div>
                                <div class="libele_form">
                                    <label class="control-label" data-original-title="" title=""><b>Département</b>  </label><b><font color="red"> * </font></b>
                                </div>
                                <div class="form">
                                    <select class="form-control" placeholder="Departement" name="departement" data-toggle="tooltip" data-original-title="Safidio ny Departemanta na sampan-draharaha misy anao" id="departement" data-bv-field="departement">
                                        <option value="0">-------</option>
                                        <option value="1">CABINET</option>
                                        <option value="2" selected="selected">SECRETARIAT GENERAL</option>
                                        <option value="3">DIRECTION GENERALE DU BUDGET</option>
                                        <option value="4">DIRECTION GENERALE DE LA GESTION FINANCIERE DU PERSONNEL DE L'ETAT</option>
                                        <option value="5">DIRECTION GENERALE DES DOUANES</option>
                                        <option value="6">DIRECTION GENERALE DES IMPOTS</option>
                                        <option value="7">DIRECTION GENERALE DU TRESOR</option>
                                        <option value="8">CONSEIL SUPERIEUR DE LA COMPTABILITE</option>
                                        <option value="9">DIRECTION GENERALE DE L'AUDIT INTERNE</option>
                                        <option value="10">DIRECTION GENERALE DU CONTROLE FINANCIER</option>
                                        <option value="11">DIRECTION GENERALE DE L'AUTORITE DE REGULATION DES MARCHES PUBLICS</option>
                                        <option value="12">CELLULE DE COORDINATION DES PROJETS DE RELANCE ECONOMIQUE ET D'ACTIONS SOCIALES</option>
                                        <option value="13">AGENCE DE MICROREALISATION ET DE LA COOPERATION DECENTRALISEE</option>
                                    </select><i class="form-control-feedback" data-bv-icon-for="departement" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="departement" style="display: none; top: 0px;"></i>
                                    <small class="help-block" data-bv-validator="greaterThan" data-bv-for="departement" data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez Sélectionner votre Departement</small></div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b> Direction</b> </label><b></b>
                                </div>
                                <div class="form">
                                    <select class="form-control" placeholder="Direction" name="direction" data-toggle="tooltip" data-original-title="Safidio ny Foibem-pitondrana misy anao " id="direction">
                                        <option value="0">-------</option>
                                        <option value="1">SECRETARIAT GENERAL</option>
                                        <option value="2">BUREAU D'APPUI AU SECRETAIRE GENERAL</option>
                                        <option value="3" selected="selected">DIRECTION DES RESSOURCES HUMAINES ET DE L'APPUI</option>
                                        <option value="4">DIRECTION DES AFFAIRES ADMINISTRATIVES ET FINANCIERES</option>
                                        <option value="5">DIRECTION DES SYSTEMES D'INFORMATION</option>
                                        <option value="6">DIRECTION DU RENFORCEMENT DE LA GOUVERNANCE</option>
                                        <option value="7">DIRECTION DE LA PROMOTION DU PARTENARIAT PUBLIC PRIVE</option>
                                        <option value="8">DIRECTION DE L'IMPRIMERIE NATIONALE</option>
                                        <option value="14">DIRECTION DE LA TUTELLE ET DU CONTROLE DES ETABLISSEMENTS PUBLICS NATIONAUX</option>
                                        <option value="134">DIRECTION DE LA COORDINATION INTERNE </option>

                                    </select>
                                </div>
                                <div class="libele_form">
                                    <label class="control-label" data-original-title="" title=""><b> Service</b> </label>
                                </div>
                                <div class="form">
                                    <select class="form-control" placeholder="Service" name="service" data-toggle="tooltip" data-original-title="Safidio  ny sampan-draharaha  misy anao " id="service">
                                        <option value="0">-------</option>
                                        <option value="2">SERVICE DE LA FORMATION ET DE L'APPUI OPERATIONNEL</option>
                                        <option value="3">SERVICE DES ARCHIVES ET DE LA DOCUMENTATION</option>
                                        <option value="4">SERVICE DE LA GESTION DES RESSOURCES HUMAINES</option>
                                        <option value="5">SERVICE D'ACCUEIL DES USAGERS</option>
                                        <option value="163" selected="selected">DIRECTION DES RESSOURCES HUMAINES ET DE L'APPUI</option>
                                    </select>
                                </div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b> SOA</b> </label>
                                </div>
                                <div id="div_soa">
                                    SOA DEPENSES : 00-21-0-130-00000
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
                                    <input type="text" class="form-control" placeholder="Porte" name="porte" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny varavarana ny toeram-piasanao" id="porte" value="356" data-bv-field="porte"><i class="form-control-feedback" data-bv-icon-for="porte" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="porte" style="display: none; top: 0px;"></i>
                                    <small class="help-block" data-bv-validator="notEmpty" data-bv-for="porte" data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez remplir votre porte ou code porte</small></div>
                                <div class="aide"> <u>Exemple </u>:
                                    P15 / BOX2
                                </div>
                                <div class="libele_form">
                                    <label class="control-label " data-original-title="" title=""><b>Lieu de travail</b> <b><font color="red"> * </font></b> </label>
                                </div>
                                <div class="form">
                                    <input type="text" class="form-control" placeholder="Lieu de travail" name="lacalite_service" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny toeram-piasanao" id="lacalite_service" value="Immeuble Finances Antaninarenina" data-bv-field="lacalite_service"><i class="form-control-feedback" data-bv-icon-for="lacalite_service" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="lacalite_service" style="display: none; top: 0px;"></i>
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