//get cookie (purejs)
function getCookie(e){var t=e+"=";var n=document.cookie.split(";");for(var r=0;r<n.length;r++){var i=n[r];while(i.charAt(0)==" ")i=i.substring(1,i.length);if(i.indexOf(t)==0)return i.substring(t.length,i.length)}return null};

// some function that depends on jquery
head.ready(function () {

//cookie policy
if ( $( ".cookie_bar" ).length ) {
	if (getCookie("argos_cookie_policy") == 1) {
    $('.cookie_bar').hide();
	} else {
    $('.cookie_bar').show();
    }	
$('.cookie_accept').click(function(){
  document.cookie ='argos_cookie_policy=1;expires=Wed, 31 Oct 3099 08:50:17 GMT;path=/'
  $('.cookie_bar').hide();
});
}

//download counter
$('.down_file').click(function(){
var file_id = $(this).attr("data-file");
var file_url = $(this).attr('href');
  $.ajax({
  type: "GET",
  cache: false,
  url: 'ajax/file_download_counter',
  data: "file_id=" + file_id,
  success: function(data){
    $(location).attr('href',file_url);
  }
  });
return false;
});

//magnific popup for files
if ( $( ".see_with_magnific").length ) {
	$('.see_with_magnific').magnificPopup({
  type: 'image',
  closeOnContentClick: true,
  mainClass: 'mfp-img-mobile',
  image: {
    verticalFit: true
  }
  });
}

//magnific popup for videos
if ( $( ".see_with_magnific_v").length ) {
        $('.see_with_magnific_v').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false
        });
}


//dropzone
if ( $( ".dropzone").length ) {
	$(".dropzone").dropzone({
	acceptedFiles: "image/*",
	addRemoveLinks: true, 
	clickable: true,
	success: function(file, response){
    $('.dz-filename').html('<br/><a href="'+response+'" class="down_pic">download</a>');
      }
	});
}

//greyfish
if ( $( "#greyfish2" ).length ) {
  $("#greyfish2").load( "greyfish/zone.php", function( response, status, xhr ) {if(status == "complete") { $(".greyfish-preload2").remove();}});
}
if ( $( "#greyfish" ).length ) {
  $("#greyfish").load( "greyfish/list.php", function( response, status, xhr ) {if(status == "complete") { $(".greyfish-preload").remove();}});
}

//Emoticons in news
var emojiElt =  $("#emoticons_here2").emojioneArea({autocomplete: false,saveEmojisAs: "shortname"});

//ajax chat
if ( $( ".main_chat" ).length ) {
var emojiElt =  $("#emoticons_here").emojioneArea({autocomplete: false,saveEmojisAs: "shortname"});

updateChat();

document.cookie ='chat_load_argos=1;expires=Wed, 31 Oct 3099 08:50:17 GMT;path=/'

$('.chat_submit').click(function(){
var text = emojiElt.data("emojioneArea").getText();
$.ajax({
  type: "POST",
  cache: false,
  url: 'ajax/chat_submit_post',
  data: "usernamec=" + $('.usernamec').val() + "&text1=" + encodeURIComponent(text),
  success: function(data){
    $('.emojionearea-editor').empty();
    $('.emojionearea-editor:first').focus();
  }
});

for(i=0;i<3;i++) {
 $('.main_chat').animate({scrollTop:$(document).height()}, 'slow');
}

return false;
});
}
//end ajax chat


//back to top
var settings = {
			min: 200,
			scrollSpeed: 400
		},
		toTop = $('.scroll-btn'),
		toTopHidden = true;

	$(window).scroll(function() {
		var pos = $(this).scrollTop();
		if (pos > settings.min && toTopHidden) {
			toTop.stop().fadeIn();
			toTopHidden = false;
		} else if(pos <= settings.min && !toTopHidden) {
			toTop.stop().fadeOut();
			toTopHidden = true;
		}
	});

	toTop.bind('click touchstart', function() {
		$('html, body').animate({
			scrollTop: 0
		}, settings.scrollSpeed);
  });

//votes for news
$(".vote-btn").click(function() 
{
var id = $(this).attr("data-my");
var name = $(this).attr("data-vote");
var dataString = 'id='+ id ;
var parent = $('#bid-'+id);

if(name=='upvote')
{

$(this).fadeIn(200).html('');
$.ajax({
   type: "POST",
   url: "ajax/vote_up_down/?for=news&vote=up",
   data: dataString,
   cache: false,

   success: function(html)
   {
   parent.html(html);
  
   }  
 });
 
}
else
{
$(this).fadeIn(200).html('');
$.ajax({
   type: "POST",
   url: "ajax/vote_up_down/?for=news&vote=down",
   data: dataString,
   cache: false,

   success: function(html)
   {
       parent.html(html);
   }
 });
}
  
return false;
});

//votes for comments
$(".vote-btn2").click(function() 
{
var id = $(this).attr("data-my");
var name = $(this).attr("data-vote");
var dataString = 'id='+ id ;
var parent = $('#bid-'+id);

if(name=='upvote')
{

$(this).fadeIn(200).html('');
$.ajax({
   type: "POST",
   url: "ajax/vote_up_down/?for=comments&vote=up",
   data: dataString,
   cache: false,

   success: function(html)
   {
   parent.html(html);
  
   }  
 });
 
}
else
{
$(this).fadeIn(200).html('');
$.ajax({
   type: "POST",
   url: "ajax/vote_up_down/?for=comments&vote=down",
   data: dataString,
   cache: false,

   success: function(html)
   {
       parent.html(html);
   }
 });
}
  
return false;
});

//remove chat msg
$( ".container" ).on( "click", ".remove_msg", function() {
var id = $(this).attr("data-my");
	if(confirm('Are you sure?!')) {
$.ajax({
   type: "GET",
   url: "ajax/chat_remove_message/?id=" + id,
  success: function(html)
  {
   $('#message-' + id).remove();
   alert(html);
  }  
});
  
 
return false;
	} else {
		return false;
	}
});

//multipurpose menu
var isLateralNavAnimating = false;
$(".hidden-button").click(function(event) 
{
		event.preventDefault();
		//stop if nav animation is running 
		 
		if( !isLateralNavAnimating ) {
			if($(this).parents('.csstransitions').length > 0 ) isLateralNavAnimating = true; 
			
			 
			$('body').toggleClass('navigation-is-open');
			$('.cd-navigation-wrapper').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				//animation is over
				isLateralNavAnimating = false;
			});
			
		}  
		
    var icon = $(this).find("i");
    if(icon.hasClass("fa-arrow-right")){
	   $('.hidden-button i').addClass('fa-arrow-left');
	   $('.hidden-button i').removeClass('fa-arrow-right');
    } else {
       $('.hidden-button i').addClass('fa-arrow-right');
       $('.hidden-button i').removeClass('fa-arrow-left');
    }

});

//responsive pagination
$('.toggle-pagination').click(function(f) {
  $(this).next('.pagination-responsive').slideToggle();
  $(this).toggleClass('active');
  f.preventDefault()
});

//change language
$( document ).on( "click", "a[data-langchange]", function() {
  var choosed_lang = $(this).attr("data-language");
  document.cookie ='argos_lang='+choosed_lang+';expires=Wed, 31 Oct 3099 08:50:17 GMT;path=/'
  location.reload();
  return false;
});
  
});

//popup for emoticons. This is function and the right place is here, not in head ready
function open_pop(){
  window.open('ajax/emoticons','mywin','right=20,top=20,width=500,height=300,toolbar=1,resizable=0');
}

//for updating the chat
setInterval( updateChat, 2000);
var chat_idz;
function updateChat() {
if ( $( ".main_chat" ).length ) {
  $.get("ajax/ajax_chat_data_reloader", {chat_id:chat_idz }, function(data) {
  $(".main_chat").html(data['chat']);
    if(data['chat_id'] != chat_idz) {
      $(".main_chat").scrollTop($(".main_chat")[0].scrollHeight)
    }
    chat_idz = data['chat_id'];
  },"json");
}
}

/*select banners*/
function hl_text(field) { 
  field.focus(); 
  field.select(); 
}