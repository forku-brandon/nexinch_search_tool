<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>

  <link rel="stylesheet" href="./fontawesome-free-6.4.2-web/css/all.css">
  <link rel="stylesheet" href="file:///D:/css/css/all.css">
  <link rel="stylesheet" href="home.css">
  <style>
    button {
  background-color: rgb(43, 43, 233);
;
  border: none;
  color: white;
  cursor: pointer;
  padding: 10px;
  width: 100%;
  border-radius: 20px;
}

button:hover {
  background-color: #45a049;
}
.button {
  background-color:rgb(43, 43, 233);
  border: none;
  color: #fff;
  cursor: pointer;
  padding: 10px;
  width: 100%;
  border-radius: 20px;}
.button:hover {
  background-color: #45a049;
}
  </style>
</head>

<body>
  <div id="sideNav">
    <nav>
      <ul>
        <li><a href="#">
            <i class="fa-solid fa-plus" style="color: #ffffff;"></i>New Tab</a></li>
        <li><a href="settings.php">
            <i class="fa-solid fa-gear" style="color: #ffffff;"></i>Settings</a></li>
        <li><a href="#">
            <i class="fa-regular fa-message" style="color: #ffffff;"></i>Feedback</a></li>
      </ul>

    </nav>
    <div id="menuBtn">
      <i class="fa-solid fa-bars"></i>

    </div>
  </div>

  <script>
    var menuBtn = document.getElementById("menuBtn")
    var sideNav = document.getElementById("sideNav")
    var menu = document.getElementById("menu")

    sideNav.style.right = "-250px";

    menuBtn.onclick = function() {
      if (sideNav.style.right == "-250px") {
        sideNav.style.right = "0";
        menu.src = "images/bulb.png";
      } else {
        sideNav.style.right = "-250PX";
        menu.src = "images/menu.png";
      }
    }
  </script>
  <div class="container">
    <div class="center-content">
      <h1>Nexinch</h1>
      <div class="box">

        <form method="post" action="result.php">
          <input type="text" name="data" id="myInput" placeholder="Search" required>
          <button type="submit" id="search-bar">
            <i class="fa fa-search" aria-hidden="true"></i>
          </button>
        </form>
      </div>
      <div class="sbutton" style="display: flex;">
     
        <a href="search history.php" class="button">Search History</a> 
        <p>.......</p>
        <a href="search history.php" class="button">I'm Feeling Lucky</a>
      </div>
    </div>
    <div class="sinbutton">

      <a href="signup.php" class="button">SignUp</a>
    </div>
  </div>
  </form>
  </div>
  </div>
  </div>

</body>

</html>