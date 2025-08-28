<?php
require "../../Connection/Database.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email != "" && $password != "") {
        $check_user_mail = "SELECT * FROM users WHERE email = '$email' ";
        $email_result = mysqli_query($conn, $check_user_mail);
        // var_dump($email_result);
        if ($email_result->num_rows == 1) {
            // echo "yo";
            $user = mysqli_fetch_assoc($email_result);
            // var_dump($user);
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user']['name'] = $user['name'];
                $_SESSION['user']['email'] = $user['email'];
                $_SESSION['user']['phone'] = $user['phone'];

                $_SESSION['suc'] = "Login Successful";
                header("Location: ../Dashboard.php");
                exit;
            } else {
                echo "wrong password";
            }
        }
    } else {
        echo "Fill all the fields";
    }
}
