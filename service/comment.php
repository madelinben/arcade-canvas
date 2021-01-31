<?php
//require('../service/account.php');

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

function retrieveComments($project) {
    // SETUP DATABASE CONNECTION
    $serverName = "localhost";
    $dbUser = "root";
    $dbPwd = "";
    $dbName = "arcade_canvas";

    $dbConnection = mysqli_connect($serverName, $dbUser, $dbPwd, $dbName);

    if (!$dbConnection) {
        die("Connection to Database Failed! : " . mysqli_connect_error());
    } else {

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
        } else {
            header('Location: ..\pages\project.php?selected='. $project .'&error=project');
            exit();
        }

        mysqli_stmt_close($stmtProjectID);

        /*RETRIEVE PROJECT COMMENTS*/
        //$sqlGetComments = "SELECT * FROM comment WHERE project_ID = ? AND comment_parent_ID IS NULL;";

        $sqlGetComments = "SELECT user.user_Name, user.user_Pic, comment.comment_Content
        FROM user INNER JOIN comment ON comment.user_ID = user.user_ID
        WHERE comment.project_ID = ? AND comment.comment_parent_ID IS NULL;";
        $stmtGetComments = mysqli_stmt_init($dbConnection);

        if (!mysqli_stmt_prepare($stmtGetComments, $sqlGetComments)) {
            header('Location: ..\pages\project.php?selected='. $project .'&error=stmtfailed');
            exit();
        }

        mysqli_stmt_bind_param($stmtGetComments, 'i', $projectID);
        mysqli_stmt_execute($stmtGetComments);
        $resultGetComments = mysqli_stmt_get_result($stmtGetComments);

        //$conn->query($sql)->fetch_assoc()
        while ($row = mysqli_fetch_assoc($resultGetComments)) {
            //echo $row['user_Name'] . PHP_EOL . $row['user_Pic'] . PHP_EOL . $row['comment_Content'];

            echo '<div class="flex-vertical view-comment-container">
                <div class="flex-horizontal view-comment-action">
                    <div class="flex-horizontal">
                        <img src="..\\' . $row['user_Pic'] . '" class="comment-profile" alt="Profile Picture">
                        <div class="view-comment-username">' . $row['user_Name'] . '</div>
                    </div>';

            if (isset($_SESSION['user'])) {
                if ($_SESSION['user'] = $row['user_Name']) {
                    echo '<form action="..\service\comment.php" method="post" class="view-comment-remove">
                                <button type="submit" name="delete-comment" class="terminate-btn">X</button>
                            </form>';
                }
            }

            echo '</div>
                        <div class="view-comment-content">' . $row['comment_Content'] . '</div>
                    </div>';
        }
    }
//    return $resultGetComments;
}

/*function getProjectID($projectTitle) {

}*/

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
            } else {
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