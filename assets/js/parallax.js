//parallax code
//we aren't binding to the scroll event 
//to increase performance
$(document).ready(function()
{
	var docHeight = $(document).height(),
		divHeight = $("#wrapper").height(),
		docWidth  = $(document).width(),
		accuracy  = 3;
	//alert("Window: "+winHeight+"\nDiv: "+divHeight);
	$("#moon").css('backgroundPosition', docWidth*0.1+'px 0px');
	var animFrame = window.requestAnimationFrame 	  ||
	    			window.webkitRequestAnimationFrame||
	    			window.mozRequestAnimationFrame   ||
	    			window.oRequestAnimationFrame     ||
	    			window.msRequestAnimationFrame    ||
	    			null ;
	//cache elements
	var $body = $(document.body),
		$moon = $("#moon"),
		$mountain0 = $("#mountains0"),
		$mountain1 = $("#mountains1"),
		$mountain2 = $("#mountains2"),
		$clouds    = $("#clouds"),
		$debug     = $("#debug");
	//parallax loop	
	var parallaxScroll = function(){
		//force the browser to run code between render calls
		animFrame(function(){
			//console.log('updating');
			var scrollV = $(document).scrollTop();
			var percent = scrollV/(docHeight - $(window).height());
			if(percent>1.0) percent = 1.0;
			// $debug.text(
			// 	"scroll: "+scrollV+"\n"+
			// 	"window: "+docHeight+"\n"+
			// 	"percent: "+percent.toFixed(accuracy)
			// );

			$body.css     ('backgroundPosition', 'center '+((-percent*docHeight)*0.05).toFixed(accuracy)+'px');
			$moon.css     ('backgroundPosition', docWidth*0.1+'px '+((-percent*docHeight)*0.0535).toFixed(accuracy)+'px');
			$mountain0.css('backgroundPosition', 'center '+(((-percent*1056)+1056)*0.2).toFixed(accuracy)+'px');
			$mountain1.css('backgroundPosition', 'center '+(((-percent*1236)+1236)*0.2).toFixed(accuracy)+'px');
			$mountain2.css('backgroundPosition', 'center '+(((-percent*1236)+1236)*0.4).toFixed(accuracy)+'px');
			$clouds.css   ('backgroundPosition', 'center '+((-percent*docHeight)*0.09).toFixed(accuracy)+'px');
		});
	}
	scrollIntervalID = setInterval(parallaxScroll, 10);


	//drop down menu functionality
	$("ul.nav_top_list li div").hover(function() 
	{ //When trigger is clicked...
					
		//Following events are applied to the subnav itself (moving subnav up and down)
		$(this).parent().find("ul.subnav").slideDown('fast').show(); //Drop down the subnav on click

		$(this).parent().hover(function()
			{
				
			},function()
			{	
				$(this).parent().find("ul.subnav").slideUp('fast'); //When the mouse hovers out of the subnav, move it back up
			}
		);
	//Following events are applied to the trigger (Hover events for the trigger)
	},function()
	{
		
	}
	).hover(function() 
	{ 
		$(this).addClass("subhover"); //On hover over, add class "subhover"
	},function()
	{	//On Hover Out
		$(this).removeClass("subhover"); //On hover out, remove class "subhover"
	});
	
	//slide out information
	var oddClick = true;
	$("#widgetToggle").click(function(e){
		e.preventDefault();
	    $(this).parent().stop().animate({
	        'marginLeft': oddClick ? '-245px' : '0'
	    },200);
	    oddClick = !oddClick;
	});
});