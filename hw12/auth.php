<?php
session_start();
include_once './../../env.php';
$email = trim($_REQUEST['email']);
$password = $_REQUEST['password'];
$hashPassword = password_hash($password, PASSWORD_BCRYPT);
$errors = [];


//Email Validation
if (empty($email)) {
    $errors['emailError'] = 'Email is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['emailError'] = 'Invalid Email Address';
}
//Password Validation
if (empty($password)) {
    $errors['passwordError'] = 'Password is required';
} elseif (strlen($password) < 8) {
    $errors['passwordError'] = 'Password can not be less than 8 Character.';
}

if (count($errors) > 0) {
    $_SESSION = $errors;
    header('Location: ./../../backend/login.php');
} else {
    $query = "SELECT email, password FROM users WHERE id = 1";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    echo '<pre>';
      print_r($data);
    echo '</pre>';
}
