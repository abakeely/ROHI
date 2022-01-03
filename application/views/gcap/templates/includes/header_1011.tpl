<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" name="viewport"/>
    <title>ROHI - GCAP</title>
	<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/vendor/jquery-ui.css" >
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/vendor/font-awesome.min.css" >
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/app/app.css">
	<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/app/select2.css">

	<script type="text/javascript" src="{$zBasePath}assets/gcap/js/vendor/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/gcap/js/vendor/jquery-ui.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main_save.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/select2.js"></script>

</head>
<body>
    <header id="mainHeader">
        <div id="mainHeaderTop">
            <div class="logo">
                <div><span><img src="{$zBasePath}assets/gcap/images/def3.jpg" alt=""></span></div>
            </div>
            <div class="info" style="padding-right:20%;padding-left:20%">
                {foreach from=$oModuleActif item=oModuleActif }
				<h1>{$oModuleActif.module_entete}</h1>
                <hr>
                <p>{$oModuleActif.module_descriptionEntete}</p>
				{/foreach}
            </div>
			<div class="logo">
                <div><span><img src="{$zBasePath}assets/gcap/images/def2.jpg" alt=""></span></div>
            </div>
        </div>
        <div id="mainHeaderBottom">
            <p><a href="#" title="">{$oCandidat[0]->nom}&nbsp;{$oCandidat[0]->prenom} <span><img src="{$zBasePath}assets/gcap/images/user.jpg" alt=""></span></a></p>
			<form name="setCompte" id="setCompte" action="{$zBasePath}gcap/setSessionCompte" method="POST">
				<input type="hidden" name="zUrlRedirect" id="zUrlRedirect" value="{$zUrl}">
				<fieldset>
						<div class="field">
							<select name="iCompteId" id="iCompteId" style="width:200px;" onChange="document.setCompte.submit();">
								<option  {if $iSessionCompte == 1} selected="selected" {/if} value="1">Compte Agent</option>
									{foreach from=$toComptes item=oComptes }
										<option  {if $iSessionCompte == $oComptes.compte_id} selected="selected" {/if} value="{$oComptes.compte_id}">{$oComptes.compte_libelle}</option>
									{/foreach}
							</select>
						</div>
				</fieldset>
				</form>
        </div>
        <div id="mainHeaderMenu">
            <nav>
				<ul style="text-align:left;padding-left:25%;">
				{assign var="iTest" value="0"}
				{assign var="i" value="1"}
				{foreach from=$toMenus item=oMenus }
				
				{if  $oMenus.page_parent != 0}

					{if $i == 1}
						{if $iTest == 0}
						 {assign var="iTest" value="1"}
						{/if}
						
					<ul style="width:230px;">
					{assign var="i" value="0"}
					{/if}
				{else}
					{assign var="i" value="1"}
					{if $iTest == 1}

					</ul>
					{/if}
				{/if}
				<li {if $oData.menu == $oMenus.page_id}class="active"{/if}><a {if $oMenus.page_target==1} target="_blank" {/if} href="{$zBasePath}{$oMenus.page_url}"><i class="fa {$oMenus.page_icone}"></i>&nbsp;&nbsp;{$oMenus.page_libelle}</a>

				{if  $oMenus.page_parent != 0}
				</li>
				{/if}
				{/foreach}
				</ul></li>
            </nav>
        </div>
    </header>