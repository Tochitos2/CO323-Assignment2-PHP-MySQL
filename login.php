<?php
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);

    if($username === 'abc' && $password === 'Only4Testing'){
        session_start();
        $_SESSION['loggedin'] = true;
        header('Location: menu.php');
        exit();
    }
    else{
        echo "<h2>Incorrect Login</h2><br><p><a href='loginform.html'>Return to login page</a></p>";
    }
}

