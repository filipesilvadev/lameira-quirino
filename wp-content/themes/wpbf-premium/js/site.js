!function(i){i('.wpbf-mega-menu > .sub-menu > .menu-item a[href="#"]').click(function(n){n.preventDefault()});var n=i(".wpbf-navigation").data("sub-menu-animation-duration");i(".wpbf-sub-menu-animation-down > .menu-item-has-children").hover(function(){i(".sub-menu",this).first().stop().css({display:"block"}).animate({marginTop:"0",opacity:"1"},n)},function(){i(".sub-menu",this).first().stop().animate({opacity:"0",marginTop:"-10px"},n,function(){i(this).css({display:"none"})})}),i(".wpbf-sub-menu-animation-up > .menu-item-has-children").hover(function(){i(".sub-menu",this).first().stop().css({display:"block"}).animate({marginTop:"0",opacity:"1"},n)},function(){i(".sub-menu",this).first().stop().animate({opacity:"0",marginTop:"10px"},n,function(){i(this).css({display:"none"})})}),i(".wpbf-sub-menu-animation-zoom-in > .menu-item-has-children").hover(function(){i(".sub-menu",this).first().stop(!0).css({display:"block"}).transition({scale:"1",opacity:"1"},n)},function(){i(".sub-menu",this).first().stop(!0).transition({scale:".95",opacity:"0"},n).fadeOut(5)}),i(".wpbf-sub-menu-animation-zoom-out > .menu-item-has-children").hover(function(){i(".sub-menu",this).first().stop(!0).css({display:"block"}).transition({scale:"1",opacity:"1"},n)},function(){i(".sub-menu",this).first().stop(!0).transition({scale:"1.05",opacity:"0"},n).fadeOut(5)}),i(document).on({mouseenter:function(){i(".wpbf-woo-menu-item .wpbf-woo-sub-menu").stop().fadeIn(n)},mouseleave:function(){i(".wpbf-woo-menu-item .wpbf-woo-sub-menu").stop().fadeOut(n)}},".wpbf-woo-menu-item.menu-item-has-children"),i(".wpbf-video-opt-in-button, .wpbf-video-opt-in-image").click(function(n){n.preventDefault();var t=i(this).parent().next().attr("data-wpbf-video");i(this).parent().next().children().attr("src",t),i(this).parent().next().removeClass("opt-in"),i(this).parent().remove()}),i(window).load(function(){i(".wpbf-post-grid-masonry").length&&i(".wpbf-post-grid-masonry").isotope({itemSelector:".wpbf-article-wrapper",transitionDuration:20})})}(jQuery);