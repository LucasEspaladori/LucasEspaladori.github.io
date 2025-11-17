<?php

require_once 'config.php';
session_start();

$is_authenticated = isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true;

$username_display = 'User';
if ($is_authenticated && isset($_COOKIE['todo-username']) && !empty($_COOKIE['todo-username'])) {
    $username_display = htmlspecialchars($_COOKIE['todo-username']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Lucas Espaladori">
    <title><?php echo $username_display; ?>'s To-Do List</title>
    <link rel="stylesheet" href="my_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <div class="body_wrapper"> 
        <header>
            <div class="title-container">

                <a href="index.php" class="header-icon-link">
                 <img src="https://cdn-icons-png.flaticon.com/512/5339/5339181.png" alt="Website Icon" class="header-icon">
                </a>

        <h1><?php echo $username_display; ?>'s to-do list</h1>

        </div>

    <?php require_once 'nav.php'; ?>

    <?php if ($is_authenticated): ?>
        <form action="logout.php" method="post" style="position: absolute; right: 20px; top: 10px;">
        <button type="submit" style="background-color: #d9534f; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-size: 1em;">
            Log out
        </button>
        </form>
    <?php endif; ?>

</header>
        
    <div class="main-content">
        
        <?php if ($is_authenticated): ?>
            <h2 class="welcome-message">Welcome back, **<?php echo $username_display; ?>**!</h2>
            
            <h2>What do you need to do?</h2>
            
            <form id="add_item_form" class="add-item-form" onsubmit="event.preventDefault(); addItem();">
                <input type="text" id="todo_input" placeholder="Enter a new task..." required>
                <button type="submit">Add to list</button>
            </form>

            <ul id="todo_list">
            </ul>

        <?php else: ?>
            <h2 class="welcome-message">Please log in to access your To-Do List.</h2>
            <p style="text-align: center; font-size: 1.2em;">
                You can log in by clicking the **To-do List** link in the navigation menu.
            </p>
        <?php endif; ?>
        
    </div>

    <hr>
    
    <?php require_once 'footer.php'; ?>
    </div>

    <?php if ($is_authenticated): ?>
        <script>
            let items = JSON.parse(localStorage.getItem("items")) || [];
            renderList();
            function renderList(){
                items.forEach((item) => {
                    renderItem(item.text, item.id);
                });
            }
            function addItem() {
                const input_element = document.getElementById("todo_input");
                const item_text = input_element.value.trim();

                if (item_text === "") {
                    alert("Please enter a task before adding it to the list!");
                    return;
                }
                const newItem = {
                    text: item_text,
                    id: Date.now()
                };
                
                items.push(newItem);
                localStorage.setItem("items", JSON.stringify(items));
                renderItem(newItem.text, newItem.id);
                input_element.value = "";
            }

            function renderItem(item_text, id) {
                const ul_element = document.getElementById("todo_list");
                const li = document.createElement("li");
                li.dataset.id = id;
                const text_span = document.createElement("span");
                text_span.textContent = item_text;
                li.appendChild(text_span);
                const trash_span = document.createElement("span");
                trash_span.classList.add('fas', 'fa-trash');
                li.appendChild(trash_span);
                trash_span.addEventListener("click", () => {
                    const item_id_to_delete = parseInt(li.dataset.id);
                    li.remove();
                    items = items.filter(x => x.id !== item_id_to_delete);
                    localStorage.setItem("items", JSON.stringify(items)); 
                });
                ul_element.appendChild(li);
            }
        </script>
    <?php endif; ?>
    
</body>
</html>