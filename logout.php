<?php

session_start();
session_unset(); 
session_destroy();

header('Location: /project%20final%20de%20poles/product/index');

exit();
