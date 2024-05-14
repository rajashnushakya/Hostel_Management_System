<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Staff Details</title>
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

      <h2>Resident Details</h2>
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
                // Add buttons for actions (Edit and Delete)
                echo "<td>
                        <button class='btn btn-edit' onclick='editRow(this)'>Edit</button>
                        <button class='btn btn-delete' onclick='showConfirmation()'>Delete</button>
                      </td>";
                echo "</tr>";
            }
        } else {
            // If no records found
            echo "<tr><td colspan='8'>No staff found</td></tr>";
        }
        ?>
    </table>
</div>

    <!-- Popup for confirmation -->
    <div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
      <p>Are you sure you want to delete this room?</p>
      <button class="btn-confirm" onclick="deleteRoom()">Yes, Delete</button>
      <button class="btn-confirm" onclick="hideConfirmation()">Cancel</button>
    </div>

    <script>
      function showConfirmation() {
        document.getElementById("overlay").style.display = "block";
        document.getElementById("popup").style.display = "block";
      }

      function hideConfirmation() {
        document.getElementById("overlay").style.display = "none";
        document.getElementById("popup").style.display = "none";
      }

      function deleteRoom() {
        // Perform delete operation here
        //add backend logic here or write a php script to delete the data
        hideConfirmation();
      }

      function editRow(button) {
        var row = button.parentNode.parentNode;
        var cells = row.getElementsByTagName("td");

        // Toggle contenteditable attribute for each cell
        for (var i = 1; i < cells.length - 1; i++) {
          if (cells[i].contentEditable === "true") {
            cells[i].contentEditable = "false";
          } else {
            cells[i].contentEditable = "true";
          }
        }

        // Toggle button text between Edit and Save
        if (button.innerHTML === "Edit") {
          button.innerHTML = "Save";
          button.classList.remove("btn-edit");
          button.classList.add("btn-save");
          button.setAttribute("onclick", "saveRow(this)");
        } else {
          button.innerHTML = "Edit";
          button.classList.remove("btn-save");
          button.classList.add("btn-edit");
          button.setAttribute("onclick", "editRow(this)");
          // Show popup for save action
          showSavePopup();
        }
      }

      function saveRow(button) {
        // Toggle button text back to Edit
        button.innerHTML = "Edit";
        button.classList.remove("btn-save");
        button.classList.add("btn-edit");
        button.setAttribute("onclick", "editRow(this)");

        // Toggle contenteditable attribute for each cell
        var row = button.parentNode.parentNode;
        var cells = row.getElementsByTagName("td");
        for (var i = 1; i < cells.length - 1; i++) {
          cells[i].contentEditable = "false";
        }

        // Show popup for save action
        showSavePopup();
      }

      function showSavePopup() {
        alert("Changes saved successfully!");
      }
    </script>
 </body>
</html>