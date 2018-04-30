/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function ($) {

    // Use this variable to set up the common and page specific functions. If you
    // rename this variable, you will also need to rename the namespace below.
    var Sage = {
        // All pages
        validate: function(form, response, success) {
            if (Object.keys(response.errors).length) {
                for (var key in response.errors) {
                    form.find('[name=' + key + ']')
                        .parent()
                        .addClass('form-controls--error')
                        .append('<span class="error">' + response.errors[key] + '</span>');
                }
            } else {
                form.find('.clear-after-submit').val('');
                success && typeof success == 'function' && success();
            }

            form.find('[disabled]').prop('disabled', false);
        },
        'common': {
            init: function () {
                // JavaScript to be fired on all pages
            },
            finalize: function () {

                $('#loginform').submit(function (e) {
                    e.preventDefault();

                    var _self = $(this),
                        $error = _self.find('.error');

                    _self.find('[type=submit]').prop('disabled', true);

                    $.post(settings.ajax_url, $(this).serialize(), function (resp) {
                        _self.find('[type=submit]').prop('disabled', false);

                        if (!resp.loggedin) {
                            $error.text(resp.error).show().parent().addClass('form-controls--error');
                        } else {
                            window.location.href = resp.redirect
                        }
                    }, 'json');
                    return false;
                });

                $('#upload').click(function (e) {
                    e.preventDefault();
                    $('#upload-input').trigger('click');
                });

                $('.main-checkbox').click(function () {
                    if ($('.main-checkbox').prop('checked') == true) {
                        console.log($('.main-checkbox').prop('checked'));
                        console.log('main is checked');
                        $('.uk-checkbox').each(function (i, el) {
                            console.log(el);
                            $(el).prop('checked', true);
                        });

                    } else {
                        $('.uk-checkbox').prop('checked', false);
                    }
                });
                $('.zoom-gallery').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    closeOnContentClick: false,
                    closeBtnInside: false,
                    mainClass: 'mfp-with-zoom mfp-img-mobile',
                    image: {
                        verticalFit: true,
                        titleSrc: function (item) {
                            return item.el.attr('title') + ' &middot; <a class="image-source-link" href="' + item.el.attr('data-source') + '" target="_blank">image source</a>';
                        }
                    },
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300, // don't foget to change the duration also in CSS
                        opener: function (element) {
                            return element.find('img');
                        }
                    }

                });

                $('.popup-with-zoom-anim').magnificPopup({
                    type: 'inline',

                    fixedContentPos: false,
                    fixedBgPos: true,

                    overflowY: 'auto',

                    closeBtnInside: true,
                    preloader: false,

                    midClick: true,
                    removalDelay: 300,
                    mainClass: 'my-mfp-zoom-in'
                });

                $('.popup-with-form').magnificPopup({
                    type: 'inline',
                    preloader: false
                });

                $('.login-popup').magnificPopup({
                    type: 'inline',
                    preloader: false,
                    mainClass: 'login-popup'
                });

                $('.social-btn-group .face-btn').click(function (e) {
                    e.preventDefault();

                    var _self = $(this);

                    FB.login(function(response) {
                        if (response.authResponse) {

                            FB.api('/me', function(response) {

                                var photo = 'url(https://graph.facebook.com/'+response.id+'/picture?width=100&height=100)',
                                    $popup = $('.fb-login-popup');

                                $popup.find('.name').text(response.name);
                                $popup.find('.img').css('background-image', photo);
                                $popup.find('.but').attr('href', _self.attr('href'));

                                $.magnificPopup.open({
                                    type: 'inline',
                                    items: {
                                        src: '#facebook-validate'
                                    }
                                });
                            });
                        }
                    });

                });

                $('.fb-login-popup .cancel').click(function (e) {
                    e.preventDefault();
                    FB.logout(function() {
                        $.magnificPopup.open(
                            {
                                type: 'inline',
                                items: {
                                    src: '#login-form'
                                }
                            }
                        );
                    });
                });

                $('body').on('click', '.action-save, .action-favorite', function (e) {
                    e.preventDefault();

                    var _self = $(this),
                        action = $(this).hasClass('action-save') ? 'save' : 'favorite';

                    if (_self.hasClass('disabled'))
                        return;

                    //_self.addClass('disabled');

                    $.post(settings.ajax_url, {
                        id: $(this).data('id'),
                        action: 'save_article',
                        type: action
                    }, function () {
                        _self.addClass('saved');
                    });
                });

                $('.edit-save-posts').click(function (e) {
                    e.preventDefault();


                });

                $('.dropbtn-2').click(function (e) {
                    $('.all-tags-content').show();
                });
                $('.save-close').click(function (e) {
                    e.preventDefault();

                    var html = '',
                        $drop = $('.dropdown-content');

                    $drop.find('.uk-checkbox:checked').each(function () {
                        html += '<div class="item" data-id="' + $(this).val() + '">' +
                            '<input type="checkbox" style="display: none;" checked name="tags[]" value="' + $(this).val() + '">' +
                            '<span class="tag remove-user-tag">#' + $(this).siblings().text() + ' <i class="zmdi zmdi-close"></i></span>' +
                            '</div>';
                    });

                    $('.tags-list .item').remove();
                    $('.tags-list .uk-form-margin').prepend(html);

                    $drop.css({'display': 'none'})

                });

                $('.follow .close-dropdown').click(function (e) {
                    e.preventDefault();

                    var $form = $('.follow');
                    $.post(settings.ajax_url, $form.serialize(), function () {
                        $form[0].reset();
                    });

                    $(this).closest('.dropdown-content').hide();
                });

                $('.subscribe-btn').click(function (e) {
                    e.preventDefault();

                    var $email = $("#follow"),
                        email = $email.val(),
                        $popup = $('.dropdown-subscribe-content');

                    if (!isValidEmailAddress(email)) {
                        $popup.hide();
                        $email.parent().addClass('form-controls--error');
                        $email.siblings('span.error').show();

                        return false;
                    }

                    $popup.show();
                    $email.parent().removeClass('form-controls--error');
                    $email.siblings('span.error').hide();
                });

                function isValidEmailAddress(emailAddress) {
                    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
                    return pattern.test(emailAddress);
                }

                $('.social-cancel').click(function () {
                    $('.facebook-done-block').css({"display": "none"})
                });

                $('.social-relogin').click(function (e) {
                    e.preventDefault();

                    alert();
                });

                $('.stage-block').slick({
                    dots: false,
                    swipe: false,
                    arrows: false,
                    infinite: false,
                    speed: 500,
                    fade: true,
                    cssEase: 'linear'
                });

                $('.back-but, #goToMain').click(function () {
                    window.location.href = settings.homeurl;
                });

                $('.edit-profile-section').find('.expert-introduce').find('img').click(function () {
                    $('.effect').css({"visibility": "visible"});
                    $('.photo-change').css({"visibility": "visible"})
                });

                $('.edit-articles-but').click(function () {
                    $(this).css({"display": "none"})
                    $('.edit-secondary-but').css({"display": "block"});

                    var $articles = $('.article-block');

                    if (!$articles.find('.uk-checkbox').length) {
                        $articles.each(function (i) {
                            $(this).prepend('<div class="article-check"> <input id="article-' + i + '" class="uk-checkbox" type="checkbox"> <label for="article-' + i + '"></label></div>')
                        });
                    } else {
                        $articles.find('.article-check').show();
                    }

                });

                $('body').on('click', '.remove-user-tag', function (e) {
                    e.preventDefault();

                    var $tag = $(this).parent(),
                        $all_tags = $('.all-checkbox');

                    if ($all_tags.length) {
                        $all_tags.find('.uk-checkbox[value="' + $tag.data('id') + '"]').prop('checked', false);
                    }

                    $.post(settings.ajax_url, {action: 'remove_user_tag', tag: $tag.data('id')});
                    $tag.remove();
                });


                $('a.check-all').click(function (e) {
                    e.preventDefault();

                    var $checkInput = $('#checkAll');

                    $(this).toggleClass('active');
                    $checkInput.prop('checked', $(this).hasClass('active'));

                    if ($checkInput.prop('checked')) {
                        var $articles = $('.article-block');

                        $articles.find('.uk-checkbox').each(function (i, el) {
                            $(el).prop('checked', true)
                        });
                    } else {
                        var cb = $('.profile-articles').find('.uk-checkbox');
                        cb.each(function (i, el) {
                            $(el).prop('checked', false)
                        });
                    }
                });

                $('.remove-articles').click(function () {
                    var chbox = $('.article-check').find('.uk-checkbox:checked'),
                        ids = [],
                        type = $('body').hasClass('is-page-saved-articles') ? 'save' : 'favorite';

                    chbox.each(function () {
                        ids.push($(this).closest('.article-block').data('id'));

                        $(this).closest('.article-block').fadeOut(function () {
                            $(this).remove();
                        });

                    });

                    $('.article-check').hide();
                    $('.edit-secondary-but').css({"display": "none"});
                    $('.edit-articles-but').css({"display": "block"});

                    $.post(settings.ajax_url, {action: 'remove_article', type: type, ids: ids});

                });

                $('.panel-collapse [data-toggle]').click(function (e) {
                    e.preventDefault();

                    $(this).closest('.panel-collapse').slideToggle();
                });

                $('.open-video').magnificPopup({
                    type: 'iframe',
                    iframe: {
                        patterns: {
                            youtube: {
                                index: 'youtube.com/',
                                id: function (url) {
                                    var m = url.match(/[\\?\\&]v=([^\\?\\&]+)/);
                                    if (!m || !m[1]) return null;
                                    return m[1];
                                },
                                src: '//www.youtube.com/embed/%id%?autoplay=1'
                            },
                            vimeo: {
                                index: 'vimeo.com/',
                                id: function (url) {
                                    var m = url.match(/(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/);
                                    if (!m || !m[5]) return null;
                                    return m[5];
                                },
                                src: '//player.vimeo.com/video/%id%?autoplay=1'
                            }
                        }
                    }
                });
            }
        },
        'is_page_settings': {
            finalize: function () {
                $('.settings-menu').find('ul').find('li').click(function () {
                    var id = $(this).attr('id');
                    $(this).parent().find('.orange').removeClass('orange');
                    $(this).addClass('orange');

                    $('.settings-params').find('.mainDiv').each(function (i, el) {
                        if ($(el).hasClass(id)) {
                            $(el).css({"display": "block"})
                        } else {
                            $(el).css({"display": "none"})
                        }
                    });
                });

                $('.form__user-settings').submit(function () {

                    var _self = $(this);

                    _self.find('input').parent().removeClass('form-controls--error').find('span.error').remove();
                    _self.find('.black-but').prop('disabled', true);

                    if ($(this)[0].checkValidity()) {
                        $.post(settings.ajax_url, {
                            action: 'save_user_settings',
                            form: $(this).serialize()
                        }, function (response) {

                            Sage.validate(_self, response);

                        }, 'json');
                    }

                    return false;
                });

                $('.email-send').on('click', '.remove-tag', function (e) {
                    e.preventDefault();

                    var $tag = $(this).parent(),
                        $all_tags = $('.all-checkbox');

                    if ($all_tags.length) {
                        $all_tags.find('.uk-checkbox[value="' + $tag.data('id') + '"]').prop('checked', false);
                    }

                    $.post(settings.ajax_url, {action: 'remove_subscribe_tag', tag: $tag.data('id')});
                    $tag.remove();
                });
            }
        },
        'is_page_edit': {
            finalize: function () {

                $(".author-img--change").click(function (e) {
                    e.preventDefault();

                    $('#avatar').trigger('click');
                });

                $('#avatar').on('change', function (event) {
                    files = event.target.files;
                    event.stopPropagation(); // Stop stuff happening
                    event.preventDefault(); // Totally stop stuff happening

                    var data = new FormData();
                    data.append('wpua-file', files[0]);
                    data.append('submit', 1);
                    data.append('wp-user-avatar', '');
                    data.append('action', 'upload_avatar');

                    $.ajax({
                        url: settings.ajax_url,
                        type: 'POST',
                        data: data,
                        cache: false,
                        dataType: 'json',
                        processData: false, // Don't process the files
                        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                        success: function (data, textStatus, jqXHR) {
                            if (typeof data.error === 'undefined') {
                                //Success so call function to process the form
                                //submitForm(event, data);
                                $(".author-img--change img").attr('src', data.src);
                            }
                        }
                    });
                });
            }
        },
        'is_page_donate': {
            finalize: function () {
                $('.donate-UAH').click(function () {
                    $(this).parent().find('.active').removeClass('active');
                    $(this).addClass('active');

                    var val = parseInt($(this).find('.value').text());

                    $.post(settings.ajax_url, {action: 'liqpay', value: val}, function (resp) {
                        $('#liqpay-data').val(resp.data);
                        $('#liqpay-sign').val(resp.sign);
                        $('button[disabled]').prop('disabled', false);
                    }, 'json');
                });
            }
        },
        'is_page_register': {
            finalize: function () {
                $('#register-form').submit(function () {

                    var _self = $(this);

                    _self.find('input').parent().removeClass('form-controls--error').find('span.error').remove();
                    _self.find('button').prop('disabled', true);

                    if ($(this)[0].checkValidity()) {
                        $.post(settings.ajax_url, {action: 'register', form: $(this).serialize()}, function (response) {

                            Sage.validate(_self, response, typeof response.data.location != 'undefined' ? function(){window.location.href = response.data.location} : false);

                        }, 'json');
                    }

                    return false;
                });
            }
        },
        // About us page, note the change from about-us to about_us.
        'single': {
            finalize: function () {
                $('.article-text a > img').click(function () {
                    $(this).parent().magnificPopup({
                        type: 'image',
                        closeOnContentClick: true,
                        mainClass: 'mfp-img-mobile',
                        image: {
                            verticalFit: true
                        }

                    });
                });
            }
        },
        // About us page, note the change from about-us to about_us.
        'is_page_register_2': {
            finalize: function () {
                $('.re-send-register-link').click(function (e) {
                    e.preventDefault();

                    $.post(settings.ajax_url, {action: 'resend_reg_link'});
                });
            }
        }
    };

    // The routing fires all common scripts, followed by the page specific scripts.
    // Add additional events for more control over timing e.g. a finalize event
    var UTIL = {
        fire: function (func, funcname, args) {
            var fire;
            var namespace = Sage;
            funcname = (funcname === undefined) ? 'init' : funcname;
            fire = func !== '';
            fire = fire && namespace[func];
            fire = fire && typeof namespace[func][funcname] === 'function';

            if (fire) {
                namespace[func][funcname](args);
            }
        },
        loadEvents: function () {
            // Fire common init JS
            UTIL.fire('common');

            // Fire page-specific init JS, and then finalize JS
            $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
                UTIL.fire(classnm);
                UTIL.fire(classnm, 'finalize');
            });

            // Fire common finalize JS
            UTIL.fire('common', 'finalize');
        }
    };

    // Load Events
    $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
