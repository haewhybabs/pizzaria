(function($, functionName) {
  'use strict';

  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function(cb, threshold, execAsap) {
    var timeout;

    return function debounced() {
      var obj = this,
        args = arguments;

      function delayed() {
        if (!execAsap) {
          cb.apply(obj, args);
        }
        timeout = null;
      }

      if (timeout) {
        clearTimeout(timeout);
      } else if (execAsap) {
        cb.apply(obj, args);
      }
      timeout = setTimeout(delayed, threshold || 10);
    };
  };
  // smartresize
  jQuery.fn[functionName] = function(callback) {
    return callback ? this.bind('resize', debounce(callback)) : this.trigger(
      functionName
    );
  };

})(jQuery, 'smartresize');
