
        <!--*Debut Contenue*-->
		<script type="text/javascript" src="{$zBasePath}assets/common/js/app/main.js"></script>
		<form action="{$zBasePath}gcap/save/gestion-absence/demande" method="POST" name="formulaireEdit11" id="formulaireEdit11" enctype="multipart/form-data">
			<input type="hidden" id="iTypeGcapId" name="iTypeGcapId" value="">
			<input type="hidden" name="zDateToDay" id="zDateToDay" value="{$zDateToDay}">
			<input type="hidden" name="iSessionCompte" id="iSessionCompte" value="{$iCompteActif}">
			<input type="hidden" name="zMessageDate" id="zMessageDate" value="Les dates entr&eacute;es sont d&eacute;j&agrave; prise en compte dans une autre demande. Veuillez v&eacute;rifier">
			 <input type="hidden" name="idSelect" id="idSelect" value="">
			<fieldset>
			<div class="clearfix" id="typeGcap">
				<div class=" clearfix">
					<div class="cell">
						<label>S&eacute;lectionner la cat&eacute;gorie d'absence</label>
						<div class="field">
							<select id="zHashUrl" name="zHashUrl" class="form-control obligatoire" onChange="getChangeTypeSet('{$zBasePath}',this.value);">
								<option value="">Veuillez s&eacute;lectionner</option>
								{if $iCompteActif == COMPTE_AGENT}
								<option value="autorisation-abscence">Autorisation d'absence</option>
								<option value="conge">Cong&eacute;</option>
								<option value="permission">Permission</option>
								{/if}
								
								{if $iCompteActif == COMPTE_AGENT}
								<option value="mission">Mission</option>
								<option value="formation">Formation</option>
								{/if}
								<option value="repos-medical">Repos m&eacute;dical</option>
								{if $iCompteActif == COMPTE_RESPONSABLE_PERSONNEL}
								<option value="25">Cong&eacute; de pat&eacute;rnit&eacute;</option>
								<option value="26">Cong&eacute; de mat&eacute;nit&eacute;</option>
								{/if}
							</select>
						<p class="message" style="width:500px">Veuillez s&eacute;lectionner la cat&eacute;gorie d'absence</p>
						</div>
					</div>
				</div>
				<div id="setTypeAjax">
				</div>
			</div>
			<div class=" clearfix">
				<div class="cell small">
					<div class="field">
						<label>Date d&eacute;but *</label>
						<input type="text" name="date_debut" id="date_debut" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$smarty.session.zDateToDayDefault}" data-dd-opt-double-view="true" autocomplete="off" value="" placeholder="s&eacute;l&eacute;ctionner la date de d&eacute;but" class="form-control datedropper-range-fiche obligatoire" onchange="setDateFin(this.value)">
						<p class="message debut" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date de d&eacute;but</p>
					</div>
				</div>
				<div class="cell small">
					<div class="field">
						<label>Date fin *</label>
						<input type="text" name="date_fin" id="date_fin" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$smarty.session.zDateToDayDefault}" autocomplete="off" value="" placeholder="s&eacute;l&eacute;ctionner la date fin" class="form-control datedropper-range-fiche obligatoire">
						<p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date fin</p>
					</div>
				</div>
				<div class="cell small">
					<div class="field">
						<label>Demi-Journee</label>
						<div class="form-group row">
							<div class="col-md-8">
								<select id="matinSoir" name="matinSoir" class="form-control obligatoire">
									<option selected="selected" value="1">Matin</p>
									<option selected="selected" value="2">Apr&eacute;s-midi</p>
								</select>
							</div>
							<div class="col-md-4">
								<div class="checkbox">
									<label>
										<input id="iDemiJournee" type="checkbox" name="iDemiJournee" value="1"> 0,5 Jour
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class=" clearfix">
				<div class="cell">
					<div class="field">
						<label>Nom de l'int&eacute;rim</label>
						<input type="text" class="form-control" name="gcap_interim" id="gcap_interim" >
						<!--select class="form-control select"  id="gcap_interim" name="gcap_interim">
							<option value="">Sélectionner</option>
						</select-->
						<p class="message interim">Veuillez mentionner le nom de votre int&eacute;rim</p>
					</div>
				</div>
			</div>
			<div class=" clearfix">
				<div class="cell">
					<label>Lieu de jouissance</label>
					<div class="field">
						{foreach from=$oListeRegion item=toListeRegion}
							<div class="col-sm-6">
								<input type="checkbox" class="obligatoire" name="lieu_jouissance[]" value="{$toListeRegion.libele}"> {$toListeRegion.libele}<br>
							</div>
						{/foreach}
						<div class="col-sm-6" id="ascal_2019" style="display:none;">
							<input type="checkbox" class="obligatoire" name="lieu_jouissance[]" value="ASCAL 2019(Mahajanga)"> ASCAL 2019(Mahajanga)<br>
						</div>
						<div class="col-sm-6" id="asief_2019" style="display:none;">
							<input type="checkbox" class="obligatoire" name="lieu_jouissance[]" value="ASIEF 2019(DIEGO)"> ASIEF 2019(DIEGO)<br>
						</div>
						<div class="col-sm-6" id="agon_2020" style="display:none;">
							<input type="checkbox" class="obligatoire" name="lieu_jouissance[]" value="AGON(Antananarivo)"> AGON-ASCAL(Antananarivo)<br>
						</div>
						<div class="col-sm-6" id="tnt_tamatave" style="display:none;">
							<input type="checkbox" class="obligatoire" name="lieu_jouissance[]" value="TNT(TAMATAVE)"> TNT(Tamatave)<br>
						</div>
					</div>
				</div>
			</div>
		  </fieldset>
        </form>
{literal}
<style>
#formulaireEdit11 input,#formulaireEdit11 select,#formulaireEdit11 textarea,#formulaireEdit11 button  {
    font-family: Verdana,Arial,sans-serif;
    font-size: 1.2em!important;
}

form .cell {
    line-height: 20px;
}

</style>
<script>
$(document).ready (function (){
	var dataArrayAgent = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
	$("#gcap_interim").select2({
		initSelection: function (element, callback){
			$(dataArrayAgent).each(function(){
				if (this.id == element.val()){
					callback(this);
					return
				}
			})
		},
		allowClear: true,
		placeholder:"Selectionnez",
		minimumInputLength: 3,
		multiple:false,
		formatNoMatches: function () { return $("#AucunResultat").val(); },
		formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
		formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
		formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
		formatSearching: function () { return "Recherche..."; },			
		ajax: { 
			url: "{/literal}{$zBasePath}{literal}gcap/candidat/",
			dataType: 'jsonp',
			data: function (term)
			{
				return {q: term, iFiltre:1};
			},
			results: function (data)
			{
				return {results: data};
			}
		},
		dropdownCssClass: "bigdrop"
	}) ;

	$("#gcap_interim").select2('val',$("#idSelect").val());
	$("#lieu_jouissance").scrollLeft( 300 );
});
function getChangeTypeSet(_zUrl,_zHashUrl){
	var type_id =  $("#type_id").val() ;

	switch (_zHashUrl){
		case 'permission':
			$("#id-envoyer").attr("disabled","disabled");
			$("#id-envoyer").attr("style","background:#a0a0a0");
			$("#setTypeAjax").html('');
			break;

		default:
			$("#id-envoyer").removeAttr("disabled");
			$("#id-envoyer").removeAttr("style");
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}gcap/ChangeTypeSet/",
				type: 'post',
				data: {
					zUrl : _zUrl,
					zHashUrl : _zHashUrl
				},
				success: function(data, textStatus, jqXHR) {
					if( data ){
						$("#setTypeAjax").html(data);
						$("#allToltip").hide();
						event.preventDefault();
					}
				
				},
				async: false
			})
		 break;
	}
	//si le type d'abscence est mission, on affiche le choix ascal mahajanga
	$("#tnt_tamatave").hide();
	$("#agon_2020").hide();
	if( _zHashUrl == "mission") {
		$("#tnt_tamatave").show();
		$("#agon_2020").show();
		//$("#asief_2019").show();
	}
	
}

function setDateFin(p_date_debut) {
   var v_nombre_conge = 0 ;
   var type_id =  $("#type_id").val()?$("#type_id").val():$("#zHashUrl").val() ;
   if( type_id == 25 ) {
	  v_nombre_conge = 14 ;
   }
   if( type_id == 26 ) {
	  v_nombre_conge = 89 ;
   }
   if ( v_nombre_conge > 0 ){
	   $.ajax({
			url: "{/literal}{$zBasePath}{literal}json/addDays/",
			type: 'post',
			data: {
				p_date_debut : p_date_debut,
				p_days : v_nombre_conge
			},
			success: function(data, textStatus, jqXHR) {
				if( data ){
					$("#date_fin").val(data);
					$("#date_fin").attr("readonly","true") ;
				}
			},
			async: false
		});
   }
   
}
</script>
{/literal}