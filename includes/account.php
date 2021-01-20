<?php

//js perhaps faster and doesnt have to reload

$accountBtn = 'Sign In';
console.log($_SESSION['user']);

if (isset($_SESSION['user'])) {

} else {

}





if ($identifyPage == 'index.php') {
    $currentPage = 'Home';
} elseif (strpos($identifyPage, 'login.php') !== false) {
    $currentPage = 'Account - Login';
} elseif (strpos($identifyPage, 'register.php') !== false) {
    $currentPage = 'Account - Register';
} elseif (strpos($identifyPage, 'profile.php') !== false) {
    $currentPage = 'Account - Profile';
} elseif (strpos($identifyPage, 'project.php') !== false) {
    if (isset($_GET['selected'])) {
        $currentPage = 'Project - ' . $_GET['selected'];
    } else {
        $currentPage = 'Error - Unidentified Project';
    }
}

if (empty($currentPage)) {
    $currentPage = 'Error - Page Not Found!';
}