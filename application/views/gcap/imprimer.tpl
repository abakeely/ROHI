<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" name="viewport"/>
    <title>ROHI - DEMANDE {$oData.zTitre}</title>
    <link rel="stylesheet" type="text/css" href="{$oData.zBasePath}assets/gcap/css/app/print.css">
</head>
<body>
    <div class="row clearfix nrml">
        <div class="col dec inPage">
            <div class="left">
                <p>&nbsp;</p>
                <p class="std txtRight">Antananarivo le, <em>{$oData.toDay|date_format|utf8}</em></p>
                <br><br><br>
                <p class="std txtRight ent"><strong>DEMANDE {$oData.zTitre}</strong></p>
                <br><br><br><br><br><br>
                <p class="std">
                    <strong>Nom et Pr&eacute;noms</strong>: {$oData.oCandidat.nom}&nbsp;{$oData.oCandidat.prenom}<br>
                    <strong>Fonction</strong>: {$oData.oCandidat.poste}<br>
                    <strong>IM</strong>: {$oData.oCandidat.matricule}<br>
                    {if $oData.oCandidat.corps != 0}<strong>Corps</strong>: {$oData.oCandidat.corps}<br>{/if}
                    {if $oData.oCandidat.grade != 0}<strong>Grade</strong>: {$oData.oCandidat.grade}<br>{/if}
                    <strong>Service ou Division</strong>: {$oData.oService.libele}<br>
                    <strong>Sollicite {$oData.zTitre1} de</strong>: {$oData.iNombreConge} jour{if $oData.iNombreConge >1}s{/if} ( au titre {if $oData.iSizeDataListeFraction > 1} des ann&eacute;es{else} de l'ann&eacute;e{/if}
					{assign var=iIncrement value="0"}
					{foreach from=$oData.toDataListeFraction item=oListe }
					{if $iIncrement > 0},{/if}
					{$oListe.decision_annee}
					{assign var=iIncrement value=$iIncrement+1}
					{/foreach}
					reste {$oData.iResteConge} jour{if $oData.iResteConge >1}s{/if}&nbsp;{$oData.zSupplementaire})<br>
                    <strong>A compter du</strong>: <em>{$oData.oGcap.gcap_dateDebut|date_format:"%d/%m/%Y"}</em> au <em>{$oData.oGcap.gcap_dateFin|date_format:"%d/%m/%Y"}</em><br>
					<strong>Motif : </strong> {$oData.oGcap.motif_libelle}<br>
					<strong>Lieu de jouissance :</strong> {$oData.oGcap.gcap_lieuJouissance}<br>
					A d&eacute;falquer sur {if $oData.iSizeDataListeFraction > 1}les{else}la{/if} D&eacute;cision{if $oData.iSizeDataListeFraction > 1}s{/if} : <br>
					{assign var=iIncrement value="0"}
					{foreach from=$oData.toDataListeFraction item=oListe }
					 - N&deg; {if $oListe.decision_numero != 0}{$oListe.decision_numero}/MFB{if $oData.sigle!=""}/{/if}{$oData.sigle}{/if} au titre de l'ann&eacute;e {$oListe.decision_annee} (reste {$oListe.reste} jour{if $oListe.reste >1}s{/if})<br>
					{assign var=iIncrement value=$iIncrement+1}
					{/foreach}
                </p>
                <br><br>    
            </div>
            <div class="right dashed" >
                
				<table width="100%">
				<td width="30%" style="vertical-align:bottom"><img src="{$oData.zBasePath}assets/gcap/images/def3.jpg" width="85" class="logo"></td>
				<td style="vertical-align:top;">
				<p>&nbsp;</p>
				<p class="rm">
				<span class="top">Repoblikan'i Madagasikara</span><br>
				<span class="bottom">Fitiavana - Tanindrazana - Fandrosoana</span></td>
				</p>
				<td width="25%" style="text-align:right;vertical-align:bottom;width:32%">{if $oData.getLogo != ""}<img width="70" src="{$oData.zBasePath}assets/upload/logo/{$oData.getLogo}" class="logo">{/if}</td>
				</table>
                
                <div class="row clearfix">
                    <div class="col dec">
                        <div class="left">
                            <p class="ent">
                                Minist&egrave;re des finances et du budget<br>
                                {$oData.sigleLong}
                            </p>
                        </div>
                        <div class="right">
							{if $oData.iTypeGcapId == CONGE}
                            <p class="ent" style="text-align:justify;padding-left:45%;">
                                <br><br><br>
								&nbsp;&nbsp;Attestation de<br>
                                d&eacute;part en {$oData.zTitre2}
                            </p>
							{elseif $oData.iTypeGcapId == AUTORISATION_ABSENCE}
							<p class="ent" style="padding-left:30%;">
								<br>
								&nbsp;&nbsp;Attestation de<br>
                                d&eacute;part en<br> {$oData.zTitre2}
							</p>
							{else}
							<p class="ent" style="padding-left:45%;">
                                <br><br>
								&nbsp;&nbsp;Attestation de<br>
                                d&eacute;part en {$oData.zTitre2}
							</p>
							{/if}
                        </div>
                    </div>
                </div>
                <p class="std">
                    <strong>N&deg;: {$oData.iNumId}/MFB{if $oData.sigle!=""}/{/if}{$oData.sigle}</strong><br>
					Je, soussign&eacute;, atteste que: <br>
					<strong>Nom et Pr&eacute;noms</strong>: {$oData.oCandidat.nom}&nbsp;{$oData.oCandidat.prenom}<br>
                    <strong>Fonction</strong>: {$oData.oCandidat.poste}<br>
                    <strong>IM</strong>: {$oData.oCandidat.matricule}<br>
                    <strong>Corps</strong>: {$oData.oCandidat.corps}<br>
                    <strong>Grade</strong>: {$oData.oCandidat.grade}<br>
                    <strong>Service ou Division</strong>: {$oData.oService.libele}<br>
                    <strong>est autoris&eacute;(e) &agrave; s'absenter pour une dur&eacute;e {*{$oData.zTitre1}*} de</strong> : {$oData.iNombreConge} jour{if $oData.iNombreConge >1}s{/if}<br>
					<strong>A compter du</strong>: <em>{$oData.oGcap.gcap_dateDebut|date_format:"%d/%m/%Y"}</em> au <em>{$oData.oGcap.gcap_dateFin|date_format:"%d/%m/%Y"}</em></br>
					<strong>Motif : </strong> {$oData.oGcap.motif_libelle}<br>
					<strong>Lieu de jouissance :</strong> {$oData.oGcap.gcap_lieuJouissance}<br>
					A d&eacute;falquer sur {if $oData.iSizeDataListeFraction > 1}les{else}la{/if} D&eacute;cision{if $oData.iSizeDataListeFraction > 1}s{/if} : <br>
					{assign var=iIncrement value="0"}
					{foreach from=$oData.toDataListeFraction item=oListe }
					 - N&deg; {if $oListe.decision_numero != 0}{$oListe.decision_numero}/MFB{if $oData.sigle!=""}/{/if}{$oData.sigle}{/if} au titre de l'ann&eacute;e {$oListe.decision_annee} (reste {$oListe.reste} jour{if $oListe.reste >1}s{/if})<br>
					{assign var=iIncrement value=$iIncrement+1}
					{/foreach}

                    
                </p>
                </p>   
            </div>
        </div>
    </div>

    <div class="row clearfix nrml">
        <div class="col dec inPage">
            <div class="left"><p class="std txtCenter">L'int&eacute;ress&eacute;(e)<span style="display:inline-block; width: 30%;"></span>Le Chef Hi&eacute;rarchique</p></div>
            <div class="right"><p class="std txtCenter">Le responsable personnel</p></div>
        </div>
    </div>
    
</body>
</html>