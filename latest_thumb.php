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

$last = count($files);
print getThumb($files[$last], $root_dir);

?>
