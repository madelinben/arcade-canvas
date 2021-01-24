<?php
require('../service/account.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// FORMAT OBJECT
class Comment {
    public $id;
    public $parent;
    public $user;
//    public $project;
    public $content;
//    public $date;

    function constructor($id, $parent, $user, $content) {
        $this->id = $id;
        $this->parent = $parent;
        $this->user = $user;
        $this->content = $content;
    }
}

// SETUP DATABASE CONNECTION
$serverName = "localhost";
$dbUser = "root";
$dbPwd = "";
$dbName = "arcade_canvas";

$dbConnection = mysqli_connect($serverName, $dbUser, $dbPwd, $dbName);

if (!$dbConnection) {
    die("Connection to Database Failed! : " . mysqli_connect_error());
} else {

    // CREATE ACTION
    if (isset($_POST['submit-comment'])) {
        try {
            // OBTAIN REGISTER INPUT VALUES
            $user = $_POST['uid'];
            $date = $_POST['date'];
            $content = $_POST['content'];

            $project = $_POST['project'];

            /*$_SESSION['user']-> {id, username, email, pic};*/



            /*VALIDATE INPUT VALUES*/









            /*if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) { // CHECK EMPTY FIELDS
                header('Location: ..\pages\register.php?error=empty&user=' . $username . '&email=' . $email);
                exit();
            }else {
                echo 'comment clicked: ' . $content;*/






                /*// CHECK USER DOESNT ALREADY EXIST
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


            }*/


            //project title
            //userid











        } catch (Exception $e) {
            // ERROR FEEDBACK
            echo 'Create Error: ' . $e->getMessage();
        }



    } elseif (isset($_POST['submit-delete'])) {
        try {

        } catch (Exception $e) {
            // ERROR FEEDBACK
            echo 'Delete Error: ' . $e->getMessage();
        }
    }
}