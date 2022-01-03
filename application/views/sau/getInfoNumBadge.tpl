<form>
<input type="hidden" name="iUserId" id="iUserId" value="{$iUserId}">
<div class="col-xs-12" style="padding-right:0px;" id="formulaire" style="display:block;">
	<div class="widget-box">
		<div class="widget-header">
			<h4 class="widget-title">
				<i class="ace-icon la la-tint"></i>
				Attribution Badge Provisioire pour un Agent
			</h4>
		</div>
		
		<div class="widget-body">
			<div class="widget-main">
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Nom : <span style="font-weight:normal">{$oGetInfoBadge.0.nom}</span></label>
				</div>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Pr&eacute;nom  : <span style="font-weight:normal">{$oGetInfoBadge.0.prenom}</span></label>
				</div>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Matricule  : <span style="font-weight:normal">{$oGetInfoBadge.0.matricule}</span></label>
				</div>
				{if $oGetInfoBadge.0.zDirection != ""}
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Direction  : <span style="font-weight:normal">{$oGetInfoBadge.0.zDirection}</span></label>
				</div>
				{/if}
				{if $oGetInfoBadge.0.zService != ""}
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Service  : <span style="font-weight:normal">{$oGetInfoBadge.0.zService}</span></label>
				</div>
				{/if}
				{if $oGetInfoBadge.0.zDivision != ""}
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Division  : <span style="font-weight:normal">{$oGetInfoBadge.0.zDivision}</span></label>
				</div>
				{/if}


				{if sizeof($toAttribution)>0}
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">BADGE  : <span style="font-weight:normal">{$toAttribution.0->badge_nom}</span></label>
				</div>
				<button class="btn btn-xs btn-danger submitRendreBadge" setDemandeId="{$toAttribution.0->attribution_userId}">
					Rendre le badge
					<i class="ace-icon la la-arrow-right icon-on-right"></i>
				</button>
				{else}
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px">Badge * :</label>
				</div>
				<div class="control-group">
					<div class="bootstrap-colorpicker"> 
						<select id="iNumBadgeId" name="iNumBadgeId">
							<option value="">Veuillez s&eacute;l&eacute;ctionner</option>
							{foreach from=$toBadge item=toBadge}
							<option value="{$toBadge.badge_id}">{$toBadge.badge_nom}</option>
							{/foreach}
						</select>
					</div>
				</div>
				{/if}
			</div>
		</div>
		
	</div>
	
</div>
</form>

<script type="text/javascript">
{literal}
			
			$(document).ready (function ()
			{
				$(".submitRendreBadge").on('click', function(e) {
					var iUserId = $(this).attr('setDemandeId');
					$.ajax({
						url: "{/literal}{$zBasePath}{literal}sau/setUpdateAttributionDate" ,
						method: "POST",
						data: {iUserId:iUserId},
						success: function(data, textStatus, jqXHR) {
							$("#badgeSortie_"+iUserId).html(data);
							$( "#dialog" ).dialog( "close" );
						},
						async: false
					});
				});
			});
{/literal}
</script>
