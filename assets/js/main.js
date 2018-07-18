jQuery(document).ready( function($) {

    //Initiate swipers after load
    $(window).load(function () {
        //HOME HERO SWIPER LEFT
        var homeHeroSwiperLeft = new Swiper('.cd-home-swiper-left', {
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 0,
            autoplay: {
                delay: 6000,
            },
            loop: true,
            slideShadows: true,
            disableOnInteraction: false,
            effect: 'flip',
            grabCursor: true
            //autoplayStart: function (){
            //    console.log('fisk');
            //}
        });

        //HOME HERO SWIPER MIDDLE
        var homeHeroSwiperMiddle = new Swiper('.cd-home-swiper-middle', {
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 0,
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
            loop: true,
            slideShadows: true,
            disableOnInteraction: false,
            effect: 'flip',
            grabCursor: true
        });

        homeHeroSwiperLeft.on('autoplay', function () {
            test(homeHeroSwiperLeft, homeHeroSwiperMiddle, 1);
        });

        homeHeroSwiperMiddle.on('autoplay', function () {
            test(homeHeroSwiperMiddle, homeHeroSwiperRight, 2);
        });

        homeHeroSwiperRight.on('autoplay', function () {
            test(homeHeroSwiperRight, homeHeroSwiperLeft, 3);
        });

    });

    function test(current, next, which_swiper){
        if ( which_swiper !== 3 ) {
            next.params.autoplay = {
                delay: 500
            };
        }
        current.autoplay.stop();
        next.autoplay.start();
    }


    $('div.cone-tr .sod_select').on('focusout', function (e) {
        $('.cone-tr').removeClass('open');
        var ss = $(this).find('span.sod_select');
        ss.removeClass('focus');
        ss.removeClass('open');
    });

    $('.cone-variations').on('click', function () {
        $('.cone-tr').toggleClass('open');
        var ss = $(this).find('span.sod_select');
        ss.toggleClass('focus');
        ss.toggleClass('open');

    });

    //Fade out on click outside
    $(document).mouseup(function(e){
        var container = $(".cone-tr");
        var st = $('.cone-variations').find('span.sod_select');
        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0 && container.hasClass('open')){
            container.removeClass('open');
            container.removeClass('focus');
            st.removeClass('open');
            st.removeClass('focus');

        }
    });


});
