<?php

session_start();
if(!$_SESSION['loggedin'] || !isset($_SESSION['loggedin'])){
    header('Location: loginform.html');
    exit();
}

try {
    $dbhandle = new PDO('mysql:host=dragon.kent.ac.uk; dbname=co323',
        'co323', 'h@v3fun');
}
catch (PDOException $e) { die('DB connect error: ' . $e->getMessage()); }

$sql = "SELECT sid, forename, surname, gender
        FROM Student"; // The SQL query itself
$query = $dbhandle->prepare($sql); // Prepare and ...
if ( $query->execute() === FALSE ) { // ... execute the query
    die('Query exec error: ' . implode($query->errorInfo(),' '));
}
$results = $query->fetchAll(); // Put all the results in an array
?>
<h2>Student Information</h2>
<form action="task7.php" method="get">
    <select>
        <?php
        foreach($results as $row){
            echo "<option value=\"".$row['sid']."\">".$row['sid']." | ".$row['forename']." ".$row['surname']. " | ".$row['gender']."<\option>";
        }
        ?>
    </select>
    <input type="submit" value="Submit">
</form>


