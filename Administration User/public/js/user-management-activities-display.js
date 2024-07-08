document.addEventListener("DOMContentLoaded", function() {
  const progressBars = document.querySelectorAll(".circular-progress");
  progressBars.forEach(bar => {
      const progress = bar.getAttribute("data-progress");
      const circle = bar.querySelector(".circle");
      const radius = circle.r.baseVal.value;
      const circumference = 2 * Math.PI * radius;
      const offset = circumference - (progress / 100) * circumference;

      circle.style.strokeDasharray = `${circumference}`;
      circle.style.strokeDashoffset = circumference;

      setTimeout(() => {
          circle.style.strokeDashoffset = offset;
      }, 100);
  });
});

$(document).ready(function() {
  var progress = 0;
  var interval = setInterval(function() {
      progress += 1;
      $('#progress-bar-fullM').css('width', progress + '%').attr('aria-valuenow', progress);
      if (progress >= 80) { 
          clearInterval(interval);
          $('#progress-bar-fullM').text(progress + '%'); 
      }
  }, 20); // faster or slower
});
