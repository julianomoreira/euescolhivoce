jQuery(function($){
	$('body').on({
		click: function(event) {
			if ( typeof wp === 'undefined' || ! wp.media || ! wp.media.gallery ) return;
			event.preventDefault();

			var dialog = $('.panel-dialog:visible' );

			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				file_frame.open();
				return;
			}
			
			// Create the media frame.
			var file_frame = wp.media.frame = wp.media({
				frame: "post",
				state: "gallery-edit",
				library : { type : 'image'},
				button: {text: "Edit Image Order"},
				multiple: true
			});

			file_frame.on('open', function() {
				var selection = file_frame.state().get('selection');
				var library = file_frame.state('gallery-edit').get('library');
				var ids = dialog.find('*[name$="[ids]"]').val();
				if (ids) {
					idsArray = ids.split(',');
					idsArray.forEach(function(id) {
						attachment = wp.media.attachment(id);
						attachment.fetch();
						selection.add( attachment ? [ attachment ] : [] );
					});
					file_frame.setState('gallery-edit');
					idsArray.forEach(function(id) {
						attachment = wp.media.attachment(id);
						attachment.fetch();
						library.add( attachment ? [ attachment ] : [] );
					});
				}
			});

			file_frame.state('gallery-edit').on( 'update', function( selection ) {
				var ids = selection.models.map(function(e){ return e.id });
				dialog.find('input[name$="[ids]"]' ).val(ids.join(','));
			});

			file_frame.open();

			return false;
		} 
	}, '.ld-photo-gallery-widget-select-attachments');

	$('body').on({
		click: function(event) {
			if ( typeof wp === 'undefined' || ! wp.media ) return;
			event.preventDefault();

			var dialog = $('.panel-dialog:visible' );

			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				file_frame.open();
				return;
			}
			
			// Create the media frame.
			var file_frame = wp.media.frame = wp.media({
				// title: "Edit Slideshow",
				frame: "post",
				state: "gallery-edit",
				library : { type : "image"},
				button: {text: "Update"},
				multiple: true
			});

			file_frame.on('open', function() {
				var selection = file_frame.state().get('selection');
				var library = file_frame.state('gallery-edit').get('library');
				var ids = dialog.find('*[name$="[slideshow]"]').val();
				if (ids) {
					idsArray = ids.split(',');
					idsArray.forEach(function(id) {
						attachment = wp.media.attachment(id);
						attachment.fetch();
						selection.add( attachment ? [ attachment ] : [] );
					});
					file_frame.setState('gallery-edit');
					idsArray.forEach(function(id) {
						attachment = wp.media.attachment(id);
						attachment.fetch();
						library.add( attachment ? [ attachment ] : [] );
					});
				}
			});

			file_frame.state('gallery-edit').on( 'update', function( selection ) {
				var ids = selection.models.map(function(e){ return e.id });
				dialog.find('input[name$="[slideshow]"]' ).val(ids.join(','));
			});

			file_frame.open();

			return false;
		} 
	}, '.ld-couple-summary-widget-select-slideshow-images');

});