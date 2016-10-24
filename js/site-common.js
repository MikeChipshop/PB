jQuery( document ).ready(function( $ ) {
	$('.pb_mobile-menu-toggle').click(function() {
		$('body').addClass('pb_mobile-menu-active');
	});
	$('.pb_mobile-nav-close').click(function() {
		$('body').removeClass('pb_mobile-menu-active');
	});
	$('.pb_go-default').click(function() {
		$('body').removeClass('pb_default-view');
		$('body').addClass('pb_default-view');
		$('body').removeClass('pb_grid-view');
		$('body').removeClass('pb_list-view');
		$('body').removeClass('pb_button-view');
	});
	$('.pb_go-grid').click(function() {
		$('body').addClass('pb_grid-view');
		$('body').removeClass('pb_list-view');
		$('body').removeClass('pb_default-view');
		$('body').removeClass('pb_button-view');
	});
	$('.pb_go-list').click(function() {
		$('body').addClass('pb_list-view');
		$('body').removeClass('pb_grid-view');
		$('body').removeClass('pb_default-view');
		$('body').removeClass('pb_button-view');
	});
	$('.pb_go-button').click(function() {
		$('body').addClass('pb_button-view');
		$('body').removeClass('pb_grid-view');
		$('body').removeClass('pb_default-view');
		$('body').removeClass('pb_list-view');
	});
	$('.owl-carousel-home').owlCarousel({
		loop:true,
		margin:0,
		nav:true,
		items:1,
		autoplay:true,
		dots:true,
		afterInit: function() {
        	owl.removeClass('hide');
    	},
		navText:["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
	});
	
	$('.pb_home-product-slider').owlCarousel({
		loop:true,
		margin:0,
		nav:true,
		items:4,
		autoplay:false,
		dots:true,
		navText:["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
	});
	
	$('.pb_home-post-slider').owlCarousel({
		loop:true,
		margin:0,
		nav:true,
		items:4,
		autoplay:false,
		dots:true,
		navText:["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
	});
	
	// Toggle "Best In"
	$( ".pe_showcase-toggle button" ).click(function() {
	  $( ".pb_article-showcase" ).slideToggle( "fast", function() {});
	  $( ".pe_showcase-toggle button" ).toggleClass( "hidden", function() {});
	});
	
	// Toggle "Search Bar"
	$( ".pb_header-global-search i" ).click(function() {
	  $( "body" ).toggleClass( "pb_search-open", function() {});
	});
	// Signup Footer
		
	$(function() {
		if (localStorage.getItem("showSignup") !==  "false") {
			$("body").removeClass("pb_footer-signup-relative");
		}
		if (localStorage.getItem("showSignup") ===  "false") {
		}
		$(".pb_global-signup-close").click(function() {
			$("body").addClass("pb_footer-signup-relative");
			localStorage.setItem("showSignup", "false");
	 	});
	});
});