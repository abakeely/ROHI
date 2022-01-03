{extends file=$viewModule|cat:"pages/evaluate_user/fiche-trimestre.tpl"}
{block name="fiche"}
    <div class="row mt-4">
        <div class="col-sm-10 offset-md-1">
            <h4>C'est un {$appreciation_label} agent</h4>
            <h6>Donner une appréciation générale pour cet agent :</h6>
            <form action="/evaluations/post_final" method="post">
                <input type="hidden" name="id_agent" value="{if $remind}{$candidat->id}{else}{$utils::decrypt($smarty.get._uid)}{/if}">
                <input type="hidden" name="id_appreciation_general" value="{$questions[0]->id_appreciation}">
                {foreach from=$questions item=question}
                    <div class="form-check">
                        <label class="form-check-label" for="question_app_{$question->id}">
                        <input required class="form-check-input" type="radio" name="appreciation_general[]" id="question_app_{$question->id}" value="{$question->id}">
                            <span>
                                {$question->label}
                            </span>

                        </label>
                    </div>
                {/foreach}
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Terminer</button>
                </div>
            </form>
        </div>
    </div>
{/block}