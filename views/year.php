<div class='issues'>
  <h1 class='section-title'>Issues from <?php echo $_GET['year']; ?></h1>
  <?php
    $issues = $archive->getIssues($_GET['year']);
    if (count($issues) == 0):
  ?>
    <h3 style='font-weight: 200; margin: 20px 0 0 45px;'>Nothing to see here. Our first archived issue is from <?php echo Archive::MIN_YEAR; ?>.</h3>
  <?php else: ?>
    <?php foreach($issues as $issue): ?>
      <div class='issue'>
        <h3><?php echo $issue->getPrettyDate(); ?></h3>
        <a href="<?php echo $issue->getURL();?>">
          <img src="<?php echo (string)$issue->getThumbnail(); ?>">
        </a>
      </div>
    <?php endforeach ?>
  <?php endif ?>
</div>
