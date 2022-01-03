{include_php file=$zCssJs}
<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>
<link href="{$zBasePath}assets/voting/css/style.css" type="text/css" rel="stylesheet">
{include_php file=$zHeader}
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
		<div id="ContentBloc">
			<!--h2>Saisie du contenu du projet d'acte</h2-->
			<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="#">RH</a> <span>&gt;</span> <a href="#">Gestion des absences</a> <span>&gt;</span> Suivi des actes</div>
			<div class="clear"></div>
			<div id="innerContentVoting">
				<div id="voting">
					<div class="panel-body">
						{if $oData.nombreVote==2}
							<center><h3>les deux (02) candidats que vous avez d&eacute;j&agrave; vot&eacute;</h3></center>
						{else}
							<center><h3>ELECTION DES DEUX DELEGUES DU PERSONNEL DE LA DRH</h3></center>
						{/if}
					</div>
					<div class="content row">	
					{foreach from=$oData.toCandidats item=oCandidat }
						<div class="form col-md-3 affiche_candidat">
							<img src="http://localhost:8088/ROHI/assets/upload/{$oCandidat.id}.{$oCandidat.type_photo}" width="100">
							<h4>{$oCandidat.nom} {$oCandidat.prenom}</h4>
							<h3>Employe de la DRH</h3>
							<p class="description">{$oCandidat.description}</p>
							{if $oData.nombreVote==2}
								<div class="button">
									<button style="margin: 0 28%;" type="button" class="col-md-5 btn btn-info center-block" onclick="manifesto('{$oCandidat.description}')">Voir Manifesto</button>
								</div>
							{else}
								<div class="button">
									<button type="button" class="col-md-5 btn btn-info " onclick="manifesto('{$oCandidat.description}')">Voir Manifesto</button>
									{if $oCandidat.id_vote>0}
										<button type="button" class="col-md-5 btn btn-danger btn_vote" >Deja vot&eacute;</button>
									{else}
										<button type="button" class="col-md-5 btn btn-danger btn_vote" onclick="voterCandidat('{$oCandidat.user_id}')">Voter pour lui</button>
									{/if}
								</div>
							{/if}
						</div>	
					{/foreach}
					</div>
				</div>
			</div>             
		</div>
	</section>
	<div class="modal fade" id="manifesto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	   <div class="modal-dialog">
			<div class="modal-content" style="height:100%">
				<div class="modal-body" id="detailManifesto" style="text-align: center;">
					<h3> Manifesto</h3>
					<div id="manifesto_content">
					</div>
				</div>
			</div>
	    </div>
    </div>
	<section id="rightContent" class="clearfix">
		{include_php file=$zRight}
	</section>
</div>
{include_php file=$zFooter}
{literal}
<script>
$(document).ready(function() {
	
});

function manifesto(description){
	$('#manifesto_content').html(description);
	$('#manifesto').modal();
}
function voterCandidat(candidat_user_id){
	$.ajax({
		url: "{/literal}{$zBasePath}{literal}Voting/voterCandidat/",
		type: 'post',
		data: {
			candidat_user_id: candidat_user_id
		},
		success: function(data, textStatus, jqXHR) {  
			var data				=	JSON.parse(data);
			if(data=="EXIST"){
				alert ("VOUS AVEZ DEJE VOTE CE CANDIDAT");
			}else{
				window.location = '{/literal}{$zBasePath}{literal}Voting/index/nouveau'; 
			}
		}
	});
}

</script>
{/literal}
</body>
</html>