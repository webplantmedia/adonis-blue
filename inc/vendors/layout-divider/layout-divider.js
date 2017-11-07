(function(tinymce) {
    tinymce.PluginManager.add('layout_divider', function(editor, url) {
		// Register commands
		editor.addCommand( 'Layout_Divider', function( tag = '' ) {
			var parent, html,
				dom = editor.dom,
				node = editor.selection.getNode();
				mceSelectedHTML = editor.selection.getContent({format: 'html'});
				

			if ( tag.length > 0 ) {
				html = '<hr class="layout-divider-'+tag+'">';
			}
			else {
				html = '<hr class="layout-divider" />';
			}

			// Most common case
			if ( node.nodeName === 'BODY' || ( node.nodeName === 'P' && node.parentNode.nodeName === 'BODY' ) ) {
				editor.insertContent( html );
				return;
			}

			// Get the top level parent node
			parent = dom.getParent( node, function( found ) {
				if ( found.parentNode && found.parentNode.nodeName === 'BODY' ) {
					return true;
				}

				return false;
			}, editor.getBody() );

			if ( parent ) {
				if ( parent.nodeName === 'P' ) {
					parent.after( dom.create( 'p', null, html ).firstChild );
				} else {
					dom.insertAfter( dom.create( 'p', null, html ), parent );
				}

				editor.nodeChanged();
			}
		});

		editor.addButton('layout_divider_button', {
            icon: 'layout_divider',
			tooltip: 'Layout Divider',
			onclick: function(){
				editor.execCommand( 'Layout_Divider' );
			}
		});
	});
})(tinymce);
