<?php
    if(!function_exists("isRoute")){
        function isRoute($route, $class){
            return Route::current()->getName() == $route ? ' ' . $class : '';
        }
    }
?>