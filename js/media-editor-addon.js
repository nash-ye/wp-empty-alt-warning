(function($) {
    'use strict';
    $(function() {
	$(document.body).one('click.add-media-button', '.insert-media', function(event) {
	    var orginalInsertCallback = wp.media.editor.insert;
	    wp.media.editor.insert = function(html) {
		var image = $('img', $("<div>" + html + "</div>"));
		if (! image.attr('alt')) {
		    var confirmed = confirm("An image without alternative text had been inserted!");
		    if (confirmed) {
			orginalInsertCallback(html);
		    } else {
			/*
			 * The media frame should be opened again, or something!
			 */
		    }
		} else {
		    orginalInsertCallback(html);
		}
	    };
	});
    });
})(jQuery);