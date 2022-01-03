<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>ROHI - Fiche de poste</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="blurBg-false" style="background-color:#EBEBEB" >


<!-- Start Formoid form-->
<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/vendor/font-awesome.min.css" >
<link rel="stylesheet" href="{$zBasePath}assets/sau/css/bootstrap1.css" />
<link rel="stylesheet" href="{$zBasePath}assets/accueil/css/components.css?sdsds" type="text/css">
<link rel="stylesheet" href="{$zBasePath}assets/iles/iles-aux-tresors.css" type="text/css" />
<script type="text/javascript" src="{$zBasePath}assets/iles/jquery.min.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/iles/question.js?12032018"></script>
<script type="text/javascript" src="{$zBasePath}assets/gcap/js/vendor/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/gcap/js/vendor/jquery-ui.js"></script>
<script src="{$zBasePath}assets/js/bootstrap.min.js"></script>
<script src="{$zBasePath}assets/sau/js/bootbox.js"></script>



<input type="hidden" name="iPagination" id="iPagination" value="1">
<form class="iles-aux-tresors" id="form-question" name="form-question" style="background-color:#FFFFFF;font-size:14px;font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:80%;min-width:150px" 
action="{$zBasePath}accueil/saveFichePoste" method="post">
<input type="hidden" name="iRow" id="iRow" value="1">
<input type="hidden" name="iIncrement_b" id="iIncrement_b" value="{if $toFormulaire.iIncrement_b != ''}{$toFormulaire.iIncrement_b}{else}1{/if}">
<input type="hidden" name="iIncrement_c" id="iIncrement_c" value="{if $toFormulaire.iIncrement_c != ''}{$toFormulaire.iIncrement_c}{else}1{/if}">
<input type="hidden" name="iIncrement_d" id="iIncrement_d" value="{if $toFormulaire.iIncrement_d != ''}{$toFormulaire.iIncrement_d}{else}1{/if}">
<input type="hidden" name="iIncrement_e" id="iIncrement_e" value="{if $toFormulaire.iIncrement_e != ''}{$toFormulaire.iIncrement_e}{else}1{/if}">
<div id="logo">
	<table class="logo">
		<tr>
			<td class="LeftLogo"><img src="{$zBasePath}assets/iles/logo.png"></td>
			<td class="repoblika" ><p><strong>REPOBLIKAN'I MADAGASIKARA</strong> <br>
			<i>Fitiavana-Tanindrazana-Fandrosoana</i>
			</p></td>
			<td class="rightLogo"><img src="{$zBasePath}assets/iles/logo1.png"></td>
		</tr>
		<tr>
			<td class="mission" colspan="3"><p><u>Mission d'Elaboration des organigrammes détaillés, des descriptifs de postes de 06 Ministères et de la nomenclature des emplois de la fonction publique Malagasy.</u></p></td>
		</tr>
		<tr>
			<td style="text-align:left;" class="mission" colspan="3"><p>Conformément à la lettre N° 26-2018 -MFB/SG/DRHA du 01 Mars 2018, vous êtes priés de remplir votre fiche de poste</p></td>
		</tr>
		<tr>
			<td class="mission" style="text-align:right" colspan="3"><p><a href="{$zBasePath}gcap/deconnexion">Déconnexion de ROHI.</u></p></td>
		</tr>
	</table>
</div>
<div class="title">
	<h2>Fiche de poste</h2>
</div> 
		<div class="element-separator"><h3 class="section-break-title">A. Intitulé de poste (Anaran'ny toeranasa)</h3></div>
		<div class="">
			<div id="xxx" class="element-textarea">
				<label class="title"><strong></strong></label>
				<div class="item-cont">
				<textarea style="width:93%" placeholder="Exemple : Correcteur d’Imprimerie" class="medium obligatoire" name="question_a" id="question_a"  cols="20" rows="5" >{$toFormulaire.question_a}</textarea>
				<span class="icon-place"></span>
				<p class="message">Veuillez remplir l'intituté de poste</p>
				</div>
			</div>
		</div>
		<div class="element-separator"><h3 class="section-break-title">B. Mission(s) (Famaritana ny Iraka)</h3></div>
		<div id="addedRows_b">
			<div id="rowCount_b_1" style="height:55px;" class="element-textarea element-textarea1 element-textarea2">
				<label class="title"><strong></strong></label>
				<div class="item-cont"><textarea style="width:93%;float:left" cols="20" rows="5" type="text" class="medium obligatoire" placeholder="(Exemple : Corriger les documents à imprimer en vérifiant à la fois le bon usage orthographique et grammatical, la tenue syntaxique, le respect des règles typographiques et la cohérence du contenu, sous l’autorité du supérieur hiérarchique)  "  name="question_b_1" id="question_b_1" placeholder=""/>{$toFormulaire.question_b_1}</textarea>&nbsp;&nbsp;
				<a href="#" onclick="addMoreRows('b',this.form);" ><i style="color:#69a26a;font-size:30px;" class="la la-plus-square"></i></a>
				<span class="icon-place"></span>
				<p style="clear:both" class="message"><br>Veuillez remplir votre mission</p>
				</div>
			</div> 
			{if $toFormulaire.iIncrement_b != ''}
				{section name=iIncrement start=2 loop=$toFormulaire.iIncrement_b+1 step=1}
					{assign var="zQuestion" value='question_b_'|cat:$smarty.section.iIncrement.index}
					{assign var="zValue" value=$toFormulaire.$zQuestion}
					<div id="rowCount_b_{$smarty.section.iIncrement.index}" class="element-textarea">
						<label class="title"><strong></strong></label>
						<div class="item-cont">
							<input style="width:93%" class="large" type="text" value="{$zValue}"  name="question_b_{$smarty.section.iIncrement.index}" id="question_b_{$smarty.section.iIncrement.index}" placeholder=""/>&nbsp;&nbsp;
							<a href="#" onclick="addMoreRows('b',this.form);" ><i style="color:#69a26a;font-size:30px" class="la la-plus-square"></i></a>
							&nbsp;&nbsp;<a href="#" onclick="removeRow('b',{$smarty.section.iIncrement.index});" ><i style="color: #F10610;font-size:22px" class="la la-close"></i></a></span><br><br>
						</div>
					</div>
				{/section}
			{/if}
			<br><br>
		</div>
		<div style="padding-top:17px;clear:both" class="element-separator"><h3 class="section-break-title">C. Activités principales (Raharaha Mivantana)</h3></div>
		<div id="addedRows_c">
			<div id="rowCount_c_1" style="height:55px;" class="element-textarea element-textarea1 element-textarea3">
				<label class="title"><strong></strong></label>
				<div class="item-cont"><textarea style="width:93%;float:left" cols="20" rows="5" class="medium obligatoire" name="question_c_1" id="question_c_1" placeholder="(Exemple : suivre le plan de travail élaboré avec le supérieur hiérarchique, apporter toute correction de fond et de forme sur les documents à imprimer, soumettre les documents déjà corrigés aux commanditaires, transmettre à l’imprimeur les autorisations de tirage une fois les dernières corrections apportées et validées par les commanditaires, faire des points réguliers avec les supérieur hiérarchique)"/>{$toFormulaire.question_c_1}</textarea>&nbsp;&nbsp;<a href="#" onclick="addMoreRows('c',this.form);" ><i style="color:#69a26a;font-size:30px;" class="la la-plus-square"></i></a>
				<span class="icon-place"></span>
				<p style="clear:both" class="message"><br>Veuillez remplir vos activités principales</p>
				</div>
			</div>
			{if $toFormulaire.iIncrement_c != ''}
				{section name=iIncrement start=2 loop=$toFormulaire.iIncrement_c+1 step=1}
					{assign var="zQuestion" value='question_c_'|cat:$smarty.section.iIncrement.index}
					{assign var="zValue" value=$toFormulaire.$zQuestion}
					<div id="rowCount_c_{$smarty.section.iIncrement.index}" class="element-textarea">
						<label class="title"><strong></strong></label>
						<div class="item-cont">
							<input style="width:93%" class="large" type="text" value="{$zValue}"  name="question_c_{$smarty.section.iIncrement.index}" id="question_c_{$smarty.section.iIncrement.index}" placeholder=""/>&nbsp;&nbsp;
							<a href="#" onclick="addMoreRows('b',this.form);" ><i style="color:#69a26a;font-size:30px" class="la la-plus-square"></i></a>
							&nbsp;&nbsp;<a href="#" onclick="removeRow('b',{$smarty.section.iIncrement.index});" ><i style="color: #F10610;font-size:22px" class="la la-close"></i></a></span><br><br>
						</div>
					</div>
				{/section}
			{/if}
			<br><br>
		</div>
		<div style="padding-top:17px;clear:both" class="element-separator"><h3 class="section-break-title">D. Activités d'encadrement (Raharaha ara-piahiana)</h3></div>
		<div id="addedRows_d">
			<div id="rowCount_d_1" class="element-textarea" style="padding-bottom: 21px;">
				<label class="title"><strong></strong></label>
				<div class="item-cont"><input style="width:93%" class="large" type="text" value="{$toFormulaire.question_d_1}"   name="question_d_1" id="question_d_1" placeholder="(Si vous encadrez un groupe, quel est votre rôle par rapport au groupe // Raha misy olona tarihina ianao eo amin’ny sehatry ny asa, inona no andraikitrao)"/>&nbsp;&nbsp;<a href="#" onclick="addMoreRows('d',this.form);" ><i style="color:#69a26a;font-size:30px" class="la la-plus-square"></i></a>
				<span class="icon-place"></span>
				<p class="message">Veuillez remplir vos activités d'encadrement</p>
				</div>
			</div>
			{if $toFormulaire.iIncrement_d != ''}
				{section name=iIncrement start=2 loop=$toFormulaire.iIncrement_d+1 step=1}
					{assign var="zQuestion" value='question_d_'|cat:$smarty.section.iIncrement.index}
					{assign var="zValue" value=$toFormulaire.$zQuestion}
					<div id="rowCount_d_{$smarty.section.iIncrement.index}" class="element-textarea">
						<label class="title"><strong></strong></label>
						<div class="item-cont">
							<input style="width:93%" class="large" type="text" value="{$zValue}"  name="question_d_{$smarty.section.iIncrement.index}" id="question_d_{$smarty.section.iIncrement.index}" placeholder=""/>&nbsp;&nbsp;
							<a href="#" onclick="addMoreRows('b',this.form);" ><i style="color:#69a26a;font-size:30px" class="la la-plus-square"></i></a>
							&nbsp;&nbsp;<a href="#" onclick="removeRow('b',{$smarty.section.iIncrement.index});" ><i style="color: #F10610;font-size:22px" class="la la-close"></i></a></span><br><br>
						</div>
					</div>
				{/section}
			{/if}
		</div>
	<div class="element-input" style="width:100%" title="">
		<div class="element-separator"><h3 class="section-break-title">E. Exigences de poste</h3></div>
		<table style="width:93%">
			<tr>
				<th style="text-align:left;width:45%;" class="entete column7">Selon vous, quel niveau et domaine de formation académique et professionnelle, diplôme devrait avoir la personne occupant le poste mentionné sur l’intitulé de poste ?</th>
				<th style="text-align:left;width:45%;" class="entete column7">Selon vous, combien d’années d’expérience professionnelle devrait avoir une personne travaillant dans le domaine cité dans l’intitulé du poste et/ou dans un poste semblable ?</th>
				<th style="border:none;width:10%;" class="column">&nbsp;&nbsp;<a href="#" onclick="addMoreRows('e',this.form);" ><i style="color:#69a26a;font-size:30px" class="la la-plus-square"></i></a></th>
				<th style="border:none;width:10%;" class="column">&nbsp;&nbsp;</th>
			</tr>
			<tbody id="addedRows_e">
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
				{if $toFormulaire.iIncrement_e != ''}
					{section name=iIncrement start=2 loop=$toFormulaire.iIncrement_e+1 step=1}
						{assign var="zQuestion1" value='question_e_1_'|cat:$smarty.section.iIncrement.index}
						{assign var="zQuestion2" value='question_e_2_'|cat:$smarty.section.iIncrement.index}
						{assign var="zValue1" value=$toFormulaire.$zQuestion1}
						{assign var="zValue2" value=$toFormulaire.$zQuestion2}
						<tr id="rowCount_e_{$iIncrement}">
							<td class="column7"><div class="item-cont">
							<textarea class="medium" name="question_e_1_{$iIncrement}" id="question_e_1_{$iIncrement}" cols="10" rows="3" placeholder="">{$zValue1}</textarea>
							<span class="icon-place"><span class="icon-place"></span>
							<p class="message">Veuillez remplir ce champ</p>
							</div>
							</td>
							<td class="column7"><div class="item-cont">
							<textarea class="medium" name="question_e_2_{$iIncrement}" id="question_e_2_{$iIncrement}" cols="10" rows="3" placeholder="">{$zValue2}</textarea>
							<span class="icon-place"><span class="icon-place"></span></div></td><td style="border:none" class="column">&nbsp;&nbsp;
							<a href="#" onclick="addMoreRows('+iVar+',this.form);" ><i style="color:#69a26a;font-size:30px" class="la la-plus-square"></i></a>
							
							&nbsp;&nbsp;<a href="#" onclick="removeRow('+iVar+',{$iIncrement});" ><i style="color: #F10610;font-size:22px" class="la la-close"></i></a>
							</td>
						</tr>
					{/section}
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
	</div>
	<div class="submit">
		<input type="button" class="SubmitValider" onclick="valider()" value="Envoyer"/>
	</div>
	<div class="title">
		<p style="text-align:center;color:black">
			<span><strong>LISTE DES POINTS FOCAUX ORGANIGRAMMES DETAILLES</strong></span>
			<table align="center" class="tableFooter">
			<tr><td><strong>Mme Aurélie (DGAI) :</strong></td><td>034 02 336 70</td></tr>
			<tr><td><strong>M. Karl (DGAI) :</strong> </td><td>      034 11 942 33</td></tr>
			<tr><td><strong>Mme Hanitriniaina (DGB) :</strong></td><td>   032 11 082 61</td></tr>
			<tr><td><strong>Mme Rosa (DGB) :</strong></td><td>   032 11 068 25</td></tr>
			<tr><td><strong>M. Manitra (DGCF) :</strong></td><td>   034 64 749 19</td></tr>
			<tr><td><strong>M. Tsiory (DGCF) :</strong> </td><td>  034 45 075 24</td></tr>
			<tr><td><strong>Mme Njara (DGD) :</strong></td><td>   034 50 968 17</td></tr>
			<tr><td><strong>Mme Ony (DGGFPE):</strong></td><td>   034 07 414 97</td></tr>
			<tr><td><strong>Mme Andrianina (DGGFPE):</strong></td><td>   034 70 612 78</td></tr>
			<tr><td><strong>M. Mamy (DGI) :</strong> </td><td>  034 15 049 34</td></tr>
			<tr><td><strong>Mme Rina (DGT) :</strong></td><td>   034 49 213 70</td></tr>
			<tr><td><strong>M. Ravoavimanampisoa (DGT) :</strong></td><td>   034 03 546 53</td></tr>
			<tr><td><strong>M. Hajantsalama (DRHA) :</strong></td><td>   032 11 070 84</td></tr>
			</table>
		</p>
		<p style="text-align:center;color:black" >&copy; 2018 - Minist&egrave;re des finances et du budget</p>    
	</div> 

</form>

<script type="text/javascript" src="questionnaire_files/iles/iles-aux-tresors.js"></script>
{literal}
<style>
td.left {width:20%}
i { vertical-align: middle;}
</style>
<script>
$(document).ready (function ()
{
	{/literal}{if $iErr==1}{literal}
	bootbox.alert("Le texte entré n'est pas valide, Veuillez réessayer. Merci!");
	{/literal}{/if}{literal}

	/*$(document).keypress(function (e) {
		if (e.which == 13) {
			//valider();
			return ;
		}
	});*/

	$('form').keypress(function(e){
		return ;
	});
	
})
</script>
{/literal}
<!-- Stop Formoid form-->
</body>
</html>
