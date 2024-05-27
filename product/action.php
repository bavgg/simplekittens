<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

if ($_SESSION['username']) {

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $qty = intval($_POST['quantity']);
    $cat_id = intval($_POST['cat_id']);
    $user_id = intval($_SESSION['uid']);
    // print_r($user_id);

    $stmt = $conn->prepare("INSERT INTO Cart (quantity, cat_id, user_id) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + ?");
    $stmt->bind_param("iiii", $qty, $cat_id, $user_id, $qty);

    if ($stmt->execute()) {
        header("location: /product?id=" . $_POST['cat_id'] . "&success=Item" . $_POST['cat_id'] . " added to cart" );
    //   echo "Items added to cart";
    } else {
    //   echo "Error: " . $stmt->error;
    }

    $stmt->close();

    
  }
}else {
  header("location: /login?error=Login first");
}




?>