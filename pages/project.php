<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">

<?php
if (isset($_GET['selected'])) {
    $selectedProject = ucfirst($_GET['selected']);
} else {
    $selectedProject = 'Error!';
}

date_default_timezone_set('Europe/London');
?>

<head>
    <meta charset="UTF-8">

    <!-- PAGE TITLE -->
    <title>Canvas - <?php echo $selectedProject ?></title>

    <!-- SITE META DATA -->
    <meta name="keywords" content="CANVAS, CODING CHALLENGE, GAME, WEB DEVELOPMENT, HTML, CSS, JAVASCRIPT">
    <meta name="description" content="A Collection of re-imagined games turned Challenges to practice Web Development.">
    <meta name="author" content="Ben Madelin">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SITE RESOURCES -->
    <script src="https://kit.fontawesome.com/c642229718.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="..\img\favicon.png">

    <!-- PAGE STYLING -->
    <link rel="stylesheet" type="text/css" href="..\style\style.css">
    <script type="text/javascript" src="..\scripts\dropdown.js"></script>
    <link rel="stylesheet" type="text/css" href="..\style\form.css">
    <link rel="stylesheet" type="text/css" href="..\style\project.css">

</head>

<body>
    <!-- PAGE CONTAINER -->
    <div class="wrapper">

        <!-- NAVBAR -->
        <?php require('../includes/header.php'); ?>

        <!-- CONTENT -->
        <div class="content-container">
            <?php
            if ($selectedProject == 'Error!') {
                echo '<div class="section">
                      <div class="section-title">Error!</div>
                      <hr>
                      <div class="section-title">Selected project is Unavailable!</div>';
            } else { ?>

                <div class="section">
                    <div class="section-title"><div class="section-title"><?php echo $selectedProject ?></div></div>
                    <hr>

                    <div class="flex-horizontal project-container">
                        <div class="environment-container">
                            <canvas class="canvas">Your browser does not support HTML5 Canvas.</canvas>
                        </div>

                        <div class="flex-vertical">
                            <div class="stats-container">
                                <!--<h1 class="current-score">Score: </h1>
                                <h1 class="high-score">Best: </h1>-->
                                <img src="..\img\profile\default.png" class="stats-profile" alt="Profile Picture">
                                <label class="current-score">Score: </label>
                                <label class="high-score"> Best: </label>
                            </div>

                            <div class="feedback-container">
                                <form action="..\service\project.php" method="post" class="flex-vertical feedback-content">
                                    <button type="submit" name="submit-like" id="like-btn">
                                        <!--<i class="fas fa-heart"></i>--> <!--LIKE-->
                                        <!--<i class="fas fa-heart-broken"></i>--> <!--DISLIKE-->
                                        <i class="far fa-heart"></i> <!--DEFAULT-->
                                        Like</button>

                                    <button type="submit" name="submit-share" id="share-btn">
                                        <i class="fas fa-share"></i>
                                        Share</button>

                                    <button type="submit" name="submit-share" id="share-btn">
                                        <i class="fas fa-flag"></i>
                                        Report</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

                <br />

                <div class="section">
                    <div class="section-title">Leaderboard</div>
                    <hr>
                </div>

                <br />

                <div class="section">
                    <div class="section-title">Comment</div>
                    <hr>

                    <!--CREATE COMMENT-->
                    <div class="sub-section">
                        <div class="flex-horizontal comment-create-container">
                            <img src="..\img\profile\default.png" class="comment-profile" alt="Profile Picture">

                                    <form action="..\service\comment.php" method="post" class="comment-form flex-vertical comment-content">
                                        <input type="hidden" name="uid" value="Anonymous">
                                        <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s') ?>">

                                        <textarea placeholder="SOMETHING INTERESTING AND INFORMATIVE" name="content" required oninput="this.style.height = '';this.style.height = this.scrollHeight + 'px'"></textarea>
                                        <button type="submit" name="submit-comment" class="submit-btn">Post</button>
                                    </form>
                        </div>


                    </div>
                    <hr>

                    <!--PARENT COMMENTS-->



                </div>
            <?php } ?>
        </div>

        <footer>
            <a href="https://github.com/madelinben/canvas-js"><i class="credit">~ Ben Madelin ~</i></a>
        </footer>
    </div>
</body>

<?php
$url = basename($_SERVER['REQUEST_URI']);

if ((strpos($url, 'project.php') !== false) && (isset($_GET['selected']))) {
    $selectedProject = $_GET['selected'];

    $projectDir = '..\content\\' . $selectedProject;
    $scriptFiles = glob($projectDir . '\*.js');



    //sortDependencies
    $dependencies = array('draw.js');
    $conflictFiles = array();

    foreach($dependencies as $compare) {
        for ($i=0; $i<count($scriptFiles); $i++) {
            //Remove Conflicts
            if (strpos($scriptFiles[$i], $compare) !== false) {
                $conflictFiles[] = $scriptFiles[$i];
                unset($scriptFiles[$i]);
                break;
            }
        }
    }

    //Ordered Dependencies
    array_push($scriptFiles, ...$conflictFiles);

    //formatScriptElements
    foreach($scriptFiles as $file) {
        echo '<script type="text/javascript" src="' . $file . '"></script>';
    }
}
?>

<script type="text/javascript" src="..\scripts\sketch.js"></script> <!--module-->

</html>