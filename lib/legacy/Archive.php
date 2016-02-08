<?php

  /**
  * Archive.php
  *
  * Allows one to traverse directories with PDF files and thumbnails.
  * Deprecated in favor of a database approach, which makes sorting easier.
  *
  * @author     Rudd Fawcett
  * @copyright  2016 The Phillipian
  * @license    MIT License
  * @version    1.0
  * @link       http://github.com/phillipian/plip-archives
  * @deprecated February 2016
  */

  require('Issue.php');

  class Archive {
    const PDF_DIR = '../pdfs/';
    const THUMBS_DIR = 'thumbs/';
    const ROOT_URL = 'http://pdf.phillipian.net/';
    const SITE_URL = 'http://archives.phillipian.net/';

    const MIN_YEAR = 1878;

    public function __construct() {

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
        return nil;
      }

      $year_dir = self::PDF_DIR.$year;

      if (!file_exists($year_dir)) {
        return nil;
      }

      $year_issues = [];

      $issues = array_diff(scandir($year_dir), ['..', '.']);
      rsort($issues);

      if ($count != 0) {
        $issues = array_splice($issues, 0, $count);
      }

      foreach($issues as $issue) {
        if (!$this->isPDF($issue)) {
          continue;
        }

        $an_issue = new Issue($issue);
        $thumbnail = $this->getThumbnail($an_issue);
        $an_issue->setThumbnail($thumbnail);
        $year_issues[] = $an_issue;
      }


      return $year_issues;
    }

    public function getDayInHistory($month, $day) {
      if ($month == 0 || $day == 0) {
        return nil;
      }

      $found_issues = [];

      for ($y = $this->getYear(); $y >= self::MIN_YEAR; $y--) {
        $year_dir = self::PDF_DIR.$y;

        if (!file_exists($year_dir)) {
          continue;
        }

        $issues = array_diff(scandir($year_dir), ['..', '.']);
        rsort($issues);

        foreach ($issues as $issue) {
          if (!$this->isPDF($issue)) {
            continue;
          }

          $an_issue = new Issue($issue);

          if ($an_issue->getDay() == $day && $an_issue->getMonth() == $month) {
            $thumbnail = $this->getThumbnail($an_issue);
            $an_issue->setThumbnail($thumbnail);
            $found_issues[] = $an_issue;
          }
        }
      }

      return $found_issues;
    }

    /**
     * Gets the $count most recent Issues, regardless of year.
     * @param  integer $count The number of Issues, defaults to 10.
     * @return array          The Issues.
     */
    public function getRecent($count = 10) {
      $year = $this->getYear();
      $year_dir = self::PDF_DIR.$year;
      $issues = array_diff(scandir($year_dir), ['..', '.']);
      rsort($issues);

      $recent_issues = [];

      $i = 0;
      for ($y = $this->getYear(); $y >= self::MIN_YEAR; $y--) {
        $year_dir = self::PDF_DIR.$y;

        if (!file_exists($year_dir)) {
          continue;
        }

        $issues = array_diff(scandir($year_dir), ['..', '.']);
        rsort($issues);

        foreach ($issues as $issue) {
          if (!$this->isPDF($issue)) {
            continue;
          }

          $an_issue = new Issue($issue);
          $thumbnail = $this->getThumbnail($an_issue);
          $an_issue->setThumbnail($thumbnail);
          $recent_issues[] = $an_issue;

          $i++;

          if ($i == $count) {
            break;
          }
        }

        if ($i == $count) {
          break;
        }
      }

      return $recent_issues;
    }

    /**
     * Gets a random issue from the PDF_DIR.
     * @return Issue The random issue.
     */
    public function getRandom() {
      $year = $this->getYear();
      $rand_year = mt_rand(self::MIN_YEAR, $year);
      $rand_year = 2016;
      $year_dir = self::PDF_DIR.$rand_year;

      if (!file_exists($year_dir)) {
        return;
      }

      $issues = array_diff(scandir($year_dir), ['..', '.']);
      sort($issues);

      $random = mt_rand(0, count($issues)-1);
      $issue = $issues[$random];

      $an_issue = new Issue($issue);
      $thumbnail = $this->getThumbnail($an_issue);
      $an_issue->setThumbnail($thumbnail);

      return $an_issue;
    }

    /**
     * Gets the thumbnail image for an Issue.  If the thumbnail is not
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
     * Gets the latest issue.
     * @return Issue The latest issue.
     */
    public function getLatestIssue() {
      $year = $this->getYear();
      $year_dir = self::PDF_DIR.$year;
      $latest;

      if (!is_dir($year_dir)) {
        $year_dir = self::PDF_DIR.($year-1);
      }

      $issues = array_diff(scandir($year_dir), ['..', '.']);
      rsort($issues);

      $latest = $issues[0];

      $an_issue = new Issue($latest);
      $thumbnail = $this->getThumbnail($an_issue);
      $an_issue->setThumbnail($thumbnail);

      return $an_issue;
    }

    /**
     * @return integer The current year in the format YYYY.
     */
    protected function getYear() {
      return date('Y');
    }

    /**
     * Checks to see if a file is a PDF.
     * @param  string  $path The path to a potential PDF file.
     * @return boolean       Whether or not the file is a PDF.
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
     * CAUTION: Regenerates all thumbnails for _every_ issue in
     * the PDF_DIR.  Use sparingly.
     */
    public function generateThumbnails() {
      $years = array_diff(scandir(self::PDF_DIR), ['..', '.']);

      foreach ($years as $year) {
        $year_dir = self::PDF_DIR.$year;

        if (is_dir($year_dir)) {
          $issues = array_diff(scandir($year_dir), ['..', '.']);
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
        else continue;
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
