// Closure
(function(window,undefined){
	"use strict";

	// Localise Globals
	var $ = window.jQuery;

    var $bs = function() {
        this.connections = [];
        this.saved_query = null;
        return this;
    };

    $bs.prototype.connect = function( title, selector, callback ) {
      console.log('connecting '+selector);
        this.connections.push( {
					title: title,
            selector: selector,
            callback: callback
        } );
    };

    $bs.prototype.update = function( context ) {

        var $this = this;

        if ( typeof context === "Array" ) {
            $.each( context, function( index, item ) {
                $this.update( item );
            } );
        } else {
            // var $context = ( context ) ? $( context ) : $( "html" );
						var $context = $('html');

            $.each( $this.connections, function( index, $connection ) {
							// console.log('Updating for '+$connection.selector);
                $context.find( $connection.selector ).each( function( index, node ) {
									// console.log('Found item of type '+$connection.selector);
                    if ( !$( this ).attr( $connection.title+"_connected" ) ) {
												$connection.callback.call( node, index, node );
                        $( this ).attr( $connection.title+"_connected", true );
												// console.log('Calling '+$connection.selector+' Function:');
												// console.log($connection.callback);
                    }
                } );
            } );
        }
    };

    $bs.prototype.query = function( url ) {
        this.saved_query = {
            url: url,
            type: "POST",
            data: {},
            dataType: "json"
        };
        return this;
    };

    $bs.prototype.with_data = function( data ) {
        this.saved_query.data = data;
        return this;
    };

    $bs.prototype.get_query = function() {
        this.saved_query.data.ajax = 1;
        this.saved_query.data.bucket_csrf_token = $.pgwCookie( { name: "bucket_csrf_cookie" } );

        return this.saved_query;
    };

    $bs.prototype.has_query = function() {
        return ( this.saved_query !== null );
    };

    $bs.prototype.post = function( success, error ) {
        // var self = this;

        // console.log( "Running query" );

        var $request = this.get_query();

        this.saved_query = null;

				console.log(JSON.stringify($request));

        $request.success = function( data, textStatus, jqXHR ) {
            // alert(textStatus);
            // var parseData = $.parseJSON( data );
            // alert(data);
            // data = JSON.parse(data + "");
            this.respond( data, success );
        }.bind(this);

        $request.error = function( jqXHR, textStatus, errorThrown ) {
            // alert(textStatus);
            // if ( typeof error === "function" ) {
            //     error( jqXHR );
            // }
        };

        // console.log($request);

        $.ajax( $request );

    };

    $bs.prototype.respond = function( response, callback ) {
        $( response.changes ).each(
            function() {
							// console.log(this.target);
                if ( 'content' in this ) {
									// console.log('Content: '+this.content);
                    $( this.target ).html( this.content );
                } else if ( 'value' in this ) {
									// console.log('Value: '+this.value);
                    $( this.target ).val( this.value );
                } else if ('invalid' in this) {
									// console.log('Error: '+this.invalid);
									// console.log('Setting error on '+this.target+'_label to '+this.invalid);
									$(this.target+'_label').attr('data-error', this.invalid);
									$(this.target+'_label').attr('data-success', '');
									$(this.target).removeClass('valid');
									$(this.target).addClass('invalid');
								} else if ('valid' in this) {
									$(this.target+'_label').attr('data-success', this.valid);
									$(this.target+'_label').attr('data-success', '');
									$(this.target).removeClass('invalid');
									$(this.target).addClass('valid');
								}

                if ( !response.is_test ) {
                    $BS.update( this.target );
                }

                if ( callback ) {
                    callback.call( response );
                }
            }
        );

				// $BS.update();

        if ( response.redirect ) {
            $BS.query( response.redirect );
            History.pushState(
                { url: response.redirect },
                $( this ).attr( "title" ),
                response.redirect
            );
        }
    };

    module.exports = new $bs();

})(window);
