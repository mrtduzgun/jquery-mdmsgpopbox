
/**
 *  Response boxes that has success, fail, warning, information, loading..
 *
 *  @filename       jquery-mdmsgpopbox-1.0.js
 *  @date           27.12.12
 *  @author         Murat Duzgun
 *  @see            https://github.com/mrtduzgun/jquery-mdmsgpopbox
 */

(function($){

    $.mdmsgpopbox = function(options) {

        if (/1\.(0|1|2|3)\.(0|1|2)/.test($.fn.jquery)) {
            alert("It needs JQuery 1.3.2 version at least!");
            return false;
        }

        var msgBox = $(".mdMsgpopbox");
        var defaults;

        if (options && typeof options == "string") {

            var defaults = msgBox.data('opts');

            if (options == "hide")
                hideMsgBox();

            return true;
        }

        defaults = $.extend($.mdmsgpopbox.defaults, options);
        msgBox.data('opts', defaults);

        if (msgBox && msgBox.length > 0) {
            msgBox = $(".mdMsgpopbox");
            clearTimer();

            msgBox.children().removeClass().
                addClass(defaults.cssClasses[defaults.msgType]).html(defaults.message);

            if (defaults.msgType && defaults.msgType != "loading") {
                setTimer(hideMsgBox);
                $(".mdMsgpopboxOverlay").hide();
            }

            if (defaults.msgType && defaults.msgType == "loading")
                $(".mdMsgpopboxOverlay").show();

            msgBox.fadeIn("fast");

        } else {

            $("body").append('<div class="mdMsgpopbox">'+
                '<div class="'+ defaults.cssClasses[defaults.msgType] +'">'+
                defaults.message +'</div>'+
                '</div>');

            msgBox = $(".mdMsgpopbox").fadeIn("fast");

            if (defaults.msgType && defaults.msgType != "loading")
                setTimer(hideMsgBox);

            if (defaults.msgType && defaults.msgType == "loading")
                $("<div class='mdMsgpopboxOverlay'/>").appendTo("body");
        }

        if (defaults.mouseKeyboardEvent && defaults.msgType &&
            defaults.msgType != "loading")
            bindEvents();

        function hideMsgBox() {
            $(".mdMsgpopboxOverlay").hide();
            msgBox.fadeOut("fast", function() {
                if (defaults && defaults.finishCallback)
                    defaults.finishCallback.call();
            });
        }

        function clearTimer() {
            if (msgBox.data("timer"))
                clearTimeout(msgBox.data("timer"));
        }

        function setTimer(callback) {
            msgBox.data("timer", setTimeout(callback, defaults.timeout));
        }

        function bindEvents() {
            msgBox.bind("mousemove click keypress",function(e){
                clearTimer();
                hideMsgBox();
            });
        }

        return true;
    }

    $.mdmsgpopbox.defaults = {
        cssClasses: {
            success:    'mdMsgpopboxSuccess',
            fail:       'mdMsgpopboxFail',
            warning:    'mdMsgpopboxWarning',
            info:       'mdMsgpopboxInfo',
            loading:    'mdMsgpopboxLoading'
        },
        timeout: 3000,
        message: '',
        finishCallback: null,
        msgType: 'success', // success, fail, warning, info, loading
        mouseKeyboardEvent: false
    };

})(jQuery);