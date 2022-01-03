{include_php file=$zCssJs}
	<!-- Main Wrapper -->
	<input type="hidden" id="base_url" value="{$zBasePath}">
	<input type="hidden" id="iInscriptionligneId" value="{$oData.iInscriptionligneId}">
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">
									Inscription en ligne{if $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
									&agrave; finaliser
									{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
									&agrave; imprimer
									{/if}
								</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">Formation</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}formation/offre/sfao/divers-offres">Offres</a></li>
									<li class="breadcrumb-item">Inscription en ligne</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="">
									<div id="content-wrap" class="form form-body demande-formation"  text-align="center">

										<h1 class="demande-formation">Formulaire de pré-inscription</h1><hr>
										<form class="row" action="{$zBasePath}formation/save" method="POST">
											
											{$oData.oOutput}
											
											<div class="contenueBouton">

												<div class="col-xs-12 col-sm-12 text-center">
													<hr><font><b><font color="red" size="5rem"> * </font></b>  Les champs marqués d'une étoile sont obligatoires.</font>
												</div>

												<input class="btn btn-primary form-control " data-toggle="tooltip" data-original-title=" Tsindrio rehefa feno daholo ny momba anao rehetra " value="S'inscrire" type="submit" style="margin-top: 26px;">    
											
											</div>
										</form>
									</div>
								</div>
								<div id="calendar"></div>
								<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
									<input type="hidden" name="AucunResultat" id="AucunResultat" value="Aucun r&eacute;sultat trouv&eacute;">
									<input type="hidden" name="chargement" id="chargement" value="Chargement des r&eacute;sultats ...">

									<input type="hidden" name="idSelect" id="idSelect" value="{if sizeof($oData.oCandidatSearch)>0}{$oData.oCandidatSearch->user_id}{/if}">
									<input type="hidden" name="textSelect" id="textSelect" value="{if sizeof($oData.oCandidatSearch)>0}{$oData.oCandidatSearch->nom}&nbsp;{$oData.oCandidatSearch->prenom}{/if}">

									<input type="hidden" name="iElementId" id="iValueId" value="">
									<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/liste/{$oData.zHashModule}/{$oData.zHashUrl}">
								</form>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- /Page Content -->
					
		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}

{literal}		
<style>

button {
	
}
.demande-formation h1
{
	text-align: center;
  	font-size: 2.5em;
	padding-bottom: 4px;
	padding-top: 29px;
  	color: black;
}
.contenueBouton
{
		/*margin-top: 900px;*/
		text-align: center;
		padding-bottom: 35px;
}
.form input[type="text"]
{
	
	width: 70%;
	float: right;

}

 </style>
 {/literal}
<br><br>

 
{literal}  
<script>
$(document).ready(function()
	{
		    var iInscriptionligneId=$('#iInscriptionligneId').val();;
 			var base_url=$('#base_url').val();
		    if(iInscriptionligneId>0)
		    {
		    	var message="<a href=\""+base_url+"formation/printNotePresentation/"+iInscriptionligneId+"\" class=\"btn btn-info glyphicon glyphicon-download-alt \" data-toggle=\"tooltip\"  target=\"_blank\" ><font style=\"font-size: 0.8em;\">Note de présentation</font></a>"
		    			+"<a href=\""+base_url+"formation/printFormulaire/"+iInscriptionligneId+"\" class=\"btn btn-primary form-control \" data-toggle=\"tooltip\" target=\"_blank\"> <font style=\"font-size: 1em;\"> Imprimer </font></a>";
		    	bootbox.dialog({
		            title:"<h3>enregistrement avec succes</h3>",
		            message: message,
		            size: 'large',
		            backdrop: true
		        });
		    }

			$("select#_zChamp-1").on("change",function()
			{
				var valeur=$("#_zChamp-1").val();
				var url=base_url+'service/getListFamilleproByFonctionId/'+valeur;
				var data_option=get_html_content_from_url(url);
				refresh_select_picker("#_zChamp-2",data_option,"famillepro_id","famillepro_libelle");
				$("#_zChamp-2").trigger("change");
			});
			$("select#_zChamp-2").on("change",function()
			{
				var valeur=$("#_zChamp-2").val();
				var url=base_url+'service/getListSousFamilleProByFamillePro/'+valeur;
				var data_option=get_html_content_from_url(url);
				refresh_select_picker("#_zChamp-3",data_option,"sousfamillepro_id","sousfamillepro_libelle");
				$("#_zChamp-3").trigger("change");
			});
			$("select#_zChamp-3").on("change",function()
			{
				var valeur=$("#_zChamp-3").val();
				var url=base_url+'service/getEmploiBySousFamille/'+valeur;
				var data_option=get_html_content_from_url(url);
				refresh_select_picker("#_zChamp-4",data_option,"emploi_id","emploi_libelle");
				$("#_zChamp-4").trigger("change");
			});
			$("select#_zChamp-4").on("change",function()
			{
				var valeur=$("#_zChamp-4").val();
				var url=base_url+'service/getPostByEmploi/'+valeur;
				var data_option=get_html_content_from_url(url);
				refresh_select_picker("#_zChamp-5",data_option,"poste_id","poste_libelle");
				$("#_zChamp-5").trigger("change");
			});
			$("select#_zChamp-15").on("change",function()
			{
				var valeur=$("#_zChamp-15").val();
				var url=base_url+'service/getInstitutByFormation/'+valeur;
				var data_option=get_html_content_from_url(url);
				refresh_select_picker("#_zChamp-16",data_option,"institut_id","institut_libelle");
				$("#_zChamp-16").trigger("change");
			});
			$("select#_zChamp-16").on("change",function()
			{
				var valeur=$("#_zChamp-16").val();
				var url=base_url+'service/getIntituleByInstitut/'+valeur;
				var data_option=get_html_content_from_url(url);
				refresh_select_picker("#_zChamp-17",data_option,"intitule_id","intitule_libelle");
				$("#_zChamp-17").trigger("change");
			});


			$("#_zChamp-1").trigger("change");
			
	});

	function refresh_select_picker(cible,data_option,value,name)
	{
	    var html='';
	     html+='<option value="">...</option>';
	    for (var i in data_option) 
	    {
	         html+='<option value="' + data_option[i][value] + '">' + data_option[i][name]  + '</option>';
	    }
	    $(cible).html(html);
	}

	function get_html_content_from_url(url, form_param,is_json)
	{
	    var html = false;
	    var form_param = form_param || new Array();
	    var is_json = is_json || true;
	    jQuery.ajax(
	    {
	        type: "POST",
	        data: form_param,
	        url: url,
	        success: function(response) 
	        {
	            if(is_json)
	            {
	            	//arrayl liste php encodé via json_encode puis il faut decoder avec parseJson ici
	                html = $.parseJSON(response); 
	            }else
	            {
	                html=response;
	            }
	        },
	        async: false
	    });
	    return html;
	}
	/*function myFunction() 
	{
	    var txt = "";
	    if (document.getElementById("_zChamp-$iId").validity.rangeUnderflow) 
	    {
	        txt = "Veuillez remplir le champ s'il vous plaît";
	    } 
	    document.getElementById("demo").innerHTML = txt;
	}*/
    


  
</script>
{/literal}
