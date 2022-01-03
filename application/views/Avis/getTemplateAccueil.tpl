<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<input type="hidden" name="iUserId" id="iUserId" value="{$iUserId}">
<p>&nbsp;</p>
<div>
		<form class="Cv-form" id="photoMAJ" action="{$zBasePath}cv2/saveBadge" method="post" enctype="multipart/form-data">
			<input type="hidden" id="testPhoto" name="testPhoto" value="{$iTestPhoto}">
			<div id="miseDispo" class="col-md-6">
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
											<input type="file" class="form-control" class="file_upload" name="photo" data-toggle="tooltip" data-original-title="Safidio sy ampidiro ny sarinao" onchange="imageChange(this);" id="photo" data-bv-field="photo"><i class="form-control-feedback" data-bv-icon-for="photo" style="display: none; top: 0px;"></i>
										</label>
									</div>
								</div>
								<!----------------- Fin bloc Details ---------------->
									<div class="row clearfix">
										<div class="cell"  style="width:50%">
											<div class="field"> 
												<label>CIN</label>
												<input type="text" id="iCin" class="form-control obligatoire" placeholder="cin" name="iCin" data-toggle="tooltip" data-original-title="" value="{$oReturn.0->cin}">
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="cell" style="width:100%">
											<div class="field"> 
												<label>Région</label>
												<select id="iRegionId" name="iRegionId" onChange="changeRegion()">
													<option value="0">s&eacute;l&eacute;ctionner une région</option>
													{foreach from=$toRegion item=oRegion }
													<option {if $oRegion.id == $oCandidat.0->region_id} selected="selected" {/if} value="{$oRegion.id}">&nbsp;&nbsp;{$oRegion.libele}</option>
													{/foreach}
												</select>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="cell" style="width:100%">
											<div class="field"> 
												<label>District</label>
												<select id="iDistrictId" name="iDistrictId">
													<option value="0">s&eacute;l&eacute;ctionner un district</option>
													{foreach from=$toDistrict item=oDistrict }
													<option {if $oDistrict.id == $oCandidat.0->district_id} selected="selected" {/if} value="{$oDistrict.id}">&nbsp;&nbsp;{$oDistrict.libele}</option>
													{/foreach}
												</select>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="cell" style="width:100%">
											<div class="field"> 
												<label>Batiment</label>
												<select id="iBatiment" name="iBatiment">
													<option value="0">s&eacute;l&eacute;ctionner un bâtiment</option>
													{foreach from=$toBatiment item=oBatiment }
													<option value="{$oBatiment.batiment_id}">&nbsp;&nbsp;{$oBatiment.batiment_libelle}</option>
													{/foreach}
												</select>
											</div>
										</div>
									</div>
									<div class="row col-md-6 clearfix">
											<div class="cell" style="width:90%">
												<div class="field"> 
													<label>Porte</label>
													<input type="text" id="zPorte" class="form-control obligatoire" placeholder="PORTE" name="zPorte" data-toggle="tooltip" data-original-title="" value="">
												</div>
											</div>
									</div>
									<div class="row col-md-6 clearfix">
											<div class="cell" style="width:90%">
												<div class="field"> 
													<label>Numéro de t&eacute;l&eacute;phone</label>
													<input type="hidden" id="iUserIdConnecte" name="iUserIdConnecte" value="{$iUserId}">
													<input type="hidden" id="iRedirect" name="iRedirect" value="{$iRedirect}">
													<input type="text" id="zPhone" class="form-control obligatoire" placeholder="T&eacute;l&eacute;phone" name="zPhone" data-toggle="tooltip" data-original-title="" value="{$oReturn.0->phone}">
												</div>
											</div>
									</div>
									<div class="row col-md-12">
										<div class="cell"  style="width:100%">
											<div class="field"> 
												<label>Adresse E-mail</label>
												<input type="text" id="zEmail" class="form-control obligatoire" placeholder="E-mail" name="zEmail" data-toggle="tooltip" data-original-title="" value="{$oReturn.0->email}">
											</div>
										</div>
									</div>
				</fieldset>
			</div>
			<div id="miseDispo1" class="col-md-6">
				<img src="{$zBasePath}assets/img/badge.png?20190306093547'" width="100%">
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