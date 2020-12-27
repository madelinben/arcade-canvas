<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['submit-register'])) {
    try {
        // OBTAIN REGISTER INPUT VALUES
        $username = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['pwd'];
        $confirmPassword = $_POST['pwd-repeat'];

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
            $serverName = "localhost";
            $dbUser = "root";
            $dbPwd = "";
            $dbName = "arcade_canvas";

            $dbConnection = mysqli_connect($serverName, $dbUser, $dbPwd, $dbName);

            if (!$dbConnection) {
                die("Connection Failed! : " . mysqli_connect_error());
            } else {
                echo "Connection Successful! : ";
            }

            // CHECK USER DOESNT ALREADY EXIST
            $sqlUserExist = "SELECT * FROM user WHERE user_Name = ? OR user_Email = ?;";
            $stmtUserExist = mysqli_stmt_init($dbConnection);
            if (!mysqli_stmt_prepare($stmtUserExist, $sqlUserExist)) {
                header('Location: ..\pages\register.php?error=stmtfailed');
                exit();
            }
            mysqli_stmt_bind_param($stmtUserExist, 'ss', $username, $email);
            mysqli_stmt_execute($stmtUserExist);

            $resultUserExist = mysqli_stmt_get_result($stmtUserExist);
            // USER EXISTS
            if ($record = mysqli_fetch_assoc($resultUserExist)) {
                header('Location: ..\pages\register.php?error=accountexists');
                exit();
            } else {
                // ADD USER TO DATABASE
                $sqlUserCreate = "INSERT INTO user(user_Name, user_Email, user_Hash_Pwd) VALUES (?,?,?);";
                $stmtUserCreate = mysqli_stmt_init($dbConnection);
                if (!mysqli_stmt_prepare($stmtUserCreate, $sqlUserCreate)) {
                    // ERROR FEEDBACK
                    header('Location: ..\pages\register.php?error=stmtfailed');
                    exit();
                }
                // HASH PASSWORD
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                // EXECUTE STATEMENT
                mysqli_stmt_bind_param($stmtUserCreate, 'sss', $username, $email, $hashPassword);
                mysqli_stmt_execute($stmtUserCreate);
                mysqli_stmt_close($stmtUserCreate);
                // SUCCESS FEEDBACK
                header('Location: ..\pages\register.php?success=accountcreated');
                exit();
            }
            mysqli_stmt_close($stmtUserExist);

            // STORE USER INFO IN OBJECT

            // UPDATE USERID SESSION

            header('Location: ..\pages\profile.php?success=register&user=' . $username);
            exit();
        }

    } catch (Exception $e) {
        // ERROR FEEDBACK
        echo 'Register Error: ' . $e->getMessage();
    }
} /*else {
    header('Location: ..\pages\login.php');
    exit();
}*/