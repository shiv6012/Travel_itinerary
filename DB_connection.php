<?php
// **DATABASE CONNECTION DETAILS**
$servername = "localhost"; // Replace with your server name
$db_username = "root"; // Replace with your database username
$db_password = ""; // Replace with your database password
$dbname = "Travel"; // Replace with your database name

$con = mysqli_connect($servername, $db_username, $db_password, $dbname);
if(!$con) {
    die("Connection failed: " . mysqli_error($con));
}






















// try {
//     $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
//     // Set the PDO error mode to exception
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch(PDOException $e) {
//     die("Database connection failed: " . $e->getMessage());
// }

// // Handle Signup Form Submission
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup_submit"])) {
//     $signup_username = $_POST["signup_username"];
//     $signup_email = $_POST["signup_email"];
//     $signup_password = $_POST["signup_password"];

//     // **IMPORTANT:** Perform proper validation and sanitization of the input data!

//     // Securely hash the password
//     $hashed_password = password_hash($signup_password, PASSWORD_DEFAULT);

//     try {
//         // Prepare and execute the SQL query to insert user data
//         $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
//         $stmt->bindParam(':username', $signup_username);
//         $stmt->bindParam(':email', $signup_email);
//         $stmt->bindParam(':password', $hashed_password);
//         $stmt->execute();

//         echo "<h2>Signup successful!</h2>";
//         echo "You can now log in with your email and password.";
//         // Optionally, redirect to the login page
//         // header("Location: index.html?signup=success");
//         // exit();

//     } catch(PDOException $e) {
//         echo "<h2>Signup failed.</h2>";
//         echo "Error: " . $e->getMessage();
//         // Consider logging the error for debugging
//     }
// }

// // Handle Login Form Submission
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login_submit"])) {
//     $login_email = $_POST["login_email"];
//     $login_password = $_POST["login_password"];

//     // **IMPORTANT:** Perform proper validation and sanitization of the input data!

//     try {
//         // Prepare and execute the SQL query to retrieve user data by email
//         $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE email = :email");
//         $stmt->bindParam(':email', $login_email);
//         $stmt->execute();
//         $user = $stmt->fetch(PDO::FETCH_ASSOC);

//         if ($user) {
//             // Verify the password
//             if (password_verify($login_password, $user['password'])) {
//                 // Successful login - you would typically set session variables here
//                 echo "<h2>Login successful!</h2>";
//                 echo "Welcome, " . htmlspecialchars($user['username']) . "!";
//                 // Redirect to a logged-in page
//                 // session_start();
//                 // $_SESSION['user_id'] = $user['id'];
//                 // $_SESSION['username'] = $user['username'];
//                 // header("Location: dashboard.php");
//                 // exit();
//             } else {
//                 // Incorrect password
//                 echo "<h2>Login failed.</h2>";
//                 echo "Invalid email or password.";
//                 // Optionally, redirect back to the login page with an error message
//                 // header("Location: index.html?error=login");
//                 // exit();
//             }
//         } else {
//             // User not found
//             echo "<h2>Login failed.</h2>";
//             echo "Invalid email or password.";
//             // Optionally, redirect back to the login page with an error message
//             // header("Location: index.html?error=login");
//             // exit();
//         }

//     } catch(PDOException $e) {
//         echo "<h2>Login failed.</h2>";
//         echo "Error: " . $e->getMessage();
//         // Consider logging the error for debugging
//     }
// }

// // If someone tries to access this file directly without submitting a form
// if ($_SERVER["REQUEST_METHOD"] != "POST") {
//     header("Location: index.html");
//     exit();
// }
// ?>