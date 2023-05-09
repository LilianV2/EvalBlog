<?php

// Inclusion des classes autres.
use App\Controller\RootController;

require_once dirname(__FILE__) . '/../Model/DB.php';
require_once dirname(__FILE__) . '/../Controller/AbstractController.php';
require_once dirname(__FILE__) . '/../Controller/RootController.php';
require_once dirname(__FILE__) . '/../Controller/ArticlesController.php';

// Inclusion des entités.
require_once dirname(__FILE__) . '/../Model/Entity/User.php';
require_once dirname(__FILE__) . '/../Model/Entity/Article.php';

// Inclusion des managers.
require_once dirname(__FILE__) . '/../Model/Manager/UserManager.php';
require_once dirname(__FILE__) . '/../Model/Manager/ArticleManager.php';
require_once dirname(__FILE__) . '/router.php';


/*
$path = $_SERVER['PATH_INFO'];

/*
$rootController = new RootController();

if($path) {
    $controller = str_replace('/', '', $path);
    $controller = ucfirst($controller)."Controller";
    $require = dirname(__FILE__) . "/../Controller/$controller.php";

    if(file_exists($require)) {
        require_once $require;
        $controller = "App\\Controller\\$controller";
        $controller = new $controller();
        $controller->index();
    }
    else {
        $rootController->displayError(404);
    }
}
else {
    // Display la home page.
    $rootController->index();
}
*/

/*
echo "<pre>";
var_dump($page = $_SERVER['QUERY_STRING']);
echo "</pre>";
*/
