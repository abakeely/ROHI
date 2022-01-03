<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/vendor/font-awesome.min.css" >
<link rel="stylesheet" href="{$zBasePath}assets/iles/iles-aux-tresors1.css" type="text/css" />
<script type="text/javascript" src="{$zBasePath}assets/iles/question1.js?12032018"></script>
<input type="hidden" name="iPagination" id="iPagination" value="1">
<form class="iles-aux-tresors" id="form-question" name="form-question" style="background-color:#FFFFFF;font-size:14px;font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:80%;min-width:150px;clear:both;" 
action="{$zBasePath}accueil/modification/fiche-de-poste/saveFichePoste" method="post">
<input type="hidden" name="iRow" id="iRow" value="1">
<input type="hidden" name="iUserId" id="iUserId" value="{$oCandidat.0->iUserId}">
<input type="hidden" name="iFichePosteId" id="iFichePosteId" value="{$toGetUserFichePoste.0.fichePoste_id}">
<input type="hidden" name="iIncrement_b" id="iIncrement_b" value="{if sizeof($toGetUserMission)>0}{$toGetUserMission|@count}{else}1{/if}">
<input type="hidden" name="iIncrement_c" id="iIncrement_c" value="{if sizeof($toGetUserActivite)>0}{
$toGetUserActivite|@count}{else}1{/if}">
<input type="hidden" name="iIncrement_d" id="iIncrement_d" value="{if sizeof($toGetUserEncadrement)>0}{$toGetUserEncadrement|@count}{else}1{/if}">
<input type="hidden" name="iIncrement_e" id="iIncrement_e" value="{if sizeof($toGetUserExigence)>0}{$toGetUserExigence|@count}{else}1{/if}">
<div id="logo1">
	<table class="logo1">
		<tr style="background:none!important">
			<td class="LeftLogo1"><img src="{$zBasePath}assets/iles/logo.png"></td>
			<td class="repoblika" ><p><strong>REPOBLIKAN'I MADAGASIKARA</strong> <br>
			<i>Fitiavana-Tanindrazana-Fandrosoana</i>
			</p></td>
			<td class="rightLogo1"><img src="{$zBasePath}assets/iles/logo1.png"></td>
		</tr>
		<tr style="background:none!important">
			<td class="mission" colspan="3"><p><u>Mission d'Elaboration des organigrammes détaillés, des descriptifs de postes de 06 Ministères et de la nomenclature des emplois de la fonction publique Malagasy.</u></p></td>
		</tr>
		<tr style="background:none!important">
			<td style="text-align:left;" class="mission" colspan="3"><p>Conformément à la lettre N° 26-2018 -MFB/SG/DRHA du 01 Mars 2018, vous êtes priés de remplir votre fiche de poste</p></td>
		</tr>
	</table>
</div>
<div class="title">
	<h6>{if $toGetUserFichePoste.0.nom ==""} Ajout {/if}fiche de poste de : {if $toGetUserFichePoste.0.nom !=""}{$toGetUserFichePoste.0.nom|ucfirst}&nbsp;&nbsp;{$toGetUserFichePoste.0.prenom|ucfirst}{else}
	{$oCandidat.0->nom|ucfirst}&nbsp;&nbsp;{$oCandidat.0->prenom|ucfirst}
	{/if}</h6>
</div> 
		<div class="element-separator"><h3 class="section-break-title">A. Intitulé de poste (Anaran'ny toeranasa)</h3></div>
			<div id="xxx" class="element-textarea" >
				<label class="title"><strong></strong></label>
				<div class="item-cont">
				<textarea style="width:93%" placeholder="Exemple : Correcteur d’Imprimerie" class="medium obligatoire" name="question_a" id="question_a"  cols="20" rows="5" >{$toGetUserFichePoste.0.fichePoste_intitule}</textarea>
				<span class="icon-place"></span>
				<p class="message">Veuillez remplir l'intituté de poste</p>
				</div>
			</div>
		<div class="element-separator"><h3 class="section-break-title">B. Mission(s) (Famaritana ny Iraka)</h3></div>
		<div id="addedRows_b">
			{if sizeof($toGetUserMission)>0}
				{assign var="zFin" value=$toGetUserMission|@count}
				{section name=iIncrement start=0 loop=$zFin step=1}
					{assign var="zQuestion" value='question_b_'|cat:$smarty.section.iIncrement.index}
					{assign var="iBoucle" value=$smarty.section.iIncrement.index}
					{assign var="iIndication" value=$iBoucle+1}
					{assign var="zValue" value=$toGetUserMission.$iBoucle.missionPoste_text}
					{assign var="iIdentifiant" value=$toGetUserMission.$iBoucle.missionPoste_id}
					
					<div id="rowCount_b_{$iIndication}" class="element-textarea">
						<label class="title"><strong></strong></label>
						<div class="item-cont">
							<input type="hidden" name="identifiant_b_{$iIndication}" value="{$iIdentifiant}">
							<input style="width:93%" class="large" type="text" value="{$zValue}"  name="question_b_{$iIndication}" id="question_b_{$iIndication}" placeholder=""/>&nbsp;&nbsp;
							<a href="#" onclick="addMoreRows('b',this.form);" ><i style="color:#69a26a;font-size:30px" class="la la-plus-square"></i></a>
							{if $iBoucle > 0}
							&nbsp;&nbsp;<a href="#" onclick="removeRow('b',{$iIndication});" ><i style="color: #F10610;font-size:22px" class="la la-close"></i></a>
							{/if}
							<span class="icon-place"></span>
						
						</div>
					</div>
				{/section}
			{else}
			<div id="rowCount_b_1" style="height:55px;" class="element-textarea element-textarea1 element-textarea2">
				<label class="title"><strong></strong></label>
				<div class="item-cont"><textarea style="width:93%;float:left" cols="20" rows="5" type="text" class="medium obligatoire" placeholder="(Exemple : Corriger les documents à imprimer en vérifiant à la fois le bon usage orthographique et grammatical, la tenue syntaxique, le respect des règles typographiques et la cohérence du contenu, sous l’autorité du supérieur hiérarchique)  "  name="question_b_1" id="question_b_1" placeholder=""/>{$toFormulaire.question_b_1}</textarea>&nbsp;&nbsp;
				<a href="#" onclick="addMoreRows('b',this.form);" ><i style="color:#69a26a;font-size:30px;" class="la la-plus-square"></i></a>
				<span class="icon-place"></span>
				<p style="clear:both" class="message"><br>Veuillez remplir votre mission</p>
				</div>
			</div> 
			{/if}
		</div>
		<div style="padding-top:17px;clear:both" class="element-separator"><h3 class="section-break-title">C. Activités principales (Raharaha Mivantana)</h3></div>
		<div id="addedRows_c">
			{if sizeof($toGetUserActivite)>0}
				{assign var="zFin" value=$toGetUserActivite|@count}
				{section name=iIncrement start=0 loop=$zFin step=1}
					{assign var="zQuestion" value='question_c_'|cat:$smarty.section.iIncrement.index}
					{assign var="iBoucle" value=$smarty.section.iIncrement.index}
					{assign var="iIndication" value=$iBoucle+1}
					{assign var="zValue" value=$toGetUserActivite.$iBoucle.activitePoste_text}
					{assign var="iIdentifiant" value=$toGetUserActivite.$iBoucle.activitePoste_id}
					<div id="rowCount_c_{$iIndication}" class="element-textarea">
						<label class="title"><strong></strong></label>
						<div class="item-cont">
							<input type="hidden" name="identifiant_c_{$iIndication}" value="{$iIdentifiant}">
							<input style="width:93%" class="large" type="text" value="{$zValue}"  name="question_c_{$iIndication}" id="question_c_{$iIndication}" placeholder=""/>&nbsp;&nbsp;
							<a href="#" onclick="addMoreRows('c',this.form);" ><i style="color:#69a26a;font-size:30px" class="la la-plus-square"></i></a>
							{if $iBoucle > 0}
							&nbsp;&nbsp;<a href="#" onclick="removeRow('c',{$iIndication});" ><i style="color: #F10610;font-size:22px" class="la la-close"></i></a>
							{/if}
							<span class="icon-place"></span>
							
						</div>
					</div>
				{/section}
			{else}
			<div id="rowCount_c_1" style="height:55px;" class="element-textarea element-textarea1 element-textarea3">
				<label class="title"><strong></strong></label>
				<div class="item-cont"><textarea style="width:93%;float:left" cols="20" rows="5" class="medium obligatoire" name="question_c_1" id="question_c_1" placeholder="(Exemple : suivre le plan de travail élaboré avec le supérieur hiérarchique, apporter toute correction de fond et de forme sur les documents à imprimer, soumettre les documents déjà corrigés aux commanditaires, transmettre à l’imprimeur les autorisations de tirage une fois les dernières corrections apportées et validées par les commanditaires, faire des points réguliers avec les supérieur hiérarchique)"/>{$toFormulaire.question_c_1}</textarea>&nbsp;&nbsp;<a href="#" onclick="addMoreRows('c',this.form);" ><i style="color:#69a26a;font-size:30px;" class="la la-plus-square"></i></a>
				<span class="icon-place"></span>
				<p style="clear:both" class="message"><br>Veuillez remplir vos activités principales</p>
				</div>
			</div>
			{/if}
		</div>
		<div style="padding-top:17px;clear:both" class="element-separator"><h3 class="section-break-title">D. Activités d'encadrement (Raharaha ara-piahiana)</h3></div>
		<div id="addedRows_d">
			{if sizeof($toGetUserEncadrement)>0}
				{assign var="zFin" value=$toGetUserEncadrement|@count}
				{section name=iIncrement start=0 loop=$zFin step=1}
					{assign var="zQuestion" value='question_c_'|cat:$smarty.section.iIncrement.index}
					{assign var="iBoucle" value=$smarty.section.iIncrement.index}
					{assign var="iIndication" value=$iBoucle+1}
					{assign var="zValue" value=$toGetUserEncadrement.$iBoucle.encadrementPoste_text}
					{assign var="iIdentifiant" value=$toGetUserEncadrement.$iBoucle.encadrementPoste_id}
					<div id="rowCount_d_{$iIndication}" class="element-textarea">
						<label class="title"><strong></strong></label>
						<div class="item-cont">
							<input type="hidden" name="identifiant_d_{$iIndication}" value="{$iIdentifiant}">
							<input style="width:93%" class="large" type="text" value="{$zValue}"  name="question_d_{$iIndication}" id="question_d_{$iIndication}" placeholder=""/>&nbsp;&nbsp;
							<a href="#" onclick="addMoreRows('d',this.form);" ><i style="color:#69a26a;font-size:30px" class="la la-plus-square"></i></a>
							{if $iBoucle > 0}
							&nbsp;&nbsp;<a href="#" onclick="removeRow('d',{$iIndication});" ><i style="color: #F10610;font-size:22px" class="la la-close"></i></a>
							{/if}
							<span class="icon-place"></span>
						</div>
					</div>
				{/section}
			{else}
			<div id="rowCount_d_1" class="element-textarea" style="padding-bottom: 21px;">
				<label class="title"><strong></strong></label>
				<div class="item-cont"><input style="width:93%" class="large" type="text" value="{$toFormulaire.question_d_1}"   name="question_d_1" id="question_d_1" placeholder="(Si vous encadrez un groupe, quel est votre rôle par rapport au groupe // Raha misy olona tarihina ianao eo amin’ny sehatry ny asa, inona no andraikitrao)"/>&nbsp;&nbsp;<a href="#" onclick="addMoreRows('d',this.form);" ><i style="color:#69a26a;font-size:30px" class="la la-plus-square"></i></a>
				<span class="icon-place"></span>
				<p class="message">Veuillez remplir vos activités d'encadrement</p>
				</div>
			</div>
			{/if}
		</div>
	<div class="element-input" style="width:100%" title="">
		<div class="element-separator"><h3 class="section-break-title">E. Exigences de poste</h3></div>
		<table style="width:93%">
			<tr>
				<th style="text-align:left;width:45%;" class="entete column7">Selon vous, quel niveau et domaine de formation académique et professionnelle, diplôme devrait avoir la personne occupant le poste mentionné sur l’intitulé de poste ?</th>
				<th style="text-align:left;width:45%;" class="entete column7">Selon vous, combien d’années d’expérience professionnelle devrait avoir une personne travaillant dans le domaine cité dans l’intitulé du poste et/ou dans un poste semblable ?</th>
				<th style="border:none;width:10%!important;" class="column">&nbsp;&nbsp;<a href="#" onclick="addMoreRows('e',this.form);" ><i style="color:#69a26a;font-size:30px" class="la la-plus-square"></i></a></th>
				<th style="border:none;width:10%;" class="column">&nbsp;&nbsp;</th>
			</tr>
			<tbody id="addedRows_e">
				
				{if sizeof($toGetUserExigence)>0}
					{assign var="zFin" value=$toGetUserExigence|@count}
					{section name=iIncrement start=0 loop=$zFin step=1}
						{assign var="iBoucle" value=$smarty.section.iIncrement.index}
						{assign var="zValue1" value=$toGetUserExigence.$iBoucle.exigencePoste_niveau}
						{assign var="zValue2" value=$toGetUserExigence.$iBoucle.exigencePoste_experience}
						{assign var="iIndication" value=$iBoucle+1}
						{assign var="iIdentifiant" value=$toGetUserExigence.$iBoucle.exigencePoste_id}
						<tr id="rowCount_e_{$iIndication}">
							<td class="column7"><div class="item-cont">
							<input type="hidden" name="identifiant_e_{$iIndication}" value="{$iIdentifiant}">
							<textarea class="medium" name="question_e_1_{$iIndication}" id="question_e_1_{$iIndication}" cols="10" rows="3" placeholder="">{$zValue1}</textarea>
							<span class="icon-place"><span class="icon-place"></span>
							<p class="message">Veuillez remplir ce champ</p>
							</div>
							</td>
							<td class="column7"><div class="item-cont">
							<textarea class="medium" name="question_e_2_{$iIndication}" id="question_e_2_{$iIndication}" cols="10" rows="3" placeholder="">{$zValue2}</textarea>
							<span class="icon-place"><span class="icon-place"></span></div></td><td style="border:none" class="column">&nbsp;&nbsp;
							<a href="#" onclick="addMoreRows('e',this.form);" ><i style="color:#69a26a;font-size:30px" class="la la-plus-square"></i></a>
							{if $iBoucle > 0}
							&nbsp;&nbsp;<a href="#" onclick="removeRow('e',{$iIndication});" ><i style="color: #F10610;font-size:22px" class="la la-close"></i></a>
							{/if}
							</td>
						</tr>
					{/section}
				{else}
				<tr>
					<td class="column7">
						<div class="item-cont">
							<textarea class="medium obligatoire" name="question_e_1_1" id="question_e_1_1"  cols="10" rows="3" placeholder="araka ny hevitrao, inona no farim-pahaizana tokony hananan’ny olona mitana io toeranasa io">{$toFormulaire.question_e_1_1}</textarea><span class="icon-place">
							<span class="icon-place"></span>
							<p class="message">Veuillez remplir votre niveau de domaine de formation</p>
						</div>
					</td>
					<td class="column7">
						<div class="item-cont">
							<textarea class="medium obligatoire" name="question_e_2_1" id="question_e_2_1"  cols="10" rows="3" placeholder="araka ny hevitrao,tokony hanana traik’efa hatramin’ny firy taona ny olona mitana io toeranasa io ?">{$toFormulaire.question_e_2_1}</textarea><span class="icon-place"><span class="icon-place"></span>
							<p class="message">Veuillez remplir votre exprerience professionnelle</p>
						</div>
					</td>
					<td colspan="2" style="border:none" class="column">
						<div class="item-cont">
							
						</div>
					</td>
				</tr>
				{/if}
			</tbody>
		</table>
		</div>
		<br><br>
		<input style="width:10%" class="large" type="hidden" value="" name="zCaptcha" id="zCaptcha" placeholder=""/>
		{#
		<div>
			<div id="rowCount_b_1" class="element-textarea">
				<label class="title"><strong>Veuillez reproduire l'image ci-après :</strong> <img width="15%" src="http://rohi.mef.gov.mg:8088/captcha2/captcha.php"></label>
				<br>
				<div class="item-cont"><input style="width:10%" class="large obligatoire" type="text"  name="zCaptcha" id="zCaptcha" placeholder=""/></span>
				<p class="message">Veuillez reproduire le texte dans l'image</p><br><br>
				</div>
			</div>
		</div>
		#}
	<br>
	<p>
		<br>
		<strong>NB :</strong>
		<i style="color:black;font-size:20px;" class="la la-hand-o-right" aria-hidden="true"></i>&nbsp;(Veuillez cliquer <i style="color:#69a26a;font-size:30px" class="la la-plus-square"></i> pour ajouter une ligne)
	</p>
	
	<div class="submit">
		<input type="button" class="SubmitValider" onclick="valider()" value="Envoyer"/>
	</div>
</form>

<script type="text/javascript" src="questionnaire_files/iles/iles-aux-tresors.js"></script>
{literal}
<style>
td.left {width:20%}
i { vertical-align: middle;}
.entete {
	background-color: #69a26a!important;
    border-top: 1px solid #32a55b!important;
    border-bottom: 5px solid #5b825c!important;
	color:white!important;
}
.iles-aux-tresors input[type=button], .iles-aux-tresors input[type=submit] {
    height: 48px;
}
</style>
<script>
$(document).ready (function ()
{
	{/literal}{if $iErr==1}{literal}
	bootbox.alert("Le texte entré n'est pas valide, Veuillez réessayer. Merci!");
	{/literal}{/if}{literal}

	$(document).keypress(function (e) {
		if (e.which == 13) {
			return;
		}
	});
	
})
</script>
{/literal}

