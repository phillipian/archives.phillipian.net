#The Phillipian Online Archives PDF Interface
Built by Eric Ouyang '13 (CXXXIV/CXXXV)

This is a custom coded PHP-based website that displays the grid format all the past Phillipian issues at http://archives.phillipian.net

Some notes:
* config located in includes/common.php
* relies on pdf folder structure with [year]/[MMDDYYYY].pdf
* uses jQuery, jQuery Masonry (https://github.com/desandro/masonry), and jQuery Mosaic (https://github.com/buildinternet/mosaic)
* if need to flush the thumbs (ie. delete the contents of the thumbs folder) - regenerate using generatethumbs.php
