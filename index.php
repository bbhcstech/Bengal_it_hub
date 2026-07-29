<?php

// This project's document root should be the public/ folder, but when
// accessed directly at the project root (e.g. http://localhost/bengal-it-hub/
// on XAMPP without a dedicated vhost), redirect into public/ instead of
// falling through to Apache's directory listing.
$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
header('Location: '.$base.'/public/');
exit;
