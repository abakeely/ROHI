{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Organigramme</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a style="text-decoration:none;" href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item">les CV des agents du mfbs</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div>
									<div id="tree"></div>
								</div>
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
					
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}


{literal}
<script>
$(document).ready(function() {
	
	$.ajax({
			url: "{/literal}{$zBasePath}{literal}Organigramme/getTree/",
			type: 'post',
			data: {
				mouvement_code: ""
			},
			success: function(data, textStatus, jqXHR) {
			OrgChart.templates.myTemplate = Object.assign({}, OrgChart.templates.ana);
			OrgChart.templates.myTemplate.size = [200, 200];
			OrgChart.templates.myTemplate.node = '<circle cx="100" cy="100" r="100" fill="#4D4D4D" stroke-width="1" stroke="#1C1C1C"></circle>'; 
			OrgChart.templates.myTemplate.ripple = {
				radius: 100,
				color: "#0890D3",
				rect: null
			};
			OrgChart.templates.myTemplate.field_0 = '<text style="font-size: 11px;" fill="#ffffff" x="100" y="90" text-anchor="middle">{val}</text>';
			OrgChart.templates.myTemplate.field_1 = '<text text-overflow="multiline" style="font-size: 11px;" fill="#ffffff" x="100" y="60" text-anchor="middle">{val}</text>';
			OrgChart.templates.myTemplate.field_2 = '<text text-overflow="multiline" style="font-size: 11px;" fill="#ffffff" x="100" y="60" text-anchor="middle">{val}</text>';
			
			OrgChart.templates.myTemplate.img_0 = '<clipPath id="ulaImg"><circle cx="100" cy="150" r="40"></circle></clipPath><image preserveAspectRatio="xMidYMid slice" clip-path="url(#ulaImg)" xlink:href="{val}" x="60" y="110"  width="80" height="80"></image>';
			
			OrgChart.templates.myTemplate.edge = '<path  stroke="#686868" stroke-width="1px" fill="none" edge-id="[{id}][{child-id}]" d="M{xa},{ya} C{xb},{yb} {xc},{yc} {xd},{yd}"/>';
		  
			OrgChart.templates.myTemplate.expandCollapseSize = 12;

			var source = JSON.parse(data);
			console.log(data);
			var chart = new OrgChart(document.getElementById("tree"), {
				showXScroll: BALKANGraph.scroll.visible,
				mouseScrool: BALKANGraph.action.xScroll,
				template: "myTemplate",            
				enableSearch: true,
				nodeBinding: {
					field_0: "name",
					field_1: "title",
					img_0: "image"
				},   
				nodes: source
			});         
		}
	});
})
</script>
<style>

</style>
{/literal}