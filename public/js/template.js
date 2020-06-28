// left or right carousel add class to odd or even rows
$(document).ready(function(){
  $( ".product_home_page:odd .flow_direction" ).addClass('right_carousel');
  $( ".product_home_page:even .flow_direction" ).addClass('left_carousel');
});

//slider
$(document).ready(function () {
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        lazyLoad: 'ondemand',
        cssEase: 'ease',
        speed: 600,
        arrows: true,
        nextArrow: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        fade: true,
        autoplaySpeed: 5000,
        infinite: true,
        autoplay: true,
        asNavFor: '.slider-nav'

    });
    $('.slider-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        infinite: true,
        centerMode: true,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 769,
                settings: {
                    slidesToShow:1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
});


// carousel_slider
$(document).ready(function () {
    $('.responsive').slick({
        dots: false,
        arrow: true,
        nextArrow: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        infinite: true,
        speed: 300,
        draggable: true,
        autoplay: true,
        cssEase: 'ease',
        autoplaySpeed: 5000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});
// carousel_slider
$(document).ready(function () {
    $('.sales_expert_in_category').slick({
        dots: false,
        arrow: true,
        nextArrow: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        infinite: true,
        speed: 300,
        draggable: true,
        autoplay: true,
        cssEase: 'ease',
        autoplaySpeed: 10000,
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});

// partners carousel slider
$(document).ready(function () {
    $('.partners_carousel_slider').slick({
        dots: false,
        arrow: true,
        nextArrow: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        lazyLoad: 'ondemand',
        cssEase: 'ease-out',
        infinite: true,
        outerEdgeLimit: false,
        pauseOnFocus: true,
        pauseOnHover: true,
        speed: 700,
        draggable: false,
        autoplay: true,
        autoplaySpeed: 8000,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    draggable: true,
                    infinite: true,
                    dots: false,
                    swipe:true,

                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    swipe:true,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    swipe:true,
                }
            }
        ]
    });
});

//slider sales_expert
$(document).ready(function () {
    var titleTab = document.getElementsByClassName('responsive_sales_expert');
    var lengthTitleTab = titleTab.length;
    // var final = lengthTitleTab / 2 ;
    var final = lengthTitleTab - lengthTitleTab;
    // alert(final);
    $('.slider-for2').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        draggable: false,
        fade: true,
        asNavFor: '.slider-nav2'
    });
    $('.slider-nav2').slick({

        slidesToShow: final,
        slidesToScroll: 1,
        asNavFor: '.slider-for2',
        dots: false,
        speed: 100,
        draggable: false,
        infinite: false,
        centerMode: true,
        arrows: false,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 5,
                    infinite: true,
                    rtl: true,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 3,

                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,

                }
            }
        ]
    });
});


// carousel_slider
$(document).ready(function () {
    $('.responsive_sales_expert').slick({
        dots: false,
        nextArrow: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        infinite: true,
        speed: 100,

        draggable: true,
        autoplay: false,
        autoplaySpeed: 5000,
        slidesToShow: 3,
        slidesToScroll: 1,
        cssEase: 'fade',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});


// carousel_slider seller
$(document).ready(function () {
    $('.seller_index').slick({
        dots: false,
        arrow: true,
        nextArrow: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        infinite: true,
        speed: 300,
        draggable: true,
        autoplay: false,
        autoplaySpeed: 5000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});

// carousel_slider product
$(document).ready(function () {
    $('.product_index').slick({
        dots: false,
        arrow: true,
        nextArrow: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        infinite: true,
        speed: 300,
        draggable: true,
        autoplay: false,
        autoplaySpeed: 5000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});


// Partners
$(document).ready(function () {
    $('.Partners_slider').slick({
        dots: false,
        arrow: true,
        nextArrow: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        lazyLoad: 'ondemand',
        cssEase: 'ease',
        infinite: true,
        speed: 300,
        draggable: true,
        autoplay: false,
        autoplaySpeed: 5000,
        slidesToShow: 6,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});


//Modal
$(document).ready(function () {
    $('.buttons .button').click(function () {
        var buttonId = $(this).attr('id');
        $('#modal-container').removeAttr('class').addClass(buttonId);
        $('body').addClass('modal-active');
    })
    $('.close_my_modal').click(function () {
            $('#modal-container').addClass('out');
            $('body').removeClass('modal-active');
            $('#modal-container').removeClass('button_key');
        }
    )
});

// Product_slider
$(document).ready(function () {
    $('.right_carousel').slick({
        dots: false,
        arrow: true,
        nextArrow: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        lazyLoad: 'ondemand',
        cssEase: 'ease',
        infinite: true,
        pauseOnFocus: true,
        pauseOnHover: true,
        speed: 800,
        draggable: true,
        autoplay: true,
        autoplaySpeed: 8000,
        slidesToShow: 5,
        slidesToScroll: 5,
        swipeToSlide: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    draggable: true,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    draggable: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    draggable: true
                }
            }
        ]
    });
});
// Product_slider carousel To left
$(document).ready(function () {
    $('.left_carousel').slick({
        dots: false,
        arrow: true,
        nextArrow: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        lazyLoad: 'ondemand',
        cssEase: 'ease',
        infinite: true,
        pauseOnFocus: true,
        pauseOnHover: true,
        speed: 800,
        draggable: true,
        autoplay: true,
        autoplaySpeed: 8000,
        slidesToShow: 5,
        slidesToScroll: -5,
        swipeToSlide: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: -3,
                    infinite: true,
                    dots: false,
                    draggable: true
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: -2,
                    draggable: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: -1,
                    draggable: true
                }
            }
        ]
    });
});

//similar product
$(document).ready(function () {
    $('.similar_product').slick({
        dots: false,
        arrow: true,
        nextArrow: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        infinite: true,
        speed: 300,
        draggable: true,
        autoplay: true,
        cssEase: 'ease',
        autoplaySpeed: 5000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});



// add arrow class for menu if has submenu
$(document).ready(function () {
    $("li.sub_lvl_1:has(.sub_menu_level_1)").addClass('arrow');
    $("ul.sub_menu_level_1 li:has(.sub_menu_level_2)").addClass('arrow');
    $("ul.sub_menu_level_2 li:has(.sub_menu_level_3)").addClass('arrow');
});


// Remove activelvl1 , activelvl2 , activelvl3 in click out of category menu
$(document).ready(function () {
    $('body').on('click', function (e) {
        if (!(e.target.closest('#category_menu'))) {
            if ($('.sub_lvl_1').hasClass('activelvl1')) {
                $(".sub_lvl_1").removeClass("activelvl1");
            }
        }
        if (!(e.target.closest('#category_menu'))) {
            if ($('.sub_menu_level_1 li').hasClass('activelvl2')) {
                $(".sub_menu_level_1 li").removeClass("activelvl2");
            }
        }
        if (!(e.target.closest('#category_menu'))) {
            if ($('.sub_menu_level_2 li').hasClass('activelvl3')) {
                $(".sub_menu_level_2 li").removeClass("activelvl3");
            }
        }
        if (!(e.target.closest('.user_panel_login'))) {
            if ($('.user_menu').hasClass('active_user_menu')) {
                $(".user_menu").removeClass("active_user_menu").addClass('inactive_user_menu');
            }
        }
        if (!(e.target.closest('#lang-menu'))) {
            if ($('#lang-menu ul').css('display') == 'block') {
              $("#lang-menu ul").slideToggle(100);
            }
        }
    });
});

//slider seller Better
$(document).ready(function () {
    $('.slider-for3').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        draggable: false,
        fade: true,
        speed: 100,
        asNavFor: '.slider-nav3'
    });
    $('.slider-nav3').slick({

        slidesToShow: 2,
        // slidesToScroll: 0,
        padding: '0px',
        asNavFor: '.slider-for3',
        dots: false,
        draggable: false,
        infinite: false,
        centerMode: true,
        speed: 100,
        arrows: false,
        focusOnSelect: true
    });
});


// carousel_slider
$(document).ready(function () {
    $('.responsive_seller_best').slick({
        dots: false,
        nextArrow: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        infinite: true,
        speed: 100,
        draggable: true,
        autoplay: false,
        autoplaySpeed: 5000,
        slidesToShow: 5,
        slidesToScroll: 1,
        cssEase: 'fade',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});


// product_gallery_in_product_page
$(document).ready(function () {
    $('.slider-for6').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        infinite: true,
        autoplay: true,
        asNavFor: '.slider-nav6'

    });
    $('.slider-nav6').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.slider-for6',
        dots: false,
        infinite: true,
        centerMode: true,
        arrow: false,
        focusOnSelect: true
    });
});





// favorite_this_product
$(document).ready(function () {
    $('a.favorite_this_product').on('click', function () {
        var product = $('.favorite_this_product i').attr('data-id');
        var lang = $('html').attr('lang');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            type: 'POST',
            url:'../like'  ,

            data: {product: product},
            success: function (data) {
                if(data==1){
                    $('.favorite_this_product .fa').removeClass('fa-heart-o').addClass('fa-heart');
                      toastr.success('محصول به لیست علاقه مندی های شما اضافه شد');
                }
                else if(data==2){
                    $('.favorite_this_product .fa').removeClass('fa-heart').addClass('fa-heart-o');
                      toastr.success('محصول از لیست علاقه مندی های شما حذف شد.');
                }
                else if(data==3){
                    toastr.info("برای افزودن محصول به لیست علاقه مندی ها لاگین کنید." );
                }
            }
        });

        });

    // Like comment
    $('.like_comment i').on('click', function () {
        if ($(this).hasClass('fa-thumbs-o-up')) {
            $(this).addClass('voted');
        } else {
            alert('ثبت نشد');
        }
    });
    // dislike comment
    $('.dislike_comment i').on('click', function () {
        if ($(this).hasClass('fa-thumbs-o-down')) {
            $(this).addClass('disliked');
        } else {
            alert('ثبت نشد');
        }
    });
});

// open comment
$(document).ready(function () {
    $('#start_comment .textarea_comment textarea').on('click', function () {
        $('#start_comment .textarea_comments_tags').removeClass('off').addClass('on animated fadeIn');
        $('#start_comment .textarea_comment form').css('height', 'auto');

    });
});

// replay_this_comment
$(document).ready(function () {
    $('#box_for_replay .textarea_comment textarea').on('click', function () {
        $('#box_for_replay .textarea_comments_tags').removeClass('off').addClass('on animated fadeIn');
        $('#box_for_replay .textarea_comment form').css('height', 'auto');
    });
    $('#replayBtn').on('click', function () {
        if ($('#box_for_replay').hasClass('off_comment')) {
            $('#box_for_replay').removeClass('off_comment').addClass('on_comment');
        } else {
            $('#box_for_replay').removeClass('on_comment').addClass('off_comment');
        }
    });
});

// add checked input checkbox
$(document).ready(function () {
    $("#both-register-section2 input").on("click", function () {
        if (this.checked) {
            this.setAttribute("checked", "checked");
        } else {
            this.removeAttribute("checked");
        }
    });
});

// mmenu user profile
$(document).ready(function () {
    $(".user_panel_login").on("click", function () {
        if ($('.user_panel_login .user_menu').hasClass('inactive_user_menu')) {
            $('.user_panel_login .user_menu').addClass('active_user_menu').removeClass('inactive_user_menu');
        } else {
            $('.user_panel_login .user_menu').addClass('inactive_user_menu').removeClass('active_user_menu');
        }
    });
});

//add Class & Romove / add attr disabled
$(document).ready(function () {
    $('#both-register-section2  input:checkbox').change(function () {
        if ($(this).is(":checked")) {
            $('#both-register-section2').addClass("register-seller-both");
            $("#both-register-section2 .transparent-layer-register-seller input ,#both-register-section2 .transparent-layer-register-seller textarea ,#both-register-section2 .transparent-layer-register-seller select").attr("disabled", false);
        } else {
            $('#both-register-section2').removeClass("register-seller-both");
            $("#both-register-section2 .transparent-layer-register-seller input , #both-register-section2 .transparent-layer-register-seller textarea , #both-register-section2 .transparent-layer-register-seller select").attr("disabled", true);
        }
    });
});


// scroll top btn
$(document).ready(function () {
    var btn = $('#return-to-top');

    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    btn.on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: 0}, '300');
    });
});

$(document).ready(function () {
    var lvl_1 = '.sub_menu_level_1';
    var lvl_2 = '.sub_menu_level_2';
    var lvl_3 = '.sub_menu_level_3';

    $('.sub_lvl_1').mouseover(function () {
          if ($(this).hasClass('activelvl1')) {
            // $(this).removeClass('active');
          } else {
              $('.sub_lvl_1.activelvl1').removeClass('activelvl1');
              $(this).addClass('activelvl1');
              $('.sub_menu_level_1').addClass('animated fadeIn');
          }
    });
    $('.sub_menu_level_1 li').mouseover(function () {
          if ($(this).hasClass('activelvl2')) {
              // $(this).removeClass('active');
          } else {
              $('.sub_menu_level_1 li.activelvl2').removeClass('activelvl2');
              $(this).addClass('activelvl2');
              $('.sub_menu_level_2').addClass('animated fadeIn');
          }
    });
    $('.sub_menu_level_2 li').mouseover(function () {
          if ($(this).hasClass('activelvl3')) {
              // $(this).removeClass('active');
          } else {
              $('.sub_menu_level_2 li.activelvl3').removeClass('activelvl3');
              $(this).addClass('activelvl3');
              $('.sub_menu_level_3').addClass('animated fadeIn');
          }
    });
});

// responsive
(function ($) {
    function mediaSize() {
        if (window.matchMedia('(max-width: 1000px)').matches) {
            $(window).on("load", function () {
              $(".tile_title").remove();
              var tileContainer = (".horizontal_tiles");
              var tileContainerParent = $(tileContainer).parent();
              if ( $(tileContainerParent).has( "div" ) ) {
                  $(tileContainer).unwrap();
                  $(tileContainerParent).unwrap();
              }
            })
            $(document).ready(function () {
                if ($('.under_menu_open').hasClass('float')) {
                    $('.under_menu_open').removeClass('float');
                }
                if ($('.vertical_tile').hasClass('float')) {
                    $('.vertical_tile').removeClass('float');
                }
                if ($('.right_row_4box').hasClass('float')) {
                    $('.right_row_4box').removeClass('float');
                }
                if ($('.left_row_4box').hasClass('float')) {
                    $('.left_row_4box').removeClass('float');
                }
                if ($('.news_event_pedia .right_row').hasClass('float')) {
                    $('.news_event_pedia .right_row').removeClass('float');
                }
                if ($('.news_event_pedia .left_row').hasClass('float')) {
                    $('.news_event_pedia .left_row').removeClass('float');
                }
                if ($('.row_4box .right_box_4').hasClass('float')) {
                    $('.row_4box .right_box_4').removeClass('float');
                }
                if ($('.header_section_1 , .header_section_2').hasClass('float')) {
                    $('.header_section_1 , .header_section_2').removeClass('float');
                }
                if ($('.right_row_4box .right_box_4:nth-child(2) .corner-ribbon , .right_row_4box .right_box_4:nth-child(4) .corner-ribbon').hasClass('top-right')) {
                    $('.right_row_4box .right_box_4:nth-child(2) .corner-ribbon  , .right_row_4box .right_box_4:nth-child(4) .corner-ribbon').removeClass('top-right').addClass('top-left');
                }
                if ($('.under_menu_open .under_menu_open_empty')) {
                    $('.under_menu_open .under_menu_open_empty').remove();
                }
                if ($('#both-register-section1').hasClass('float')) {
                    $('#both-register-section1').removeClass('float');
                }
                if ($('#both-register-section2').hasClass('float')) {
                    $('#both-register-section2').removeClass('float');
                }
                if ($('.request_box_right').hasClass('float')) {
                    $('.request_box_right').removeClass('float');
                }
                if ($('.request_box_center').hasClass('float')) {
                    $('.request_box_center').removeClass('float');
                }
                if ($('.request_box_left').hasClass('float')) {
                    $('.request_box_left').removeClass('float');
                }
                if ($('.additional_information_request_right').hasClass('float')) {
                    $('.additional_information_request_right').removeClass('float');
                }
                if ($('.aside-search').hasClass('float')) {
                    $('.aside-search').removeClass('float');
                }
                if ($('.list-search').hasClass('float')) {
                    $('.list-search').removeClass('float');
                }
                if ($('.product_row_1_gallery').hasClass('float')) {
                    $('.product_row_1_gallery ').removeClass('float');
                }
                if ($('.product_row2_description').hasClass('float')) {
                    $('.product_row2_description ').removeClass('float');
                }
                if ($('.product_row3_price_and_btn_group').hasClass('float')) {
                    $('.product_row3_price_and_btn_group ').removeClass('float');
                }
            });
            // remove attr href in responsive
            $(document).ready(function() {
                  $( ".arrow > a" ).removeAttr("href");
            });
        } else {
            // menu closed in inner page re-open with Click
            $(document).ready(function () {
                var path = window.location.pathname;
                if (path == '/ahanmart/public/fa' || path == '/ahanmart/public/en' || path == '/ahanmart/public/ru' || path == '/ahanmart/public/ar') {
                    $("#a_category_menu").click();
                    $("html").addClass("home");
                    $(".has_sub_menu").removeClass('open').addClass("opened");
                } else {
                    $('.menu .has_sub_menu> a').on('click', function () {
                        if ($(".nav_full .menu ul#category_menu ").css('display') == 'none') {
                            $(".nav_full .menu ul#category_menu ").css('display', 'block');
                        } else {
                            //$(".nav_full .menu ul#category_menu ").css('display' , 'none');
                        }
                    });
                    $(document).ready(function () {
                        $('body').on('click', function (e) {
                            if (!(e.target.closest('.has_sub_menu'))) {
                                if ($(".nav_full .menu ul#category_menu").css('display') == 'block') {
                                    $(".nav_full .menu ul#category_menu").css('display', 'none');
                                    // alert('if');
                                } else {
                                    //    $(".nav_full .menu ul#category_menu").css('display' , 'none');
                                    // alert('else');
                                }
                            }
                        });
                    });
                }
            });
            $(document).ready(function () {
                if (!$('.under_menu_open').hasClass('float')) {
                    $('.under_menu_open').addClass('float');
                }
                if (!$('.vertical_tile').hasClass('float')) {
                    $('.vertical_tile').addClass('float');
                }
                if (!$('.right_row_4box').hasClass('float')) {
                    $('.right_row_4box').addClass('float');
                }
                if (!$('.left_row_4box').hasClass('float')) {
                    $('.left_row_4box').addClass('float');
                }
                if (!$('.news_event_pedia .right_row').hasClass('float')) {
                    $('.news_event_pedia .right_row').addClass('float');
                }
                if (!$('.news_event_pedia .left_row').hasClass('float')) {
                    $('.news_event_pedia .left_row').addClass('float');
                }
                if (!$('.row_4box .right_box_4').hasClass('float')) {
                    $('.row_4box .right_box_4').addClass('float');
                }
                if (!$('.header_section_1 , .header_section_2').hasClass('float')) {
                    $('.header_section_1 , .header_section_2').addClass('float');
                }
                if ($('.right_row_4box .right_box_4:nth-child(2) .corner-ribbon , .right_row_4box .right_box_4:nth-child(4) .corner-ribbon').hasClass('top-right')) {
                    $('.right_row_4box .right_box_4:nth-child(2) .corner-ribbon  , .right_row_4box .right_box_4:nth-child(4) .corner-ribbon').removeClass('top-left').addClass('top-right');
                }

                if (!$('#both-register-section1').hasClass('float')) {
                    $('#both-register-section1').addClass('float');
                }
                if (!$('#both-register-section2').hasClass('float')) {
                    $('#both-register-section2').addClass('float');
                }
                if (!$('.request_box_right').hasClass('float')) {
                    $('.request_box_right').addClass('float');
                }
                if (!$('.request_box_center').hasClass('float')) {
                    $('.request_box_center').addClass('float');
                }
                if (!$('.request_box_left').hasClass('float')) {
                    $('.request_box_left').addClass('float');
                }
                if (!$('.additional_information_request_right').hasClass('float')) {
                    $('.additional_information_request_right').addClass('float');
                }
                if (!$('.aside-search').hasClass('float')) {
                    $('.aside-search').addClass('float');
                }
                if (!$('.list-search').hasClass('float')) {
                    $('.list-search').addClass('float');
                }
                if (!$('.product_row_1_gallery').hasClass('float')) {
                    $('.product_row_1_gallery ').addClass('float');
                }
                if (!$('.product_row2_description').hasClass('float')) {
                    $('.product_row2_description ').addClass('float');
                }
                if (!$('.product_row3_price_and_btn_group').hasClass('float')) {
                    $('.product_row3_price_and_btn_group ').addClass('float');
                }
            });

            // replace attr href in menu
            $(document).ready(function() {
                    $( ".arrow > a" ).attr('href', 'javascript:void(0)');
            });

            // limit title product name in product description
            // $(document).ready(function() {
            //     $(".title_product_tooltip a").text(function(index, currentText) {
            //         return currentText.substr(0, 21 ) + '...';
            //     });
            // });
        }
    };
    mediaSize();
    window.addEventListener('resize', mediaSize, true);
})(jQuery);


// Sidebar
$(document).ready(function () {
    'use strict';

    var sidebar = $('#sidebar'),
        sidebarToggleButton = $('#sidebar-toggle'),
        sidebarToggleText = $('#sidebar-toggle span'),
        sidebarToggleButtonIcon = $('#sidebar-toggle .fa'),
        body = $('body');

    // sidebar.css('right', -(sidebar.width() / 2));

    var toggleSidebar = function () {
        sidebar.toggleClass('show animated fadeIn');
    };

    sidebarToggleButton.click(function () {
        toggleSidebar();
        if (sidebar.hasClass('show')) {
            // sidebar.css('display', 'none');
            sidebarToggleButtonIcon.removeClass('fa-navicon').addClass('fa-close').css('transition', 'none');
            sidebarToggleButton.css('right', sidebar.width() + 20).addClass('foldOut');
            body.addClass('background_dark');
        } else {
            // sidebar.css('display', 'block');
            sidebarToggleButtonIcon.removeClass('fa-close').addClass('fa-navicon').css('transition', 'none');
            sidebarToggleButton.addClass('foldIn').css('right', 20);
            body.removeClass('background_dark');
        }
        sidebarToggleButtonIcon.addClass('spin')
        setTimeout(function () {
            sidebarToggleButton.removeClass('foldOut foldIn');
            sidebarToggleButtonIcon.removeClass('spin').css('transition', '.4s');
        }, 600);
    });
});

$(document).ready(function () {
    $('body').on('click', function (e) {
        if (!(e.target.closest('#sidebar'))) {
            if ($("#sidebar").hasClass('show') && !$("#sidebar-toggle").hasClass("foldOut")) {
                // $(".nav_full .menu ul#category_menu").css('display' , 'none');
                $("#sidebar-toggle").click();
                // alert('if');
            } else {
                //    $(".nav_full .menu ul#category_menu").css('display' , 'none');
                // alert('else');
            }
        }
    });
});



// limit excerpt in product description
$(document).ready(function() {
    $("#the_excerpt").text(function(index, currentText) {
        return currentText.substr(0, 500);
    });
});


// auto height description boxes in product page
$(document).ready(function() {
    var height140 = $('.additional_information_production_row_3_40.checkheight140').height();
    var height160 = $('.additional_information_production_row_3_60.checkheight160').height();
    var height1 = $('.additional_information_production_row_3.checkheight1').height();
    var height240 = $('.additional_information_production_row_3_40.checkheight240').height();
    var height260 = $('.additional_information_production_row_3_60.checkheight260').height();
    var height2 = $('.additional_information_production_row_3.checkheight2').height();
        if (height140 < height160) {
                $(".additional_information_production_row_3_40.checkheight140").css('height', height1);
        } else {
                $(".additional_information_production_row_3_60.checkheight160").css('height', "auto");
        }
        if (height240 < height260) {
                $(".additional_information_production_row_3_40.checkheight140").css('height', height2);
        } else {
                $(".additional_information_production_row_3_60.checkheight160").css('height', "auto");
        }
        var heightArticles = $('.news_event_pedia .left_row').height();
        var heightPedia = $('.news_event_pedia .right_row').height();
        if (heightArticles < heightPedia) {
                $(".news_event_pedia .left_row").css('height', '255px');
                $(".news_event_pedia .right_row").css('height', '255px');
        } else {
                $(".news_event_pedia .left_row").css('height', '255px');
                $(".news_event_pedia .right_row").css('height', '255px');
        }
});


// Preloader
(function($){
  'use strict';
    $(window).on('load', function () {
        if ($(".pre_loader").length > 0)
        {
            $(".pre_loader").fadeOut("slow");
        }
    });
})(jQuery)

// add active to header profile
$(document).ready(function(){
  // add active class to submenu level 2
  $(".btn_header").on('click', function(e){
    $("a.btn_header").removeClass("active_tab");
    $(this).toggleClass("active_tab");
  });

});


$(document).ready(function(){
  ///hover container lang menu
  $("#lang-menu").on('click',function(){
      	$(this).addClass("cls-border-lang");
      	$(this).children().eq(0).addClass("cls-borderbottom-lang");
			  $("#lang-menu ul").stop().slideToggle(100);
    },
    function(){
 				$(this).removeClass("cls-border-lang");
      	$(this).children().eq(0).removeClass("cls-borderbottom-lang");
        $("#lang-menu ul").stop().slideToggle(100);
    }
  );
  /// click languages
  $("#lang-menu ul li > a").on("click", function(){
    	//select lang and apply changes
    	$lang = $(this).html();
	    $("#lang-menu div").html($lang);
  });
});

// calculator
  $(document).ready(function(){
    $(".row_calculator button").on('click', function(e){
      $(".row_calculator.result_cal").show();
    });

  });

  // add animation loading in menu when click on a tag
  $(document).ready(function(){
    $(".sub_lvl_1 a:not(.arrow > a)").on('click', function(e){
      $(this).addClass('loading_menu');
    });
  });

  $(document).ready(function(){
    $(".tiles_container a , .title_product_tooltip > a").on('click', function(e){
      var loading = $("<div class='loading'>"+"<i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i>"+"</div>");
      $('body').append(loading).fadeIn(2000);;
      $('body').css('position','relative');
    });
  });

// onload limitedtext
  window.onload = function limitedText() {
    if (window.matchMedia('(max-width: 1000px)').matches) {
        // alert('bye');
        var aTag = ".title_product_tooltip a";
        $(aTag).text(function(index, currentText) {
            return currentText.substr(0, 100 );
        });
      }else {
        // alert('hi');
        var aTag = ".title_product_tooltip a";
        $(aTag).text(function(index, currentText) {
            return currentText.substr(0, 30 ) + '...';
        });
      }
    }

// ajax limited
  function limitedText() {
    var aTag = ".title_product_tooltip a";
    $(aTag).text(function(index, currentText) {
        return currentText.substr(0, 30 ) + '...';
    });
  }

  function openChartModal() {
    var chart = ".price_archives";
    var buttonId = $(chart).attr('id');
    $('#modal-container').removeAttr('class').addClass(buttonId);
    $('body').addClass('modal-active');

  }

  function closeModalArchivePrice() {
      $('#modal-container').addClass('out');
      $('body').removeClass('modal-active');
      $('#modal-container').removeClass('chart_btn');
  }

//end js
