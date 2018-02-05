<?php

if (! function_exists('ddd')) {
    
    /**
     * workround for the laravel helper function dd
     */
    function ddd(...$args)
    {
        http_response_code(500);
        call_user_func_array('dd', $args);
    }
}
