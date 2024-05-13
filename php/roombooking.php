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
  </style>
</head>
<body>
    <!-- Room Details -->
    <div class="container">
      <div class="row mb-3 mb-3-custom">
        <h1 class="col-sm-2">Room Booking</h1>
      </div>    
      <div>
        <table class="table">
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
              echo "<tr>";
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
          <button type="button" class="btn btn-primary btn-sm me-2">Submit</button>
          <button type="button" class="btn btn-secondary btn-sm">Back</button>
        </div>
      </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
