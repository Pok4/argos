// some function that depends on jquery
head.ready(function () {
  
  //orizon theme
  $('#menu li').bind('mouseover', openSubMenu);
  $('#menu > li').bind('mouseout', closeSubMenu);
  
  function openSubMenu() {
    $(this).find('ul').css('visibility', 'visible');
  };
  
  function closeSubMenu() {
    $(this).find('ul').css('visibility', 'hidden');
  };
  var pull    = $('#pull');
  var menuz 		= $('ul#menu');
  
  $(pull).on('click', function(e) {
    e.preventDefault();
    menuz.slideToggle();
  });
  
  $(window).resize(function(){
    var w = $(window).width();
    if(w > 767 && $('ul#menu').css('visibility', 'hidden')) {
      $('ul#menu').removeAttr('style');
    };
    var menu = $('#menu_wrapper').width();
    $('#pull').width(menu - 20);
  });
  
  var menu = $('#menu_wrapper').width();
  $('#pull').width(menu - 20);
  
  
  //style sw
  $("link.colour-switcher2").attr("href", getCookie("colour-choice2")); 
  $("a.switch").click(function() {
    var style_sw=0; 
    style_sw = $("link.colour-switcher").attr("href", $(this).attr("data-rel"));
    document.cookie ='colour-choice2='+ $(this).attr("data-rel") +';expires=Wed, 31 Oct 3099 08:50:17 GMT;path=/';	
    location.reload();
  });
  
  if(getCookie("colour-choice2") && getCookie("colour-choice2").indexOf('blue')) {
   $('.logo_replacer').attr('src', 'template/orizon/images/blue/logo.png');
   $('.social_tleft').attr('src', 'template/orizon/images/blue/social_tleft.png');
   $('.social_tright').attr('src', 'template/orizon/images/blue/social_tright.png');
  }
  
  //slider
  $('.pgwSlider').pgwSlider({
    maxHeight : 300,
    intervalDuration : 4000,
    displayControls: true,
    listPosition: 'left',
  });
  
  //carousel
  $('#mycarousel').jcarousel({
    scroll: 1, //the number of items to scroll by
    auto: 2, //the interval of scrolling
    wrap: 'last', //wrap at last item and jump back to the start
    visible:2
  });
  
  
});