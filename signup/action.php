<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // -------------------------------------------------------------------------- //
  //                                 user input                                 //
  // -------------------------------------------------------------------------- //
  $username = $_POST['username'];
  $email = $_POST['email'];
  // ---------------------------- encrypt password ---------------------------- //
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  // ------------------------- validate email address ------------------------- //
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format";
  }

  // -------------------------------------------------------------------------- //
  //                              sql - create user                             //
  // -------------------------------------------------------------------------- //
  $query = "INSERT INTO Users (username, email, password) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("sss", $username, $email, $password);



  // -------------------------------------------------------------------------- //
  //                                 set session                                //
  // -------------------------------------------------------------------------- //
  if ($stmt->execute()) {
    $last_id = $conn->insert_id; 
    // echo $username;

    $_SESSION['username'] = $username;
    $_SESSION['uid'] = $last_id;
    
    header("Location: /");
  } else {
    header("Location: /signup?error=$error");
  }

    $stmt->close();

  // -------------------------------------------------------------------------- //
  //                                 close stmt                                 //
  // -------------------------------------------------------------------------- //

}

