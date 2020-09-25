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
        <link rel="stylesheet" type="text/css" href="..\style\gallery.css">

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
        <div class="gallery">
            <?php
            $path = "../content/";
            $dirList = glob($path . '*', GLOB_ONLYDIR);

            foreach($dirList as $i) {
                $projectName = str_replace($path, "", $i);

                echo '<a href="..\pages\project.php?selected=' . $projectName . '" class="tile-container">' .
                    '<img src="..\img\\' . $projectName . '.png" class="tile-image" alt="' . ucfirst($projectName) . '" style="width:300px;height:300px">' .
                    '<div class="tile-overlay">
                    <div class="tile-content">' . ucfirst($projectName) . '</div>
                </div>
            </a>';
            } ?>
        </div>

        <footer>
            <a href="..\pages\index.php" class="scroll-up"><button><b>Back to Top</b></button></a>
            <i>~ Ben Madelin ~</i>
        </footer>

    </div>
    </body>

    </html>