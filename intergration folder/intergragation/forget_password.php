
<?php
//define variables and set to empty values
$emailErr = " ";
  $email = " ";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {

    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }else{
        header("Location: enter_password.php");
exit;

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
    <link rel="stylesheet" href="login.css">
    <style>
              body {
                background-color: rgb(47, 48, 48);
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}
    </style>
    <title> forgot Password?</title>
</head>

<body >

    <br><br>
    <center>
        <div class="container" style="height: 50vh ; width:25%">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <img src="images/Nexinch logo.png" style="width:70px;height:70px;" alt="">

                <h1 style="color: rgb(108, 107, 106);"> forget Password</h1>

                <div class="input-box">
                    <label for="email" style="color: darkgray; float: left;"> Email</label> <br>
                    <input type="email" placeholder=" text@gmail.com" name="email" value="<?php echo $email; ?>">

                    <span class="error"><?php echo $emailErr; ?></span>

                </div>
                <br>
                <br>
                <div class="button">
                <input type="submit" name="submit" value="send code" style="width: 20vw; text-align: center;">

            </div><br><br>
                <label for="login">already have and acount? <span><a href="signup.php" style="color: rgb(46, 46, 151); text-decoration-line: none; "> signup</a></span></label><br>

                <br><br>
            </form>


        </div>

    </center>
</body>
</html>

<?php
?>