<?php
	include('includes/common.php');

	$year = "null";
	
	if(isset($_GET['year'])){
		if ($_GET['year'] <= date('Y') && $_GET['year'] >= 1878){
			$year = $_GET['year'];
		}
	}
	
	$dir = $root_dir.$year;

?>

<!DOCTYPE html>
<html>

<head>
<title>Browse <?php echo $year; ?> Issues | Phillipian Online Archives</title>
<?php include('includes/common_header.php'); ?>
<script type="text/javascript">  
	$(function(){
		$('.fade').mosaic();
		$('.masonry-container').masonry({
			itemSelector: '.issue',
			columnWidth: 240,
			gutterWidth: 10,
			isFitWidth: true
		});
		if (typeof window.location.hash != 'undefined') {
			$(window.location.hash).css('border','2px solid #00325F');
		}
	});

</script>
</head>

<body>

<div id="browse">
	<div id="title">
		<h1>
		<?php
			if ($year != "null")
				echo "browse by year: ".$year; 
			else
				echo "Page not Found";
		?>
		</h1>
		<a href="explore.php">Go Back</a>
	</div>
	<div class="masonry-container">
		<?php
			if ($year != "null") displayIssues($dir, $year, $root_url, $site_url);
		?>
	</div>
</div>

</body>

</html>
