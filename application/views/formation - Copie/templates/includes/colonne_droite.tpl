{literal}
<script type="text/javascript">
	var zBasePath = '{/literal}{$zBasePath}{literal}';
	var iUserIdConnect = {/literal}{$oUser.id}{literal};
</script>

{/literal}
<script src="{$zBasePath}assets/sau/js/moment.min.js"></script>
<script src="{$zBasePath}assets/sau/js/fullcalendar.min.js"></script>
<script src="{$zBasePath}assets/sau/js/bootbox.js"></script>
<script src="{$zBasePath}assets/sau/js/lang-all.js"></script>
<script src="{$zBasePath}assets/sau/js/getcalendar.js?sdsd"></script>
{literal}
<style>
@media only screen and (max-width: 1300px) {
	#mon-agenda{ display:none;};
	#mainContent { margin-right:15px:display:inline;};
}

@media only screen and (min-width: 1301px) {
	#mainContent { margin-right:260px};
}
</style>
<script>

$(document).ready (function ()
{
	 if ($( window ).width() <= 1300) { 
			$("#mon-agenda").hide();
			$("#mainContent").css( { marginRight : "15px" } );
	 } else {
		{/literal}{if $iAfficheAgenda==1}{literal}
		$("#mainContent").css( { marginRight : "260px" } );
		{/literal}{else}{literal}
		$("#mainContent").css( { marginRight : "15px" } );
		{/literal}{/if}{literal}
	 }

	$( window ).resize(function() {
		if ($( window ).width() <= 1300) { 
			$("#mon-agenda").hide();
			$("#mainContent").css( { marginRight : "15px" } );
		} else {
			$("#mon-agenda").show();
			{/literal}{if $iAfficheAgenda==1}{literal}
			$("#mainContent").css( { marginRight : "260px" } );
			{/literal}{else}{literal}
			$("#mainContent").css( { marginRight : "15px" } );
			{/literal}{/if}{literal}
		}
	});
})
</script>
{/literal}
<div id="mon-agenda" {if $iAfficheAgenda==0} style="display:none;" {/if}>
	<div id="zavatra">
		<div class="widget-header">
			<img class="showCommuniquer" width="25" style="cursor:pointer" src="{$zBasePath}assets/gcap/images/right-round-xxl.png">
			<img class="showCalendar" width="25" style="cursor:pointer" src="{$zBasePath}assets/gcap/images/left-round-xxl.png">
			<h4 class="smaller">Chronologie</h4>
			<img class="AddEvent dialog-add_event" style="cursor:pointer" width="25" src="{$zBasePath}assets/gcap/images/plus.png">
		</div>
			<div id="contentEventAll">
			{if sizeof($toAllEvent)>0}
			{assign var=iIncrement value="0"}
				{foreach from=$toAllEvent item=oAllEvent }
				<div {if $iIncrement%2!=0} id="tojo" {/if} class="parentAgenda" {if $iIncrement%2!=0} style="padding-top:0px;" {/if}>
					<div class="enteteEvenement">
						<h4 class="media-heading">
							<a href="#" class="blue"> <p>- {$oAllEvent.evenement_intitule|ucFirst|truncate:32:"...":true}</p></a>
						</h4>
						{if $oAllEvent.evenement_id !=''}<img class="delEvent" iEventId="{$oAllEvent.evenement_id}" style="cursor:pointer" width="15" src="{$zBasePath}assets/gcap/css/delete.png">{/if}
					</div>
					<div class="media search-media {if $oAllEvent.evenement_degre==1}cadreViolet{elseif $oAllEvent.evenement_degre==2}cadreBleu{else}cadreRose{/if}">
						<div class="media-body11 {if $iIncrement%2!=0}rightBody{/if} {if $oAllEvent.evenement_degre==1}cadreViolet {elseif $oAllEvent.evenement_degre==2}cadreBleu{else}cadreRose{/if} {if $oAllEvent.delai==3}delai{/if}">
							<div class="{if $iIncrement%2==0}content{else}content1{/if}">
								
								{if $oAllEvent.evenement_image != ''}
									<p style="text-align:center!important;">
									{$oAllEvent.evenement_image}
								{else}
									<p>
									{$oAllEvent.evenement_desccription|truncate:65:"...":true}<br>
								{/if}
								{if $oAllEvent.evenement_dateFin != ""}
								<span style="font-size:0.8em">{$oAllEvent.evenement_dateDeb|date_format:"%d/%m/%Y"} - {$oAllEvent.evenement_dateFin|date_format:"%d/%m/%Y"}</span>
								{/if}
								</p>
							</div>
						</div>
						<div class="{if $iIncrement%2==0}cadre3{else}cadre4{/if} {if $oAllEvent.evenement_degre==1}cadreViolet{elseif $oAllEvent.evenement_degre==2}cadreBleu{else}cadreRose{/if}">
						</div>
					</div>
					<span class="calendar {if $iIncrement%2!=0}calendar1{/if}">{$oAllEvent.evenement_dateDeb|date_format:"%d"} <em class="{if $oAllEvent.evenement_degre==1}cadreViolet{elseif $oAllEvent.evenement_degre==2}cadreBleu{else}cadreRose{/if}">{$oAllEvent.evenement_dateDeb|date_format:"%m"|datecourt}</em></span>
					<div class="piedEvenement">
						<p><b>Lieu :</b> {$oAllEvent.evenement_lieu}</p>
					</div>
				</div>
				{assign var=iIncrement value=$iIncrement+1}
				{/foreach}
			{else}
				<div class="parentAgenda">
					<div class="media ">
						<div class="media-body11" style="width:100%">
							<img class="flecheEvent" width="50" src="{$zBasePath}assets/gcap/css/arrow.png">
							<div class="content" style="padding:75px 10px 10px 10px;font-size:1.4em">
								<p>Veuillez cliquer sur le bouton "+" pour ajouter un événement</p>
							</div>
						</div>
						</div>
					</div>
				</div>
			{/if}
			</div>
	</div>
</div>
<div id="dialogEvent" style="background: white url({$zBasePath}assets/gcap/css/wood2.jpg) 0 500px repeat-y;">
</div>


