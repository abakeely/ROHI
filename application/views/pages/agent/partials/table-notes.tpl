<table class="table table-notes">
    <thead>
    <tr>
        <th>Période</th>
        <th>Date d’évaluation</th>
        <th>Valeur générale</th>
        <th>Appréciation générale</th>
        <th>Notation par</th>
        <th>Note attribuée</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$notes item=note}

        <tr class="row-notes">
            <td>{$note->label_period} {$note->year_period}</td>
            <td>{$note->date|date_format:"%d/%m/%Y"}</td>
            <td>
                {if $note->valeur_generale_id == 1}
                    Agent {$note->valeur_general}
                {else}
                    {$note->valeur_general} agent
                {/if}
            </td>
            <td>{$note->appreciation_generale}</td>
            <td>{if $note->type_evaluation == 'auto'}
                    ROHI
                {else}
                    {$note->evaluateur_im|number_format:0:" ":" "}
                {/if}
            </td>
            <td>{$note->moyenne}/20</td>
            <td>
                {if $account == COMPTE_EVALUATEUR || $account == COMPTE_AUTORITE}

                    <a class="print-note" data-evid="{if $note->type_evaluation == "manual"}{$utils::encrypt($note->evaluation_id)}{/if}" style="display: none;" {if $note->type_evaluation == "auto"}data-auto-note{else}data-print-note-agent{/if} href="#"><i class="fa fa-print"></i></a>

                    {if $note->type_evaluation == "auto"}
                        <a class="evaluate-manual" href="/evaluations/evaluate_remind/?_evid={$utils::encrypt($note->evaluation_id)}"><i class="mdi mdi-account-settings"></i></a>
                    {/if}
                {/if}
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>