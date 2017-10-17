jQuery(document).ready(function($){

	imageWidget = {

		// Call this from the upload button to initiate the upload frame.
		uploader : function( el ) {

			var $container = $(el).closest('.image-sel-container');

			var frame = wp.media({
				title : 'Choose an Image',
				multiple : false,
				library : { type : 'image' },
				button : { text : 'Use Image' }
			});

			// Handle results from media manager.
			frame.on('close',function( ) {
				var attachments = frame.state().get('selection').toJSON();
				imageWidget.render( attachments[0], $container );
				$container.find(".image-sel-value").trigger('change');
			});

			frame.open();
			return false;
		},

		remove : function( el ) {
			var $container = $(el).closest('.image-sel-container');

			$container.find('.image-sel-preview').html('');
			$container.find('.image-sel-value').val('');
			$container.find('.image-sel-remove').css('display', 'none');
			$container.find('.image-sel-value').trigger('change');
		},

		// Output Image preview and populate widget form.
		render : function( attachment, $container ) {
			$container.find('.image-sel-preview').html(imageWidget.imgHTML( attachment ));
			$container.find('.image-sel-value').val(attachment.url);
			$container.find('.image-sel-remove').css('display', 'inline-block');
		},

		// Render html for the image.
		imgHTML : function( attachment ) {
			var img_html = '<img src="' + attachment.url + '" alt="" />';
			return img_html;
		}

	};

});
