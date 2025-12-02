<?php
$host = '127.0.0.1';     // DB is on the same EC2
$user = 'appuser';
$pass = 'AppPassword123!';
$db   = 'appdb';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_errno) {
    echo "<h1>DB Connection Failed</h1>";
    echo "<p>Error: " . $mysqli->connect_error . "</p>";
    exit;
}

$result = $mysqli->query("SELECT NOW() AS now");
$row = $result->fetch_assoc();

echo "<h1>App → MySQL connection successful!</h1>";
echo "<p>Time from DB: " . $row['now'] . "</p>";
echo "<p>Served from host: " . gethostname() . "</p>";

$mysqli->close();
?>
[ec2-user@ip-10-0-3-16 ~]$ sudo cat /var/www/html/index.php
<?php
$host = '127.0.0.1';     // DB is on the same EC2
$user = 'appuser';
$pass = 'AppPassword123!';
$db   = 'appdb';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_errno) {
    echo "<h1>DB Connection Failed</h1>";
    echo "<p>Error: " . $mysqli->connect_error . "</p>";
    exit;
}

$result = $mysqli->query("SELECT NOW() AS now");
$row = $result->fetch_assoc();

echo "<h1>App → MySQL connection successful!</h1>";
echo "<p>Time from DB: " . $row['now'] . "</p>";
echo "<p>Served from host: " . gethostname() . "</p>";

$mysqli->close();
?>