<?php
// Check if the link has been clicked
if (isset($_GET['link_clicked'])) {
    // Set the variable to true
    $isClicked = "your data will be available as soon as posible";
} else {
    // Set the variable to false or initialize it
    $isClicked = "error occured";
}
?>


<!-- Display the variable value -->
<p> <?php echo $isClicked  ?></p>
<?php

session_start();
echo $_SESSION['myVariable'];  // Output: Hello, world!


?>