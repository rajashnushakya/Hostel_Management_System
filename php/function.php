<?php

require 'Connection.php';

function getResidentList() {
    global $conn;

    $query = "SELECT * FROM resident";
    $query_run = mysqli_query($conn, $query);
    //$num_rows = mysqli_num_rows($query_run);
    //echo "Number of rows: " . $num_rows; 

    if (!$query_run) {
        $data = array(
            'status' => 500,
            'message' => 'Query Execution Error: ' . mysqli_error($conn), 
        );
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($data);
    } else {
        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $data = array(
                'status' => 200,
                'message' => 'Successfully fetched data', 
                'data' => $res
            );
            header("HTTP/1.0 200 OK");
            echo json_encode($data);
        } else {
            $data = array(
                'status' => 404,
                'message' => 'No resident found', 
            );
            header("HTTP/1.0 404 Not Found");
            echo json_encode($data);
        }
    }
}

?>
