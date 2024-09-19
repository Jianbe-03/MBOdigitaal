<?php
require $_SERVER["DOCUMENT_ROOT"] . '/docroot.php';
require __DOCUMENTROOT__ . '/config/globalvars.php';

require __DOCUMENTROOT__ . '/models/Auth.php';
Auth::check(["applicatiebeheerder", "administrator"]);

require_once __DOCUMENTROOT__ . '/models/Levels.php';
require_once __DOCUMENTROOT__ . '/models/Educations.php';

$levels = Level::selectAll();

require __DOCUMENTROOT__ . '/views/admin/levels/overview.php';