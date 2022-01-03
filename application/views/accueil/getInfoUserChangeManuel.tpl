<script src="{$zBasePath}assets/js/jquery.maskedinput.js?sdsds"></script>
<input type="hidden" name="iUserId" id="iUserId" value="{$iUserId}">
<input type="hidden" name="iUserTarget" id="iUserTarget" value="{$iUserTarget}">
<p>&nbsp;</p>
<table id="evaluation-table">
	<tr>
		<td style="width:2%">
			<div class="left">
				<p class="photo1"><img width="200" src="{$zPathWithPhoto}"/></p>
			</div>
		</td>
		<td style="width:30%;vertical-align:top">
			<table id="information-table">
				<tr>
					<td style="width:30%;vertical-align:top;border:none" colspan="2">
						<form enctype="multipart/form-data">
							<fieldset>
								<div class="row1" style="width:100%">
									<div class="cell">
										<div class="field">
											<label><b>Nom :</b> {$oCandidat.0->nom}</label>
											<label>Matricule : {$oCandidat.0->matricule}</label>
										</div>
									</div>
								</div>
								<div class="row1">
									<div class="cell small">
										<div class="field">
											<label>Pr&eacutenom(s) : {$oCandidat.0->prenom}</label>
										</div>
									</div>
								</div>
								<div class="row1 clearfix">
									<div class="cell">
										<div class="field">
											
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell" style="width:65%">
										<div class="field"> 
											<label>Province</label>
											<select id="iOrganisation_1" name="iProvinceId" onChange="getOrganisation('{$zBasePath}',1,this.value);">
												<option value="0">s&eacute;l&eacute;ctionner une province</option>
												{foreach from=$toProvince item=oProvince }
												<option {if $oProvince.id == $oCandidat.0->province_id} selected="selected" {/if} value="{$oProvince.id}">{$oProvince.libele}</option>
												{/foreach}
											</select>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell" style="width:65%">
										<div class="field"> 
											<label>Région</label>
											<select id="iOrganisation_2" name="iRegionId" onChange="getOrganisation('{$zBasePath}',2,this.value);">
												<option value="0">s&eacute;l&eacute;ctionner une région</option>
												{foreach from=$toRegion item=oRegion }
												<option {if $oRegion.id == $oCandidat.0->region_id} selected="selected" {/if} value="{$oRegion.id}">{$oRegion.libele}</option>
												{/foreach}
											</select>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell" style="width:65%">
										<div class="field"> 
											<label>District</label>
											<select id="iOrganisation_3" name="iDistrictId" onChange="getOrganisation('{$zBasePath}',3,this.value);">
												<option value="0">s&eacute;l&eacute;ctionner un district</option>
												{foreach from=$toDistrict item=oDistrict }
												<option {if $oDistrict.id == $oCandidat.0->district_id} selected="selected" {/if} value="{$oDistrict.id}">{$oDistrict.libele}</option>
												{/foreach}
											</select>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell" style="width:65%">
										<div class="field"> 
											<label>Departement</label>
											<select id="iOrganisation_4" name="iDepartementId" onChange="getOrganisation('{$zBasePath}',4,this.value);">
												<option value="0">s&eacute;l&eacute;ctionner un d&eacute;partement</option>
												{foreach from=$oDepartement item=oDepartement }
												<option {if $oDepartement.id == $oCandidat.0->departement} selected="selected" {/if} value="{$oDepartement.id}">{$oDepartement.libele}</option>
												{/foreach}
											</select>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell"  style="width:50%">
										<div class="field"> 
											<label>Direction</label>
											<select id="iOrganisation_5" name="iDirectionId" onChange="getOrganisation('{$zBasePath}',5,this.value);">
												<option value="0">s&eacute;l&eacute;ctionner une direction</option>
												{foreach from=$oDirection item=oDirection }
												<option {if $oDirection.id == $oCandidat.0->direction} selected="selected" {/if} value="{$oDirection.id}">{$oDirection.libele}</option>
												{/foreach}
											</select>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell"  style="width:50%">
										<div class="field"> 
											<label>Service</label>
											<select id="iOrganisation_6" name="iServiceId" onChange="getOrganisation('{$zBasePath}',6,this.value);">
												<option value="0">s&eacute;l&eacute;ctionner un service</option>
												{foreach from=$oService item=oService }
												<option {if $oService.id == $oCandidat.0->service} selected="selected" {/if} value="{$oService.id}">{$oService.libele}</option>
												{/foreach}
											</select>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell"  style="width:50%">
										<div class="field"> 
											<label>Division</label>
											<select id="iOrganisation_7" name="iDivisionId" >
												<option value="0">s&eacute;l&eacute;ctionner une division</option>
												{foreach from=$oDivision item=oDivision }
												<option {if $oDivision.id == $oCandidat.0->division} selected="selected" {/if} value="{$oDivision.id}">{$oDivision.libele}</option>
												{/foreach}
											</select>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell"  style="width:50%">
										<div class="field"> 
											<label>T&eacute;l&eacute;phone</label>
											<input type="text" id="zPhone" class="form-control" placeholder="T&eacute;l&eacute;phone" name="zPhone" data-toggle="tooltip" data-original-title="" value="{$oCandidat.0->phone}">
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell"  style="width:50%">
										<div class="field"> 
											<label>E-mail</label>
											<input type="text" id="zEmail" class="form-control" placeholder="E-mail" name="zEmail" data-toggle="tooltip" data-original-title="" value="{$oCandidat.0->email}">
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
{literal}
<style>
table { margin:0 }
td {
    padding: 15px;
    text-align: left;
    border-bottom: none; 
}
.submitRendreBadge {
    background-color: #D15B47!important;
    border-color: #D15B47;
}

input[type=checkbox] {
    height: 20px;
    width: 20px;
    vertical-align: middle;
}

.btn {
    color: #FFF!important;
    text-shadow: 0 -1px 0 rgba(0,0,0,.25);
    background-image: none!important;
    border: 5px solid #FFF;
    border-radius: 0;
    box-shadow: none!important;
    -webkit-transition: background-color .15s,border-color .15s,opacity .15s;
    -o-transition: background-color .15s,border-color .15s,opacity .15s;
    transition: background-color .15s,border-color .15s,opacity .15s;
    vertical-align: middle;
    margin: 0;
    position: relative;
	width:500px;
}
</style>
<script>

function getOrganisation(_zBasePath, _iType, _iValue)
{
	$(document).ready (function ()
	{
		
		for(iBoucle=_iType+1;iBoucle<=7;iBoucle++){
			$('#iOrganisation_' + iBoucle).val('0');
			$('#iOrganisation_' + iBoucle).attr("disabled","disabled");
		}

		var iDistrictId = $('#iOrganisation_3').val();
		$.ajax({
			url: _zBasePath + "critere/organisation/" + _iType +'/' +_iValue ,
			type: 'POST',
			data: { iDistrictId:iDistrictId},
			success: function(data, textStatus, jqXHR) {
				iType = _iType+1;
				$('#iOrganisation_' + iType).removeAttr("disabled");
				$('#iOrganisation_' + iType).html(data);
				
			},
			async: false
		});
	});
}
$(document).ready (function ()
{
	$("#zPhone").mask("999 99 999 99");
	/*$("#motifSuppression").hide();
	$('#iNoteEvaluable').click(function(){
		
		var iValue = $('#iNoteEvaluable').is(':checked'); 
		switch (iValue) {
			case true:
				$("#iDesevaluer").val(1);
				$("#motifSuppression").show();
				break;

			case false:
				$("#iDesevaluer").val(0);
				$("#motifSuppression").hide();
				break;
		}	
	});*/
});
</script>
{/literal}