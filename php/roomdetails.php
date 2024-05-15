<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add your CSS styles here */
        /* Just basic styling for demonstration purposes */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative; /* Added */
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            background-color: #4caf50;
            color: #fff;
            font-size: 14px;
        }

        .btn-edit {
            background-color: #2196f3;
        }

        .btn-save {
            background-color: #ffc107;
        }

        .btn-delete {
            background-color: #f44336;
        }

        /* Styles for the popup */
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            display: none;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
        }

        .btn-confirm {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Style for the cross button */
        .cross-button {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Cross button to go back to main.html -->
    <a href="dashboard.html" class="cross-button">&#10006;</a>

    <h2>Room Details</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Seater</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php
        // Database connection
        include('connection.php');

        // Fetch data from database
        $query = "SELECT * FROM rooms";
        $result = $mysqli->query($query);

        // Check if records exist
        if ($result->num_rows > 0) {
            // Loop through each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['room_name'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td>" . $row['seater'] . "</td>";
                echo "<td>" . $row['fee'] . "</td>";
                echo "<td>
                <button class='btn btn-edit' data-id='" . $row['id'] . "' onclick='editRow(this)'>Edit</button>
                <button class='btn btn-delete' data-id='" . $row['id'] . "' onclick='deleteRoom(this)'>Delete</button>
                      </td>";
                echo "</tr>";
            }
        } else {
            // If no records found
            echo "<tr><td colspan='6'>No rooms found</td></tr>";
        }
        ?>
    </table>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Room Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editRoomForm">
                    <div class="form-group">
                        <label for="editRoomName">Room Name:</label>
                        <input type="text" class="form-control" id="editRoomName" name="editRoomName" required>
                    </div>
                    <div class="form-group">
                        <label for="editCategory">Category:</label>
                        <input type="text" class="form-control" id="editCategory" name="editCategory" required>
                    </div>
                    <div class="form-group">
                        <label for="editSeater">Seater:</label>
                        <input type="text" class="form-control" id="editSeater" name="editSeater" required>
                    </div>
                    <div class="form-group">
                        <label for="editFee">Price:</label>
                        <input type="text" class="form-control" id="editFee" name="editFee" required>
                    </div>
                    <input type="hidden" id="editId" name="editId">
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this resident?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="deleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function editRow(button) {
        const id = button.getAttribute("data-id");
        $.ajax({
            url: 'get_room.php', // This PHP file will fetch the room details based on the ID
            type: 'GET',
            data: { id: id },
            success: function(response) {
                const data = JSON.parse(response);
                $('#editId').val(data.id);
                $('#editRoomName').val(data.room_name);
                $('#editCategory').val(data.category);
                $('#editSeater').val(data.seater);
                $('#editFee').val(data.fee);
                $('#editModal').modal('show');
            }
        });
    }

    $('#editRoomForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        $.ajax({
            url: 'update_room.php', // This PHP file will update the room details
            type: 'POST',
            data: formData,
            success: function(response) {
                location.reload(); // Reload the page to see the changes
            }
        });
    });

    function deleteRoom(button) {
        const id = button.getAttribute("data-id");
        $('#deleteModal').modal('show');
        $('#deleteButton').off('click').on('click', function() {
            $.ajax({
                url: 'delete_room.php', // This PHP file will delete the room based on the ID
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    location.reload(); // Reload the page to see the changes
                }
            });
        });
    }
</script>
</body>
</html>
