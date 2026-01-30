jQuery(document).ready(function ($) {
  // Handle add-on item click
  $(".addon-item").on("click", function () {
    const addonId = $(this).data("addon-id");

    // Update active state on list items
    $(".addon-item").removeClass("active");
    $(this).addClass("active");

    // Update active detail view
    $(".addon-detail").removeClass("active");
    $(`.addon-detail[data-addon-id="${addonId}"]`).addClass("active");

    // Smooth scroll to detail section on mobile
    if ($(window).width() < 992) {
      $("html, body").animate(
        {
          scrollTop: $(".addon-detail-section").offset().top - 20,
        },
        400,
      );
    }
  });

  // Optional: Keyboard navigation
  $(".addon-item").on("keypress", function (e) {
    if (e.which === 13 || e.which === 32) {
      // Enter or Space
      e.preventDefault();
      $(this).click();
    }
  });

  // Make items keyboard accessible
  $(".addon-item").attr("tabindex", "0").attr("role", "button");
});
