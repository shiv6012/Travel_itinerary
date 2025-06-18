<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: log-in.php");
    exit();
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Travel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION["user_id"];

// Fetch itineraries for the logged-in user
$sql = "SELECT id, destination, travel_date, activities, created_at FROM itineraries WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$itineraries = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $itineraries[] = $row;
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Your Itineraries</title>
   
    <link rel="stylesheet" href="styles.css"> 
    <style>
        
table {
    width: 80%; /* Adjust the width as needed */
    margin: 20px auto; /* Top and bottom margin (adjust as needed), auto for horizontal centering */
    border-collapse: collapse; /* Optional: Collapse borders for a cleaner look */
  }
  
  th, td {
    border: 1px solid #ccc; /* Optional: Add borders for visibility */
    padding: 8px;
    text-align: left; /* Optional: Align text within cells */
  }
  
  th {
    background-color: #f2f2f2; /* Optional: Style table header */
  }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1>Travel Itinerary</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="log-in.html">Log-in</a></li>
                <li><a href="create-itinerary.html">Create Itinerary</a></li>
                <li><a href="view-itinerary.php">View Itinerary</a></li>
            </ul>
        </nav>
    </header>

    
        <h1>Your Travel Itineraries</h1>

        <?php if (empty($itineraries)): ?>
            <p>You haven't created any itineraries yet.</p>
            <p><a href="create-itinerary.php">Create a new itinerary</a></p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Destination</th>
                        <th>Travel Date</th>
                        <th>Activities</th>
                        <th>Created At</th>
                        </tr>
                </thead>
                <tbody>
                    <?php foreach ($itineraries as $itinerary): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($itinerary["destination"]); ?></td>
                            <td><?php echo htmlspecialchars($itinerary["travel_date"]); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($itinerary["activities"])); ?></td>
                            <td><?php echo htmlspecialchars($itinerary["created_at"]); ?></td>
                            </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    

    <footer>
        <div class="footer-content">
            <p>&copy; 2025 Travel Itinerary App. All rights reserved.</p>
        </div>
    </footer>

    <script src="scripts.js"></script> </body>
</html>