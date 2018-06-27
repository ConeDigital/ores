jQuery(document).ready( function($) {


    //HOME HERO SWIPER LEFT
    var homeHeroSwiperLeft = new Swiper('.cd-home-swiper-left', {
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 0,
        autoplay: 4000,
        loop: true,
        slideShadows: true,
        disableOnInteraction: false,
        effect: 'flip',
        grabCursor: true
    });

    //HOME HERO SWIPER MIDDLE
    var homeHeroSwiperMiddle = new Swiper('.cd-home-swiper-middle', {
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 0,
        autoplay: 4500,
        loop: true,
        slideShadows: true,
        disableOnInteraction: false,
        effect: 'flip',
        grabCursor: true
    });

    //HOME HERO SWIPER RIGHT
    var homeHeroSwiperRight = new Swiper('.cd-home-swiper-right', {
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 0,
        autoplay: 4250,
        loop: true,
        slideShadows: true,
        disableOnInteraction: false,
        effect: 'flip',
        grabCursor: true
    });


});
