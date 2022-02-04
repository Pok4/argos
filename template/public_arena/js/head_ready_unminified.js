// some function that depends on jquery
head.ready(function () {

//slider
$('.pgwSlider').pgwSlider({
    maxHeight : 300,
    intervalDuration : 4000,
	displayControls: true,
	listPosition: 'left',
  }
);
//slider
 
//carousel
$('#mycarousel').jcarousel({
    scroll: 1, //the number of items to scroll by
    auto: 2, //the interval of scrolling
    wrap: 'last', //wrap at last item and jump back to the start
    visible:2
    });
//end

/*public arena*/
$('.backtotop').click(function() {
$("html, body").animate({scrollTop: 0}, 500);
});
$(".head_bar").sticky({topSpacing:0})

});