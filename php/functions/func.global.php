<?php

function __autoload($className)
{
    // Folders to search
    $folders = getSubfolders('php/');

    // Filename to search for classes
    $filenames = array(
        'class' => 'class.' . $className . '.php',
        'default' => $className . '.php',
    );

    // Also search for namespaced classes
    $array = explode('\\', $className);

    if (count($array) > 1) {
        $filenames['default'] = $array[count($array) - 1] . '.php';
    }

    // Loop all folder & filename combinations and include if a file is found
    foreach ($folders as $filepath) {
        foreach ($filenames as $filename) {
            if (file_exists($filepath . $filename)) {
                include $filepath . $filename;
                break;
            }
        }
    }
}

/**
 * Recursively retrieve all subfolders for a specified folder
 *
 * @param string $folder
 *
 * @return array a list of subfolders
 */
function getSubfolders($folder)
{
    $folderList = array();
    foreach (scandir($folder) as $file) {
        $folderString = $folder . $file . '/';
        if (is_dir($folderString)) {
            if ($file != '.' && $file != '..') {
                $folderList[] = $folderString;
                $folderList = array_merge($folderList, getSubfolders($folderString));
            }
        }
    }

    return $folderList;
}