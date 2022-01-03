<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" name="viewport"/>
    <title>ROHI - ETAT {$oData.zLibelle}</title>
    <link rel="stylesheet" type="text/css" href="{$oData.zBasePath}assets/gcap/css/app/print.css">
</head>
<body>
    <h1>
        RECOMMANDATIONS EN DATE DU {$oData.date|date_format:"%d.%m.%Y"}<br>
        <span>Gestion des Carrières et Abscences du Personnel</span>
    </h1>
    <h2>MODELE D'ETAT {$oData.zPrefixe}&nbsp;{$oData.zTitre}</h2>
	<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a style="text-decoration:none;" href="{$zBasePath}">Accueil</a> <span>&gt;</span> Communiqué</div>
    <div class="row clearfix">
        <div class="col profil clearfix">
            <div class="left">
                <p class="photo"><img src="{$oData.zBasePath}assets/upload/{$oData.oCandidat.id}.{$oData.oCandidat.type_photo}"/></p>
            </div>
            <div class="right">
                <p><strong>Nom :</strong>&nbsp;{$oData.oCandidat.nom}</p>
                <p><strong>Prénoms :</strong>&nbsp;{$oData.oCandidat.prenom}</p>
                <p><strong>IM :&nbsp;{$oData.oCandidat.matricule}</strong></p>
                <p><strong>Indice :</strong>&nbsp;{$oData.oCandidat.indice}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Corps :</strong>&nbsp;{$oData.oCandidat.corps}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Grade :</strong>&nbsp;{$oData.oCandidat.grade}</p>
                <p><strong>Date de prise de service :</strong>&nbsp;{$oData.oCandidat.date_prise_service|date_format:"%d/%m/%Y"}</p>
                <p>{if $oData.oService.libele != ''}<strong>Service :</strong>&nbsp;{$oData.oService.libele}{/if}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{if $oData.oService.porte != ''}<strong>Porte :</strong>: &nbsp;{$oData.oService.porte}{/if}</p>
            </div>
        </div>
    </div>
    <div class="inner">
        <!--<p><strong>Nombre de décisions en possession :</strong></p>
        <p><strong>Nombre total de jours accordé :</strong></p>
        <p><strong>Nombre de jours disponible :</strong></p>-->
        <br>
        <br>
        <p class="center"><strong>DETAILS DE DEPART EN {$oData.zTitre}</strong></p>
        <table class="depCon">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Réference de la Décision</th>
					<th>type</th>
                    <th>Nb jours pris</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                </tr>
            </thead>
            <tbody>
                {assign var=iIncrement value="1"}
				{if sizeof($oData.oListe)>0}
				{foreach from=$oData.oListe item=oListeGcap }
				<tr>
                    <td>{$iIncrement}</td>
                    <td>N&deg;&nbsp;{$oListeGcap.sigle} du {$oListeGcap.gcap_dateValidation|date_format:"%d/%m/%Y"}</td>
					<th>{$oListeGcap.type_libelle}</th>
                    <td>{$oListeGcap.NombreJour}</td>
                    <td>{$oListeGcap.gcap_dateDebut|date_format:"%d/%m/%Y"}</td>
                    <td>{$oListeGcap.gcap_dateFin|date_format:"%d/%m/%Y"}</td>
                </tr>
                {assign var=iIncrement value=$iIncrement+1}
				{/foreach}
				{else}
				<tr><td style="text-align:center;" colspan="7">{$oData.zMessageAucun}</td></tr>
				{/if}
            </tbody>
        </table>
    </div>
</body>
</html>