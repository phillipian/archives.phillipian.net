<div class='issues'>
  <!-- <h1 class='section-title'>Today in History</h1> -->
  <?php
    $issues = $archive->getIssuesForDay(date('m'), date('d'));
    if (count($issues) == 0):
  ?>
    <h3 style='font-weight: 200; margin: 20px 0 0 45px;'>Nothing to see here today!  Try coming back tomorrow.</h3>
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
