<?php

  /**
  * Archive.php
  *
  * Allows one to traverse directories with PDF files and thumbnails through
  * a MySQL database approach.
  *
  * @author     Rudd Fawcett<rudd.fawcett@gmail.com>
  * @copyright  2016 The Phillipian
  * @license    MIT License
  * @version    1.1
  * @link       http://github.com/phillipian/plip-archives
  */

  require('Issue.php');
  require('Keys.php');

  class Archive {
    private $db;

    const PDF_DIR = '../pdfs/';
    const THUMBS_DIR = 'thumbs/';
    const ROOT_URL = 'http://pdf.phillipian.net/';
    const SITE_URL = 'http://archives.phillipian.net/';

    const MIN_YEAR = 1878;

    public function __construct() {
      $this->db = new PDO('mysql:host='.Keys::DB_HOST.';dbname=pliparchives;charset=utf8', Keys::USERNAME, Keys::PASSWORD);
    }

    /**
     * Gets $count issues for the year.  Defaults to all issues,
     * unless $count is overridden with a value within the archival
     * range.
     * @param  integer  $year  The year to get issues from.
     * @param  integer $count  The number of issues to get.  Defaults to all.
     * @return array           An array of Issues.
     */
    public function getIssues($year, $count = 0) {
      if (!$this->isValidYear($year)) {
        return [];
      }

      $issues = [];

      $stmt;

      if ($count == 0) {
        $stmt = $this->db->query("SELECT * FROM `archives` WHERE YEAR(published)=$year ORDER BY published DESC");
      }
      else {
        $stmt = $this->db->query("SELECT * FROM `archives` WHERE YEAR(published)=$year ORDER BY published DESC LIMIT $count");
      }

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $an_issue = new Issue($row['filename']);
        $thumbnail = $this->getThumbnail($an_issue);
        $an_issue->setThumbnail($thumbnail);
        $issues[] = $an_issue;
      }

      return $issues;
    }

    /**
     * Gets an array of all of the issues on a certain day.
     * @param  integer $month The month of the issue.
     * @param  integer $day   The day of the issue.
     * @return array          The issues on that day.
     */
    public function getIssuesForDay($month, $day) {
      if ($month == 0 || $day == 0) {
        return [];
      }

      $issues = [];

      $stmt = $this->db->query("SELECT * FROM `archives` WHERE MONTH(published)=$month AND DAY(published)=$day ORDER BY published DESC");

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $an_issue = new Issue($row['filename']);
        $thumbnail = $this->getThumbnail($an_issue);
        $an_issue->setThumbnail($thumbnail);
        $issues[] = $an_issue;
      }

      return $issues;
    }

    /**
     * Gets the $count most recent Issues, regardless of year.
     * @param  integer $count The number of Issues, defaults to 10.
     * @return array          The Issues.
     */
    public function getRecent($count = 10) {
      $issues = [];

      $stmt = $this->db->query("SELECT * FROM `archives` ORDER BY published DESC LIMIT $count");

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $an_issue = new Issue($row['filename']);
        $thumbnail = $this->getThumbnail($an_issue);
        $an_issue->setThumbnail($thumbnail);
        $issues[] = $an_issue;
      }

      return $issues;
    }

    /**
     * Gets a random issue from the PDF_DIR.
     * @return Issue The random issue.
     */
    public function getRandom() {
      $stmt = $this->db->query("SELECT * FROM `archives` ORDER BY RAND() LIMIT 1");
      $row = $stmt->fetch();

      $issue = new Issue($row['filename']);
      $thumbnail = $this->getThumbnail($issue);
      $issue->setThumbnail($thumbnail);

      return $issue;
    }

    /**
     * Gets the latest issue.
     * @return Issue The latest issue.
     */
    public function getLatest() {
      $stmt = $this->db->query("SELECT * FROM `archives` ORDER BY published DESC LIMIT 1");
      $row = $stmt->fetch();

      $issue = new Issue($row['filename']);
      $thumbnail = $this->getThumbnail($issue);
      $issue->setThumbnail($thumbnail);

      return $issue;
    }

    /**
     * Gets the thumbnail image for an Issue. If the thumbnail is not
     * found, then it generates it.
     * @param  Issue $issue The issue for which to retreive a thumbnail.
     * @return Thumbnail    A Thumbnail of the issue.
     */
    public function getThumbnail($issue) {
      $source = self::PDF_DIR.$issue->getYear().'/'.$issue->getFile();

      if (!file_exists($source)) {
        return;
      }

      $year_dest = self::THUMBS_DIR.$issue->getYear().'/';

      if (!file_exists($year_dest)) {
        mkdir($year_dest);
      }

      $dest = $year_dest.pathinfo($source, PATHINFO_FILENAME).'.jpg';

      if (!file_exists($dest)) {
        $this->generateThumbnail($source, $dest);
      }

      return new Thumbnail($dest);
    }

    /**
     * @return integer The number of issues in the database.
     */
    public function getCount() {
      $stmt = $this->db->query("SELECT * FROM archives");
      return $stmt->rowCount();
    }

    /**
     * @return integer The current year in the format YYYY.
     */
    protected function getYear() {
      return date('Y');
    }

    /**
     * Checks to see if a file is a PDF.
     * @param  string $path The path to a potential PDF file.
     * @return boolean      Whether or not the file is a PDF.
     */
    protected function isPDF($path) {
      return pathinfo($path, PATHINFO_EXTENSION) === 'pdf';
    }

    /**
     * Whether or not a year falls within the archival range.
     * @param  intteger  $year The year to check.
     * @return boolean         If the year falls within the range.
     */
    public function isValidYear($year) {
      return $year >= self::MIN_YEAR && $year <= $this->getYear();
    }

    /**
     * Adds every issue to the database. Use with CAUTION. You will
     * have to uncomment the first 4 lines to use this function.
     */
    public function addAll() {
      echo "Are you sure you really want to do this?\n";
      echo "It will empty the archives and add every issue again.";
      exit();

      $this->db->query("TRUNCATE TABLE `archives`");

      $years = array_diff(scandir(self::PDF_DIR), ['..', '.']);
      sort($years);

      foreach ($years as $year) {
        if (!ctype_digit($year)) {
          continue;
        }

        $year_dir = self::PDF_DIR.$year;

        if (is_dir($year_dir)) {
          $issues = array_diff(scandir($year_dir), ['..', '.']);
          sort($issues);

          foreach ($issues as $issue) {
            if (!$this->isPDF($issue) || !ctype_digit(pathinfo($issue, PATHINFO_FILENAME))) {
              continue;
            }

            $an_issue = new Issue($issue);
            $stmt = $this->db->prepare("INSERT INTO archives(published,filename) VALUES(:published,:filename)");
            $stmt->execute([':published' => $an_issue->getDate(), ':filename' => $an_issue->getFile()]);
            $affected_rows = $stmt->rowCount();

            if ($affected_rows != 1) {
              echo $year.'/'.$issue;
            }
          }
        }
      }
    }

    /**
     * CAUTION: Regenerates all thumbnails for _every_ issue in
     * the PDF_DIR. Use sparingly. Make sure to comment out
     * `if (!file_exists($dest)) {`. (Added in as fail safe).
     */
    public function generateThumbnails() {
      $years = array_diff(scandir(self::PDF_DIR), ['..', '.']);
      sort($years);

      foreach ($years as $year) {
        $year_dir = self::PDF_DIR.$year;

        if (is_dir($year_dir)) {
          $issues = array_diff(scandir($year_dir), ['..', '.']);
          sort($issues);

          foreach ($issues as $issue) {
            if (!$this->isPDF($issue)) {
              continue;
            }

            $thumb_year = self::THUMBS_DIR.$year;

            if (!file_exists($thumb_year)) {
              mkdir($thumb_year);
            }

            $an_issue = new Issue($issue);
            $source = self::PDF_DIR.$an_issue->getYear().'/'.$an_issue->getFile();
            $dest = $thumb_year.'/'.pathinfo($source, PATHINFO_FILENAME).'.jpg';

            if (!ctype_digit(pathinfo($issue, PATHINFO_FILENAME))) {
              echo $source."\n";
              continue;
            }

            if (!file_exists($dest)) {
              $this->generateThumbnail($source, $dest);
            }
          }
        }
      }
    }

    /**
     * Uses Imagick to generate a thumbnail based on the
     * first page of a PDF file.
     * @param  string $source Which PDF file to generate the thumbnail from.
     * @param  string $dest   Where to save the thumbnail.
     * @return boolean        Whether or not the image could be saved.
     */
    public function generateThumbnail($source, $dest) {
      $im = new Imagick();
      $im->readImage($source.'[0]');
      $im->setResolution(300, 300);
      $im->scaleImage(300, 0);
      $im->setFormat('png');
      $im->setColorspace(Imagick::COLORSPACE_RGB);

      return $im->writeImage($dest);
    }
  }

?>
