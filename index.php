<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/inc/header.php');
require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');


// -------------------------------------------------------------------------- //
//                            pagination variables                            //
// -------------------------------------------------------------------------- //
$total_cats = $conn->query('SELECT * FROM Cats')->num_rows;
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$cats_per_page = 8;
$total_pages = ceil($total_cats / $cats_per_page);


// -------------------------------------------------------------------------- //
//                                sql read cats                               //
// -------------------------------------------------------------------------- //
if ($stmt = $conn->prepare("SELECT * FROM Cats LIMIT ?, ?")) {
  $row_start = ($current_page - 1) * $cats_per_page;
  $stmt->bind_param('ii', $row_start, $cats_per_page);
  if ($stmt->execute()) {
    $result = $stmt->get_result();
  } else {
    echo 'error';
  }
}



// -------------------------------------------------------------------------- //
//                            add function response                           //
// -------------------------------------------------------------------------- //
if (isset($_GET['success']) && isset($_GET['item'])) {

    echo "<div style='display: flex; justify-content: center;'><h3 style='color: green;'>Item" . $_GET['item'] . " " . $_GET['success'] . "</h3></div>";
}


echo "<div style='display: flex; justify-content: center;'>
  <h1 style='color: gray;'>Products</h1>
</div>";





// -------------------------------------------------------------------------- //
//                                    cats                                    //
// -------------------------------------------------------------------------- //
echo "<div style='display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin: 0px 350px;'>";

if ($result !== false) {

  while ($row = $result->fetch_assoc()) {

    echo "
    
      <div style='display: flex; flex-direction: column;'>
        <a href='/product?id=" . $row['id'] . "'>
          <div>
            <img height='150px' width='150px' src='/images/" . $row['file_name'] . "' alt='cat image'>
            <p>" . $row['cat_name'] . "</p>
            <p>" . $row['price'] . "</p>
          </div>
        </a>
        <form action='add.php' method='post'>
          <input hidden name='current_page' value='" . $current_page . "'>
          <input hidden name='quantity' value='1'>
          <input hidden name='cat_id' value='" . $row['id'] . "'>
          <div>
            <button type='submit'>Add to Cart</button>
          </div>
        </form>
      </div>
      ";
  }
} else {
  echo "No cats available";
}

echo "</div>";


// -------------------------------------------------------------------------- //
//                                 page links                                 //
// -------------------------------------------------------------------------- //
echo "<div style='display: flex; position: fixed; bottom: 10px; gap: 20px; margin-left: 750px; margin-top: 20px; justify-content: space-between; margin-right: 700px; height: 120px;'>";


// ---------------------------------- prev ---------------------------------- //
echo "<div style='width: 80px;'>";
if ($current_page > 1) {
  echo "<div><a href='{$_SERVER['PHP_SELF']}?page=" . ($current_page - 1) . "'>" . 'Prev' . "</a></div>";
}
echo "</div>";





echo "<div style='margin-right: 40px;'>";
// ----------------------------------- ?1 ----------------------------------- //
if ($current_page > 3) {
  echo "<div><a href='{$_SERVER['PHP_SELF']}?page=" . 1 . "'>" . '1' . "</a></div>";
  echo "...";
}


// ---------------------------------- ?2nd ---------------------------------- //
if (($current_page - 2) > 0) {
  echo "<div><a href='{$_SERVER['PHP_SELF']}?page=" . ($current_page - 2) . "'>" . ($current_page - 2) . "</a></div>";
}

// ---------------------------------- ?1st ---------------------------------- //
if (($current_page - 1) > 0) {
  echo "<div><a href='{$_SERVER['PHP_SELF']}?page=" . ($current_page - 1) . "'>" . ($current_page - 1) . "</a></div>";
}

// ------------------------------------ 0 ----------------------------------- //
echo "<div><a href='{$_SERVER['PHP_SELF']}?page=$current_page'>$current_page</a></div>";

// ---------------------------------- ?1st ---------------------------------- //
if (($current_page + 1) <= $total_pages) {
  echo "<div><a href='{$_SERVER['PHP_SELF']}?page=" . ($current_page + 1) . "'>" . ($current_page + 1) . "</a></div>";
}

// ---------------------------------- ?2nd ---------------------------------- //
if (($current_page + 2) <= $total_pages) {
  echo "<div><a href='{$_SERVER['PHP_SELF']}?page=" . ($current_page + 2) . "'>" . ($current_page + 2) . "</a></div>";
}

// ----------------------------------- ?n ----------------------------------- //
if ($current_page < ($total_pages - 2)) {
  echo "...";
  echo "<div><a href='{$_SERVER['PHP_SELF']}?page=" . ($total_pages) . "'>" . ($total_pages) . "</a></div>";
}
echo "</div>";




// ---------------------------------- next ---------------------------------- //
echo "<div style='width: 80px;'>";
if ($current_page < $total_pages) {
  echo "<a href='{$_SERVER['PHP_SELF']}?page=" . ($current_page + 1) . "'>" . 'Next' . "</a>";
}
echo "</div>";

echo "</div>";
?>

<div>



</div>