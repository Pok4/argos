head.ready(function(){function i(){$(this).find("ul").css("visibility","visible")}function e(){$(this).find("ul").css("visibility","hidden")}$("#menu li").bind("mouseover",i),$("#menu > li").bind("mouseout",e);var t=$("#pull"),o=$("ul#menu");$(t).on("click",function(i){i.preventDefault(),o.slideToggle()}),$(window).resize(function(){var i=$(window).width();i>767&&$("ul#menu").css("visibility","hidden")&&$("ul#menu").removeAttr("style");var e=$("#menu_wrapper").width();$("#pull").width(e-20)});var l=$("#menu_wrapper").width();$("#pull").width(l-20),$("link.colour-switcher2").attr("href",getCookie("colour-choice2")),$("a.switch").click(function(){var i=0;i=$("link.colour-switcher").attr("href",$(this).attr("data-rel")),document.cookie="colour-choice2="+$(this).attr("data-rel")+";expires=Wed, 31 Oct 3099 08:50:17 GMT;path=/",location.reload()}),getCookie("colour-choice2")&&getCookie("colour-choice2").indexOf("blue")&&($(".logo_replacer").attr("src","template/orizon/images/blue/logo.png"),$(".social_tleft").attr("src","template/orizon/images/blue/social_tleft.png"),$(".social_tright").attr("src","template/orizon/images/blue/social_tright.png")),$(".pgwSlider").pgwSlider({maxHeight:300,intervalDuration:4e3,displayControls:!0,listPosition:"left"}),$("#mycarousel").jcarousel({scroll:1,auto:2,wrap:"last",visible:2})});