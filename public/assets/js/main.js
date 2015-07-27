// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

(function(window,$,undefined){
    $(function(){

        var curUrl  = window.location.href;

        if(curUrl.charAt(curUrl.length - 1)==="/"){
            curUrl  = curUrl.substr(0,curUrl.length-1);
        }
        console.log(curUrl);

        $("#main-menu a").each(function(){
            var $this   = $(this);
            if($this.attr("href") === curUrl){
                $this.parent().addClass("active");
            }
        });

    });
})(window,jQuery);
