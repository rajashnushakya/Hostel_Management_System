<?php
// Include connection
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "hms";

// Connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// If connection failed
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
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
      cursor: pointer; /* Add cursor pointer for better UX */
    }
    .selected-row {
  background-color: #d1ecf1 !important; /* Change to your desired color */
  /* Or add a shadow */
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
}
    .room-booking {
      color: blue;
      font-size: 24px;
    }
    .selected-row {
      background-color: #d1ecf1 !important;
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
              <th scope="col">Name</th>
              <th scope="col">Category</th>
              <th scope="col">Seater</th>
              <th scope="col">Price</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Fetch data from the database and populate table rows dynamically
            $query = "SELECT * FROM rooms";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr data-room-id='" . $row["id"] . "'>";
                    echo "<th scope='row'>" . $row["id"] . "</th>";
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
        <button type="button" class="btn btn-primary btn-sm me-2" onclick="submitForm()">Submit</button>

          <button type="button" class="btn btn-secondary btn-sm">Back</button>
        </div>
      </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    let selectedRoomId = null;

    document.addEventListener("DOMContentLoaded", () => {

      const email = '<?php echo $_POST["email"]; ?>';
        const rows = document.querySelectorAll(".table tbody tr");
        rows.forEach(row => {
            row.addEventListener("click", () => {
                rows.forEach(r => r.classList.remove("selected-row")); // Remove the class from all rows
                row.classList.add("selected-row"); // Add the class to the clicked row
                selectedRoomId = row.getAttribute("data-room-id");
                console.log(selectedRoomId);
            });
        });
    });

    async function getResidentId(email) {
        const response = await fetch('../php/getResidentId.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email: email })
        });

        const result = await response.json();
        if (result.success) {
            return result.residentId;
        } else {
            throw new Error('Error fetching resident ID: ' + result.error);
        }
    }

    async function bookRoom() {
        if (!selectedRoomId) {
            alert("Please select a room first.");
            return;
        }

        let email = localStorage.getItem("email");

            let residentId = await getResidentId(email);

            let data = {
                roomId: selectedRoomId,
                residentId: residentId
            };

            const response = await fetch("../php/bookRoom.php", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();
            if (result.success) {
                alert('Room booked successfully');
            } else {
                alert('Error booking room: ' + result.error);
            }
    }

    // Check if a row is selected before submitting
    function submitForm() {
        if (selectedRoomId) {
            bookRoom();
        } else {
            alert("Please select a room first.");
        }
    }
</script>

</body>
</html>
<?php
$conn->close();
?>