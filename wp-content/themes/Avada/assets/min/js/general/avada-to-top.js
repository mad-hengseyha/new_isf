jQuery(document).ready(function () {
  var o = 0,
    a =
      jQuery("html").hasClass("ua-edge") ||
      jQuery("html").hasClass("ua-safari-12") ||
      jQuery("html").hasClass("ua-safari-11") ||
      jQuery("html").hasClass("ua-safari-10")
        ? "body"
        : "html";
  jQuery(window).on("scroll", function () {
    var a = jQuery(this).scrollTop();
    200 < a && (a >= o || 1 !== parseInt(avadaToTopVars.totop_scroll_down_only))
      ? jQuery(".fusion-top-top-link").addClass("fusion-to-top-active")
      : jQuery(".fusion-top-top-link").removeClass("fusion-to-top-active"),
      (o = a);
  });
});
