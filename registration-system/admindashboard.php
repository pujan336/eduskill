<?php
// Legacy filename: entry point that used to mirror an admin UI.
// Real admin lives in /admin/. This page redirects to the student portal hub.
header('Location: index.php', true, 302);
exit;
