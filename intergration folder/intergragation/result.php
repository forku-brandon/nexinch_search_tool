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
$data = $_POST["data"];
?>







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
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- link to stylesheet -->
  <link rel="stylesheet" href="result.css" />
  <!-- link to icons -->
  <link rel="stylesheet" href="./fontawesome-free-6.4.2-web/css/all.css" />
  <title>Results</title>
</head>

<body>

  <div class="container">
    <br>
  <a href=" searching prototype.php">
      <i class="fa fa-arrow-left fa-lg" style="width: 10px; color: white" aria-hidden="true" id="arrow"></i>
        </a>
    <h2 id="header">Results</h2>


    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

      <input type="text" name="data" id="search-bar" placeholder="Search..." onkeyup="javascript:load_data(this.value)" onfocus="javascript:load_search_history()">
      <button type="submit">
        <i class="fa fa-search" aria-hidden="true"></i>
      </button>
    </form>

    <br />
    <div class="content" style="display:flex; width:95%">
      <div style="width: 60%">

        <?php
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
            echo    "<h3 id='header-links'>" . $row['header'] .  "</h3>" . "<br>";
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
          echo " ";
        }
        session_start();
       $name = $_SESSION['name']; // Store the variable in a session variable
        // Query to display similar search  data
        $sql = "SELECT * FROM `search-engine`  WHERE UPPER(`header`) LIKE UPPER('%$capitalizedSentence%')";
        $result = $conn->query($sql);
        //inserting the data into the search history table
         $sq= "INSERT INTO `user_activity_$name` (`id`,
           `activity_description`, `email`, `username`, 
          `activity_timestamp`, `search_history`, `images`, `comments`)
           VALUES (NULL, '', '', '', current_timestamp(), '$data', '', '')";
            $result = $conn->query($sq);
            if($result){
            
            }
        // Check if any rows were returned
        if ($result->num_rows > 0) {
          // Output data of each row
          echo  "<br><h4>" . "similar search questions: " .  "</h4>";
          while ($row = $result->fetch_assoc()) {
            echo "<a href='#'>" . $row["header"] . "</a><br><br>";
          }
        } else {
          echo "<br>" . "No link.";
        }
       
        // Close the connection
        $conn->close();
        ?>


      </div>

      <div style="width: 35%; display:content">
        <div class="accordian">
          <h2 class="accordian-title">FAQ</h2>
          <div class="content-container">
            <div class="question">
              <p style="color: black;"> What is Google?</p>
            </div>
            <div class="answer">
              <p style="color: black;"> Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                Praesentium, aliquid!</p>
            </div>
          </div>
          <div class="content-container">
            <div class="question">
              <p style="color: black;"> Where is Nexinch?</p>
            </div>
            <div class="answer">
              <p style="color: black;"> Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                Praesentium, aliquid! </p>
            </div>
          </div>
          <div class="content-container">
            <div class="question">
              <p style="color: black;"> How to Search? </p>
            </div>
            <div class="answer">
              <p style="color: black;">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                Praesentium, aliquid! </p>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</body>
<script src="accordion.js"></script>

</html>
<!--
<script>
  function delete_search_history(id) {
    fetch("result.php", {

      method: "POST",

      body: JSON.stringify({
        action: 'delete',
        id: id
      }),

      headers: {
        'Content-type': 'application/json; charset=UTF-8'
      }

    }).then(function(response) {

      return response.json();

    }).then(function(responseData) {
      load_search_history();
    });
  }

  function load_search_history() {
    var search_query = document.getElementsByName('search-bar')[0].value;

    if (search_query == '') {

      fetch("result.php", {

        method: "POST",

        body: JSON.stringify({
          action: 'fetch'
        }),

        headers: {
          'Content-type': 'application/json; charset=UTF-8'
        }

      }).then(function(response) {

        return response.json();

      }).then(function(responseData) {

        if (responseData.length > 0) {

          var html = '<ul class="list-group">';

          html += '<li class="list-group-item d-flex justify-content-between align-items-center"><b class="text-primary"><i>Your Recent Searches</i></b></li>';

          for (var count = 0; count < responseData.length; count++) {

            html += '<li class="list-group-item text-muted" style="cursor:pointer"><i class="fas fa-history mr-3"></i><span onclick="get_text(this)">' + responseData[count].search_query + '</span> <i class="far fa-trash-alt float-right mt-1" onclick="delete_search_history(' + responseData[count].id + ')"></i></li>';

          }

          html += '</ul>';

          document.getElementById('search-result').innerHTML = html;

        }

      });

    }
  }

  function get_text(event) {
    var string = event.textContent;

    //fetch api

    fetch("result.php", {

      method: "POST",

      body: JSON.stringify({
        search_query: string
      }),

      headers: {
        "Content-type": "application/json; charset=UTF-8"
      }
    }).then(function(response) {

      return response.json();

    }).then(function(responseData) {

      document.getElementsByName('search-bar')[0].value = string;

      document.getElementById('search_z').innerHTML = '';

    });



  }

  /*function load_data(query) {
    if (query.length > 2) {
      var form_data = new FormData();

      form_data.append('query', query);

      var ajax_request = new XMLHttpRequest();

      ajax_request.open('POST', 'process_data.php');

      ajax_request.send(form_data);

      ajax_request.onreadystatechange = function() {
        if (ajax_request.readyState == 4 && ajax_request.status == 200) {
          var response = JSON.parse(ajax_request.responseText);

          var html = '<div class="list-group">';

          if (response.length > 0) {
            for (var count = 0; count < response.length; count++) {
              html += '<a href="#" class="list-group-item list-group-item-action" onclick="get_text(this)">' + response[count].header + '</a>';
            }
          } else {
            html += '<a href="#" class="list-group-item list-group-item-action disabled">No Data Found</a>';
          }

          html += '</div>';

          document.getElementById('search_result').innerHTML = html;
        }
      }
    } else {
      document.getElementById('search_result').innerHTML = '';
    }
  }*/

  /*var ignore_element = document.getElementById('search_box');
  
  document.addEventListener('click', function(event) {
      var check_click = ignore_element.contains(event.target);
      if (!check_click) 
      {
          document.getElementById('search_result').innerHTML = '';
      }
  });*/
</script>