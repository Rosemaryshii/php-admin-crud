<?php
require_once 'includes/db-conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the glass ID from the POST data
  $glassId = $_POST['glass_id'];

  // Fetch the glass data from the database
  $selectQuery = "SELECT * FROM glass WHERE id = :id";
  $statement = $db->prepare($selectQuery);
  $statement->bindParam(':id', $glassId);
  $statement->execute();
  $glass = $statement->fetch(PDO::FETCH_ASSOC);

  // Return the glass data as a JSON response
  header('Content-Type: application/json');
  echo json_encode($glass);
} else {
  // If accessed directly without a POST request, redirect back to the previous page
  header('Location: index.php');
  exit();
}
?>
