<?php
session_start();
include('connection.php');

// Assuming you have a MySQL table named "room_booking" with columns: id, room_name, seater, price
// Fetch room booking data from the database
$sql = "SELECT * FROM rooms";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Room Booking</title>
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
  /* Remove .selected-row class */
  /* .selected-row {
    background-color: lightblue;
  } */
  /* New class for clicked rows */
  .clicked-row {
    background-color: lightgreen; /* Change to your desired color */
  }
  /* Added styles for hover effect */
  table tbody tr:hover {
    cursor: pointer;
    background-color: #e1f0e5; /* Light blue shade */
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
  }
</style>

</head>
<body>
    <!-- Room Details -->
    <div class="container">
      <div class="row mb-3 mb-3-custom">
        <h1 class="col-sm-2">Room Booking</h1>
      </div>    
      <div>
        <table id="roomTable" class="table">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Seater</th>
              <th scope="col">Price</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Loop through each row of room booking data
            while ($row = $result->fetch_assoc()) {
              echo "<tr data-id='" . $row['id'] . "'>";
              echo "<th scope='row'>" . $row['id'] . "</th>";
              echo "<td>" . $row['room_name'] . "</td>";
              echo "<td>" . $row['seater'] . "</td>";
              echo "<td>$" . $row['fee'] . "</td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
  
      <!-- Buttons -->
      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
          <button id="submitBtn" class="btn btn-primary btn-sm me-2">Submit</button>
          <button type="button" class="btn btn-secondary btn-sm">Back</button>
        </div>
      </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const roomTable = document.getElementById('roomTable');
      const submitBtn = document.getElementById('submitBtn');

      roomTable.addEventListener('click', (e) => {
        const clickedRow = e.target.closest('tr');
        if (clickedRow) {
          clickedRow.classList.toggle('clicked-row');
          clickedRow.classList.toggle('selected-row');
          const roomId = clickedRow.getAttribute('data-id');
          localStorage.setItem('roomId', roomId);
        }
      });
      const userEmail = localStorage.getItem('email');
      console.log(userEmail);
      submitBtn.addEventListener('click', () => {
            const roomId = localStorage.getItem('roomId');
            if (roomId) {
                alert('Room ID selected: ' + roomId);

                // AJAX call to retrieve resident name
                $.ajax({
                    type: 'GET',
                    url: 'retrieve_email.php',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            const residentName = response.residentName;
                            console.log('Resident Name:', residentName);
                            // Do something with the resident name
                        } else {
                            console.log('Error:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX Error:', error);
                    }
                });

            } else {
                alert('Please select a room before submitting.');
            }
        });
    });

  </script>

</body>
</html>