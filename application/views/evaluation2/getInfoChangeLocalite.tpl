<form>
<input type="hidden" name="iUserId" id="iUserId" value="{$toLocalite.0.localite_userId}">
<div class="col-xs-12" style="padding-right:0px;" id="formulaire" style="display:block;">
	<div class="widget-box">
		
		<div class="widget-body">
			<div class="widget-main">
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">&nbsp;</label>
				</div>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Nom : <span style="font-weight:normal">{$toLocalite.0.nom}</span></label>
				</div>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Pr&eacute;nom  : <span style="font-weight:normal">{$toLocalite.0.prenom}</span></label>
				</div>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Matricule  : <span style="font-weight:normal">{$toLocalite.0.matricule}</span></label>
				</div>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Pays  : <span style="font-weight:normal">{$toLocalite.0.zPays}</span></label>
				</div>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Province  : <span style="font-weight:normal">{$toLocalite.0.zProvince}</span></label>
				</div>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">R&eacute;gion  : <span style="font-weight:normal">{$toLocalite.0.zRegion}</span></label>
				</div>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">District  : <span style="font-weight:normal">{$toLocalite.0.zDistrict}</span></label>
				</div>
				{if $toLocalite.0.zDirection != ""}
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Direction  : <span style="font-weight:normal">{$toLocalite.0.zDirection}</span></label>
				</div>
				{/if}
				{if $toLocalite.0.zService != ""}
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Service  : <span style="font-weight:normal">{$toLocalite.0.zService}</span></label>
				</div>
				{/if}
				{if $toLocalite.0.zDivision != ""}
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Division  : <span style="font-weight:normal">{$toLocalite.0.zDivision}</span></label>
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
					var iBadgeId = $(this).attr('setDemandeId');
					$.ajax({
						url: "{/literal}{$zBasePath}{literal}sau/setUpdateAttributionDate" ,
						method: "POST",
						data: {iBadgeId:iBadgeId},
						success: function(data, textStatus, jqXHR) {
							$("#badgeSortie_"+iBadgeId).html(data);
							$( "#dialog" ).dialog( "close" );
						},
						async: false
					});
				});
			});
{/literal}
</script>
