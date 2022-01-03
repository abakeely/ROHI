<div class="row mt-4">
    <div class="col-sm-6 offset-md-3">
        <h4>Groupe de l'agent</h4>
        <form action="/evaluations/post_group" method="post">
            <input type="hidden" name="_uid" value="{if $remind}{$utils::encrypt($candidat->id)}{else}{$smarty.get._uid}{/if}">
            {if $remind}
                <input type="hidden" name="_remind" value="1">
                <input type="hidden" name="_evid" value="{$utils::encrypt($evid)}">
            {/if}
            {if $reload}
                <input type="hidden" name="_reload" value="1">
                <input type="hidden" name="_evp" value="{$utils::encrypt($evp)}">
            {/if}
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label" for="radio_group_1">
                    <input checked class="form-check-input" type="radio" name="job_group[]" id="radio_group_1" value="1">
                       <span>Groupe 1</span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="radio_group_2">
                    <input class="form-check-input" type="radio" name="job_group[]" id="radio_group_2" value="2">
                    <span>Groupe 2</span>

                    </label>
                </div>
            </div>
            <div class="from-group">
                <button class="btn btn-primary" type="submit">Valider</button>
            </div>
        </form>
    </div>
</div>