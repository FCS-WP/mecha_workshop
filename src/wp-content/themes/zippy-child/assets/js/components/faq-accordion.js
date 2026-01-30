jQuery(document).ready(function ($) {
  // Handle FAQ item click
  $(".faq-question").on("click", function () {
    const $item = $(this).closest(".faq-item");
    const isActive = $item.hasClass("active");

    // Close all other items (optional: remove these lines for multi-open behavior)
    $(".faq-item").removeClass("active");

    // Toggle current item
    if (!isActive) {
      $item.addClass("active");
    }
  });

  // Keyboard navigation
  $(".faq-question").on("keypress", function (e) {
    if (e.which === 13 || e.which === 32) {
      // Enter or Space
      e.preventDefault();
      $(this).click();
    }
  });

  // Make accessible
  $(".faq-question").attr({
    role: "button",
    "aria-expanded": "false",
  });

  // Update aria-expanded on toggle
  $(".faq-item").on("click", ".faq-question", function () {
    const isExpanded = $(this).closest(".faq-item").hasClass("active");
    $(this).attr("aria-expanded", isExpanded);
  });
});
