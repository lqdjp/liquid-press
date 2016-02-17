/*
RWD+
Author: LIQUID DESIGN
Author URI: https://lqd.jp/wp/
*/
jQuery(function ($) {
    if (navigator.userAgent.indexOf('iPhone') > 0 || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {
        $('body').append('<!-- RWD+ (Plugin: Liquid RWD Plus) --><div class="rwd"><div class="rwd_in"><strong class="hidden">Mobile</strong><a href="javascript:void(0);" class="rwd_sp hidden_sp">Mobile</a> | <strong class="hidden_sp">Desktop</strong><a href="javascript:void(0);" class="rwd_pc hidden">Desktop</a></div></div>');
        $(".hidden_sp").hide();
        $(".rwd_in").css({
            'color': '#333',
            'display': 'block',
            'background': '#eee',
            'margin': '20px',
            'padding': '10px 15px',
            'text-align': 'center',
            'border-radius': '5px',
            '-webkit-border-radius': '5px',
            '-moz-border-radius': '5px'
        });
        if ($.cookie("rwd")) {
            mode = $.cookie("rwd")
        } else {
            mode = "sp"
        }
        if (mode == "sp") {
            $(".rwd *").removeClass("hidden")
        } else {
            $(".rwd .hidden").hide();
            $(".rwd .hidden_rp").hide();
            $(".rwd .hidden_sp").show();
            $('meta[name="viewport"]').attr('content', 'width=1280, initial-scale=0.25');
            $(".rwd").css({
                'font-size': '50px'
            })
            $(".rwd_in").css({
                'margin': '0',
                'padding': '20px 0',
                'position': 'fixed',
                'width': '100%',
                'bottom': '0'
            });
        }
        $(".rwd_pc").click(function () {
            $.cookie("rwd", "pc", {
                path: '/'
            });
            url = location.href;
            location.href = url;
            return false
        });
        $(".rwd_sp").click(function () {
            $.cookie("rwd", "sp", {
                path: '/'
            });
            url = location.href;
            location.href = url;
            return false
        });
    }
});