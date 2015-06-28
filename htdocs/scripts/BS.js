var $bs = function() {
     this.connections = []
     this.saved_query = null
     return this
}

$bs.prototype.connect = function(selector, callback) {
     this.connections.push({
          selector: selector,
          callback: callback
     })
}

$bs.prototype.update = function(context) {

     $this = this;

     if (typeof context == 'Array') {
          $.each(context, function(index, item) {
               $this.update(item)
          })
     } else
     {
          $context = (context) ? $ ( context ) : $ ( 'html' )

          $.each($this.connections, function(index, $connection) {

               $context.find($connection.selector ).each(function(index, node) {
                    if (!$(this ).attr('bs_connected'))
                    {
                         $ ( this ).attr ( 'bs_connected' , true )
                         $connection.callback.call ( node , index , node );
                    }
               })
          })
     }
}

$bs.prototype.query = function(url) {
     this.saved_query = {
          url: url,
          type: 'POST',
          data: {},
          dataType: 'JSON'
     };
     return this
}

$bs.prototype.with_data = function(data) {
     this.saved_query.data = data
     return this
}

$bs.prototype.get_query = function() {
     this.saved_query.data['ajax'] = 1
     this.saved_query.data['bucket_csrf_token'] = $.pgwCookie({name: 'bucket_csrf_cookie'})

     return this.saved_query
}

$bs.prototype.has_query = function() {
     return (this.saved_query !== null)
}



$bs.prototype.post = function(success, error) {
     $this = this

     console.log('Running query')

     $request = this.get_query()

     this.saved_query = null;

     $request['success'] = function(response) {
          response = $.parseJSON(response)
          $this.respond(response, success)
     }

     $request['error'] = function(response) {
          if (typeof error == 'function') error(response)
     }

     $.ajax($request)

}

$bs.prototype.respond = function(response, callback) {
     console.log('Parsing response.')

     $ ( response.changes ).each (
               function ()
               {
                    //console.log('response item:')
                    //console.log(this)
                    if (this.content !== null)
                    {
                         $ ( this.target ).html ( this.content )
                    } else if (this.value !== null) {
                         $( this.target ).val( this.value )
                    }

                    if (!response.is_test) {
                         $BS.update( this.target )
                    }

                    if ( callback )
                    {
                         callback.call ( response )
                    }
               }
     )

     if (response.redirect) {
          $BS.query(response.redirect)
          History.pushState({url: response.redirect}, $(this ).attr('title'), response.redirect)
     }
}



var $BS = new $bs()
