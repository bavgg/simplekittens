<?php 
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/inc/header.php');
require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php') ?>


<!-- ----------------------------------------------------------------------- -->
<!--                             sql - read cats                             -->
<!-- ----------------------------------------------------------------------- -->
<?php
$success = isset($_GET['success']) ? $_GET['success'] : '';

$stmt = $conn->prepare("SELECT id, cat_name, price, file_name FROM Cats WHERE id = ?");
$stmt->bind_param("i", $cat_id); // "s" denotes the type (string, integer, etc.)


// Get the product ID from the GET request and sanitize it as an integer
$cat_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// Check if the product ID is valid
if ($cat_id === false || $cat_id === null) {
  // Handle the error appropriately
  die("Invalid product ID.");
}

$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$row = $result->fetch_assoc();


?>




<!-- ----------------------------------------------------------------------- -->
<!--                             post - quantity                             -->
<!-- ----------------------------------------------------------------------- -->
<?php


if (isset($_POST['button'])) {


  if ($_POST['button'] == 'increment') {

    $_POST['quantity'] = intval($_POST['quantity']) + 1;
  } elseif ($_POST['button'] == 'decrement') {

    if (intval($_POST['quantity']) > 1) {
      $_POST['quantity'] = intval($_POST['quantity']) - 1;
    }
  }
}

?>






<div style="display: flex; justify-content: center; margin-top: 100px;">
  <div style="display: flex; flex-direction: column;">
      <?php echo $success ?>
    <img height="200px" width="200px" src="<?php echo '/images/' . $row['file_name'] ?>" alt="product image">
    <p><?php echo $row['cat_name']; ?></p>
    <p>₱<?php echo $row['price'] ?></p>

    <div>
      <p>Quantity</p>

      <form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $cat_id ?>" method="post">
        <button hidden name='button' value='hidden'></button>
        <button name="button" value="decrement">-</button>
        <!-- <input value="1"> -->
        <input name="quantity" value="<?php echo isset($_POST['quantity']) ? $_POST['quantity'] : 1; ?>">
        <button name="button" value="increment">+</button>
      </form>



      <form action="action.php" method="post">
        <input hidden name="quantity" value="<?php echo  isset($_POST['quantity']) ? $_POST['quantity'] : 1; ?>">
        <input hidden name="cat_id" value="<?php echo $row['id'] ?>">
        <div>
          
          <button type="submit">Add to Cart</button>
        </div>
      </form>
    </div>

  </div>



</div>