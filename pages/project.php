<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">

    <!-- PAGE TITLE -->
    <title>Canvas - Home</title>

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
        <a href="..\pages\index.php" class="nav-logo"><h1>CANVAS CODING CHALLENGES</h1></a>

        <nav>
            <ul class="nav-link">
                <li><a href="..\pages\about.php">Personal Portfolio</a></li>
                <li><a href="..\pages\index.php">Project Gallery</a></li>
            </ul>
        </nav>

        <a href="..\pages\account.php" class="nav-account"><button><b>Account</b></button></a>
    </header>

    <!-- CONTENT -->
    <div class="project-container">

        <canvas class="canvas" height="300" width="300" style="background-color: #e0f8cf">Your browser does not support HTML5 Canvas.</canvas>

        <span class="profile-stats-container">
            <h1 class="score">Score: </h1>
        </span>


        <!--Black = #071821
        Dark Green = #306850
        Light Green = #86c06c
        Lime = #e0f8cf-->

    </div>

    <footer>
        <a href="..\pages\index.php" class="scroll-up"><button><b>Back to Top</b></button></a>
        <i>~ Ben Madelin ~</i>
    </footer>

</div>
</body>

<?php
$url = basename($_SERVER['REQUEST_URI']);

if ((strpos($url, 'project.php') !== false) && (isset($_GET['selected']))) {
    $selectedProject = $_GET['selected'];

    $projectDir = '..\content\\' . $selectedProject;
    $scriptFiles = glob($projectDir . '/*.js');

    //sortDependencies
    $dependencies = array('draw.js');
    $conflictFiles = array();

    foreach($dependencies as $compare) {
        for ($i=0; $i<count($dependencies); $i++) {
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

} /*else {
    echo '<div class="game-section"><h2>NO DATA AVAILABLE FOR SELECTED TITLE</h2></div>';
}*/
?>

</html>