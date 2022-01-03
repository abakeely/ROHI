{if $account == COMPTE_EVALUATEUR || $account == COMPTE_AUTORITE}
<div class="add-search">
    <div class="row">
        <div class="col-sm-8">
            <div class="input-field">
                <input data-search type="text" id="search_agent"
                       aria-label=""
                       aria-describedby="button-action-search">
                <label for="search_agent">Taper un IM ou un numero CIN ici</label>
            </div>
        </div>
        <div class="col-sm-4">
            <button class="btn btn-outline-secondary" type="button">
                <i class="material-icons">search</i>
            </button>
            {if $account == COMPTE_EVALUATEUR}
                <button class="btn btn-outline-secondary" load-search-box>
                    <i class="material-icons">add</i>
                </button>
            {/if}
        </div>
    </div>
</div>
    <a href="#" class="mt-3 print-dashboard btn btn-primary">
        Imprimer le tableau de bord
    </a>
{/if}