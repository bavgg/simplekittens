<?php
ob_start();

session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

// -------------------------------------------------------------------------- //
//                       create or update address table                       //
// -------------------------------------------------------------------------- //


if (!isset($_SESSION['uid'])) {
        header("location: /checkout?error=<h2 style='color: red;'>User not logged in.</h2>");
        exit();
} else {
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $uid = intval($_SESSION['uid']);

        $sql = "INSERT INTO Address (full_name, phone_number, address, user_id) VALUES (?, ?, ?, ?) 
        ON DUPLICATE KEY UPDATE full_name = VALUES(full_name), phone_number = VALUES(phone_number), address = VALUES(address)";

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("sssi", $fullname, $phone, $address, $uid);

        if ($stmt->execute()) {
                $stmt->close();
                $conn->close();
                header("Location: /checkout?success=Address updated&fullname=" . $fullname . "&phone=" . $phone . "&address=" . $address);
                exit(); // Ensure the script stops executing after the redirect
        } else {
                $error = $stmt->error;
                $stmt->close();
                $conn->close();
                header("Location: /checkout?error=" . urlencode("Address didn't save: $error"));
                exit(); // Ensure the script stops executing after the redirect
        }
}
ob_end_flush();
