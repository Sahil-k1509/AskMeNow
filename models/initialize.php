<?php 
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'askMeNow');
    defined('DB_PATH') ? null : define('DB_PATH', SITE_ROOT.DS.'dbh');
    defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'models');

    require_once(DB_PATH.DS."dbh.class.php");
    require_once(CORE_PATH.DS."user.model.php");
?>