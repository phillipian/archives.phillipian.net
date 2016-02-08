<?php

  /**
  * Issue.php
  *
  * An abstract representation of an Issue for a publication.
  * Very much based on the current storage structure for The Phillipian.
  *
  * @author     Rudd Fawcett<rudd.fawcett@gmail.com>
  * @copyright  2016 The Phillipian
  * @license    MIT License
  * @version    1.0
  * @link       http://github.com/phillipian/plip-archives
  */

  date_default_timezone_set('America/New_York');

  require_once('Archive.php');
  require('Thumbnail.php');

  class Issue implements JsonSerializable {
    protected $month;
    protected $day;
    protected $year;

    protected $file;
    protected $path;
    protected $url;

    protected $thumbnail;

    public function __construct($file) {
      $this->file = $file;

      if (strlen($file) == 12) {
        $this->month = substr($file, 0, 2);
        $this->day = substr($file, 2, 2);
        $this->year = substr($file, 4, 4);
      }

      $this->path = Archive::PDF_DIR.$this->year.'/'.$file;
      $this->url = Archive::ROOT_URL.$this->year.'/'.$file;
    }

    /**
     * Converts the date parts into a "pretty" date.
     * @return date The pretty date.
     */
    public function getPrettyDate() {
      $converted_date = mktime(0, 0, 0, $this->month, $this->day, $this->year);
      return date("F j, Y", $converted_date);
    }

    public function getDate() {
      return $this->year.'-'.$this->month.'-'.$this->day;
    }

    /**
     * Sets the thumbnail for this issue.
     * @param Thumbnail $thumbnail The thumbnail.
     */
    public function setThumbnail($thumbnail) {
      $this->thumbnail = $thumbnail;
    }

    /**
     * @return Thumbnail the thumbnail for this Issue.
     */
    public function getThumbnail() {
      return $this->thumbnail;
    }

    /**
     * @return integer The month that this Issue was published.
     */
    public function getMonth() {
      return $this->month;
    }

    /**
     * @return integer The day that this Issue was published.
     */
    public function getDay() {
      return $this->day;
    }

    /**
     * @return integer The year that this Issue was published.
     */
    public function getYear() {
      return $this->year;
    }

    /**
     * @return string The filename of the Issue.
     */
    public function getFile() {
      return $this->file;
    }

    /**
     * @return string The link to the issue.
     */
    public function getURL() {
      return $this->url;
    }

    /**
     * Maps keys and values for conversion to a JSON serialization.
     * @return array The mapping of keys and values.
     */
    public function jsonSerialize() {
      return [
        "date" => date('Y-m-d', strtotime($this->getDate())),
        "url" => $this->url,
        "thumb" => (string)$this->thumbnail
      ];
    }
  }

?>
