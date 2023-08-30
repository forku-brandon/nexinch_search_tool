<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Settings</title>
  <!-- link to font awesome -->
  <link rel="stylesheet" href="./fontawesome-free-6.4.2-web/css/all.css" />
  <!-- link to stylesheet -->
  <link rel="stylesheet" href="Settings.css" />
  <style>
    .button {
  background-color:rgb(43, 43, 233);
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
  <div class="container">
    <div class="header">
    <a href=" searching prototype.php">
      <i class="fa fa-arrow-left fa-lg" style="width: 10px; color: white" aria-hidden="true" id="arrow"></i>
        </a>
      <h2 id="Settings">Settings</h2>
    </div>
    <div class="profile">
      <h2>Profile</h2>
      <div class="profile-card">
        <img src="./images/PRO.jpg" alt="" class="profile-img" />
        <br />
        <center>
          <?php
          //connect to the data base
        $mysqli = require __DIR__ . "/conn.php";
          //start the session and asign the activity variable to $name
        session_start();
        $name = $_SESSION['activity'];
        //selecting every thing from the user activity table
                  $sql = "SELECT * FROM `$name` WHERE 1";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    // output data of each row
                    $row = $result->fetch_assoc();
             
                  //display the data out
       echo ' <h2 style="color:aliceblue;">user name</h2>';
         echo    ' <h4 style="color:aliceblue;">' . $row["username"] . '</h4>';
         echo '<br>';
        echo '<h2 style="color:aliceblue;">Email</h2>';
         echo    ' <h4 style="color:aliceblue;">' . $row["email"] . '</h4>';

     echo '<br><br>' . '<a href="update image.php" class="button">change image</a></center>';
                  }
       ?>
      </div>
    </div>
    <div class="darkmode">
      <h2>Dark Mode</h2>
      <div class="btn">
        <button type="submit">ON</button> <button type="submit">OFF</button>
      </div>
    </div>
    <div class="logout">
      <button type="submit">Log Out</button>
    </div>
  </div>
  <script src="profile.js"></script>
</body>

</html>