{include_php file=$zCssJs}
{include_php file=$zHeader}
<div class="page-header">
	<div class="row align-items-center">
		<div class="col-12">
			<h3 class="page-title">Communiqué</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
				<li class="breadcrumb-item"><a href="{$zBasePath}">Gestion des absences</a></li>
				<li class="breadcrumb-item">Suivi des actes</li>
			</ul>
		</div>
	</div>
</div>
<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
			<div class="clear"></div>
			<div id="innerContent">
					<ul class="tabs">
						<li><a onclick="setCurent('organigramme')" href="#organigramme_link">Evaluation</a></li>
					</ul> 
				
					<div id="organigramme_link">
						{include file='application/views/eval/evaluation.tpl'}
					</div>
				
			</div>             
		</div>
	</section>
	<section id="rightContent" class="clearfix">
		{include_php file=$zRight}
	</section>
</div>
<input type="hidden" id="div_localite_curent">
<input type="hidden" id="div_structure_curent">
<input type="hidden" id="curent_page">

<div style="display:none;" id="template_structure" >
	<div class="form col-md-3" id="structure_niveau_[[source.niveau]]">
		<div class="libele_form">
			<label class="control-label label_rohi " data-original-title="" title=""><b> [[source.libelle]](*) </b></label>
		</div>
		[[#source]]
		<select class="form-control"   onChange="getChild($(this),[[source.niveau]]);"   name="[[source.name]]">
			<option  value="0">-------</option> 
			[[#list]]
			  <option value="[[child_id]]">[[child_libelle]]</option>
			[[/list]]
		</select>
		[[/source]]
	</div>
</div>

<div style="display:none;" id="template_localite" >
	<div class="form col-md-3" id="localite_niveau_[[source.niveau]]">
		<div class="libele_form">
			<label class="control-label label_rohi " data-original-title="" title=""><b> [[source.libelle]](*) </b></label>
		</div>
		[[#source]]
		<select class="form-control" onChange="getLocalite($(this),'[[source.niveau_suivant]]',[[source.niveau]]);" id="[[source.name]]_id" name="[[source.name]]">
			<option  value="0">-------</option> 
			[[#list]]
			  <option value="[[localite_id]]">[[localite_libelle]]</option>
			[[/list]]
		</select>
		[[/source]]
	</div>
</div>
{include_php file=$zFooter}
{literal}
<script>
$(document).ready(function() {
	$("#div_localite_curent").val("div_localite_organigramme");
	$("#div_structure_curent").val("div_structure_organigramme");
	$("#curent_page").val("organigramme");
	$("#innerContent" ).tabs({
		  collapsible: true
	});
});


</script>
{/literal}
</body>
</html>