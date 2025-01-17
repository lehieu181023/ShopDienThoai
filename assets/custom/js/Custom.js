'use strict';
$(document).ready(function () {
    changeSizeHeader();

    //Scrollbar cho cột trái và cột phải
    //$('.scrollJs').mCustomScrollbar({ axis: "xy", });
    //$('#FormInput').mCustomScrollbar({ axis: "y" });

    //Ghim các tab khi đóng lại
    
    $('html').on('click', '.pintab', function (e) {
        var id = $(this).attr("data-id");
        $('#' + id).fadeToggle();
        var text = $(this).attr("data-text");
        if (!$(this).hasClass('expend')) {
            $('#pintab ul').append('<li><a href="javascript://" title="' + text + '" data-id="' + id + '" class="pintab expend">' + text + ' <i class="fa fa-arrows-alt" aria-hidden="true"></i></a></li> ');
        }
        $(this).parent('li').remove();
    });
    
    //Phục vụ tắt + bật multiple modal
    $(document).on('show.bs.modal', '.modal', function () { 
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function () {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });
    $(document).on('hidden.bs.modal', '.modal', function () {
        $(this).data('bs.modal', null);
    });

    //$("#colRightHoSo").on("resizestop", function (event, ui) { alert(123); });

    /*==================================================================*/
    //Thay đổi select -> thay đổi giá trị trường dữ liệu

    $('html').on("change",
        ".changeValueName",
        function () { 
            var name = $(this).attr("data-name");
            var text = $(this).find("option:selected").text();
            if ($(this).parents(".modal").length > 0)
                $('.modal #' + name).val(text.trim().replace(/-/g, ""));
            else $('#' + name).val(text.trim().replace(/-/g, ""));
        });

    showHideButtonPemission();

    if ($("#searchForm select").length > 0)  $("#searchForm select:not(.notselect2)").select2();

    $('html').on('click', ".tabs .tab-links a",
        function () {
            var currentAttrValue = $(this).data('href');
            $('.tabs ' + currentAttrValue).addClass("active").siblings().removeClass("active");
            $(this).parents('li').addClass('active').siblings().removeClass('active');
            //e.preventDefault();
        });

    $(function () {
        $('.noidung img').attr("data-lightbox", "roadtrip");
        var countimg = 0;
        $('.noidung img').each(function () {
            var src = $(this).attr("src");
            if (!$(this).parent().is("a")) {
                $('<a class="example-image-link countimg' +
                    countimg +
                    '" href="' +
                    src +
                    '" data-lightbox="example-1"></a>').insertBefore($(this));
                $('.countimg' + countimg).append($(this));
            } else {
                var href = $(this).parent("a").attr("href");
                if (href === src)
                    $(this).parent("a").attr({
                        "class": "example-image-link countimg" + countimg,
                        "data-lightbox": "example-1"
                    });
            }
            countimg++;
        });

        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        });
    });
});
 


$(window).resize(function () {
    changeSizeHeader();
}); 

function changeSizeHeader() { 
     var totalVal = $(window).innerHeight() - $('#header').innerHeight() - $('#menuMain').innerHeight();
     $('#flexBody').innerHeight(totalVal); 
     $('#FormInput').innerHeight(totalVal - 20);  
 }

function breakTextarea(id) {
    var span = $('<span>').css('display', 'inline-block').css('word-break', 'break-all').appendTo('#' + id).css('visibility', 'hidden').hide();
    function initSpan(textarea) {
        span.text(textarea.text()).width(textarea.width()).css('font', textarea.css('font'));
    }

    $('#' + id + ' table textarea').each(function () {
        initSpan($(this));
        var text = $(this).val();
        span.text(text);
        $(this).innerHeight(text ? span.innerHeight() : '25px');
    });


    $('#' + id + ' table textarea').attr("cols", "1");
    $('#' + id + ' table textarea').on({
        input: function () {
            var text = $(this).val();
            span.text(text);
            $(this).innerHeight(text ? span.innerHeight() : '25px');
        },
        focus: function () {
            initSpan($(this));
        },
        keypress: function (e) {
            if (e.which == 13) e.preventDefault();
        }
    });

    
} 

function showHideButtonPemission() {  
    var hideIsRoot = $("#hideIsRoot").text();
    if (hideIsRoot.toLowerCase() == "false") {
        var hideRoles = $("#hideRoles").text();
        var arrRoles;
        if (hideRoles != "") {
            arrRoles = hideRoles.split(',').filter(g => g != "").map(g => g.toLowerCase());
        }
        var check = false;
        var arrTemp;
        $(".permCodeVz").each(function(index) {
            var classThis = $(this).attr("class");
            if (classThis != "" && classThis != undefined) {
                arrTemp = classThis.split(' ').map(x => x.toLowerCase().replace('_', '.'));
                check = arrRoles.filter(value => arrTemp.includes(value)).length > 0;
            } else {
                check = false;
            }
            if (!check)
                $(this).remove();
            else
                $(this).css("display", "inline-flex");
        });
    } else {
        $(".permCodeVz").css("display", "inline-flex");
    }
}

 $(function () {
        //$("img").lazy({
        //    effect: "fadeIn",
        //    effectTime: 1000, 
        //    placeholder: "../css/icon/logo.png"
        //});

        //$('.noidung img').attr("data-lightbox", "roadtrip");

        //var countimg = 0;
        //var tenmienwebsite = $('#TenMienWebSite').val();
        //$('.noidung img').each(function () {
        //    var src = $(this).attr("src");
        //    if (!src.includes("http")) {
        //        src =tenmienwebsite + "/" + $(this).attr("src");
        //    }
        //    $(this).attr("src", src);
        //    if (!$(this).parent().is("a")) {
        //        $('<a class="example-image-link countimg' +
        //            countimg +
        //            '" href="' +
        //            src +
        //            '" data-lightbox="example-1"></a>').insertBefore($(this));
        //        $('.countimg' + countimg).append($(this));
        //    } else {
        //        var href = $(this).parent("a").attr("href");
        //        if (href === src)
        //            $(this).parent("a").attr({
        //                "class": "example-image-link countimg" + countimg,
        //                "data-lightbox": "example-1"
        //            });
        //    }
        //    countimg++;
        //});

        //lightbox.option({
        //    'resizeDuration': 200,
        //    'wrapAround': true
        //}); 
    });
	//Tăng giảm cỡ chữ
var size = parseInt($(".noidung").css("font-size"));
var lineheight = parseInt($(".noidung").css("line-height"));
if (!size)
    size = 14;
if (!lineheight)
    lineheight = 22;

function format(state) {
    if (!state.id) return state.text; // optgroup
    var baseUrl = $(state.element).attr('data-image');;
    return "<img style='max-width: 70px; margin-right: 15px; max-height: 100%;' src='" + baseUrl + "'/>" + state.text;
}

function Increasenoidung() {
    size++;
    lineheight += 2; 
    $(".noidung")
        .css('cssText','font-size:' +size + 'px !important; line-height:' + lineheight + 'px !important');
    $(".noidung").find("*").css('cssText','font-size:' +size +'px !important; line-height:' +lineheight +'px !important');
}
function Decreasenoidung() {
    size--;
    lineheight -= 2;

    $(".noidung")
        .css('cssText',
            'font-size:' +
            size +
            'px !important; line-height:' +
            lineheight +
            'px !important');
    $(".noidung")
        .find("*")
        .css('cssText',
            'font-size:' +
            size +
            'px !important; line-height:' +
            lineheight +
            'px !important');
}
function Resetnoidung() {
    size = 14;
    lineheight = 22;

    $(".noidung")
        .css('cssText',
            'font-size:' +
            size +
            'px !important; line-height:' +
            lineheight +
            'px !important');
    $(".noidung")
        .find("*")
        .css('cssText',
            'font-size:' +
            size +
            'px !important; line-height:' +
            lineheight +
            'px !important');
}

//Thiết lập thời gian đăng xuất khi người dùng không thao tác trên hệ thống
(function () {
    var lastMove = Date.now();
    document.onmousemove = function () {
        lastMove = Date.now();
    }
    var htmlLockSreen = "<div id='lockscreen'>" + $("#lockscreen").html() + "</div>"; 
    setInterval(function () {
        var diff = Date.now() - lastMove; 
        var lockscr = $.cookie('lockscr'); 
        if (lockscr == "1") {
            if ($("#lockscreen").length == 0) {
                $("body").append(htmlLockSreen);
                recapcha();
            }
            $("#lockscreen").addClass("active");
        } 
        if (diff > (30 * 60 * 1000) && !$("#lockscreen").hasClass("active")) {
            $("#lockscreen").addClass("active");
            $.cookie('lockscr', '1', { path: '/' });
        } else {
            clearInterval();
        }
    }, 1000);
    
}());

var url = window.location.href;
var arr = url.split("/");
var resultUrl = arr[0] + "//" + arr[2];
function get_css_print(ele) {
    let style = "<html><meta charset='utf-8' /><style>body {background: #fff !important}</style>";
    style += '<link href="'+resultUrl + '/Assets/custom/css/print.css" rel="stylesheet">';
    let baseUrl = resultUrl;
    $(ele + " link").each(function () {
        let vl = this.outerHTML;
        let n = vl.search("~");
        if (n != -1) {
            vl = vl.replace("~", baseUrl);
        } else {
            let m = vl.search(baseUrl);
            if (m == -1) {
                vl = vl.replace("\"/", "\"" + baseUrl + "/");
            }
        }
        style += vl;
    });
    $(ele + " style").each(function () { style += this.outerHTML; });
    return style;
}