<div class="user-list">
    <h4 class="sidebar-title">
        <!--a href="{site_url('accueil/communique')}">
            <i class="material-icons">keyboard_arrow_left</i>
        </a-->
        {if $account == COMPTE_AGENT}
            Evaluation de performance
        {else}
            Liste des agents à évaluer
        {/if}
        <!--a class="d-sm-none collapse-trigger" type="button" data-toggle="collapse" data-target="#user-list-collapse" aria-expanded="false" aria-controls="collapseExample">
            <span class="material-icons">
                expand_more
            </span>
        </a-->
    </h4>
    <!--div id="user-list-collapse" class="collapse d-sm-block"-->

        {if $account == COMPTE_EVALUATEUR || $account == COMPTE_AUTORITE}
            <div id="user-listing" class="user-listing">
                {foreach from=$users item=user}
                    {include file=$viewModule|cat:"partials/item/user-item.tpl" user=$user}
                {/foreach}

            </div>
        {elseif $account == COMPTE_AGENT}
            {include file=$viewModule|cat:"partials/item/agent-sidebar.tpl"}
        {/if}

        <div class="d-flex justify-content-center" >
            <div class="spinner-border process-loader" role="status" style="display: none;">
                <span class="sr-only">Chargement...</span>
            </div>
        </div>
    <!--/div-->
</div>