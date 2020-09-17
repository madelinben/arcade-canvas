<?php

function getDirectoryList($path) {
    print_r(str_replace('../content/', "", glob('../content/*', GLOB_ONLYDIR)));
    return glob($path . '*', GLOB_ONLYDIR);
}

function importScriptFiles($path) {
    $url = basename($_SERVER['REQUEST_URI']);

    if ((strpos($url, 'project.php') !== false) && (isset($_GET['selected']))) {
        $selectedProject = $_GET['selected'];

        $projectDir = '..\content\\' . $selectedProject;
        $scriptFiles = glob($projectDir . '/*.js');

        orderByDependencies($scriptFiles);

        foreach($scriptFiles as $file) {
            echo '<script type="text/javascript" src="' . $file . '"></script>';
        }
    }
}

function orderByDependencies($fileList) {
        $dependencies = 'draw.js';
        $index = array_search($dependencies, $fileList);
        $shift = count($fileList) - $index;

        $dependencyValue =  $fileList[$index];
        $swapValue = $fileList[count($fileList)-1];

        $scriptFiles[$index] = $swapValue;
        $scriptFiles[count($scriptFiles)-1] = $dependencyValue;
    }

?>