<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/vendor/font-awesome.min.css" >
<link rel="stylesheet" href="{$zBasePath}assets/iles/iles-aux-tresors1.css" type="text/css" />
<script type="text/javascript" src="{$zBasePath}assets/iles/question1.js?12032018"></script>
<input type="hidden" name="iPagination" id="iPagination" value="1">
<form class="iles-aux-tresors" id="form-question" name="form-question" style="background-color:#FFFFFF;font-size:14px;font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:80%;min-width:150px;clear:both;" 
action="{$zBasePath}accueil/outils/fiche-de-poste/saveFichePoste" method="post">
<input type="hidden" name="iRow" id="iRow" value="1">
<input type="hidden" name="iFichePosteId" id="iFichePosteId" value="{$iFichePosteId}">
<div class="title">
	<h6>fiche de poste </h6>
</div> 
		<div class="element-separator"><h3 class="section-break-title">1. Intitulé de poste</h3></div>
			<div id="xxx" class="element-textarea" >
				<label class="title"><strong></strong></label>
				<div class="item-cont">
				{$zIntitule}
				<span class="icon-place"></span>
				</div>
			</div>
		<div class="element-separator"><h3 class="section-break-title">2. Mission(s)</h3></div>
		<div id="xxx" class="element-textarea">
			<div class="element-textarea element-textarea1 element-textarea2">
				<label class="title"><strong></strong></label>
				<div class="item-cont">
				{$zMission}
				</div>
			</div> 
		</div>
		<div   class="element-separator"><h3 class="section-break-title">3. Activités principales</h3></div>
		<div id="xxx" class="element-textarea">
			
			<div class="element-textarea element-textarea1 element-textarea3">
				<label class="title"><strong></strong></label>
				<div class="item-cont">
				{$zActivite}
				</div>
			</div>
			
		</div>
		<div  class="element-separator"><h3 class="section-break-title">4. Activités d'encadrement</h3></div>
		<div id="xxx" class="element-textarea">
			
			<div class="element-textarea" style="padding-bottom: 21px;">
				<label class="title"><strong></strong></label>
				<div class="item-cont">
				{$zEncadrement}
				</div>
			</div>
			
		</div>
	<div class="element-input" style="width:100%" title="">
		<div class="element-separator"><h3 class="section-break-title">5. Exigences de poste</h3></div>
		<table style="width:95%">
			<tr>
				<th style="text-align:left;width:45%;" class="entete column7">Selon vous, quel niveau et domaine de formation académique et professionnelle, diplôme devrait avoir la personne occupant le poste mentionné sur l’intitulé de poste ?</th>
				<th style="text-align:left;width:45%;" class="entete column7">Selon vous, combien d’années d’expérience professionnelle devrait avoir une personne travaillant dans le domaine cité dans l’intitulé du poste et/ou dans un poste semblable ?</th>
			</tr>
			<tbody id="addedRows_e">
				<tr>
					<td class="column7">
						<div class="item-cont">
							{$zDiplome}
						</div>
					</td>
					<td class="column7">
						<div class="item-cont">
							{$zNiveau}
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		</div>
		<br><br>
		<input style="width:10%" class="large" type="hidden" value="" name="zCaptcha" id="zCaptcha" placeholder=""/>
		

	<div class="submit">
		<input type="button" class="SubmitValider" onclick="document.location.href='{$zBasePath}accueil/outils/fiche-de-poste/liste'" value="Retour"/>
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

