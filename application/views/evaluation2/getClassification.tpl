<tr>
<th width="40%">CRITERES</th>
<th width="60%" colspan="2">NOTES</th>
</tr>
{assign var=iTest value="0"}
{foreach from=$toCritereCroup item=oCritereCroup }
<input type="hidden" class="lesNotes" name="note-{$oCritereCroup.critere_id}" id="note-{$oCritereCroup.critere_id}" zCritereId="{$oCritereCroup.critere_id}" zLibelle="{$oCritereCroup.critere_libelle}"  value="">

{if $iTest != $oCritereCroup.critere_groupeId}
{assign var=iTest value=$oCritereCroup.critere_groupeId}
<tr style="background:linear-gradient(#5db7d0,#1c6473);color:white">
	<td style="text-align:center;color:white" colspan="2">{$oCritereCroup.groupeCritere_libelle}</td>
</tr>
{/if}
{if $oCritereCroup.critere_groupeId == 2} {* ponctualité *}
	{if $iMoyenneUserInfoPointage != ''}
	<tr>
		<td style="width:40%!important;padding:15px;"><strong>{$oCritereCroup.critere_libelle}</strong></td>
		<td class="etoile">
			<table class="notationCritere" style="width:100%">
			<tr>
				<td style="width:100%;padding-left:10px!important;" colspan="3">
				<p style="font-size:13px;color:red"> Aperçu note Pointage électronique : {$iMoyenneUserInfoPointage}<br/></p>
				<p>&nbsp;</p>
				<p class="check"><input type="checkbox" class="form-control" checked="checked" id="iManuel"  name="iManuel" value="1"><label>Saisie manuelle (si decochée la note sera la moyenne dans le pointage électronique)</label></p></td>
			</tr>
			<tr id="noteManuel" >
				<td class="leftTD" id="{$oCritereCroup.critere_id}"><div class="ratebox" id="starss_{$oCritereCroup.critere_id}" data-id="{$oCritereCroup.critere_id}" data-rating="0"></div></td>
				<!--<td  style="width:20%;vertical-align:middle;font-weight:bold;text-align:left;padding-left:10px;border:none!important" id="live-rating-{$oCritereCroup.critere_id}"></td>-->
				<td class="RightTD" id="live-rating1-{$oCritereCroup.critere_id}">
					<input type="text" maxlength="4" class="inputChange" name="input_{$oCritereCroup.critere_id}"  style="width:50%" idInput="{$oCritereCroup.critere_id}" value="">
				</td>
				<td class="lastTD" >&nbsp;&nbsp;/&nbsp;5</td>
			</tr>
			</table>
		</td>
	</tr>
	{else}
		<tr>
			<td style="width:40%!important;padding:15px;"><strong>{$oCritereCroup.critere_libelle}</strong></td>
			<td class="etoile">
				<table class="notationCritere">
				<tr>
					<td class="leftTD" id="{$oCritereCroup.critere_id}"><div id="starss_{$oCritereCroup.critere_id}" class="ratebox" data-id="{$oCritereCroup.critere_id}" data-rating="0"></div></td>
					<!--<td  style="width:20%;vertical-align:middle;font-weight:bold;text-align:left;padding-left:10px;border:none!important" id="live-rating-{$oCritereCroup.critere_id}"></td>-->
					<td class="RightTD" id="live-rating1-{$oCritereCroup.critere_id}">
						<input type="text" maxlength="4" class="inputChange" class="form-control" name="input_{$oCritereCroup.critere_id}" style="width:50%" idInput="{$oCritereCroup.critere_id}" value="">
					</td>
					<td class="lastTD" >&nbsp;&nbsp;/&nbsp;5</td>
				</tr>
				</table>
			</td>
		</tr>
	{/if}
{else}
<tr>
<td style="width:40%!important;padding:15px;"><strong>{$oCritereCroup.critere_libelle}</strong></td>
<td class="etoile">
	<table class="notationCritere" style="border:none;">
	<tr>
		<td class="leftTD" id="{$oCritereCroup.critere_id}"><div class="ratebox" id="starss_{$oCritereCroup.critere_id}" data-id="{$oCritereCroup.critere_id}" data-rating="0"></div></td>
		<!--<td  style="width:20%;vertical-align:middle;font-weight:bold;text-align:left;padding-left:10px;border:none!important" id="live-rating-{$oCritereCroup.critere_id}"></td>-->
		<td class="RightTD" id="live-rating1-{$oCritereCroup.critere_id}">
			<input type="text" class="inputChange" maxlength="4" id="input_{$oCritereCroup.critere_id}" style="width:50%" name="input_{$oCritereCroup.critere_id}" idInput="{$oCritereCroup.critere_id}" value="">
		</td>
		<td class="lastTD">&nbsp;&nbsp;/&nbsp;5</td>
	</tr>
	</table>
</td>
</tr>
{/if}


{/foreach}
<input type="hidden" name="iMoyenneUserInfoPointage" id="iMoyenneUserInfoPointage" value="{$iMoyenneUserInfoPointage}">
{literal}
<style>
/*#noteCritere th { 
border: 1px solid #e2e2e2;
text-align:center;
background: #357c6e;
font-weight:bold;
}

#noteCritere td { 
border: 1px solid #e2e2e2;
color: #3d423e;
background: none!important;
}*/
.notationCritere td.leftTD {
	padding-left:0px!important;
	padding-right:0px!important;
	width:40%!important;
	padding-left:10px!important;
	border:none!important;
}

.notationCritere td {
	border: 1px solid white!important;
}

.notationCritere td.RightTD {
	padding-left:0px!important;
	padding-right:0px!important;
	width:30%!important;
	text-align:left;
	vertical-align:middle;
	font-weight:bold;
	text-align:right;
	padding-left:10px;
	border:none!important;
}

.notationCritere td.lastTD {
	padding-left:0px!important;
	padding-right:0px!important;
	width:30%;
	text-align:left;
	vertical-align:middle;
	border:none!important;
}

.notationCritere tr {
	background:none!important;
}

tbody > tr:nth-of-type(odd) {
    background-color: white!important;
}

#noteCritere {
margin:0!important ;
font-size:1em!important;
}
.notationCritere
{
	margin:0!important ;
	border:none!important;
}

.etoile
{
	padding:5px!important ;
}
</style>
<script>
function rateAlert(id, rating)
{
	zAffichageRating = rating.toFixed(1) ; 

	$("#note-" + id).val(zAffichageRating);
	$("#input_" + id).val(zAffichageRating);
	$("#starss_"+id).attr("data-id", id);
	$("#starss_"+id).attr("data-rating", zAffichageRating);
	//$("#live-rating-" + id).html("<strong>" + zAffichageRating + " / 5</strong>");
}

function isFloat(n){
    return n === +n && n !== (n|0);
}

/* Here we initialize raterater on our rating boxes
 */
$(function() {
    $("#userANoteId").val({/literal}{$oCandidat.0->user_id}{literal});
	$( '.ratebox' ).raterater( { 
		submitFunction: 'rateAlert', 
		allowChange: true,
		starWidth: 50,
		spaceWidth: 5,
		numStars: 5
	} );

	//setValue(1, 5);
	//$('.raterater-input[data-id="1"]').data('input').val(5).change(); 
	$(".inputChange").bind("keyup change", function(e) {
		var iStars = $(this).val();

		if (isNaN(iStars)==false){
			iStars = eval(iStars);
			if (iStars == undefined)
			{
				iStars = 0;
			} 
			if ((parseFloat(iStars) || parseInt(iStars) || iStars=='') &&  iStars <= 5 )
			{
				var iIdStars = $(this).attr("idInput");

				$("#starss_"+iIdStars).attr("data-id", iStars);
				$("#starss_"+iIdStars).attr("data-rating", iStars);
				$("#note-" + iIdStars).val(iStars);
				//$("#live-rating-" + iIdStars).html("<strong>" + iStars + " / 5</strong>");
				$( '.ratebox' ).raterater( { 
					submitFunction: 'rateAlert', 
					allowChange: true,
					starWidth: 50,
					spaceWidth: 5,
					numStars: 5
				} );
			} else {
				alert("la valeur entrée n'est pas correcte");
				$(this).val('');
			}
		} else {
			alert("la valeur entrée n'est pas correcte"); 
			$(this).val('');
			var iIdStars = $(this).attr("idInput");

			$("#starss_"+iIdStars).attr("data-id", 0);
			$("#starss_"+iIdStars).attr("data-rating", 0);
			$("#note-" + iIdStars).val('');
			//$("#live-rating-" + iIdStars).html("<strong>" + iStars + " / 5</strong>");
			$( '.ratebox' ).raterater( { 
				submitFunction: 'rateAlert', 
				allowChange: true,
				starWidth: 50,
				spaceWidth: 5,
				numStars: 5
			} );
		}
		
	});

	$('#iManuel').click(function(){
		
		var iValue = $('#iManuel').is(':checked');  

		switch (iValue) {
			case true:
				$("#noteManuel").show();
				break;

			case false:
				$("#noteManuel").hide();
				break;
		}

		
	});

	

})
</script>
{/literal}

