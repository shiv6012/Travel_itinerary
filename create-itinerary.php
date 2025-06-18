<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION["user_id"])) {
    header("Location: log-in.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Travel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$itinerary_error = "";
$itinerary_success = "";

// Initialize form values to prevent undefined variable warnings
$destination = "";
$travel_date = "";
$activities = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>$_POST Array:\n";
    print_r($_POST);
    echo "</pre>";

   $user_id = $_SESSION['user_id']; // Get the user ID from the session
    $destination = $_POST['destination'];
    $travel_date = $_POST['travel_date'];
    $activities = $_POST['activities'];

    $sql = "INSERT INTO itineraries (user_id, destination, travel_date, activities, created_at) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("isss", $user_id, $destination, $travel_date, $activities);

        echo "<p>Attempting to execute SQL: " . htmlspecialchars($sql) . "</p>";

        if ($stmt->execute()) {
            echo "<p style='color: green;'>execute() returned true</p>";
            $itinerary_success = "Itinerary created successfully!";
            $destination = "";
            $travel_date = "";
            $activities = "";
        } else {
            $error_message = $stmt->error;
            echo "<p style='color: red;'>execute() returned false. Error: " . htmlspecialchars($error_message) . "</p>";
            $itinerary_error = "Error creating itinerary: " . $error_message;
        }

        $stmt->close();
    } else {
        $error_message = $conn->error;
        echo "<p style='color: red;'>Error preparing SQL: " . htmlspecialchars($error_message) . "</p>";
        $itinerary_error = "Error preparing SQL statement: " . $error_message;
    }
}

$conn->close();
?>