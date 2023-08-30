<?php


echo $email;

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
    <title> INSERT Password?</title>
</head>

<body>

    <br><br><br><br>

    <center>
        <div>
            <div class="container" style=" height: 40vh;">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="input-box">
                    <img src="images/Nexinch logo.png" style="width:70px;height:70px;" alt="">

                        <label for="send code" style="color: darkgray; float: left;"> A code has been send to your email kindly input the code here</label> <br>
                        <input type="">
                    </div>
                    <br>
                    <br>
                    <div class="button">
                        <input type="submit" value="Resend code" style="text-align: center;">
                        
                    </div><br><br><br>
                    <label for="login">click here to<span><a href="forget_password.php" style="color: rgb(46, 46, 151); text-decoration-line: none; "> enter email </a></span></label><br>

                </form>
            </div>
    </center>
    <br><br>
    </div>

</body>

</html>