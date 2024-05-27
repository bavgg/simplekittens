<?php require($_SERVER['DOCUMENT_ROOT'] . '/inc/header.php'); ?>


<div style="display: flex; justify-content: center; margin-top: 50px;">
    <div style="display: flex; flex-direction: column;">
        <h1>Sign Up</h1>
        <form method="post" action="action.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" value="Login">
        </form>
    </div>
</div>