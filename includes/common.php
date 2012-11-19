<?php

/* includes/common.php -- common functions and variables */

error_reporting(0); // turn off all error reporting

$root_dir = "../pdfs/";
$root_url = "http://pdf.phillipian.net/";

$site_url = "http://archives.phillipian.net/";

function isPDF ($file) {
	$ext = substr($file, -4);
	return ($ext == ".pdf");
}

function getThumb($file, $dir) {
        $source = $dir."/$file".'[0]';
        $dest = "thumbs/$file.jpg";
 
        if (!file_exists($dest))
        {
            $exec = "convert -scale 200 -colorspace sRGB -modulate 100,95 '$source' '$dest'";
            exec($exec);
        }
 		return "<img src=\"$dest\" class=\"thumb\"/>";
   }
   
   
function getIssueDate($file) {
	if (strlen($file)== 12){
	$n = substr($file, 0, 2);
	$j = substr($file, 2, 2);
	$Y = substr($file, 4, 4);
	}
	$converted_date = mktime(0,0,0, $n, $j, $Y);
	return date ("F jS, Y", $converted_date);
}

function getHeight($file){
	$size = getimagesize("thumbs/$file.jpg");
	return $size[1];
}

function displayIssues($dir, $year, $root_url) {	
	$files = scandir($dir);
	rsort($files);

	foreach ($files as $file){
		if (isPDF($file)) {
			$filename = str_replace('.pdf', '', $file);
			if ($year >= 2011) $height = 420;
			else if ($year >= 2004) $height = 370;
			else if ($year >= 1975) $height = 350;
			else if ($year >= 1901) $height = 320;
			else $height = 280;

    		echo "<div id=\"$filename\" class=\"issue\" style=\"height: ".$height."px\"><div class=\"mosaic-block fade\" style=\"height: ".getHeight($file)."px\">".
				"<a href=\"$root_url$year/$file\" class=\"mosaic-overlay\">". 
					"<div class=\"details\" style=\"padding-top: ".getHeight($file)*0.4."px\">".
						"<p>Published on <br>".
						getIssueDate($file).
				"</p>".
				'<div class="fb-like" data-href="'.$site_url.'/browse.php?year='.$year.'#'.$file.'" data-send="true" data-layout="button_count" data-width="240" data-show-faces="false"></div>'.
				"</div></a>". 
			"<div class=\"mosaic-backdrop\">".getThumb($file, $dir)."</div></div></div>";
        }
	}
}

function displayRecent($dir, $year, $root_url, $num) {
	$files = scandir($dir);
	rsort($files);
	foreach ($files as $file) {
		if (++$i == $num) break;
		if (isPDF($file)) {
    		echo "<div class=\"issue\"><div class=\"mosaic-block fade\" style=\"height: ".getHeight($file)."px\">".
				"<a href=\"$root_url$year/$file\" class=\"mosaic-overlay\">". 
					"<div class=\"details\" style=\"padding-top: ".getHeight($file)*0.4."px\">".
						"<p>Published on <br>".
						getIssueDate($file).
				"</p></div></a>". 
			"<div class=\"mosaic-backdrop\">".getThumb($file, $year)."</div></div></div>";
        }
	}
}

function getLinkToLatestIssue() {
	
	$year = date('Y');
	$month = date('n');
	$dir = $root_dir.$year;
	
	if (is_dir($dir)) {
		$files = scandir($dir);
		rsort($files);
		return $root_url."$year/$files[0]";
	}
	
	else {
		$dir = $root_dir.($year-1);
		$files = scandir($dir);
		rsort($files);
		return $root_url."$year/$files[0]";
	}
}
?>
