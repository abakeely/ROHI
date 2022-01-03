
<div id="innerContent">
	<div id="saisieActe">
		<div class="panel-body">
			<h3>ENQUÊTE SUR LES CONDITIONS DE TRAVAIL DES AGENTS DE LA DGFAG</h3>
		</div>
		<div class="col-xs-6">
			<table id="jqGridDownload"></table>
			<div id="jqGridPagerDownload"></div>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4">
				<a class="form-control btn-primary bouton" onclick="telechargerFormulaireDeclaration()" type="submit"/>Telecharger</a>
			</div>
		</div>
	</div>
</div>             

<input type="hidden" value="" id="user_id_selected"/>
<div id="template_detail_agent" style="display:none">
	<table>
		 <tbody>
			<tr>
			   <td><b>Nom: <a class="lien_cv" target="_blank" href="http://rohi.mef.gov.mg:8088/ROHI/cv2/mon_cv?id=[[data.id]]">[[data.nom]]</a></b></td>
			   <td>Pr&eacute;noms: [[data.prenom]]</td>
			   <td>Phone: [[data.phone]]</td>
			   <td rowspan="10" valign="top"><img style="width:90px;border-radius:50px;" src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload/[[data.id]].[[data.type_photo]]"></td>
			</tr>
			<tr>
			   <td>Adresse: [[data.address]]</td>
			   <td>Poste:   [[data.poste]]</td>
			   <td>Domaine: [[data.domaine]]</td>
			</tr>
			<tr>
			   <td>E-mail: <a class="lien_cv"  href="mailto:[[data.email]]">[[data.email]]</a></td>
			   <td>Coprs: [[data.corps]] (Categorie: [[data.categorie]])</td>
			   <td>Grade: [[data.grade]] (Indice: [[data.indice]])</td>
			</tr>
			<tr>

			   <td>Sanction: [[data.sanction_libelle]]</td>
			   <td>Date sanction: [[data.dateSanction]]</td>
			   <td>Date prise de service: [[data.date_prise_service]]</td>
			</tr>
		</tbody>
	</table>
</div>
{literal}
<script>
$(document).ready(function() {
	
});



</script>
{/literal}
</body>
</html>