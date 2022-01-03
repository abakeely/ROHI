<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 align-self-center">
         <!--   <h4 class="page-title">Evaluation</h4> -->
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{base_url('/accueil/communique')}">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{base_url('/evaluations')}">Evaluations</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{block name="pagetitle_nav"}
                                Evaluations
                            {/block}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">

                {*if $oData.toMenus|@sizeof > 0}
                    <div class="other_menu">
                        <a class="dropdown-toggle" href="#" id="to_menus_dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Navigations ...
                        </a>
                        <div class="dropdown-menu " aria-labelledby="to_menus_dropdown">
                            {foreach from=$oData.toMenus item=other_menu}
                                <a class="dropdown-item" href="{base_url('/'|cat:$other_menu.page_url)}">
                                    {$other_menu.page_libelle}
                                </a>
                            {/foreach}
                        </div>
                    </div>

                {/if*}
            </div>
        </div>
    </div>
</div>