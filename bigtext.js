(function() {
    tinymce.PluginManager.add('dziudek_bigtext_button', function( editor, url ) {
       var editorFormatterSetup = function(self) {
       		editor.formatter.register('bigtext', {
				inline : 'strong',
				styles : {fontSize : '32px'}
			});

    		editor.formatter.formatChanged('bigtext', function(state) {
            	self.active(state);

                if(state) {
                    document.querySelector('#' + self._id + ' i').setAttribute('class', 'mce-ico mce-i-icon dashicons-arrow-down-alt2');
                } else {
                    document.querySelector('#' + self._id + ' i').setAttribute('class', 'mce-ico mce-i-icon dashicons-arrow-up-alt2');
                }
        	});
       };

       editor.addButton("dziudek_bigtext_button", {
            title: 'Big text',
            tooltip: "Toggle big text",
            icon: 'icon dashicons-arrow-up-alt2',
            onclick: function() {
 				editor.formatter.toggle('bigtext');
                console.log(this);
           	},
            onpostrender: function() {
                var self = this;

                if(editor.formatter) {
                	editorFormatterSetup(self);
                } else {
                	editor.on('init', function() {
                		editorFormatterSetup(self);
                	});
                }
            }
        })
    });
})();