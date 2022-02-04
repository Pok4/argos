// some function that depends on jquery
head.ready(function () {

//opacity to sidr button	
for(i=0;i<3;i++) {
$('#open-sidr').fadeTo('slow', 0.5).fadeTo('slow', 1.0);
}

//tooltip
$('.tipso').tipso({ 
  background:'#3498db',
  width:'150px',
});

//sidr
$('#open-sidr').sidr({
   name: 'sidr-existing-content',
   source: '#sidr-panel-open',
   side: 'right',
       onOpen: function(name) {
		 $('.tipso').tipso('hide');
         $('.tipso').tipso('destroy');
    },
	onClose: function(name) {
        $('.tipso').tipso( {
		background:'#3498db',
		width:'150px',
		 
		});
    },
});

//close sidr
$('#sidr-id-close-sidr').click(function() {
 $.sidr('close', 'sidr-existing-content');
});

//style sw
$("link.colour-switcher").attr("href", getCookie("colour-choice")); 
  $("a.sidr-class-switch").click(function() {
  var style_sw=0; 
  style_sw = $("link.colour-switcher").attr("href", $(this).attr("data-rel"));
  document.cookie ='colour-choice='+ $(this).attr("data-rel") +';expires=Wed, 31 Oct 3099 08:50:17 GMT;path=/';	
  location.reload();
});

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