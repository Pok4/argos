function getCookie(a){for(var b=a+"=",c=document.cookie.split(";"),d=0;d<c.length;d++){for(var e=c[d];" "==e.charAt(0);)e=e.substring(1,e.length);if(0==e.indexOf(b))return e.substring(b.length,e.length)}return null}function open_pop(){window.open("ajax/emoticons","mywin","right=20,top=20,width=500,height=300,toolbar=1,resizable=0")}function updateChat(){$(".main_chat").length&&$.get("ajax/ajax_chat_data_reloader",{chat_id:chat_idz},function(a){$(".main_chat").html(a.chat),a.chat_id!=chat_idz&&$(".main_chat").scrollTop($(".main_chat")[0].scrollHeight),chat_idz=a.chat_id},"json")}function hl_text(a){a.focus(),a.select()}head.ready(function(){$(".cookie_bar").length&&(1==getCookie("argos_cookie_policy")?$(".cookie_bar").hide():$(".cookie_bar").show(),$(".cookie_accept").click(function(){document.cookie="argos_cookie_policy=1;expires=Wed, 31 Oct 3099 08:50:17 GMT;path=/",$(".cookie_bar").hide()})),$(".down_file").click(function(){var a=$(this).attr("data-file"),b=$(this).attr("href");return $.ajax({type:"GET",cache:!1,url:"ajax/file_download_counter",data:"file_id="+a,success:function(a){$(location).attr("href",b)}}),!1}),$(".see_with_magnific").length&&$(".see_with_magnific").magnificPopup({type:"image",closeOnContentClick:!0,mainClass:"mfp-img-mobile",image:{verticalFit:!0}}),$(".see_with_magnific_v").length&&$(".see_with_magnific_v").magnificPopup({disableOn:700,type:"iframe",mainClass:"mfp-fade",removalDelay:160,preloader:!1,fixedContentPos:!1}),$(".dropzone").length&&$(".dropzone").dropzone({acceptedFiles:"image/*",addRemoveLinks:!0,clickable:!0,success:function(a,b){$(".dz-filename").html('<br/><a href="'+b+'" class="down_pic">download</a>')}}),$("#greyfish2").length&&$("#greyfish2").load("greyfish/zone.php",function(a,b,c){"complete"==b&&$(".greyfish-preload2").remove()}),$("#greyfish").length&&$("#greyfish").load("greyfish/list.php",function(a,b,c){"complete"==b&&$(".greyfish-preload").remove()});var a=$("#emoticons_here2").emojioneArea({autocomplete:!1,saveEmojisAs:"shortname"});if($(".main_chat").length){var a=$("#emoticons_here").emojioneArea({autocomplete:!1,saveEmojisAs:"shortname"});updateChat(),document.cookie="chat_load_argos=1;expires=Wed, 31 Oct 3099 08:50:17 GMT;path=/",$(".chat_submit").click(function(){var b=a.data("emojioneArea").getText();for($.ajax({type:"POST",cache:!1,url:"ajax/chat_submit_post",data:"usernamec="+$(".usernamec").val()+"&text1="+encodeURIComponent(b),success:function(a){$(".emojionearea-editor").empty(),$(".emojionearea-editor").focus()}}),i=0;i<3;i++)$(".main_chat").animate({scrollTop:$(document).height()},"slow");return!1})}var b={min:200,scrollSpeed:400},c=$(".scroll-btn"),d=!0;$(window).scroll(function(){var a=$(this).scrollTop();a>b.min&&d?(c.stop().fadeIn(),d=!1):a<=b.min&&!d&&(c.stop().fadeOut(),d=!0)}),c.bind("click touchstart",function(){$("html, body").animate({scrollTop:0},b.scrollSpeed)}),$(".vote-btn").click(function(){var a=$(this).attr("data-my"),b=$(this).attr("data-vote"),c="id="+a,d=$("#bid-"+a);return"upvote"==b?($(this).fadeIn(200).html(""),$.ajax({type:"POST",url:"ajax/vote_up_down/?for=news&vote=up",data:c,cache:!1,success:function(a){d.html(a)}})):($(this).fadeIn(200).html(""),$.ajax({type:"POST",url:"ajax/vote_up_down/?for=news&vote=down",data:c,cache:!1,success:function(a){d.html(a)}})),!1}),$(".vote-btn2").click(function(){var a=$(this).attr("data-my"),b=$(this).attr("data-vote"),c="id="+a,d=$("#bid-"+a);return"upvote"==b?($(this).fadeIn(200).html(""),$.ajax({type:"POST",url:"ajax/vote_up_down/?for=comments&vote=up",data:c,cache:!1,success:function(a){d.html(a)}})):($(this).fadeIn(200).html(""),$.ajax({type:"POST",url:"ajax/vote_up_down/?for=comments&vote=down",data:c,cache:!1,success:function(a){d.html(a)}})),!1}),$(".container").on("click",".remove_msg",function(){var a=$(this).attr("data-my");return!!confirm("Are you sure?!")&&($.ajax({type:"GET",url:"ajax/chat_remove_message/?id="+a,success:function(b){$("#message-"+a).remove(),alert(b)}}),!1)});var e=!1;$(".hidden-button").click(function(a){a.preventDefault(),e||($(this).parents(".csstransitions").length>0&&(e=!0),$("body").toggleClass("navigation-is-open"),$(".cd-navigation-wrapper").one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",function(){e=!1})),$(this).find("i").hasClass("fa-arrow-right")?($(".hidden-button i").addClass("fa-arrow-left"),$(".hidden-button i").removeClass("fa-arrow-right")):($(".hidden-button i").addClass("fa-arrow-right"),$(".hidden-button i").removeClass("fa-arrow-left"))}),$(".toggle-pagination").click(function(a){$(this).next(".pagination-responsive").slideToggle(),$(this).toggleClass("active"),a.preventDefault()}),$(document).on("click","a[data-langchange]",function(){var a=$(this).attr("data-language");return document.cookie="argos_lang="+a+";expires=Wed, 31 Oct 3099 08:50:17 GMT;path=/",location.reload(),!1})}),setInterval(updateChat,2e3);var chat_idz;