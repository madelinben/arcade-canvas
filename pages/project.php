<!DOCTYPE html>
<html lang="en-US">

<?php
if (isset($_GET['selected'])) {
    $selectedProject = ucfirst($_GET['selected']);
} else {
    $selectedProject = 'Error!';
}
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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="..\img\favicon.png">

    <!-- PAGE STYLING -->
    <link rel="stylesheet" type="text/css" href="..\style\style.css">
    <link rel="stylesheet" type="text/css" href="..\style\project.css">
</head>

<body>
    <!-- PAGE CONTAINER -->
    <div class="wrapper">
        <header>
            <div class="flex-container">
                <a href="..\pages\index.php" class="nav-logo"><h1>CANVAS CODING CHALLENGES</h1></a>
                <a href="..\pages\account.php" class="nav-account"><button><b>Account</b></button></a>
            </div>
        </header>

        <!-- CONTENT -->
        <div class="project-container">
            <?php
            if ($selectedProject == 'Error!') {
                echo '<div class="section">
                      <div class="section-title">Error!</div>
                      <hr>
                      <div class="section-title">Selected project is Unavailable!</div>';
            } else { ?>

                <div class="section">
                    <div class="section-title"><?php echo $selectedProject ?></div>
                    <hr>

                    <div class="interactive-container">
                        <div class="environment-container">
                            <canvas class="canvas">Your browser does not support HTML5 Canvas.</canvas>
                        </div>

                        <div class="stats-container">
                            <h1 class="current-score">Score: </h1>
                            <h1 class="high-score">Best: </h1>
                            <h1 class="like-btn">Like!</h1>
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