!function(t,n){var e="carousel",a=4e3,i={play:function(){var n=t(this),i=n.attr("data-interval"),o=parseFloat(i)||a;return n.data("timer",setInterval(function(){n[e]("next")},o))},stop:function(){clearTimeout(t(this).data("timer"))},_bindStopListener:function(){return t(this).bind("mousedown",function(){t(this)[e]("stop")})},_initAutoPlay:function(){var n=t(this).attr("data-autoplay"),a="undefined"!=typeof n&&"false"!==n.toLowerCase();a&&t(this)[e]("_bindStopListener")[e]("play")}};t.extend(t.fn[e].prototype,i),t(document).bind("create."+e,function(n){t(n.target)[e]("_initAutoPlay")})}(jQuery);