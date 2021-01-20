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
                if (isset($_GET['terminate'])) {
                    if ($_GET['terminate'] == 'true') {
                        echo '<i class="nav-user">Sign Out Successful!</i>';
                    }
                } else {
                    echo '<i class="nav-user">Sign In to play!</i>';
                }
            }
            ?>

            <div class="dropdown-container">
                <img src="..\img\profile\default.png" class="dropdown-action" alt="Profile Picture">

                <div class="dropdown-visibility">
                    <div class="dropdown-content">

                        <?php if (isset($_SESSION['user'])) { ?>

                            <div class="action-terminate">
                                <form action="..\service\account.php" method="post">
                                    <button type="submit" name="submit-logout" id="terminate-btn"><i class="fas fa-hand-sparkles"></i>Bye Bye MotherTrucker!</button>
                                </form>
                            </div>

                        <?php } else { ?>

                            <div class="action-account">
                                <a href="..\pages\register.php"><button><i class="fas fa-rocket"></i>Register</button></a>
                                <a href="..\pages\login.php"><button><i class="fas fa-user-astronaut"></i>Login</button></a>
                            </div>

                        <?php } ?>

                        <div class="action-info">
                            <a href="..\pages\profile.php"><button><i class="fas fa-cog"></i>Settings</button></a>
                            <a href="..\pages\#.php"><button><i class="fas fa-question-circle"></i>Support</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</header>