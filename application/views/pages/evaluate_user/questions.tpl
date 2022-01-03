<form action="/evaluations/post_note_question" method="post">
    <input type="hidden" name="id_agent" value="{$candidat->id}">
    <input type="hidden" name="id_agent_user_id" value="{$candidat->user_id}">
    <input type="hidden" name="id_evaluateur" value="{$current_user.id}">
    <input type="hidden" name="id_evaluation_periode" value="{$periode.id}">
    <input type="hidden" name="id_groupe" value="{$job_group}">
    {if $remind}
        <input type="hidden" name="_remind" value="1">
        <input type="hidden" name="_evid" value="{$utils::encrypt($evid)}">
    {/if}
    {if $reload}
        <input type="hidden" name="_reload" value="1">
        <input type="hidden" name="_evp" value="{$utils::encrypt($evp)}">
    {/if}
    <div class="questions">
        <table class="table">
            <thead>
            <tr>
                <th></th>
                {foreach from=$appreciations_questions item=app_q}
                    <th>{$app_q->label}</th>
                {/foreach}
            </tr>
            </thead>
            <tbody>
            {foreach from=$questions item=question}
                {foreach from=$question.questions item=q}
                    <tr>
                        <td>{$q->question}</td>

                        {foreach from=$appreciations_questions item=app_q}
                            <td>
                                <label>
                                    <input required type="radio" name="question[{$question.elements->id}][{$q->id}]" value="{$app_q->id}">
                                    <span>&nbsp;</span>
                                </label>
                            </td>
                        {/foreach}
                    </tr>
                {/foreach}
            {/foreach}
            </tbody>
        </table>
        <div class="action-question">
            <a href="/evaluations/evaluate_user/?_uid={$utils::encrypt($candidat->id)}" class="btn btn-default">Réinitialiser</a>
            <button type="submit" class="btn btn-primary">Suivant</button>
        </div>
    </div>
</form>
