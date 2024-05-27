<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/inc/header.php');
require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');



// -------------------------------------------------------------------------- //
//                             read address table                             //
// -------------------------------------------------------------------------- //
if (isset($_SESSION['uid'])) {
  $uid = $_SESSION['uid'];

  $query = "SELECT * FROM Address WHERE user_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $uid);

  if ($stmt->execute()) {
    $result = $stmt->get_result();
    // $num_rows_address = $result->num_rows;
    $address_row = $result->fetch_assoc();
  }
}

// -------------------------------------------------------------------------- //
//                               read cart table                              //
// -------------------------------------------------------------------------- //
if (isset($_SESSION['uid'])) {
  $uid = $_SESSION['uid'];

  $query = "SELECT * FROM Cart JOIN Cats ON Cart.cat_id = Cats.id WHERE user_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $uid);

  if ($stmt->execute()) {
    $cart_cat_result = $stmt->get_result();
    $num_rows = $cart_cat_result->num_rows;
    
    // $cart_rows = $cart_result->fetch_assoc();
  }
}

?>

<?php if (isset($_SESSION['uid'])) : ?>

  <div>
    <form action="create_update_address.php" method="post">
      <div style="display: flex; flex-direction: column; align-items: center;">
        <h2>Delivery Address</h2>

        <label>Fullname:</label>
        <input type="text" name="fullname" placeholder="Fullname" value="<?php echo isset($address_row['full_name']) ? $address_row['full_name'] : '' ?>" required>
        <label>Phone number:</label>
        <input type="text" name="phone" placeholder="Phone number" value="<?php echo isset($address_row['phone_number']) ? $address_row['phone_number'] : '' ?>" required>
        <label>Address:</label>
        <input type="text" name="address" placeholder="Street, Brgy, City, Country" value="<?php echo isset($address_row['address']) ? $address_row['address']: '' ?>" required>
        <button type="submit">Update</button>

        <?php
        // -------------------------------------------------------------------------- //
        //                                after submit                                //
        // -------------------------------------------------------------------------- //
        if (isset($_GET['error'])) {
          echo $_GET['error'];
        }
        if (isset($_GET['success'])) {
          echo "<h3 style='color: green;'>" . $_GET['success'] . "</h3>";
        }

        ?>
      </div>

      <div style="display: flex; flex-direction: column; align-items: center;">
        <h2>Products Ordered</h2>
        <?php $total = 0; ?>
        <?php while ($cart_cat_row = $cart_cat_result->fetch_assoc()) :
          // -------------------------------------------------------------------------- //
          //                               cart rows loop                               //
          // -------------------------------------------------------------------------- //  
        ?>

          <div>
            <img height="150" width="150" src="/images/<?php echo $cart_cat_row['file_name'] ?>" alt="product image">
            <h3><?php echo $cart_cat_row['cat_name'] ?></h3>

            <p>₱<?php echo $cart_cat_row['price'] ?></p>
            <p>Quantity: <?php echo $cart_cat_row['quantity'] ?></p>
            <p>Total-price: ₱<?php echo ($cart_cat_row['quantity'] * $cart_cat_row['price']);
                              $total += ($cart_cat_row['quantity'] * $cart_cat_row['price']); ?>.00</p>

          </div>
        <?php endwhile ?>
      </div>


      <?php if ($num_rows !== 0): ?>
        <div style="position:fixed; bottom: 100px; right: 500px;">
          <p>Merchandise Subtotal: ₱<?php echo $total ?></p>
          <p>Shipping fee: ₱200</p>
          <h3>Total Payment:</h3>
          <p>₱<?php echo $total + 200 ?></p>

          <h3 style="color: red;"><?php echo isset($_GET['incomplete']) ? $_GET['incomplete'] : '' ?></h3>
          <?php if(isset($address_row['full_name'])): ?>
            <a href="<?php echo 'create_purchase.php?complete=true' ?>" style="text-decoration: none;" ><div style="all:unset; padding: 6px; color: #202020; text-decoration: none; background-color: #e9e9ed; border-color: #8f8f9d; border-radius: 4px; border-width: 1px; border-style: solid;">Place Order</div></a>
          <?php else: ?>
            <a href="<?php echo 'create_purchase.php?complete=false' ?>" style="text-decoration: none;" ><div style="all:unset; padding: 6px; color: #202020; text-decoration: none; background-color: #e9e9ed; border-color: #8f8f9d; border-radius: 4px; border-width: 1px; border-style: solid;">Place Order</div></a>
          <?php endif ?>
        </div>
      <?php endif ?>
    </form>


  </div>


<?php else : header("location: /login?error=Login first"); ?>

<?php endif ?>