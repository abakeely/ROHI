{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb"></div>
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<h2>Statistiques</h2>
		<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="{$zBasePath}">Formation</a> <span>&gt;</span> <a href="{$zBasePath}formation/programmeFormation/formation/programme-formation">Reporting</a><span>&gt;</span>Statistiques</div>
		
		<div class="contenuePage">

		<!--*Debut Contenue*-->
		<div class="col-xs-12">

{literal}		
<style>
button {
	padding: 4px 20px;
	background-color: #A9A9A9;
	border: 1px solid white! important;
}

th, td {
 border:1px solid #E6E6FA;
 width:20%;
 }
td {
 text-align:center;
 }
caption {
 font-weight:bold
 }
 
 /* Style des lignes de séparation */
.table-separateur {
  font-size : 12px;
  font-family : Verdana, arial, helvetica, sans-serif;
  color : #333333;
  background-color :#F5F5F5;
  }

.th_livre{
		background: Teal
	}	


  .zoom {
	height:160px;
		}
	.zoom p {
	text-align:center;
	}
	.zoom img {
	width:200px;
	height:190px;
	}
	.zoom img:hover {
	width:250px;
	height:210px;
}
   
 </style>
 {/literal}

 <script>
$(document).ready(function(){

  // URL of PDF document
  var url ="{/literal}{$zBasePath}{literal}assets/pdf_sfao/CALENDRIER_FORMATION_2018_1.pdf";
  PDFJS.disableWorker = true;
  var currPage = 1; //Pages are 1-based not 0-based
  var numPages = 0;
  var thePDF = null;
  var pdfDom = $("#thePdfContainer");
  // Asynchronous download PDF
  PDFJS.getDocument(url).then(function(pdf) {

            //Set PDFJS global object (so we can easily access in our page functions
            thePDF = pdf;

            //How many pages it has
            numPages = pdf.numPages;

            //Start with first page
            pdf.getPage( 1 ).then( handlePages );
    });

    function appendPage(_canv){
      pdfDom.append(_canv);
    }

    function handlePages(page)
    {
        //This gives us the page's dimensions at full scale
        var viewport = page.getViewport( 1 );

        //We'll create a canvas for each page to draw it on
        var canvas = document.createElement( "canvas" );
        canvas.style.display = "block";
        var context = canvas.getContext('2d');
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        //Draw it on the canvas
        page.render({canvasContext: context, viewport: viewport});

        //Add it to the web page
        appendPage( canvas );

        //Move to next page
        currPage++;
        if ( thePDF !== null && currPage <= numPages )
        {
            thePDF.getPage( currPage ).then( handlePages );
        }
    }

    var Scrollbar = window.Scrollbar;

    Scrollbar.use(window.OverscrollPlugin);
    Scrollbar.init(document.querySelector('#thePdfContainer'), {
        plugins: {
            overscroll: true,
        }
    });

});
</script>

 
{/literal}
 

<!--*Fin Contenue*-->
    </div>
  </div>
  <div id="calendar"></div>
  </div>
</section>
<section id="rightContent" class="clearfix">
  {include_php file=$zRight}
</section>
{include_php file=$zFooter}
</div>

</body>


</html>