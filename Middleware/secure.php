<?php
session_start();
if (empty($_SESSION['user'])) {
    $_SESSION['err'] = "Please log in";
    header("location: /index.php");
};
