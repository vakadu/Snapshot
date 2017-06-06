<?php

// echo __DIR__;    path of directory /var/www/html/Snapshot/admin/includes

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
//if DS its defined we apply null, if its not defined we define it

define('SITE_ROOT', DS . 'var' . DS . 'www' . DS . 'html' . DS . 'Snapshot');

defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS . 'admin' . DS . 'includes');

require_once ("functions.php");
require_once ("new_config.php");
require_once ("database.php");
require_once ("db_object.php");
require_once ("user.php");
require_once ("photo.php");
require_once ("session.php");
require_once ("comment.php");
