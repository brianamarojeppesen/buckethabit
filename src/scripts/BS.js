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

    $bs.prototype.connect = function( selector, callback ) {
      console.log('connecting '+selector);
        this.connections.push( {
            selector: selector,
            callback: callback
        } );
    };

    $bs.prototype.update = function( context ) {

        console.log('Updating $BS.');

        var $this = this;

        if ( typeof context === "Array" ) {
            $.each( context, function( index, item ) {
                $this.update( item );
            } );
        } else {
            var $context = ( context ) ? $( context ) : $( "html" );

            $.each( $this.connections, function( index, $connection ) {
              console.log('found connection with selector '+$connection.selector);

                $context.find( $connection.selector ).each( function( index, node ) {
                    if ( !$( this ).attr( "bs_connected" ) ) {
                        $( this ).attr( "bs_connected", true );
                        $connection.callback.call( node, index, node );
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

        console.log( "Running query" );

        var $request = this.get_query();

        this.saved_query = null;

        $request.success = function( data, textStatus, jqXHR ) {
            // alert(textStatus);
            // var parseData = $.parseJSON( data );
            // alert(data);
            // data = JSON.parse(data + "");
            this.respond( data, success );
        }.bind(this);

        $request.error = function( jqXHR, textStatus, errorThrown ) {
            alert(textStatus);
            // if ( typeof error === "function" ) {
            //     error( jqXHR );
            // }
        };

        console.log($request);

        $.ajax( $request );

    };

    $bs.prototype.respond = function( response, callback ) {
        $( response.changes ).each(
            function() {
                if ( this.content !== null ) {
                    $( this.target ).html( this.content );
                } else if ( this.value !== null ) {
                    $( this.target ).val( this.value );
                }

                if ( !response.is_test ) {
                    $BS.update( this.target );
                }

                if ( callback ) {
                    callback.call( response );
                }
            }
        );

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
