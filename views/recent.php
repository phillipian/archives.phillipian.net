<div class='issues'>
  <!-- <h1 class='section-title'>Recent</h1> -->
  <?php foreach($archive->getRecent(15) as $issue): ?>
    <div class='issue'>
      <h3><?php echo $issue->getPrettyDate();?></h3>
      <a href="<?php echo $issue->getURL(); ?>">
        <img src="<?php echo (string)$issue->getThumbnail(); ?>">
      </a>
    </div>
  <?php endforeach ?>
</div>
