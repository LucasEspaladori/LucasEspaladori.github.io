<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  
  $current_page = basename($_SERVER['PHP_SELF']);
  $is_authenticated = isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true;
?>

<nav>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>

    <ul class="main-nav-list" id="nav_ul">
        
        <li class="dropdown <?php echo ($current_page === 'my_vacation.php' || $current_page === 'my_artistic_self.php') ? 'current_page' : ''; ?>">
            <a href="javascript:void(0)" class="dropbtn">Discover me!</a>
            <div class="dropdown-content">
                <a href="my_vacation.php" class="<?php echo ($current_page === 'my_vacation.php') ? 'current_page' : ''; ?>">Dream vacation</a>
                <a href="my_artistic_self.php" class="<?php echo ($current_page === 'my_artistic_self.php') ? 'current_page' : ''; ?>">Personal Art</a>
            </div>
        </li>

        <li><a href="marketplace.php" class="<?php echo ($current_page === 'marketplace.php') ? 'current_page' : ''; ?>">My shop</a></li>
        <li><a href="my_form.php" class="<?php echo ($current_page === 'my_form.php') ? 'current_page' : ''; ?>">Quiz</a></li>
        
        <li><a 
            href="login.php" 
            class="<?php echo ($current_page === 'login.php' || $current_page === 'todo-list.php') ? 'current_page' : ''; ?>">
            To-do List
        </a></li>

        <?php if ($is_authenticated): ?>

        <?php endif; ?>

    </ul>
    
    <script>
        function myFunction() {
            var x = document.getElementById("nav_ul");
            if (x.className === "main-nav-list") {
                x.className += " responsive";
            } else {
                x.className = "main-nav-list";
            }   
        }
    </script>
</nav>