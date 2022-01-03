<!DOCTYPE html>
<html style="font-size: 16px" lang="fr"> {*For Garina chat-ui, just add style="font-size: 16px" as shown here to your file version*}
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>ROHI {if $zTitle!=''}- {$zTitle}{/if}</title>

		    <!-- ace styles -->
		<!--<link rel="stylesheet" href="{$zBasePath}assets/common/css/bootstrap4.css?{$zClearCache}" />-->
		
		<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/fullcalendar.min.css?{$zClearCache}" />
		<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/app/select2.css?{$zClearCache}">
		<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/vendor/jquery-ui.css?{$zClearCache}?sdsds" >
		<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/vendor/font-awesome.min.css?{$zClearCache}" >
		<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/agenda.css?{$zClearCache}">
		<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/formation/zoom.css?{$zClearCache}">

		<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/light/assets/css/chaty-front.css?{$zClearCache}">
		<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/light/assets/css/chaty-front-css.css?{$zClearCache}">
		<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/light/assets/css/style-4.css?{$zClearCache}">

		<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/jquery.ferro.ferroMenu.css?{$zClearCache}">
		<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/jquery.bxslider.min.css?{$zClearCache}">
		<!--<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/app/app.css?{$zClearCache}">-->
		<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/aria-tooltip.css?{$zClearCache}">
		<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/slick.css?{$zClearCache}">
		<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/slick_custom.css?{$zClearCache}">
		<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/slick-theme.css?{$zClearCache}">
		<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/aos.css?{$zClearCache}">
		
		<link rel="stylesheet" href="{$zBasePath}assets/common/css/bootstrap.min.css?{$zClearCache}" />

		<script type="text/javascript" src="{$zBasePath}assets/common/js/jquery-1.12.4.min.js"></script>
		<script type="text/javascript" src="{$zBasePath}assets/common/js/vendor/jquery-1.11.3.min.js"></script>
		<script type="text/javascript">
			{literal}
			$(document).ready(function() {
				var zBasePathTheme = "{/literal}{$zBasePath}{literal}assets/common/" ; 
				$("li .active").parents('li').addClass('active1');
				var zBasePath = "{/literal}{$zBasePath}{literal}";
			});
			{/literal}
		</script>
		<script type="text/javascript" src="{$zBasePath}assets/common/js/vendor/jquery-ui.js"></script>
		
		<script type="text/javascript" src="{$zBasePath}assets/common/js/aria-tooltip.js?{$zClearCache}"></script>
		<script type="text/javascript" src="{$zBasePath}assets/common/js/slick.min.js?{$zClearCache}"></script>
		<script type="text/javascript" src="{$zBasePath}assets/common/js/aos.js?{$zClearCache}"></script>

		<script src="{$zBasePath}assets/common/js/jquery.ferro.ferroMenu-1.2.3.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="{$zBasePath}assets/common/js/app/main.js?{$zClearCache}"></script>
		<script type="text/javascript" src="{$zBasePath}assets/common/js/app/main_save.js?{$zClearCache}"></script>
		<script type="text/javascript" src="{$zBasePath}assets/common/js/app/select2.js"></script>
		<script type="text/javascript" src="{$zBasePath}assets/common/js/jquery.bxslider.min.js"></script>
		<script type="text/javascript" src="{$zBasePath}assets/common/js/jquery.dataTables.js"></script>
		<script type="text/javascript" src="{$zBasePath}assets/common/js/dataTables.bootstrap.js"></script>
		<script src="{$zBasePath}assets/common/js/bootstrap.min.js"></script>
		
		<script src="{$zBasePath}assets/common/js/site.js?{$zClearCache}" type="text/javascript"></script>

		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{$zBasePath}assets/light/assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{$zBasePath}assets/light/assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{$zBasePath}assets/light/assets/css/font-awesome.min.css">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{$zBasePath}assets/light/assets/css/line-awesome.min.css">
		
		<!-- Datatable CSS -->
		<link rel="stylesheet" href="{$zBasePath}assets/light/assets/css/dataTables.bootstrap4.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{$zBasePath}assets/light/assets/css/select2.min.css">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{$zBasePath}assets/light/assets/css/bootstrap-datetimepicker.min.css">
		
		<!-- Main CSS -->
		
		{if $oRowUserTheme.0.fondPage_couleur !='' && $oRowUserTheme.0.fondPage_couleur != 'style-fond'}
		<link rel="stylesheet" class="style-default" href="{$zBasePath}assets/light/assets/css/style.css">
		{else}
		<link rel="stylesheet" class="style-default" href="{$zBasePath}assets/light/assets/css/default.css">
		{/if}
		<link rel="stylesheet" href="{$zBasePath}assets/common/css/bootstrap.min.css?20211118094705" />
		<link rel="stylesheet" id="theming" type="text/css" href="{$zBasePath}assets/common/css/themepurple.css?20211023062053?sdsfs1122" datatype="style1">
		<script src="{$zBasePath}assets/light/assets/js/datedropper-javascript.js"></script>
		<script src="{$zBasePath}assets/light/assets/js/datedropper-javascript-lang-FR.js"></script>
		
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="{$zBasePath}assets/light/assets/js/html5shiv.min.js"></script>
			<script src="{$zBasePath}assets/light/assets/js/respond.min.js"></script>
			
		<![endif]-->
    
    <style>
		{literal}
        /*body {
            background-color:transparent ;
            background-repeat:no-repeat;
        }*/
		th, td {
			width: 0px!important;
		}

		.select2-drop-active {z-index:1000000000!important}
		a:hover {color: white!important;}
		{/literal}
    </style>
	{*
    {if !empty($oRowUserTheme)>0}
		<link rel="stylesheet" id="theming" type="text/css" href="{$zBasePath}assets/common/css/{$oRowUserTheme.0.fondPage_photo}.css?{$zClearCache}?sdsfs1122" datatype="style1">
		<link rel="stylesheet" id="stickyF" type="text/css" href="{$zBasePath}assets/common/css/stickymenu-{$oRowUserTheme.0.fondPage_photo}.css?{$zClearCache}?333">
	{else}
		<link rel="stylesheet" id="theming" type="text/css" href="{$zBasePath}assets/common/css/themepurple.css?{$zClearCache}?dfdfd1122" datatype="style1">
		<link rel="stylesheet" id="stickyF" type="text/css" href="{$zBasePath}assets/common/css/stickymenu-themepurple.css?{$zClearCache}?333">
	{/if}
	*}

	<link rel="stylesheet" id="stickyF" type="text/css" href="{$zBasePath}assets/common/css/stickymenu-bas-themepurple.css?sdsdsd">

<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{$zBasePath}assets/light/assets/img/favicon.png">
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="{$zBasePath}assets/light/assets/js/html5shiv.min.js"></script>
		<script src="{$zBasePath}assets/light/assets/js/respond.min.js"></script>
	<![endif]-->
	
</head>
{*<body {if !empty($oRowUserTheme)>0 && $oRowUserTheme.0.fondPage_couleur!=""} style="background-image:url('{$zBasePath}assets/common/img/{$oRowUserTheme.0.fondPage_couleur}')" {else} style="background-image:url('{$zBasePath}assets/common/img/bg1.jpg')" {/if}>*}
{if !empty($oRowUserTheme)>0}
{if $oRowUserTheme.0.fondPage_couleur !='' && $oRowUserTheme.0.fondPage_couleur != 'style-fond'}
<body style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.6)), url({$zBasePath}assets/common/img/{$oRowUserTheme.0.fondPage_photo}.jpg);background-position:left;background-attachment: fixed;">
{/if}
{else}
<body>
{/if}


