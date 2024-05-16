let icon =
  '<svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg"> <g clip-path="url(#clip0_3217_49728)"> <path d="M8.40035 29.9033C8.32012 29.9033 8.23901 29.8828 8.16502 29.84C7.9404 29.7099 7.86463 29.4228 7.99477 29.1982L10.208 25.3858C11.1698 23.7279 12.9579 22.6983 14.8744 22.6983H18.6823C19.292 22.6983 19.8892 22.4871 20.3634 22.1047L27.8724 16.0434C27.9535 15.9783 28.0007 15.8856 28.0061 15.7822C28.0114 15.6788 27.974 15.5816 27.9009 15.5076C27.7752 15.382 27.5729 15.3677 27.4302 15.4738C27.4204 15.4809 27.4115 15.4871 27.4017 15.4934L21.5507 19.2166C20.8813 19.7122 20.0862 19.9975 19.3669 20.0002L12.0149 20.3068C11.7546 20.3211 11.5371 20.116 11.5264 19.8575C11.5157 19.5982 11.7171 19.3798 11.9756 19.3691L19.3366 19.0624C19.3428 19.0624 19.35 19.0624 19.3562 19.0624C19.8776 19.0624 20.4936 18.8351 21.0034 18.4545C21.0133 18.4474 21.0222 18.4412 21.032 18.4349L26.8847 14.7108C27.3973 14.34 28.1166 14.3961 28.5658 14.8445C28.8261 15.1047 28.9643 15.4649 28.9447 15.8321C28.9251 16.1994 28.7495 16.5434 28.4633 16.7743L20.9544 22.8356C20.3135 23.3526 19.5068 23.6378 18.6832 23.6378H14.8753C13.2922 23.6378 11.8152 24.4882 11.021 25.8574L8.8077 29.6698C8.72035 29.8195 8.56347 29.9033 8.40124 29.9033H8.40035Z" fill="white"/> <path d="M2.74798 24.2511C2.66508 24.2511 2.5813 24.2288 2.50553 24.1833C2.28358 24.0487 2.21227 23.7599 2.34687 23.5388L4.94076 19.254C5.91235 17.6487 7.68083 16.6521 9.55717 16.6521H16.402C17.4102 16.6521 18.2302 17.4722 18.2302 18.4803C18.2302 19.435 17.4369 20.1293 16.3414 20.1329L15.1666 20.1766C14.9072 20.1837 14.6897 19.9841 14.6799 19.7247C14.6701 19.4653 14.8724 19.2478 15.1318 19.238L16.3147 19.1943C16.32 19.1943 16.3262 19.1943 16.3316 19.1943C16.7933 19.1943 17.2898 18.9706 17.2898 18.4803C17.2898 17.9901 16.8914 17.5916 16.4011 17.5916H9.55628C8.00707 17.5916 6.54612 18.4152 5.74388 19.7407L3.14999 24.0255C3.06174 24.1717 2.90665 24.2519 2.74798 24.2519V24.2511Z" fill="white"/> <path d="M15.6124 15.8312C15.5117 15.8312 15.41 15.7982 15.3254 15.7331L12.5158 13.5662C12.3954 13.4735 11.3071 12.6285 10.1759 11.5562C8.43061 9.90179 6.64697 7.84896 6.64697 5.17039C6.64697 2.49182 8.92175 0.102051 11.7162 0.102051C13.2413 0.102051 14.6551 0.773254 15.6115 1.92669C16.5688 0.773254 17.9817 0.102051 19.5068 0.102051C22.3012 0.102051 24.5751 2.37594 24.5751 5.17039C24.5751 7.96484 22.7915 9.90179 21.0462 11.5562C19.915 12.6294 18.8267 13.4735 18.7063 13.5662L15.8976 15.7331C15.8129 15.7982 15.7122 15.8312 15.6106 15.8312H15.6124ZM11.7162 1.04067C9.43875 1.04067 7.58648 2.89294 7.58648 5.17039C7.58648 7.44785 9.22215 9.35806 10.8222 10.8752C11.9194 11.9154 12.9721 12.7328 13.0889 12.8228L15.6115 14.7687L18.1341 12.8228C18.2508 12.7328 19.3036 11.9154 20.4008 10.8752C22.0008 9.35806 23.6365 7.49331 23.6365 5.17039C23.6365 2.84748 21.7842 1.04067 19.5068 1.04067C18.0779 1.04067 16.7703 1.76357 16.0082 2.97494C15.9226 3.11132 15.7719 3.19422 15.6106 3.19422C15.4493 3.19422 15.2995 3.11132 15.2131 2.97494C14.4509 1.76357 13.1433 1.04067 11.7144 1.04067H11.7162Z" fill="white"/> </g> <defs> <clipPath id="clip0_3217_49728"> <rect width="30" height="29.9991" fill="white" transform="translate(0.5 0.000488281)"/> </clipPath> </defs> </svg>';
// jQuery("#donat-icon").append(icon);
jQuery("#donat-icon-footer").append(icon);
// jQuery("li.menu-call-action").append(icon);

jQuery(document).ready(function ($) {
  $(".fusion-flyout-menu-toggle").on("click", function () {
    $(".header-section-wraper").toggleClass("active");
    $(this).toggleClass("active");
    addDisplayLogo();
  });
  $(".fusion-flyout-search-toggle .awb-icon-search").on("click", function () {
    $(this).addClass("active");
  });
  $(".fusion-toggle-icon").on("click", function () {
    console.log(123);
    $(".header-section-wraper").removeClass("active");
    addDisplayLogo();
    $(".fusion-flyout-search-toggle .awb-icon-search").removeClass("active");
  });
  function addDisplayLogo() {
    console.log(345);
    $(".fusion-flyout-search-toggle").toggleClass("d-block");
    $(".fusion-mobile-logo").toggleClass("d-done");
    $(".fusion-standard-logo").toggleClass("d-block");
    $("#menu-donation-button-mobile-link").toggleClass("d-none");
  }

  $(".isf-people-link").on("click", function () {
    event.preventDefault();
    let activeClass = $(this).attr("data-class");
    $("." + activeClass).toggleClass("people-max-height");
    let html = "";
    if ($("." + activeClass).hasClass("people-max-height")) {
      html =
        '<div class="slide-in-bottom"><div class="learn_more" data-hover="Learn More">Learn More</div><div class=" custom-styles w-embed"></div></div>';
    } else {
      html =
        '<div class="slide-in-bottom"><div class="learn_more" data-hover="Close">Close</div><div class=" custom-styles w-embed"></div></div>';
    }
    $(this).html(html);
  });

  $(".fusion-mobile-nav-item").on("click", function () {
    if ($(this).hasClass("active")) {
      $(this).toggleClass("active");
    } else {
      $(".fusion-mobile-nav-item").removeClass("active");
      $(this).addClass("active");
    }
  });

  $(".fusion-flyout-search-toggle.d-block .fusion-toggle-icon").on(
    "click",
    function () {
      console.log(123);
      $(".fusion-flyout-search-toggle").toggleClass("d-block");
      $(".fusion-mobile-logo").toggleClass("d-done");
      $(".fusion-standard-logo").toggleClass("d-block");
      $("#menu-donation-button-mobile-link").toggleClass("d-none");
    }
  );

  $(".menu-mobile-menu-container li").on("click", function () {
    if ($(this).hasClass("active")) {
      $(this).toggleClass("active");
    } else {
      $(".menu-mobile-menu-container li").removeClass("active");
      $(this).toggleClass("active");
    }
  });

  $(".menu-mobile-menu-container li.menu-item-has-children").on(
    "click",
    function (event) {
      event.preventDefault();
    }
  );

  // socail media
  // fusion-linkedin
  // fusion-mail
  // fusion-facebook
  //mail icon
  let mailIcon =
    '<svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M28.5 6H4.5C3.96957 6 3.46086 6.21071 3.08579 6.58579C2.71071 6.96086 2.5 7.46957 2.5 8V24C2.5 24.5304 2.71071 25.0391 3.08579 25.4142C3.46086 25.7893 3.96957 26 4.5 26H28.5C29.0304 26 29.5391 25.7893 29.9142 25.4142C30.2893 25.0391 30.5 24.5304 30.5 24V8C30.5 7.46957 30.2893 6.96086 29.9142 6.58579C29.5391 6.21071 29.0304 6 28.5 6ZM26.3 8L16.5 14.78L6.7 8H26.3ZM4.5 24V8.91L15.93 16.82C16.0974 16.9361 16.2963 16.9984 16.5 16.9984C16.7037 16.9984 16.9026 16.9361 17.07 16.82L28.5 8.91V24H4.5Z" fill="white"/></svg>';

  let facebookIcon =
    '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26.67 4H5.33C4.97807 4.00262 4.6413 4.14358 4.39244 4.39244C4.14358 4.6413 4.00262 4.97807 4 5.33V26.67C4.00262 27.0219 4.14358 27.3587 4.39244 27.6076C4.6413 27.8564 4.97807 27.9974 5.33 28H16.82V18.72H13.7V15.09H16.82V12.42C16.82 9.32 18.71 7.63 21.49 7.63C22.42 7.63 23.35 7.63 24.28 7.77V11H22.37C20.86 11 20.57 11.72 20.57 12.77V15.08H24.17L23.7 18.71H20.57V28H26.67C27.0219 27.9974 27.3587 27.8564 27.6076 27.6076C27.8564 27.3587 27.9974 27.0219 28 26.67V5.33C27.9974 4.97807 27.8564 4.6413 27.6076 4.39244C27.3587 4.14358 27.0219 4.00262 26.67 4Z" fill="#FFFFF6"/></svg>';

  let linkedInicon =
    '<svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26.7 4H6.3C5.3 4 4.5 4.8 4.5 5.7V26.2C4.5 27.1 5.3 27.9 6.3 27.9H26.7C27.7 27.9 28.5 27.1 28.5 26.2V5.7C28.5 4.8 27.7 4 26.7 4ZM11.6 24.4H8.1V13H11.6V24.4ZM9.9 11.4C8.8 11.4 7.8 10.5 7.8 9.3C7.8 8.1 8.7 7.2 9.9 7.2C11 7.2 12 8.1 12 9.3C12 10.5 11 11.4 9.9 11.4ZM25 24.3H21.5V18.7C21.5 17.4 21.5 15.6 19.6 15.6C17.7 15.6 17.5 17.1 17.5 18.5V24.2H14V13H17.3V14.5H17.4C17.9 13.6 19.1 12.6 20.8 12.6C24.4 12.6 25.1 15 25.1 18.1V24.3H25Z" fill="#FFFFF6"/></svg>';

  $(".fusion-mail").append(mailIcon + "&nbsp; Send via e-mail");
  $(".fusion-linkedin").append(linkedInicon + "&nbsp; Share on LinkedIn");
  $(".fusion-facebook").append(facebookIcon + "&nbsp; Share on Facebook");

  $(".play-button").on("click", function (e) {
    let classID = $(this).attr("post-data");
    let postTitle = $("#title_" + classID).text();
    var iframe = document.querySelector("#iframe_" + classID + " iframe");
    var symbol = $(iframe)[0].src.indexOf("?") > -1 ? "&" : "?";
    $(iframe)[0].src += symbol + "autoplay=1&auto_play=true";
    $(iframe).width("100%");
    $(iframe).height("540px");
    $("#videoModalContentYouTube").append(iframe);
    $("#videoModalTitle").text(postTitle);
  });

  $(".close_modal").on("click", function () {
    $("#videoModalContentYouTube").html("");
    $("#videoModalTitle").text("");
  });

  if ($(window).width() > 1024) {
    var lastScrollTop = 0;
    $(window).scroll(function (event) {
      var st = $(this).scrollTop();
      if (st > lastScrollTop && st > 5) {
        $("header.fusion-header-wrapper").addClass("d-none");
        $("header.fusion-header-wrapper").removeClass("position-relative");
      } else {
        $("header.fusion-header-wrapper").removeClass("d-none");
        $("header.fusion-header-wrapper").addClass("position-fixed");
      }
      lastScrollTop = st;
      if (lastScrollTop <= 5) {
        $("header.fusion-header-wrapper").removeClass("d-none");
        $("header.fusion-header-wrapper").removeClass("position-fixed");
        $("header.fusion-header-wrapper").addClass("position-relative");
      }
    });
  } else {
    $(window).scroll(function (event) {
      $("header.fusion-header-wrapper").addClass("position-fixed");
      $("header.fusion-header-wrapper").removeClass("position-relative");
    });
  }

  var prevScrollpos = window.pageYOffset;
  window.onscroll = function () {
    var findClass = document.getElementsByClassName("fusion-sticky-shadow");
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
      if (findClass.length > 0) {
        findClass[0].style.top = "0px";
      }
    } else {
      if (findClass.length > 0) {
        findClass[0].style.top = "-84px";
      }
    }
    prevScrollpos = currentScrollPos;
  };

  // number counter
  gsap.registerPlugin(ScrollTrigger);
  sectionAnimation();
  function sectionAnimation() {
    ScrollTrigger.defaults({
      toggleActions: "restart pause resume pause",
      scrub: true,
      start: "100px 80%",
      end: "+=100",
      markers: false,
    });

    //Gather elements into an array
    var sections = gsap.utils.toArray(".state-number");

    //Map var to the elements
    var section = $(".state-number");
    // Animation for Sections
    sections.forEach(function (section, index) {
      gsap.set(section, { y: 100, opacity: 1 });
      gsap.to(section, {
        y: 0,
        opacity: 1,
        duration: 2,
        scrollTrigger: {
          trigger: sections[index],
          onEnter: () => animText(sections, index),
          onLeave: () => resetAnimText(sections, index),
        },
      });
    });
  }

  function resetAnimText(section, index) {
    if ($(section[index]).attr("id") == "number_state") {
      // $(".number").each(function () {
      //   $(this).text(0);
      // });
    }
  }

  function animText(section, index) {
    if ($(section[index]).attr("id") == "number_state") {
      $(".number").each(function () {
        var numberSymbol = $(this).attr("data-symbol");
        $(this)
          .prop("Counter", 0)
          .animate(
            {
              Counter: $(this).data("count"),
            },
            {
              duration: 2000,
              easing: "swing",
              step: function (now) {
                $(this).text(
                  Math.ceil(now)
                    .toString()
                    .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + numberSymbol
                );
              },
            }
          );
      });
    }
  }

  function selectedPaymentOption() {
    let donationType = $(
      '.monthly-or-one-of li input[type="radio"]:checked'
    ).val();
    let donationTypeText = "One time donation";
    let htmlText = "";
    if (donationType == "Once-off") {
      htmlText =
        "<span id='label-donation-option'>" + donationTypeText + "</span>";
    } else {
      donationTypeText = "Monthly donation";
      htmlText =
        "<span id='label-donation-option'>" + donationTypeText + "</span>";
    }
    $(".ginput_container_total").append(htmlText);
  }
  selectedPaymentOption();

  $(".monthly-or-one-of .gchoice label").on("click", function () {
    $(".ginput_container_total #label-donation-option").text("");

    let inputID = $(this).attr("for");
    let donationType = $("#" + inputID).val();
    let donationTypeText = "One time donation";
    if (donationType == "Once-off") {
    } else {
      donationTypeText = "Monthly donation";
    }
    $(".ginput_container_total #label-donation-option").text(donationTypeText);
  });
});