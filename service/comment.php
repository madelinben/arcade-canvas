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
            $userID = $_SESSION['user']->id;

            $project = $_POST['project'];

            date_default_timezone_set('Europe/London');
            $date = date('Y-m-d H:i:s');

            $content = $_POST['content'];



            /*VALIDATE INPUT VALUES*/



            /*IDENTIFY PROJECT ID*/
            $sqlProjectID = "SELECT project_ID FROM project WHERE project_Title = ?;";
            $stmtProjectID = mysqli_stmt_init($dbConnection);

            if (!mysqli_stmt_prepare($stmtProjectID, $sqlProjectID)) {
                header('Location: ..\pages\project.php?selected='. $project .'&error=stmtfailed');
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

                header('Location: ..\pages\project.php?selected='. $project .'&error=project');
                exit();
            }

            mysqli_stmt_close($stmtProjectID);



            /*INSERT COMMENT*/
            $sqlComment = "INSERT INTO comment(user_ID, project_ID, comment_Content, comment_Date) VALUES (?,?,?,?);";
            $stmtComment = mysqli_stmt_init($dbConnection);

            if (!mysqli_stmt_prepare($stmtComment, $sqlComment)) {
                header('Location: ..\pages\project.php?selected='. $project .'&error=stmtfailed');
                exit();
            }

            //i=int, d=double, s=string, b=blob
            mysqli_stmt_bind_param($stmtComment, 'iiss', $userID, $projectID, $content, $date);
            mysqli_stmt_execute($stmtComment);
            mysqli_stmt_close($stmtComment);

            // SUCCESS FEEDBACK
            header('Location: ..\pages\project.php?selected='. $project .'&success=comment');
            exit();



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