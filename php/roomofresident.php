<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Styled Room Detail</title>
  <!-- Importing fonts from Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Patua+One|Open+Sans" rel="stylesheet">
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
    <p><span>Resident Name:</span> <span id="residentName"></span></p>
    <p><span>Room Name:</span> <span id="roomName"></span></p>
    <p><span>Room ID:</span> <span id="roomId"></span></p>
    <p><span>Room Seater:</span> <span id="roomSeater"></span></p>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const email = localStorage.getItem('email');
      if (!email) {
        console.error('Email not found in local storage');
        return;
      }

      fetch('getresidentId.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: email })
      })
      .then(response => response.json())
      .then(data => {
        console.log('getresidentId.php response:', data);
        if (data.success) {
          fetch('fetch_room_details.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({ residentId: data.residentId })
          })
          .then(response => response.json())
          .then(roomData => {
            console.log('fetch_room_details.php response:', roomData);
            if (roomData.success) {
              document.getElementById('residentName').innerText = roomData.residentName;
              document.getElementById('roomName').innerText = roomData.roomName;
              document.getElementById('roomId').innerText = roomData.roomId;
              document.getElementById('roomSeater').innerText = roomData.roomSeater;
            } else {
              alert('Room allocation not found'); // Display pop-up alert
              console.error(roomData.error);
            }
          });
        } else {
          console.error(data.error);
        }
      });
    });
  </script>
</body>
</html>
