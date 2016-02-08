<?php

  /**
  * Issue.php
  *
  * An abstract representation of a Thumbnail for a publication.
  * Very much based on the current storage structure for The Phillipian.
  *
  * @author     Rudd Fawcett<rudd.fawcett@gmail.com>
  * @copyright  2016 The Phillipian
  * @license    MIT License
  * @version    1.0
  * @link       http://github.com/phillipian/plip-archives
  */

  require_once('Archive.php');

  class Thumbnail {
    private $path;

    /**
     * Creates a new Thumbnail object.
     * @param string $path The path to the thumbnail.
     */
    public function __construct($path) {
      $this->path = $path;
    }

    /**
     * @return integer The height of the thumbnail (pixel height).
     */
    function getHeight() {
      $size = getimagesize($this->path);
      return $size[1];
    }

    public function __toString() {
      // return Archive::SITE_URL.$this->path;
      return $this->path;
    }
  }

 ?>
