$('.multiple-items ').slick({
    Infinity: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplaySpeed: 1000,
    arrows: true,
    prevArrow: '<i class="fal fa-angle-left"></i>',
    nextArrow: '<i class="fal fa-angle-right"></i>',
});

$('.tab-multiple-items ').slick({
  Infinity: true,
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplaySpeed: 3000,
  arrows: true,
  prevArrow: '<i class="fal fa-angle-left"></i>',
  nextArrow: '<i class="fal fa-angle-right"></i>',
    responsive: [
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 1, 
            }
        }
    ]
});

$('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  asNavFor: '.slider-nav',
});
$('.slider-nav').slick({
  Infinity: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: false,
  centerMode: true,
  focusOnSelect: true,
  prevArrow: '',
  nextArrow: '',
  autoplaySpeed:3000,
});

