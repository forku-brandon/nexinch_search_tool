<?php
// define variables and set to empty values
$nameErr = $emailErr = $passwordErr = "";
$name = $email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    session_start();
  $_SESSION['name'] = $name; // Store the variable in a session variable
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>







<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>signup page</title>
  <link rel="stylesheet" href="login.css">
  <style>
        body {
          background-color: rgb(47, 48, 48);
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}
  </style>
</head>

<body >


  <div class="space">
  </div>
  <center>
    <div class="container">
  

      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <img src="images/Nexinch logo.png" style="width:70px;height:70px;" alt="">

        <h1>signup</h1>
        <div class="input-box">
          <input type="text" name="name" placeholder="username" value="<?php echo $name; ?>">
          <span class="error"> <?php echo $nameErr; ?></span>

        </div>
        <div class="input-box">
          <label for="email" style="color: darkgray; float: left;"> email</label> <br>
          <input type="email" placeholder=" text@gmail.com" name="email" value="<?php echo $email; ?>">
          <span class="error"><?php echo $emailErr; ?></span>
        </div>
        <div class="input-box">
          <br>

          <label for="password" style="color: darkgray; float: left;"> password</label>
          <input type="password" placeholder=" enter password" name="password" class="over_flow" value="<?php echo $password; ?>" class="over_flow">
          <span class="error"> <?php echo $passwordErr; ?></span>

        </div>
        <!-- <div class="input-box message-box">
                
              </div> --><br><br>
        <div class="button">
          <input type="submit" value="Create Account" value="Submit">
        </div><br><br>
        <label for="login">Already have an account? <span><a href="login.php" style="color: blueviolet; text-decoration-line: none;"> Login</a></span></label>
      </form>
    </div>
  </center>
</body>

</html>
<?php


$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
if (empty($_POST["email"])) {
  echo '';
} else {
  $mysqli = require __DIR__ . "/conn.php";
  $stmt = $conn->prepare("INSERT INTO `users`( `name`, `email`, `password`)  VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name,  $email, $password);

  if ($stmt->execute()) {

  }
  else{
  echo "<h1>" . "data exist" . "</h1>";
 
  }
 
  $stmt->close();
  $conn->close();
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


// Assuming you have already established a database connection ($pdo) and retrieved user signup data

// Retrieve user signup data
$username = $name; // Assuming you have a form field for username
$email =  $email;// Assuming you have a form field for email
// Insert user signup data into the users table
$query = "INSERT INTO test (username, email) VALUES (:username, :email)";

$stmt = $pdo->prepare($query);

$stmt->bindParam(':username', $username);

$stmt->bindParam(':email', $email);

//if ($stmt->execute()) {
//echo "hello";

session_start();

$activityTableName = 'user_activity_' . $username; // Generate a unique table name
$_SESSION['activity']=$activityTableName;
$query= "CREATE TABLE `crudDB`.`$activityTableName` (`id` INT(12) NOT NULL AUTO_INCREMENT , 
`activity_description` VARCHAR(300) NOT NULL , 
`email` VARCHAR(300) NOT NULL , 
`username` VARCHAR(300) NOT NULL ,
 `activity_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
`search_history` TEXT NOT NULL , 
`images` VARCHAR(300) NOT NULL ,
 `comments` VARCHAR(300)  NOT NULL , 
 PRIMARY KEY (`id`)) ENGINE = InnoDB;


";

$pdo->exec($query);

// Store a sample user activity in the newly created table
$sampleActivity = "User $username signed up.";

 $quer = "INSERT INTO `$activityTableName` (`id`, `activity_description`, `email`,
  `username`, `activity_timestamp`, `search_history`, `images`, `comments`) 
 VALUES (NULL, '$sampleActivity', '$email', '$username', current_timestamp(), '', '', '')";
$stmt = $pdo->prepare($quer);
$stmt->execute();

echo " conneted success";
// Display success message
  
header("Location: searching prototype.php");
exit;


?>