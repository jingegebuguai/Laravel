/*
 * MWS Admin v2.1 - FileInput Plugin JS
 * This file is part of MWS Admin, an Admin template build for sale at ThemeForest.
 * All copyright to this file is hold by Mairel Theafila <maimairel@yahoo.com> a.k.a nagaemas on ThemeForest.
 * Last Updated:
 * December 08, 2012
 *
 * 'Highly configurable' mutable plugin boilerplate
 * Author: @markdalgleish
 * Further changes, comments: @addyosmani
 * Licensed under the MIT license
 *
 */

;(function( $, window, document, undefined ) {
	// our plugin constructor
	function FileInput( element, options ) {
		if( arguments.length ) {
			this._init( element, options );
		}
    };
	
	// the plugin prototype
	FileInput.prototype = {
		defaults: {
			placeholder: 'No file selected...', 
			buttontext: 'Browse...'
		}, 

		_init: function( element, options ) {
			this.element = $( element );
			this.options = $.extend( {}, this.defaults, options, this.element.data() );

			this._build();
		}, 

		_build: function () {

			this.element.css( {
				'position': 'absolute', 
				'top': 0, 
				'right': 0, 
				'margin': 0, 
				'cursor': 'pointer', 
				'fontSize': '999px', 
				'opacity': 0, 
				'zIndex': 999, 
				'filter': 'alpha(opacity=0)'
			} )
			.on( 'change.fileupload', $.proxy( this._change, this) );

			this.container = $( '<div class="fileinput-holder" style="position: relative;"></div>' )
				.append( $( '<input type="text" class="fileinput-preview" style="width: 100%;" readonly="readonly" />' )
					.attr('placeholder', this.options.placeholder ) 
				)
				.append( $( '<span class="fileinput-btn btn" type="button" ' + 
					'style="display:block; overflow: hidden; position: absolute; top: 0; right: 0; cursor: pointer;"></span>' )
						.text( this.options.buttontext )
				)
				.insertAfter( this.element );

			var btn = this.container.find( '.fileinput-btn' );
			this.element.appendTo( btn );

			this.container.find( '.fileinput-preview' ).css('paddingRight', (btn.outerWidth() + 4) + 'px')

		}, 

		_change: function ( e ) {
			var file = e.target.files !== undefined ? e.target.files[0] : { name: e.target.value.replace(/^.+\\/, '') };
			if ( !file ) return;
			
			this.container.find( '.fileinput-preview ' ).val(file.name);
		}
	}

	$.fn.fileInput = function( options ) {
		return this.each(function() {
			new FileInput( this, options );
		});
	};

})( jQuery, window , document );
