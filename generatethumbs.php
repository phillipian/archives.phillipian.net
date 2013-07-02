<?php

include 'includes/common.php';

$year = date('Y');

for ($y = $year; $y >= 1878; $y--) {
	$dir = $root_dir.$y;
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
		    while (($file = readdir($dh)) !== false) 
		    {
		        if (!is_dir($file) && isPDF($file)) 
		  			{
		            $source = $dir."/$file".'[0]';
			        $dest = "thumbs/$file.jpg";
			 		++$found;
			        if (!file_exists($dest))
			        {
			            $exec = "~/local/bin/convert -scale 200 $source $dest";
			            exec($exec);
			            ++$generated;
			            echo "generated".$file;
			        }
			 		echo "<img src=\"$dest\" />";
		          }
		    }
		    closedir($dh);
		}
	}
}

echo "Found ".$found. " pdfs in the archives.";
echo "Generated ".$generated." thumbnails.";

?>
