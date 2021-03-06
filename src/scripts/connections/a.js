(function(window,undefined){

  // Localise Globals
  var $ = window.jQuery;

$BS.connect($('a').not('.no-bs'), function() {
     $(this).click(function (event) {
          $url = $(this ).attr('href')

          if (event.which === 2 || event.metaKey || ($url.indexOf(':') > -1 && $url.indexOf(location.hostname) == -1)) return true

          $BS.query($url)

          History.pushState({url: $url}, $(this ).attr('title'), $url)

          event.preventDefault()
          return false
     })
})

})(window);
