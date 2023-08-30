<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image = $_FILES["image"]["tmp_name"];
        $imageName = $_FILES["image"]["name"];
        
        // Read the file content
        $imageData = file_get_contents($image);

    } else {
        echo "No image file uploaded.";
    }
}


?>

<!DOCTYPE html>
<html>
<head>
  <title>  Select image to upload</title>
  <link rel="stylesheet" href="./fontawesome-free-6.4.2-web/css/all.css" />

  <link rel="stylesheet" type="text/css" href="styles.css">
  <style>
    body {
  background-color:  rgb(47, 48, 48);
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.login-container {
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  margin: 100px auto;
  max-width: 400px;
  padding: 20px;
  text-align: center;
}

h2 {
  color: #333;
  margin-bottom: 30px;
}

input {
  padding: 10px;
  margin-bottom: 20px;
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.button {
  background-color: #4CAF50;
  border: none;
  color: #fff;
  cursor: pointer;
  padding: 10px;
  width: 100%;
  border-radius: 5px;
}

.button:hover {
  background-color: #45a049;
}
  </style>
</head>
<body>
<a href="settings.php">
      <i class="fa fa-arrow-left fa-lg" style="width: 10px; color: white" aria-hidden="true" id="arrow"></i>
        </a>
  <div class="login-container">
    <h2>UPDATE IMAGE</h2>
    <img src="images/Nexinch logo.png" style="width:70px;height:70px;" alt="">

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    <input type="file" name="image" accept="image/*" required>
    <input type="submit" value="Upload Image"  class="button ">
    </form>
  </div>
</body>
</html>
<?php
// Database connection details



        $servername = "localhost"; // Replace with your actual server name
        $username = "root"; // Replace with your actual username
        $password = ""; // Replace with your actual password
        $dbname = "crudDB"; // Replace with your actual database name

        // Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
        //start session
        session_start();

        $activityTableName = 'user_activity_' . $username; // Generate a unique table name
        $_SESSION['activity']=$activityTableName;
        //insert the data into the user activity table
      
        $quer = "INSERT INTO `$activityTableName` (`id`, `activity_description`, `email`,
        `username`, `activity_timestamp`, `search_history`, `images`, `comments`) 
       VALUES (NULL, '', '', '', current_timestamp(), '', '$imageName', '$imageData')";
               // Prepare and execute the SQL query

      $stmt = $pdo->prepare($quer);
      $stmt->execute();
      
        if ($stmt->affected_rows > 0) {
            echo "Image uploaded successfully!";
        } else {
            echo "Error uploading image.";
        }

        $stmt->close();
   
$conn->close();
?>
