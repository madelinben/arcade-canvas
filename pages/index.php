<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">

    <!-- PAGE TITLE -->
    <title>Canvas - Home</title>
    <?php /*include ('../includes/title.php'); echo '<title>' . $currentPage . '</title>';*/ ?>

    <!-- SITE META DATA -->
    <meta name="keywords" content="CANVAS, CODING CHALLENGE, GAME, WEB DEVELOPMENT, HTML, CSS, JAVASCRIPT">
    <meta name="description" content="A Collection of re-imagined games turned Challenges to practice Web Development.">
    <meta name="author" content="Ben Madelin">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SITE RESOURCES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/c642229718.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="..\img\favicon.png">

    <!-- PAGE STYLING -->
    <link rel="stylesheet" type="text/css" href="..\style\style.css">
    <link rel="stylesheet" type="text/css" href="..\style\gallery.css">
</head>

<body>
    <!-- PAGE CONTAINER -->
    <div class="wrapper">

        <?php /*include ('../includes/header.php');*/ ?>

        <!--NAVBAR-->
        <header>
            <div class="flex-container">
                <!--<a href="..\pages\index.php" class="nav-logo"><h1>CANVAS CODING CHALLENGES</h1></a>-->
                <!--<a href="..\pages\register.php" class="nav-account"><button><b>+</b></button></a>-->

                <!--<a href="login.php" class="account-container">
                        <img src="..\img\usr-img.png" class="account-image" alt="Profile Picture" style="width:100px;height:100px">
                        </a>-->

                <div class="nav-left">
                    <a href="..\pages\index.php" class="nav-link">Arcade</a>   <!--<i class="fas fa-home"></i>-->
                </div>

                <div class="nav-right">
                    <i class="nav-user">Sign In to play! // User</i>

                    <div class="dropdown-container">
                        <i class="dropdown-action fas fa-user"></i>

                        <!--<img src border-radius />  <i class="fas fa-user"></i>-->
                        <!--<img src="..\img\\' . $projectName . '.png" class="dropdown-action" alt="<?php /*echo <i class="fas fa-user"></i> */?>">-->

                        <div class="dropdown-visibility">
                            <div class="dropdown-content">
                                <a href="..\pages\login.php" class="dropdown-link">Login</a>
                                <a href="..\pages\register.php" class="dropdown-link">Register</a>
                                <hr>
                                <a href="..\pages\profile.php" class="dropdown-link">Settings</a>
                                <a href="..\pages\#.php" class="dropdown-link">Support</a>   <!--<i class="fas fa-envelope"></i>-->
                            </div>
                        </div>
                    </div>
                </div>



            </div>
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

        <?php /*include ('../includes/footer.php');*/ ?>

        <footer>
            <a href="https://github.com/madelinben/canvas-js"><i class="credit">~ Ben Madelin ~</i></a>
        </footer>
    </div>
</body>

<script>
/*    document.querySelector(".right ul li").addEventListener("click", function(){
        this.classList.toggle("active");
    });

        $(function(){
            $('#close').live('click',function(){
                $('#main').show();
                $('#login').hide();
            });
        });*/
</script>

</html>