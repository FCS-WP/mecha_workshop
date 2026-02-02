jQuery(document).ready(function ($) {
  // Tab switching
  $(".project-cat-tab").on("click", function () {
    var categoryId = $(this).data("category");

    // Update active tab
    $(".project-cat-tab").removeClass("active");
    $(this).addClass("active");

    // Show corresponding slider
    $(".project-slider").removeClass("active");
    $('.project-slider[data-category="' + categoryId + '"]').addClass("active");
  });

  // Slider functionality - only for project slider
  $(
    ".project-category-slider-wrapper .slider-prev, .project-category-slider-wrapper .slider-next",
  ).on("click", function () {
    var $wrapper = $(this).closest(".slider-wrapper");
    var $track = $wrapper.find(".project-slider-track");

    // Check if track exists
    if (!$track.length || !$track[0]) {
      console.error("Slider track not found");
      return;
    }

    var $slides = $track.find(".project-slide");
    var currentScroll = $track.scrollLeft();
    var containerWidth = $track.width();
    var maxScroll = $track[0].scrollWidth - containerWidth;

    var screenWidth = $(window).width();
    var slidesToScroll;

    if (screenWidth <= 640) {
      slidesToScroll = 1;
    } else if (screenWidth <= 1024) {
      slidesToScroll = 2;
    } else {
      slidesToScroll = 3;
    }

    var currentIndex = 0;
    var trackOffset = $track.offset().left;

    $slides.each(function (index) {
      var slideOffset = $(this).offset().left;
      var relativePosition = slideOffset - trackOffset;

      if (relativePosition <= 5) {
        currentIndex = index;
      }
    });

    var targetIndex;
    if ($(this).hasClass("slider-prev")) {
      targetIndex = Math.max(0, currentIndex - slidesToScroll);
    } else {
      targetIndex = Math.min($slides.length - 1, currentIndex + slidesToScroll);
    }

    var $targetSlide = $slides.eq(targetIndex);
    if ($targetSlide.length) {
      var targetOffset = $targetSlide.offset().left;
      var newScroll = currentScroll + (targetOffset - trackOffset);
      newScroll = Math.max(0, Math.min(maxScroll, newScroll));
      $track.animate({ scrollLeft: newScroll }, 0, "swing");
    }
  });
});
