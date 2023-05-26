<?php
require_once 'includes/db-conn.php';

if (isset($_POST['update-glass'])) {
  $glassId = $_POST['edit-glass-id'];
  $glassName = $_POST['edit-glass-name'];
  $glassPrice = $_POST['edit-glass-price'];

  // Update the glass in the database
  $updateQuery = "UPDATE glass SET GlassName = :glassName, price = :glassPrice WHERE id = :glassId";
  $statement = $db->prepare($updateQuery);
  $statement->bindValue(':glassName', $glassName);
  $statement->bindValue(':glassPrice', $glassPrice);
  $statement->bindValue(':glassId', $glassId);
  $statement->execute();

  // Redirect back to the page where the form is displayed
  header("Location: all_glass.php");
  exit();
}
?>

