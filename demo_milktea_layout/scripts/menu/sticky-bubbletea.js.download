//Sticky div code taken from http://jsfiddle.net/apaul34208/ZyKar/3/ and week 8 hamburger menu tutorial
//Using media queries for jQuery taken from https://www.sitepoint.com/javascript-media-queries/

$(document).scroll(function() {

var mq = window.matchMedia( "(min-width: 35em)" );
	if (mq.matches) {
	  var y = $(this).scrollTop();
	  if (y > 580) {
	    $('#category-nav').removeClass("hidden");
	    $('#category-nav').attr("aria-hidden", "false");
	  } else {
	    $('#category-nav').addClass("hidden");
	  }
	} else {
		$('#category-nav').addClass("hidden");
	}
});