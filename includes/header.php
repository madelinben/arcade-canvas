<!--<script src="https://kit.fontawesome.com/c642229718.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="..\scripts\dropdown.js"></script>-->

<header>
    <div class="flex-container">

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