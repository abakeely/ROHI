<table class="table">
    <thead>
        <tr>
            <th>Période</th>
            <th>Année</th>
            <th>Début</th>
            <th>Fin</th>
            <th>&nbsp</th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$period item=p_}
            <tr>
                <td>{$p_->label}</td>
                <td>{$p_->year}</td>
                <td>{$p_->started_at|date_format:"%d/%m/%Y"}</td>
                <td>{$p_->ended_at|date_format:"%d/%m/%Y"}</td>
                <td>
                    <a class="evaluate-later" href="/evaluations/evaluate_date/?_evp={$utils::encrypt($p_->id)}&_uid={$smarty.get._uid}"><i class="mdi mdi-account-settings"></i></a>
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>