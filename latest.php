<?php
  if (array_key_exists('t', $_GET))  {
    require('lib/Archive.php');
    $archive = new Archive();
    $latest = $archive->getLatest();
    if (!headers_sent()) {
      header('Location: '.(string)$latest->getThumbnail());
    }
  }

  $title = 'Latest Issue';
  include('includes/header.php');
  $latest = $archive->getLatest();
  if (!headers_sent()) {
    header('Location: '.(string)$latest->getThumbnail());
  }
?>

<h3 class='redirect'>We are redirecting you to the latest issue of <i>The Phillipian</i> (<?php echo $latest->getPrettyDate(); ?>).  <a href="<?php echo $latest->getURL(); ?>">Click here if nothing is happening.</a></h3>

<?php include('includes/footer.php'); ?>
