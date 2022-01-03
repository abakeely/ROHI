{extends file=$viewModule|cat:"common.tpl"}
{block name='commonContent'}
    <section class="row" id="rating-content">
        <div class="col-sm-4 sidebar">

            {include file=$viewModule|cat:"partials/sidebar-account-list.tpl"}

            {include file=$viewModule|cat:"partials/sidebar-search-footer.tpl"}
        </div>
        <div class="col-sm-8 content">
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
