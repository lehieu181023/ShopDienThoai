jQuery(document).ready(function($){
    
    // jQuery sticky Menu
    
	$(".mainmenu-area").sticky({topSpacing:0});
    
    
    $('.product-carousel').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:5,
            }
        }
    });  
    
    $('.related-products-carousel').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:2,
            },
            1000:{
                items:2,
            },
            1200:{
                items:3,
            }
        }
    });  
    
    $('.brand-list').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:4,
            }
        }
    });    
    
    
    // Bootstrap Mobile Menu fix
    $(".navbar-nav li a").click(function(){
        $(".navbar-collapse").removeClass('in');
    });    
    
    // jQuery Scroll effect
    $('.navbar-nav li a, .scroll-to-up').bind('click', function(event) {
        var $anchor = $(this);
        var headerH = $('.header-area').outerHeight();
        $('html, body').stop().animate({
            scrollTop : $($anchor.attr('href')).offset().top - headerH + "px"
        }, 1200, 'easeInOutExpo');

        event.preventDefault();
    });    
    
    // Bootstrap ScrollPSY
    $('body').scrollspy({ 
        target: '.navbar-collapse',
        offset: 95
    })      
});

function BlockUI() {
    $("#blockUI").css("display", "flex");
  }
  
function UnBlockUI() {
$("#blockUI").css("display", "none");
}

function sendGetRequest(id) {
    // Lấy URL hiện tại và thêm tham số GET
    let currentUrl = window.location.href;
    let newUrl = currentUrl + "?id=" + id;

    // Chuyển hướng đến URL mới
    window.location.href = newUrl;
}

function LoadHeader(){
    $.ajax({
        url: "header.php",
        type: "GET",
        success: function (response) {
            $("#header").html(response); // Chèn dữ liệu vào bảng
        },
        error: function () {
            alert("Không thể tải dữ liệu!");
        }
    });
}

searchProduct = function (search){
    $.ajax({
        url: "DB/product/listdataSearch.php", // Gọi file PHP xử lý
        type: "GET",
        data: { search: search },
        success: function (response) {
            $("#listdatasearch").html(response); // Chèn dữ liệu vào bảng
            $("#search").val(search);
        },
        error: function () {
            alert("Không thể tải dữ liệu!");
        }
    });
}
