<script src="{$zBasePath}assets/reclassement/js/custom-file-input.js"></script>
<table id="getVIsualisation">
	<tr>
	<td>
			<form id="pieceJointeSubmit" method="POST" action="{$zBasePath}reclassement/save/gestion-reclassement/dossiers" enctype="multipart/form-data">
			<input type="hidden" name="iReclassementId" id="iReclassementId" value="{$iReclassementId}">
			<fieldset>
				<table>
					<tr class="notAffiche">
						<td colspan="2" style="color:green;"><i style="color:green;font-size:20px;" class="la la-info-circle" aria-hidden="true"></i>&nbsp;<strong>Information sur le reclassement demandé </strong></td>
					</tr>
					<tr class="notAffiche">
						<td colspan="2"><strong>Nom et prénom : </strong>{$oInfoReclassement.0.nom}&nbsp;{$oInfoReclassement.0.prenom}</td>
					</tr>
					<tr class="notAffiche">
						<td colspan="2"><strong>Matricule : </strong>{$oInfoReclassement.0.matricule}</td>
					</tr>
					<tr class="notAffiche">
						<td colspan="2" style="color:green;"><i style="color:green;font-size:20px;" class="la la-hand-o-right" aria-hidden="true">&nbsp;</i><strong>Pièces jointes </strong></td>
					</tr>
					{foreach from=$oPiecesJointes1 item=oPiecesJointes }
					<tr class="notAffiche">
						<td style="width:40%"><input type="checkBox" {if $oPiecesJointes->reclassPieceJointe_pieceJointeId!=''}checked="checked"{/if} name="pieceJointe_{$oPiecesJointes->pieceJointe_id}" id="pieceJointe_{$oPiecesJointes->pieceJointe_id}" value="1">&nbsp;{$oPiecesJointes->pieceJointe_libelle}&nbsp;</td><td><input type="file" name="filePieceJointe_{$oPiecesJointes->pieceJointe_id}" id="file-{$oPiecesJointes->pieceJointe_id}" style="display:none"  class="inputfile inputfile-1" data-multiple-caption="files selected" />
					<label {if $oPiecesJointes->reclassPieceJointe_nomFichier!=''}style="background:green"{/if} for="file-{$oPiecesJointes->pieceJointe_id}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>{if $oPiecesJointes->reclassPieceJointe_nomFichier!=''}
					{$oPiecesJointes->reclassPieceJointe_nomFichier}{else}Fichier joint{/if}</span></label>&nbsp;&nbsp;
					{if $oPiecesJointes->reclassPieceJointe_nomFichier!=''}
					<a href="{$zBasePath}assets/reclassement/upload/{$oPiecesJointes->reclassPieceJointe_nomFichier}" target="_blank">
						<i id="image2" style="display:inline-block;color:#0089DC;font-size:16px;" title="Modifier" alt="Modifier" class="la la-search"></i>
					</a>
					{/if}
					</td>
					</tr>
					{/foreach}
				</table>
			</fieldset>
			</form>
		
	</td>
	</tr>
</table>
{literal}
<style>
#getVIsualisation td {font-size:1em;}
.ui-widget-overlay {
  /*opacity: 0.6!important;*/
  filter: Alpha(Opacity=50);
  background-color: gray;
}
input[type=checkbox]{height:18px;width:18px;vertical-align:middle}

.js .inputfile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}

.inputfile + label {
    width:auto!important;
	max-width:300px!important;
	min-width:120px!important;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: pointer;
    display: inline-block;
    overflow: hidden;
    padding: 0.625rem 1.25rem;
    /* 10px 20px */
}

.no-js .inputfile + label {
    display: none;
}

.inputfile:focus + label,
.inputfile.has-focus + label {
    outline: 1px dotted #000;
    outline: -webkit-focus-ring-color auto 5px;
}

.inputfile + label * {
    /* pointer-events: none; */
    /* in case of FastClick lib use */
}

.inputfile + label svg {
    width: 1em;
    height: 1em;
    vertical-align: middle;
    fill: currentColor;
    margin-top: -0.25em;
    /* 4px */
    margin-right: 0.25em;
    /* 4px */
}


/* style 1 */

.inputfile-1 + label {
    color: #f1e5e6;
    background-color: #58688b;
}

.inputfile-1:focus + label,
.inputfile-1.has-focus + label,
.inputfile-1 + label:hover {
    background-color: #722040;
}


/* style 2 */

.inputfile-2 + label {
    color: #d3394c;
    border: 2px solid currentColor;
}

.inputfile-2:focus + label,
.inputfile-2.has-focus + label,
.inputfile-2 + label:hover {
    color: #722040;
}


/* style 3 */

.inputfile-3 + label {
    color: #d3394c;
}

.inputfile-3:focus + label,
.inputfile-3.has-focus + label,
.inputfile-3 + label:hover {
    color: #722040;
}


/* style 4 */

.inputfile-4 + label {
    color: #d3394c;
}

.inputfile-4:focus + label,
.inputfile-4.has-focus + label,
.inputfile-4 + label:hover {
    color: #722040;
}

.inputfile-4 + label figure {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background-color: #d3394c;
    display: block;
    padding: 20px;
    margin: 0 auto 10px;
}

.inputfile-4:focus + label figure,
.inputfile-4.has-focus + label figure,
.inputfile-4 + label:hover figure {
    background-color: #722040;
}

.inputfile-4 + label svg {
    width: 100%;
    height: 100%;
    fill: #f1e5e6;
}


/* style 5 */

.inputfile-5 + label {
    color: #d3394c;
}

.inputfile-5:focus + label,
.inputfile-5.has-focus + label,
.inputfile-5 + label:hover {
    color: #722040;
}

.inputfile-5 + label figure {
    width: 100px;
    height: 135px;
    background-color: #d3394c;
    display: block;
    position: relative;
    padding: 30px;
    margin: 0 auto 10px;
}

.inputfile-5:focus + label figure,
.inputfile-5.has-focus + label figure,
.inputfile-5 + label:hover figure {
    background-color: #722040;
}

.inputfile-5 + label figure::before,
.inputfile-5 + label figure::after {
    width: 0;
    height: 0;
    content: '';
    position: absolute;
    top: 0;
    right: 0;
}

.inputfile-5 + label figure::before {
    border-top: 20px solid #dfc8ca;
    border-left: 20px solid transparent;
}

.inputfile-5 + label figure::after {
    border-bottom: 20px solid #722040;
    border-right: 20px solid transparent;
}

.inputfile-5:focus + label figure::after,
.inputfile-5.has-focus + label figure::after,
.inputfile-5 + label:hover figure::after {
    border-bottom-color: #d3394c;
}

.inputfile-5 + label svg {
    width: 100%;
    height: 100%;
    fill: #f1e5e6;
}


/* style 6 */

.inputfile-6 + label {
    color: #d3394c;
}

.inputfile-6 + label {
    border: 1px solid #d3394c;
    background-color: #f1e5e6;
    padding: 0;
}

.inputfile-6:focus + label,
.inputfile-6.has-focus + label,
.inputfile-6 + label:hover {
    border-color: #722040;
}

.inputfile-6 + label span,
.inputfile-6 + label strong {
    padding: 0.625rem 1.25rem;
    /* 10px 20px */
}

.inputfile-6 + label span {
    width: 200px;
    min-height: 2em;
    display: inline-block;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    vertical-align: top;
}

.inputfile-6 + label strong {
    height: 100%;
    color: #f1e5e6;
    background-color: #d3394c;
    display: inline-block;
}

.inputfile-6:focus + label strong,
.inputfile-6.has-focus + label strong,
.inputfile-6 + label:hover strong {
    background-color: #722040;
}

@media screen and (max-width: 50em) {
	.inputfile-6 + label strong {
		display: block;
	}
}


</style>
{/literal}
		