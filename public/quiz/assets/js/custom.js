$(document).ready(function () {
  $("header").css("transform", "translateY(0)");

  // timer
  var count = 60;

  var interval = setInterval(function () {
    if (count == 0) {
      clearInterval(interval);
    } else {
      count = count - 1;
    }
    document.getElementById("timer").innerHTML = count;
  }, 1000);

  var swiper = new Swiper(".mySwiper", {
    effect: "creative",
    slidesPerView: 1,
    speed: 700,
    // allowTouchMove: false,
    creativeEffect: {
      prev: {
        shadow: true,
        translate: [0, 0, -400],
      },
      next: {
        translate: ["100%", 0, 0],
      },
    },
  });
  $("form fieldset input").on("click", function () {
    // Check if the currentStep is less than the totalSteps
    if (currentStep < totalSteps) {
      setTimeout(function () {
        swiper.slideNext();
        currentStep++;
        updateProgress();
      }, 500);
    } else {
      $("form fieldset input").prop("disabled", true);
    }
  });

  var totalSteps = $("form fieldset").length;
  $("#total").text(totalSteps);

  var currentStep = 1;

  function updateProgress() {
    $("#current").text(currentStep + "/");

    // Calculate progress width based on the current step
    var progressWidth = (100 / totalSteps) * (currentStep - 1);
    $(".bar .progress").css("width", progressWidth + "%");
  }

  updateProgress();
});

$("fieldset:last input").on("click", function () {
  showresult();
});
