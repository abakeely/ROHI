{include file=$viewModule|cat:"partials/main-content/header.tpl"}

<div style="display: none;" no-info class="alert alert-info">
    Aucun résultat à afficher pour le moment
</div>

    {if $account == COMPTE_EVALUATEUR}
        <div class="content-chart" content-chart>
            {include file=$viewModule|cat:"partials/main-content/evaluateur.tpl"}
        </div>
    {/if}
    {if $account == COMPTE_AUTORITE}
        <div class="content-chart" content-chart>
            {include file=$viewModule|cat:"partials/main-content/autorite.tpl"}
        </div>
    {/if}

    {if $account == COMPTE_AGENT}

        {include file=$viewModule|cat:"partials/main-content/agent.tpl"}

    {/if}

