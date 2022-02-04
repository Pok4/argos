// some function that depends on jquery
head.ready(function () {

//GameForest Theme
    $("[data-toggle='tooltip']").tooltip({
        container: "body"
    }), $("[data-toggle='popover']").popover(), $(window).scroll(function() {
        $(this).scrollTop() > 40 ? $("body").addClass("header-scroll") : $("body").removeClass("header-scroll")
        }), $("[data-toggle='modal-search']").click(function() {
        return $("body").toggleClass("search-open"), !1
    }), $(".modal-search .close").click(function() {
        return $("body").removeClass("search-open"), !1
    }), $("[data-toggle='fixed-header']").click(function() {
        return $("body").toggleClass("fixed-header"), !1
    }), setTimeout(function() {
       $(".progress-animation .progress-bar").each(function() {
            var e = $(this),
                t = e.attr("aria-valuenow"),
                n = 0,
                i = setInterval(function() {
                    n >= t ? clearInterval(i) : (n += 1, e.css("width", n + "%"))
                }, 0)
        })
    }, 0),   $(".bar").click(function() {
        $("body").toggleClass("nav-open"), $("#wrapper").click(function() {
            $("body").removeClass("nav-open")
        })
    }), $("section.background-image.full-height").each(function() {
        $(this).css("height", $(window).height())
    }), $(window).resize(function() {
        $("section.background-image.full-height").each(function() {
            $(this).css("height", $(window).height())
        })
    }),  $("nav .dropdown > a").click(function() {
        return !1
    }), $("nav .dropdown-submenu > a").click(function() {
        return !1
    }), $("nav ul li.dropdown").hover(function() {
        $(this).addClass("open");
        var e = $(this).data("effect");
        e ? $(this).find(".dropdown-menu").addClass("animated " + e) : $(this).find(".dropdown-menu").addClass("animated fast fadeIn")
    }, function() {
        $(this).removeClass("open");
        var e = $(this).data("effect");
        e ? $(this).find(".dropdown-menu").removeClass("animated " + e) : $(this).find(".dropdown-menu").removeClass("animated fast fadeIn")
    }), $("nav .dropdown-submenu").hover(function() {
        $(this).addClass("open")
    }, function() {
        $(this).removeClass("open")
});


$(".owl-carousel").owlCarousel({
			autoPlay: true,
			items : 6, //4 items above 1000px browser width
			itemsDesktop : [1600,3], //3 items between 1000px and 0
			itemsTablet: [940,1], //1 items between 600 and 0
			itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
}); 
 
//carousel
$('#mycarousel').jcarousel({
    scroll: 1, //the number of items to scroll by
    auto: 2, //the interval of scrolling
    wrap: 'last', //wrap at last item and jump back to the start
    visible:2
});


});