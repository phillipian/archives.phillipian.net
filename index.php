<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Phillipian Online Archives</title>
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
<link rel="shortcut icon" href="/favicon.png">
</head>

<body>

<?php function getLatest() {
	include 'includes/common.php';
	$year = date('Y');
	$month = date('n');
	$dir = $root_dir.$year;
	if (is_dir($dir)) {
		$files = scandir($dir);
		rsort($files);
		echo $root_url."$year/$files[0]";
		}
	else {
		$dir = $root_dir.($year-1);
		$files = scandir($dir);
		rsort($files);
		echo $root_url."$year/$files[0]";
	}
}
?>
<div id="fp-wrapper">
	<div id="title" class="rounded">
		<h1>The Phillipian Archives</h1>
		<h3>Explore the Phillipian since 1878!</h3>
		<a href="http://phillipian.net">Go back to the Phillipian Online</a>
	</div>
	<div id="links">
		<a id="latest" class="link rounded" href="<?php getLatest(); ?>">Latest</a>
		<a id="recent" class="link rounded" href="recent.php">Recent</a>
		<a id="browse-year" class="link rounded" href="explore.php">Browse</a>
		<a id="go-back" class="link rounded last" href="random.php">Random</a>
	</div>
	<div id="feedback">
		Suggestions? Go to: <a href="http://phillipian.net/forms/website-issues">
		http://phillipian.net/forms/website-issues</a> </div>
</div>

</body>

</html>
