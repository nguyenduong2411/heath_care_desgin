//Scroll code taken from http://stackoverflow.com/questions/19012495/smooth-scroll-to-div-id-jquery
//Using media queries for jQuery taken from https://www.sitepoint.com/javascript-media-queries/

// handle links with @href started with '#' only
$(document).on('click', 'a[href^="#"]', function(e) {
	var mq = window.matchMedia( "(min-width: 50em)" );
		if (mq.matches) {
		    // target element id
		    var id = $(this).attr('href');

		    // target element
		    var $id = $(id);
		    if ($id.length === 0) {
		        return;
		    }

		    // prevent standard hash navigation (avoid blinking in IE)
		    e.preventDefault();

		    // top position relative to the document
		    var pos = $id.offset().top-80;

		    // animated top scrolling
		    $('body, html').animate({scrollTop: pos});
		} else {
		    // target element id
		    var id = $(this).attr('href');

		    // target element
		    var $id = $(id);
		    if ($id.length === 0) {
		        return;
		    }

		    // prevent standard hash navigation (avoid blinking in IE)
		    e.preventDefault();

		    // top position relative to the document
		    var pos = $id.offset().top-200;

		    // animated top scrolling
		    $('body, html').animate({scrollTop: pos});
		}
});
