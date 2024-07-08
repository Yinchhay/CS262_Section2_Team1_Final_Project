$(document).ready(function() {
  var progress = 0;
  var interval = setInterval(function() {
      progress += 1;
      $('#progress-bar-m').css('width', progress + '%').attr('aria-valuenow', progress);
      if (progress >= 88) {
          clearInterval(interval);
          $('#progress-bar-m').text('Overall Score: 88%'); // Display the percentage
      }
  }, 30); // Decreased from 100 to 50 to make the animation faster
});

$(document).ready(function() {
  var progress = 0;
  var interval = setInterval(function() {
      progress += 1;
      $('#progress-bar-o').css('width', progress + '%').attr('aria-valuenow', progress);
      if (progress >= 86) {
          clearInterval(interval);
          $('#progress-bar-o').text('Overall Score: 86%'); // Display the percentage
      }
  }, 30); // Decreased from 100 to 50 to make the animation faster
});