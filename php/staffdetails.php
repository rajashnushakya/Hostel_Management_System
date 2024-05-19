<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Details</title>
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
    <!-- Cross button to go back to dashboard.html -->
    <a href="dashboard.php" class="cross-button">&#10006;</a>

    <h2>Staff Details</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php
        // Database connection
        include('connection.php');

        // Fetch data from database
        $query = "SELECT * FROM staff";
        $result = $mysqli->query($query);

        // Check if records exist
        if ($result->num_rows > 0) {
            // Loop through each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['contact'] . "</td>";
                echo "<td>" . $row['role'] . "</td>";
                echo "<td>
                <button class='btn btn-edit' data-id='" . $row['id'] . "' onclick='editStaffRow(this)'>Edit</button>
                <button class='btn btn-delete' data-id='" . $row['id'] . "' onclick='deleteStaff(this)'>Delete</button>
                      </td>";
                echo "</tr>";
            }
        } else {
            // If no records found
            echo "<tr><td colspan='7'>No staff found</td></tr>";
        }
        ?>
    </table>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editStaffModal" tabindex="-1" role="dialog" aria-labelledby="editStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStaffModalLabel">Edit Staff Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editStaffForm">
                    <div class="form-group">
                        <label for="editFirstName">First Name:</label>
                        <input type="text" class="form-control" id="editFirstName" name="editFirstName" required>
                    </div>
                    <div class="form-group">
                        <label for="editLastName">Last Name:</label>
                        <input type="text" class="form-control" id="editLastName" name="editLastName" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email:</label>
                        <input type="email" class="form-control" id="editEmail" name="editEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="editMobile">Mobile Number:</label>
                        <input type="text" class="form-control" id="editMobile" name="editMobile" required>
                    </div>
                    <div class="form-group">
                        <label for="editRole">Role:</label>
                        <input type="text" class="form-control" id="editRole" name="editRole" required>
                    </div>
                    <input type="hidden" id="editStaffId" name="editStaffId">
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteStaffModal" tabindex="-1" role="dialog" aria-labelledby="deleteStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteStaffModalLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this staff member?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="deleteStaffButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function editStaffRow(button) {
        const id = button.getAttribute("data-id");
        $.ajax({
            url: 'get_staff.php', // This PHP file will fetch the staff details based on the ID
            type: 'GET',
            data: { id: id },
            success: function(response) {
                const data = JSON.parse(response);
                $('#editStaffId').val(data.id);
                $('#editFirstName').val(data.first_name);
                $('#editLastName').val(data.last_name);
                $('#editEmail').val(data.email);
                $('#editMobile').val(data.contact);
                $('#editRole').val(data.role);
                $('#editStaffModal').modal('show');
            }
        });
    }

    $('#editStaffForm').on('submit', function(e) {
        e.preventDefault();
        const id = $('#editStaffId').val();
        const firstName = $('#editFirstName').val();
        const lastName = $('#editLastName').val();
        const email = $('#editEmail').val();
        const mobile = $('#editMobile').val();
        const role = $('#editRole').val();

        $.ajax({
            url: 'update_staff.php', // This PHP file will handle the update request
            type: 'POST',
            data: {
                id: id,
                first_name: firstName,
                last_name: lastName,
                email: email,
                mobile_number: mobile,
                role: role
            },
            success: function(response) {
                alert("Staff details updated successfully!");
                $('#editStaffModal').modal('hide');
                location.reload(); // Reload the page to see the updated details
            }
        });
    });

    function deleteStaff(button) {
        const id = button.getAttribute("data-id");
        if (confirm("Are you sure you want to delete this staff member?")) {
            $.ajax({
                url: 'delete_staff.php', // This PHP file will handle the delete request
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    alert(response);
                    location.reload(); // Reload the page to see the updated details
                }
            });
        }
    }
</script>

</body>
</html>
