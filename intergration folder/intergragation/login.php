<?php

// define variables and set to empty values

$nameErr = $passwordErr = "";
$name = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    session_start();
    $_SESSION['name'] = $name;
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["password"])) {
    $passwordErr = "password is required";
  } else {
    $password = test_input($_POST["password"]);
  }
}


function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



//message();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="login.css">
  <title>login page</title>
  <style>
        body {
          background-color: rgb(47, 48, 48);
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.login-container {
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  margin: 100px auto;
  max-width: 400px;
  padding: 20px;
  text-align: center;
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

        <h1>login</h1>
        <div class="input-box">
          <input type="text" name="name" value="<?php echo $name; ?>" placeholder="user name">
          <span class="error"> <?php echo $nameErr; ?></span>

        </div>
        <div class="input-box">
          <input type="password" name="password" placeholder=" password" value="<?php echo $password; ?>" class="over_flow">
          <span class="error"> <?php echo $passwordErr; ?></span>
        </div>

        <input type="checkbox"><label for="remainber"> remainber me</label> <span></span> <a href="forget_password.php" style="color: rgb(46, 35, 192); text-decoration-line: none; float: right;">Forgot Password?</a><br>

        <br><br>
        <div class="button">
          <input type="submit" name="submit" value="login" style="width: 20vw; text-align: center;">
        </div><br><br>
        <label for="login">Not a member? <span><a href="signup.php" style="color: rgb(46, 46, 151); text-decoration-line: none; "> signup</a></span></label><br>

        <?php

        //$password=password_hash($_POST["password"], PASSWORD_DEFAULT);
        $mysqli = require __DIR__ . "/conn.php";

        $sql = "SELECT `name`, `password` FROM users WHERE `name`='$name' or `password`='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row
          $row = $result->fetch_assoc();
          if ($name == $row['name'] and password_verify($password, $row['password']) and !empty($_POST["name"])) {

            echo  $row['name'] . "name";
            echo "<p style='color: rgb(100, 228, 100);'>" . "login succesfull....." . "</p>";
           
            $activityTableName = 'user_activity_' . $name; // Generate a unique table name
          

              $_SESSION['activity']=$activityTableName;
            header("Location: searching prototype.php");
            exit;
          } else {
            echo "<p style=' color:rgb(238, 109, 109);'>" . "invalid uers name or password" . "</p>";
          }
        } else {

          echo "<p style=' color:rgb(238, 109, 109);'>" . "invalid username and password" . "</p>";
        }

        $mysqli->close();

        $conn->close();
        ?>
      </form>

    </div>
  </center>


</body>

</html>
<?php
