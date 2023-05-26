<!-- <?php

require_once 'includes/db-conn.php';

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the glass ID from the request
  $glassId = $_POST['id'];

  // Perform the necessary actions to delete the glass from the database
  // Replace the following code with your actual database query or ORM logic
  $sql = "DELETE FROM glass WHERE id = :glassId";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':glassId', $glassId, PDO::PARAM_INT);
  
  if ($stmt->execute()) {
    // The glass was successfully deleted
    $response = [
      'success' => true,
      'message' => 'Glass deleted successfully'
    ];
  } else {
    // There was an error deleting the glass
    $response = [
      'success' => false,
      'message' => 'Error deleting glass'
    ];
  }
} else {
  // Invalid request method
  $response = [
    'success' => false,
    'message' => 'Invalid request method'
  ];
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?> -->
