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

if(isset($_GET['sid'])) {
    $sid = htmlspecialchars($_GET['sid']);
    $sql = "SELECT c.cid, c.title, name, weighting, mark, mark * weighting AS final
FROM   Grade g JOIN Assessment a ON g.aid = a.aid JOIN Course c on a.cid = c.cid          
WHERE sid = \"$sid\";";
 // The SQL query itself
    $query = $dbhandle->prepare($sql); // Prepare and ...
    if ($query->execute() === FALSE) { // ... execute the query
        die('Query exec error: ' . implode($query->errorInfo(), ' '));
    }
    $results = $query->fetchAll(); // Put all the results in an array

    echo "<h2>Student Information:"." ".$sid."</h2>
    <table><tr><th>Course ID</th><th>Name</th><th>Weighting</th><th>Mark</th><th>Final Grade</th></tr>";

    foreach ($results as $row) {
        echo "<tr><td>".$row['cid']."</td>"."<td>".$row['name']."</td>"."<td>".$row['weighting']."</td>"."<td>".$row['mark']."</td>"."<td>".$row['final']."</td></tr>";
    }
}
else echo "<h2>Unauthorised Request</h2>";

