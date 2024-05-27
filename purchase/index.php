<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/inc/header.php');
require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');




if (isset($_SESSION['uid'])) {
  $uid = $_SESSION['uid'];

  // -------------------------------------------------------------------------- //
  //                 read purchase table group by purchase date                 //
  // -------------------------------------------------------------------------- //
  $sql =
    "SELECT user_id, SUM(total) AS total_price, purchase_date FROM 
  Purchase
  WHERE user_id = ?
  GROUP BY 
  purchase_date, user_id
  ORDER BY 
  purchase_date DESC
  ";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $uid);

  if ($stmt->execute()) {
    $purchase_result = $stmt->get_result();
    $num_rows = $purchase_result->num_rows;
  } else {
    echo 'failed exec';
  }

  echo "<div style='display: flex; justify-content: center;'><h1>My Purchase</h1></div>";

  if ($num_rows > 0) {

    // -------------------------------------------------------------------------- //
    //                       display purchase table group by purchase_date        //
    // -------------------------------------------------------------------------- //
    while ($purchase_row = $purchase_result->fetch_assoc()) {

      // ------------------------------------------------------------------------ //
      //    read purchase_cats table where purchase_date = purchase_date          //
      // ------------------------------------------------------------------------ //
      $purchase_date = $purchase_row['purchase_date'];

      $sql = "SELECT cat_name, price, file_name, quantity, price, total, purchase_date FROM Purchase JOIN Cats ON Purchase.cat_id = Cats.id WHERE purchase_date = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $purchase_date);

      $order_total = $purchase_row['total_price'];


      if ($stmt->execute()) {
        $purchase_cats_result = $stmt->get_result();
      } else {
        echo 'failed exec';
      }
      echo "<div style='display: flex; align-items: center; flex-direction: column;'>";

      echo "<p>" . $purchase_date . "</p>";

      echo "<div style='display: flex; gap: 10px; padding: 10px; align-items: center; background-color: #caf0f8;'>";
      while ($purchase_cats_row = $purchase_cats_result->fetch_assoc()) {
        echo "
        

            <img src='/images/" . $purchase_cats_row['file_name'] . " ' height='150' width='150'>
            <div>
              <h3>" . $purchase_cats_row['cat_name'] . "</h3>
              <p>Price: " . $purchase_cats_row['price'] . "</p>
              <p>x" . $purchase_cats_row['quantity'] . "</p>
              <p>Sub-toal: " . $purchase_cats_row['total'] . "</p>
            </div>
          

        ";
        echo "<br>";
      }
      echo "</div>";

      echo "<h3 style='margin-left: 100px;'>Shipping fee: 200, Order Total: " . ( intval($order_total) + 200 )  . "</h3>";
      echo "<br>";
      echo "<br>";
    }
  } else {
    echo "<div style='display: flex; justify-content: center;'><h2>No purchases have been made yet</h2></div>";
  }
} else {
  echo "<div style='display: flex; justify-content: center;'><h3>Login first</h3></div>";
}
