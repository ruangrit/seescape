jQuery(document).ready(function($) {
  'use strict';
  var b = $('.fixed-footer').outerHeight();
  $('.wrapper').css('margin-bottom', b + 'px'),
    $(window).width() <= 767 &&
      $('footer').hasClass('fixed-footer') &&
      ($('footer').removeClass('fixed-footer'),
      $('.wrapper').css('margin-bottom', '0'));
  var c = $('header.fixed').outerHeight();
  $('body').css('padding-top', c + 'px'),
    $(window).on('scroll', function() {
      $(this).scrollTop() > 50
        ? $('header.fixed').addClass('no-margin')
        : $('header.fixed').removeClass('no-margin');
    }),
    $('header ul li.menu-item-has-children > a').append(
      '<span class="drop-down-icon"><i class="fa fa-angle-down"></i></span>'
    ),
    $(window).width() <= 991 &&
      ($('.default-header').hasClass('second-header') &&
        $('.default-header').removeClass('second-header'),
      $('.default-header').hasClass('third-header') &&
        $('.default-header').removeClass('third-header')),
    $('.third-header .menu-item-has-children > a').on('click', function(b) {
      b.preventDefault();
      var c = $(this).next('.sub-menu');
      c
        .slideToggle()
        .find('.sub-menu')
        .slideUp(),
        c.find('li').removeClass('sub-menu-open'),
        $(this)
          .parent()
          .toggleClass('sub-menu-open')
          .siblings()
          .removeClass('sub-menu-open')
          .find('.sub-menu')
          .slideUp();
    }),
    $(window).width() <= 991 &&
      $('.default-header ul li.menu-item-has-children > a').on(
        'click',
        function(b) {
          b.preventDefault(),
            $(this)
              .parent()
              .toggleClass('sub-menu-open')
              .siblings()
              .find('.sub-menu')
              .slideUp(),
            $(this)
              .next('.sub-menu')
              .slideToggle()
              .find('.sub-menu')
              .slideUp(),
            $(this)
              .next('.sub-menu')
              .find('li')
              .removeClass('sub-menu-open'),
            $(this)
              .parent()
              .siblings()
              .removeClass('sub-menu-open');
        }
      ),
    $('.hamburger > a').on('click', function(b) {
      if (
        (b.preventDefault(),
        $('header .hamburger').toggleClass('is-active'),
        $(window).width() <= 991)
      ) {
        var c = $('header nav');
        c.is(':visible')
          ? (c
              .slideUp()
              .find('.sub-menu')
              .slideUp(),
            c.find('.sub-menu-open').removeClass('sub-menu-open'))
          : c.slideDown();
      } else {
        if ($('header .third-header .hamburger').hasClass('is-active'))
          $('header .third-header .logo img').hasClass('logo-white') &&
            $('header .third-header .logo').addClass('white-logo'),
            $('header .third-header .logo').addClass('white-color'),
            $('header .third-header #cartcontents').addClass('white-color'),
            $('body, html').bind('mousewheel', function() {
              return !1;
            }),
            $('header .third-header .menu-holder').fadeIn('slow'),
            setTimeout(function() {
              $('header .third-header .menu-holder').addClass('menu-visible');
            }, 400);
        else {
          var d = $('header .third-header .menu-holder');
          d
            .fadeOut('slow')
            .find('.sub-menu')
            .slideUp(),
            d.find('li').removeClass('sub-menu-open'),
            $('body, html').unbind('mousewheel'),
            $('header .third-header .menu-holder').removeClass('menu-visible'),
            $('header .third-header .logo').removeClass('white-color'),
            $('header .third-header .logo').removeClass('white-logo'),
            $('header .third-header #cartcontents').removeClass('white-color');
        }
        $('header .second-header .hamburger').hasClass('is-active')
          ? ($('header .second-header nav').addClass('menu-visible'),
            $('header .second-header').addClass('cart-visible'))
          : ($('header .second-header nav').removeClass('menu-visible'),
            $('header .second-header').removeClass('cart-visible'));
      }
    }),
    $('html').click(function() {
      $('#cartcontents .widget_shopping_cart_content').removeClass(
        'showcartcontents'
      );
    }),
    $('#cartcontents').click(function(a) {
      a.stopPropagation();
    }),
    $('#minicart').click(function(b) {
      $('#cartcontents .widget_shopping_cart_content').toggleClass(
        'showcartcontents'
      );
    }),
    $('.active-gallery').magnificPopup({
      gallery: {
        enabled: !0
      },
      image: {
        titleSrc: 'title'
      },
      delegate: '.selector .item a',
      type: 'image'
    }),
    $('.project-single').magnificPopup({
      gallery: {
        enabled: !0
      },
      image: {
        titleSrc: 'title'
      },
      delegate: '.project-single-gallery a',
      type: 'image'
    }),
    document.addEventListener('touchstart', function() {}, !0);

  // Pagination show more
  $(window).load(function() {
    function parallaxFooterHeight() {
      if ($(window).width() >= 992) {
        var footerHeight = $('.parallax-footer').outerHeight();
        $('.wrapper').css('margin-bottom', footerHeight);
      }
    }
    $(window).on('resize', parallaxFooterHeight);
    // Footer
    parallaxFooterHeight();

    // Page Loading
    $('.page-loading').addClass('loaded');

    var $masonry = $('.masonry');
    var $loadMoreButton = $('#load-more-posts');
    var loadMorePosts = $loadMoreButton.text();

    $('#filters li').on('click', function() {
      var filterValue = $(this).attr('data-filter');

      $masonry.isotope({
        filter: filterValue
      });

      $loadMoreButton.data('filter', filterValue.replace('.', ''));

      if ($(this).data('all') === true) {
        $loadMoreButton.parent().hide();
      } else {
        $loadMoreButton
          .html(loadMorePosts)
          .prop('disabled', false)
          .parent()
          .show();
      }

      $(this)
        .addClass('active')
        .siblings('li')
        .removeClass('active');
    });

    if ($masonry.length) {
      $masonry = $('.portfolio .masonry');

      $masonry.isotope({
        layoutMode: 'packery',
        itemSelector: '.portfolio .selector'
      });

      function loadMore($button) {
        var data = {};
        data.exclude = [];

        if ($button.data('nofilters') !== false) {
          var filter = $button.data('filter');
          if (filter && filter !== '*') {
            data.filter = filter;
          }

          var filteredItems = $masonry.isotope('getFilteredItemElements');
          if (filteredItems) {
            data.exclude = filteredItems.map(function(item) {
              return item.dataset.id;
            });
          }
        } else {
          $masonry.children('.portfolio .selector').each(function() {
            data.exclude.push($(this).data('id'));
          });
        }

        jQuery.ajax({
          type: 'GET',
          url: window.location.href,
          data: data,
          beforeSend: function() {
            $button.html('Loading...').prop('disabled', true);
          },
          success: function(data) {
            var $data = jQuery(data).find('.portfolio .selector');
            var $hasMore = jQuery(data).find('#load-more-posts').length;

            if ($data.length > 0) {
              $button.html(loadMorePosts).prop('disabled', false);

              $masonry.append($data);

              $data.imagesLoaded(function() {
                $masonry.isotope('appended', $data);
              });
            }

            if (!$hasMore) {
              $button.parent().hide();

              var filterClass = filter ? '.' + filter : '*';

              if (filterClass == '*') {
                $button
                  .parents('.portfolio')
                  .find('li')
                  .attr('data-all', true);
              } else {
                $button
                  .parents('.portfolio')
                  .find('li[data-filter="' + filterClass + '"]')
                  .attr('data-all', true);
              }
            }
          },
          error: function() {
            $button.html('No More Posts');
          }
        });
      }

      $loadMoreButton.on('click', function(e) {
        e.preventDefault();

        loadMore($(this));
      });
    }
  });
});
