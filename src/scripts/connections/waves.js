(function(window,undefined){

  // Localise Globals
  var $ = window.jQuery, Waves = window.Waves;

$BS.connect('waves', '.waves-effect', function() {
  console.log('Applying Waves connection.');
  // console.log(typeof Waves);
  Waves.attach(this);
})

})(window);
