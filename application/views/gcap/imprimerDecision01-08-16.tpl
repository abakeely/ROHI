<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" name="viewport"/>
    <title>ROHI - demande {$oData.zTitre}</title>
    <link rel="stylesheet" type="text/css" href="{$oData.zBasePath}assets/gcap/css/app/print.css">
</head>
<body>
	<table width="100%" border="1">
	<td width="28%" style="text-align:right;vertical-align:bottom"><img src="{$oData.zBasePath}assets/gcap/images/def3.jpg" style="height:80%" class="logo"></td>
	<td style="vertical-align:top;">
		<p class="rm">
			<span class="top">Repoblikan'i Madagasikara</span><br>
			<span class="bottom">Fitiavana - Tanindrazana - Fandrosoana</span>
		</p>
	</td>
	<td width="28%" style="text-align:right;vertical-align:bottom"></td>
	</table>
    <div class="row clearfix">
        <div class="col dec">
				<p class="rm">
						<div class="left">
							<p class="ent">
								Ministère des finances et du budget<br>
								{$oData.sigleLong}
							</p>
						</div>
						<div class="right">
							
						</div>
				</p>
        </div>
    </div>
	<p class="prt" style="text-align:right;margin-right:340px;">Decision n° {if $oData.oDecision.decision_numero != 0}{$oData.oDecision.decision_numero}{else}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{/if} MFB{if $oData.sigle!=""}/{/if}{$oData.sigle} {if $oData.oDecision.decision_numero != 0}du {$oData.oDecision.decision_dateValidation|date_format|utf8}{/if}</p>
    <p class="prt">Portant: <span>Octroi d'{$oData.oDecision.type_libelleImpression|lower}&nbsp;au titre de l'ann&eacute;e&nbsp;{$oData.oDecision.decision_annee}</span></p>
    <div class="inner">
        <p><strong>Matricule</strong>: {$oData.oCandidat.matricule}</p>
        <p><strong>Nom et Prénoms</strong>: {$oData.oCandidat.nom}&nbsp;{$oData.oCandidat.prenom}</p>
        <br>
        <table class="geCon">
            <thead>
                <tr>
                    <th>Ancienne Position</th>
                    <th>Nouvelle Position</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Budget: <strong>GENERAL</strong><br>
                        Imputation budgetaire: 
						{$oData.zChapitre}<br>
                        Grade ou emploi: <strong>{$oData.oCandidat.grade}</strong><br>
                        Indice: <strong>{$oData.oCandidat.indice}</strong>
                    </td>
                    <td class="center middle">
                        <strong>SANS CHANGEMENT</strong>  
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>{if $oData.oService.libele!= ''}en service auprès de la {$oData.oService.libele}{/if}</strong>
                    </td>
                    <td>Obtient {$oData.oDecision.type_libelleImpression|lower} de : {$oData.oDecision.decision_nbrJour}&nbsp;jour{if $oData.oDecision.decision_nbrJour > 1}s{/if}&nbsp;&nbsp;au titre de l'ann&eacute;e&nbsp;{$oData.oDecision.decision_annee}</td>
                </tr>
            </tbody>
        </table>
        <div class="row clearfix">
            <div class="col end">
                <div>
                    <p>
                        <strong>A completer par les services, district ou l'interessé</strong><br>
                        Date de notification: <br>
                        Date de départ: <br>
                        Date d'arrivée: <br>
                        Date de prise de service: <br>
                        Date: 
                    </p>
                </div>
                <div>
                    <p class="center">
                        <strong>Ampliation</strong><br>
                        Antananarivo, le {if $oData.oDecision.decision_numero != 0}{else}{$oData.toDay|date_format}{/if}
                    </p>
                </div>
                <div class="last">
                    <p class="center"><strong>Sigrnature de: {if $oData.oCandidat.id != $oData.oSignataire.0->id}{if $oData.oSignataire.0->nom != ""}{$oData.oSignataire.0->nom}&nbsp;{$oData.oSignataire.0->prenom}{/if}{/if}</strong></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>