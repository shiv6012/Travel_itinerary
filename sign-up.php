<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection details
$servername = "localhost"; // Replace with your database server name if different
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "Travel"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
echo "Connecting to database...<br>";
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"]; // In a real application, you should hash this!

    // Basic input validation (you should add more robust validation)
    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required.";
    } else {
        // Prepare the SQL statement to insert user data
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters and execute the statement
            $stmt->bind_param("sss", $username, $email, $password); // "sss" indicates three string parameters

            if ($stmt->execute()) {
                echo "Sign up successful!";
                // Optionally, you can redirect the user to a login page or another page
                header("Location: log-in.html");
                 exit();
            } else {
                echo "Error during sign up: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing SQL statement: " . $conn->error;
        }
    }
}

$conn->close();
?>