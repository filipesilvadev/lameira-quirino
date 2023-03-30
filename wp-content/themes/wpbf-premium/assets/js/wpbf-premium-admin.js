(function($) {

	// Transparent Header Advanced
	$('.wpbf-transparent-header-advanced').toggle(function(e) {
		e.preventDefault();
		$(this).html('- Advanced');
		$('.wpbf-transparent-header-advanced-wrapper').slideDown();
	}, function() {
		$(this).html('+ Advanced');
		$('.wpbf-transparent-header-advanced-wrapper').slideUp();
	});

	// Blog Layouts Advanced
	$('.wpbf-blog-layouts-advanced').toggle(function(e) {
		e.preventDefault();
		$(this).html('- Advanced');
		$('.wpbf-blog-layouts-advanced-wrapper').slideDown();
	}, function() {
		$(this).html('+ Advanced');
		$('.wpbf-blog-layouts-advanced-wrapper').slideUp();
	});

	// Select All
	$('.wpbf-performance-select-all').toggle(function(e) {
		e.preventDefault();
		$('.wpbf-performance-setting').prop( "checked", true );
	}, function() {
		$('.wpbf-performance-setting').prop( "checked", false );
	});

	// Theme Image Upload
	$('.wpbf-screenshot-upload').click(function(e) {
		e.preventDefault();

		var custom_uploader = wp.media({
			title: 'Login Logo',
			button: {
				text: 'Upload Image'
			},
			multiple: false  // Set this to true to allow multiple files to be selected
		})
		.on('select', function() {
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			$('.udb-branding-login-logo').attr('src', attachment.url);
			$('.wpbf-screenshot-url').val(attachment.url);

		})
		.open();
	});

	$('.wpbf-screenshot-remove').click(function(e) {
		e.preventDefault();
		$('.wpbf-screenshot-url').val('');
	});

})( jQuery );