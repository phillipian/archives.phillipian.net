<?php
  $title = 'Latest Issue';
  include('includes/header.php');
  $latest = $archive->getLatest();

  if (array_key_exists('thumb', $_GET))  {
    header("Location: ".(string)$latest->getThumbnail());
  }
?>

<h3 class='redirect'>We are redirecting you to the latest issue of <i>The Phillipian</i> (<?php echo $latest->getPrettyDate(); ?>).  <a href="<?php echo $latest->getURL(); ?>">Click here if nothing is happening.</a></h3>

<script type='text/javascript'>
  window.setTimeout(function() {
    window.location.href = "<?php echo $latest->getURL(); ?>";
  }, 1000);
</script>

<?php include('includes/footer.php'); ?>
