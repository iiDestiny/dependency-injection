<?php

if (!function_exists('di_register')) {
    /**
     * Dependency injection registration Helper method
     *
     * @param $instance
     *
     * @return string
     */
    function di_register($instance)
    {
        return (new \Iidestiny\DependencyInjection\App())->register($instance);
    }
}