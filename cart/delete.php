<?php
require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

// -------------------------------------------------------------------------- //
//                           delete cart table item                           //
// -------------------------------------------------------------------------- //
$sql = "DELETE FROM Cart WHERE id = ?";
$stmt  = $conn->prepare($sql);
$stmt->bind_param("i", $cart_id);

$cart_id = $_POST['cart_id'];

if ( $stmt->execute() ) {
  $stmt->close();
  header("location: /cart");
}else {
  $stmt->close();
  header("location: /cart?error=Something went wrong");
}


