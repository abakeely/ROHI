<input type="hidden" name="iUserId" id="iUserId" value="{$iUserId}">
<input type="hidden" name="iUserTarget" id="iUserTarget" value="{$iUserTarget}">
<input type="hidden" name="iModeForChange" id="iModeForChange" value="{$iModeForChange}">
<input type="hidden" name="iDesevaluer" id="iDesevaluer" value="0">
<div id="evaluation-table">
<div id="information-table">
						<form enctype="multipart/form-data">
							<fieldset>
								{if $zName!=""}
								<div class="" >
									<div class="">
										<div class="field">
											<label style="text-align:center;color:green;">
											{if $zName!="" && $zMessage!=""}
											<br/>{$zName} est déjà évalué par {$zMessage}.<br/><br/>Êtes vous sûr de vouloir l'ajouter dans votre liste?<br/>
											{else}
											<br/>Êtes vous sûr de vouloir ajouter {$zName} dans votre liste?<br/>
											{/if}
											</label>
										</div>
									</div>
								</div>
								{/if}
								<div class="headblock">
								<div class="left User-photo">
									<img src="{$zPathWithPhoto}" width="200">
								</div>
								<div class="User-details">
									<div class="row" style="width:100%">
										<div class="cell">
											<div class="field">
												<label><b>Nom :</b> {$oCandidat.0->nom}</label>
												<label>Matricule : {$oCandidat.0->matricule}</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="cell small">
											<div class="field">
												<label>Pr&eacutenom(s) : {$oCandidat.0->prenom}</label>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="cell">
											<div class="field">
												
											</div>
										</div>
									</div>
								</div>
							</fieldset>
						</form>
</div>
</div>
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

.headblock .User-details-other {
    float: left;
    width: calc(100% - 150px);
    width: -moz-calc(100% - 150px);
    width: -webkit-calc(100% - 150px);
    width: -ms-calc(100% - 150px);
    z-index: 1;
    left: -40px;
    top: 10px;
    background: #ffffff;
    border-radius: 5px;
    padding: 10px 10px 10px 200px;
    text-align: left;
    position: relative;
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