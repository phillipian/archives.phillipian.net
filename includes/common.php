<?php
// Built by Eric Ouyang '13 (CXXXIV/CXXXV)

/* includes/common.php -- common functions and variables */

error_reporting(0); // production site, turn off all error reporting

// config vars -- passed in as params for the functions
$root_dir = "../pdfs/";
$root_url = "http://pdf.phillipian.net/";
$site_url = "http://archives.phillipian.net/";

// is the file a PDF file? (based on extension of file name)
function isPDF ($file) {
	$ext = substr($file, -4);
	return ($ext == ".pdf");
}

// returns the HTML for the thumbnail of a given PDF file. If doesn't exist, generates it.
function getThumb($file, $dir) {
        $source = $dir."/$file".'[0]';
        $dest = "thumbs/$file.jpg";
 
        if (!file_exists($dest))
        {
            $exec = "~/local/bin/convert -scale 200 -background white -colorspace sRGB -modulate 100,95 '$source' '$dest'";
            exec($exec);
        }
 		return "<img src=\"$dest\" class=\"thumb\"/>";
   }
   
// returns a formatted string of the date for a given filename (assumes MMDDYYYY)
function getIssueDate($file) {
	if (strlen($file)== 12){
	$n = substr($file, 0, 2);
	$j = substr($file, 2, 2);
	$Y = substr($file, 4, 4);
	}
	$converted_date = mktime(0,0,0, $n, $j, $Y);
	return date ("F jS, Y", $converted_date);
}

// returns the height of a given $file
function getHeight($file){
	$size = getimagesize("thumbs/$file.jpg");
	return $size[1];
}

// displays all issues of a given $year
function displayIssues($dir, $year, $root_url, $site_url) {	
	$files = scandir($dir);
	rsort($files);

	foreach ($files as $file){
		if (isPDF($file)) {
			$issueDate = substr($file, 0, 2).'-'.substr($file, 2, 2);
			if ($year >= 2011) $height = 420;
			else if ($year >= 2004) $height = 370;
			else if ($year >= 1975) $height = 350;
			else if ($year >= 1901) $height = 320;
			else $height = 280;

			echo "<div id=\"$issueDate\" class=\"issue\" style=\"height: ".$height."px\"><div class=\"mosaic-block fade\" style=\"height: ".getHeight($file)."px\">".
				"<a href=\"$root_url$year/$file\" class=\"mosaic-overlay\">". 
					"<div class=\"details\" style=\"padding-top: ".getHeight($file)*0.4."px\">".
						"<p>".getIssueDate($file)."</p>".
				'<div class="fb-like" data-href="'.$site_url.'browse.php?year='.$year.'#'.$issueDate.'" data-send="true" data-layout="button_count" data-width="130" data-show-faces="false"></div>'.
				"</div></a>". 
			"<div class=\"mosaic-backdrop\">".getThumb($file, $dir)."</div></div></div>";
        }
	}
}

// displays the $num most recent issues of a given $year
function displayRecent($dir, $year, $root_url, $site_url, $num) {
	$files = scandir($dir);
	rsort($files);
	foreach ($files as $file) {
		if (++$i == $num) break;
		if (isPDF($file)) {
			$issueDate = substr($file, 0, 2).'-'.substr($file, 2, 2);
    		echo "<div id=\"$issueDate\" class=\"issue\" style=\"height: ".$height."px\"><div class=\"mosaic-block fade\" style=\"height: ".getHeight($file)."px\">".
				"<a href=\"$root_url$year/$file\" class=\"mosaic-overlay\">". 
					"<div class=\"details\" style=\"padding-top: ".getHeight($file)*0.4."px\">".
						"<p>".getIssueDate($file)."</p>".
				'<div class="fb-like" data-href="'.$site_url.'browse.php?year='.$year.'#'.$issueDate.'" data-send="true" data-layout="button_count" data-width="130" data-show-faces="false"></div>'.
				"</div></a>". 
			"<div class=\"mosaic-backdrop\">".getThumb($file, $dir)."</div></div></div>";
        }
	}
}

// returns URL of the latest issue published on the Archives
function getLinkToLatestIssue($root_dir, $root_url) {
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
