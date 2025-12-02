<?php

$host = '10.0.3.16';         // Private IP of DB EC2
$user = 'appuser';
$pass = 'AppPassword123!';
$db   = 'appdb';

// Create a connection
$mysqli = new mysqli($host, $user, $pass, $db);

// Check connection
if ($mysqli->connect_errno) {
    echo "<h1>DB Connection Failed</h1>";
    echo "<p>Error: " . $mysqli->connect_error . "</p>";
    exit;
}

// Run a simple query
$result = $mysqli->query("SELECT NOW() AS now");
$row = $result->fetch_assoc();

// Output HTML
echo "<h1>CI/CD Deployment Successful! 🚀</h1>";
echo "<p>Time from DB: " . $row['now'] . "</p>";
echo "<p>Served from host: " . gethostname() . "</p>";

// Close connection
$mysqli->close();

?>
