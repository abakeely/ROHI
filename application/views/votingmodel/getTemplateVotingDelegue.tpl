<script type="text/javascript" src="{$zBasePath}assets/common/js/app/main.js"></script>
<input type="hidden" name="iUserId" id="iUserId" value="{$iUserId}">
<p>&nbsp;</p>
<div>
		<form class="Cv-form" id="votingMeriteAgent" action="{$zBasePath}votingdelegue/save" method="post" enctype="multipart/form-data">
			<div id="miseDispo" class="col-md-12">
				<fieldset style="padding-left : 3% !important">
					<div class="clearfix"></div>
							{assign var=iIncrement value="1"}
							{if sizeof($toAVoter)>0}
							{foreach from=$toAVoter item=oAVoter}
							<div class=" clearfix">
								<div class="cell1" style="font-size:16px;">
									<div class="field">
										<label></label>
										<input type="checkbox" name="agentVoting{$iIncrement}" class="checkTest" id="agentVoting{$iIncrement}" value="{$oAVoter.user_id}">&nbsp;{$oAVoter.matricule} : {$oAVoter.nom}&nbsp;{$oAVoter.prenom}
									</div>
								</div>
							</div>
							{assign var=iIncrement value=$iIncrement+1}
							{/foreach}
							{else}
							<tr><td style="text-align:center;" colspan="7">Aucun enregistrement correspondant</td></tr>
							{/if}
							<div class=" clearfix">
								<div class="cell">
									<div class="field">
										&nbsp;
									</div>
								</div>
							</div>
								
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

{/literal}
</style>