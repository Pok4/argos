var _datMenuAnim="undefined"==typeof _datMenuAnim?400:_datMenuAnim,_datMenuEffect="undefined"==typeof _datMenuEffect?"effect-1":_datMenuEffect,_datMenuSublist="undefined"==typeof _datMenuSublist?!0:_datMenuSublist,_datMenuHeader="undefined"==typeof _datMenuHeader?!0:_datMenuHeader,_datMenuHeaderTitle="undefined"==typeof _datMenuHeaderTitle?'<a href="#"><img src="images/logo.png" style="background-color: #0589cd;" alt="" /></a>':_datMenuHeaderTitle,_datMenuSearch="undefined"==typeof _datMenuSearch?!0:_datMenuSearch,_datMenuCustomS="undefined"==typeof _datMenuCustomS?"fa-search":_datMenuCustomS,_datMenuCustomM="undefined"==typeof _datMenuCustomM?"fa-bars":_datMenuCustomM,_datMenuRootURL="undefined"==typeof _datMenuRootURL?"":_datMenuRootURL,myScroll;$(document).ready(function(){var e=_datMenuSublist?" dat-submenu":"";Modernizr.csstransforms3d||$("body").addClass("no-csstransforms3d"),$("body").addClass("has-dat-menu").wrapInner(function(){return'<div id="dat-menu" class="'+_datMenuEffect+'"><div class="dat-menu-container"><div class="dat-menu-wrapper"></div></div></div>'}),$("#dat-menu").append('<nav class="dat-menu-list'+e+'"><ul id="dat-menu-list-inner"></ul></nav>'),_datMenuHeader&&($(".dat-menu-wrapper").addClass("dat-menu-padding"),$(".dat-menu-container").prepend('<div class="dat-menu-top-header">'+_datMenuHeaderTitle+'<form action="'+_datMenuRootURL+'"><input type="text" name="s" value="" /><input type="submit" value="" /></form></div>'),_datMenuSearch&&$(".dat-menu-top-header").prepend('<a href="#" class="dat-menu-search"><i class="fa '+_datMenuCustomS+'"></i></a>'),$(".dat-menu-top-header").prepend('<a href="#dat-menu" class="dat-menu-menu"><i class="fa '+_datMenuCustomM+'"></i></a>')),$(".dat-menu-top-header input[type='text']").bind("blur",function(){$(".dat-menu-top-header").css("position","fixed").css("top","0px")}),$(".dat-menu-top-header .dat-menu-search").bind("click",function(){return $("html,body").animate({scrollTop:0}),$(".dat-menu-top-header").css("position","absolute").css("top","0px"),$(".dat-menu-top-header input[type='text']").focus(),!1}),$(".load-responsive").each(function(){var e=$(this);$(".dat-menu-list > ul").append('<li class="dat-menu-header"><span>'+e.attr("data-rel")+"</span></li>"+e.html())}),$(".dat-menu-list.dat-submenu > ul > li ul").each(function(){var e=$(this).parent();e.addClass("dat-has-sub")});var a=["background","background-size","background-image","background-color","background-repeat","background-position"];$.each(a,function(e,a){$(".dat-menu-container").css(a,$("body").css(a))}),$("#dat-menu-list-inner li > a").on("click tap",function(){var e=$(this).parent();if(0==e.hasClass("dat-has-sub")){var a=e.children("a");return window.location=a.attr("href"),!0}if(e.hasClass("dat-sub-active")){var a=e.children("a");return window.location=a.attr("href"),!0}return setTimeout(function(){e.addClass("dat-sub-active")},100),e.children("ul").children("li").css("display","none").animate({height:"toggle"},_datMenuAnim,function(){myScroll.refresh()}),!1}),$(".dat-menu-container").on("mousedown",function(){var e=$(this).parent();if(e.hasClass("dat-menu-load")){var a=Math.abs(parseInt($("#dat-menu > .dat-menu-container > .dat-menu-wrapper").css("top")));return e.removeClass("dat-menu-animate"),setTimeout(function(){e.removeClass("dat-menu-load"),e.removeClass("dat-menu-setup"),$(document).scrollTop(a),$("body").removeClass("datnomargin")},_datMenuAnim+100),!1}return!0}),$("#wpadminbar").appendTo("body"),myScroll=new IScroll(".dat-menu-list",{scrollbars:!1,mouseWheel:!0,interactiveScrollbars:!1,shrinkScrollbars:"scale",fadeScrollbars:!1,tap:!0}),$('a[href="#dat-menu"]').on("click",function(){var e=$(document).scrollTop(),a=$("#dat-menu");return a.find(".dat-menu-wrapper").css("top","-"+parseInt(e)+"px"),a.addClass("dat-menu-setup"),a.toggleClass("dat-menu-load"),setTimeout(function(){myScroll.refresh(),a.toggleClass("dat-menu-animate")},10),$("body").addClass("datnomargin"),!1})});