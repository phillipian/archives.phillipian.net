<?php
  include_once(__DIR__.'/../lib/Archive.php');
  $archive = new Archive();
?>
<!-- Created by Rudd Fawcett '18 for The Phillipian. Designed by Ally Klionsky '17. -->
<!DOCTYPE html>
<html lang='en'>
  <head>
    <title><?php echo $title; ?></title>

    <link rel='icon' type='image/ico' href='assets/images/favicon.ico' />
    <link rel='stylesheet' type='text/css' href='assets/styles/main.css' />

    <meta charset='UTF-8'>
    <meta name='description' content="The Phillipian's Archives allow you to explore 5.2k+ past issues of The Phillipian since its founding in 1878." />
    <meta name='keywords' content='the phillipian, phillipian, phillips academy, andover, pa, student journalism, newspaper' />

    <!-- Open Graph data -->
    <meta property='og:url' content='http://archives.phillipian.net' />
    <meta property='og:title' content='The Phillipian: Archives' />
    <meta property='og:description' content="The Phillipian's Archives allow you to explore 5.2k+ past issues of The Phillipian since its founding in 1878." />
    <meta property='og:image' content='http://archives.phillipian.net/assets/images/pliparchives_p.jpg' />

    <!-- Facebook data -->
    <meta property='fb:page_id' content='201784209836581' />
    <meta property='fb:app_id' content='216970804999359' />

    <!-- Twitter data -->
    <meta name='twitter:card' content='summary' />
    <meta name='twitter:site' content='@phillipian' />
    <meta name='twitter:title' content='The Phillipian: Archives' />
    <meta name='twitter:description' content="The Phillipian's Archives allow you to explore 5.2k+ past issues of The Phillipian since its founding in 1878." />
    <meta name='twitter:image' content='http://archives.phillipian.net/assets/images/pliparchives_p.jpg' />

    <!-- Google Plus data -->
    <meta itemscope itemtype='https://schema.org/WebSite' />
    <meta itemprop='name' content='The Phillipian: Archives' />
    <meta itemprop='description' content="The Phillipian's Archives allow you to explore 5.2k+ past issues of The Phillipian since its founding in 1878." />
    <meta itemprop='image' content='http://archives.phillipian.net/assets/images/pliparchives_p.jpg' />
  </head>
  <body>
    <div class='wrapper'>
    <?php include(__DIR__.'/../views/navigation.php'); ?>
