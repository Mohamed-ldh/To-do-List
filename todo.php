<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <script src="script.js" defer></script>
    <title>To-do List - Home</title>
  </head>
  <body>
  <div class="user-info" style="position: absolute; right:105px; top:5%; color:white">
                    <?php
                      session_start();
                      if (isset($_SESSION['nom'])) {
                      $name = $_SESSION['nom'];
                      echo "Welcome, $name";
                    } else {
                      echo "Welcome, Guest";
                    }
                    ?>
                    </div> 
                    <div class="logout-btn">
                        <a href="logout.php" id="logout" style="position: absolute; top:5%; right:15px; text-decoration: none; color: white;">Logout</a>
                    </div>
    <section class="todo">
      <h2>To-do list</h2>
      <div class="input">
        <input type="text" class="text" id="tdtext" placeholder="Enter something you need to do">
        <button class="btn">Add</button>
      </div>
      <ul class="scroll">
        <li id="theList"></li>
      </ul>
      <div>
        <hr class="counter">
        <div class="counter-container">
          <p><span id="Counter">0</span> items total</p>
          <button id="deleteButton">Delete All</button>
        </div>
      </div>
    </section>
    <footer>
      <div class="footer">
        <p class="credits">Made By</p>
        <p class="credits">Mohamed Labiadh</p>
      </div>
    </footer>
  </body>
</html>