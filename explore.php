<!DOCTYPE html>
<html>

<head>
<title>Browse by Year | Phillipian Online Archives</title>
<?php include('includes/common_header.php'); ?>
<script>
	$(function(){
		$('.masonry-container').masonry({
			itemSelector: '.item',
			columnWidth: 180
		});
	});
</script>
</head>

<body>

<div id="by-year" class="masonry-container">
	<div id="title" class="item">
		<h1>explore the archives...</h1>
		<a href="index.php">Go Back</a>
	</div>
	<?php
		include 'includes/common.php';
		$year = date('Y');

		for ($y = $year; $y >= 1878; $y--)
			if (is_dir($root_dir.$y))
				echo "<a href=\"browse.php?year=$y\" class=\"year item\">$y</a>";
	?>
</div>

</body>

</html>
