/**
 * Main JS Template file
 * @since 1.0
 * @author Amelia
 */

jQuery(document).ready(function ($) {
  /**
   * Enables desktop menu navigation/animation
   * @since 1.0
   * @author Amelia
   */
  function dropDownMenuDesktop() {
    var $hasChildrenAnchore = $(
      ".nav-desktop .menu > li.menu-item-has-children > a"
    );
    var $hasChildren = $(".nav-desktop .menu > li.menu-item-has-children");
    var $subMenu = $(".nav-desktop .menu li .sub-menu");

    $hasChildrenAnchore.on("click", function (e) {
      e.preventDefault();
    });

    $hasChildrenAnchore.mouseenter(function () {
      $(this).parent().siblings().find(".sub-menu").stop().slideUp(300);
      $(this)
        .parent()
        .find(".sub-menu")
        .stop()
        .delay(200)
        .stop()
        .slideDown(500);
    });

    $hasChildren.mouseleave(function () {
      $(this).find(".sub-menu").stop().slideUp(200);
    });
  }

  dropDownMenuDesktop();

  /**
   * Toggles the main mobile menu hamburger
   * @since 1.0
   * @author Amelia
   */
  function toggleMobileMenu() {
    var $hamburger = $(".header-mobile .hamburger");
    var $menu = $(".nav-mobile");

    $hamburger.on("click", function () {
      $(this).toggleClass("is-active");
      $menu.toggleClass("show-menu");
    });
  }

  toggleMobileMenu();

  /**
   * Enables mobile menu navigation/animation
   * @since 1.0
   * @author Amelia
   */
  function dropDownMenuMobile() {
    var $hasChildrenAnchore = $(
      ".header-mobile .menu > li.menu-item-has-children > a"
    );
    var $hasChildren = $(".header-mobile .menu > li.menu-item-has-children");
    var $subMenu = $(".header-mobile .menu li .sub-menu");

    $hasChildrenAnchore.on("click", function (e) {
      e.preventDefault();
      $(this).parent().siblings().find("a").removeClass("active");
      $(this).toggleClass("active");
      $(this).parent().siblings().find(".sub-menu").slideUp(300);
      $(this).parent().find(".sub-menu").slideToggle(300);
    });
  }

  dropDownMenuMobile();

  /**
   * Injects SVG files
   *
   * Calls SVGInjector on every SVG file with a specific class('inject-me'),
   * extracts the svg tree from the file and injects it into the DOM.
   * This enables direct svg tree modification (eg. changing icon colors)
   * @since 1.0
   * @author Amelia
   */
  function SVGinject() {
    var mySVGsToInject = $("img.inject-me");
    SVGInjector(mySVGsToInject);
  }

  SVGinject();

  /**
   * Shows a hidden phone number
   *
   * Since hidden phone numbers are actually two <a> tag siblings, this function
   * hides the clicked hidden-no one, and reveals the sibling with the full number
   * @since 1.0
   * @author Amelia
   */
  function showPhoneNo() {
    var $hiddenNo = $(".hidden-no");

    $hiddenNo.on("click", function (e) {
      e.preventDefault();

      $(this).removeClass(
        "d-sm-flex d-sm-block d-sm-inline d-sm-inline-block d-sm-inline-flexbox"
      );
      $(this).siblings(".visible-no").removeClass("d-sm-none");
    });
  }

  showPhoneNo();

  /**
   * Prevents clicking on active term in terms lists
   */
  $(".terms-list li.active a").on("click", function (e) {
    e.preventDefault();
  });

  /**
   * Shows a popup when a popup-opening control is clicked
   * @since 1.0
   * @author Amelia
   */
  function showPopUp() {
    var $open = $("[show-popup]");

    $open.on("click", function (e) {
      e.preventDefault();
      id = $(this).attr("show-popup");
      $(id).addClass("show-popup");
      $("body").addClass("noscroll");
      $(id).find(".popup__box").focus();
    });
  }

  showPopUp();

  /**
   * Shows a popup after a specified time delay
   * @since 1.0
   * @author Amelia
   */
  function showPopAfterSomeTime() {
    var $popup = $(".popup[show-after]");
    var delay = $popup.attr("show-after");

    setTimeout(function () {
      $popup.addClass("show-popup");
    }, delay);
  }

  showPopAfterSomeTime();

  /**
   * Shows a popup after a specified scroll percentage has been reached by the user
   * @since 1.0
   * @author Amelia
   */
  function showPopAfterSomeScroll() {
    var $popup = $(".popup[show-after-scroll-procent]");
    var procentFromTop = $popup.attr("show-after-scroll-procent") / 100;
    var intDocumentHeight = $(document).height();

    $(window).on("scroll", function (e) {
      if ($(window).scrollTop() > intDocumentHeight * procentFromTop) {
        $popup.addClass("show-popup");
        $(this).off(e);
      }
    });
  }

  showPopAfterSomeScroll();

  // CLOSE POPUP VARS
  var $close1 = $(".popup__close");
  var $close2 = $(".popup__bg");

  $close1.on("click", closePopUp);
  $close2.on("click", closePopUp);

  /**
   * Closes the popup
   */
  function closePopUp() {
    $(".popup").removeClass("show-popup");
    $("body").removeClass("noscroll");
  }

  /**
   * OWL Carousels initialization
   *
   * @link https://owlcarousel2.github.io/OwlCarousel2/docs/api-options.html
   * @since 1.0
   * @author Amelia
   */
  function owlCarousels() {
    var themplateDir = piData.template_directory_uri;

    $(".owl-hero").owlCarousel({
      nav: false,
      slideSpeed: 300,
      paginationSpeed: 400,
      items: 1,
      loop: true,
      dots: true,
      autoplay: true,
      smartSpeed: 500,
      animateIn: "fadeIn",
      animateOut: "fadeOut",
      autoplayTimeout: 5000,
    });

    $(".owl-offer").owlCarousel({
      nav: true,
      margin: 30,
      slideSpeed: 300,
      paginationSpeed: 400,
      items: 2,
      loop: true,
      dots: false,
      autoplay: true,
      autoplayHoverPause: true,
      smartSpeed: 500,
      autoplayTimeout: 3600,
      responsive: {
        0: {
          items: 1,
        },
        576: {
          items: 2,
        },
      },
    });

    $(".owl-team").owlCarousel({
      nav: true,
      navText: ["<", ">"],
      margin: 30,
      slideSpeed: 300,
      paginationSpeed: 400,
      items: 4,
      loop: true,
      dots: false,
      autoplay: true,
      autoplayHoverPause: true,
      smartSpeed: 500,
      autoplayTimeout: 3600,
      responsive: {
        0: {
          items: 1,
        },
        576: {
          items: 2,
        },
        768: {
          items: 3,
        },
        992: {
          items: 4,
        },
      },
    });

    $(".owl-testimonials").owlCarousel({
      nav: false,
      //navText: ["<", ">"],
      slideSpeed: 300,
      paginationSpeed: 400,
      items: 3,
      loop: true,
      dots: false,
      autoplay: false,
      autoplayHoverPause: true,
      smartSpeed: 500,
      autoplayTimeout: 5000,
      margin: 30,
      responsive: {
        0: {
          nav: false,
          items: 1,
        },
        768: {
          items: 2,
        },
        1024: {
          items: 3,
        },
        1360: {
          nav: true,
        },
      },
    });

    $(".owl-doctors").owlCarousel({
      nav: true,
      navText: ["<", ">"],
      slideSpeed: 300,
      paginationSpeed: 400,
      items: 1,
      loop: true,
      dots: false,
      autoplay: true,
      autoplayHoverPause: true,
      smartSpeed: 500,
      autoplayTimeout: 5000,
    });

    $(".owl-related-offer").owlCarousel({
      nav: true,
      navText: ["<", ">"],
      slideSpeed: 300,
      paginationSpeed: 400,
      items: 2,
      loop: true,
      dots: false,
      autoplay: true,
      autoplayHoverPause: true,
      smartSpeed: 500,
      autoplayTimeout: 5000,
    });

    $(".owl-lp-doctors").owlCarousel({
      nav: true,
      navText: [
        '<i class="icon-arrow-left"></i>',
        '<i class="icon-arrow-right"></i>',
      ],
      slideSpeed: 300,
      paginationSpeed: 400,
      items: 1,
      loop: false,
      dots: false,
      autoplay: false,
      autoplayHoverPause: true,
      smartSpeed: 500,
      autoplayTimeout: 5000,
    });

    $(".owl-lp-pricelist").owlCarousel({
      nav: true,
      navText: [
        '<i class="icon-arrow-left"></i>',
        '<i class="icon-arrow-right"></i>',
      ],
      margin: 30,
      slideSpeed: 300,
      paginationSpeed: 400,
      items: 1,
      loop: true,
      dots: false,
      autoplay: false,
      autoplayHoverPause: true,
      smartSpeed: 500,
      autoplayTimeout: 3600,
    });
  }

  owlCarousels();

  /**
   * Enables tabbed controls functionality
   *
   * @since 1.0
   * @author Amelia
   */
  // function tabs() {
  //   var $tabLink = $('.tabs .tab-link');
  //   var $tabContents = $('.tabs .tab-content');
  //
  //   $tabLink.on('click', function(e) {
  //     e.preventDefault();
  //
  //     if (!$(this).hasClass('active')) {
  //       $(this).parent().siblings().find('.tab-link').removeClass('active');
  //       $(this).addClass('active');
  //
  //       var id = $(this).attr('href');
  //       var $tabContent = $('.tabs .tab-content' + id);
  //
  //       $tabContents.slideUp(400);
  //       $tabContent.slideDown(400);
  //     }
  //
  //   });
  // }

  /**
   * reveals certain CTA/UX elements on scroll
   *
   * Revealed elements are: a scroll-up button, a landing page CTA popup, a 'call us' mobile button
   *
   * @since 1.0
   * @author Amelia
   */
  function stickyButtons() {
    $(window).scroll(function () {
      if ($(window).scrollTop() > $(window).height() - 100) {
        $(".scroll-up").addClass("show-scroll");
        $(".lp-cta-sticky").addClass("show-cta");
        $(".call-to-us").addClass("show-call");
      } else {
        $(".scroll-up").removeClass("show-scroll");
        $(".lp-cta-sticky").removeClass("show-cta");
        $(".call-to-us").removeClass("show-call");
      }
    });

    var $scrollUp = $(".scroll-up");

    $scrollUp.on("click", function () {
      $("html, body").animate(
        {
          scrollTop: $("body").offset().top,
        },
        500,
        "linear"
      );
    });
  }

  stickyButtons();

  /**
   * Enables smooth sroll on specific anchors
   *
   * @since 1.0
   * @author Amelia
   */
  function smoothScroll() {
    var $mobileHeader = $(".header-mobile__sticky");

    if ($mobileHeader.length) {
      var mobileHeaderHeight = $mobileHeader.height();
      mobileHeaderHeight = mobileHeaderHeight + 32;
    } else {
      var mobileHeaderHeight = 32;
    }
    $('a.smooth-scroll[href^="#"]').on("click", function (e) {
      //e.preventDefault()
      $("html, body").animate(
        {
          scrollTop: $($(this).attr("href")).offset().top - mobileHeaderHeight,
        },
        500,
        "linear"
      );
    });
  }

  smoothScroll();
  //$(window).resize(smoothScroll);

  /**
   * Enables floating labels on some form elements
   *
   * Float labels move to the top of the element when input is clicked or has some value.
   * Otherwise the label will stay on top of the input.
   *
   * @since 1.0
   * @author Amelia
   */
  function floatLables() {
    $(".float-labels-container input, .float-labels-container textarea").each(
      function () {
        if ($(this).val().length != 0) {
          $(this).parent().siblings("label").addClass("move");
        } else {
          $(this).parent().siblings("label").removeClass("move");
        }
      }
    );

    $(
      ".float-labels-container input, .float-labels-container textarea, .float-labels-container select"
    ).focus(function () {
      $(this).parent().siblings("label").addClass("move");
    });

    $(
      ".float-labels-container input, .float-labels-container textarea"
    ).focusout(function () {
      if ($(this).val().length == 0) {
        $(this).parent().siblings("label").removeClass("move");
      }
    });

    $(".float-labels-container select").focusout(function () {
      if ($(this).val() == "") {
        $(this).parent().siblings("label").removeClass("move");
      }
    });

    document.addEventListener(
      "wpcf7mailsent",
      function (event) {
        $(this).find("label").removeClass("move");
      },
      false
    );
  }

  floatLables();

  /**
   * Renders a reading progress bar animation (used mainly in offers and blog posts)
   *
   * @since 1.0
   * @author Amelia
   */
  function readingProgressBar() {
    var scrollwin = $(window).scrollTop();
    var articleheight = $(".reading-content").outerHeight(true);
    var windowWidth = $(window).width();

    if (scrollwin >= $(".reading-content").offset().top) {
      if (scrollwin <= $(".reading-content").offset().top + articleheight) {
        $("#reading-progress-bar").css(
          "width",
          ((scrollwin - $("article").offset().top) / articleheight) * 100 + "%"
        );
      } else {
        $("#reading-progress-bar").css("width", "100%");
      }
    } else {
      $("#reading-progress-bar").css("width", "0px");
    }
  }

  if ($("#reading-progress-bar").length) {
    readingProgressBar();

    $(window).scroll(function () {
      readingProgressBar();
    });
  }

  /**
   * Fires justified gallery script on tagged nodes (mainly certs)
   *
   * @since 1.0
   * @author Amelia
   */
  $(".justified-gallery").justifiedGallery({
    rowHeight: 200,
    lastRow: "nojustify",
    margins: 24,
  });

  /**
   * Reveals a full table of contents in offers
   *
   * @since 1.0
   * @author Amelia
   */
  function showFullTableOfContent() {
    var $tableOfContent = $(".js-table-of-contents");

    $tableOfContent.each(function () {
      $(this)
        .find("li")
        .each(function (index, element) {
          if (index == 4) {
            $(this).parent().next().removeClass("d-none");
          }
          if (index > 3) {
            $(this).hide();
          }
        });
    });
  }

  $(".js-show-table-of-contents").on("click", function (e) {
    e.preventDefault();
    $(this).prev().find("li").show(300);
    $(this).hide(300);
  });

  if ($(window).width() < 768) {
    showFullTableOfContent();
  }

  /**
   * Reveals a 'read more' element
   *
   * @since 1.0
   * @author Amelia
   */
  function readMore() {
    if ($(window).width() <= 992) {
      $("p")
        .has("<!--more-->")
        .html(function (_, text) {
          return text.replace(
            "<!--more-->",
            '<a href="#" class="js-read-more">czytaj dalej</a>'
          );
        });

      $(".js-read-more").parent().nextAll().slideUp(0);

      $(".js-read-more").on("click", function (e) {
        e.preventDefault();
        $(this).slideUp(0);
        $(this).parent().nextAll().slideDown(200);
      });
    }
  }

  readMore();

  /*
  =================================
    SHOW METAMORPHOSIS BEFORE IMG
  =================================
  */

  function showMetamorphosisImg() {
    var $btn = $(".preview-metamorphosis .btn");

    $btn.on("click", function (e) {
      e.preventDefault();
      $(this).parent().toggleClass("show");
      $(this).hide();
    });
  }

  showMetamorphosisImg();

  function showNextRow() {
    var $show_next_row = $(".show-next-row");
    $show_next_row.on("click", function (e) {
      e.preventDefault();
      id = $(this).attr("href");
      $(this).parent().addClass("hide"); // hide btn after clicking
      $btnNr = parseInt($(this).parent().attr("nr")) + 1; // create id of next btn
      $nextBtnId = ".btn-holder--" + $btnNr; // create id of next btn
      $(this).parent().parent().find(id).addClass("show"); // show next row of items
      $(this).parent().parent().find($nextBtnId).addClass("show"); // show next btn
    });
  }
  showNextRow();
});
