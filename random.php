<?php
  include_once('lib/Archive.php');
  $archive = new Archive();
  include('includes/footer.php');
  $location = $archive->getRandom()->getURL();
  header("Location: $location");
?>
