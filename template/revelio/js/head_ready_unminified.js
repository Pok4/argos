// some function that depends on jquery
head.ready(function () {
  
  var thetop = parseInt(($(window).height()/2)-50);
  var isinsitelikes = false;
  var isinsitememb = false;
  var timer;
  var timerb;

	// Check if the device supports touch events
	if('ontouchstart' in document.documentElement) {
		// Loop through each stylesheet
		for(var sheetI = document.styleSheets.length - 1; sheetI >= 0; sheetI--) {
			var sheet = document.styleSheets[sheetI];
			// Verify if cssRules exists in sheet
			if(sheet.cssRules) {
				// Loop through each rule in sheet
				for(var ruleI = sheet.cssRules.length - 1; ruleI >= 0; ruleI--) {
					var rule = sheet.cssRules[ruleI];
					// Verify rule has selector text
					if(rule.selectorText) {
						// Replace hover psuedo-class with active psuedo-class
						rule.selectorText = rule.selectorText.replace(":hover", ":active");
					}
				}
			}
		}
	}

	$(document).on("ready resize", function() {
		resizeSidebar();
	});

	function resizeSidebar(){
		$("#sidebar").css("min-height", parseInt($("#main").height())+65);
	}

	setTimeout(function(){resizeSidebar()}, 200);

		
		$("body").append("<div id='_strike-tooltip'></div>");
		$("body").append("<div class='likes-tooltip'></div>");
		$("body").append("<div id='_strike-user'></div>");
		
		$(".strike-tooltip").mouseenter(function(){
			if($(this).attr("title")){
				var offset = $(this).offset();
				$("#_strike-tooltip").html($(this).attr("title"));
				$(this).attr("title", "");
				$("#_strike-tooltip").addClass("active");
				$("#_strike-tooltip").css("left", offset.left+"px").css("top", offset.top+"px");
				var wii = (parseInt($(this).css("width"))/2);
				var wiiii = ((parseInt($("#_strike-tooltip").css("width"))+parseInt($("#_strike-tooltip").css("padding-right"))+parseInt($("#_strike-tooltip").css("padding-left")))/2);
				$("#_strike-tooltip").css("margin-left", ((wiiii-wii)*(-1))+"px");
			}
		}).mouseleave(function(){
			$("#_strike-tooltip").removeClass("active");
			$(this).attr("title", $("#_strike-tooltip").html());
		});

		// Js like tooltip

		$('.likes-tooltip').hover(function() {
			isinsitelikes = true;
		},function() {
			if(timer) {
				clearTimeout(timer);
				timer = null;
			}
			isinsitelikes = false;
			timer = setTimeout(function() {
				if(isinsitelikes == true)return false;
				$(".likes-tooltip").removeClass("active");
				$(".likes-tooltip").html("");
			}, 500);
	    });

		$('.show-likes').hover(function() {
			if(timer) {
				clearTimeout(timer);
				timer = null;
			}
			var offset = $(this).offset();
			$(".likes-tooltip").html('<div class="like-button"><a href="#">4 people like this</a></div><a href="#" class="avatar online strike-tooltip" title="John Doe"><img src="img//photos/avatar-1.jpg" alt="" title="" /></a><a href="#" class="avatar online" title="minkka."><img src="img//photos/avatar-2.jpg" alt="" title="" /></a><a href="#" class="avatar offline" title="Alfred"><img src="img//photos/avatar-3.jpg" alt="" title="" /></a><a href="#" class="avatar away" title="Orangutan"><img src="img//photos/avatar-4.jpg" alt="" title="" /></a>');
			$(".likes-tooltip").css("left", offset.left+"px").css("top", offset.top+"px");
			var wii = (parseInt($(this).css("width"))/2);
			var wiiii = ((parseInt($(".likes-tooltip").css("width"))+parseInt($(".likes-tooltip").css("padding-right"))+parseInt($(".likes-tooltip").css("padding-left")))/2);
			timer = setTimeout(function() {
				$(".likes-tooltip").css("margin-left", ((wiiii-wii)*(-1))+"px");
				$(".likes-tooltip").addClass("active");
			}, 500);
	    },function() {
			if(timer) {
				clearTimeout(timer);
				timer = null;
			}
			timer = setTimeout(function() {
				if(isinsitelikes == true)return false;
				$(".likes-tooltip").removeClass("active");
				$(".likes-tooltip").html("");
			}, 500);
	    });
		
		// content tooltip

		$('#_strike-user').hover(function() {
			isinsitememb = true;
		},function() {
			if(timerb) {
				clearTimeout(timerb);
				timerb = null;
			}
			isinsitememb = false;
			timerb = setTimeout(function() {
				if(isinsitememb == true)return false;
				$("#_strike-user").removeClass("active");
				$("#_strike-user").html("");
			}, 500);
	    });
		
		$('.user-tooltip').hover(function() {
			if(timerb) {
				clearTimeout(timerb);
				timerb = null;
			}
			var offset = $(this).offset();
			var position = $(window).scrollTop();
			var karsejmeitene = offset.top-position;
			if(karsejmeitene <= 200){
				$("#_strike-user").addClass("upsidedown");
			}else{
				$("#_strike-user").removeClass("upsidedown");
			}
			$("#_strike-user").html('<a href="#" class="username" style="background:#232323;color:#fff;">John Doe</a><a href="#" class="avatar online"><span class="wrapimg" style="display:inline-block;position:relative;border-radius:inherit;-moz-border-radius:inherit;overflow:hidden;"><img src="img//photos/avatar-11.jpg" alt="" /></span></a><div class="info"><div>"The one who digs a hole, has a shovel"</div><div><font>Group:</font><span class="admin-ribbon">main admin</span></div><div><font>Now:</font>Reading topic "<a href="#"><b>Do you wanna be a billionaire ?</b></a>"</div></div><div class="clear-float"></div><div class="bottom"><a href="#" class="com-control"><i class="fa fa-envelope"></i>Private message</a><a href="#" class="com-control"><i class="fa fa-file-text-o"></i>View profile</a></div>');
			$("#_strike-user").css("left", offset.left+"px").css("top", offset.top+"px");
			var wii = (parseInt($(this).css("width"))/2);
			var wiiii = ((parseInt($("#_strike-user").css("width"))+parseInt($("#_strike-user").css("padding-right"))+parseInt($("#_strike-user").css("padding-left")))/2);
			timerb = setTimeout(function() {
				$("#_strike-user").css("margin-left", ((wiiii-wii)*(-1))+"px");
				$("#_strike-user").addClass("active");
			}, 500);
	    },function() {
			if(timerb) {
				clearTimeout(timerb);
				timerb = null;
			}
			timerb = setTimeout(function() {
				if(isinsitememb == true)return false;
				$("#_strike-user").removeClass("active");
				$("#_strike-user").html("");
			}, 500);
	    });

		// toggle comments
		
		$("a[href='#show-responses']").click(function (){
			$(".drop.active").children().find("li.new").each(function () {
				$(this).removeClass("new");
			});
			$(this).parent().parent().find(".comment-responses").toggleClass("active");
			return false;
		});
		
		$("a[href='#drop-the-bass']").click(function (){
			$(".drop.active").children().find("li.new").each(function () {
				$(this).removeClass("new");
			});
			$("a[href='#drop-the-bass']").not(this).parent().find(".drop").removeClass("active");
			$(this).parent().find(".drop").toggleClass("active");
			$("html, body").animate({ scrollTop: 0 }, "fast");
			$(this).find("span.fadeout").fadeOut("fast");
			return false;
		});

		$("body").click(function(){
			$(".drop.active").children().find("li.new").each(function () {
				$(this).removeClass("new");
			});
			$(".drop.active").removeClass("active");
		});

		$("a[href='#top']").click(function () {
			$("html, body").animate({ scrollTop: 0 }, "fast");
			return false;
		});


	$(document).scroll(function() {
		var position = $(window).scrollTop();
		if(position <= 180) {
			$("#header-top ul li a span").removeClass('gotop');
		}else{
			$("#header-top ul li a span").addClass('gotop');
		}

	});


	//menu background
  $("#menu-bottom").addClass("blurred");
  reloadMenuBlur($(".featured-img-box").css("background-image"));

    
  //carousel
  $('#mycarousel').jcarousel({
      scroll: 1, //the number of items to scroll by
      auto: 2, //the interval of scrolling
      wrap: 'last', //wrap at last item and jump back to the start
      visible:2
  });


//slider
$('.pgwSlider').pgwSlider({
  maxHeight : 300,
  intervalDuration : 4000,
	displayControls: true,
	listPosition: 'left',
});

});

function reloadMenuBlur(blurel){
	if($("body").hasClass("no-slider")){
		var blurel = $(".featured-img-box").css("background-image");
	}
	$("#menu-bottom #menu").css("background-image", blurel);
}

function surroundSelection(sel, element) {
	if (window.getSelection) {
		if (sel.rangeCount) {
			var range = sel.getRangeAt(0).cloneRange();
			range.surroundContents(element);
			sel.removeAllRanges();
			sel.addRange(range);
		}
	}
}

 

function addZero(number){
	if(number.toString().length == 1){
		return "0"+number;
	}else{
		return number;
	}
}

function secondsToHms(d) {
	d = Number(d);
	var h = Math.floor(d / 3600);
	var days = addZero(Math.floor(h / (24)));
	h = addZero(Math.floor((d / 3600)-(days*24)));
	var m = addZero(Math.floor(d % 3600 / 60));
	var s = addZero(Math.floor(d % 3600 % 60));
	return days+":"+h+":"+m+":"+s;
}