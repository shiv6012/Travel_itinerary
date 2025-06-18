<?php
session_start();

// Database connection details (replace with your actual credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Travel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = $_POST["email"];
    $password = $_POST["password"];

    // Perform your user authentication logic here
    $sql = "SELECT id, password FROM users WHERE username=? OR email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username_or_email, $username_or_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Directly compare the entered password with the password from the database
        if ($password == $row["password"]) {
            // Authentication successful!
            $_SESSION["user_id"] = $row["id"]; // Store the user's ID from the database in the session
            echo "<p>User ID set in session after login: " . $_SESSION["user_id"] . "</p>"; // Debugging line
            header("Location: create-itinerary.html"); // Redirect to the itinerary creation page
            exit();
        } else {
            $login_error = "Incorrect password.";
            echo "<p style='color: red;'>Incorrect password.</p>"; // Display error
        }
    } else {
        $login_error = "User not found.";
        echo "<p style='color: red;'>User not found.</p>"; // Display error
    }

    $stmt->close();
}

$conn->close();
?>