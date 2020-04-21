<?php
session_start();
if(!$_SESSION['loggedin'] || !isset($_SESSION['loggedin'])){
    header('Location: loginform.html');
    exit();
}
?>

<h2>Navigate Site</h2>
<ul>
    <li><a href="task4.php">Task 4</a></li>
    <li><a href="task5.php">Task 5</a></li>
    <li><a href="task6.php">Task 6</a></li>
    <li><a href="task7.php">Task 7</a></li>
    <li><a href="logout.php">Log out</a> </li>
</ul>
