(function(window,undefined){

  // Localise Globals
  var $ = window.jQuery;

$BS.connect('collapsible', '.collapsible', function() {
  $('.collapsible').collapsible({
    accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
  });
})

})(window);
