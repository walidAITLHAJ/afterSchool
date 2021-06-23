<?php 
$servername = "localhost";
$username = "root";
$password = ""; 
$db_name = "pfa_ensias2";


try {
  $pdo = new PDO("mysql:host=$servername;port=3306;dbname=$db_name", $username, $password);
  $pdo->query("SET NAMES 'UTF8'");
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>