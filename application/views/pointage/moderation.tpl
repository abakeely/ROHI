{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								{if $oData.zHashUrl == 'moderer'}
									<h3 class="page-title">Moderation mot de passe </h3>
								{elseif $oData.zHashUrl == 'valider'}
									<h3 class="page-title">Les acc&egrave;s moder&eacute;s et valid&eacute;s</h3>
								{elseif $oData.zHashUrl == 'refuser'}
									<h3 class="page-title">Les acc&egrave;s moder&eacute;s et refus&eacute;s</h3>
								{elseif $oData.zHashUrl == 'archiver'}
									<h3 class="page-title">Les acc&egrave;s archiv&eacute;s</h3>
								{/if}
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item">Modération</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
		
								<form action="{$zBasePath}pointage/moderation/pointage-electronique/" method="POST" name="formulaireGet" id="formulaireGet" enctype="multipart/form-data">
									<fieldset>
										<div class="row1 clearfix" >
											<div>
												<div class="field">
													<input type="button" class="button" style="max-width:226px;" onClick="send(1);" name="" id="" value="Les acc&egrave;s moder&eacute;s et valid&eacute;s"><p class="yes">&nbsp;</p>
													<input type="button" class="button" style="max-width:226px;" onClick="send(2);" name="" id="" value="Les acc&egrave;s moder&eacute;s et refus&eacute;s"><p class="yes">&nbsp;</p>
													<input type="button" class="button" style="max-width:325px;" onClick="send(3);" name="" id="" value="les changements d'acc&egrave;s archiv&eacute;s">
												</div>
											</div>
										</div>
									</fieldset>
								</form>
								<p class="no" id="azafady" style="height:75px;padding-top:25px;vertical-align:middle;text-align:center;font-size:16px;color:green; background-color:pink;animation: allblink 2s infinite;"> Izay manao <strong>"Mod&eacute;ration mot de passe"</strong> anie azafady mba anotanio ny <strong>"CIN"</strong> an'ilay "Agent" (3e Colonne amin'ny liste eo ambany), izay vo valider-na. Misaotra Betsaka ô!</p>
								<p>&nbsp;</p>
								<div class="clear"></div>
								

								
								<div class="clear"></div>
								
								<div class="">
									<table>
										<thead>
											<tr>
												<th class="no">Date</th>
												<th >Nom</th>
												<th class="no">CIN</th>
												<th class="no">T&eacute;lephone</th>
												{if $oData.zHashUrl == 'moderer'}
												<th class="no" style="text-align:center;">Mettre en archive</th>
												{/if}
												<th style="text-align:center" colspan="2">Validation</th>
											</tr>
										</thead>
										<tbody>
											{assign var=iIncrement value="0"}
											{if sizeof($oData.toGetModeration)>0}
											{foreach from=$oData.toGetModeration item=oListeModeration }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td class="no">{$oListeModeration.moderation_date|date_format:"%d/%m/%Y %T"}</td>
												<td>{$oListeModeration.nom} &nbsp; {$oListeModeration.prenom}</td>
												<td class="no">{$oListeModeration.cin}</td>
												<td class="no">{$oListeModeration.phone}</td>
												{if $oData.zHashUrl == 'moderer'}
												<td class="no" style="text-align:center;"><input type="checkbox" class="archivage" getUserId="{$oListeModeration.moderation_id}" id="iArchivage_{$oListeModeration.moderation_id}" name="iArchivage_{$oListeModeration.moderation_id}" value="1"></td>
												{/if}
												<td class="no" {if $oListeModeration.moderation_statut==0}style="text-align:right"{else}style="text-align:center" colspan="2"{/if}>
												{if $oListeModeration.moderation_statut==0}
												<button onClick="sendModeration('{$oListeModeration.moderation_id}',1);" name="" id="" value="Valider"><i style="padding:10px;" class="button la la-check">&nbsp;Valider</i></button></td>
												<td class="no" style="text-align:left"><button onClick="sendModeration('{$oListeModeration.moderation_id}',2);" name="" id="" value="Refuser"><i style="padding:10px;" class="button la la-close">&nbsp;Refuser</i></button>
												{elseif $oListeModeration.moderation_statut==1}
												<i style="color: green;padding:10px;" class="button la la-check">&nbsp;</i>
												{elseif $oListeModeration.moderation_statut==2}
												<i style="color: #F10610;padding:10px;" class="button la la-close">&nbsp;</i>
												{/if}
												</td>
												<td class="yes">
												{if $oListeModeration.moderation_statut==0}
												<button onClick="sendModeration('{$oListeModeration.moderation_id}',1);" name="" id="" value="Valider"><i style="padding:10px;" class="button la la-check">&nbsp;Valider</i></button><p>&nbsp;</p>
												<button onClick="sendModeration('{$oListeModeration.moderation_id}',2);" name="" id="" value="Refuser"><i style="padding:10px;" class="button la la-close">&nbsp;Refuser</i></button>
												{elseif $oListeModeration.moderation_statut==1}
												<i style="color: green;padding:10px;" class="button la la-check">&nbsp;</i>
												{elseif $oListeModeration.moderation_statut==2}
												<i style="color: #F10610;padding:10px;" class="button la la-close">&nbsp;</i>
												{/if}
												</td>
												
											</tr>
											{assign var=iIncrement value=$iIncrement+1}
											{/foreach}
											{if $oData.zHashUrl == 'moderer'}
											<tr>
												<td colspan="4">&nbsp;</td>
												<td style="text-align:center;"><input type="button" class="button" onClick="validerArchive()" name="" id="" value="Archiver"></td>
												<td colspan="2"></td>
												</td>
											</tr>
											{/if}
											{else}
											
											<tr><td style="text-align:center;" colspan="10">Aucun enregistrement correspondant</td></tr>
											{/if}
										</tbody>
									</table>
									{$oData.zPagination}
								</div>
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
			<form action="{$zBasePath}pointage/saveModeration/pointage-electronique/save" method="POST" name="formulaireSend" id="formulaireSend"  enctype="multipart/form-data">
				<input type="hidden" name="iModerationId" id="iModerationId" value="">
				<input type="hidden" name="iValue" id="iValue" value="">
			</form>
			<form action="{$zBasePath}pointage/moderation/pointage-electronique/moderer" method="POST" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
				<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}pointage/moderation/pointage-electronique/{$oData.zHashUrl}">	
			</form>	
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}

{literal}
<style>
td {padding:5px;}
input[type=checkbox] {
	height: 18px;
	width: 18px;
	vertical-align: middle;
}
@media screen and (max-width: 620px) {
	#azafady{
		height : 100px !important;
		padding: 10px !important;
	}
	.no {
		display:none;
	}

	form input[type=button] {
		width: 100%!important;
	}
}

@media screen and (min-width: 620px) {
	.yes {
		display:none;
	}
}

</style>
<script>
	function sendModeration(_iModerationId, iValueData) {

		$("#iModerationId").val(_iModerationId);
		$("#iValue").val(iValueData);
		$("#formulaireSend").submit();
	}

	function send(_iValue){
		var zAction = $("#formulaireGet").attr("action");

		switch (_iValue) {

			case 1:
				zAction = zAction + "valider";
				break;

			case 2:
				zAction = zAction + "refuser";
				break;

			case 3:
				zAction = zAction + "archiver";
				break;
		}

		$("#formulaireGet").attr("action", zAction) ; 
		$("#formulaireGet").submit();
	}

	function validerArchive(){

		var zListe = '';
		$('.archivage').each(function()
		{
			
			var iValue = $(this).is(':checked'); 
			if (iValue == true) {
				
				iUserId = $(this).attr("getUserId");

				if (zListe == '') {
					zListe += iUserId;
					iTest = 1;
				} else {
					zListe += "-" + iUserId;
					iTest = 1;
				}
			}
			
		})

		if (iTest == 0) {
			alert("Veuillez cocher au moins une ligne si vous voulez valider")
		} else {
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}pointage/saveUpdateModeration/" ,
				method: "POST",
				data: { zListe:zListe},
				success: function(data, textStatus, jqXHR) {
					document.location.href = '{/literal}{$zBasePath}{literal}pointage/moderation/pointage-electronique/moderer';
				},
				async: false
			});
		}
	}
</script>
{/literal}