<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/gcap/css/app/select2.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/gcap/js/app/select2.js"></script>
 <style>
 	.modal-header .modal-footer{
 		background : #91c149;
 	}
 </style>
 <div id="content-wrap" class="row"> 
  <div class="col-md-12">
		<br>
	<div class="row separateur"><div class="col-md-12">Modification localité de service (Département / direction / service)</div></div>
	<br>
	<form action="<?php echo base_url(). "gcap/search_matricule"; ?>" method="post">
	<input type="hidden" name="idSelect" id="idSelect" value="">
	<input type="hidden" name="textSelect" id="textSelect" value="">

	<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2">
				<select class="form-control" name="type" onchange="changeMask()" id="type">
					<option value="im">MATRICULE</option>
					<option value="cin">CIN</option>
				</select>
			</div>
			
			<div class="col-md-2">
				<input class="form-control" placeholder="matricule ou CIN" name="im" id="num"/>
			</div>
			
			<div class="col-md-4"></div>
	</div>
	<br>
	<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" id="searchCandidat" style="display:block">
				<input placeholder="Veuillez entrer le nom de l'agent" type="text" id="zCandidatSearch" name="zCandidatSearch">
			</div>
	</div>
	<br>
	<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2"><button class="form-control">Rechercher</button></div>
	</div>
	</form>
	<br>
   </div>	
 </div>
   <script type="text/javascript">
   		$("#num").mask("999999"); 
		$("#phone").mask("999 99 999 99"); 
		$("#cin").mask("999 999 999 999");
   		function changeMask(){
   			var type = $("#type").val(); 
   			if(type=="cin")
   				$("#num").mask("999 999 999 999");
   			else
   				$("#num").mask("999999");   
   	   	}

		$(document).ready (function ()
		{
		
			var dataArrayAgent = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
			
			$("#zCandidatSearch").select2
			({
				initSelection: function (element, callback)
				{
					
					$(dataArrayAgent).each(function()
					{
						if (this.id == element.val())
						{
							callback(this);
							return
						}
					})
				},
				allowClear: true,
				placeholder:"Sélectionnez",
				minimumInputLength: 3,
				multiple:false,
				formatNoMatches: function () { return $("#AucunResultat").val(); },
				formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
				formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
				formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
				formatSearching: function () { return "Recherche..."; },			
				ajax: { 
					url: "<?php echo base_url();?>gcap/candidat/",
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

			$("#zCandidatSearch").select2('val',$("#idSelect").val());
		});

   </script>