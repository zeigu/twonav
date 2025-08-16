/***
*Theme by 总裁 [www.dhceo.com]       
*The url:www.dhceo.com
*warning:Please respect the author's work
***/
jQuery(document).ready(function($) {
    var sweetTitles = {
        x: 10,
        y: 20,
        tipElements: "a,span,img,div ",
        noTitle: false,
        init: function() {
            var noTitle = this.noTitle;
            $(this.tipElements).each(function() {
                $(this).mouseover(function(e) {
                    if (noTitle) {
                        isTitle = true;
                    } else {
                        isTitle = $.trim(this.title) != '';
                    }
                    if (isTitle) {
                        this.myTitle = this.title;
                        this.title = "";
                        var tooltip = "<div class='tooltip'><div class='tipsy-arrow tipsy-arrow-n'></div><div class='tipsy-inner'>" + this.myTitle + "</div></div>";
                        $('body').append(tooltip);
                        $('.tooltip').css({
                            "top": (e.pageY + 25) + "px",
                            "left": (e.pageX - 15) + "px"
                        }).show('fast');
                    }
                }).mouseout(function() {
                    if (this.myTitle != null) {
                        this.title = this.myTitle;
                        $('.tooltip').remove();
                    }
                }).mousemove(function(e) {
                    $('.tooltip').css({
                        "top": (e.pageY + 25) + "px",
                        "left": (e.pageX - 15) + "px"
                    });
                });
            });
        }
    };
    $(function() {
        sweetTitles.init();
    });
});

//复制提示代码
$("body").bind('copy',
    function (e) {
        if (typeof window.getSelection == "undefined") return;
        var body_element = document.getElementsByTagName('body')[0];
        var selection = window.getSelection();
        if (("" + selection).length < 30) return;
        var newdiv = document.createElement('div');
        newdiv.style.position = 'absolute';
        newdiv.style.left = '-99999px';
        body_element.appendChild(newdiv);
        newdiv.appendChild(selection.getRangeAt(0).cloneContents());
        if (selection.getRangeAt(0).commonAncestorContainer.nodeName == "PRE") {
            newdiv.innerHTML = "<pre>" + newdiv.innerHTML + "</pre>";
        }
        newdiv.innerHTML += "原文来自：" + document.location.href;
        selection.selectAllChildren(newdiv);
        window.setTimeout(function () {
                body_element.removeChild(newdiv);
            },
            200);
    });

function warning() {
    if (navigator.userAgent.indexOf("MSIE") < 0) {
        layer.msg('复制成功,总裁提示您转载请保留原文链接！', {icon: "6", time: 2000, shift: 6});
    }
}
document.body.oncopy = function () {
    warning();
}