<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title><?php echo $year; ?> Issues | Phillipian Online Archives</title>
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

<?php include 'includes/common.php'?>
<?php
$year = "null";

if(isset($_GET['year'])){
	if ($_GET['year'] <= date('Y') && $_GET['year'] >= 1878){
		$year = $_GET['year'];
	}
}

$dir = $root_dir.$year;

?>
<div id="browse">
	<div id="title">
		<h1><?php if ($year != "null") {
echo "browse by year: ".$year; 
}
else { echo "Page not Found"; }
?></h1>
		<a href="explore.php">Go Back</a></div>
	<?php
if ($year != "null") {
	displayIssues($dir, $year, $root_url);
}
?></div>

</body>

</html>
