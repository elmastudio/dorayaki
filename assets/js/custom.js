
/*--------------------------------------------------------------------------------------------
  Add class of JS and remove no-js class
----------------------------------------------------------------------------------------------*/

jQuery(document).ready(function(){
    var doc = document.getElementById('doc');
    if (doc != null ) {
        doc.removeAttribute('class', 'no-js');
        doc.setAttribute('class', 'js');
    }
});

/*--------------------------------------------------------------------------------------------
  Mobile Menu (Nav + Search)
----------------------------------------------------------------------------------------------*/

jQuery(document).ready(function(){
    	jQuery('#search-wrap').hide();
		jQuery('a#mobile-search-btn').click(function () {
		jQuery('#search-wrap').slideToggle('fast');
		jQuery('a#mobile-search-btn').toggleClass('search-btn-open');
    });
});

jQuery(document).ready(function(){
    	jQuery('#site-nav').hide();
		jQuery('a#mobile-menu-btn').click(function () {
		jQuery('#site-nav').slideToggle('100');
		jQuery('a#mobile-menu-btn').toggleClass('menu-btn-open');
    });
});

/*--------------------------------------------------------------------------------------------
  Show/Hide for Share Buttons
----------------------------------------------------------------------------------------------*/

jQuery(document).ready(function(){
    	jQuery('.share-links-wrap').hide();
		jQuery('.share-btn').click(function () {
		jQuery(this).next('.share-links-wrap').fadeToggle('fast');
    });
});

/*--------------------------------------------------------------------------------------------
  Animate Header Search Form (Desktop)
----------------------------------------------------------------------------------------------*/

if (document.documentElement.clientWidth > 1260) {
	jQuery(document).ready(function(){
		jQuery("a#desktop-search-btn").click(function(event) {
			event.preventDefault();
			if(jQuery('a#desktop-search-btn').hasClass('btn-open')) {
				jQuery('#s').animate({
					width: 'hide',
					opacity: 'hide'
				}, 'fast');
				jQuery('.headerinfo-text').animate({
					right: '65'
				}, 'fast');
				jQuery('a#desktop-search-btn').removeClass('btn-open');
			} else {
				jQuery('#s').animate({
					width: 'show',
					opacity: 'show'
				}, 'fast');
				jQuery('.headerinfo-text').animate({
					right: '280px'
				}, 'fast');
				jQuery('a#desktop-search-btn').addClass('btn-open');
			}
    	});
	});
}