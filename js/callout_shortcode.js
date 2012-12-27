jQuery(document).ready(function($) {
  tinymce.create('tinymce.plugins.tnics_plugin', {
    init : function( ed, url ) {

      // Register command for when button is clicked
      ed.addCommand( 'tnics_insert_shortcode', function(u, v) {
        selected = tinyMCE.activeEditor.selection.getContent();


        if( selected ) {
          return false;
        }else {
          content = '[callout]';
        }

        tinymce.execCommand( 'mceInsertContent', false, content );
      });

      // Register buttons - trigger above command when clicked
      ed.addButton( 'tnics_button', {
        title : 'Insert shortcode',
        cmd : 'tnics_insert_shortcode',
        image : url + '/path/to/image.png'
      });

    }
  });

  // Register our TinyMCE plugin
  // first parameter is the button ID1
  // second parameter must match the first parameter of the tinymce.create() function above
  tinymce.PluginManager.add( 'tnics_button', tinymce.plugins.tnics_plugin );
});