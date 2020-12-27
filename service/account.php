<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['submit-register'])) {
    try {
        // OBTAIN REGISTER INPUT VALUES
        $username = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
        $confirmPassword = password_hash($_POST['pwd-repeat'], PASSWORD_DEFAULT);

        // VALIDATE FORM
        if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) { // CHECK EMPTY FIELDS
            header('Location: ..\pages\register.php?error=empty&user=' . $username . '&email=' . $email);
            exit();
        } else if (! filter_var($email, FILTER_VALIDATE_EMAIL) && ! preg_match('/^[a-zA-Z0-9]*$/', $username)) { // CHECK BOTH INPUTS
            header('Location: ..\pages\register.php?error=invaliduseremail');
            exit();
        } else if (! filter_var($email, FILTER_VALIDATE_EMAIL)) { // CHECK VALID EMAIL
            header('Location: ..\pages\register.php?error=invalidemail&user=' . $username);
            exit();
        } else if (! preg_match('/^[a-zA-Z0-9]*$/', $username)) { // CHECK SPECIAL CHARACTERS
            header('Location: ..\pages\register.php?error=invaliduser&email=' . $email);
            exit();
        } else if ($password !== $confirmPassword) { // CHECK PASSWORDS MATCH
            header('Location: ..\pages\register.php?error=pwdcheck&user' . $username . '&email' . $email);
            exit();
        } else {
            // SETUP MYSQL DATABASE CONNECTION WITH PHPMYADMIN

            // CHECK USER DOESNT ALREADY EXIST

            // HASH PASSWORD

            // ADD USER TO DATABASE

            // STORE USER INFO IN OBJECT

            // UPDATE USERID SESSION

            // SUCCESS FEEDBACK
            header('Location: ..\pages\profile.php?success=register&user=' . $username);
            exit();
        }

    } catch (Exception $e) {
        // ERROR FEEDBACK
        echo 'Register Error: ' . $e->getMessage();
    }
}