<div class="row mt-4">
    <div class="col-sm-7">
        <p>Répartition globale de la note par élément de notation</p>
        <div class="filter-trimestre">

            <div class="input-field from">
                <select name="from_trimestre" id="from_trimestre">
                    <option value="0" selected>Selectionnez un trimestre</option>
                    {foreach from=$periods item=period}
                        <option {if $current_trimestre.id == $period.id}selected{/if} value="{$period.id}">{$period.label} {$period.year}  {*$period.started_at|date_format:"%d/%m/%Y"} - {$period.ended_at|date_format:"%d/%m/%Y"*}</option>
                    {/foreach}
                </select>
                <label for="from_trimestre">Début</label>
            </div>
            <div class="input-field to">
                <select name="to_trimestre" id="to_trimestre">
                    <option value="0" selected>Selectionnez un trimestre</option>
                    {foreach from=$periods item=period}
                        <option {if $current_trimestre.id == $period.id}selected{/if} value="{$period.id}">{$period.label} {$period.year} {*$period.started_at|date_format:"%d/%m/%Y"} - {$period.ended_at|date_format:"%d/%m/%Y"*}</option>
                    {/foreach}
                </select>
                <label for="from_trimestre">Fin</label>
            </div>
            <div class="d-none">
                <button class="btn btn-secondary btn-do-filter" do-filter type="button">
                    OK
                </button>
            </div>
        </div>
        <canvas id="radar-chart-element"></canvas>
        {if $compare_data && $compare_data|@sizeof > 0}
            <div class="tools">
                <div class="row  mt-3 mb-3">
                    <!--div class="col-sm-6 text-center">
                        <a href="#" class="btn btn-compare btn-primary" compare-evaluation>
                            Comparer
                        </a>
                    </div-->
                    <div class="col-sm-12 choice-compare">
                        <label data-my-st>
                            <input class="rang_compare" name="rang_compare" value="--" type="radio" checked />
                            <span>Ma structure</span>
                        </label>
                        {foreach from=$compare_data item=rang key=k}
                            <label>
                                <input class="rang_compare" name="rang_compare" value="{$rang}" type="radio" />
                                <span>{if $rang == '___DIR___'}DIR{else}{$rang}{/if}</span>

                            </label>
                            &nbsp;&nbsp;
                        {/foreach}
                    </div>

                </div>
                <div class="row d-none info-compare mt-3 mb-3">
                    <div class="col-sm-12">
                        <div class="alert alert-info">
                            Aucun resultat à afficher pour cette section
                        </div>
                    </div>
                </div>
            </div>

        {/if}
    </div>
    <div class="col-sm-5 ">

    </div>

</div>
<div class="row mt-4">
    <div class="chart-bars col-sm-8">
        <p>Courbe des notes successives attribuées à la structure</p>
        <div id="line">
            <canvas id="line-chart-note"></canvas>
            <div id="line-div-chart-note"></div>
        </div>
    </div>
    <div class="col-sm-4 donut-chart">
        <p>Note de performance pour le dernier trimestre</p>
        <canvas id="donut-chart-perf"></canvas>
    </div>
</div>
