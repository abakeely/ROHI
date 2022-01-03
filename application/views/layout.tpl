<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{base_url('/application/modules/evaluations/assets/css/style.min.css')}?_={$utils::encrypt($smarty.now)}">
    <link rel="stylesheet" href="{base_url('/application/modules/evaluations/assets/css/main.css')}?_={$utils::encrypt($smarty.now)}">
    <link rel="stylesheet" href="{base_url('/application/modules/evaluations/assets/css/main-dev.css')}?_={$utils::encrypt($smarty.now)}">
    <!--link rel="stylesheet" href="{base_url('/application/modules/evaluations/assets/css/fa/css/all.min.css')}?_={$utils::encrypt($smarty.now)}"-->
    <title>{block name="pagetitle"}{/block}</title>
    {*$dbg->renderHead()*}
    {block name="css"}{/block}
</head>
<body>

<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>

<div id="main-wrapper" class="">

    {include file=$viewModule|cat:"common/layout/topbar.tpl"}
    {include file=$viewModule|cat:"common/layout/sidebar.tpl"}
    <div class="page-wrapper">
        {include file=$viewModule|cat:"common/layout/breadcrumb.tpl"}

        <div class="container-fluid">
            {block name="content"}{/block}
            {block name="commonContent"}{/block}
        </div>
        <footer class="footer text-center">
            Ministère de l'Economie et des Finances
        </footer>
    </div>

    {include file=$viewModule|cat:"common/layout/sticky-menu.tpl"}

</div>
{block name='js'}
    {*$dbg->render()*}
<script>
    window.ua  = {$account};
    window.dep = '&_dep{if $_dep}={$_dep}{else}{/if}';
    {if $user_theme}
        window.theme_data = {
            logobg : '{$user_theme->logobg}', navbarbg : '{$user_theme->navbarbg}', sidebarbg : '{$user_theme->sidebarbg}'
        };
    {else}
        window.theme_data = {
            logobg : '', navbarbg : '', sidebarbg : ''
        };
    {/if}
</script>
<script src="{base_url('/application/modules/evaluations/assets/js/dist/bundle.js')}?_={$utils::encrypt($smarty.now)}"></script>
{/block}
</body>
</html>