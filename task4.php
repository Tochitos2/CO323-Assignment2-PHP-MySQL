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

$sql = "SELECT   name, weighting
FROM     Assessment a JOIN Course c ON a.cid = c.cid 
WHERE    title = 'Database Systems'
ORDER BY name;"; // The SQL query itself
$query = $dbhandle->prepare($sql); // Prepare and ...
if ( $query->execute() === FALSE ) { // ... execute the query
    die('Query exec error: ' . implode($query->errorInfo(),' '));
}
$results = $query->fetchAll(); // Put all the results in an array
?>
    <h2>Database Systems Assessments</h2>
    <table><tr><th>Name</th><th>Weighting</th></tr>
        <?php // Generate HTML from the contents of the results array
        foreach ($results as $row) {
            echo "<tr><td>".$row['name']."</td>"."<td>".$row['weighting']."</td></tr>";
        }
        ?>
    </table>

