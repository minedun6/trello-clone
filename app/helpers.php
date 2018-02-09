<?php

if (! function_exists('ddd')) {

    /**
     * workaround for the laravel helper function dd
     * @param array $args
     */
    function ddd(...$args)
    {
        http_response_code(500);
        call_user_func_array('dd', $args);
    }
}

if (! function_exists('random_color')) {

    /**
     * generates a random color
     */
    function random_color()
    {
        return '#' . dechex(rand(0x000000, 0xDDDDDD));
    }
}
