<?php

$servername = "localhost"; // Replace with your actual server name
$username = "root"; // Replace with your actual username
$password = ""; // Replace with your actual password
$dbname = "crudDB"; // Replace with your actual database name

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  
} catch (PDOException $e) {
    // Display an error message
    echo "Connection failed: " . $e->getMessage();
}

// Assuming you have already established a database connection ($pdo) and retrieved user signup data

// Retrieve user signup data
$username = 'brandon'; // Assuming you have a form field for username
$email = 'email'; // Assuming you have a form field for email

// Insert user signup data into the users table
$query = "INSERT INTO test (username, email) VALUES (:username, :email)";

$stmt = $pdo->prepare($query);

$stmt->bindParam(':username', $username);

$stmt->bindParam(':email', $email);

//if ($stmt->execute()) {
//echo "hello";
//}
// Create a user activity table for the new user
$activityTableName = 'user_activity_' . $username; // Generate a unique table name
$query = "CREATE TABLE $activityTableName (
    activity_id INT AUTO_INCREMENT PRIMARY KEY,
    activity_description VARCHAR(255),
    activity_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$pdo->exec($query);

// Store a sample user activity in the newly created table
$sampleActivity = "User $username signed up.";
$query = "INSERT INTO $activityTableName (activity_description) VALUES (:activity)";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':activity', $sampleActivity);
$stmt->execute();

// Display success message
  
header("Location: searching prototype.php");
exit;
?>