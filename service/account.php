<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// FORMAT OBJECT
class Account {
    public $username;
    public $email;

    /*
     * profile img
     * high scores
     *
     * preferences
    */

    function constructor($username, $email) {
        $this->username = $username;
        $this->email = $email;
    }
}

// SETUP MYSQL DATABASE CONNECTION WITH PHPMYADMIN
$serverName = "localhost";
$dbUser = "root";
$dbPwd = "";
$dbName = "arcade_canvas";

$dbConnection = mysqli_connect($serverName, $dbUser, $dbPwd, $dbName);

if (!$dbConnection) {
    die("Connection to Database Failed! : " . mysqli_connect_error());
} else {
    //echo "Connection Successful! : ";


    // REGISTER ACTION
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
                }
                mysqli_stmt_close($stmtUserExist);

                // STORE USER INFORMATION CONTAINED IN REFERENCE OBJECT
                $userInfo = new Account();
                $userInfo->constructor($username, $email);

                // CREATE  USERID SESSION
                $_SESSION['user'] = $userInfo;

                // SUCCESS FEEDBACK
                header('Location: ..\pages\profile.php?success=register&user=' . $username);
                exit();
            }
        } catch (Exception $e) {
            // ERROR FEEDBACK
            echo 'Register Error: ' . $e->getMessage();
        }


    // LOGIN ACTION
    } else if (isset($_POST['submit-login'])) {
        try {
            // OBTAIN REGISTER INPUT VALUES
            $email = $_POST['email'];
            $password = $_POST['pwd'];

            // VALIDATE FORM
            if (empty($email) || empty($password)) { // CHECK EMPTY FIELDS
                header('Location: ..\pages\login.php?error=empty&email=' . $email);
                exit();
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // CHECK VALID EMAIL
                header('Location: ..\pages\login.php?error=email');
                exit();
            } else {
                // CHECK USER EXIST
                $sqlUserLogin = "SELECT * FROM user WHERE user_Email = ?;";
                $stmtUserLogin = mysqli_stmt_init($dbConnection);
                if (!mysqli_stmt_prepare($stmtUserLogin, $sqlUserLogin)) {
                    header('Location: ..\pages\register.php?error=stmtfailed');
                    exit();
                }
                mysqli_stmt_bind_param($stmtUserLogin, 's', $email);
                mysqli_stmt_execute($stmtUserLogin);

                $resultUserLogin = mysqli_stmt_get_result($stmtUserLogin);
                // USER EXISTS
                if ($record = mysqli_fetch_assoc($resultUserLogin)) {
                    //VALIDATE PASSWORD
                    $hashPassword = $record["user_Hash_Pwd"];
                    if (password_verify($password, $hashPassword)) {
                        /*session_start();*/

                        // STORE USER INFORMATION CONTAINED IN REFERENCE OBJECT
                        $userInfo = new Account();
                        $userInfo->constructor($record["user_Name"], $record["user_Email"]);

                        // CREATE USERID SESSION
                        $_SESSION['user'] = $userInfo;

                        header('Location: ..\pages\profile.php?success=login&user=' . $record["user_Name"]);
                        exit();
                    } else {
                        header('Location: ..\pages\login.php?error=pwd');
                        exit();
                    }
                } else {
                    header('Location: ..\pages\login.php?error=login');
                    exit();
                }
                mysqli_stmt_close($stmtUserLogin);
            }
        } catch (Exception $e) {
            echo 'Login Error: ' . $e->getMessage();
        }


    // TERMINATE ACTION
    } else if (isset($_POST['submit-logout'])) {
        try {
            /* session_start(); */
            session_unset();
            session_destroy();
            header('Location: ..\pages\index.php?terminate=true');
        } catch (Exception $e) {
            echo 'Logout Error: ' . $e->getMessage();
        }



    } /*else {
        header('Location: ..\pages\login.php');
        exit();
    }*/
}