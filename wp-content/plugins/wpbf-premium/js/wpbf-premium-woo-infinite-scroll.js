"use strict";!function(c,e){var l,s,r=c.extend({scroll_item_selector:!1,scroll_content_selector:!1,scroll_next_selector:!1,is_shop:!1,loader:!1},{scroll_item_selector:wpbf_infinte_scroll_object.item_Selector,scroll_content_selector:wpbf_infinte_scroll_object.content_Selector,scroll_next_selector:wpbf_infinte_scroll_object.next_Selector,is_shop:!0,loader:wpbf_infinte_scroll_object.image_loader}),n=!1,i=!1,_=c(r.scroll_next_selector).attr("href");c(".woocommerce-pagination").css({display:"none"}),0==!c(r.post_scroll_next_selector).length&&0==!c(r.scroll_item_selector).length&&0==!c(r.scroll_content_selector).length&&(i=!0),0!=c(r.scroll_next_selector).length?(l=c(r.scroll_content_selector).find(r.scroll_item_selector).first().nextUntil(".wpbf-woo-infinite-first",r.scroll_item_selector).length+1,s=function(e,t,o){var l=t-e.prevUntil(".wpbf-woo-infinite-last",r.scroll_item_selector).length,s=0;o.each(function(){var e=c(this);s++,e.removeClass("wpbf-woo-infinite-first"),e.removeClass("wpbf-woo-infinite-last"),(s-l)%t!=0&&(s-(l-1))%t!=0||e.addClass("wpbf-woo-infinite-last")})},c(e).on("scroll touchstart",function(){var o,e=c(this),t=c(r.scroll_item_selector).last().offset();!n&&!i&&e.scrollTop()>=Math.abs(t.top-(e.height()-150))&&(o=c(r.scroll_content_selector).find(r.scroll_item_selector).last(),r.loader&&c(r.scroll_content_selector).append('<div class="wpbf-woo-infinite-scroll-loader"><img src="'+r.loader+'"/></div>'),n=!0,c.ajax({url:_,dataType:"html",success:function(e){var t=c(e),e=t.find(r.scroll_item_selector),t=t.find(r.scroll_next_selector);t.length?_=t.attr("href"):i=!0,!o.hasClass("wpbf-woo-infinite-last")&&r.is_shop&&s(o,l,e),e.css({opacity:"0"}),o.after(e),c(".wpbf-woo-infinite-scroll-loader").remove(),e.fadeTo(800,1,function(){n=!1})}}))})):i=!0}(jQuery,window,document);