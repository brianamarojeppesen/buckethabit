(function(window,undefined){

  // Localise Globals
  var $ = window.jQuery;

  $BS.connect('history', 'body', function() {

       // Bind to StateChange Event
       History.Adapter.bind(window, 'statechange', function() {
            var State = History.getState()
            if (!$BS.has_query()) $BS.query(State.url)
            $BS.post()
       })

       History.replaceState({url: location.href}, document.title, location.href)
  })

})(window);
