<?php require($_SERVER['DOCUMENT_ROOT'] . '/inc/header.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $message =  isset($_GET['message'])? $_GET['message'] : null;
    $error = isset($_GET['error']) ? $_GET['error'] : null;
}


?>
<div style="display: flex; justify-content: center; margin-top: 50px;">
    <div style="display: flex; flex-direction: column;">

        <h1>Log In</h1>
        <div>
            <h3 style='color: red;'><?php echo $error ?></h3>
            <h3 style='color: green;'><?php echo $message ?></h3>
            

        </div>
        <form method="post" action="action.php">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" value="Login">
        </form>
        <div style="display: flex; align-items: center; gap: 10px;"">
            <p>No account yet? Register now.</p>
            <a href="/signup">Signup</a>

        </div>
    </div>

</div>