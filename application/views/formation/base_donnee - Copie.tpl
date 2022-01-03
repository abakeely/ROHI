{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb"><a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="{$zBasePath}">Formation</a> <span>&gt;</span> <a href="{$zBasePath}formation/programmeFormation/formation/programme-formation">Reporting</a><span>&gt;</span>Base de données des agents formés</div>
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<h2>Base de données des agents formés{if $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
		&agrave; finaliser
		{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
		&agrave; imprimer
		{/if}</h2>
		
		<div class="contenuePage">

		<!--*Debut Contenue*-->
		<div class="col-xs-12">

{literal}
<style>
	
	.styled-select.slate {
   background: url({$zBasePath}assets/common/css/formation/img/1.jpg) no-repeat right center;
  
}

	.styled-select.slate select {
   border: 1px solid #ccc;
   font-size: 14px;
   height: 34px;
   width: 268px;
}

</style>
{/literal}

<link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/css/bootstrap.min.css">

<br>

<br>
  <div class="col-md-12">

  		<center>
  			<label for="lieu"></label>



  				<input type="hidden" id="saveUrl" name="saveUrl" value="">
  				<input type="hidden" name="saveLieu" id="saveLieu" value="{zBasePath}base-donnee-agent-forme/lieu/{$oData.local}">

  		   <script type="text/javascript">
  				
  				document.getElementById('saveUrl').value = window.document.location.href;
  				
  			</script>

  				<input type="hidden" name="saveAnnee" id="saveAnnee" value="{zBasePath}base-donnee-agent-forme/lieu/{$oData.local}/annee/">
	  			<!--<td class="styled-select slate"> -->
				  	<select onchange="window.document.location = document.getElementById('saveLieu').value+document.getElementById('lieu').value" id="lieu" name="lieu">
				  		<option value="">---Lieu de Formation---</option>
						<option value="1" {if (isset($oData.local) && ($oData.local == '1'))}  selected {/if} >MADAGASCAR</option>
						<option value="2" {if (isset($oData.local) && ($oData.local == '2'))}  selected {/if}>ETRANGER</option>
				  	</select>
				  	<script type="text/javascript">
				  		

				  	</script>
				
  			<label for="lieu"></label>
	  			 
				  	<select onchange="window.document.location =document.getElementById('saveUrl').value+'/annee/'+document.getElementById('annee').value" id="annee" name="annee">
				  		<option value="">---Année---</option>
				  	{foreach from=$oData.agentformeAnnee  item=oAgentformeAnnee}
						<option value="{$oAgentformeAnnee.agentforme_date}" {if (isset($oData.annee) && ($oData.annee == $oAgentformeAnnee.agentforme_date))}  selected {/if}>{$oAgentformeAnnee.agentforme_date}</option>
					{/foreach}
				  	</select>
			</center>
			<br><br>
<h3 align="center" >LISTE DES AGENTS FORMEES {if (isset($oData.local) && isset($oData.annee) && ($oData.local != '') && ($oData.annee != '') )} à {if $oData.local == '1'}MADAGASCAR{/if} {if $oData.local == '2'}ETRANGER{/if} en {$oData.annee} {/if}</h3>
<br><br>

	<table class="table table-striped table-bordered table-hover" id="table_planning" >
	   <thead>
		<tr>						
			<th class="th_livre"><font size="3"><font face="Times New Roman">LIEU DE FORMATION</font></font></th>
			<th class="th_livre"><font size="3"><font face="Times New Roman">AGENT</font></font></th>
			<th class="th_livre"><font size="3"><font face="Times New Roman">DEPARTEMENT</font></font></th>
			<th class="th_livre"><font size="3"><font face="Times New Roman">REGION</font></font></th>
			<th class="th_livre"><font size="3"><font face="Times New Roman">INTITUL&Eacute;</font></font></th>
		</tr>

	   </thead>
	   	<tbody>	
	   	{foreach from=$oData.agentforme  item=oAgentformeMada}
				<tr>
					<td><font size="2"><font face="Times New Roman">{$oAgentformeMada.agentforme_lieu}</font></font></td>
					<td><font size="2"><font face="Times New Roman">{$oAgentformeMada.agentforme_nom}{$oAgentformeMada.agentforme_prenom}</font></font></td>
					<td><font size="2"><font face="Times New Roman">{$oAgentformeMada.agentforme_departement}</font></font></td>
					<td><font size="2"><font face="Times New Roman">{$oAgentformeMada.agentforme_region}</font></font></td>
					<td><font size="2"><font face="Times New Roman">{$oAgentformeMada.agentforme_intitule}</font></font></td>
				</tr>
		{/foreach}

		</tbody>								 
	</table>	
</div>

		<div class="row"><br></div>
		<div class="row"><br></div>
			
		</div>
	</div>  
</div>
 <br><br><br><br>
 
{literal}  
<script>

    $(document).ready(function() {
       $('#table_planning').dataTable({
	   "ordering" : false
	   });	
	});	
  </script>	
{/literal}

</div>

    <!--*Fin Contenue*-->
    </div>
	</div>
	<div id="calendar"></div>
	</div>
</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>

{include_php file=$zFooter}
</div>

</body>
</html>