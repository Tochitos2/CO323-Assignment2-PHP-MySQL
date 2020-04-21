<?php
$loggedIn = $_SESSION['loggedin'];

if(($loggedIn)){
    session_destroy();
    echo "<h2>Successfully logged out</h2>";
}
else{
    header('Location: loginform.html');
    exit();
}