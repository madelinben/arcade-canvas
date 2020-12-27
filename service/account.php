<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['submit-register'])) {
    try {
        // VALIDATE FORM
        $username = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['pwd'];
        $confirmPassword = $_POST['pwd-repeat'];

        echo $username;

    } catch (Exception $e) {
        echo 'Register Error: ' . $e->getMessage();
    }
}