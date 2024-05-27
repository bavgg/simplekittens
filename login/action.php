<?php
require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

session_start();



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // -------------------------------------------------------------------------- //
  //                                 user input                                 //
  // -------------------------------------------------------------------------- //
  $email = $_POST['email'];
  $password = $_POST['password'];

  // -------------------------------------------------------------------------- //
  //                              sql - read users                              //
  // -------------------------------------------------------------------------- //
  $query = "SELECT * FROM Users WHERE email = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  // -------------------------------------------------------------------------- //
  //                           verify user & password                           //
  // -------------------------------------------------------------------------- //
  if ($user && password_verify($password, $user['password'])) {
    // Start session and set user session variables
    $_SESSION['username'] = $user['username'];
    $_SESSION['uid'] = $user['id'];
    header("Location: /");
    exit;
  } else {
    header("Location: /login?message=Invalid email or password");
  }

  // -------------------------------------------------------------------------- //
  //                                 close stmt                                 //
  // -------------------------------------------------------------------------- //
  $stmt->close();
}
