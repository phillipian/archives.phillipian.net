<?php
  include_once(__DIR__.'/../lib/Archive.php');
  $archive = new Archive();

  if ($title === '') {
    $title = "The Phillipian Archives";
  }
  else {
    $title = "The Phillipian Archives: ".$title;
  }

  // http://stackoverflow.com/a/6225706
  function sanitize_output($buffer) {
      $search = ['/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s'];
      $replace = [ '>', '<', '\\1'];

      return preg_replace($search, $replace, $buffer);
    }

  ob_start("sanitize_output");
?>
<!-- Created by Rudd Fawcett '18 for The Phillipian. Designed by Ally Klionsky '17. -->
<!DOCTYPE html>
<html lang='en'>
  <head>
    <title><?php echo $title; ?></title>

    <link rel='icon' type='image/ico' href='assets/images/favicon.ico' />
    <link rel='stylesheet' type='text/css' href='assets/styles/main.css' />

    <!-- Favicons data -->
    <link rel='apple-touch-icon' sizes='57x57' href='assets/images/favicon/apple-icon-57x57.png'>
    <link rel='apple-touch-icon' sizes='60x60' href='assets/images/favicon/apple-icon-60x60.png'>
    <link rel='apple-touch-icon' sizes='72x72' href='assets/images/favicon/apple-icon-72x72.png'>
    <link rel='apple-touch-icon' sizes='76x76' href='assets/images/favicon/apple-icon-76x76.png'>
    <link rel='apple-touch-icon' sizes='114x114' href='assets/images/favicon/apple-icon-114x114.png'>
    <link rel='apple-touch-icon' sizes='120x120' href='assets/images/favicon/apple-icon-120x120.png'>
    <link rel='apple-touch-icon' sizes='144x144' href='assets/images/favicon/apple-icon-144x144.png'>
    <link rel='apple-touch-icon' sizes='152x152' href='assets/images/favicon/apple-icon-152x152.png'>
    <link rel='apple-touch-icon' sizes='180x180' href='assets/images/favicon/apple-icon-180x180.png'>
    <link rel='icon' type='image/png' sizes='192x192'  href='/android-icon-192x192.png'>
    <link rel='icon' type='image/png' sizes='32x32' href='assets/images/favicon/favicon-32x32.png'>
    <link rel='icon' type='image/png' sizes='96x96' href='assets/images/favicon/favicon-96x96.png'>
    <link rel='icon' type='image/png' sizes='16x16' href='assets/images/favicon/favicon-16x16.png'>
    <link rel='manifest' href='assets/images/favicon/manifest.json'>
    <meta name='msapplication-TileColor' content='#000000'>
    <meta name='msapplication-TileImage' content='assets/images/favicon/ms-icon-144x144.png'>
    <meta name='theme-color' content='#000000'>

    <meta charset='UTF-8'>
    <meta name='description' content="The Phillipian's Archives allow you to explore the 5.2k+ past issues of The Phillipian since its founding in 1857." />
    <meta name='keywords' content='the phillipian, phillipian, phillips academy, andover, pa, student journalism, newspaper' />

    <!-- Open Graph data -->
    <meta property='og:url' content='http://archives.phillipian.net' />
    <meta property='og:title' content="<?php echo $title; ?>" />
    <meta property='og:description' content="The Phillipian's Archives allow you to explore the 5.2k+ past issues of The Phillipian since its founding in 1857." />
    <meta property='og:image' content='http://archives.phillipian.net/assets/images/facebook_card.png' />

    <!-- Facebook data -->
    <meta property='fb:admins' content='100004691580883' />
    <meta property='fb:page_id' content='201784209836581' />

    <!-- Twitter data -->
    <meta name='twitter:card' content='summary' />
    <meta name='twitter:site' content='@phillipian' />
    <meta name='twitter:title' content="<?php echo $title; ?>" />
    <meta name='twitter:description' content="The Phillipian's Archives allow you to explore the 5.2k+ past issues of The Phillipian since its founding in 1857." />
    <meta name='twitter:image' content='http://archives.phillipian.net/assets/images/pliparchives_p.jpg' />

    <!-- Google Plus data -->
    <meta itemscope itemtype='https://schema.org/WebSite' />
    <meta itemprop='name' content="<?php echo $title; ?>" />
    <meta itemprop='description' content="The Phillipian's Archives allow you to explore the 5.2k+ past issues of The Phillipian since its founding in 1857." />
    <meta itemprop='image' content='http://archives.phillipian.net/assets/images/pliparchives_p.jpg' />
  </head>
  <body>
    <div class='wrapper'>
    <?php include(__DIR__.'/../views/navigation.php'); ?>
