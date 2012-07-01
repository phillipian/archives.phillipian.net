<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Browse by Year | Phillipian Online Archives</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/mosaic.css" media="screen" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js" type="text/javascript"></script>
<script src="includes/mosaic.1.0.1.min.js" type="text/javascript"></script>
<script type="text/javascript">

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

<div id="by-year">
	<div id="title">
		<h1>explore the archives...</h1>
		<a href="index.php">Go Back</a></div>
	<?php
include 'includes/common.php';
$year = date('Y');

for ($y = $year; $y >= 1878; $y--) {
	if (is_dir($root_dir.$y)) {
		echo "<a href=\"browse.php?year=$y\" class=\"year\">$y</a>";
	}
}?></div>

</body>

</html>
