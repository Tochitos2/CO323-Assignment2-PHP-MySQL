<?php // Connect to database, and print error message if it fails
try {
    $dbhandle = new PDO('mysql:host=dragon.kent.ac.uk; dbname=co323',
        'co323', 'h@v3fun');
}
catch (PDOException $e) { die('DB connect error: ' . $e->getMessage()); }

$sql = "SELECT * FROM Course"; // The SQL query itself
$query = $dbhandle->prepare($sql); // Prepare and ...
if ( $query->execute() === FALSE ) { // ... execute the query
    die('Query exec error: ' . implode($query->errorInfo(),' '));
}
$results = $query->fetchAll(); // Put all the results in an array
?>
    <h2>Details of all courses</h2> <!-- static HTML heading -->
<?php // Generate HTML from the contents of the results array
foreach ($results as $row) {
    echo "<p>".$row['cid'].": ".$row['title']."</p>";
}
?>