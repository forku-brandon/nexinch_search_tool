<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>


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

session_start();

$activityTableName = 'user_activity_' . $username; // Generate a unique table name
$_SESSION['activity']=$activityTableName;

 $quer = "INSERT INTO `$activityTableName` (`id`, `activity_description`, `email`,
  `username`, `activity_timestamp`, `search_history`, `images`, `comments`) 
 VALUES (NULL, '', '', '', current_timestamp(), '', '$target_file', '')";
$stmt = $pdo->prepare($quer);
$stmt->execute();

echo " success";
?>