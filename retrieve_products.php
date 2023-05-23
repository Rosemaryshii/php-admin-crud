<?php

include 'config.php'; // Include the config.php file to establish the database connection

$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Error retrieving products: ' . mysqli_error($conn));
}

$products = array();

while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

mysqli_free_result($result);
mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($products);
?>
