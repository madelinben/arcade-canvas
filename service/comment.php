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
            //comment_ID
            //comment_parent
            //user_ID
            //project_ID
            //comment_content
            //comment_date

            // OBTAIN VALUES
            $user = $_SESSION['user']->id;

            $project = $_POST['project'];

            date_default_timezone_set('Europe/London');
            $date = date('Y-m-d H:i:s');

            $content = $_POST['content'];



            /*VALIDATE INPUT VALUES*/



            /*IDENTIFY PROJECT ID*/
            $sqlProjectID = "SELECT project_ID FROM project WHERE project_Title = ?;";
            $stmtProjectID = mysqli_stmt_init($dbConnection);

            if (!mysqli_stmt_prepare($stmtProjectID, $sqlProjectID)) {
                header('Location: ..\pages\register.php?error=stmtfailed');
                exit();
            }

            mysqli_stmt_bind_param($stmtProjectID, 's', $project);
            mysqli_stmt_execute($stmtProjectID);
            $resultProjectID = mysqli_stmt_get_result($stmtProjectID);

            if ($record = mysqli_fetch_assoc($resultProjectID)) {
                $projectID = $record['project_ID'];
                echo $projectID;

            } else {
                echo 'error identifying project id';

                header('Location: ..\pages\project.php?selected=' . $project . 'error=project');
                exit();
            }

            mysqli_stmt_close($stmtProjectID);



            /*INSERT COMMENT*/
            $sqlProjectID = "INSERT INTO comment(user_Name, user_Email, user_Hash_Pwd) VALUES (?,?,?);";
            $stmtProjectID = mysqli_stmt_init($dbConnection);

            if (!mysqli_stmt_prepare($stmtProjectID, $sqlProjectID)) {
                header('Location: ..\pages\register.php?error=stmtfailed');
                exit();
            }

            mysqli_stmt_bind_param($stmtProjectID, 's', $project);
            mysqli_stmt_execute($stmtProjectID);
            $resultProjectID = mysqli_stmt_get_result($stmtProjectID);

            if ($record = mysqli_fetch_assoc($resultProjectID)) {
                $projectID = $record['project_ID'];
                echo $projectID;

            } else {
                echo 'error identifying project id';

                header('Location: ..\pages\project.php?selected=' . $project . 'error=project');
                exit();
            }

            mysqli_stmt_close($stmtProjectID);










                    $sqlUserCreate = ;
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