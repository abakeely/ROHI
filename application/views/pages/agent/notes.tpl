{extends file=$viewModule|cat:"layout.tpl"}
{*extends file=$viewModule|cat:"common.tpl"*}
{block name="pagetitle"}
    ROHI | Mes notes
{/block}
{block name="pagetitle_nav"}
    {if $account == 1}Mes notes{else}Notes{/if}
{/block}
{block name="commonContent"}
    <section class="row" id="rating-content">
        <div class="left-part sidebar">
            <a class="ti-menu ti-close btn btn-success show-left-part d-block d-md-none" href="javascript:void(0)"></a>
            {include file=$viewModule|cat:"partials/sidebar-account-list.tpl"}

            {include file=$viewModule|cat:"partials/sidebar-search-footer.tpl"}
        </div>
        <div class="right-part content">
            {*if $is_evaluated*}
                {include file=$viewModule|cat:"partials/agent/heading.tpl" candidat=$candidat}


                <h2>Etat des évaluations antérieures</h2>
                {if $row_count > 0}
                    <div class="pagination">
                        <ul>
                            {if $page > 1}
                                <li><a href="/evaluations/notes_agent/?_uid={$smarty.get._uid}&_p_={$utils::encrypt($page-1)}"><i class="fa fa-chevron-left"></i></a></li>
                            {/if}
                            <li>Page {$page} - {$total_page}</li>
                            {if $page < $total_page}
                                <li><a href="/evaluations/notes_agent/?_uid={$smarty.get._uid}&_p_={$utils::encrypt($page+1)}"><i class="fa fa-chevron-right"></i></a></li>
                            {/if}
                        </ul>
                    </div>

                    {include file=$viewModule|cat:"pages/agent/partials/table-notes.tpl" notes=$notes}
                    {if $account == COMPTE_EVALUATEUR || $account == COMPTE_AUTORITE}
                        <a data-agent-id="{$utils::encrypt($candidat->id)}" data-matricule="{$candidat->matricule|number_format:0:" ":" "}" data-print-bin href="#" class="btn btn-primary btn-print-bin">
                            Imprimer le BIN
                        </a>
                    {/if}
                {else}

                        <p class="alert alert-info alert-not-evaluated">
                            Cette page n’est pas encore disponible. Revenez à la fin du trimestre !
                        </p>


                {/if}
            {if $account == COMPTE_EVALUATEUR && $prev_date}
                <div class="mt-5 no_evaluations">
                    <h2>Période sans évaluations</h2>
                    <div class="pagination">
                        <ul>
                            {if $pagination_dates.page > 1}
                                <li><a href="/evaluations/notes_agent/?_uid={$smarty.get._uid}&_pdt_={$utils::encrypt($pagination_dates.page-1)}"><i class="fa fa-chevron-left"></i></a></li>
                            {/if}
                            <li>Page {$pagination_dates.page} - {$pagination_dates.total_page}</li>
                            {if $pagination_dates.page < $pagination_dates.total_page}
                                <li><a href="/evaluations/notes_agent/?_uid={$smarty.get._uid}&_pdt_={$utils::encrypt($pagination_dates.page+1)}"><i class="fa fa-chevron-right"></i></a></li>
                            {/if}
                        </ul>
                    </div>
                    {include file=$viewModule|cat:"pages/agent/partials/table-periode.tpl" period=$prev_date}
                </div>
            {/if}
        </div>
    </section>
{/block}