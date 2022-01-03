<table id="noteCritere" border="1">
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
  <tr>
		<td style="padding:15px;"><strong>{$oCritereCroup.critere_libelle}</strong></td>
		<td class="etoile">
			<table class="notationCritere" style="width:100%">
			<tr>
				<td style="width:100%" colspan="2"><p class="check"><input type="checkbox" id="iManuel"  name="iManuel" value="1"><label>Saisie manuelle (si decochée la note sera la moyenne dans le pointage électronique)</label></p></td>
			</tr>
			<tr id="noteManuel" style="display:none;width:100%">
				<td style="width:40%;border:none!important" id="{$oCritereCroup.critere_id}"><div class="ratebox" data-id="1" data-rating="0"></div></td>
				<td  style="width:60%;vertical-align:middle;font-weight:bold;text-align:left;padding-left:10px;border:none!important" id="live-rating-{$oCritereCroup.critere_id}"></td>
			</tr>
			</table>
		</td>
  </tr>
  {else}
  <tr>
	<td style="padding:15px;"><strong>{$oCritereCroup.critere_libelle}</strong></td>
	<td class="etoile">
		<table class="notationCritere">
		<tr>
			<td style="width:60%;border:none!important" id="{$oCritereCroup.critere_id}"><div class="ratebox" data-id="1" data-rating="0"></div></td>
			<td  style="width:40%;vertical-align:middle;font-weight:bold;text-align:left;padding-left:10px;border:none!important" id="live-rating-{$oCritereCroup.critere_id}"></td>
		</tr>
		</table>
	</td>
  </tr>
  {/if}
  {/foreach}
</table>
{literal}
<style>
#noteCritere th { 
	border: 1px solid #e2e2e2!important;
	text-align:center;
	background: #357c6e;
	font-weight:bold;
}

#noteCritere td { 
	border: 1px solid #e2e2e2!important;
	color: #3d423e;
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
input[type=radio] {
    height:20px;
	width:20px; 
	vertical-align: middle;
}
</style>
{/literal}