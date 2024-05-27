<?php


// Start session
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');


if ($_GET['complete'] === "true") {
  // -------------------------------------------------------------------------- //
  //                               read cart table                              //
  // -------------------------------------------------------------------------- //
  if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];

    // 	quantity	cat_id 	user_id  	cat_name 	price 	file_name
    $query = "SELECT quantity, cat_id, user_id, cat_name, price, file_name FROM Cart JOIN Cats ON Cart.cat_id = Cats.id WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $uid);

    if ($stmt->execute()) {
      $cart_result = $stmt->get_result();
      // $cart_rows = $cart_result->fetch_assoc();
    } else {
    //   echo 'cart failed execution';
    }
  }

  // type string
  $date_now =  date('Y-m-d H:i:s');

  // -------------------------------------------------------------------------- //
  //                  create purchase table with the cart rows                  //
  // -------------------------------------------------------------------------- //
  // user_id cat_id quantity price total purchase_date
  while ($row = $cart_result->fetch_assoc()) {
    
    $sql = "INSERT INTO Purchase (user_id, cat_id, quantity, total, purchase_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $user_id = $row['user_id'];
    $cat_id = $row['cat_id'];
    $quantity = $row['quantity'];

    $price = $row['price'];
    $total = $quantity * $price;
    // purchase date on top and is global

    $stmt->bind_param("iiids", $user_id, $cat_id, $quantity, $total, $date_now);

    if ($stmt->execute()) {
    } else {
      // failed execution
    }
  }


  // -------------------------------------------------------------------------- //
  //                              delete cart rows                              //
  // -------------------------------------------------------------------------- //
  $sql = "DELETE FROM Cart WHERE user_id = ?";
  $stmt  = $conn->prepare($sql);
  $stmt->bind_param("i", $user_id);

  $user_id = $_SESSION['uid'];

  if ($stmt->execute()) {
    $stmt->close();
    header("location: /purchase");
  } else {
    $stmt->close();
    header("location: /purchase");
  }
}else {
  header("location: /checkout?incomplete=Fill all the address fields first.");
}

