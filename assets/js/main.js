jQuery(document).ready( function($) {

    //Initiate swipers after load
    $(window).load(function () {
        //HOME HERO SWIPER LEFT
        var homeHeroSwiperLeft = new Swiper('.cd-home-swiper-left', {
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 0,
            autoplay: 6000,
            loop: true,
            slideShadows: true,
            disableOnInteraction: false,
            effect: 'flip',
            grabCursor: true
        });

        //HOME HERO SWIPER MIDDLE
        var homeHeroSwiperMiddle = new Swiper('.cd-home-swiper-middle', {
            init: false,
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 0,
            autoplay: 6000,
            loop: true,
            slideShadows: true,
            disableOnInteraction: false,
            effect: 'flip',
            grabCursor: true
        });

        //HOME HERO SWIPER RIGHT
        var homeHeroSwiperRight = new Swiper('.cd-home-swiper-right', {
            init: false,
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 0,
            autoplay: 6000,
            loop: true,
            slideShadows: true,
            disableOnInteraction: false,
            effect: 'flip',
            grabCursor: true
        });

        setTimeout(function(){
            homeHeroSwiperMiddle.init();
        }, 500);


        setTimeout(function(){
            homeHeroSwiperRight.init();
        }, 1000);
    });


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
