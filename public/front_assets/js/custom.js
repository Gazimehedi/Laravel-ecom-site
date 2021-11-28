/**
  * Template Name: Daily Shop
  * Version: 1.0
  * Template Scripts
  * Author: MarkUps
  * Author URI: http://www.markups.io/

  Custom JS


  1. CARTBOX
  2. TOOLTIP
  3. PRODUCT VIEW SLIDER
  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  9. PRICE SLIDER  (noUiSlider SLIDER)
  10. SCROLL TOP BUTTON
  11. PRELOADER
  12. GRID AND LIST LAYOUT CHANGER
  13. RELATED ITEM SLIDER (SLICK SLIDER)


**/

jQuery(function($) {


    /* ----------------------------------------------------------- */
    /*  1. CARTBOX
    /* ----------------------------------------------------------- */

    jQuery(".aa-cartbox").hover(function() {
        jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
    }, function() {
        jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
    });

    /* ----------------------------------------------------------- */
    /*  2. TOOLTIP
    /* ----------------------------------------------------------- */
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle2="tooltip"]').tooltip();

    /* ----------------------------------------------------------- */
    /*  3. PRODUCT VIEW SLIDER
    /* ----------------------------------------------------------- */

    jQuery('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
        loading_image: 'demo/images/loading.gif'
    });

    jQuery('#demo-1 .simpleLens-big-image').simpleLens({
        loading_image: 'demo/images/loading.gif'
    });

    /* ----------------------------------------------------------- */
    /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
    /* ----------------------------------------------------------- */

    jQuery('.aa-popular-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [{
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
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });


    /* ----------------------------------------------------------- */
    /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
    /* ----------------------------------------------------------- */

    jQuery('.aa-featured-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [{
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
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    /* ----------------------------------------------------------- */
    /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
    /* ----------------------------------------------------------- */
    jQuery('.aa-latest-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [{
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
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    /* ----------------------------------------------------------- */
    /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
    /* ----------------------------------------------------------- */

    jQuery('.aa-testimonial-slider').slick({
        dots: true,
        infinite: true,
        arrows: false,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true
    });

    /* ----------------------------------------------------------- */
    /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
    /* ----------------------------------------------------------- */

    jQuery('.aa-client-brand-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
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
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    /* ----------------------------------------------------------- */
    /*  9. PRICE SLIDER  (noUiSlider SLIDER)
    /* ----------------------------------------------------------- */

    jQuery(function() {
        if ($('body').is('.productPage')) {
            var skipSlider = document.getElementById('skipstep');
            var price_filter_start = jQuery('#price_filter_start').val();
            var price_filter_end = jQuery('#price_filter_end').val();
            if (price_filter_start == '' || price_filter_end == '') {
                var price_filter_start = 20;
                var price_filter_end = 300;
            }
            noUiSlider.create(skipSlider, {
                range: {
                    'min': 0,
                    '10%': 20,
                    '20%': 50,
                    '30%': 80,
                    '40%': 100,
                    '50%': 150,
                    '60%': 200,
                    '70%': 250,
                    '80%': 300,
                    '90%': 350,
                    'max': 400
                },
                snap: true,
                connect: true,
                start: [price_filter_start, price_filter_end]
            });
            // for value print
            var skipValues = [
                document.getElementById('skip-value-lower'),
                document.getElementById('skip-value-upper')
            ];

            skipSlider.noUiSlider.on('update', function(values, handle) {
                skipValues[handle].innerHTML = values[handle];
            });
        }
    });



    /* ----------------------------------------------------------- */
    /*  10. SCROLL TOP BUTTON
    /* ----------------------------------------------------------- */

    //Check to see if the window is top if not then display button

    jQuery(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });

    //Click event to scroll to top

    jQuery('.scrollToTop').click(function() {
        $('html, body').animate({ scrollTop: 0 }, 800);
        return false;
    });

    /* ----------------------------------------------------------- */
    /*  11. PRELOADER
    /* ----------------------------------------------------------- */

    jQuery(window).load(function() { // makes sure the whole site is loaded
        jQuery('#wpf-loader-two').delay(200).fadeOut('slow'); // will fade out
    })

    /* ----------------------------------------------------------- */
    /*  12. GRID AND LIST LAYOUT CHANGER
    /* ----------------------------------------------------------- */

    jQuery("#list-catg").click(function(e) {
        e.preventDefault(e);
        jQuery(".aa-product-catg").addClass("list");
    });
    jQuery("#grid-catg").click(function(e) {
        e.preventDefault(e);
        jQuery(".aa-product-catg").removeClass("list");
    });


    /* ----------------------------------------------------------- */
    /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
    /* ----------------------------------------------------------- */

    jQuery('.aa-related-item-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [{
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
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
});

function image_change(img, color) {
    jQuery('#color_id').val(color);
    jQuery('.simpleLens-big-image-container').html('<a data-lens-image="' + img + '" class="simpleLens-lens-image"><img src="' + img + '" class="simpleLens-big-image"></a>');
}

function size_color(size) {
    jQuery('#size_id').val(size);
    jQuery('.color_hide').hide();
    jQuery('.size_' + size).show();
    jQuery('.size_link').css('border', '1px solid #ddd');
    jQuery('#size_' + size).css('border', '1px solid #000');
}

function add_to_cart(pid, size_srt_id, color_str_id) {
    jQuery('#cart_msg').html('');
    var size_id = jQuery('#size_id').val();
    var color_id = jQuery('#color_id').val();
    if (size_srt_id == 0) {
        size_id = "no";
    }
    if (color_str_id == 0) {
        color_id = "no";
    }
    if (size_id == '' && size_id != 'no') {
        jQuery('#cart_msg').html('<div class="alert alert-danger" role="alert">Please select product size!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    } else if (color_id == '' && color_id != 'no') {
        jQuery('#cart_msg').html('<div class="alert alert-danger" role="alert">Please select product color!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    } else {
        jQuery('#product_id').val(pid);
        jQuery('#pqty').val(jQuery('#qty').val());
        jQuery.ajax({
            url: '/add_to_cart',
            data: jQuery('#frmAddToCart').serialize(),
            type: 'post',
            success: function(result) {
                alert('Product ' + result.msg);
                if (result.totalCart == 0) {
                    jQuery('.aa-cart-notify').html('0');
                    jQuery('.aa-cartbox-summary').remove();
                } else {
                    jQuery('.aa-cart-notify').html(result.totalCart);
                    var totalPrice = 0;
                    var html = '<ul>';
                    jQuery.each(result.data, function(arrKey, arrVal) {
                        totalPrice = parseInt(totalPrice) + parseInt(arrVal.qty) * parseInt(arrVal.price);
                        html += '<li><a class="aa-cartbox-img" href="' + sitePath + '/product/' + arrVal.slug + '"><img src="' + imagePath + '/' + arrVal.image + '" alt="img"></a><div class="aa-cartbox-info"><h4><a href="' + sitePath + '/product/' + arrVal.slug + '">' + arrVal.name + '</a></h4><p>' + arrVal.qty + ' x $ ' + arrVal.price + '</p></div></li>';
                    });
                    html += '<li><span class="aa-cartbox-total-title">Total </span><span class="aa-cartbox-total-price"> $ ' + totalPrice + ' </span></li></ul><a class="aa-cartbox-checkout aa-primary-btn" href="' + sitePath + '/cart">Cart</a>';
                    jQuery('.aa-cartbox-summary').html(html);
                }
            }
        });
    }
}

function home_add_to_cart(pid, size_srt_id, color_str_id) {
    jQuery('#size_id').val(size_srt_id);
    jQuery('#color_id').val(color_str_id);
    add_to_cart(pid, size_srt_id, color_str_id);
}

function updateQty(pid, size, color, attr_id, price) {
    jQuery('#size_id').val(size);
    jQuery('#color_id').val(color);
    var qty = jQuery('#qty' + pid).val();
    jQuery('#qty').val(qty);
    add_to_cart(pid, size, color);
    jQuery('#total_price' + attr_id).html('$ ' + price * qty);
}

function deleteCartProduct(pid, size, color, attr_id) {
    jQuery('#size_id').val(size);
    jQuery('#color_id').val(color);
    jQuery('#qty').val(0);
    add_to_cart(pid, size, color);
    jQuery('#cart_box' + attr_id).hide();
}

function sortBy() {
    var sort_by_value = jQuery('#sort_by_value').val();
    jQuery('#sort_by').val(sort_by_value);
    jQuery('#sort_by_form').submit();
}

function sort_price_filter() {
    jQuery('#price_filter_start').val(jQuery('#skip-value-lower').html());
    jQuery('#price_filter_end').val(jQuery('#skip-value-upper').html());
    jQuery('#sort_by_form').submit();
}

function set_color(color, type) {
    var color_str = jQuery('#color_filter').val();
    if (type == 1) {
        var new_color_str = color_str.replace(color + ':', '');
        jQuery('#color_filter').val(new_color_str);
    } else {
        jQuery('#color_filter').val(color + ':' + color_str);
    }
    jQuery('#sort_by_form').submit();
}

function fun_search() {
    var search_str = jQuery('#str').val();
    if (search_str != '' && search_str.length > 2) {
        window.location.href = '/search/' + search_str;
    }
}

jQuery('#frmRegistration').submit(function(e) {
    e.preventDefault();
    jQuery('#reg_loading').show();
    jQuery.ajax({
        url: 'registration_proccess',
        data: jQuery('#frmRegistration').serialize(),
        type: 'post',
        success: function(result) {
            jQuery('.error_msg').html('');
            if (result.status == 'error') {
                jQuery.each(result.error, function(key, val) {
                    jQuery('#' + key + '_error').html(val[0]);
                });
            }
            if (result.status == 'success') {
                jQuery('#frmRegistration')[0].reset();
                jQuery('#registration_success').html('<br><div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + result.msg + '</div>');
                jQuery('#reg_loading').hide();
            }
        }
    });
});

jQuery('#loginFrm').submit(function(e) {
    e.preventDefault();
    jQuery.ajax({
        url: '/login_proccess',
        data: jQuery('#loginFrm').serialize(),
        type: 'post',
        success: function(result) {
            jQuery('.error_msg').html('');
            if (result.status == 'error') {
                jQuery('#login_error').html(result.msg);
            }
            if (result.status == 'success') {
                jQuery('#login_error').removeClass('error_msg');
                jQuery('#login_error').addClass('success_msg');
                jQuery('#login_error').html(result.msg);
                window.location.href = window.location.href;
            }
        }
    });
});

function show_forgot_popup() {
    jQuery('#forgot_popup').show();
    jQuery('#login_popup').hide();
}

function show_login_popup() {
    jQuery('#forgot_popup').hide();
    jQuery('#login_popup').show();
}
jQuery('#forgotFrm').submit(function(e) {
    e.preventDefault();
    jQuery('#forgot_error').html('Please wait...');
    jQuery.ajax({
        url: '/forgot_proccess',
        data: jQuery('#forgotFrm').serialize(),
        type: 'post',
        success: function(result) {
            jQuery('#forgot_error').html('');
            if (result.status == 'error') {
                jQuery('#forgot_error').html(result.msg);
                jQuery('#forgot_error').addClass('error_msg');
                jQuery('#forgot_error').removeClass('success_msg');
            }
            if (result.status == 'success') {
                jQuery('#forgot_error').removeClass('error_msg');
                jQuery('#forgot_error').addClass('success_msg');
                jQuery('#forgot_error').html(result.msg);
                jQuery('#forgotFrm')[0].reset();
            }
        }
    });
});

jQuery('#frmReset').submit(function(e) {
    e.preventDefault();
    jQuery('#reset_loading').show();
    jQuery.ajax({
        url: '/reset_password_proccess',
        data: jQuery('#frmReset').serialize(),
        type: 'post',
        success: function(result) {
            jQuery('.error_msg').html('');
            if (result.status == 'error') {
                jQuery('#password_error').html(result.msg);
            }
            if (result.status == 'success') {
                jQuery('#frmReset')[0].reset();
                jQuery('#reset_success').html('<br><div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + result.msg + '</div>');
                jQuery('#reset_loading').hide();
            }
        }
    });
});


function applyCouponCode() {
    jQuery('#coupon_msg').html('');
    var coupon_code = jQuery('#coupon_code').val();
    if (coupon_code != "") {
        jQuery.ajax({
            url: '/apply_coupon_code',
            data: 'coupon_code=' + coupon_code + '&_token=' + jQuery("[name='_token']").val(),
            type: 'post',
            success: function(result) {
                if (result.status == 'success') {
                    jQuery('#coupon_msg').html(result.msg);
                    jQuery('.show_code').removeClass('hide');
                    jQuery('#coupon_code_str').html(coupon_code);
                    jQuery('#totalPrice').html('$ ' + result.totalprice);
                    jQuery('.coupon_input').hide();
                } else {
                    jQuery('#coupon_msg').html(result.msg);
                }
            }
        });
    } else {
        jQuery('#coupon_msg').html('Please enter coupon code');
    }
}

function removeCouponCode() {
    jQuery('#coupon_msg').html('');
    var coupon_code = jQuery('#coupon_code').val();
    jQuery('#coupon_code').val('');
    if (coupon_code != "") {
        jQuery.ajax({
            url: '/remove_coupon_code',
            data: 'coupon_code=' + coupon_code + '&_token=' + jQuery("[name='_token']").val(),
            type: 'post',
            success: function(result) {
                if (result.status == 'success') {
                    jQuery('#coupon_msg').html(result.msg);
                    jQuery('.show_code').addClass('hide');
                    jQuery('#coupon_code_str').html('');
                    jQuery('#totalPrice').html('$ ' + result.totalprice);
                    jQuery('.coupon_input').show();
                } else {
                    jQuery('#coupon_msg').html(result.msg);
                }
            }
        });
    } else {
        jQuery('#coupon_msg').html('Please enter coupon code');
    }
}

jQuery('#frmCheckout').submit(function(e) {
    e.preventDefault();
    jQuery('#orderPlaceError').html('');
    jQuery('#reg_loading').show();
    jQuery.ajax({
        url: '/place_order',
        data: jQuery('#frmCheckout').serialize(),
        type: 'post',
        success: function(result) {
            if (result.status == 'success') {
                window.location.href = result.payment_url;
            } else {
                jQuery('#reg_loading').hide();
                jQuery('#orderPlaceError').html(result.msg);
                jQuery('#orderPlaceError').addClass('error');
            }
        }
    });
});

function rating_oparetion(rating) {
    if (rating == 1) {
        jQuery('#rating1').removeClass('fa-star-o');
        jQuery('#rating1').addClass('fa-star');
        jQuery('#rating2').addClass('fa-star-o');
        jQuery('#rating3').addClass('fa-star-o');
        jQuery('#rating4').addClass('fa-star-o');
        jQuery('#rating5').addClass('fa-star-o');
        jQuery('#rating2').removeClass('fa-star');
        jQuery('#rating3').removeClass('fa-star');
        jQuery('#rating4').removeClass('fa-star');
        jQuery('#rating5').removeClass('fa-star');
        jQuery('#rating').val(rating);
    }
    if (rating == 2) {
        jQuery('#rating1').removeClass('fa-star-o');
        jQuery('#rating2').removeClass('fa-star-o');
        jQuery('#rating1').addClass('fa-star');
        jQuery('#rating2').addClass('fa-star');
        jQuery('#rating3').addClass('fa-star-o');
        jQuery('#rating4').addClass('fa-star-o');
        jQuery('#rating5').addClass('fa-star-o');
        jQuery('#rating3').removeClass('fa-star');
        jQuery('#rating4').removeClass('fa-star');
        jQuery('#rating5').removeClass('fa-star');
        jQuery('#rating').val(rating);
    }
    if (rating == 3) {
        jQuery('#rating1').removeClass('fa-star-o');
        jQuery('#rating2').removeClass('fa-star-o');
        jQuery('#rating3').removeClass('fa-star-o');
        jQuery('#rating1').addClass('fa-star');
        jQuery('#rating2').addClass('fa-star');
        jQuery('#rating3').addClass('fa-star');
        jQuery('#rating4').addClass('fa-star-o');
        jQuery('#rating5').addClass('fa-star-o');
        jQuery('#rating4').removeClass('fa-star');
        jQuery('#rating5').removeClass('fa-star');
        jQuery('#rating').val(rating);
    }
    if (rating == 4) {
        jQuery('#rating1').removeClass('fa-star-o');
        jQuery('#rating2').removeClass('fa-star-o');
        jQuery('#rating3').removeClass('fa-star-o');
        jQuery('#rating4').removeClass('fa-star-o');
        jQuery('#rating1').addClass('fa-star');
        jQuery('#rating2').addClass('fa-star');
        jQuery('#rating3').addClass('fa-star');
        jQuery('#rating4').addClass('fa-star');
        jQuery('#rating5').addClass('fa-star-o');
        jQuery('#rating5').removeClass('fa-star');
        jQuery('#rating').val(rating);
    }
    if (rating == 5) {
        jQuery('#rating1').removeClass('fa-star-o');
        jQuery('#rating2').removeClass('fa-star-o');
        jQuery('#rating3').removeClass('fa-star-o');
        jQuery('#rating4').removeClass('fa-star-o');
        jQuery('#rating5').removeClass('fa-star-o');
        jQuery('#rating1').addClass('fa-star');
        jQuery('#rating2').addClass('fa-star');
        jQuery('#rating3').addClass('fa-star');
        jQuery('#rating4').addClass('fa-star');
        jQuery('#rating5').addClass('fa-star');
        jQuery('#rating').val(rating);
    }

}

jQuery('#reviewFrm').submit(function(e) {
    e.preventDefault();
    //   jQuery('#orderPlaceError').html('');
    //   jQuery('#reg_loading').show();
    jQuery.ajax({
        url: '/product_review_proccess',
        data: jQuery('#reviewFrm').serialize(),
        type: 'post',
        success: function(result) {
            console.log(result.status)
            if (result.status == 'success') {
                jQuery('#review_error').html(result.msg);
                jQuery('#review_error').addClass('success');
                setInterval(() => {
                    window.location.href = window.location.href
                }, 3000);
            } else {
                jQuery('#review_error').html(result.msg);
                jQuery('#review_error').addClass('error');
            }
        }
    });
});