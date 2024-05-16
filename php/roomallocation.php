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
    <div class="mb-5"></div>
    <label for="allocatedTo" class="col-sm-2 col-form-label"><b>Room Booked List</b>  </label>
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
// Database connection
include('connection.php');

// Prepare and execute the query to fetch residentId and roomId from room_booking table
$query = "SELECT residentid, roomid FROM room_booking";
$result = $mysqli->query($query);

// Check if query execution was successful
if (!$result) {
    // Query error
    echo json_encode(['error' => $mysqli->error]);
} else {
    // Check if records exist
    if ($result->num_rows > 0) {
        // Loop through each row to fetch residentId and roomId
        while ($row = $result->fetch_assoc()) {
            $residentId = $row['residentid'];
            $roomId = $row['roomid'];

            // Prepare and execute the query to get room and resident details based on residentId and roomId
            $innerQuery = "SELECT rb.id AS booking_id, r.room_name AS room_name, res.firstname AS resident_name
                          FROM room_booking rb
                        INNER JOIN rooms r ON rb.roomid = r.id
                      INNER JOIN resident res ON rb.residentid = res.id
                      WHERE rb.residentid = $residentId AND rb.roomid = $roomId";

            $innerResult = $mysqli->query($innerQuery);

            // Check if inner query execution was successful
            if ($innerResult) {
                // Check if records exist
                if ($innerResult->num_rows > 0) {
                    // Loop through each row in the inner query result
                    while ($innerRow = $innerResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $innerRow['booking_id'] . "</td>"; // Display booking ID

                        echo "<td>" . $innerRow['resident_name'] . "</td>";
                        echo "<td>" . $innerRow['room_name'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // If no records found in inner query
                    echo "<tr><td colspan='3'>No Booking Details</td></tr>";
                }
            } else {
                // Inner query error
                echo json_encode(['error' => $mysqli->error]);
            }
        }
    } else {
        // If no records found in the main query
        echo "<tr><td colspan='3'>No Booking Details</td></tr>";
    }
}

// Close the database connection
$mysqli->close();
?>

        </tbody>
      </table>
    </div>
    <div class="mb-5"></div>

    <label for="allocatedTo" class="col-sm-2 col-form-label"><b>Room Details</b></label>

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
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['room_name'] . "</td>";
            echo "<td>" . $row['seater'] . "</td>";
            echo "<td>" . $row['residentno'] . "</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='8'>No rooms found</td></tr>";
        }
        ?>
        </tbody>
        </tbody>
      </table>
    </div>

    <div class="mb-5"></div>

    <form id="allocationForm" method="POST" action="insert_room.php">
    <div class="row mb-3">
        <label for="allocatedTo" class="col-sm-2 col-form-label">Allocated to:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="allocatedTo" name="residentname" placeholder="Enter resident name">
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="roomNumber" class="col-sm-2 col-form-label">Room name:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="roomNumber" name="roomname" placeholder="Enter room name">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <button type="submit" class="btn btn-primary btn-sm me-2">Submit</button>
            <button type="button" class="btn btn-secondary btn-sm">Back</button>
        </div>
    </div>
</form>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("allocationForm").addEventListener("submit", function(event) {
            var residentName = document.getElementById("allocatedTo").value.trim();
            var roomName = document.getElementById("roomNumber").value.trim();

            if (residentName === "" || roomName === "") {
                alert("Please fill in all fields.");
                event.preventDefault();
            } else {
                fetch('check_names.php', { // PHP script to check names
                    method: 'POST',
                    body: JSON.stringify({ residentName: residentName, roomName: roomName }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        // Names exist, proceed with form submission
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





    

  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>