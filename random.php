<?php
  $title = 'Random Issue';
  include('includes/header.php');
  $random = $archive->getRandom();
?>

<h3 class='redirect'>We are redirecting you to the <?php echo $random->getPrettyDate() ?> issue of <i>The Phillipian</i>.  <a href="<?php echo $random->getURL(); ?>">Click here if nothing is happening.</a></h3>

<script type='text/javascript'>
  window.setTimeout(function() {
    window.location.href = "<?php echo $random->getURL(); ?>";
  }, 1000);
</script>

<?php include('includes/footer.php'); ?>
