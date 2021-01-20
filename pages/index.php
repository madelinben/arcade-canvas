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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                    <a href="..\pages\index.php" class="nav-link">Arcade</a>
                </div>

                <div class="nav-right">

                    <?php
                    if (isset($_SESSION['user'])) {
                        echo '<i class="nav-user">' . $_SESSION['user'] . '</i>';
                    } else {
                        echo '<i class="nav-user">Sign In to play!</i>';
                    }
                    ?>

                    <div class="dropdown-container">
                        <img src="..\img\profile\default.png" class="dropdown-action" alt="Profile Picture">

                        <div class="dropdown-visibility">
                            <div class="dropdown-content">

                                <?php if (isset($_SESSION['user'])) { ?>

                                    <div class="action-terminate">
                                        <a href="..\pages\register.php" class="dropdown-link terminate-btn"><button><i class="fas fa-hand-sparkles"></i>Bye Bye MotherTrucker!</button></a>
                                    </div>

                                <?php } else { ?>

                                    <div class="action-account">
                                        <a href="..\pages\register.php" class="dropdown-link"><button><i class="fas fa-rocket"></i>Register</button></a>
                                        <a href="..\pages\login.php" class="dropdown-link"><button><i class="fas fa-user-astronaut"></i>Login</button></a>
                                    </div>

                                <?php } ?>

                                <div class="action-info">
                                    <a href="..\pages\profile.php" class="dropdown-link"><button><i class="fas fa-cog"></i>Settings</button></a>
                                    <a href="..\pages\#.php" class="dropdown-link"><button><i class="fas fa-question-circle"></i>Support</button></a>
                                </div>
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

<script type="text/javascript">
    $(document).ready(function() {
        $(document).click(function(e) {
            const targetElement = e.target.className;
            //alert(targetElement.toString());
            const dropdownContent = $(".dropdown-visibility");
            if (targetElement === 'dropdown-action') {
                $('.dropdown-visibility').toggle();
            } else if (dropdownContent.is(":visible") && (!dropdownContent.is(e.target) && dropdownContent.has(e.target).length===0)) {
                dropdownContent.hide();
            }
        });
    });
</script>

</html>