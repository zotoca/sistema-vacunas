<?php
    function isRoute($route, $class){
        return Route::current()->getName() == $route ? ' ' . $class : '';
    }
?>