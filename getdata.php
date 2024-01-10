<?php
// This is a simplified example, and you should handle database connections securely
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected value from the request
$selectedValue = $_GET["selectedValue"];

// Prepare and execute the SQL query
$sql = "SELECT id, value FROM data WHERE main_value = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $selectedValue);
$stmt->execute();

$result = $stmt->get_result();

// Fetch the results into an associative array
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Close the connection and send the JSON response
$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
