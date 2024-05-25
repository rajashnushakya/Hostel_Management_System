<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Room Allocation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .container {
      padding: 20px;
    }
    .mb-3-custom {
      margin-bottom: 1.5rem;
    }
    .table {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Room Allocation</h1>
    
    <label for="allocatedTo" class="col-form-label"><b>Room Booked List</b></label>
    <div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">S.No</th>
            <th scope="col">Name of Resident</th>
            <th scope="col">Room</th>
          </tr>
        </thead>
        <tbody>
        <?php
          include('connection.php');

          $query = "SELECT rb.id AS booking_id, res.firstname AS resident_name, r.room_name AS room_name 
                    FROM room_booking rb
                    INNER JOIN rooms r ON rb.roomid = r.id
                    INNER JOIN resident res ON rb.residentid = res.id";
          $result = $mysqli->query($query);

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>{$row['booking_id']}</td>";
                  echo "<td>{$row['resident_name']}</td>";
                  echo "<td>{$row['room_name']}</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='3'>No Booking Details</td></tr>";
          }

          $mysqli->close();
        ?>
        </tbody>
      </table>
    </div>

    <label for="roomDetails" class="col-form-label"><b>Room Details</b></label>
    <div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Room Id</th>
            <th scope="col">Room name</th>
            <th scope="col">Seater</th>
            <th scope="col">Occupancy</th>
          </tr>
        </thead>
        <tbody>
        <?php
          include('connection.php');

          $query = "SELECT * FROM rooms";
          $result = $mysqli->query($query);

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>{$row['id']}</td>";
                  echo "<td>{$row['room_name']}</td>";
                  echo "<td>{$row['seater']}</td>";
                  echo "<td>{$row['residentno']}</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='4'>No rooms found</td></tr>";
          }

          $mysqli->close();
        ?>
        </tbody>
      </table>
    </div>

    <form id="allocationForm" method="POST" action="insert_room.php">
      <div class="mb-3">
        <label for="allocatedTo" class="form-label">Allocated to:</label>
        <input type="text" class="form-control" id="allocatedTo" name="residentname" placeholder="Enter resident name">
      </div>
      <div class="mb-3">
        <label for="roomNumber" class="form-label">Room name:</label>
        <input type="text" class="form-control" id="roomNumber" name="roomname" placeholder="Enter room name">
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("allocationForm").addEventListener("submit", function(event) {
            event.preventDefault();
            var residentName = document.getElementById("allocatedTo").value.trim();
            var roomName = document.getElementById("roomNumber").value.trim();

            if (residentName === "" || roomName === "") {
                alert("Please fill in all fields.");
            } else {
                fetch('check_names.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ residentName: residentName, roomName: roomName })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        fetch('insert_room.php', {
                            method: 'POST',
                            body: new FormData(event.target)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.success);
                                document.getElementById("allocatedTo").value = ""; 
                                document.getElementById("roomNumber").value = "";
                            } else {
                                alert(data.error);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error allocating room');
                        });
                    } else {
                        alert('Please enter valid names.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error checking names');
                });
            }
        });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
