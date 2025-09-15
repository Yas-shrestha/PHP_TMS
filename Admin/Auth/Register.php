<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../../Connection/Database.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // var_dump($_POST);
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cPass = $_POST['CPass'];
    if ($name != "" && $phone != "" && $email != "" && $password != "" && $cPass != "") {
        $check_user_mail = "SELECT * FROM users WHERE email = '$email' ";
        $email_result = mysqli_query($conn, $check_user_mail);
        // var_dump($email_result);
        if ($email_result->num_rows == 0) {
            // echo "yo";
            if ($password === $cPass) {
                $hashPassword = password_hash($password, PASSWORD_BCRYPT);
                // var_dump($hashPassword);
                $insert_query = "INSERT INTO users(name,email,phone,password) VALUES ('$name','$email','$phone','$hashPassword') ";
                $insert_result = $conn->query($insert_query);
                if ($insert_result) {
                    header('Location: /index.php');
                }
            } else {
                echo "password must be same";
            }
        } else {
            echo "email already exist";
        }
    } else {
        echo "Fill all the fields";
    }
}
