{if $account == COMPTE_AUTORITE || $account == COMPTE_EVALUATEUR }
    <h3> {if $account == COMPTE_AUTORITE}
            Tableau de bord de performance de la Structure
            {elseif $account == COMPTE_EVALUATEUR}
            Tableau de bord de performance de votre Structure
        {/if}
    </h3>
    <div class="input-field mb-3 col-sm-6">
        <select name="" class="depart" aria-describedby="dep-addons">
            <option value="">Sélectionner le Département ici</option>
            <option
                    {if isset($smarty.get.dep) && $utils::decrypt($smarty.get.dep) == $dep->id}
                        selected
                    {else}
                        {if $current_structure[0][0] == $current_structure_id}selected{/if}
                    {/if}
                    value="{$utils::encrypt($current_structure[0][0])}">{$current_structure[0][1]}
            </option>
            {foreach from=$sts item=dep}
                <option {if isset($smarty.get.dep) && $utils::decrypt($smarty.get.dep) == $dep[0]}selected{/if}
                        value="{$utils::encrypt($dep[0])}">{$dep[1]}</option>
            {/foreach}
            {*foreach from=$departments item=dep}
                <option {if isset($smarty.get.dep) && $utils::decrypt($smarty.get.dep) == $dep->id}selected{/if} value="{$utils::encrypt($dep->id)}">{$dep->sigle_departement}</option>
            {/foreach*}
        </select>

        <div class="input-group-append">
            <button class="btn btn-outline-secondary search-with-depart" type="button" id="dep-addons">
                <i class="material-icons">search</i>
            </button>
        </div>
    </div>
{/if}
{*if $account == COMPTE_EVALUATEUR}
    <h3>Tableau de bord de performance de votre Structure</h3>
{/if*}

