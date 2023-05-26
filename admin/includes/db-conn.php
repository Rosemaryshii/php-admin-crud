<?php
$host = 'localhost'; // e.g., 'localhost'
$dbname = 'cart_db';
$userName = 'root';
$pass = '';

try {
  $db = new PDO("mysql:host=$host;dbname=$dbname", $userName, $pass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // Other configuration options if needed
} catch(PDOException $e) {
  // Handle the error appropriately (e.g., logging, displaying an error message)
  echo "Connection failed: " . $e->getMessage();
}
?>
