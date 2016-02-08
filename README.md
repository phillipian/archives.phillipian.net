_The Phillipian_ Archives
===

_The Phillipian_ Online Archives were originally built by Eric Ouyang '13 (CXXXIV/CXXXV).  Since then it has been completely rewritten, and the architecture has been drastically changed.  Little of the original code remains.

## Flexibility
When rewriting the archive management system, abstraction and flexibility were among the top priorities.  Though built with *The Phillipian* in mind, the library can be configured to work with any Phillipian-like PDF archive.

## Notes
- Out of the box, project relies on the PDF folder structure of `[year]/[MMDDYYYY].pdf`. This can be easily configured by fiddling with `lib/Issue.php`.
- To regenerate all of the thumbnails for **all** issues, take a look at `Archive->generateThumbnails()`.

This is a custom coded PHP-based website that displays the grid format all the past Phillipian issues at http://archives.phillipian.net.

## License
plip-archives is available under the MIT license. See the LICENSE file for more info.
