(function(tinymce) {
    tinymce.PluginManager.add('layout_divider', function(editor, url) {
		// Register commands
		editor.addCommand( 'Layout_Divider', function( tag ) {
			var parent, html,
				dom = editor.dom,
				node = editor.selection.getNode();

			if ( tag.length > 0 ) {
				html = '<hr class="layout-divider-'+tag+'" />';
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
					parent.appendChild( dom.create( 'p', null, html ).firstChild );
				} else {
					dom.insertAfter( dom.create( 'p', null, html ), parent );
				}

				editor.nodeChanged();
			}
		});

		editor.addButton('layout_divider_button', {
            icon: 'layout_divider',
			tooltip: 'Horizontal line',
			type: 'menubutton',
			menu: [
				{
					text: "Start Grid",
					onclick: function(){
						editor.execCommand( 'Layout_Divider', 'start-grid' );
					}
				},
				{
					text: "1/2 Column",
					onclick: function(){
						editor.execCommand( 'Layout_Divider', 'column-1-2' );
					}
				},
				{
					text: "1/3 Column",
					onclick: function(){
						editor.execCommand( 'Layout_Divider', 'column-1-3' );
					}
				},
				{
					text: "2/3 Column",
					onclick: function(){
						editor.execCommand( 'Layout_Divider', 'column-2-3' );
					}
				},
				{
					text: "1/4 Column",
					onclick: function(){
						editor.execCommand( 'Layout_Divider', 'column-1-4' );
					}
				},
				{
					text: "3/4 Column",
					onclick: function(){
						editor.execCommand( 'Layout_Divider', 'column-3-4' );
					}
				},
				{
					text: "End Grid",
					onclick: function(){
						editor.execCommand( 'Layout_Divider', 'end-grid' );
					}
				},
			]
		});
	});
})(tinymce);
