<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<input type="hidden" name="iUserId" id="iUserId" value="{$iUserId}">
<p>&nbsp;</p>
<div>
		<form class="Cv-form" id="photoMAJ" action="{$zBasePath}cv2/saveConfirmationBadge" method="post" enctype="multipart/form-data">
			<input type="hidden" id="testPhoto" name="testPhoto" value="{$iTestPhoto}">
			<input type="hidden" id="iUserIdConnecte" name="iUserIdConnecte" value="{$oCandidat.0->user_id}">
			
			<div id="miseDispo" class="col-md-12">
				<fieldset style="padding-left : 3% !important">
					<div class="clearfix"></div>
					 <!----------------- bloc Details ---------------->
								<div class="headblock">
									<div class="left User-photo">
										 <img id="userLeftPhoto" src="{$zPathWithPhoto}">
									</div>
									<div class="User-details">
										<div class="row" style="width:100%">
											<div class="cell1">
												<div class="field">
													<label><b>Nom :</b> {$oCandidat.0->nom}</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="field">
												<label>Prénom(s) : {$oCandidat.0->prenom}</label>
											</div>
										</div>
										<div class="row clearfix">
											<div class="cell1">
												<div class="field">
													<label>Matricule : {$oCandidat.0->matricule}</label>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>

									</div>
									<div class="clearfix"></div>
									<div class="fileChange">
										<label for="photo">Modifier
											<input type="file" class="file_upload" class="form-control" name="photo" data-toggle="tooltip" data-original-title="Safidio sy ampidiro ny sarinao" onchange="imageChange(this);" id="photo" data-bv-field="photo"><i class="form-control-feedback" data-bv-icon-for="photo" style="display: none; top: 0px;"></i>
										</label>
									</div>
								</div>
								<div class="form form-group" style="width:50%">
									<label>DEPARTEMENT</label>
									<select class="form-control" placeholder="Departement" onChange="getLocaliteCv('{$zBasePath}',1,this.value,1);"  name="departement" data-toggle="tooltip" data-original-title= "Safidio ny Departemanta na sampan-draharaha misy anao" id="departement"{if $zRole=='chef'}{/if}>
										<option  value="0">-------</option> 
										{foreach from=$toDepartement item=oDepartement}
											<option  value={$oDepartement.id} {if $oDepartement.id==$oCandidat[0]->departement}selected="selected"{/if}>{$oDepartement.libele}</option>
										{/foreach}
									</select>
								</div>

								<!---------------------------------------------------------------->

								<div id="iLocalite_1" class="clearfix">
									{$oData.zSelectDirection}
								</div>
								<br>
								<div id="iLocalite_2" class="clearfix">
									{$oData.zSelectService}
								</div>
								<br>
								<div id="iLocalite_3" class="clearfix">
									{$oData.zSelectSouService}
								</div>
								<br>
								<div id="iLocalite_4" class="clearfix">
									{$oData.zSelectDivision}
								</div>
								<br>
				</fieldset>
			</div>
			
		</form>
</div>
{literal}
<style>

.Cv-form .fileChange {
    padding: 10px 0;
}

.Cv-form .fileChange label {
    position: absolute;
    z-index: 100;
    top: 115px;
    left: 20px;
    background: #3c5a2c;
    color: #fff;
    display: inline-block;
    width: 100px;
    cursor: pointer;
    padding: 7px;
    text-align: center;
    border-radius: 3px;
    border: 1px solid #000;
}


</style>
<script type="text/javascript">
function imageChange(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#userLeftPhoto').attr('src', e.target.result);
			$('#userLeftPhoto').attr('setLb', "1");
		}

		reader.readAsDataURL(input.files[0]);
	}
}

function changeRegion(){
    var valeur = $('#iRegionId').val();
    $.ajax({
             url: zBasePath + "json/district/"+valeur,
             type: 'get',
             success: function(data, textStatus, jqXHR) {
                   var obj = $.parseJSON(data);
                   $('#district').html('');
                   var select_option ='';
                   var exist = false;
                   select_option += '<option value="0">S&eacute;l&eacute;ctionner un district</option>';
                   obj.forEach(function(module) {
                       select_option += '<option value="'+module['id']+'">&nbsp;&nbsp;'+module['libele']+'</option>';
                       exist = true;
                   });
                   if(exist)
                	  /* select_option += '<option value="0">AUTRES</option>';*/
                   $('#iDistrictId').html(select_option);
             },
             async: false
     });
 }

$(document).ready (function ()
{
	$("#zPhone").mask("999 99 999 99");
});
</script>
{/literal}