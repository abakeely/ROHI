{include_php file=$zCssJs}
<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								{* <h3 class="page-title">Visualisations</h3> *}
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Suivi des actes</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="clear"></div>
								<div id="innerContent">
									
									<div id="saisieActe">
										<div class="panel-body">
											<h3>Modification du mot de passe</h3>
										</div>
										<div class="row">
											<div class="form col-md-2">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Ancien mot de passe(*) </b></label>
												</div>
												<input type="text" class="form-control obligatoire" placeholder="Ancien mot de passe"  name="ancien_mot_de_passe" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ancien_mot_de_passe" value="">
											</div>
											<div class="form col-md-2">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Nouveau mot de passe(*) </b></label>
												</div>
												<input type="text" class="form-control obligatoire" placeholder="Nouveau mot de passe"  name="nouveau_mot_de_passe" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="nouveau_mot_de_passe" value="">
											</div>
											<div class="col-md-2 mb-5" style="margin: 5% 0 0 0;">
												<a class="form-control btn-primary bouton" onclick="modifierMotDePasse()" type="submit"/>			<center>MODIFIER</center>
												</a>
											</div>
										</div>
									</div>
								</div>   
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
<script>
$(document).ready(function() {
	
});

function modifierMotDePasse(){
	var iValide	=	validateFields();
	if(iValide == 1){
		$.ajax({
				url: "{/literal}{$zBasePath}{literal}User/modifierMotDePasse/",
				type: 'post',
				data: {
					ancien_mot_de_passe  : $("#ancien_mot_de_passe").val(),
					nouveau_mot_de_passe : $("#nouveau_mot_de_passe").val(),
				},
				success: function(data, textStatus, jqXHR) {  
					cleanFields();
					jAlert("Modification effectuée");
				}
		});
	}
}

function cleanFields(){
	$(".form-control").each (function (){
		$(this).val("");
	}) ;
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
</script>
{/literal}