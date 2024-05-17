<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <title>To do task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Your custom CSS styles */
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
        <h1>To do task</h1>
    
        <!-- Request from Resident -->
        <h2>Number of tasks: 4</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <form method="post" action="" name="registration" class="form-horizontal" onSubmit="return valid();">
                            <div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">S.No</th>
                                            <th scope="col">My Task</th>
                                            <th scope="col">Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include('connection.php');
                                    $query = "SELECT * FROM request";
                                    $result = $mysqli->query($query);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['request_text'] . "</td>";
                                            echo "<td><button onclick=\"markAsDone(this, '" . $row['id'] . "')\">Done</button></td>"; // Pass task ID to markAsDone function
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>No tasks found</td></tr>"; // Corrected colspan value
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function markAsDone(button, taskId) {
            // Confirm before deleting
            if (confirm("Are you sure you want to mark this task as done and delete it?")) {
                // Send an AJAX request to delete the task
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "deleteTask.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Remove the row from the table
                        button.parentNode.parentNode.remove();
                        // Show a success message
                        alert("Task marked as done and deleted successfully.");
                    }
                };
                xhr.send("taskId=" + taskId);
            }
        }
    </script>
</body>
</html>
