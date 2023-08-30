<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./fontawesome-free-6.4.2-web/css/all.css" />
  <!-- link to stylesheet -->
  <link rel="stylesheet" href="Settings.css" />
    <title>Learn more</title>
</head>
<body>
   <div>
   <a href="result.php">
      <i class="fa fa-arrow-left fa-lg" style="width: 10px; color: black" aria-hidden="true" id="arrow"></i>
      <p>move back</p>
        </a>
      <center>  <img src="images/Nexinch logo.png"  alt=""></center>

   </div> 
</body>
</html>

<?php
// Check if the link has been clicked
if (isset($_GET['link_clicked'])) {
    // Set the variable to true
    $isClicked = "This section of the system is still under developement ";
} else {
    // Set the variable to false or initialize it
    $isClicked = "error occured";
}
?>


<!-- Display the variable value -->
<p> <?php echo "<center><h1 style='color:green;'>".$isClicked ."</h1></center> " ?></p>
<?php

session_start();
echo $_SESSION['myVariable'];  // Output: Hello, world!


?>
