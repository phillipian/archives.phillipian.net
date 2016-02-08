<div class='header'>
  <div class='content'>
    <div class='branding'>
      <div class='logo'></div>
      <h1><i>The Phillipian</i>: Archives</h1>
      <p>First printed in 1857, <i>The Phillipian</i> is Phillips Academy's weekly student newspaper. Completely uncensored and entirely student-run, the paper is distributed every Friday from September to June. Explore <i>The Phillipian</i> in its entirety from 1878.</p>
    </div>
    <div class='search'>
      <form action='../explore.php' method='GET'>
        <select name='year' onchange="this.form.submit()">
          <?php if (!array_key_exists($_GET, 'year')): ?>
            <option disabled='disabled' selected='selected'>Year:</option>
          <?php else: ?>
            <option disabled='disabled'>Year:</option>
          <?php endif ?>
          <?php for($y = date('Y'); $y >= Archive::MIN_YEAR; $y--): ?>
            <?php if ($_GET['year'] == $y): ?>
              <option selected='selected' value='<?php echo $y; ?>'><?php echo $y; ?></option>
            <?php else: ?>
              <option value='<?php echo $y; ?>'><?php echo $y; ?></option>
            <?php endif ?>
          <?php endfor ?>
        </select>
      </form>
    </div>
  </div>
  <div class='navigation'>
    <ul>
      <a href='../'><li><p>Recent</p></li></a>
      <a href='../today.php'><li><p>Today in History</p></li></a>
      <a href='../latest.php'><li><p>Latest</p></li></a>
      <a href='../random.php'><li><p>Random</p></li></a>
      <a href='https://twitter.com/pliparchives'><li><p>Twitter</p></li></a>
    </ul>
  </div>
</div>
