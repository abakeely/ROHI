{include_php file=$zHeader }

<section id="mainContent" class="clearfix">
	<div id="leftContent">
		{include_php file=$zLeft}
		
	</div>
	<div id="innerContent">
		<div class="row separateur"><div class="col-md-12">Vos notes d'évaluation mensuelles</div></div>
		{$oData.zReturn}
		{$oData.zReturn2}
		
	</div>
</section>
{include_php file=$zFooter}