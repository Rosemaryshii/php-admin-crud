<?php

include './includes/db-conn.php'; // Include the database file to establish the database connection

$selectQuery = "SELECT * FROM glass";
$statement = $db->prepare($selectQuery);
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($products);

?>

