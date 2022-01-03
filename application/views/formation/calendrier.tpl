{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Calendrier de formation</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item">Formation</li>
									<li class="breadcrumb-item">Calendrier de formation</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
              <div class="card-body">
                <div class="">

                  <link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/pop/css/page.css">
                  <link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/pop/css/portBox.css">
                  <link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/pop/css/jquerysctipttop.css">

                  <script type="text/javascript" src="{$zBasePath}assets/common/css/formation/pop/js/jquery-ui-1.10.3.custom.min.js"></script>
                  <script type="text/javascript" src="{$zBasePath}assets/common/css/formation/pop/js/portBox.slimscroll.min.js"></script> 

                  <div id="content-wrap" class="row">
                    <script type="text/javascript" src="{$zBasePath}assets/inscription/js/pdf.js"></script>
                    <div class="firstPdf">
                      <div></div>
                      <div class="scrollbar" id="thePdfContainer"></div>
                    </div>
                  </div>
                </div>
                <div id="calendar"></div>
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
<style>
.firstPdf{
  position: relative;
  margin: auto;
  width : 90%;
}
.aboutThis{
      width: 300px;
      color: white;
      font-family: Courier, monospace;
      position: absolute;
      background: rgba(50, 50, 50, 0.25)!important;
      z-index: 2;
      top : 0;
      margin-left: calc((100% - 300px)/2);
      text-align: center;
      height: 40px;
      line-height: inherit;
      font-size: 15px;
}
.scrollbar
{
  position: relative;
  padding: 0 3% 0 3%;
  height: 600px;
  width: 100%;
  background: #F5F5F5;
  overflow-y: scroll;
}
.scrollbar canvas{
  position : relative !important;
  width : 100% !important;
  margin: 10px 0 10px 0;
}
#thePdfContainer::-webkit-scrollbar-track , #thePdfContainer::-moz-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	border-radius: 10px;
	background-color: #F5F5F5;
}

#thePdfContainer::-webkit-scrollbar , #thePdfContainer::-moz-scrollbar
{
	width: 12px;
	background-color: #F5F5F5;
}

#thePdfContainer::-webkit-scrollbar-thumb , #thePdfContainer::-moz-scrollbar-thumb
{
	border-radius: 10px;
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
	background-color: #555;
}


</style>
{/literal}

{literal}
<script>
$(document).ready(function(){

  // URL of PDF document
  var url ="{/literal}{$zBasePath}{literal}assets/pdf_sfao/CALENDRIER_DE_FORMATION_23_JUILLET_2018.pdf";
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