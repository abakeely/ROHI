<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<input type="hidden" name="iUserId" id="iUserId" value="{$iUserId}">
<p>&nbsp;</p>
<div id="">
		<form class="Cv-form" id="photoMAJ" action="{$zBasePath}cv2/savePhoto" method="post" enctype="multipart/form-data">
			<fieldset style="padding-left : 3% !important">
				<div class="clearfix"></div>
				 <!----------------- bloc Details ---------------->
                            <div class="headblock">
                                <div class="left User-photo">
									<img id="userLeftPhoto" src="{$zBasePath}assets/upload/default.jpg" setLb="0">
                                </div>

                                <div class="User-details">
                                    <div class="row" style="width:100%">
                                        <div class="cell">
                                            <div class="field">
                                                <label>&nbsp;</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="field">
                                            <label>&nbsp;</label>

                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="cell">
                                            <div class="field">
                                                <label>&nbsp;</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>

                                </div>
                                <div class="clearfix"></div>
                                <div class="fileChange">
                                    <label for="photo">Ajouter
                                        <input type="file" class="file_upload obligatoire" name="photo" data-toggle="tooltip" data-original-title="Safidio sy ampidiro ny sarinao" onchange="imageChange(this);" id="photo"  data-bv-field="photo">
                                    </label>
                                </div>
                            </div>
                            <!----------------- Fin bloc Details ---------------->
				<div class="row clearfix">
					<div class="cell"  style="width:50%">
						<div class="field"> 
							<label>T&eacute;l&eacute;phone</label>
							<input type="hidden" id="iUserIdConnecte" name="iUserIdConnecte" value="{$iUserId}">
							<input type="hidden" id="iRedirect" name="iRedirect" value="{$iRedirect}">
							<input type="text" id="zPhone" class="form-control obligatoire" placeholder="T&eacute;l&eacute;phone" name="zPhone" data-toggle="tooltip" data-original-title="" value="{$oReturn.0->phone}">
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell"  style="width:50%">
						<div class="field"> 
							<label>E-mail</label>
							<input type="text" id="zEmail" class="form-control obligatoire" placeholder="T&eacute;l&eacute;phone" name="zEmail" data-toggle="tooltip" data-original-title="" value="{$oReturn.0->email}">
						</div>
					</div>
				</div>
			</fieldset>
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
$(document).ready (function ()
{
	$("#zPhone").mask("999 99 999 99");
});
</script>
{/literal}