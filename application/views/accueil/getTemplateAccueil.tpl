<style>



#slider1 {
  position: relative;
  overflow: hidden;
  margin: 20px auto 0 auto;
  border-radius: 4px;
}

#slider1 ul {
  position: relative;
  margin: 0;
  padding: 0;
  height: 200px;
  list-style: none;
}

#slider1 ul li {
  position: relative;
  display: block;
  float: left;
  margin: 0;
  padding: 0;
  width: 750px;
  height: 500px;
  background: #ccc;
  text-align: center;
  line-height: 300px;
}

a.control_prev, a.control_next {
  position: absolute;
  top: 40%;
  z-index: 999;
  display: block;
  padding: 4% 3%;
  width: auto;
  height: auto;
  background: #2a2a2a;
  color: #fff;
  text-decoration: none;
  font-weight: 600;
  font-size: 18px;
  opacity: 0.8;
  cursor: pointer;
}

a.control_prev:hover, a.control_next:hover {
  opacity: 1;
  -webkit-transition: all 0.2s ease;
}

a.control_prev {
  border-radius: 0 2px 2px 0;
}

a.control_next {
  right: 0;
  border-radius: 2px 0 0 2px;
}

.slider1_option {
  position: relative;
  margin: 10px auto;
  width: 260px;
  font-size: 18px;
}
</style>
<div id="slider1" style="width:800px;height:600px;">
  <a href="#" class="control_next">></a>
  <a href="#" class="control_prev"><</a>
  <ul>
	<li><img src="{$zBasePath}assets/common/smile/CCPREAS.jpg" width="100%" height="100%"></li>
	<li><img src="{$zBasePath}assets/common/smile/CNM.jpg" width="100%" height="100%"></li>
	<li><img src="{$zBasePath}assets/common/smile/DAI.jpg" width="100%" height="100%"></li>
	<li><img src="{$zBasePath}assets/common/smile/DGARMP.jpg" width="100%" height="100%"></li>
	<li><img src="{$zBasePath}assets/common/smile/DGCF.jpg" width="100%" height="100%"></li>
	<li><img src="{$zBasePath}assets/common/smile/DGD.jpg" width="100%" height="100%"></li>
	<li><img src="{$zBasePath}assets/common/smile/DGEP.jpg" width="100%" height="100%"></li>
	<li><img src="{$zBasePath}assets/common/smile/DGFAG.jpg" width="100%" height="100%"></li>
	<li><img src="{$zBasePath}assets/common/smile/DGI.jpg" width="100%" height="100%"></li>
	<li><img src="{$zBasePath}assets/common/smile/DGT.jpg" width="100%" height="100%"></li>
	<li><img src="{$zBasePath}assets/common/smile/SG.jpg" width="100%" height="100%"></li>
  </ul>  
</div>

<div class="slider1_option">
  <input type="checkbox" id="checkbox">
  <label for="checkbox">Lecture automatique</label>
</div> 
<script>
jQuery(document).ready(function ($) {

  $('#checkbox').change(function(){

	 iValue = $(this).is(':checked');
	 

	 if(iValue == true){
		refreshIntervalId = setInterval(function () {
			moveRight();
		}, 3000);
	 } else {
		clearInterval(refreshIntervalId);
	 }
    
  });
  
	var slideCount = $('#slider1 ul li').length;
	var slideWidth = $('#slider1 ul li').width();
	var slideHeight = $('#slider1 ul li').height();
	var slider1UlWidth = slideCount * slideWidth;
	
	$('#slider1').css({ width: slideWidth, height: slideHeight });
	
	$('#slider1 ul').css({ width: slider1UlWidth, marginLeft: - slideWidth });
	
    $('#slider1 ul li:last-child').prependTo('#slider1 ul');

    function moveLeft() {
        $('#slider1 ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#slider1 ul li:last-child').prependTo('#slider1 ul');
            $('#slider1 ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider1 ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#slider1 ul li:first-child').appendTo('#slider1 ul');
            $('#slider1 ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });

});    

</script>