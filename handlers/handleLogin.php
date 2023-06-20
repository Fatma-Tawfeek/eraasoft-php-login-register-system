<?php 

session_start();

include '../core/functions.php';
include '../core/validations.php';

$errors = [];

if(checkRequestMethod("POST") && checkPostInput('email')) {
    foreach($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }

    // Email validations
    if(!requiredVal($email)) {
        $errors[] = "email is required";
    } elseif(!emailVal($email)) {
        $errors[] = "please type a valid email";
    } 

    // Password validations
    if(!requiredVal($password)) {
        $errors[] = "password is required";
    }

    // Login validations
    if(!checkLogin($email, $password)) {
        $errors[] = "Email or Password is incorrect";
    }

    if(empty($errors)) {
        $name = checkLogin($email, $password)[0];
        // redirect
        $_SESSION['auth'] = [$name, $email];
        redirect("../index.php");
        die();
    } else {
        $_SESSION['errors'] = $errors;
        redirect("../login.php");
        die();
    }

} else {
    echo "Not supported method";
}