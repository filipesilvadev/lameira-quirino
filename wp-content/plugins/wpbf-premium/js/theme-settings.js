"use strict";!function(a){var n=document.querySelector('[name="_wp_http_referer"]');function s(e){var t;n&&(n.value.includes("#")?(t=n.value.split("#")[0],n.value=t+"#"+e):n.value=n.value+"#"+e)}a(".wpbf-transparent-header-advanced").on("click",function(){0!=this.dataset.expanded&&this.dataset.expanded?(this.dataset.expanded="0",a(this).html("+ Advanced"),a(".wpbf-transparent-header-advanced-wrapper").slideUp()):(this.dataset.expanded="1",a(this).html("- Advanced"),a(".wpbf-transparent-header-advanced-wrapper").slideDown())}),a(".wpbf-blog-layouts-advanced").on("click",function(){0!=this.dataset.expanded&&this.dataset.expanded?(this.dataset.expanded="0",a(this).html("+ Advanced"),a(".wpbf-blog-layouts-advanced-wrapper").slideUp()):(this.dataset.expanded="1",a(this).html("- Advanced"),a(".wpbf-blog-layouts-advanced-wrapper").slideDown())}),a(".wpbf-performance-select-all").on("click",function(){0!=this.dataset.selected&&this.dataset.selected?(this.dataset.selected="0",a(".wpbf-performance-setting").prop("checked",!1)):(this.dataset.selected="1",a(".wpbf-performance-setting").prop("checked",!0))}),a(".wpbf-company-logo-upload").click(function(e){e.preventDefault();var t=wp.media({title:"Company Logo",button:{text:"Add Logo"},multiple:!1}).on("select",function(){var e=t.state().get("selection").first().toJSON();a(".wpbf-company-logo-url").val(e.url)}).open()}),a(".wpbf-company-logo-remove").click(function(e){e.preventDefault(),a(".wpbf-company-logo-url").val("")}),a(".wpbf-screenshot-upload").click(function(e){e.preventDefault();var t=wp.media({title:"Theme Screenshot",button:{text:"Add Screenshot"},multiple:!1}).on("select",function(){var e=t.state().get("selection").first().toJSON();a(".wpbf-screenshot-url").val(e.url)}).open()}),a(".wpbf-screenshot-remove").click(function(e){e.preventDefault(),a(".wpbf-screenshot-url").val("")}),jQuery(document).ready(function(e){e(".color-picker").wpColorPicker()}),a(".heatbox-tab-nav-item a").on("click",function(e){var t=this.href.substring(this.href.indexOf("#")+1);t&&(s(t),a(".heatbox-tab-nav-item").removeClass("active"),this.parentNode.classList.add("active"),a(".heatbox-admin-panel").css("display","none"),a('.heatbox-admin-panel[data-tab-id="'+t+'"]').css("display","block"))}),a(window).on("load",function(){var n=window.location.hash.substr(1);n&&(s(n),a(".heatbox-tab-nav-item").removeClass("active"),a(".heatbox-admin-panel").css("display","none"),a(".heatbox-tab-nav-item a").each(function(e,t){var a=t.href.substring(t.href.indexOf("#")+1);a&&a===n&&t.parentNode.classList.add("active")}),a('.heatbox-admin-panel[data-tab-id="'+n+'"]').css("display","block"))})}(jQuery);