<!DOCTYPE html>
<html>

<head>
<title>Phillipian Online Archives</title>
<?php include('includes/common_header.php'); ?>
</head>

<body>

<?php include('includes/common.php'); ?>
<div id="fp-wrapper">
	<div id="title">
		<h1><i>The Phillipian</i> Archives</h1>
		<h3>Explore <i>The Phillipian</i> since 1878!</h3>
		<a href="http://phillipian.net">Go back to The Phillipian Online</a>
	</div>
	<div id="links">
		<a id="latest" class="link rounded" href="<?php echo getLinkToLatestIssue("../pdfs/", "http://pdf.phillipian.net/"); ?>">
		Latest</a> <a id="recent" class="link rounded" href="recent.php">Recent</a>
		<a id="browse-year" class="link rounded" href="explore.php">Browse</a>
		<a id="go-back" class="link rounded last" href="random.php">Random</a>
	</div>
	<div id="feedback">
		<p>Suggestions? Go to: <a href="http://phillipian.net/forms/website-issues">
		http://phillipian.net/forms/website-issues</a></p>		
		<div class="fb-like" data-href="http://www.facebook.com/thephillipian" data-layout="button_count" data-send="false" data-show-faces="false" data-width="260"></div>
		</div>

</div>

</body>

</html>
