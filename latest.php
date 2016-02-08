<?php
  include_once('lib/Archive.php');
  $archive = new Archive();
  include('includes/footer.php');
  $location = $archive->getLatest()->getURL();
  header("Location: $location");
?>
