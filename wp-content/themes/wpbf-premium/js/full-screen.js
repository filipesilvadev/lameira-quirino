!function(e){function n(){e(".wpbf-menu-full-screen").hasClass("active")&&(e(".wpbf-menu-full-screen").removeClass("active"),e(".wpbf-menu-full-screen").fadeOut(150))}e(".wpbf-menu-toggle").click(function(){e(".wpbf-menu-full-screen").hasClass("active")?(e(".wpbf-menu-toggle").removeClass("active").attr("aria-expanded","false"),e(".wpbf-menu-full-screen").removeClass("active"),e(".wpbf-menu-full-screen").fadeOut(150)):(e(".wpbf-menu-toggle").addClass("active").attr("aria-expanded","true"),e(".wpbf-menu-full-screen").addClass("active"),e(".wpbf-menu-full-screen").fadeIn(150))}),e(".wpbf-menu-full-screen .wpbf-close").click(function(){n()}),e(document).keyup(function(e){27===e.keyCode&&n()})}(jQuery);