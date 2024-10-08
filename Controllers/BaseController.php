<?php

namespace Controllers;

abstract class BaseController
{

    public function render($file, array $array = [])
    {
        extract($array);

        include "public/header.html.php";
        include "views/$file";
        include "public/footer.html.php";
    }
}
