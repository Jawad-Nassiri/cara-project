<?php
function addLink($controller, $method, $id = null)
{
    // return ROOT . "?controller=$controller&method=$method" . ($id ? "&id=$id" : "");
    return ROOT . "$controller/$method" . ($id ? "/$id" : "");
}


function debug($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

function d_die($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die;
}

function redirection($url)
{
    header("Location: $url");
    exit;
}

// ⚠ test 
function error($num = 404)
{
    redirection("errors/$num.php");
    exit;
}
