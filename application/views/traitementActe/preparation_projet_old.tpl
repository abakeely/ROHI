{include_php file=$zCssJs}
<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
{include_php file=$zHeader}
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<h2>Initialisation du projet d'acte</h2>
		<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="#">RH</a> <span>&gt;</span> <a href="#">Gestion des absences</a> <span>&gt;</span> Suivi des actes</div>
		<div class="clear"></div>
			<div id="innerContent">
            
				<div class="panel-body">
					<div class="row">
						<div class="form col-md-4">
							<a class="form-control btn-primary bouton" onclick="saveProjetActe()" type="submit"/>ENREGISTRER</a>
						</div>
					</div>
				</div>
			</div>.               
		</div>
	</section>
	<section id="rightContent" class="clearfix">
		{include_php file=$zRight}
	</section>
</div>
<script>
		var dataPlan = {$oData.jsonData};
</script>
{include_php file=$zFooter}
{literal}

<script>

$(document).ready(function() {
	//setMask();
});

function saveProjetActe(){
	var iValide	=	validateFields();
	if(iValide == 1){
		$.ajax({
				url: "{/literal}{$zBasePath}{literal}TraitementActe/saveProjetActe/",
				type: 'post',
				data: {
					ticket_poste_agent_numero: $("#ticket_poste_agent_numero").val(),
					ticket_libelle: $("#ticket_libelle").val(),
					ticket_processus_code: $("#ticket_processus_code").val(),
					ticket_commentaire: $("#ticket_commentaire").val(),
					ticket_sigle: $("#ticket_sigle").val(),
					ticket_designation: $("#ticket_designation").val(),
					ticket_niveau: $("#ticket_niveau").val(),
				},
				success: function(data, textStatus, jqXHR) {  
					cleanFields();
					alert(" Ticket Numero : "+data);
				}
		});
	}
}

function cleanFields(){
	$("#ticket_poste_agent_numero").val("");
	$("#ticket_libelle").val("");
	$("#ticket_processus_code").val("");
	$("#ticket_commentaire").val("");
	$("#ticket_sigle").val("");
	$("#ticket_designation").val("");
}

function validateFields(){
	var iValide = 1;
	$(".obligatoire").each (function (){
		if($(this).val()=="" || $(this).val()=="--select--"){
			$(this).addClass("required");
			iValide = 0;
		}else{
			$(this).removeClass("required");
		}
	}) ;

	return iValide;
}

function setMask(){
	//$("#ticket_poste_agent_numero").mask("9999999");  
}

</script>
{/literal}
</body>
</html>