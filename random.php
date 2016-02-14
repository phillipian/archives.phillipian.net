<?php
  $title = 'Random Issue';
  include('includes/header.php');
  $random = $archive->getRandom();
  if (!headers_sent()) {
    header('Location: '.$random->getURL());
  }
?>

<h3 class='redirect'>We are redirecting you to the <?php echo $random->getPrettyDate() ?> issue of <i>The Phillipian</i>.  <a href="<?php echo $random->getURL(); ?>">Click here if nothing is happening.</a></h3>

<?php include('includes/footer.php'); ?>
