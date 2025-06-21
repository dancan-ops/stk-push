<!DOCTYPE html>
<html>
<head>
  <title>Where Am I?</title>
</head>
<body>
  <h2>Click to find your location:</h2>
  <button onclick="getLocation()">Find Me</button>
  <p id="output"></p>

  <script>
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
      } else {
        document.getElementById("output").innerHTML = "Geolocation is not supported.";
      }
    }

    function showPosition(position) {
      document.getElementById("output").innerHTML =
        "Latitude: " + position.coords.latitude +
        "<br>Longitude: " + position.coords.longitude;
    }

    function showError(error) {
      document.getElementById("output").innerHTML =
        "Error: " + error.message;
    }
  </script>
</body>
</html>
