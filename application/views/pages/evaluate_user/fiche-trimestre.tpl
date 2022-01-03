{extends file=$viewModule|cat:"layout.tpl"}
{*extends file=$viewModule|cat:"common.tpl"*}
{block name="pagetitle"}
    ROHI | Fiche trimestrielle
{/block}
{block name="pagetitle_nav"}
    Fiche trimestrielle
{/block}
{block name="commonContent"}
    <section class="row" id="rating-content">
        <div class="left-part sidebar">
            <a class="ti-menu ti-close btn btn-success show-left-part d-block d-md-none" href="javascript:void(0)"></a>
            {include file=$viewModule|cat:"partials/sidebar-account-list.tpl"}

            {include file=$viewModule|cat:"partials/sidebar-search-footer.tpl"}
        </div>
        <div class="right-part content">
            {if ($is_evaluation_time && !$is_evaluated) || $reload}
                {include file=$viewModule|cat:"partials/agent/heading.tpl" candidat=$candidat}
                {block name='fiche'}
                    <h3>Fiche d’évaluation du {if $periode}{$periode.label}{/if} trimestre {if $periode}{$periode.year}{else}{'Y'|date}{/if}</h3>
                    {if is_null($job_group)}
                        {include file=$viewModule|cat:"pages/evaluate_user/job_group.tpl"}
                    {else}
                        {include file=$viewModule|cat:"pages/evaluate_user/questions.tpl"}
                    {/if}
                {/block}
            {else}
                <p class="alert alert-info alert-not-evaluated">
                    Cette page n’est pas encore disponible. Revenez à la fin du trimestre !
                </p>
            {/if}
        </div>
    </section>
{/block}