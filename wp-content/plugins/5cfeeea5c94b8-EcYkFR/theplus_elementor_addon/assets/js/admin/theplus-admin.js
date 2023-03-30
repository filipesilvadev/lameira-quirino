(function ($) {
	jQuery(document).on( 'click', '.plus-key-notify .notice-dismiss', function() {

    jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'theplus_key_notice'
        }
    })
	
	});	
	$(window).load(function(){
	
		var $category_container = $(".plus-template-main-category");
		var $category_list = $category_container.find(".plus-main-category-list");
		
		if($category_container.length==1 && $category_list.length == 1 ){
			var active_category = $category_list.find(".active-open .plus-templates-tab");
			var category = active_category.data("listing");
			get_template_load(category);
		}
		$('.plus-template-main-category .plus-main-category-list li').on('click',function(e) {
			var $this=$(this);
			
			var parent_class=$this.parent().find('li').removeClass("active-open");			
			$this.addClass("active-open");
			var category = $this.find(".plus-templates-tab").data("listing");
			
			var parent_class=$this.closest(".plus-template-main-category").find(".widgets-listing-content");
			parent_class.removeClass("active");
			
			$("#listing-"+category).addClass("active");
			
			get_template_load(category);
		});
		$(document).on('click','.widgets-listing-content .sub-category-listing li', function(e) {
			e.preventDefault();
			var $this =$(this);
			var filter_category=$this.data("filter");
			var parent_class=$this.parent().find('li').removeClass("active");
			var main_category=$(".plus-main-category-list").find("li.active-open .plus-templates-tab").data("listing");
			$this.addClass("active");
			if(filter_category!='*'){
				$(this).closest(".widgets-listing-content").find('.plus-template-library-template').not('.'+filter_category).hide('400');
				$(this).closest(".widgets-listing-content").find('.plus-template-library-template').filter('.'+filter_category).show('400');
			}else{
				$(this).closest(".widgets-listing-content").find('.plus-template-library-template').show('600');
			}
			/*var $masonry_column = $("#listing-"+main_category +' .plus-template-innner-content').masonry({						  
			  itemSelector: '.plus-template-library-template'
			});*/
			var $masonry_column = $("#listing-"+main_category +' .plus-template-innner-content');
			$masonry_column.masonry('layout');			
			setTimeout(function(){
				$masonry_column.imagesLoaded().progress( function() {
				  $masonry_column.masonry('layout');
				});			
			}, 400);
			
		});
		$(document).on('click','.plus-template-library-template-download .template-download', function(e) {
			e.preventDefault();
			var json="json";
			var $this=$(this);
			var template=$(this).data("url");
			var main_category_widget=$(".plus-main-category-list").find("li.active-open .plus-templates-tab").data("listing");
			
			if(template!=''){
			
				$this.find(".download-template").hide();
				$this.find(".loading-template").show();
				$.ajax({
					url : ajaxurl,
					type : 'post',
					data : {
						action : 'plus_template_ajax',
						json : json,
						widget_category : main_category_widget,
						template: template
					},
					success : function( data ) {
					if(data!='' && data!=0){
					 var a = document.createElement("a");
					document.body.appendChild(a);
					a.style = "display: none";
						var blob = new Blob([data], {type: "octet/stream"}),
							url = window.URL.createObjectURL(blob);
						a.href = url;
						a.download = 'download.json';
						a.click();
						window.URL.revokeObjectURL(url);
					}
					setTimeout(function(){						
						$this.find(".loading-template").hide();
						$this.find(".download-template").show();
					}, 2000);
					}
				});
			setTimeout(function(){
				$this.find(".loading-template").hide();
				$this.find(".download-template").show();
			}, 2000);
			}
		});
	});
	function get_template_load(category){
		if(category!=''){
				$.ajax({
					url : ajaxurl,
					type : 'post',
					data : {
						action : 'plus_template_library_content',
						category : category,
					},
					success : function( data ) {
						if(data!='' && data!=0){
							$("#listing-"+category).html(data);
						}else{
							alert("Not Found Templates");
						}
					},
					complete: function() {						
						var $masonry_column = $("#listing-"+category +' .plus-template-innner-content').masonry({						  
						  itemSelector: '.plus-template-library-template'
						});
						
						$masonry_column.imagesLoaded().progress( function() {
						  $masonry_column.masonry('layout');
						});
						$masonry_column.masonry();
					}
				});
			}
	}
	$(document).ready(function() {
		if($('#elementor-import-template-area').length==1){
		$('#elementor-import-template-area').dialog({
			title: 'Import Template Library',
			dialogClass: 'wp-dialog plus-import-template-popup',
			autoOpen: false,
			draggable: false,
			width: 'auto',
			modal: true,
			resizable: false,
			closeOnEscape: true,
			position: {
			  my: "center",
			  at: "center",
			  of: window
			},
			open: function () {
			  // close dialog by clicking the overlay behind it
			  $('.ui-widget-overlay').bind('click', function(){
				$('#elementor-import-template-area').dialog('close');
			  })
			},
			create: function () {
			  // style fix for WordPress admin
			  $('.ui-dialog-titlebar-close').addClass('ui-button');
			},
		});
		  // bind a button or a link to open the dialog
		$('.theplus-import-template-library').click(function(e) {
			e.preventDefault();
			$('#elementor-import-template-area').dialog('open');
		});
		}
		if($("#theplus_verified_api").length==1){
		
			$("#post_type_options").find(".button-primary").remove();
			
			$("#post_type_options").append('<div class="pt-plus-page-form"><div class="alert alert-warning"><strong>Important Notice :</strong><ul><li><b><a href="admin.php?page=theplus_purchase_code">Verify</a></b> your plugin and get access of all functionalities. Go to Verify section of settings to proceed further.</li></ul></div></div>');			
		}
	});
})(window.jQuery);
