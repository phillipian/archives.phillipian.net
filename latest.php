<?php

include 'includes/common.php';
$redirect = getLinkToLatestIssue($root_dir, $root_url);
header("Location: $redirect");

?>
