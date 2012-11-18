<!DOCTYPE html>
<html>

<head>
<title>Recent Issues | Phillipian Online Archives</title>
<?php include('includes/common_header.php'); ?>
<script type="text/javascript">  
	$(function(){
		$('.fade').mosaic();
		$('.masonry-container').masonry({
			itemSelector : '.issue',
			columnWidth : 240
		});
	});
</script>
</head>

<body>

<?php
	include 'includes/common.php';
	$year = date('Y');
	$month = date('n');
	
	$dir1 = $root_dir.$year;
	$dir2 = $root_dir.($year-1);
?>

<div id="browse">
	<div id="title">
		<h1>Recent Issues</h1>
		<a href="index.php">Go Back</a>
	</div>
	<div class="masonry-container">
		<?php
			displayRecent($dir1, $year, $root_url, 10); // display 10 most recent issues
			if ($month == 1 || $month == 2 || $month == 3) displayRecent($dir2, $year-1, $root_url, 10); // if jan, feb, mar. display 10 most recent issues in prev. year as well
		?>
	</div>
</div>

</body>

</html>
