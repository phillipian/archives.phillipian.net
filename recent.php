<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Recent Issues | Phillipian Online Archives</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/mosaic.css" media="screen" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js" type="text/javascript"></script>
<script src="includes/mosaic.1.0.1.min.js" type="text/javascript"></script>
<script type="text/javascript">  
			jQuery(function($){
				$('.fade').mosaic();
						    });
		 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-24401254-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body>

<div id="browse">
	<?php
include 'includes/common.php';
$year = date('Y');
$month = date('n');

$dir1 = $root_dir.$year;
$dir2 = $root_dir.($year-1);
?>
	<div id="title">
		<h1>Recent Issues</h1>
		<a href="index.php">Go Back</a></div>
	<?php
$i = 0;

displayRecent($dir1, $year, $root_url, 10);

if ($month == 1 || $month == 2 || $month == 3) displayRecent($dir2, $year-1, $root_url, 10);
?></div>

</body>

</html>
