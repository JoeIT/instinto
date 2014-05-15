<?php
$GLOBAL_ROOT = realpath(dirname(__FILE__) . '/..') ;
$LOCAL_HOST = realpath(dirname(__FILE__) . '/..') ;

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

//se debe mejorar la forma de loading del acl
require_once 'Zend/Session.php';
require_once 'Zend/Acl.php';
require_once 'Zend/Auth.php';
require_once 'Zend/Controller/Plugin/Abstract.php';
require_once 'Zend/Controller/Front.php';
//----------------------------
//require_once $GLOBAL_ROOT . '/application/plugins/AclCustom.php';

$frontController = Zend_Controller_Front::getInstance();
//$frontController->registerPlugin(new AclCustomPlugin());
$frontController->throwExceptions(true);

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

$application->bootstrap()
            ->run();
