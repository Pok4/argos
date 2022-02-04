// some function that depends on jquery
head.ready(function () {

//slider
var sliderTimer = null;
var interval = 15000;

$('#slidebox .left').click(function()
{
	advanceLeft();
});

$('#slidebox .right').click(function()
{
	advanceRight();
});

function advanceRight()
{
	var current = $('#slidebox .slideImage.selected');
	var next = current.next();
	
	if(next.length == 0)
		next = $('#slidebox .slideImage:first-child');
		
	transitionImage(next);
}

function advanceLeft()
{
	var current = $('#slidebox .slideImage.selected');
	var next = current.prev();
	
	if(next.length == 0)
		next = $('#slidebox .slideImage:last-child');
		
	transitionImage(next);
}

function transitionImage(next)
{
	$('#slidebox .slideImage.selected').removeClass('selected');
	$(next).addClass('selected')
	
	var caption = $('img', next).attr('alt');
	var link = $('a', next).attr('href');
	
	$('#slidebox .caption_slider').text(caption);
	$('#slidebox .readMore').attr('href', link);
	
	autoTransition();
}

function autoTransition()
{
	if(sliderTimer != null)
	{
		clearTimeout(sliderTimer);
		sliderTimer = null;
	}
	
	sliderTimer = setTimeout(advanceRight, interval);
}

advanceRight();

 
//carousel
$('#mycarousel').jcarousel({
    scroll: 1, //the number of items to scroll by
    auto: 2, //the interval of scrolling
    wrap: 'last', //wrap at last item and jump back to the start
    visible:2
});


//gamecity
$('#mainNav > ul > li, .menu').each(function()
{
	if($('.submenu', this).length > 0)
	{
		$(this).click(function()
		{
			$(this).toggleClass('expanded');
		});
	}
});

$('#navToggle').change(function()
{
	$('#mainNav').slideToggle().toggleClass('expanded');
});

});