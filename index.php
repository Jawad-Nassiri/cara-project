


<?php
require "inc/init.inc.php";

$admin = $_GET["doc"] ?? null;
$controller = $_GET["controller"] ?? "product";
$method = $_GET["method"] ?? "index";
$id = $_GET["id"] ?? null;

if (!empty($admin)) {
    $classController = "Controllers\\admin\\" . ucfirst($controller) . "Controller";
} else {
    $classController = "Controllers\\" . ucfirst($controller) . "Controller";
}


if (!class_exists($classController)) {
    echo "Error: The controller '$classController' does not exist.";
    exit;
}

try {
    $controllerInstance = new $classController;

    if (!method_exists($controllerInstance, $method)) {
        echo "Error: The method '$method' does not exist in '$classController'.";
        exit;
    }

    $controllerInstance->$method($id);
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}



