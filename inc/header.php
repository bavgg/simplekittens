<?php
// session_start();
echo "
<header>
  <div style='display: flex; justify-content: center; align-items: center; gap: 20px; padding: 30px;'>
    <a style='margin-right: 100px;' href='/'>CuteKittens</a>";

$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

if ($username) {
    // echo "<img src='icon'>";
    echo "<p>$username</p>";
    echo '<a href="/logout">Logout</a>';
    echo '<a href="/purchase">My Purchase</a>';
} else {
    echo "<a href='/signup'>Sign Up</a>";
    echo "<a href='/login'>Login</a>";
}

echo "<a href='/cart'>Cart</a>";

echo "
  </div>
</header>";
?>