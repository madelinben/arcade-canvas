<?php

function getDirectoryList($path) {
    print_r(str_replace('../content/', "", glob('../content/*', GLOB_ONLYDIR)));
    return glob($path . '*', GLOB_ONLYDIR);
}

?>