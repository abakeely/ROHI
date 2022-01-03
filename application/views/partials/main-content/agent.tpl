<div class="agent-dashboard">
    {*if $is_evaluated*}
        <h1>Tableau de bord de ma performance</h1>
        <div class="content-chart" content-chart>
            <div class="row mt-4">
                <div class="col-sm-5 ">
                    <p>Note de performance pour le dernier trimestre</p>
                    <canvas id="donut-chart-perf"></canvas>
                </div>
                <div class="col-sm-7">
                    <p>Répartition globale de la note par élément de notation</p>
                    <canvas id="radar-chart-element"></canvas>
                </div>
            </div>
            <div class="mt-4 chart-bars">
                <p>Courbe des notes successives attribuées à la structure</p>
                <div id="line">
                    <canvas id="line-chart-note"></canvas><div id="line-div-chart-note"></div>
                </div>
            </div>
        </div>
    {*else}
        <p class="not-evaluated">
            Cette page n’est pas encore disponible. Revenez à la fin du trimestre !
        </p>
    {/if*}
</div>