{extends file=$viewModule|cat:"layout.tpl"}
{*extends file=$viewModule|cat:"common.tpl"*}
{block name="pagetitle"}
    ROHI | evaluation
{/block}
{block name="pagetitle_nav"}
    Tableau de bord de performance
{/block}
{block name="content"}
    <section class="row" id="rating-content">
        <div class="left-part sidebar">
            <a class="ti-menu ti-close btn btn-success show-left-part d-block d-md-none" href="javascript:void(0)"></a>
            {include file=$viewModule|cat:"partials/sidebar-account-list.tpl"}

            {include file=$viewModule|cat:"partials/sidebar-search-footer.tpl"}
        </div>
        <div class="right-part content">
            <div class="_main">
                {include file=$viewModule|cat:"partials/main-content.tpl"}
                {if $account == COMPTE_EVALUATEUR || $account == COMPTE_AUTORITE || $account == COMPTE_AGENT}
                <div class="spinner-container" xhr-spinner>
                    <div class="text-center spin">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                {/if}
            </div>
        </div>
    </section>
{/block}