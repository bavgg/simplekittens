<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

// -------------------------------------------------------------------------- //
//                              update cart table                             //
// -------------------------------------------------------------------------- //

$cart_id = $_POST['cart_id'];
$quantity = 1; 

if (intval($_POST['quantity']) > 0) {
    
    if ($_POST['button'] === 'increment') {
      $quantity = $_POST['quantity'] + 1;
    } elseif ($_POST['button'] === 'hidden') {
        $quantity = $_POST['quantity'];
        
    } elseif ($_POST['button'] === 'decrement') {
        if (intval($_POST['quantity']) > 1) $quantity = $_POST['quantity'] - 1;
    }
    
    
    
    
    $sql = "UPDATE Cart SET quantity = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $quantity, $cart_id);
    
    if($stmt->execute()) header("location: /cart");
    $stmt->close();
    
}else {
    header("location: /cart");
}








