// some function that depends on jquery
head.ready(function () {
//carousel
$('#mycarousel').jcarousel({
    scroll: 1, //the number of items to scroll by
    auto: 2, //the interval of scrolling
    wrap: 'last', //wrap at last item and jump back to the start
    visible:2
});

//progaming
//NAVBAR
	$('.navbar .nav > li.dropdown').mouseenter(function() {
		$(this).addClass('open');
	});
	
	$('.navbar .nav > li.dropdown').mouseleave(function() {
		$(this).removeClass('open');
	});
	
	$.vegas('slideshow', {
		delay:5000,
		backgrounds:[
			{ src:'template/esport/img/background-1.jpg', fade:1500 },
			{ src:'template/esport/img/background-2.jpg', fade:1500 },
			{ src:'template/esport/img/background-3.jpg', fade:1500 },
			{ src:'template/esport/img/background-4.jpg', fade:1500 },
			{ src:'template/esport/img/background-5.jpg', fade:1500 },
	  	]
	})('overlay', {src:'template/esport/img/overlayz.png'});
	
	//SCROLLING
	$("a.scroll[href^='#']").on('click', function(e) {
		e.preventDefault();
		var hash = this.hash;
		$('html, body').animate({ scrollTop: $(this.hash).offset().top - 110}, 1000, function(){window.location.hash = hash;});
	});

	
	//OWL CAROUSEL
	$("#jumbotron-slider").owlCarousel({
		pagination : false,
		itemsDesktop :[1200,3],
		itemsDesktopSmall :[991,2],
		items : 3,
		navigation : true,
		navigationText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"]
  	});
	
	$('#open-search').on('click', function() {
		$(this).toggleClass('show2 hidden');
		$('#close-search').toggleClass('show2 hidden');
		$("#navbar-search-form").toggleClass('show2 hidden animated fadeInDown');
		return false;
	});
	$('#close-search').on('click', function() {
		$(this).toggleClass('show2 hidden');
		$('#open-search').toggleClass('show2 hidden');;
		$("#navbar-search-form").toggleClass('fadeInDown fadeOutUp');
		setTimeout(function(){
			$("#navbar-search-form").toggleClass('show2 hidden animated fadeOutUp');
		}, 500);
		return false;
	});
	
	$('#open-login').on('click', function() {
		$(this).toggleClass('show2 hidden');
		$('#close-login').toggleClass('show2 hidden');
		$("#navbar-login-form").toggleClass('show2 hidden animated fadeInDown');
		return false;
	});
	$('#close-login').on('click', function() {
		$(this).toggleClass('show2 hidden');
		$('#open-login').toggleClass('show2 hidden');;
		$("#navbar-login-form").toggleClass('fadeInDown fadeOutUp');
		setTimeout(function(){
			$("#navbar-login-form").toggleClass('show2 hidden animated fadeOutUp');
		}, 500);
		return false;
	});
//end programing

});
