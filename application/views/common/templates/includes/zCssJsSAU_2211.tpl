<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" name="viewport"/>
    <title>ROHI {if $zTitle!=''}- {$zTitle}{/if}</title>
    <!-- ace styles -->

    <link rel="stylesheet" href="{$zBasePath}assets/common/css/bootstrap.min.css?{$zClearCache}" />
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/fullcalendar.min.css?{$zClearCache}" />

    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/app/app.css?{$zClearCache}">
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/app/select2.css?{$zClearCache}">
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/vendor/jquery-ui.css?{$zClearCache}?sdsds" >
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/vendor/font-awesome.min.css?{$zClearCache}" >
	
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/agenda.css?{$zClearCache}">

    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/jquery.ferro.ferroMenu.css?{$zClearCache}">
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/jquery.bxslider.min.css?{$zClearCache}">
	<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/slick-theme.css?{$zClearCache}">
	<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/aos.css?{$zClearCache}">
	<!--<link rel="stylesheet" href="{$zBasePath}assets/sau/css/bootstrap.min.css?{$zClearCache}" />-->
	<!--<link rel="stylesheet" href="{$zBasePath}assets/sau/css/fonts.googleapis.com.css?{$zClearCache}" />-->
	<link rel="stylesheet" href="{$zBasePath}assets/common/css/ace.min.css?{$zClearCache}" class="ace-main-stylesheet" id="main-ace-style" />

	<!--[if lte IE 9]>
	<link rel="stylesheet" href="{$zBasePath}assets/sau/css/ace-part2.min.css?{$zClearCache}" class="ace-main-stylesheet" />
	<![endif]-->
	<link rel="stylesheet" href="{$zBasePath}assets/sau/css/ace-skins.min.css?{$zClearCache}" />
	<link rel="stylesheet" href="{$zBasePath}assets/sau/css/ace-rtl.min.css?{$zClearCache}" />
	<link rel="stylesheet" href="{$zBasePath}assets/sau/css/jquery.alerts.css?{$zClearCache}" />
	<link rel="stylesheet" href="{$zBasePath}assets/sau/css/blue.css?{$zClearCache}">
	
	<script type="text/javascript" src="{$zBasePath}assets/common/js/vendor/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/pageloader.js"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/vendor/jquery-ui.js"></script>
    <script src="{$zBasePath}assets/common/js/bootstrap.min.js"></script>
    <script src="{$zBasePath}assets/common/js/jquery.ferro.ferroMenu-1.2.3.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/app/main.js"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/app/main_save.js"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/app/select2.js"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/dataTables.bootstrap.js"></script>
	 <script type="text/javascript" src="{$zBasePath}assets/common/js/slick.min.js?{$zClearCache}"></script>
	<script type="text/javascript" src="{$zBasePath}assets/common/js/aos.js?{$zClearCache}"></script>
	<!-- ace settings handler -->
	<script src="{$zBasePath}assets/sau/js/ace-extra.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/pointage/css/vendor/font-awesome.min.css?{$zClearCache}" >
	<script type="text/javascript" src="{$zBasePath}assets/sau/app/js/app/main.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/sau/app/js/app/main_save.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/sau/js/icheck.min.js"></script>

    <script type="text/javascript">
		{literal}
        $(document).ready(function() {
            $.pageLoader();
			var zBasePathTheme = "{/literal}{$zBasePath}{literal}assets/common/" ; 
        });
		{/literal}
    </script>
    <script src="{$zBasePath}assets/common/js/site.js?{$zClearCache}" type="text/javascript"></script>
    <style>
		{literal}
        body {
            background-color:transparent ;
            background-repeat:no-repeat;
        }
		{/literal}
    </style>
    {if sizeof($oRowUserTheme)>0}
		<link rel="stylesheet" id="theming" type="text/css" href="{$zBasePath}assets/common/css/{$oRowUserTheme.0.fondPage_photo}.css?{$zClearCache}" datatype="style1">
		<link rel="stylesheet" id="stickyF" type="text/css" href="{$zBasePath}assets/common/css/stickymenu-{$oRowUserTheme.0.fondPage_photo}.css?{$zClearCache}?333">
	{else}
		<link rel="stylesheet" id="theming" type="text/css" href="{$zBasePath}assets/common/css/style.css?{$zClearCache}" datatype="style1">
		<link rel="stylesheet" id="stickyF" type="text/css" href="{$zBasePath}assets/common/css/stickymenu-style.css?{$zClearCache}?333">
	{/if}
	
</head>
{*<body {if sizeof($oRowUserTheme)>0 && $oRowUserTheme.0.fondPage_couleur!=""} style="background-image:url('{$zBasePath}assets/common/img/{$oRowUserTheme.0.fondPage_couleur}')" {else} style="background-image:url('{$zBasePath}assets/common/img/bg1.jpg')" {/if}>*}
{if sizeof($oRowUserTheme)>0}
{if $oRowUserTheme.0.fondPage_couleur !=''}
<body style="background:url('{$zBasePath}assets/common/img/{$oRowUserTheme.0.fondPage_couleur}.jpg?{$zClearCache}');background-size: auto;background-attachment: fixed;">
{else}
<body style="background:url('{$zBasePath}assets/common/img/{$oRowUserTheme.0.fondPage_photo}-fond.jpg?{$zClearCache}');background-size: auto;background-attachment: fixed;">
{/if}
{else}
<body style="background:url('{$zBasePath}assets/common/img/style-fond.jpg');background-size: auto;background-attachment: fixed;">
{/if}
<div id="chargement"> <span id="chargement-infos"></span></div>