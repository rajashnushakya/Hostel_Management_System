<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2 class="my-4">Payment Details</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Name of Resident</th>
                <th scope="col">Room</th>
                <th scope="col">Payment</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection
            include('connection.php');

            // Fetch data from database
            $query = "SELECT * FROM payments";
            $result = $mysqli->query($query);

            // Check if records exist
            if ($result->num_rows > 0) {
                // Loop through each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $row['id'] . "</th>";
                    echo "<td>" . $row['resident_name'] . "</td>";
                    echo "<td>" . $row['room_number'] . "</td>";
                    echo "<td>$" . $row['payment_amount'] . "</td>";
                    echo "</tr>";
                }
            } else {
                // If no records found
                echo "<tr><td colspan='4'>No payment records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JavaScript and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
