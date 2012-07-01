<?php 

include 'includes/common.php';
$year = date('Y');
$dir = "";

while (is_dir($dir) == false) {
	$randYear = mt_rand(1878, $year);
	$dir = $root_dir.$randYear;
}

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

$rand = mt_rand(0, count($files)-1);
$redirect = $root_url.$randYear."/".$files[$rand];
header("Location: $redirect"); 
?>