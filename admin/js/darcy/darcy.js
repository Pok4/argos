var darcy_element = '.darcy'; //our element
 
//emoticons
var darcy_emoticons = [
	  "<img src=\"http://i.imgur.com/kM0PdWU.gif\" onclick=\"show_emos('0')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/KVnuEHL.gif\" onclick=\"show_emos('1')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/t2RAAD9.gif\" onclick=\"show_emos('2')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/LEYnCi4.gif\" onclick=\"show_emos('3')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/n34xOuy.gif\" onclick=\"show_emos('4')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/tnadycC.gif\" onclick=\"show_emos('5')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/OjdJK0B.gif\" onclick=\"show_emos('6')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/pQtOgpA.gif\" onclick=\"show_emos('7')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/6v8D8LH.gif\" onclick=\"show_emos('8')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/eIBPRfY.gif\" onclick=\"show_emos('9')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/BaTMEhT.gif\" onclick=\"show_emos('10')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/nscGiyH.gif\" onclick=\"show_emos('11')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/mUKxhiJ.gif\" onclick=\"show_emos('12')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/Avhzv6O.gif\" onclick=\"show_emos('13')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/4ak5jY8.gif\" onclick=\"show_emos('14')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/0YuswtC.gif\" onclick=\"show_emos('15')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/xtTjece.gif\" onclick=\"show_emos('16')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/QstPKpR.gif\" onclick=\"show_emos('17')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/xUtVwW3.gif\" onclick=\"show_emos('18')\" border='0' alt='' />",
	  "<img src=\"http://i.imgur.com/I11A4iw.png\" onclick=\"show_emos('19')\" border='0' alt='' />",
];
//end emoticons
var editor =""; //we catch what we need :P
 
$(function () {

$(darcy_element).each(function() {

//Ace Editor
var textarea = $(this);
var mode = textarea.data('editor');
var editDiv = $('<div>', {
    position: 'absolute',
    width: '100%',
    height: textarea.height(),
    'class': textarea.attr('class')
}).insertBefore(textarea);
textarea.css('display', 'none');
editor = ace.edit(editDiv[0]);
editor.$blockScrolling = Infinity; //prevent warnings
//editor.renderer.setShowGutter(false);
editor.getSession().setValue(textarea.val());
editor.getSession().setUseWrapMode(true); //div like real textarea
editor.getSession().setMode("ace/mode/" + mode);

// copy back to textarea on form submit...
editor.getSession().on('change', function(){
textarea.val(editor.getSession().getValue());
});

 
var darcy = this; //our darcy
 
//preview div add
$('.ace_editor').before('<div id="darcy-smilies-preview" style="max-width:700px"></div>');
//end preview div add

//toolbar
$('.ace_editor').before("<div class='toolbar-darcy'><i title='Bold text' class='fa fa-bold darcy-bold'></i>&nbsp;&nbsp;<i title='Italic text' class='fa fa-italic darcy-italic'></i>&nbsp;&nbsp;<i title='Underline text' class='fa fa-underline darcy-under'></i>&nbsp;&nbsp;<i title='Img insert' class='fa fa-picture-o darcy-img'></i>&nbsp;&nbsp;<i title='Insert link' class='fa fa-link darcy-link'></i>&nbsp;&nbsp;<i title='Smilies' class='fa fa-smile-o darcy-smile'></i>&nbsp;&nbsp;<i title='Center text' class='fa fa-align-center darcy-center'></i>&nbsp;&nbsp;<i title='Youtube video insert' class='fa fa-youtube darcy-youtube'></i>&nbsp&nbsp;<i title='Color picker' class='fa fa-font darcy-color' id='color'></i>&nbsp;&nbsp;<i title='Generate Bootstrap table' class='fa fa-table darcy-table'></i>&nbsp;&nbsp;<select class='darcy-font'><option>Font-size</option><option value='12px'>12px</option><option value='13px'>13px</option><option value='14px'>14px</option><option value='15px'>15px</option><option value='16px'>16px</option><option value='17px'>17px</option><option value='18px'>18px</option><option value='19px'>19px</option><option value='20px'>20px</option></select>&nbsp;&nbsp;<i title='Erase text' class='fa fa-eraser darcy-erase'></i>&nbsp;&nbsp;<i title='About' class='fa fa-info-circle darcy-about'></i></div>");

//our functions

//bold
$( ".darcy-bold" ).click(function() {
 
editor.find(editor.session.getTextRange(editor.getSelectionRange()));
editor.replace('<strong>' + editor.session.getTextRange(editor.getSelectionRange()) + '</strong>');
  
})
//end bold

//italic
$('.darcy-italic').click(function() {

editor.find(editor.session.getTextRange(editor.getSelectionRange()));
editor.replace('<em>' + editor.session.getTextRange(editor.getSelectionRange()) + '</em>');

});
//end italic

//underline
$('.darcy-under').click(function() {
editor.find(editor.session.getTextRange(editor.getSelectionRange()));
editor.replace("<u>" + editor.session.getTextRange(editor.getSelectionRange()) + "</u>");
});
//end underline

//image
$('.darcy-img').click(function() {

editor.find(editor.session.getTextRange(editor.getSelectionRange()));
editor.replace("<img src='" + editor.session.getTextRange(editor.getSelectionRange()) + "' alt='Your Text'/>");

});
//end image

//about
$('.darcy-about').click(function() {
	alert('Made by val4o0o0 @ dedihost.org');
});
//end about

//link
$('.darcy-link').click(function() {

editor.find(editor.session.getTextRange(editor.getSelectionRange()));
editor.replace("<a href='" + editor.session.getTextRange(editor.getSelectionRange()) + "' title='Your Text'>Your Text</a>");

});
//end link

//center
$('.darcy-center').click(function() {

editor.find(editor.session.getTextRange(editor.getSelectionRange()));
editor.replace("<div style='text-align:center'>" + editor.session.getTextRange(editor.getSelectionRange()) + "</div>");
	
});
//end center

//smilies
$('.darcy-smile').click(function() {
 
 $('#darcy-smilies-preview').toggle();
 $('#darcy-smilies-preview').html(darcy_emoticons);
});
//end smilies

//table
$('.darcy-table').click(function() {
var content_now = $(darcy_element).val();
var newData = content_now+'<div class="table-responsive">\n<table class="table">\n<tr>\n<td>Your Text</td>\n<td>Your Text</td>\n<td>Your Text</td>\n<td>Your Text</td>\n</tr>\n<tr>\n<td>Your Text</td>\n<td>Your Text</td>\n<td>Your Text</td>\n<td>Your Text</td>\n</tr>\n</table>\n</div>';

editor.insert(newData);
});
//end table

//color
$('.darcy-color').click(function() {
var hex_sel = "";
$(".darcy-color").ColorPicker({
        color: '#0000ff',
        onShow: function (colpkr) {
            $(colpkr).fadeIn(500);
            return false;
        },
        onHide: function (colpkr) {
            $(colpkr).fadeOut(500);
            return false;
        },
        onChange: function (hsb, hex, rgb) {
			hex_sel = hex; 
        },
		onSubmit: function(hsb, hex, rgb) {
		editor.find(editor.session.getTextRange(editor.getSelectionRange()));
		editor.replace("<span style='color:#"+hex+"'>" + editor.session.getTextRange(editor.getSelectionRange()) + "</span>");
	    }
});   
 				 
});
//end clor

//font size
$('.darcy-font').on('change',function(){
	editor.find(editor.session.getTextRange(editor.getSelectionRange()));
	editor.replace("<span style='font-size:"+this.value+"'>" + editor.session.getTextRange(editor.getSelectionRange()) + "</span>");
});
//end font-size

//eraser
$('.darcy-erase').click(function() {
	editor.setValue("");
});
//end eraser

//youtube
$('.darcy-youtube').click(function() {
$(".toolbar-darcy").append("<div class='youtube-bar'>Youtube video ID: <input style='color:#000' id='youtubeid' type='text'><div type='button' style='max-width:50px' class='confirm-y-id btn btn-success'>OK</div></div>")

$('.confirm-y-id').click(function() {
var youtube_id = $('#youtubeid').val();
$('.youtube-bar').hide();
	editor.insert("<iframe height=\"315\" src=\"https://www.youtube.com/embed/"+youtube_id+"\" style=\"width:100%;border:0;\"  allowfullscreen></iframe>");
});

});
//end youtube

//end our functions

//hover effect
$(".toolbar-darcy i").mouseover(function(){
    $(this).css("cursor", "pointer");
});
$(".toolbar-darcy i").mouseout(function() {
	 $(this).css("cursor", "0");
});
//end

});
  

});	

//show emos
function show_emos(valuez){
var content_now = $(darcy_element).val();
var newData = content_now+darcy_emoticons[valuez];
$('#darcy-smilies-preview').hide();
editor.insert(newData);
}

/*color picker*/
!function(e){var o=function(){var o=65,t='<div class="colorpicker"><div class="colorpicker_color"><div><div></div></div></div><div class="colorpicker_hue"><div></div></div><div class="colorpicker_new_color"></div><div class="colorpicker_current_color"></div><div class="colorpicker_hex"><input type="text" maxlength="6" size="6" /></div><div class="colorpicker_rgb_r colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_submit"></div></div>',r={eventName:"click",onShow:function(){},onBeforeShow:function(){},onHide:function(){},onChange:function(){},onSubmit:function(){},color:"ff0000",livePreview:!0,flat:!1},i=function(o,t){var r=j(o);e(t).data("colorpicker").fields.eq(1).val(r.r).end().eq(2).val(r.g).end().eq(3).val(r.b).end()},a=function(o,t){e(t).data("colorpicker").fields.eq(4).val(o.h).end().eq(5).val(o.s).end().eq(6).val(o.b).end()},n=function(o,t){e(t).data("colorpicker").fields.eq(0).val(B(o)).end()},c=function(o,t){e(t).data("colorpicker").selector.css("backgroundColor","#"+B({h:o.h,s:100,b:100})),e(t).data("colorpicker").selectorIndic.css({left:parseInt(150*o.s/100,10),top:parseInt(150*(100-o.b)/100,10)})},d=function(o,t){e(t).data("colorpicker").hue.css("top",parseInt(150-150*o.h/360,10))},l=function(o,t){e(t).data("colorpicker").currentColor.css("backgroundColor","#"+B(o))},s=function(o,t){e(t).data("colorpicker").newColor.css("backgroundColor","#"+B(o))},p=function(t){var r=t.charCode||t.keyCode||-1;if(r>o&&90>=r||32==r)return!1;var i=e(this).parent().parent();i.data("colorpicker").livePreview===!0&&u.apply(this)},u=function(o){var t,r=e(this).parent().parent();r.data("colorpicker").color=t=this.parentNode.className.indexOf("_hex")>0?E(z(this.value)):this.parentNode.className.indexOf("_hsb")>0?H({h:parseInt(r.data("colorpicker").fields.eq(4).val(),10),s:parseInt(r.data("colorpicker").fields.eq(5).val(),10),b:parseInt(r.data("colorpicker").fields.eq(6).val(),10)}):T(O({r:parseInt(r.data("colorpicker").fields.eq(1).val(),10),g:parseInt(r.data("colorpicker").fields.eq(2).val(),10),b:parseInt(r.data("colorpicker").fields.eq(3).val(),10)})),o&&(i(t,r.get(0)),n(t,r.get(0)),a(t,r.get(0))),c(t,r.get(0)),d(t,r.get(0)),s(t,r.get(0)),r.data("colorpicker").onChange.apply(r,[t,B(t),j(t)])},f=function(){var o=e(this).parent().parent();o.data("colorpicker").fields.parent().removeClass("colorpicker_focus")},h=function(){o=this.parentNode.className.indexOf("_hex")>0?70:65,e(this).parent().parent().data("colorpicker").fields.parent().removeClass("colorpicker_focus"),e(this).parent().addClass("colorpicker_focus")},v=function(o){var t=e(this).parent().find("input").focus(),r={el:e(this).parent().addClass("colorpicker_slider"),max:this.parentNode.className.indexOf("_hsb_h")>0?360:this.parentNode.className.indexOf("_hsb")>0?100:255,y:o.pageY,field:t,val:parseInt(t.val(),10),preview:e(this).parent().parent().data("colorpicker").livePreview};e(document).bind("mouseup",r,g),e(document).bind("mousemove",r,m)},m=function(e){return e.data.field.val(Math.max(0,Math.min(e.data.max,parseInt(e.data.val+e.pageY-e.data.y,10)))),e.data.preview&&u.apply(e.data.field.get(0),[!0]),!1},g=function(o){return u.apply(o.data.field.get(0),[!0]),o.data.el.removeClass("colorpicker_slider").find("input").focus(),e(document).unbind("mouseup",g),e(document).unbind("mousemove",m),!1},k=function(){var o={cal:e(this).parent(),y:e(this).offset().top};o.preview=o.cal.data("colorpicker").livePreview,e(document).bind("mouseup",o,_),e(document).bind("mousemove",o,b)},b=function(e){return u.apply(e.data.cal.data("colorpicker").fields.eq(4).val(parseInt(360*(150-Math.max(0,Math.min(150,e.pageY-e.data.y)))/150,10)).get(0),[e.data.preview]),!1},_=function(o){return i(o.data.cal.data("colorpicker").color,o.data.cal.get(0)),n(o.data.cal.data("colorpicker").color,o.data.cal.get(0)),e(document).unbind("mouseup",_),e(document).unbind("mousemove",b),!1},x=function(){var o={cal:e(this).parent(),pos:e(this).offset()};o.preview=o.cal.data("colorpicker").livePreview,e(document).bind("mouseup",o,y),e(document).bind("mousemove",o,w)},w=function(e){return u.apply(e.data.cal.data("colorpicker").fields.eq(6).val(parseInt(100*(150-Math.max(0,Math.min(150,e.pageY-e.data.pos.top)))/150,10)).end().eq(5).val(parseInt(100*Math.max(0,Math.min(150,e.pageX-e.data.pos.left))/150,10)).get(0),[e.data.preview]),!1},y=function(o){return i(o.data.cal.data("colorpicker").color,o.data.cal.get(0)),n(o.data.cal.data("colorpicker").color,o.data.cal.get(0)),e(document).unbind("mouseup",y),e(document).unbind("mousemove",w),!1},C=function(){e(this).addClass("colorpicker_focus")},M=function(){e(this).removeClass("colorpicker_focus")},I=function(){var o=e(this).parent(),t=o.data("colorpicker").color;o.data("colorpicker").origColor=t,l(t,o.get(0)),o.data("colorpicker").onSubmit(t,B(t),j(t),o.data("colorpicker").el)},q=function(){var o=e("#"+e(this).data("colorpickerId"));o.data("colorpicker").onBeforeShow.apply(this,[o.get(0)]);var t=e(this).offset(),r=S(),i=t.top+this.offsetHeight,a=t.left;return i+176>r.t+r.h&&(i-=this.offsetHeight+176),a+356>r.l+r.w&&(a-=356),o.css({left:a+"px",top:i+"px"}),0!=o.data("colorpicker").onShow.apply(this,[o.get(0)])&&o.show(),e(document).bind("mousedown",{cal:o},P),!1},P=function(o){N(o.data.cal.get(0),o.target,o.data.cal.get(0))||(0!=o.data.cal.data("colorpicker").onHide.apply(this,[o.data.cal.get(0)])&&o.data.cal.hide(),e(document).unbind("mousedown",P))},N=function(e,o,t){if(e==o)return!0;if(e.contains)return e.contains(o);if(e.compareDocumentPosition)return!!(16&e.compareDocumentPosition(o));for(var r=o.parentNode;r&&r!=t;){if(r==e)return!0;r=r.parentNode}return!1},S=function(){var e="CSS1Compat"==document.compatMode;return{l:window.pageXOffset||(e?document.documentElement.scrollLeft:document.body.scrollLeft),t:window.pageYOffset||(e?document.documentElement.scrollTop:document.body.scrollTop),w:window.innerWidth||(e?document.documentElement.clientWidth:document.body.clientWidth),h:window.innerHeight||(e?document.documentElement.clientHeight:document.body.clientHeight)}},H=function(e){return{h:Math.min(360,Math.max(0,e.h)),s:Math.min(100,Math.max(0,e.s)),b:Math.min(100,Math.max(0,e.b))}},O=function(e){return{r:Math.min(255,Math.max(0,e.r)),g:Math.min(255,Math.max(0,e.g)),b:Math.min(255,Math.max(0,e.b))}},z=function(e){var o=6-e.length;if(o>0){for(var t=[],r=0;o>r;r++)t.push("0");t.push(e),e=t.join("")}return e},Y=function(e){var e=parseInt(e.indexOf("#")>-1?e.substring(1):e,16);return{r:e>>16,g:(65280&e)>>8,b:255&e}},E=function(e){return T(Y(e))},T=function(e){var o={h:0,s:0,b:0},t=Math.min(e.r,e.g,e.b),r=Math.max(e.r,e.g,e.b),i=r-t;return o.b=r,o.s=0!=r?255*i/r:0,o.h=0!=o.s?e.r==r?(e.g-e.b)/i:e.g==r?2+(e.b-e.r)/i:4+(e.r-e.g)/i:-1,o.h*=60,o.h<0&&(o.h+=360),o.s*=100/255,o.b*=100/255,o},j=function(e){var o={},t=Math.round(e.h),r=Math.round(255*e.s/100),i=Math.round(255*e.b/100);if(0==r)o.r=o.g=o.b=i;else{var a=i,n=(255-r)*i/255,c=(a-n)*(t%60)/60;360==t&&(t=0),60>t?(o.r=a,o.b=n,o.g=n+c):120>t?(o.g=a,o.b=n,o.r=a-c):180>t?(o.g=a,o.r=n,o.b=n+c):240>t?(o.b=a,o.r=n,o.g=a-c):300>t?(o.b=a,o.g=n,o.r=n+c):360>t?(o.r=a,o.g=n,o.b=a-c):(o.r=0,o.g=0,o.b=0)}return{r:Math.round(o.r),g:Math.round(o.g),b:Math.round(o.b)}},W=function(o){var t=[o.r.toString(16),o.g.toString(16),o.b.toString(16)];return e.each(t,function(e,o){1==o.length&&(t[e]="0"+o)}),t.join("")},B=function(e){return W(j(e))},D=function(){var o=e(this).parent(),t=o.data("colorpicker").origColor;o.data("colorpicker").color=t,i(t,o.get(0)),n(t,o.get(0)),a(t,o.get(0)),c(t,o.get(0)),d(t,o.get(0)),s(t,o.get(0))};return{init:function(o){if(o=e.extend({},r,o||{}),"string"==typeof o.color)o.color=E(o.color);else if(void 0!=o.color.r&&void 0!=o.color.g&&void 0!=o.color.b)o.color=T(o.color);else{if(void 0==o.color.h||void 0==o.color.s||void 0==o.color.b)return this;o.color=H(o.color)}return this.each(function(){if(!e(this).data("colorpickerId")){var r=e.extend({},o);r.origColor=o.color;var m="collorpicker_"+parseInt(1e3*Math.random());e(this).data("colorpickerId",m);var g=e(t).attr("id",m);r.flat?g.appendTo(this).show():g.appendTo(document.body),r.fields=g.find("input").bind("keyup",p).bind("change",u).bind("blur",f).bind("focus",h),g.find("span").bind("mousedown",v).end().find(">div.colorpicker_current_color").bind("click",D),r.selector=g.find("div.colorpicker_color").bind("mousedown",x),r.selectorIndic=r.selector.find("div div"),r.el=this,r.hue=g.find("div.colorpicker_hue div"),g.find("div.colorpicker_hue").bind("mousedown",k),r.newColor=g.find("div.colorpicker_new_color"),r.currentColor=g.find("div.colorpicker_current_color"),g.data("colorpicker",r),g.find("div.colorpicker_submit").bind("mouseenter",C).bind("mouseleave",M).bind("click",I),i(r.color,g.get(0)),a(r.color,g.get(0)),n(r.color,g.get(0)),d(r.color,g.get(0)),c(r.color,g.get(0)),l(r.color,g.get(0)),s(r.color,g.get(0)),r.flat?g.css({position:"relative",display:"block"}):e(this).bind(r.eventName,q)}})},showPicker:function(){return this.each(function(){e(this).data("colorpickerId")&&q.apply(this)})},hidePicker:function(){return this.each(function(){e(this).data("colorpickerId")&&e("#"+e(this).data("colorpickerId")).hide()})},setColor:function(o){if("string"==typeof o)o=E(o);else if(void 0!=o.r&&void 0!=o.g&&void 0!=o.b)o=T(o);else{if(void 0==o.h||void 0==o.s||void 0==o.b)return this;o=H(o)}return this.each(function(){if(e(this).data("colorpickerId")){var t=e("#"+e(this).data("colorpickerId"));t.data("colorpicker").color=o,t.data("colorpicker").origColor=o,i(o,t.get(0)),a(o,t.get(0)),n(o,t.get(0)),d(o,t.get(0)),c(o,t.get(0)),l(o,t.get(0)),s(o,t.get(0))}})}}}();e.fn.extend({ColorPicker:o.init,ColorPickerHide:o.hidePicker,ColorPickerShow:o.showPicker,ColorPickerSetColor:o.setColor})}(jQuery);
/*end colorpicker*/