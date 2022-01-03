<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" name="viewport"/>
    <title>ROHI {if $zTitle!=''}- {$zTitle}{/if}</title>
    <!-- ace styles -->
    <link rel="stylesheet" href="{$zBasePath}assets/common/css/bootstrap.min.css?{$zClearCache}" />
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/fullcalendar.min.css?{$zClearCache}" />
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/app/select2.css?{$zClearCache}">
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/vendor/jquery-ui.css?{$zClearCache}?sdsds" >
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/vendor/font-awesome.min.css?{$zClearCache}" >
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/agenda.css?{$zClearCache}">
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/formation/zoom.css?{$zClearCache}">

    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/jquery.ferro.ferroMenu.css?{$zClearCache}">
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/jquery.bxslider.min.css?{$zClearCache}">
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/app/app.css?{$zClearCache}">
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/aria-tooltip.css?{$zClearCache}">
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/style_rohi.css?{$zClearCache}">
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/jquery.alerts.css?{$zClearCache}">


    <style>
        {literal}
        /*body {
            background-color:transparent ;
            background-repeat:no-repeat;
        }*/
        /*th, td {
            width: 0px!important;
        }*/

        .select2-drop-active {z-index:1000000000!important}
        a:hover {color: white!important;}
        {/literal}
    </style>
    {if !empty($oRowUserTheme)>0}
        <link rel="stylesheet" id="theming" type="text/css" href="{$zBasePath}assets/common/css/{$oRowUserTheme.0.fondPage_photo}.css?{$zClearCache}?sdsfs1122" datatype="style1">
        <link rel="stylesheet" id="stickyF" type="text/css" href="{$zBasePath}assets/common/css/stickymenu-{$oRowUserTheme.0.fondPage_photo}.css?{$zClearCache}?333">
    {else}
        <link rel="stylesheet" id="theming" type="text/css" href="{$zBasePath}assets/common/css/themepurple.css?{$zClearCache}?dfdfd1122" datatype="style1">
        <link rel="stylesheet" id="stickyF" type="text/css" href="{$zBasePath}assets/common/css/stickymenu-themepurple.css?{$zClearCache}?333">
    {/if}
    <link href="//fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <script type="text/javascript" src="{$zBasePath}assets/common/js/jquery-1.12.4.min.js"></script>
    <script>
        var $ = jQuery = jQuery.noConflict();
    </script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{base_url('/application/modules/evaluations/assets/css/bootstrap.min.css')}?_={$utils::encrypt($smarty.now)}">
    <link rel="stylesheet" href="{base_url('/application/modules/evaluations/assets/css/main.css')}?_={$utils::encrypt($smarty.now)}">
    <link rel="stylesheet" href="{base_url('/application/modules/evaluations/assets/css/main-dev.css')}?_={$utils::encrypt($smarty.now)}">
    <link rel="stylesheet" href="{base_url('/application/modules/evaluations/assets/css/fa/css/all.min.css')}?_={$utils::encrypt($smarty.now)}">
    {block name='commonCSS'}{/block}
</head>
{*<body {if !empty($oRowUserTheme)>0 && $oRowUserTheme.0.fondPage_couleur!=""} style="background-image:url('{$zBasePath}assets/common/img/{$oRowUserTheme.0.fondPage_couleur}')" {else} style="background-image:url('{$zBasePath}assets/common/img/bg1.jpg')" {/if}>*}
{if !empty($oRowUserTheme)>0}
{if $oRowUserTheme.0.fondPage_couleur !=''}
<body style="background:url('{$zBasePath}assets/common/img/{$oRowUserTheme.0.fondPage_couleur}.jpg?{$zClearCache}');background-size: auto;background-attachment: fixed;">
{else}
<body style="background:url('{$zBasePath}assets/common/img/{$oRowUserTheme.0.fondPage_photo}-fond.jpg?{$zClearCache}');background-size: auto;background-attachment: fixed;">
{/if}
{else}
<body style="background:url('{$zBasePath}assets/common/img/themepurple-fond.jpg');background-size: auto;background-attachment: fixed;">
{/if}
<div id="chargement"> <span id="chargement-infos"></span></div>