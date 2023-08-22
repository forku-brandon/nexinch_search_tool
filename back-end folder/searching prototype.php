<?php
/* this php code collect data entered by the user and stores it in the $data variable*/
$data = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["data"])) {
    $Err = "Data is required";
  } else {
    $data = $_POST["data"];
  }
}
?>



<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width, initial-scale=1.0">
  <title>search input</title>

</head>

<body>
  <!-- contact form start -->
  <center>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <label for="data">
        <h4> data here</h4>
      </label><br><br>

      <input type="text" name="data" id="myInput" oninput="handleInput(event)" value=""><br>
      <span class="error"> <?php echo $Err; ?></span>
      <br><br>
      <input type="submit" name="submit">

    </form>
    <!-- contact form ends here-->
    <div id="display">

    </div>
  </center>
  <script>
    function handleInput(event) {
      var inputValue = event.target.value;
      // Display the input value
      document.getElementById("display").innerHTML = inputValue;
    }
  </script>
</body>

</html>

<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "crudDB";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data
$capitalizedSentence = ucfirst($data);

//
$sqll = "SELECT * FROM `search-engine`  WHERE `header` LIKE '%$capitalizedSentence%'";
$resut = $conn->query($sqll);
if ($resut->num_rows > 0) {
  // Output data of each row
  echo "<h4>" . "result: " .  "</h4>";
  while ($row = $resut->fetch_assoc()) {
    $content = $row["content"];
    //asign the 'more data' row of the data base to the link variable
    $link = $row["more data"];
    //starting the sesion 
    session_start();
    //the $link variable is store in the session
    $_SESSION['myVariable'] = $link;
    //printing the title
    echo    "<h5>" . $row['header'] .  "</h5>" . "<br>";
    // editing the code to look presentable on the screen
    $parts = preg_split('/(?<=[.:])\s+/', $content);

    foreach ($parts as $part) {
      echo trim($part) . "<br><br>";
    }
    // end editing 
    // this link directs you to the 'your-php-script.php' where the $link variable is displayed
    echo  "<a href='your-php-script.php?link_clicked=true'>" . "click here to see more" . "</a><br>";
  }
  //link stop
} else {
  echo "No results found.";
}
// Query to display similar search  data
$sql = "SELECT * FROM `search-engine`  WHERE UPPER(`header`) LIKE UPPER('%$capitalizedSentence%')";
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
  // Output data of each row
  echo  "<br><h4>" . "similar search questions: " .  "</h4>";
  while ($row = $result->fetch_assoc()) {
    echo "<a href='#'>" . $row["header"] . "</a><br><br>";
  }
} else {
  echo "No  found.";
}

// Close the connection
$conn->close();
?>




<?php
/*
$mysqli = require __DIR__ . "/conn.php";

$sql = "SELECT `ID`, `header`, 'content' FROM search-engine WHERE `header`='$data'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc())
  {

    echo  $row['header'] . "<br>";
    echo $row['content'];

 }}else {

  echo  "invalid " . "</p>";
}

$mysqli->close();

$conn->close();
?>
</form>
*/
?>