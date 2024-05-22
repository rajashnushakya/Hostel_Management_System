<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Styled Room Detail</title>
  <!-- Importing fonts from Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Patua+One|Open+Sans" rel="stylesheet">
  <!-- Importing Compass mixins for CSS3 -->
  <style>
    @import "compass/css3";

    * {
      -moz-box-sizing: border-box;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
    }

    body {
      background: #353a40;
      font-family: 'Open Sans', sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .room-details {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
      width: 90%;
      max-width: 1200px;
      text-align: center;
      padding: 80px 20px;
    }

    .room-details h1 {
      font-family: 'Patua One', cursive;
      font-size: 108px; /* 36px * 3 */
      color: #4a5564;
      margin-bottom: 60px;
    }

    .room-details p {
      font-size: 60px; /* 20px * 3 */
      color: #5f6062;
      margin: 30px 0;
    }

    .room-details p span {
      font-weight: 700;
      color: #2d2d2d;
    }
  </style>
</head>
<body>
  <div class="room-details">
    <h1>Room Detail</h1>
    <p><span>Room Name:</span> KATHMANDU</p>
    <p><span>Room ID:</span> 23</p>
    <p><span>Room Seater:</span> RAJASHNU</p>
  </div>
</body>
</html>