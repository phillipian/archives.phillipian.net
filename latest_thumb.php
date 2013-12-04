<?php

include 'includes/common.php';
$year = date('Y');
$dir = $root_dir.$year;

if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if (!is_dir($file) && isPDF($file)) {
                $files[] = $file;
            }
        }
        closedir($dh);
    }
}

$last = $files[count($files)-1];
$redirect = $site_url."thumbs/$last.jpg";
header("Location: $redirect");

?>
