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

$sql = "SELECT cid, name, AVG(mark) AS avg_mark
FROM Grade g JOIN Assessment a ON g.aid = a.aid      
GROUP BY cid, name
ORDER BY cid, name;"; // The SQL query itself
$query = $dbhandle->prepare($sql); // Prepare and ...
if ( $query->execute() === FALSE ) { // ... execute the query
    die('Query exec error: ' . implode($query->errorInfo(),' '));
}
$results = $query->fetchAll(); // Put all the results in an array
?>
<h2>Assessment Information</h2>
<table><tr><th>Course ID</th><th>Name</th><th>Weighting</th></tr>
    <?php // Generate HTML from the contents of the results array
    foreach ($results as $row) {
        echo "<tr><td>".$row['cid']."</td>"."<td>".$row['name']."</td>"."<td>".$row['avg_mark']."</td></tr>";
    }
    ?>
</table>


