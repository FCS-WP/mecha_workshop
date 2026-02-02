jQuery(document).ready(function ($) {
  // Package Slider functionality
  $(
    ".package-slider-wrapper .slider-prev, .package-slider-wrapper .slider-next",
  ).on("click", function () {
    var $wrapper = $(this).closest(".slider-wrapper");
    var $track = $wrapper.find(".package-slider-track");
    var $slides = $track.find(".package-slide");
    var currentScroll = $track.scrollLeft();
    var containerWidth = $track.width();
    var maxScroll = $track[0].scrollWidth - containerWidth;

    // Responsive scroll amount based on screen size
    var screenWidth = $(window).width();
    var slidesToScroll;

    if (screenWidth <= 640) {
      slidesToScroll = 1; // Mobile: scroll 1 slide
    } else if (screenWidth <= 1024) {
      slidesToScroll = 2; // Tablet: scroll 2 slides
    } else {
      slidesToScroll = 3; // Desktop: scroll 3 slides
    }

    // Find current visible slide index by comparing offset positions
    var currentIndex = 0;
    var trackOffset = $track.offset().left;

    $slides.each(function (index) {
      var slideOffset = $(this).offset().left;
      var relativePosition = slideOffset - trackOffset;

      if (relativePosition <= 5) {
        // 5px tolerance
        currentIndex = index;
      }
    });

    var targetIndex;
    if ($(this).hasClass("slider-prev")) {
      targetIndex = Math.max(0, currentIndex - slidesToScroll);
    } else {
      targetIndex = Math.min($slides.length - 1, currentIndex + slidesToScroll);
    }

    // Get target slide offset position
    var $targetSlide = $slides.eq(targetIndex);
    if ($targetSlide.length) {
      var targetOffset = $targetSlide.offset().left;
      var newScroll = currentScroll + (targetOffset - trackOffset);
      newScroll = Math.max(0, Math.min(maxScroll, newScroll));
      $track.animate({ scrollLeft: newScroll }, 0, "swing");
    }
  });
});
