<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Resident Details</title>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <style>
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
        position: relative;
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
      <a href="dashboard.php" class="cross-button">&#10006;</a>
      <h2>Resident Details</h2>
      <table>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>City</th>
          <th>Email</th>
          <th>Mobile Number</th>
          <th>Gender</th>
          <th>Actions</th>
        </tr>
        <?php
        include('connection.php');
        $query = "SELECT * FROM resident";
        $result = $mysqli->query($query);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['firstname'] . "</td>";
            echo "<td>" . $row['lastname'] . "</td>";
            echo "<td>" . $row['city'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['mobile_number'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>
                    <button class='btn btn-edit' data-id='" . $row['id'] . "' onclick='editRow(this)'>Edit</button>
                    <button class='btn btn-delete' data-id='" . $row['id'] . "' onclick='confirmDelete(this)'>Delete</button>
                  </td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='8'>No residents found</td></tr>";
        }
        ?>
      </table>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Resident Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="editResidentForm">
              <div class="form-group">
                <label for="editFirstName">First Name:</label>
                <input type="text" class="form-control" id="editFirstName" name="editFirstName" required>
              </div>
              <div class="form-group">
                <label for="editLastName">Last Name:</label>
                <input type="text" class="form-control" id="editLastName" name="editLastName" required>
              </div>
              <div class="form-group">
                <label for="editCity">City:</label>
                <input type="text" class="form-control" id="editCity" name="editCity" required>
              </div>
              <div class="form-group">
                <label for="editEmail">Email:</label>
                <input type="email" class="form-control" id="editEmail" name="editEmail" required>
              </div>
              <div class="form-group">
                <label for="editMobileNumber">Mobile Number:</label>
                <input type="text" class="form-control" id="editMobileNumber" name="editMobileNumber" required>
              </div>
              <div class="form-group">
                <label for="editGender">Gender:</label>
                <select class="form-control" id="editGender" name="editGender" required>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
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
          url: 'get_resident.php', // This PHP file will fetch the resident details based on the ID
          type: 'GET',
          data: { id: id },
          success: function(response) {
            const data = JSON.parse(response);
            $('#editId').val(data.id);
            $('#editFirstName').val(data.firstname);
            $('#editLastName').val(data.lastname);
            $('#editCity').val(data.city);
            $('#editEmail').val(data.email);
            $('#editMobileNumber').val(data.mobile_number);
            $('#editGender').val(data.gender);
            $('#editModal').modal('show');
          }
        });
      }

      $('#editResidentForm').on('submit', function(e) {
        e.preventDefault();
        const id = $('#editId').val();
        const firstname = $('#editFirstName').val();
        const lastname = $('#editLastName').val();
        const city = $('#editCity').val();
        const email = $('#editEmail').val();
        const mobile_number = $('#editMobileNumber').val();
        const gender = $('#editGender').val();

        $.ajax({
          url: 'update_resident.php', // This PHP file will handle the update request
          type: 'POST',
          data: {
            id: id,
            firstname: firstname,
            lastname: lastname,
            city: city,
            email: email,
            mobile_number: mobile_number,
            gender: gender
          },
          success: function(response) {
            alert("Resident details updated successfully!");
            $('#editModal').modal('hide');
            location.reload(); // Reload the page to see the updated details
          }
        });
      });

      function confirmDelete(button) {
        const id = button.getAttribute("data-id");
        $('#deleteButton').attr("data-id", id);
        $('#deleteModal').modal('show');
      }

      $('#deleteButton').on('click', function() {
        const id = $(this).attr("data-id");

        $.ajax({
          url: 'delete_resident.php', // This PHP file will handle the delete request
          type: 'POST',
          data: { id: id },
          success: function(response) {
            alert(response);
            $('#deleteModal').modal('hide');
            location.reload(); // Reload the page to see the updated details
          }
        });
      });
    </script>
  </body>
</html>
