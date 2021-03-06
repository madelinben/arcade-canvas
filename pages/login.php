<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">

    <!-- PAGE TITLE -->
    <title>Canvas - Login</title>

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
    <link rel="stylesheet" type="text/css" href="..\style\account.css">
</head>

<body>
    <!-- PAGE CONTAINER -->
    <div class="wrapper">

        <!-- NAVBAR -->
        <?php
        require('../includes/header.php');
        require('../service/account.php');
        ?>

        <!-- CONTENT -->
        <div class="content-container">

            <!-- LOGIN -->
            <div class="section form-container">

                <!-- TITLE -->
                <div class="section-title">Login</div> <!--h1-->
                <hr>

                <!-- ERROR MESSAGE -->
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'login') {
                        echo '<p style="float:right;color:red;">Error Logging User In!</p>';
                    } else if ($_GET['error'] == 'email') {
                        echo '<p style="float:right;color:red;">Error! Email provided is invalid.</p>';
                    } else if ($_GET['error'] == 'pwd') {
                        echo '<p style="float:right;color:red;">Error! Password provided is invalid.</p>';
                    } else if ($_GET['error'] == 'empty') {
                        echo '<p style="float:right;color:red;">Error! No input data provided.</p>';
                    } else if ($_GET['error'] == 'stmtfailed') {
                        echo '<p style="float:right;color:red;">Database Connection Error!</p>';
                    }
                }
                ?>

                <!-- FORM -->
                <form action="..\service\account.php" method="post">
                    <div class="flex-vertical">

                        <div>
                            <div class="flex-horizontal">
                                <label for="name"><b>Email</b></label>
                                <input type="text" placeholder="Enter Email" name="email" required>
                            </div>

                            <div class="flex-horizontal">
                                <label for="pwd"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="pwd" required>
                            </div>
                        </div>
                    </div>

                        <div class="account-action">
                            <button type="submit" name="submit-login" class="submit-btn">Login</button>

                    <!--  <label><input type="checkbox" checked="checked" name="remember"> Remember me</label> -->
                    <!--  <span class="psw">Forgot <a href="..\service\reset.php">password?</a></span> -->
                </form>
                <form action="..\pages\register.php">
                    <button type="submit" class="alt-btn">Register</button>
                </form>
                        </div>
                </div>
            </div>

        </div>

        <footer>
            <a href="https://github.com/madelinben/canvas-js"><i class="credit">~ Ben Madelin ~</i></a>
        </footer>
    </div>
</body>

</html>