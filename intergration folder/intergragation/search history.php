<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>search history</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

   
<style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    
         html,body,h1,h2,h3,h4,h5 {font-family: "RobotoDraft", "Roboto", sans-serif}
        .w3-bar-block .w3-bar-item {padding: 16px}
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>

<a href=" searching prototype.php">
      <i class="fa fa-arrow-left fa-lg" style="width: 10px; color: black" aria-hidden="true" id="arrow"></i>
        </a>
<?php
 $mysqli = require __DIR__ . "/conn.php";

 session_start();
 $name = $_SESSION['activity'];
           $sql = "SELECT * FROM `$name` WHERE 1";
           $result = $conn->query($sql);

           if ($result->num_rows > 0) {
             // output data of each row
             
             echo  "<center><h3 style='color:green;'>" . "HERE IS YOUR SEARCH HISTORY " .  "</h3></center>";
             echo '<table class="table table-bordered table-striped">';
             echo "<thead>";
                 echo "<tr>";
                 echo "<th>#</th>";
                     echo "<th>Search time</th>";
                     echo "<th>Search Details</th>";
                     echo "<th>Action</th>";

                 echo "</tr>";
             echo "</thead>";
             echo "<tbody>";
             while ($row = $result->fetch_assoc()) {
                $timestamp = $row['activity_timestamp'];
                $details = $row['search_history'];
        
                // Display the activity information
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";  
                echo "<td>" . $timestamp  . "</td>";
                echo "<td>" . $details  . "</td>";
               
                echo "<td>";
                    echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                echo "</td>";
            echo "</tr>";
          }
        echo "</tbody>";                            
    echo "</table>";
              
                      
           } else {
             echo "<br>" . "No  fund.";
           }
        

?></body>
</html>