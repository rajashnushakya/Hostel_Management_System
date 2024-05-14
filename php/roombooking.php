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
      margin-bottom: 1.5rem; /* Adjust as needed */
    }
    .table {
      margin-top: 20px;
      width: 100%;
      border-collapse: collapse;
    }
    .table th, .table td {
      border: 1px solid #dee2e6;
      padding: 8px;
    }
    .table th {
      background-color: #f2f2f2;
    }
    .table tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    .table tbody tr:hover {
      background-color: #f0f0f0;
    }
    .room-booking {
      color: blue;
      font-size: 24px;
    }
  </style>
</head>
<body>
    <!-- Room Details -->
    <div class="container">
      <div class="row mb-3 mb-3-custom">
        <h1 class="col-sm-10">
          <span class="room-booking">Room Booking</span>
        </h1>
      </div>    
      <div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Room Number</th>
              <th scope="col">Name</th>
              <th scope="col">Category</th>
              <th scope="col">Seater</th>
              <th scope="col">Price</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Fetch data from the database and populate table rows dynamically
            include('connection.php');
            $query = "SELECT * FROM rooms";
            $result = $mysqli->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $row["id"] . "</th>";
                    echo "<td>" . $row["room_number"] . "</td>";
                    echo "<td>" . $row["room_name"] . "</td>";
                    echo "<td>" . $row["category"] . "</td>";
                    echo "<td>" . $row["seater"] . "</td>";
                    echo "<td>$" . $row["fee"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No rooms found</td></tr>";
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
