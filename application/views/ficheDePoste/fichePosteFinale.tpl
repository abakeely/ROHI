{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<form name="notation" id="notation" method="post">
<input type="hidden" name="noteEvaluation_userSendNoteId" id="noteEvaluation_userSendNoteId" value="{$oData.user_id}">
<input type="hidden" name="userANoteId" id="userANoteId" value="">
<input type="hidden" name="noteOfUserId" id="noteOfUserId" value="">
<input type="hidden" name="notePonctualiteOfUserId" id="notePonctualiteOfUserId" value="">
</form>
{include_php file=$zHeader}
<div class="page-header">
	<div class="row align-items-center">
		<div class="col-12">
			<h3 class="page-title">Ajout / Modification fiche de poste</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
				<li class="breadcrumb-item"><a href="{$zBasePath}">RH</a></li>
				<li class="breadcrumb-item">Fiche de poste </li>
			</ul>
		</div>
	</div>
</div>
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<h2> Ajout / Modification fiche de poste</h2>
		<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="#">RH</a> <span>&gt;</span> Fiche de poste </div>
		
		<div class="clear"></div>
		<div class="contenuePage">
				<div class="col-xs-12">
					<div style="float:left;" id="getUserInfo">
						{$oData.zInfoUser}
					</div>
				</div>	
		</div>
	</div>
	<div id="calendar"></div>
	</div>
</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>

</form>
{include_php file=$zFooter}
</div>

</body>
</html>