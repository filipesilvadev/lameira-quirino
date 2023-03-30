var wwsLoader='<div class="wws-spinner">';
wwsLoader +='<div class="wws-bounce1 wws--bg-color"></div>';
wwsLoader +='<div class="wws-bounce2 wws--bg-color"></div>';
wwsLoader +='<div class="wws-bounce3 wws--bg-color"></div>';
wwsLoader +='</div>';
const wwsWidget={
trigger: function(status=''){
if('open'===status){
this.open();
jQuery(document.body).trigger('wws_widget_open');
}else if('close'===status){
this.close();
jQuery(document.body).trigger('wws_widget_close');
}else{
if(jQuery('.wws-popup').attr('data-wws-popup-status')=='0'){
this.open();
jQuery(document.body).trigger('wws_widget_open');
}else{
this.close();
jQuery(document.body).trigger('wws_widget_close');
}}
},
open: function(){
jQuery('.wws-popup').slideDown();
jQuery('.wws-popup').attr('data-wws-popup-status', '1');
jQuery('.wws-gradient').show();
},
close: function(){
jQuery('.wws-popup').slideUp();
jQuery('.wws-popup').attr('data-wws-popup-status', '0');
jQuery('.wws-gradient').hide();
},
autoPopup: function(delayInSeconds){
if('yes'!==sessionStorage.wwsAutoPopup){
setTimeout(function(){
if('0'==jQuery('.wws-popup').data('wws-popup-status')){
wwsWidget.trigger();
}
sessionStorage.wwsAutoPopup='yes';
}, Number(delayInSeconds * 1000));
}},
sendMessage: function(message='', whatsappNumber=''){
if(''===message||''===whatsappNumber){
return false;
}
if(this.is_mobile.any()){
window.open(wwsObj.whatsapp_mobile_api + '/send?phone=' + whatsappNumber + '&text=' + message + '');
}else{
window.open(wwsObj.whatsapp_desktop_api + '/send?phone=' + whatsappNumber + '&text=' + message + '');
}
jQuery(document.body).trigger('wws_message_sent');
return true;
},
sendGroupInvitation: function(groupID){
window.open('https://chat.whatsapp.com/' + groupID);
},
is_mobile: {
Android: function(){
return navigator.userAgent.match(/Android/i);
},
BlackBerry: function(){
return navigator.userAgent.match(/BlackBerry/i);
},
iOS: function(){
return navigator.userAgent.match(/iPhone|iPad|iPod/i);
},
Opera: function(){
return navigator.userAgent.match(/Opera Mini/i);
},
Windows: function(){
return navigator.userAgent.match(/IEMobile/i);
},
any: function(){
return(wwsWidget.is_mobile.Android()||wwsWidget.is_mobile.BlackBerry()||wwsWidget.is_mobile.iOS()||wwsWidget.is_mobile.Opera()||wwsWidget.is_mobile.Windows());
},
},
logAnalytics: function(message='N/A', number='N/A', through='', args={}){
jQuery.ajax({
url: wwsObj.admin_url,
type: 'post',
data: {
'action':   'wws_click_analytics',
'message':  message,
'number':   number,
'through':  through,
'support_person_id': args.supportPersonId||'-1',
'security': wwsObj.security_token,
}});
},
}
;(function($){
"use strict";
jQuery(document).ready(function(){
function wws_ga_and_fb_click_analytics(){
var fbGaAnalytics=jQuery.parseJSON(wwsObj.fb_ga_click_tracking);
if('yes'==fbGaAnalytics.ga_click_tracking_status){
try {
gtag(
'event',
fbGaAnalytics.ga_click_tracking_event_name, {
'event_category': fbGaAnalytics.ga_click_tracking_event_category,
'event_label': fbGaAnalytics.ga_click_tracking_event_label,
}
);
} catch(error){
if('yes'===wwsObj.is_debug){
window.console&&console.log('WordPress WhatsApp Support Google or Facebook analytics error message: ' + error.message);
}}
try {
ga(
'send',
'event',
fbGaAnalytics.ga_click_tracking_event_category,
fbGaAnalytics.ga_click_tracking_event_name,
fbGaAnalytics.ga_click_tracking_event_label
);
} catch(error){
if('yes'===wwsObj.is_debug){
window.console&&console.log('WordPress WhatsApp Support Google or Facebook analytics error message: ' + error.message);
}}
try {
_gaq.push([
'_trackEvent',
fbGaAnalytics.ga_click_tracking_event_category,
fbGaAnalytics.ga_click_tracking_event_name,
fbGaAnalytics.ga_click_tracking_event_label
]);
}
catch(error){
if('yes'===wwsObj.is_debug){
window.console&&console.log('WordPress WhatsApp Support Google or Facebook analytics error message: ' + error.message);
}}
try {
dataLayer.push({
'event': 'customEvent',
'eventCategory': fbGaAnalytics.ga_click_tracking_event_category,
'eventAction': fbGaAnalytics.ga_click_tracking_event_name,
'eventLabel': fbGaAnalytics.ga_click_tracking_event_label
});
}
catch(error){
if('yes'===wwsObj.is_debug){
window.console&&console.log('WordPress WhatsApp Support Google or Facebook analytics error message: ' + error.message);
}}
}
if('yes'==fbGaAnalytics.fb_click_tracking_status){
var FBpixeled=false;
try {
if(! FBpixeled){
fbq('trackCustom', 'WordPressWhatsAppSupport', {
event: fbGaAnalytics.fb_click_tracking_event_name,
account: fbGaAnalytics.fb_click_tracking_event_label
});
FBpixeled=true;
}}
catch(error){
if('yes'===wwsObj.is_debug){
window.console&&console.log('WordPress WhatsApp Support Google or Facebook analytics error message: ' + error.message);
}}
}}
function isGDPRChecked(){
if('yes'!==wwsObj.is_gdpr){
return;
}
if(jQuery('.wws-gdpr input').is(':checked')==false){
jQuery('.wws-gdpr > div').addClass('wws-shake-animation');
setTimeout(function(){
jQuery('.wws-gdpr > div').removeClass('wws-shake-animation');
}, 300);
return false;
}else{
return true;
}}
jQuery('.wws-popup__open-btn, .wws-popup__close-btn').on('click', function(event){
event.preventDefault();
wwsWidget.trigger();
});
jQuery(document).on('click', '.wws-popup__send-btn', function(event){
event.preventDefault();
if(wwsObj.popup_layout==8){
var preMessage=jQuery(this).attr('data-wws-pre-msg');
var whatsappNumber=jQuery(this).attr('data-wws-number');
if(isGDPRChecked()==false) return;
if(''===preMessage){
preMessage='%20';
}
if(wwsWidget.sendMessage(preMessage, whatsappNumber)==true){
wwsWidget.logAnalytics(preMessage, 'N/A', 'Layout 8');
wws_ga_and_fb_click_analytics();
}}
if(wwsObj.popup_layout==7){
var message=jQuery('.wws-popup__input').val();
var number=jQuery('.wws-popup__fields-number').val();
var whatsappNumber=wwsObj.support_number;
if(isGDPRChecked()==false) return;
setTimeout(function(){
jQuery('.wws-popup__fields-textarea-wrapper, .wws-popup__fields-number').removeClass('wws-shake-animation');
}, 300);
if(number==''){
jQuery('.wws-popup__fields-number').addClass('wws-shake-animation');
return;
}
if(message==''){
jQuery('.wws-popup__fields-textarea-wrapper').addClass('wws-shake-animation');
return;
}
if(wwsWidget.sendMessage(( message + wwsObj.pre_defined_text), whatsappNumber)==true){
wwsWidget.logAnalytics(message, number, 'Layout 7');
wws_ga_and_fb_click_analytics();
}}
if(wwsObj.popup_layout==6){
var message=jQuery('.wws-popup__input').val();
var preMessage=jQuery('.wws-popup-multi-support-pre-essage').val();
var number=jQuery('.wws-popup__fields-number').val();
var whatsappNumber=jQuery('.wws-popup-multi-support-number').val();
var supportPersonId=jQuery('.wws-popup-multi-support-id').val();
if(isGDPRChecked()==false) return;
setTimeout(function(){
jQuery('.wws-popup__fields-textarea-wrapper, .wws-popup__fields-number').removeClass('wws-shake-animation');
}, 300);
if(number==''){
jQuery('.wws-popup__fields-number').addClass('wws-shake-animation');
return;
}
if(message==''){
jQuery('.wws-popup__fields-textarea-wrapper').addClass('wws-shake-animation');
return;
}
if(wwsWidget.sendMessage(( message + preMessage), whatsappNumber)==true){
wwsWidget.logAnalytics(message, number, 'Layout 6', {
supportPersonId: supportPersonId
});
wws_ga_and_fb_click_analytics();
}}
if(wwsObj.popup_layout==1||wwsObj.popup_layout==2||wwsObj.popup_layout==3){
var message=jQuery('.wws-popup__input').val();
var whatsappNumber=wwsObj.support_number;
if(isGDPRChecked()==false) return;
setTimeout(function(){
jQuery('.wws-popup__input-wrapper').removeClass('wws-shake-animation');
}, 300);
if(0==message.length){
jQuery('.wws-popup__input-wrapper').addClass('wws-shake-animation');
return;
}
if(wwsWidget.sendMessage(( message + wwsObj.pre_defined_text), whatsappNumber)==true){
if(1==wwsObj.popup_layout){
wwsWidget.logAnalytics(message, 'N/A', 'Layout 1');
}else if(2==wwsObj.popup_layout){
wwsWidget.logAnalytics(message, 'N/A', 'Layout 2');
}else if(3==wwsObj.popup_layout){
wwsWidget.logAnalytics(message, 'N/A', 'Layout 3');
}
wws_ga_and_fb_click_analytics();
}}
if(wwsObj.popup_layout==4){
var message=jQuery('.wws-popup__input').val();
var whatsappNumber=wwsObj.support_number;
if(wwsWidget.sendMessage(( message + wwsObj.pre_defined_text), whatsappNumber)==true){
wwsWidget.logAnalytics('N/A', 'N/A', 'Layout 4');
wws_ga_and_fb_click_analytics();
}}
});
jQuery('.wws-popup__input').on('keypress', function (e){
var key=e.which;
if(key==13){
jQuery('.wws-popup__send-btn').click();
return false;
}});
jQuery('.wws-popup-group-invitation__button').on('click', function(){
wwsWidget.sendGroupInvitation(wwsObj.group_invitation_id);
wwsWidget.logAnalytics();
wws_ga_and_fb_click_analytics()
});
if('yes'===wwsObj.auto_popup){
wwsWidget.autoPopup(wwsObj.auto_popup_time);
}
if(wwsObj.scroll_lenght!=null){
jQuery(document).on('scroll', function (){
var y=jQuery(window).scrollTop() + jQuery(window).height();
var documentHeight=jQuery(document).height() * wwsObj.scroll_lenght / 100;
if(y >=documentHeight - 10){
jQuery('.wws-popup-container').fadeIn();
}else{
jQuery('.wws-popup-container').fadeOut();
}});
}
jQuery(document).on('click', '[data-wws-multi-support-person-id]', function(){
var multiSupportPersonID=jQuery(this).attr('data-wws-multi-support-person-id');
jQuery('.wws-popup__support-person-wrapper').hide();
jQuery('.wws-popup__support-person-form').show();
jQuery('.wws-popup__support-person-form').html(wwsLoader);
jQuery.ajax({
url: wwsObj.admin_url,
type: 'post',
data: {
'action':   'wws_view_multi_person_form',
'support_person_id': multiSupportPersonID,
'post_id':wwsObj.current_page_id,
}}).done(function(response){
jQuery('.wws-popup__support-person-form').html(response);
if(''!==wwsObj.numberMasking){
jQuery('.wws-popup__fields-number').inputmask(wwsObj.numberMasking);
}});
});
jQuery(document).on('click', '[data-wws-multi-support-back]', function(){
jQuery('.wws-popup__support-person-wrapper').show();
jQuery('.wws-popup__support-person-form').hide();
});
if(''!==wwsObj.numberMasking){
jQuery('.wws-popup__fields-number').inputmask(wwsObj.numberMasking);
}
jQuery('.wws-shortcode-btn').on('click', function(){
wwsWidget.logAnalytics('N/A', 'N/A', 'Shortcode Button');
wws_ga_and_fb_click_analytics();
});
jQuery('.wws-product-query-btn').on('click', function(){
wwsWidget.logAnalytics('N/A', 'N/A', 'Woo Query Button');
wws_ga_and_fb_click_analytics();
});
jQuery('[data-wws-agent-call]').on('click', function(){
var call_number=jQuery(this).data('wws-agent-call');
window.open('tel:' + call_number);
});
});
})(jQuery);