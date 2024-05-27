<?php 
session_start();

require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

$user_id = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;


$sql = "SELECT Cart.id AS cart_id, quantity, cat_name, price, file_name, user_id
        FROM Cart 
        JOIN Cats ON Cart.cat_id = Cats.id
        WHERE user_id = ?"; 
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);

$stmt->execute();
$result = $stmt->get_result();
$num_rows = $result->num_rows;

$total = 0;
$total_item = 0;

if (isset($_SESSION['username'])){
    require($_SERVER['DOCUMENT_ROOT'] . '/inc/header.php');
    if($num_rows === 0) {
        echo "<div style='display: flex; justify-content: center; margin-top: 50px;'><h2>Your cart is empty.</h2></div>";
    }

    echo "<div style='display: flex; justify-content: center; margin-top: 50px;'>
            <div style='display: flex; flex-direction: column;'>";
            // loop cart items 
            while ($cartItem = $result->fetch_assoc()) :
                // read
                echo "<img height='150px' width='150px' src='/images/".$cartItem['file_name']."'>
                        <p>".$cartItem['cat_name']."</p>
                        <p>₱".$cartItem['price']."</p>";

                // Update 
                echo "<form action='/cart/update.php' method='post'>
                            <input hidden name='cart_id' value='".$cartItem['cart_id']."'>
                            <button hidden name='button' value='hidden'></button>
                            <button name='button' value='decrement'>-</button>
                            
                            <input name='quantity' value='".$cartItem['quantity']."'>
                            
                            <button name='button' value='increment'>+</button>
                        </form>
                        
                        <p>Total price: ₱".($total_price = $cartItem['price'] * $cartItem['quantity']);
                                $total += $total_price;
                                $total_item += 1; "</p>";

                // delete 
                echo "<form method='post' action='/cart/delete.php'>
                            <input hidden name='cart_id' value='".$cartItem['cart_id']."'>
                            <button type='submit'>Delete</button>
                        </form>";

                // error 
                echo isset($_GET['error']) ? $_GET['error'] : '';

                echo "<br>";
            endwhile;
            // end of loop 
        echo "</div>
    </div>";

    //  
    if($num_rows !== 0){
        echo "<div style='display: flex; justify-content: center; align-items: center; gap: 20px; position: fixed; bottom: 100px; right: 300px;'>
                <h1>Total(".$total_item." item): ₱".$total."</h1>
                <a href='/checkout'>Check Out</a>
            </div>";
    }

}else {
    header("location: /login");
    exit(); // Stop further execution
}
?>
